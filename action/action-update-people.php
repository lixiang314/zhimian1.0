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

@$id=$_POST['id'];
@$name=$_POST['new-name']; 
@$age=$_POST['new-age'];
@$gender=$_POST['new-gender'];
@$date=$_POST['new-date'];
@$deviceId=$_POST['new-deviceId'];
@$buildId=$_POST['new-buildId'];
@$roomId=$_POST['new-roomId'];
@$bedId=$_POST['new-bedId'];

mysql_query("UPDATE user SET userName = '$name', gender='$gender', age='$age', checkInDate='$date', deviceId='$deviceId', buildId='$buildId', roomId='$roomId', bedId='$bedId' where id=$id");

echo "<script> ";
echo "alert(\"修改人员信息成功！\");";
echo "window.location.href=\"../people-manage.php\";";
echo "</script>";
?>

</body>
</html>
