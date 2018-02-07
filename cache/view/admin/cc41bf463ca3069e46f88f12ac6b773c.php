<?php exit;?> 
<body class="main_body">
	<div class="layui-layout layui-layout-admin">
		<!-- 头-->
		<!DOCTYPE html>
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
	<link resource="css" rel="stylesheet" href="/cache/resource/admin/css/child_header.css" />	<script>
		window.DIR = "/";
	</script>
	
	<style type="text/css">
		.layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
		@media(max-width:1240px){
			.layui-form-item .layui-inline{ width:100%; float:none; }
		}
	</style>
	
	<script type="text/javascript" src="/public/js/layui/layui.js"></script>	
</head><body>
<!-- 顶部 -->
<div class="layui-header header">
	<div class="layui-main">
		
		<a href="/admin/home/index" class="logo">Vsong后台管理</a>
		<!-- 搜索 -->
		<!--<div class="layui-form component">
	        <select name="modules" lay-verify="required" lay-search="">
				<option value="">直接选择或搜索选择</option>
				<option value="1">layer</option>
				<option value="2">form</option>
				
	        </select>
	        <i class="layui-icon">&#xe615;</i>
	   </div>-->
	   <a href="/admin/../../main" class="logo"><h3>进入首页</h3></a>
	    <!-- 顶部右侧菜单 -->
	    <ul class="layui-nav top_menu">
	    	<li class="layui-nav-item showNotice" id="showNotice" pc>
				<a href="javascript:;">
					<i class="iconfont icon-gonggao"></i><cite>系统公告</cite>
				</a>
			</li>
			<li class="layui-nav-item" pc>
				<a href="javascript:;">
					<img src="/favicon.ico" class="layui-circle" width="35" height="35">
					<cite>管理员&nbsp;&nbsp;admin</cite>
				</a>
				<dl class="layui-nav-child">
					<dd><a href="javascript:;" data-url="/admin/Administrator/show">
						<i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"></i>
						<cite>个人资料</cite>
					</a></dd>
					<dd><a href="javascript:;" data-url="/admin/Administrator/changePwd">
						<i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i>
						<cite>修改密码</cite>
					</a></dd>
					<dd><a href="/admin/home/loginout">
						<i class="iconfont icon-loginout"></i>
						<cite>退出</cite>
					</a></dd>
				</dl>
			</li>
		</ul>
	</div>
</div>
<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>		<!-- 左侧导航 -->
		<!-- 左侧导航 -->
	<div class="layui-side layui-bg-black">
		<div class="user-photo">
			<a class="img" title="我的头像" ><img src="/favicon.ico"></a>
			<p>你好！<span class="userName">admin</span>， 欢迎登录</p>
		</div>
		<div class="navBar layui-side-scroll"></div>
	</div>		<!-- 右侧内容 -->
		<div class="layui-body layui-form">
			<div class="layui-tab marg0" lay-filter="bodyTab">
				<ul class="layui-tab-title top_tab">
					<li class="layui-this" lay-id=""><i class="iconfont icon-computer"></i> 						<cite>后台首页</cite>
						
					</li>
				</ul>
				<div class="layui-tab-content clildFrame">
					<div class="layui-tab-item layui-show">
						<iframe src="/admin/home/main"></iframe>
					</div>
				</div>
			</div>
		</div>
		<!-- 底部 -->
		<script type="text/javascript" src="/public/js/layui/layui.js"></script>
<script type="text/javascript" src="/admin/common/navs"></script>
<script type="text/javascript" src="/cache/resource/admin/js/header.js"></script></body>
