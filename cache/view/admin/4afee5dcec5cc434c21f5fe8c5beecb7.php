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
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 5px;">
  <legend>
  <label style="font-size: 15px; color: red;">发布详情信息</label>&nbsp;
	<a class="layui-btn layui-btn-normal layui-btn-mini" href="/admin/news/index">返回列表</a>
  </legend>
</fieldset>
	<!---->
	<!---->
	<form id="conts-form" class="layui-form" style="width:80%;" action="/admin/news/update/20-post" method="post" enctype="multipart/form-data">
		<div class="layui-form-item">
			<label class="layui-form-label">发布者</label>
			<div class="layui-input-block">
			<input type="text" class="layui-input" disabled name="uid" lay-verify="required" value="admin">
			</div>
		</div>
		<div class="layui-form-item">
		  <label class="layui-form-label">新闻类型</label>
		  <div class="layui-input-block">
		    <!--  -->
			<input type="text" class="layui-input layui-disabled" disabled value="文章">
			<!--  -->
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">标题</label>
			<div class="layui-input-block">
			<input type="text" class="layui-input" name="title" value="">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">简介</label>
			<div class="layui-input-block">
			<input type="text" class="layui-input" name="summery" value="">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">内容</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea" name="content" form="conts-form" ></textarea>
				
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">图片/视频</label>
			 <input  type="file" name="files"  multiple="multiple" class="layui-btn layui-btn-primary"/>
			 <ul class="layui-form-item" style="margin-left: 110px;">
			 					 					 					 			<li><img src="/data/news/20171116/170119-0.png" style="width: 60px;height: 50px;"/></li>
			 					 			<li><img src="/data/news/20171116/170119-1.png" style="width: 60px;height: 50px;"/></li>
			 					 			<li><img src="/data/news/20171116/170119-2.png" style="width: 60px;height: 50px;"/></li>
			 					 				 
			 </ul>
		</div>
		<input type="hidden" name="formhash" value="54ec738d">
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button  class="layui-btn" lay-submit="">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<!---->
	<!---->

	<script type="text/javascript" src="/cache/resource/admin/js/add.js"></script></body>
</html>