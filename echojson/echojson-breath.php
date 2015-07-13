<?php 
	include("../public/connect.php");
	header("Content-type: text/json");
	$id=$_GET["id"];
	$sql="SELECT breathRate FROM heartbeat where userId=$id order by id desc limit 1";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$x = time() * 1000;
	$y = floor($row['breathRate']);
	$ret = array($x, $y);
	echo json_encode($ret);
?>
