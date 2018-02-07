<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key'); $uid =& $this->getVariable('uid');  ?>
<?php include $this->compile('common/header'); ?>
	<div class="details">
		<?php include $this->compile('common/stuInfoHeader'); ?>
		<form action="<?php echo $this->url(('home/buy/del'));?>" id='buyForm'>
			<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>" />
			<div class="buy-wrap">
				<table border="1" cellspacing="1" cellpadding="1">
					<tr>
						<th>购买类型</th>
						<th>名称</th>
						<th>价格</th>
						<th>购买时间</th>
						<th>操作</th>
					</tr>
					<!--<?php foreach ((array)$data['list'] as $key) { ?>-->
					<tr data-id ="<?php echo $key['id'];?>">
						<td><?php echo $key['type'];?></td>
						<td><?php echo $key['name'];?></td>
						<td><?php echo $key['price'];?></td>
						<td><?php echo date('Y-m-d',$key['dateline']);?></td>
						<td><a class="btn buyBtn">删除</a></td>
					</tr>
					<!--<?php } ?>-->
				</table>
				<div class="ma-pager">
					<a href="<?php echo $this->url(('home/buy/'.$uid));?>" class="btn pjax">首页</a>
					<a class="btn prev-page">上一页</a>
					<!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
					<?php if ($data['page'] == $i){ ?>
					<a class="btn open">第<?php echo $i;?>页</a>
					<?php }else{ ?>
					<a class="btn pjax" href="<?php echo $this->url(('home/buy/'.$uid.'-'.$i));?>">第<?php echo $i;?>页</a>
					<?php } ?>
					<!--<?php } ?>-->
					
					<a class="btn pjax next-page">下一页</a>
					<a id="next-num" href="<?php echo $this->url(('home/buy/'.$uid.'-'.$data['total']));?>" class="btn pjax">尾页</a>
				</div>
			</div>
		</form>
	</div>
<?php include $this->compile('common/footer'); ?>