<?php $_G =& $this->getVariable('_G');  ?>
<!-- 左侧导航 -->
	<div class="layui-side layui-bg-black">
		<div class="user-photo">
			<a class="img" title="我的头像" ><img src="<?php echo $_G['dir'];?>favicon.ico"></a>
			<p>你好！<span class="userName"><?php echo $_SESSION['username'];?></span>， 欢迎登录</p>
		</div>
		<div class="navBar layui-side-scroll"></div>
	</div>