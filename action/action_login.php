<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php

$username = $_POST["username"];
$password = $_POST["password"];
// 默认登录名为admin，密码为admin
if($username =='admin' && $password=='admin')
{
	session_start();
	$_SESSION['username']=$username;
	echo"<script>";
	echo"window.location = '../health-monitor.php';";
	echo"</script>";
	}
else{
	echo"<script>";
	echo"alert('密码或用户名不正确！');";
	echo"window.history.back(-1)"; 
	echo"</script>";
}


?>
</body>
</html>