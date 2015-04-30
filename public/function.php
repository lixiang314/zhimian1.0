<?php 

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


 