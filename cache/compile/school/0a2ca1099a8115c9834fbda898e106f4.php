<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key'); $uid =& $this->getVariable('uid');  ?>
<?php include $this->compile('common/header'); ?>
	<div class="details">
		<?php include $this->compile('common/stuInfoHeader'); ?>
		<form action="<?php echo $this->url(('home/recharge/del'));?>" id='rechargeForm'>
			<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>" />
			<div class="recharge-wrap">
				<table border="1" cellspacing="1" cellpadding="1">
					<tr>
						<th>充值方式</th>
						<th>充值金额</th>
						<th>充值时间</th>
						<th>操作</th>
					</tr>
					<!--<?php foreach ((array)$data['list'] as $key) { ?>-->
					<tr data-id ="<?php echo $key['id'];?>">
						<!--<?php if ($key['way']==0){ ?>-->
							<td>微信</td>
							<!--<?php }else if ($key['way']==1){ ?>-->
							<td>支付宝</td>
							<!--<?php } ?>-->
							<td><?php echo $key['amount'];?></td>
							<td><?php echo date('Y-m-d',$key['time']);?></td>
						<td><a class="btn rechargeBtn">删除</a></td>
					</tr>
					<!--<?php } ?>-->
				</table>
				<div class="ma-pager">
					<a href="<?php echo $this->url(('home/recharge/'.$uid));?>" class="btn pjax">首页</a>
					<a class="btn prev-page">上一页</a>
					<!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
					<?php if ($data['page'] == $i){ ?>
					<a class="btn open">第<?php echo $i;?>页</a>
					<?php }else{ ?>
					<a class="btn pjax" href="<?php echo $this->url(('home/recharge/'.$uid.'-'.$i));?>">第<?php echo $i;?>页</a>
					<?php } ?>
					<!--<?php } ?>-->	
					<a class="btn pjax next-page">下一页</a>
					<a id="next-num" href="<?php echo $this->url(('home/recharge/'.$uid.'-'.$data['total']));?>" class="btn pjax">尾页</a>
				</div>
			</div>
		</form>
	</div>
<?php include $this->compile('common/footer'); ?>