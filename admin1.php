<?php
//该常量作为控制器目录名称
define('APP','admin');
session_start();
//程序版本
//define('__VERSION__', 1.3);
//加载核心程序
require('source/include/common.inc.php');
if(isset($_SERVER['PATH_INFO']) && strstr('/home/login',$_SERVER['PATH_INFO'])){
	header("location:/admin");
	exit;
}
if(!isset($_SESSION['username']) && isset($_SERVER['PATH_INFO']) && !strstr('/home/login/post',$_SERVER['PATH_INFO'])){
	header("location:/admin");
	exit;
}
#+------------------------------------------------------------------+
#
# $Core->setConfig('cookie', array( ... ));	// 配置COOKIE
# $Core->setConfig('mysql', array( ... ));	// 配置MySQL
# $Core->setConfig('url_rewrite', true);	// 开启 URL伪静态
# $Core->setConfig('cache', true);			// 开启页面缓存（全局）
# $Core->setConfig('compel', true);			// 强制编译模板
# 
# 更多参数请查看 'source/config/common.conf.php'
# 
#+------------------------------------------------------------------+

# 初始化, 可带两个参数：$mod, $page
# 对应的模板文件：view/APP/$mod/$page.html
$Core->init('home','login');