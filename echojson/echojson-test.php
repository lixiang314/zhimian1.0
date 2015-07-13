<?php 
include("../public/connect.php");
include("../public/function.php");

header("Content-type: text/json");
// $a = time() * 1000;
$sql="SELECT max(id),heartbeatstring FROM heartbeat";
//$sql="SELECT heartbeatstring FROM heartbeat where id = select max(id) from heartbeat";
//$sql="SELECT name FROM test where name = 'lixiang' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$datastring = $row['heartbeatstring'];
//$datastring = $result['name'];
// $b = substr($datastring,0,2)
//$b = $result['heartbeatstring'];
$b = (int)subStr($datastring,0,2);
echo "<script>alert('".$b."'); </script>";
	$ret = array($a, $b);
	echo json_encode($ret);


?>
