<?php include $this->compile('common/common'); ?>
<style type="text/css">
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
	<form id="conts-form" class="layui-form" style="width:80%;" action="<?php echo $this->url(('news/add/post'));?>" enctype="multipart/form-data" method="post">
		<div class="layui-form-item">
			<label class="layui-form-label">发布者</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input " name="rolename" disabled value="<?php echo $_SESSION['username'];?>" >
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
		<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>">
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn submit" type="button">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<?php echo $this->resource('js','add',2,'
	  <file src="admin/file">
	  <file src="admin/add">
	');?>
</body>
</html>