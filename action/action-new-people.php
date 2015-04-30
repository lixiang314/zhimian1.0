<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>action-new-people</title>
</head>

<body>
<?php

// session_start();

include("../public/connect.php");
include("../public/function.php");

	//判断用户是否登录，若没有登录，跳转到登录
// if(!isset($_SESSION['username'])){
// 	jump("http://localhost:8888/iask/admin_index.php");
// 	die("");
// }
	
@$name=$_POST['new-name']; 
@$age=$_POST['new-age'];
@$sex=$_POST['new-sex'];
@$date=$_POST['new-date'];
@$deviceId=$_POST['new-deviceId'];
@$buildId=$_POST['new-buildId'];
@$roomId=$_POST['new-roomId'];
@$bedId=$_POST['new-bedId'];


//===================================
mysql_query("INSERT INTO user (id, userName, sex, age, joinDate, deviceId, bedId, roomId, buildId) VALUES (null, '$name', '$sex', '$age', '$date', '$deviceId', '$bedId', '$roomId', '$buildId')");
//===================================
	echo "<script>";
	echo "alert(\"新增人员成功！\");";
	echo "window.location.href=\"../people-manage.php\";";
	echo "</script>";
	?>
</body>
</html>


