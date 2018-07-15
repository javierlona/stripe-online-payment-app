<?php
// Verify request came from POST and Stripe Token was succesfully obtained
if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['stripeToken']))):

	// Call in my validation functions file
	include 'functions.php';

	// The only allowed parameters are listed below
	$post_params = allowed_post_params(['customer_email', 'amount','note','stripeToken']);
	// Initialize my forms error variable to false
	$paymentFormsErrors = false;

	// Validate the email
	$customer_email = filter_var($post_params['customer_email'], FILTER_VALIDATE_EMAIL) ? $post_params['customer_email'] : '';
	if(!$customer_email) :
	  $err_emailinvalid = '<div class="error_message">A valid email address is required.</div>';
	  $paymentFormsErrors = true;
	endif;

	// Validate the amount
	$amount = $post_params['amount'];
	$validamount = has_number($amount,['min' => 1,'max' => 10000]);

	if(!$validamount) :
		$err_amountinvalid = '<div class="error_message">A dollar amount from 1 - 10,000 is required.</div>';
		$paymentFormsErrors = true;
	else:
		$amount_cents = number_format((float)$amount, 2, '', '');
	endif;

	// Verify a note was entered
	$note = strip_tags($post_params['note']);
	if($note === '') :
		$err_noteblank = '<div class="error_message">A short description is required.</div>';
	  $paymentFormsErrors = true;
	endif;

	// Process the charge when no errors are found
	if(!($paymentFormsErrors)) :
		require_once('./vendor/autoload.php');
		\Stripe\Stripe::setApiKey('sk_test_tZQ88A2proEn1eoyD3YVKfG6');

		$stripeToken = $post_params['stripeToken'];
		// Create Customer In Stripe
		$customer = \Stripe\Customer::create(array(
			'email' => $customer_email,
			'source' => $stripeToken
		));

		// Charge Customer
		$charge = \Stripe\Charge::create(array(
			'amount' => $amount_cents,
			'currency' => 'usd',
			'description' => 'Web Development Services',
			'receipt_email' => $customer->email,
			'customer' => $customer->id,
			'metadata'=> array('reason_for_payment' => $note)
		));

		// Redirect to success page
		header('Location: ./private/success.php?tid='.$charge->id);
	else:
		$err_msg = 'Invalid data was submitted. Please try again.';
		header('Location: ./index.php?err_msg='.$err_msg);
	endif;

endif;
?>
