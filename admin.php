<?php
//该常量作为控制器目录名称
define('APP','admin');
session_start();
require('source/include/common.inc.php');
$page = !isset($_SESSION['username'])?'login':null;

$Core->init(null,$page);

if($page === 'login' && !($_G['mod'] === 'home' && $_G['page'] === 'login')){
	// echo "<script>window.location.href='/admin/home/login'</script>";
	header('location:/admin/home/login');
}