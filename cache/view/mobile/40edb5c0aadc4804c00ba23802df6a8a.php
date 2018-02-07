<?php exit;?><div class="login-mobile">
	<div class="top_nav"></div>
	<div class="login-logo"><a href="/mobile/../mobile"><img src="/public/images/mobile/logo.png"/></a></div>
	<div class="formBox">
		<div class="tab_btn">
			<span class="login_btn open">登陆</span>
			<span class='regist_btn'>注册</span>
			<span class='forget_btn'>找回密码</span>
		</div>
		
		<!--登陆-->
		<form class="mobile_login open" action="/mobile/common/login/login-9cff8a46ee046305b04f4c5464087c37" method="post">
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
		<form class="mobile_regist" action="/mobile/common/login/register-9cff8a46ee046305b04f4c5464087c37" method="post">
			<input type="hidden" name="formhash" value="54ec738d" />
			<label>
				<input type="text" class="username" name="username" placeholder="请输入昵称"/>
			</label>
			<label class="phoneNum">
				<i>+86</i>
				<input type="tel" class="phone" name="phone" placeholder="请输入手机号码"/>
				<a class="sendNum" onClick="$(this).sms('54ec738d,9cff8a46ee046305b04f4c5464087c37,127.0.0.1',$('input[name=phone]',this.parentNode).DOM[0],'/mobile/../main/common/sms/9cff8a46ee046305b04f4c5464087c37')">发送验证码</a>
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
		<form class="mobile_forget" action="/mobile/common/login/forget-9cff8a46ee046305b04f4c5464087c37" method="post">
			<label class="phoneNum">
				<i>+86</i>
				<input type="tel" name="phone" placeholder="请输入手机号码"/>
				<a class="sendNum" onClick="$(this).sms('54ec738d,9cff8a46ee046305b04f4c5464087c37,127.0.0.1',$('input[name=phone]',this.parentNode).DOM[0],'/mobile/../main/common/sms/9cff8a46ee046305b04f4c5464087c37')">发送验证码</a>
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
		<p><a href="/mobile/home/index"><span>逛一逛</span></a></p>
	</div>
	
</div>


		</div>
	</div>
</main>

<!--<footer>
	<a href="/mobile/home/index"><span><i class="icons icon-first"></i><p>首页</p></span></a>
	<a href="javascript:;">
		<span><div class="modu_join"></div></span>
	</a>
	<a href="javascript:;" class="myInfo"><span><i class="icons icon-my"></i><p>我</p></span></a>
</footer>-->


<script>
var VSong = {
	//引擎版本号
	engineVersion:'2.0',
	// 解包进度
	executeProgress:function(f,p){
		console.log('Loaded:', f, p);
	},
	// 解包完成
	executeComplete:function(){
		console.log('Unpack completed.', this);
	},
	workerMod:'common',//锁定worker模块
	useWorker:false,//是否使用worker
	lang:{"vs_name":"VSong","vs_title":"维颂科技","vs_url":"http:\/\/vsong.tv\/?mod=vsong","vs_version":"2.0"}};
</script>
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'mobile';root.mod = 'common';root.page = 'login';root.packURL = '/mobile/pack/login/mobile-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":0,"gender":0,"group":0,"username":"","type":0};root.ecode = '9cff8a46ee046305b04f4c5464087c37';root.execute(root.packURL,root.mobileProgress || null, root.mobileComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
