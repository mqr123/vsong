<?php $_G =& $this->getVariable('_G');  ?>
<?php include $this->compile('common/header'); ?>
<div class="login-mobile">
	<div class="top_nav"></div>
	<div class="login-logo"><a href="<?php echo $this->url(('../mobile'));?>"><img src="<?php echo $_G['dir'];?>public/images/mobile/logo.png"/></a></div>
	<div class="formBox">
		<div class="tab_btn">
			<span class="login_btn open">登陆</span>
			<span class='regist_btn'>注册</span>
			<span class='forget_btn'>找回密码</span>
		</div>
		
		<!--登陆-->
		<form class="mobile_login open" action="<?php echo $this->url(('common/login/login-'.$_G['ecode']));?>" method="post">
			<label>
				<input type="text" name="account" placeholder="请输入昵称或账号"/>
			</label>
			<label class="pwdBox">
				<input type="text"  id="look-password" class="seePwd" name="password" placeholder="请输入密码" />
				<input type="password" class="hidePsw" placeholder="请输入密码" oninput="$('#look-password').val(this.value)"/>
				<a class="btn tls openyoureye"><i class="icon eye" size="22"></i></a>
			</label>
			<div class="info">
				<span class="wranMsg"></span>
				<a class="flt-r forgetPage">找回密码</a>
			</div>	
			<div class="Login">确认登陆</div>
		</form>
		
		
		<!--注册-->
		<form class="mobile_regist" action="<?php echo $this->url(('common/login/register-'.$_G['ecode']));?>" method="post">
			<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>" />
			<label>
				<input type="text" class="username" name="username" placeholder="请输入昵称"/>
			</label>
			<label class="phoneNum">
				<i>+86</i>
				<input type="tel" class="phone" name="phone" placeholder="请输入手机号码"/>
				<a class="sendNum" onClick="$(this).sms('<?php echo $this->formhash();?>,<?php echo $_G['ecode'];?>,<?php echo $_G['ip'];?>',$('input[name=phone]',this.parentNode).DOM[0],'<?php echo $this->url(('../main/common/sms/'.$_G['ecode']));?>')">发送验证码</a>
			</label>
			<label>
				<input type="tel" name="smscode" placeholder="请输入验证码" />
			</label>
			<label class="pwdBox">
				<input type="text"  id="look-password" class="seePwd" name="password" placeholder="请输入密码" />
				<input type="password" class="hidePsw" placeholder="请输入密码" oninput="$('#look-password').val(this.value)"/>
				<a class="btn tls openyoureye"><i class="icon eye" size="22"></i></a>
			</label>
			<div class="label mobile-gender">
		        <span>请选择性别</span>
		        <label class="btn"><input name="gender" type="radio" value="1">男</label>
		        <label class="btn"><input name="gender" type="radio" value="2" checked>女</label>
		        <label class="btn"><input name="gender" type="radio" value="0">保密</label>
            </div>
			<div class="info">
				<span class="wranMsg"></span>
			</div>
			<div class="Regist">立即注册</div>
		</form>
		
		<!--找回密码-->
		<form class="mobile_forget" action="<?php echo $this->url(('common/login/forget-'.$_G['ecode']));?>" method="post">
			<label class="phoneNum">
				<i>+86</i>
				<input type="tel" name="phone" placeholder="请输入手机号码"/>
				<a class="sendNum" onClick="$(this).sms('<?php echo $this->formhash();?>,<?php echo $_G['ecode'];?>,<?php echo $_G['ip'];?>',$('input[name=phone]',this.parentNode).DOM[0],'<?php echo $this->url(('../main/common/sms/'.$_G['ecode']));?>')">发送验证码</a>
			</label>
			<label>
				<input type="tel" name="smscode" placeholder="请输入验证码" />
			</label>
			<label class="pwdBox">
				<input type="text"  id="look-password1" class="seePwd1" name="password" placeholder="请输入密码" />
				<input type="password" class="hidePsw1" placeholder="请输入密码" oninput="$('#look-password1').val(this.value)"/>
				<a class="btn tls mobile-eye1"><i class="icon eye" size="22"></i></a>
			</label>
			<label class="pwdBox">
				<input type="text"  id="look-password2" class="seePwd2" name="pwd" placeholder="再次输入密码" />
				<input type="password" class="hidePsw2" placeholder="再次输入密码" oninput="$('#look-password2').val(this.value)"/>
				<a class="btn tls mobile-eye2"><i class="icon eye" size="22"></i></a>
			</label>
			<div class="info">
				<span class="wranMsg"></span>
				<a class="flt-r backLogin">返回登录</a>
			</div>
			<div class="Forget">提交</div>
		</form>
	</div>
	<div class="go">
		<p class="or">or</p>
		<p><a href="<?php echo $this->url(('home/index'));?>"><span>逛一逛</span></a></p>
	</div>
	
</div>

<?php include $this->compile('common/footer'); ?>
