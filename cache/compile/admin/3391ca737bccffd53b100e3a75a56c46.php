<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/common'); ?>
<body class="childrenBody">
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
		   <!--<?php foreach ((array)$data['list'] as $key) { ?>-->
		    	<tr>
		    		<td><?php echo $key['id'];?></td>
		    		<!--<?php if (($key['uid'] == 0)){ ?>-->
					<td><?php echo $_SESSION['username'];?></td>
					<!--<?php }else{ ?>-->
					<td><?php echo $key['uid'];?></td>
					<!--<?php } ?>-->
					<td><?php echo $key['title'];?></td>
					<td><?php echo $key['summery'];?></td>			
					<td><?php echo date('Y-m-d H:i:s',$key['datetime']);?></td>
					<td><?php echo $key['forwarding'];?></td>
					<td><?php echo $key['likes'];?></td>	
					<td><?php echo $key['collection'];?></td>
					<td><?php echo $key['browse'];?></td>
					<!--<?php if ($key['type'] == 0){ ?>-->
					<td>新闻</td>
					<!--<?php }else if ($key['type'] == 1){ ?>-->
					<td>招生</td>
					<!--<?php }else if ($key['type'] == 2){ ?>-->
					<td>产品</td>
					<!--<?php }else if ($key['type'] == 3){ ?>-->
					<td>招商</td>
					<!--<?php }else if ($key['type'] == 4){ ?>-->
					<td>公告</td>
					<!--<?php }else if ($key['type'] == 5){ ?>-->
					<td>活动</td>
					<!--<?php } ?>-->
					<td>
						<a href="<?php echo $this->url(('news/update/'.$key['id']));?>" class="layui-btn layui-btn-mini">详情</a>
						<a href="<?php echo $this->url(('news/delete/'.$key['id']));?>"class="layui-btn layui-btn-normal layui-btn-mini" onclick="Javascript:if(confirm('确定要删除吗？')){return true;}return false;">删除</a>
					</td>
				</tr> 
			  <!--<?php } ?>-->	
		    </tbody>
		</table>
	</div>
<div id="page">
<!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
   <?php if ($data['page'] == $i){ ?>
    <a class="btn checked">第<?php echo $i;?>页</a>  
  <?php }else{ ?>
	<a class="btn pjax" href="<?php echo $this->url(('news/index/'.$i));?>">第<?php echo $i;?>页</a>  
  <?php } ?>
<!--<?php } ?>-->
	</div>
	<?php echo $this->resource('js','show',30,'
	  <file src="admin/show" />
	');?>	
</body>
</html>