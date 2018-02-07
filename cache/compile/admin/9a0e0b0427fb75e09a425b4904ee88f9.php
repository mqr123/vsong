 
<body class="main_body">
	<div class="layui-layout layui-layout-admin">
		<!-- 头-->
		<?php include $this->compile('common/header'); ?>
		<!-- 左侧导航 -->
		<?php include $this->compile('common/left'); ?>
		<!-- 右侧内容 -->
		<div class="layui-body layui-form">
			<div class="layui-tab marg0" lay-filter="bodyTab">
				<ul class="layui-tab-title top_tab">
					<li class="layui-this" lay-id=""><i class="iconfont icon-computer"></i> 						<cite>后台首页</cite>
						
					</li>
				</ul>
				<div class="layui-tab-content clildFrame">
					<div class="layui-tab-item layui-show">
						<iframe src="<?php echo $this->url(('home/main'));?>"></iframe>
					</div>
				</div>
			</div>
		</div>
		<!-- 底部 -->
		<?php include $this->compile('common/footer'); ?>
</body>
