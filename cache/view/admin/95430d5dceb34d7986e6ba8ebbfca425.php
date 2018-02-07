<?php exit;?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Vsong后台管理</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">

	<link rel="icon" href="/favicon.ico">
	<link rel="stylesheet" href="/cache/resource/admin/css/child_header.css" />	<script>
		window.DIR = "/";
	</script>
	
	<style type="text/css">
		.layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
		@media(max-width:1240px){
			.layui-form-item .layui-inline{ width:100%; float:none; }
		}
	</style>
	
	<script type="text/javascript" src="/public/js/layui/layui.js"></script>	
</head><div class="wrap">
	<div class="login">
		<form action="/admin/home/login/post" id="login-form">
		<input type="text" name="account" placeholder="请输入用户名">
		<input type="password" name="password" placeholder="请输入密码">
		<button class="login_btn submit" type="button">登陆</button>
		<input type="reset" class="cancel_btn" value="重置" />
		</form>
		<p>Copyright&copy;2017 VSong.TV 浙ICP17002031号</p>
	</div>
</div>
<link resource="css" rel="stylesheet" href="/cache/resource/admin/css/add.css" /><script type="text/javascript" src="/cache/resource/admin/js/add.js"></script>