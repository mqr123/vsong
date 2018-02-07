<?php exit;?><!doctype html>
<!--[if !IE]><!--><html class="w3c" _manifest="/school/home/cache/index"><!--<![endif]-->
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

<link resource="css" rel="stylesheet" href="/cache/resource/school/css/school.css" /> 
<link rel="shortcut icon" href="/favicon.ico">
</head>
<!---->
<body loading="500" mod="home" page="index" app="school">
<div class="fxd full" id="loading"></div>
<header>
	<div class="warp justify">
		<nav>
			<a class="logo flt-l" href="/school/.." ></a>
		
						<a class="btn" href="/school/../subsite/home/index/10000">首页</a>
						<a class="btn pjax open" href="/school//home/index/10000">管理中心</a>
						<a class="btn" href="/school/../member/manage/index/home/index/10000">个人中心</a>
					</nav>
		<nav>
			<a class="btn changePsw">修改密码</a>
			<a class="btn ts logout">退出</a>
		</nav>
	</div>
</header>
<main>
	<div class="warp">
	<aside>
		<div class="information-box">
			<a href="/school/home/message/unread" class="btn pjax message">
				<span class="icon_s icon-infor icon_infor"></span>
				<i class="icon_s icon-readSmall" type="0"></i>
			</a>
		</div>
		<div class="userinfo">
			<!---->
			<!--<p>琴行琴行</p>-->
			<!---->
			<a class="avatar" href="/school/home/index">
				<img width="100%" src="/school/../avatar/big/10000">
				<span class="gender">
					<i class="icon_s icon-gender" gender="0"></i>
				</span>
			</a>
			<p>UID: 10000</p>
			
		</div>
				
				<a class="btn pjax" href="/school/home/wallet"><i class="icons icon-wallet"></i><span class="h_span"> 我的钱包</span></a>
				
		
		<!--<a class="btn pjax" href="/school/home/wallet"><i class="icons icon-wallet"></i><span class="h_span">我的钱包</span></a>-->
				
				<a class="btn pjax" href="/school/home/index"><i class="icons icon-index"></i><span class="h_span"> 机构信息</span></a>
				
		
		<!--<a class="btn pjax" href="/school/home/index"><i class="icons icon-index"></i><span class="h_span">机构信息</span></a>-->
				
				<a class="btn pjax" href="/school/home/student"><i class="icons icon-student"></i><span class="h_span"> 我的学员</span></a>
				
		
		<!--<a class="btn pjax" href="/school/home/student"><i class="icons icon-student"></i><span class="h_span">我的学员</span></a>-->
				
				<a class="btn pjax" href=" /school/home/release/news"><i class="icons icon-release"></i><span class="h_span"> 发布中心</span></a>
				
		
		<!--<a class="btn pjax" href="/school/home/release"><i class="icons icon-release"></i><span class="h_span">发布中心</span></a>-->
			</aside>	
	<div id="container">
<!---->
	<form action="/school/home/index/post" id="school-btn">
		<div class="school-box">
			<!--<div style="font-size:14px;padding:10px;margin:10px 0;line-height:30px;color:#555; max-width:900px;background:#f5f5f5; border:1px solid #ddd; font-family:'Microsoft Yahei'"><div><span style="color:#aaa;float:right">等级：<a style="color:#d30">1</a> 级</span><b style="color:#333;font-size:16px;font-weight:400">通知</b>：</div><div style="padding:5px 10px; background:#fff;margin:5px;border:1px solid #eee;">Undefined index: aid</div><div style="padding:0 10px;"><span style="float:right">第 <a style="color:#d30">6</a> 行</span>路径：<font color="gray"><span style="color:#c30">[ROOT]</span>/a5994053d109b8736c3b3c965e3e2d40</font></div></div>			-->
			<label>
				<div class="label">
					<div class="item"><span>机构名称</span><span>*</span></div>
					<div class="school-ipt">
						<input type="text" name="name" value="琴行琴行"/>
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>法人姓名</span><span>*</span></div>
					<div class="school-ipt">
						<input type="text" name="ceo" value="也活泼"/>
					</div>
				</div>
			</label>
			<label>
				<div class="label">
					<div class="item"><span>联系电话</span><span>*</span></div>
					<div class="school-ipt">
						<input type="text" name="tel" value="15029297927">
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>学生数量</span><span>*</span></div>
					<div class="school-ipt">
						<input type="text" name="volume" disabled value="10"/>
					</div>
				</div>
			</label>
			
			<label>
				<div class="label">
					<div class="item"><span>申请时间</span><span>*</span></div>
					<div class="school-ipt">
						<input disabled value="2017-09-30"/>
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>到期时间</span><span>*</span></div>
					<div class="school-ipt">
						<input disabled value="2018-09-30"/>
					</div>
				</div>
			</label>
			<label>
				<div class="label">
					<div class="item"><span>审核时间</span><span>*</span></div>
					<div class="school-ipt">
						<input disabled value="2017-09-30"/>
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>审核状态</span><span>*</span></div>
					<div class="school-ipt">
						<!--  -->
						<input type="text" disabled  value="审核通过"/>
						<!--  -->
					</div>
				</div>
			</label>
			<label>
				<div class="label l">
					<div class="item"><span>所在地址</span><span>*</span></div>
					<div class="district">
						<span class="vs-district"  value="1,37,567" style="margin:20px auto"></span>
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>街道</span><span>*</span></div>
					<div class="ipt school-ipt">
						<input type="text" name="address" value="001号" />
					</div>
				</div>
				<!--<div class="laber r">
					
				</div>-->
			</label>
			<div class="summery-box">
				<div class="item" style="padding-bottom: 1%;"><span>机构简介</span><span>*</span></div>
				
				<textarea form="school-btn" maxlength="300" name="summery" class="text-box">没错，她具备AMD的影子，又并非受限于commonjs的那些条条框框，Layui认为这种轻量的组织方式，比WebPack更符合绝大多数场景。所以她坚持采用经典模块化，也正是能让人避开工具的复杂配置，回</textarea>
				<span class="words"></span>
			</div>
			<div class="up_load">
				<div class="item"><span class="item_span">营业执照 </span><span>*</span></div>
				<label class="btn ilb upload" style="background: url(/data/license/0/1.png);background-size: 100% 100%;">
					<input type="file" id="license" name="license" class="hide">
				</label>
				<!--<img src="/data/license/0/1.png" style="width: 100px;height: auto;">-->
			</div>
			<div class="schBtn">
				<div class="school_btn">保存</div>
			</div>
		</div>
	</form>
	<!---->
		</div>
	</div>
</main>

<footer>
	<div class="warp">
		
	</div>
</footer>
<script>
var VSong = {
	//程序版本号
	version: 1,
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
	lang:{"vs_name":"VSong","vs_title":"维颂科技","vs_url":"http:\/\/vsong.tv\/?mod=vsong","vs_version":"2.0"}};
</script>
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'school';root.mod = 'home';root.page = 'index';root.packURL = '/school/pack/index/main-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10000","gender":"0","group":"0","username":"user_113554","type":"1"};root.ecode = '3be4e0d68f68990d30e85ed98f6fd47e';root.execute(root.packURL,root.schoolProgress || null, root.schoolComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
