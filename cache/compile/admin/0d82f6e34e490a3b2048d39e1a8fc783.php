<?php $_G =& $this->getVariable('_G');  ?>
<?php include $this->compile('common/common'); ?>
<body>
<!-- 顶部 -->
<div class="layui-header header">
	<div class="layui-main">
		
		<a href="<?php echo $this->url(('home/index'));?>" class="logo">Vsong后台管理</a>
		<!-- 搜索 -->
		<!--<div class="layui-form component">
	        <select name="modules" lay-verify="required" lay-search="">
				<option value="">直接选择或搜索选择</option>
				<option value="1">layer</option>
				<option value="2">form</option>
				
	        </select>
	        <i class="layui-icon">&#xe615;</i>
	   </div>-->
	   <a href="<?php echo $this->url(('../../main'));?>" class="logo"><h3>进入首页</h3></a>
	    <!-- 顶部右侧菜单 -->
	    <ul class="layui-nav top_menu">
	    	<li class="layui-nav-item showNotice" id="showNotice" pc>
				<a href="javascript:;">
					<i class="iconfont icon-gonggao"></i><cite>系统公告</cite>
				</a>
			</li>
			<li class="layui-nav-item" pc>
				<a href="javascript:;">
					<img src="<?php echo $_G['dir'];?>favicon.ico" class="layui-circle" width="35" height="35">
					<cite>管理员&nbsp;&nbsp;<?php echo $_SESSION['username'];?></cite>
				</a>
				<dl class="layui-nav-child">
					<dd><a href="javascript:;" data-url="<?php echo $this->url(('Administrator/show'));?>">
						<i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"></i>
						<cite>个人资料</cite>
					</a></dd>
					<dd><a href="javascript:;" data-url="<?php echo $this->url(('Administrator/changePwd'));?>">
						<i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i>
						<cite>修改密码</cite>
					</a></dd>
					<dd><a href="<?php echo $this->url(('home/loginout'));?>">
						<i class="iconfont icon-loginout"></i>
						<cite>退出</cite>
					</a></dd>
				</dl>
			</li>
		</ul>
	</div>
</div>
<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>