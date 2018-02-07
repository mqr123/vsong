<?php
//该常量作为控制器目录名称
define('APP','school');

//程序版本
define('__VERSION__', 1.0);
session_start();
//加载核心程序
require('source/include/common.inc.php');

if(!isset($_SESSION['school_user'])){
	$Core->cookie('is_school_session','',-3600);
	header("location:/main");
	exit;
}

$Core->init();