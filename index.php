<?php include "./private/charge.php" ?>
<?php
  if(!empty($_GET['err_msg'])) :
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);
    $err_msg = $GET['err_msg'];
  endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="ie=edge" http-equiv="X-UA-Compatible">
  <title>Javier's Payment Form</title>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel=
  "stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel=
  "stylesheet">
  <link href="./css/style.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1 class="brand">Payment Form</h1>
    <div class="wrapper animated bounceInLeft">
      <div class="company-info">
        <h3>Contact Info</h3>
        <ul>
          <li><i class="fa fa-building"></i> PO BOX 180281 Arlington, TX 76096</li>
          <li><i class="fa fa-phone"></i> (214) 715-7510</li>
          <li><i class="fa fa-envelope"></i> Hire@JavierLona.com</li>
        </ul>
      </div>
      <div class="contact">
        <h3>Please complete all fields.</h3>
        <?php echo (isset($err_msg)) ? '<div class="error_message">'.$err_msg.'</div>' : ''; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="payment-form">
          <input type="email" name="customer_email" class="form-control mb-3 StripeElement StripeElement--empty" title="A valid email address is required" required placeholder="Email Address" value="">
          <input type="text" name="amount" class="form-control mb-3 StripeElement StripeElement--empty" title="Only digits and decimal points allowed" required pattern="[0-9.]+" placeholder="Enter a Dollar Amount" value="">
          <input type="text" name="note" class="form-control mb-3 StripeElement StripeElement--empty" title="No special characters allowed" required pattern="[A-Za-z0-9. ]+" placeholder="What is the payment for?" value="">
          <div class="full" id="card-element" class="form-control">
            <!-- A Stripe Element will be inserted here. -->
          </div>
          <!-- Used to display form errors. -->
          <div class="full" id="card-errors" role="alert"></div>
          <button class="full" name="payment_action" type="submit" value="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="./private/myscript.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript" src="./private/charge.js"></script>
</body>
</html>
