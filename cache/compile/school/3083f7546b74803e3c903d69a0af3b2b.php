<?php $sum =& $this->getVariable('sum');  ?>
<?php include $this->compile('common/header'); ?>
	<div class="building">
		
		学员消费总额：<?php echo $sum;?>元
		<br/>
		<!--学员消费总额的40%是收益总额-->
		收益总额：<?php echo $sum*0.4;?>元
		
	</div>
<?php include $this->compile('common/footer'); ?>