<?php 
include("../public/connect.php");
header("Content-type: text/json");
$id=$_GET["id"];
$sql="SELECT heartRate FROM heartbeat where userId=$id order by id desc limit 1";
//echo $sql;
//$sql="SELECT heartbeatstring FROM heartbeat  order by rand() limit 1 ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$x = time() * 1000;
// The y value is a random number
$y = floor($row['heartRate']);
// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);


?>
