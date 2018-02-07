<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key'); $uid =& $this->getVariable('uid');  ?>
<?php include $this->compile('common/header'); ?>
	<div class="details">
		<?php include $this->compile('common/stuInfoHeader'); ?>
		<form action="<?php echo $this->url(('home/log/del'));?>" id="logForm">
			<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>" />
			<div class="log-wrap">
				<table border="1" cellspacing="1" cellpadding="1">
					<tr>
						<th>教育模式</th>
						<th>开始时间</th>
						<th>得分</th>
						<th>力度</th>
						<th>速度</th>
						<th>准确度</th>
						<th>音准</th>
						<th>节拍(乐感)</th>
						<th>结束时间</th>
						<th>操作</th>
					</tr>
					<!--<?php foreach ((array)$data['list'] as $key) { ?>-->
					<tr data-id ="<?php echo $key['id'];?>">
						<!--<?php if ($key['mode']==0){ ?>-->
						<td>教学模式</td>
						<!--<?php } ?>-->
						<td><?php echo date('Y-m-d H:i:s',$key['starttime']);?></td>
						<td><?php echo $key['score'];?></td>
						<td><?php echo $key['intensity'];?></td>
						<td><?php echo $key['speed'];?></td>
						<td><?php echo $key['accuracy'];?></td>
						<td><?php echo $key['intonation'];?></td>
						<td><?php echo $key['beat'];?></td>
						<td><?php echo date('Y-m-d H:i:s',$key['overtime']);?></td>
						<td><a class="btn logBtn">删除</a></td>
					</tr>
					<!--<?php } ?>-->
				</table>
					<div class="ma-pager">
					<a href="<?php echo $this->url(('home/log/'.$uid));?>" class="btn pjax">首页</a>
					<a class="btn prev-page">上一页</a>
					<!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
					<?php if ($data['page'] == $i){ ?>
					<a class="btn open">第<?php echo $i;?>页</a>
					<?php }else{ ?>
					<a class="btn pjax" href="<?php echo $this->url(('home/log/'.$uid.'-'.$i));?>">第<?php echo $i;?>页</a>
					<?php } ?>
					<!--<?php } ?>-->
					<a class="btn pjax next-page">下一页</a>
					<a id="next-num" href="<?php echo $this->url(('home/log/'.$uid.'-'.$data['total']));?>" class="btn pjax">尾页</a>
				</div>
				
			</div>
		</form>
	</div>
<?php include $this->compile('common/footer'); ?>