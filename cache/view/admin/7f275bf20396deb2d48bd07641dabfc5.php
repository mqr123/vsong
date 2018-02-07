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
</head><body class="childrenBody">
	<blockquote class="layui-elem-quote news_search">
		<div class="layui-inline">
		    <div class="layui-input-inline">
		    	<input type="text" value="" disabled placeholder="暂时未开放" class="layui-input search_input">
		    </div>
		    <a class="layui-btn search_btn">查询</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-normal usersAdd_btn">发布中心</a>
		</div>																		
		<!--<div class="layui-inline">
			<a class="layui-btn layui-btn-danger batchDel">批量删除</a>
		</div>-->
		
	</blockquote>
	<div class="layui-form news_list">
	  	<table class="layui-table">
		    <thead>
				<tr>
					<th>id</th>
					<th>发布者uid</th>
					<th>标题</th>
					<th>简介</th>
					<th>发布时间</th>
					<th>转发次数</th>
					<th>点赞次数</th>
					<th>收藏次数</th>
					<th>浏览次数</th>
					<th>类型</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="users_content">
		   <!---->
		    	<tr>
		    		<td>2</td>
		    		<!---->
					<td>admin</td>
					<!---->
					<td>斯蒂芬</td>
					<td>烦死哒</td>			
					<td>2017-09-30 15:31:27</td>
					<td>0</td>
					<td>0</td>	
					<td>0</td>
					<td>0</td>
					<!---->
					<td>招生</td>
					<!---->
					<td>
						<a href="/admin/news/update/2" class="layui-btn layui-btn-mini">详情</a>
						<a href="/admin/news/delete/2"class="layui-btn layui-btn-normal layui-btn-mini" onclick="Javascript:if(confirm('确定要删除吗？')){return true;}return false;">删除</a>
					</td>
				</tr> 
			  <!---->
		    	<tr>
		    		<td>3</td>
		    		<!---->
					<td>admin</td>
					<!---->
					<td>反倒是</td>
					<td>发的萨芬</td>			
					<td>2017-09-30 15:31:41</td>
					<td>0</td>
					<td>0</td>	
					<td>0</td>
					<td>0</td>
					<!---->
					<td>招商</td>
					<!---->
					<td>
						<a href="/admin/news/update/3" class="layui-btn layui-btn-mini">详情</a>
						<a href="/admin/news/delete/3"class="layui-btn layui-btn-normal layui-btn-mini" onclick="Javascript:if(confirm('确定要删除吗？')){return true;}return false;">删除</a>
					</td>
				</tr> 
			  <!---->
		    	<tr>
		    		<td>4</td>
		    		<!---->
					<td>10000</td>
					<!---->
					<td>新闻动态</td>
					<td>曲江369</td>			
					<td>2017-10-09 17:46:01</td>
					<td>0</td>
					<td>0</td>	
					<td>0</td>
					<td>0</td>
					<!---->
					<td>新闻</td>
					<!---->
					<td>
						<a href="/admin/news/update/4" class="layui-btn layui-btn-mini">详情</a>
						<a href="/admin/news/delete/4"class="layui-btn layui-btn-normal layui-btn-mini" onclick="Javascript:if(confirm('确定要删除吗？')){return true;}return false;">删除</a>
					</td>
				</tr> 
			  <!---->
		    	<tr>
		    		<td>5</td>
		    		<!---->
					<td>10000</td>
					<!---->
					<td>兴趣文章</td>
					<td>曲江369基地</td>			
					<td>2017-10-09 17:47:18</td>
					<td>0</td>
					<td>0</td>	
					<td>0</td>
					<td>0</td>
					<!---->
					<td>新闻</td>
					<!---->
					<td>
						<a href="/admin/news/update/5" class="layui-btn layui-btn-mini">详情</a>
						<a href="/admin/news/delete/5"class="layui-btn layui-btn-normal layui-btn-mini" onclick="Javascript:if(confirm('确定要删除吗？')){return true;}return false;">删除</a>
					</td>
				</tr> 
			  <!---->
		    	<tr>
		    		<td>6</td>
		    		<!---->
					<td>10002</td>
					<!---->
					<td>曲江</td>
					<td>曲江新区商业办公</td>			
					<td>2017-10-10 13:46:25</td>
					<td>0</td>
					<td>0</td>	
					<td>0</td>
					<td>0</td>
					<!---->
					<td>新闻</td>
					<!---->
					<td>
						<a href="/admin/news/update/6" class="layui-btn layui-btn-mini">详情</a>
						<a href="/admin/news/delete/6"class="layui-btn layui-btn-normal layui-btn-mini" onclick="Javascript:if(confirm('确定要删除吗？')){return true;}return false;">删除</a>
					</td>
				</tr> 
			  <!---->	
		    </tbody>
		</table>
	</div>
<div id="page">
<!---->
       <a class="btn checked">第1页</a>  
  <!---->
   	<a class="btn pjax" href="/admin/news/index/2">第2页</a>  
  <!---->
   	<a class="btn pjax" href="/admin/news/index/3">第3页</a>  
  <!---->
   	<a class="btn pjax" href="/admin/news/index/4">第4页</a>  
  <!---->
	</div>
	<script type="text/javascript" src="/cache/resource/admin/js/show.js"></script>	
</body>
</html>