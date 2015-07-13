<?php 
//定义标准常量
$HEART_UPPER=100;
$HEART_LOWER=60;
$HEART_ZERO=0;

$HEART_UPPER_ALERT="心率偏高";
$HEART_LOWER_ALERT="心率偏低";
$HEART_ALERT="无心跳";
$HEART_NORMAL="心率正常";

$BREATH_UPPER=20;
$BREATH_LOWER=16;
$BREATH_ZERO=0;
$BREATH_NORMAL="呼吸正常";

$BREATH_UPPER_ALERT="呼吸偏快";
$BREATH_LOWER_ALERT="呼吸偏慢";
$BREATH_ALERT="无呼吸";

function sqlQuery($sql){
	$query=mysql_query($sql);
	return mysql_fetch_array($query);
	}


 //页面跳转
function jump($url){
	echo("<script>");
	echo("window.location='$url';");
	echo("</script>");
	}
// 提示
function tishi($info){
	echo("<script>");
	echo("alert('$info');");
	echo("</script>");
	}

// 获取当天日期
function todayDate(){
	date_default_timezone_set('Etc/GMT-8');
    return date("Y-m-d");
	}


?>


 