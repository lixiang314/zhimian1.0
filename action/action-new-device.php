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
	
@$deviceId=$_POST['new-deviceId'];

@$buildId=$_POST['new-buildId'];
@$roomId=$_POST['new-roomId'];
@$bedId=$_POST[ 'new-bedId'];

@$deviceInfo=$_POST[ 'new-deviceInfo'];


//===================================
mysql_query("INSERT INTO device (id, deviceId, settingDate, deviceInfo, buildId, roomId, bedId, userId) VALUES (null, '$deviceId', now(), '$deviceInfo', '$buildId', '$roomId', '$bedId', null)");

//===================================
	echo "<script>";
	echo "alert(\"新增设备成功！\");";
	echo "window.location.href=\"../device-manage.php\";";
	echo "</script>";
	?>
</body>
</html>


