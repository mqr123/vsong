<?php
if(!defined('APP'))exit;

#定义常量 __ROOT__
define('__ROOT__',trim(__DIR__,'\source\include'));

#定义时间差
if(!version_compare(PHP_VERSION,'5.1.0','<'))date_default_timezone_set('Asia/Shanghai');

#屏蔽所有错误
error_reporting(E_ALL);

#记录开始运行时间
$runtime = time() + microtime();

#引入公共函数
require('source/function/common.func.php');

#定义错误头
set_error_handler('showError');

#加载核心文件
require('source/class/core.class.php');

#初始化
$Core = new Core();