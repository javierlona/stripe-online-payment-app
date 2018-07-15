<?php
// Verifies I only process the passed parameters
function allowed_post_params($allowed_params=[]) {
  $allowed_array = [];
  foreach($allowed_params as $param) {
    if(isset($_POST[$param])) {
      $allowed_array[$param] = $_POST[$param];
    } else {
      $allowed_array[$param] = NULL;
    }
  }
  return $allowed_array;
}

// Verify the quantity entered is within a range and numeric
function has_number($value, $options=[]) {
  if(!is_numeric($value)) {
    return false;
  }
  if(isset($options['max']) && ($value > (int)$options['max'])) {
    return false;
  }
  if(isset($options['min']) && ($value < (int)$options['min'])) {
    return false;
  }
  return true;
}

?>
