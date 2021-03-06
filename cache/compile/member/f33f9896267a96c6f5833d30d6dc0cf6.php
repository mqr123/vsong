<?php include $this->compile('common/header'); ?>
<form class="payContent" action="<?php echo $this->url(('home/recharge/post'));?>">
	<p class="pay_text">
		<a class="isChoose" method='0'>给自己充值</a>
		<a method='1'>给他人充值</a>
		<i></i>
	</p>
	<div class="id_box"><input type='number' name='uid' placeholder='请填写对方账号(UID)或手机号码' /></div>
	<div class="payBox">
		<p class="money">
			<span><input class="vs-font payInput" type="number" max='50000' min='100' step="100" value="100" /></span>
			<span>元</span>
		</p>
		<div class="progress">
			<span id='spanB'><input class="rangeInput" type="range" max='50000' min='100' step="100" value="100" /></span>
			<span class="l_pay">100</span>
			<span class="r_pay">50000</span>
		</div>
		<p>微信单笔最高5000元 支付宝单笔最高50000元</p>
		<div class="payMethod">
			<label class="radio_box rad r" state='1'>
				<input type="radio" class="rdo" name="way" checked>
				<p>支付宝支付</p>
			</label>
			<label class="radio_box" state='0'>
				<input type="radio" class="rdo" name="way">
				<p>微信支付</p>
			</label>
		</div>
	</div>
	<div><span id="paySubmit" class="mbtn">提交</span></div>
</form>
<?php include $this->compile('common/footer'); ?>