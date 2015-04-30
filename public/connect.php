<!--php连接数据库，公用代码 -->
<?php
$con=mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
	  echo "<script>";
// echo "<script>";
echo "</script>";}
mysql_select_db("zhimian", $con);
mysql_query("set names 'utf8'");

?>
