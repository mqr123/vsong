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
</head><style type="text/css">
	span.addBtn {display: inline-block;width: 60px;height: 60px;background: #ddd;text-align: center;}
	span.addBtn::after,span.addBtn::before {content: '';position: absolute;width: 30px;height: 3px;border-radius: 2px;background: #fff;margin: 30px -15px;}
	span.addBtn::before {transform: rotate(90deg);}
	.files {display: none;}
	ul {display: block;list-style: none;}
	li {width: 90px;margin-right: 5px;display: inline-block;text-align: center;position:relative;}
	img {width: 90px;height: 90px;background: #fff;}
	li>p {font-size: 12px;color: #777;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
	.deleteBtn{display:none;width: 20px;height: 20px;border-radius: 50%;background: #ddd;position: absolute;top: 0;right: 0;transform: rotate(45deg);}
	.deleteBtn::after,.deleteBtn::before {content: '';position: absolute;width: 12px;height: 2px;border-radius: 2px;background: #777;margin: 9px -6px;}
	.deleteBtn::before {transform: rotate(90deg);}
	li:hover .deleteBtn{display: block;}
</style>
<body class="childrenBody">
	<form id="conts-form" class="layui-form" style="width:80%;" action="/admin/news/add/post" enctype="multipart/form-data" method="post">
		<div class="layui-form-item">
			<label class="layui-form-label">发布者</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input " name="rolename" disabled value="admin" >
			</div>
		</div>
		<div class="layui-form-item">
		    <label class="layui-form-label">新闻类型</label>
		    <div class="layui-input-block">
		    	<input type="radio" name="type" value="0" title="文章" checked="checked">
     			<input type="radio" name="type" value="1" title="招生">
     			<input type="radio" name="type" value="2" title="产品">
     			<input type="radio" name="type" value="3" title="招商">
     			<input type="radio" name="type" value="4" title="公告">
     			<input type="radio" name="type" value="5" title="活动">
     		</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">标题</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input " name="title"  placeholder="请输入标题">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">简介</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input " name="summery" placeholder="请输入内容">
			</div>
		</div>
		<div class="layui-form-item"> 
			<label class="layui-form-label">内容</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea" name="content" form="conts-form"></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<p class="layui-form-label">上传图片</p>
			<div class="layui-input-block">
				<label class="layui-form-label" style="width: auto;padding: 0;">
					<input class="files" type="file" name="files" multiple accept="image/jpeg,image/png,image/gif"/>
					<span class="addBtn"></span>
				</label>
			</div>
			<ul class="layui-form-item" style="margin-left: 110px;"></ul>
		</div>
		<input type="hidden" name="formhash" value="54ec738d">
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn submit" type="button">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="/cache/resource/admin/js/add.js"></script></body>
</html>