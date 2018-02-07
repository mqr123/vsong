<?php $arr =& $this->getVariable('arr'); $tab =& $this->getVariable('tab'); $_G =& $this->getVariable('_G');  ?>
<?php include $this->compile('common/header'); ?>
<?php
$arr = array('全部','教材','练习','曲目','模型','道具','场景');
$tab = !empty($_G['param'][0]) && is_numeric($_G['param'][0])?$_G['param'][0]:0;
?>
	<div class="backpack">
		<div class="record_nav">
			<?php for ($i=0;$i<count($arr);$i+=1) { ?>
				<a class="btn pjax<?php if ($tab == $i){ ?> open<?php } ?>" href="<?php echo $this->url(('manage/depot/'.$i));?>"><?php echo $arr[$i];?></a>
			<?php } ?>
		</div>
		<div class="tab-all">
			<?php $this->displays('manage/depot_'.$tab); ?>
		</div>
	</div>
	<?php include $this->compile('common/footer'); ?>