<?php $nav2 =& $this->getVariable('nav2'); $uid =& $this->getVariable('uid'); $gender =& $this->getVariable('gender'); $key =& $this->getVariable('key'); $value =& $this->getVariable('value');  ?>
<!--<?php 
$nav2 = array(
	'stuInfo'  => '个人资料',
	'log'	   => '学习记录',
	'can'	   => '仓库管理',
	'buy'	   => '购买记录',
	'recharge' => '充值记录',
	//'level' => '等级',
	//'total'	   => '统计信息'
); 
?>-->
<nav>
	<div class="det-headImage">
		<div class="det-img">
			<img src="<?php echo $this->url(('../avatar/big/'.$uid.'/'.$gender));?>"/>
		</div>
		<span class="stu-sex">
			<i class="icon_s icon-gender" gender="<?php echo $gender;?>"></i>
		</span>
	</div>
	<?php foreach ((array)$nav2 as $key => $value) { ?>
	<a class="btn pjax s" href="<?php echo $this->url(('home/'.$key.'/'.$uid));?>"><?php echo $value;?></a>
	<?php } ?>
    <a href="<?php echo $this->url(('home/student'));?>" class="btn pjax" style="float: right;">返回</a>
</nav>
