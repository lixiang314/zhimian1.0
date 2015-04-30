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

@$id=$_GET['id'];
@$arrayStr=$_GET['idArray'];
@$array=explode("_",$arrayStr);

$idSqlStr="";
$useridSqlStr="";
for ($i=0; $i < count($array); $i++) { 
	$idSqlStr = $idSqlStr."id=".$array[$i]." or ";
	$useridSqlStr = $useridSqlStr."userId=".$array[$i]." or ";
}
$idSqlStr = substr($idSqlStr, 0,-4);
$useridSqlStr = substr($useridSqlStr, 0,-4);
// echo"$idSqlStr \n $useridSqlStr";

mysql_query("DELETE FROM user WHERE id=$id");
mysql_query("DELETE FROM family WHERE userId=$id");


mysql_query("DELETE FROM user WHERE ".$idSqlStr);
mysql_query("DELETE FROM family WHERE ".$useridSqlStr);

echo "<script> ";
echo "alert(\"删除人员信息成功！\");";
echo "window.location.href=\"../people-manage.php\";";
echo "</script>";


?>

</body>
</html>
