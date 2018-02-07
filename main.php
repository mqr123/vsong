<?php
//该常量作为控制器目录名称
define('APP','main');

//程序版本
define('__VERSION__', 1.0);

//加载核心程序
require('source/include/common.inc.php');
$Core->init();