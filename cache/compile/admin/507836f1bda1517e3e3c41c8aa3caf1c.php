<?php include $this->compile('common/common'); ?>
<div class="wrap">
	<div class="login">
		<form action="<?php echo $this->url(('home/login/post'));?>" id="login-form">
		<input type="text" name="account" placeholder="请输入用户名">
		<input type="password" name="password" placeholder="请输入密码">
		<button class="login_btn submit" type="button">登陆</button>
		<input type="reset" class="cancel_btn" value="重置" />
		</form>
		<p>Copyright&copy;2017 VSong.TV 浙ICP17002031号</p>
	</div>
</div>
<?php echo $this->resource('css','add',3,'
	<file src="admin/login" />
');?>
<?php echo $this->resource('js','add',3,'
	  <file src="admin/add" />
');?>