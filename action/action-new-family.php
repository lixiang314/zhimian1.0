<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>action-new-people</title>
</head>

<body>
<?php


include("../public/connect.php");
include("../public/function.php");

	
@$name=$_POST['family-name']; 
@$relationship=$_POST['family-relationship'];
@$phone=$_POST['family-phone'];
@$userId=$_POST['family-userId'];

//===================================
mysql_query("INSERT INTO family (id, name, relationship, phone, userId) VALUES (null, '$name', '$relationship', '$phone', '$userId')");
//===================================
	echo "<script>";
	// echo "alert(\"新增家属成功！\");";
	echo "window.location.href=\"../state.php?id=$userId\";";
	echo "</script>";
	?>
</body>
</html>


