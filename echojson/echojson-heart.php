<?php 
include("../public/connect.php");
include("../public/function.php");

//header("Content-type: text/json");

$id=$_GET["id"];
$sql="SELECT heartbeatstring FROM heartbeat where userId=$id order by id desc limit 1";
//echo $sql;
//$sql="SELECT heartbeatstring FROM heartbeat  order by rand() limit 1 ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$datastring = $row['heartbeatstring'];
echo $datastring;


?>
