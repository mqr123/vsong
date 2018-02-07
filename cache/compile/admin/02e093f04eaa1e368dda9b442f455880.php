<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key'); $files =& $this->getVariable('files');  ?>
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
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 5px;">
  <legend>
  <label style="font-size: 15px; color: red;">发布详情信息</label>&nbsp;
	<a class="layui-btn layui-btn-normal layui-btn-mini" href="<?php echo $this->url(('news/index'));?>">返回列表</a>
  </legend>
</fieldset>
	<!--<?php foreach ((array)$data['list'] as $key) { ?>-->
	<!--<?php if (($key['uid']==0)){ ?>-->
	<form id="conts-form" class="layui-form" style="width:80%;" action="<?php echo $this->url(('news/update/'.$key['nid'].'-post'));?>" method="post" enctype="multipart/form-data">
		<div class="layui-form-item">
			<label class="layui-form-label">发布者</label>
			<div class="layui-input-block">
			<input type="text" class="layui-input" disabled name="uid" lay-verify="required" value="<?php echo $_SESSION['username'];?>">
			</div>
		</div>
		<div class="layui-form-item">
		  <label class="layui-form-label">新闻类型</label>
		  <div class="layui-input-block">
		    <!-- <?php if ($key['type']==0){ ?> -->
			<input type="text" class="layui-input layui-disabled" disabled value="文章">
			<!-- <?php }else if ($key['type']==1){ ?> -->
			<input type="text" class="layui-input layui-disabled" disabled value="招生">
			<!-- <?php }else if ($key['type']==2){ ?> -->
			<input type="text" class="layui-input layui-disabled" disabled value="产品">
			<!-- <?php }else if ($key['type']==3){ ?> -->
			<input type="text" class="layui-input layui-disabled" disabled value="招商">
			<!-- <?php }else if ($key['type']==4){ ?> -->
			<input type="text" class="layui-input layui-disabled" disabled value="公告">
			<!-- <?php }else if ($key['type']==5){ ?> -->
			<input type="text" class="layui-input layui-disabled" disabled value="活动">
			<!-- <?php } ?> -->
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">标题</label>
			<div class="layui-input-block">
			<input type="text" class="layui-input" name="title" value="<?php echo $key['title'];?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">简介</label>
			<div class="layui-input-block">
			<input type="text" class="layui-input" name="summery" value="<?php echo $key['summery'];?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">内容</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea" name="content" form="conts-form" ><?php echo $key['content'];?></textarea>
				
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">图片/视频</label>
			 <input  type="file" name="files"  multiple="multiple" class="layui-btn layui-btn-primary"/>
			 <ul class="layui-form-item" style="margin-left: 110px;">
			 		<?php if (!empty($key['files'])){ ?>
			 		<?php $files=json_decode($key['files']);; ?>
			 		<?php for ($i=0;$i<count($files);$i++) { ?>
			 			<li><img src="/<?php echo $files[$i];?>" style="width: 60px;height: 50px;"/></li>
			 		<?php } ?>
			 	<?php } ?>
			 
			 </ul>
		</div>
		<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>">
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button  class="layui-btn" lay-submit="">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<!--<?php }else{ ?>-->
		<div class="layui-form-item">
			<label class="layui-form-label">发布者</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" disabled name="uid" lay-verify="required" value="<?php echo $key['uid'];?>">
			</div>
		</div>
		<div class="layui-form-item">
		  <label class="layui-form-label">新闻类型</label>
		  <div class="layui-input-block">
		    <!-- <?php if ($key['type']==0){ ?> -->
			<input type="text" class="layui-input" disabled value="文章">
			<!-- <?php }else if ($key['type']==1){ ?> -->
			<input type="text" class="layui-input" disabled value="招生">
			<!-- <?php }else if ($key['type']==2){ ?> -->
			<input type="text" class="layui-input" disabled value="产品">
			<!-- <?php }else if ($key['type']==3){ ?> -->
			<input type="text" class="layui-input" disabled value="招商">
			<!-- <?php }else if ($key['type']==4){ ?> -->
			<input type="text" class="layui-input" disabled value="公告">
			<!-- <?php }else if ($key['type']==5){ ?> -->
			<input type="text" class="layui-input" disabled value="活动">
			<!-- <?php } ?> -->
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">标题</label>
			<div class="layui-input-block">
			<input type="text" class="layui-input" disabled value="<?php echo $key['title'];?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">简介</label>
			<div class="layui-input-block">
			<input type="text" class="layui-input" disabled value="<?php echo $key['summery'];?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">内容</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea" disabled><?php echo $key['content'];?></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">图片/视频</label>
			<ul class="layui-form-item" style="margin-left: 110px;">
				<?php if (!empty($key['files'])){ ?>
				<li><img src="/<?php echo $key['files'];?>" style="width: 60px;height: 50px;"/></li>
				<?php } ?>
			</ul>
	
		</div>
	<!--<?php } ?>-->
	<!--<?php } ?>-->

	<?php echo $this->resource('js','add',3,'
	  <file src="admin/add">
	');?>
</body>
</html>