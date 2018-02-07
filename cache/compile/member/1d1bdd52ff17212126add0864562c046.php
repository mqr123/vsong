<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/header'); ?>
	<div class="backpack">
		<!--<?php if (empty($data['list'])){ ?>-->
		<div class="build">
			<span></span>
			<p>暂无数据~</p>
		</div>
		<!--<?php }else{ ?>-->
		<div class="tab-all">
			<div class="depot_list">
				<form class="form_pay" action="<?php echo $this->url(('manage/pay/del'));?>" method="post">
					<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>" />
					<ul>
						<li class="li_head">
							<span>充值方式</span>
							<span>充值金额</span>
							<span>充值时间</span>
							<span>操作</span>
						</li>
						<!--<?php foreach ((array)$data['list'] as $key) { ?>-->
						<li class="li_cont" data-id="<?php echo $key['id'];?>">
							<!--<?php if ($key['way']==0){ ?>-->
							<span>微信</span>
							<!--<?php }else if ($key['way']==1){ ?>-->
							<span>支付宝</span>
							<!--<?php } ?>-->
							<span><?php echo $key['amount'];?></span>
							<span><?php echo date('Y-m-d',$key['time']);?></span>
							<span class="delete_btn"><a class="btn">删除</a></span>
						</li>
						<!--<?php } ?>-->
					</ul>
				</form>
				<div class="ma-pager">
					<a href="<?php echo $this->url(('manage/pay'));?>" class="btn pjax">首页</a>
					<a class="btn prev-page">上一页</a>
					<!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
					<?php if ($data['page'] == $i){ ?>
					<a class="btn open">第<?php echo $i;?>页</a>
					<?php }else{ ?>
					<a class="btn pjax" href="<?php echo $this->url(('manage/pay/-'.$i));?>">第<?php echo $i;?>页</a>
					<?php } ?>
					<!--<?php } ?>-->
					
					<a class="btn pjax next-page">下一页</a>
					<a id="next-num" href="<?php echo $this->url(('manage/pay/-'.$data['total']));?>" class="btn pjax">尾页</a>
				</div>
			</div>
		</div>
		<!--<?php } ?>-->
	</div>

<?php include $this->compile('common/footer'); ?>

