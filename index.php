<?php
//获取USER AGENT
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
$is_pc = (strpos($agent, 'windows nt')) ? true : false;  
if($is_pc){
	include 'main.php';
}else{
	include 'mobile.php';
}
