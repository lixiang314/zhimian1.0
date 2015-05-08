
<?php 
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied by 1000.
$a = time() * 1000;
// The y value is a random number
$b = rand(50, 70);

// Create a PHP array and echo it as JSON
$ret = array($a, $b);
echo json_encode($ret);
?>
