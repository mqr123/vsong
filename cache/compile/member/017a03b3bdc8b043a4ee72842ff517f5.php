<?php $_G =& $this->getVariable('_G');  ?>
<!--<?php if (!isset($_G['is_school_session'])){ ?>-->
<?php include $this->compile('common/header'); ?>
	<div class="school">
		<h2 class="logo"></h2>
		<div class="check">
			<span class="schoolImg"></span>
			<form onsubmit="$('#schoolCheck').click();return false"  action="<?php echo $this->url(('home/school/post'));?>" class="checkBox flt-r" method="post">
				<h3 type="tips">
					<i size="72" class="icon smile-warn flt-l"></i>
					<p>为了安全起见，请再次输入您的登陆密码</p>
				</h3>
				<label>
					<span>账号</span>
					<?php echo $_G['user']['username'];?>
				</label>
				<label>
					<span>密码</span>
					<input type="password" name="password" placeholder="请输入密码" />
				</label>
				<div>
					<a id="schoolCheck" class="mbtn">验证</a>
				</div>
			</form>
		</div>
	</div>
<?php include $this->compile('common/footer'); ?>
<!--<?php } ?>-->
