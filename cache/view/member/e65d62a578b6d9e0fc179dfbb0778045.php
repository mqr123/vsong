<?php exit;?><!---->
<!doctype html>
<!--[if !IE]><!--><html class="w3c" _manifest="/member/home/cache/index"><!--<![endif]-->
<head>
<meta charset="utf-8">
<title>维颂科技 - VSong 2.0</title>

<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />

<!--针对移动端-->
<meta itemprop="name" content="VSong.view - Demo">
<meta itemprop="description" content="VSong.view - Demo">
<meta itemprop="image" content="">

<meta property="og:url" content="">
<meta property="og:type" content="article">
<meta property="og:title" content="VSong Execute - Demo">

<meta property="og:image" content="">
<meta property="og:description" content="VSong.view - Demo">
<meta property="og:site_name" content="VSong.view - Demo">

<meta name="theme-color" content="#00a09d">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#00a09d">

<link resource="css" rel="stylesheet" href="/cache/resource/member/css/member.css" /> 
<link rel="shortcut icon" href="/favicon.ico">
</head>
<!---->
<body loading="500" mod="manage" page="index" app="member">
	<div class="fxd full" id="loading"></div>
	<header>
	<div class="warp justify">
			<a class="logo flt-l" href="/member/.." ></a>
		
		<!---->
		<nav class='memberNav flt-r'>
			<a class="btn" href="/member/..">首页</a>
			<!---->
			<!--  -->
			<a class="btn pjax manage" href="/member/manage/study">个人中心</a>
			<!--  -->
			<!---->
			<!--  -->
			<a class="btn school" href="/member/../../school/home/index" title="school">管理中心</a>	
			<!--  -->
			<!---->
			<!--  -->
			<a class="btn pjax recharge" href="/member/home/recharge">充值</a>
			<!--  -->
			<!---->
			
			<a class="btn changePsw">修改密码</a>
			<a class="btn ts logout">退出</a>
			
		</nav>
		<!---->
	</div>
	 <div class="slogan">
		<img src="/public/images/member/s_logo.png">
		<p>维颂，赢在音乐的起跑线</p>
	</div>
	</header>
<main>
    <div class="warp">
    	<div>
	    <aside type="userinfo">
			<div>
				 <i class="icon icon-gender" gender="0"></i>	
				 <i size="16" class="icon icon-gender" gender="0"></i>	
				<a class="avatar pjax" href="/member/manage/index">
					
					<img src="/member/../avatar/big/10000"/>
				</a>
			</div> 
			<div>UID: 10000</div>
		
			<aside type="manage">
				<!---->
<!--				<a class="btn pjax study" href="/member/manage/study"><i class="icon manage-study"></i>学习记录</a> -->
				 <a class="btn pjax study" href="/member/manage/study"><i class="icon_m manage-study" size='45'></i>学习记录</a>
				<!---->
<!--				<a class="btn pjax index" href="/member/manage/index"><i class="icon manage-index"></i>常用资料</a> -->
				 <a class="btn pjax index" href="/member/manage/index"><i class="icon_m manage-index" size='45'></i>常用资料</a>
				<!---->
<!--				<a class="btn pjax buy" href="/member/manage/buy"><i class="icon manage-buy"></i>购买记录</a> -->
				 <a class="btn pjax buy" href="/member/manage/buy"><i class="icon_m manage-buy" size='45'></i>购买记录</a>
				<!---->
<!--				<a class="btn pjax pay" href="/member/manage/pay"><i class="icon manage-pay"></i>充值记录</a> -->
				 <a class="btn pjax pay" href="/member/manage/pay"><i class="icon_m manage-pay" size='45'></i>充值记录</a>
				<!---->
<!--				<a class="btn pjax count" href="/member/manage/count"><i class="icon manage-count"></i>统计信息</a> -->
				 <a class="btn pjax count" href="/member/manage/count"><i class="icon_m manage-count" size='45'></i>统计信息</a>
				<!---->
			</aside>
		</aside>
		</div>
		<div class="cont">
			<div id="container">
				
	
	<!--  -->
	<form id="manageBox" action="/member/manage/index/post" method="post">
		<label class="col col_l">
			<span>用户名*</span>
			<input type="text" name="username" placeholder="请输入用户名" value="user_113554" />
			<i></i>
		</label>
		<label class="col">
			<span>手机号*</span>
			<input  type="tel" maxlength="11" name="tellphone"  value="13958113554"/>
			
		</label>
		<label class="col col_l">
			<span>姓名*</span>
			<input type="text" name="realname"  value="笑笑"/>
		</label>
		<label class="col">
			<span>身份证*</span>
			<input type="text" name="idcard"  value="610430198712113426"/>
			
		</label>
		<label class="col col_l">
			<span>微信*</span>
			<input type="text" name="openid" placeholder="请输入微信账号" value=""/>
		</label>
		<label class="col q">
			<span>QQ*</span>
			<input type="number" name="qq" placeholder="请输入常用QQ账号" value="1013670984"/>
		</label>
		
		<label class="col col_l">
			<span>家长姓名*</span>
			<input type="text" name="parents" placeholder="请输入家长姓名" value=""/>
		</label>
		<label class="col">
			<span>家长电话*</span>
			<input type="tel" maxlength="11" name="parents_phone" placeholder="请输入家长电话" value=""/>
		</label>
		
		<label class="col col_l">
			<span>邮箱*</span>
			<input type="text" name="email" placeholder="请输入常用邮箱账号" value="web@gamil.com"/>
			
		</label>
		<label class="col">
			<span>注册ip*</span>
			<input type="text" name="ip"  value="127.0.0.1" disabled/>
			
		</label>
		
		
		<!--  -->
		
		<span style="display:block;">所在地址*</span>
		<!--  -->

		<span class="vs-district address" value="1,567" ></span>
		<!--  -->
		<label class="address_l">
			<input type="text" name="address" placeholder="请输入街道及门牌号" value="001"/>
		</label>
		<label class="personinfo">
			<span>个人简介*</span>
			<textarea form="manageBox" maxlength="100" name="summery" placeholder="请输入个人简介（100字以内）">reyg</textarea>
			<span class="words">0/100字</span>
		</label>
		<div><span id="manageSubmit" class="mbtn"/>保存</span></div>	
	</form>
	<!--  -->
	<div class="show-block">
		<span class="close-show-block"></span>
		<div class="show-info-school" style="text-align: center;">
			<!-- -->
			
			
		</div>
	</div>
		</div></div>
	</div>
</main>
    <footer>
		<div class="warp">
			<ul>
				<li>关于维颂</li>
				<li>服务条款</li>
				<li>广告服务</li>
				<li>维颂招聘</li>
				<li>隐私政策</li>
				<li>用户服务协议</li>
			</ul>
			<p>Copyright &copy; 2017 <a target="_blank" href="https:vsong.tv">VSong.TV</a> 浙ICP备17002031号</p>
			<p>维颂电子科技版权所有 维颂电子科技有限公司文化经营许可</p>
		</div>
    </footer>
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
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'member';root.mod = 'manage';root.page = 'index';root.packURL = '/member/pack/index/member-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10000","gender":"0","group":"0","username":"user_113554","type":"1"};root.ecode = 'f8d71d17d7484ef38ad38a7d3eb3b778';root.execute(root.packURL,root.memberProgress || null, root.memberComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
<!---->