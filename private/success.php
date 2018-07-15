<?php
  if(!empty($_GET['tid'])) :
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);
    $tid = $GET['tid'];
  else:
    header('Location: ../index.php');
  endif;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thank You</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel=
    "stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel=
    "stylesheet">
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h1 class="brand"><span>lona sites</span> Payment Succesful</h1>
        <div class="contact-success">
          <h3>Your payment is confirmed. Please check your email for your receipt.</h3>
          <p>Your transaction ID is: <?php echo $tid; ?></p>
          <p>Thank you for your payment. You may close this window.</p>
        </div>
      </div>
    </body>
</html>
