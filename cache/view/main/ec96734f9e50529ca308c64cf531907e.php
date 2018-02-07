<?php exit;?><!doctype html>
<!--[if !IE]><!--><html class="w3c cur" ><!--<![endif]-->
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

<link resource="css" rel="stylesheet" href="/cache/resource/main/css/main.css" /> 
<link rel="shortcut icon" href="/favicon.ico">
</head>

<!--/*
*/-->
<body loading="500" mod="home" page="help" app="main" content="drum">
<div class="fxd full" id="loading"></div>
<div class="fxd full" id="background">
  <div class="bg fxd full" style="background-image:url(/main/../public/images/main/bg-drum.jpg)"></div>
</div>
<a class="btn fullscreen min500"><i class="icon icon-screen" size="36"></i></a>
<div class="fxd t r" id="member-menu"></div>
<!--/* Interface Start */-->
<div class="fxd full" id="interface">
    <!--/* Header Start */-->
    <header class="fxd fx t bgc-dark justify">
    	<nav class="nav flt-r usermenu"></nav>
    	<nav class="nav comm">
        			            <a class="btn min600  pjax" href="/main/home/index"><span>首页</span></a>
			        						<a class="btn min600" target="_blank" onclick="$('a.btn.min600.open').removeClass('open');$(this).addClass('open')" href="/main/../member/home/summary"><span>公司简介</span></a>
			        			            <a class="btn min600  pjax" href="/main/home/download"><span>下载</span></a>
			        			            <a class="btn min600 open pjax" href="/main/home/help"><span>帮助</span></a>
			        			            <a class="btn min600  pjax" href="/main/home/advice"><span>意见反馈</span></a>
			                </nav>
    </header>
    <!--/* Header End */-->
    
	<!--/* Navigation Start */-->
	<nav id="nav"></nav>
    <!--/* Navigation End */-->
    
    <!--/* Container Start */-->
    <main id="container">
<style>
	.helpPage{background: #fff;border-radius: 10px;margin: 100px auto 0;width: 70%;}
	.helpPage>div{padding: 30px;color:#6B6B6B;line-height: 30px;}
	.quest_help{padding: 5px 0;border-top: 1px solid #e8f2f2;}
	.quest_help:nth-of-type(2){border-top: none;}
	.question{color: #00A09D;}
	.title_help{border-bottom: 1px solid #e8f2f2;}
	.title_help span{display:inline-block;padding: 10px 0;margin-right: 30px;border-bottom: 2px solid transparent;}
	.title_help span:hover,.title_help span.open{color: #00A09D;border-color: #00A09D;background: none;}
	.btn_cont{display: none;}
	.btn_cont.open{display: block;}
	.quest_type{font-size: 0;overflow: hidden;background: #f8f8f8;}
	.quest_type>a{color: #999;font-size:18px;display: inline-block;line-height: 50px;width: 20%;float: left;text-align: center;}
	.quest_type>a.open{color: #00A09D;background: #e9f4f4;}
	.quest_type>a:hover{color: #00A09D;}
	/*使用流程*/
	.use-book{padding: 20px 0;color: #00A09D;}
	.use-book>p{margin-left: 15px;}
	.use-book>p:before{content:'';width: 8px;height: 8px;background: #00A09D;position: absolute;margin: 10px 0 10px -15px;transform: rotate(45deg);}
</style>
	<div class="helpPage">
		<div>
			<div class="title_help">
				<span class="btn" state='0'>使用流程</span>
				<span class="btn open" state='1'>常见问题</span>
			</div>
			<!--使用流程-->
			<div class="btn_cont">
				<div class="use-book">
					<p>学生使用流程</p>
				</div>
				<div class="use-book">
					<p>机构使用流程</p>
				</div>
			</div>
			
			<!--常见问题-->
			<div class="btn_cont open">
				<!--问题分类-->
				<div class="quest_type">
					<a class="btn open" data-type='0'>教学</a>
					<a class="btn" data-type='1'>游戏</a>
					<a class="btn" data-type='2'>练习</a>
					<a class="btn" data-type='3'>技术</a>
					<a class="btn" data-type='4'>产品</a>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>你咋了</p>
					<p><m>A:</m>不咋啊</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>你好</p>
					<p><m>A:</m>我不好</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>你咋了</p>
					<p><m>A:</m>你管啊</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>你好</p>
					<p><m>A:</m>我不好</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>你想咋</p>
					<p><m>A:</m>关你啥事</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>12</p>
					<p><m>A:</m>121212</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>121</p>
					<p><m>A:</m>12</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>111</p>
					<p><m>A:</m>111</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>111</p>
					<p><m>A:</m>1111</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>11</p>
					<p><m>A:</m>111</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>333</p>
					<p><m>A:</m>333333333333333</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>3</p>
					<p><m>A:</m>3</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>8</p>
					<p><m>A:</m>8</p>
				</div>
								<div class="quest_help">
					<p class="question"><m>Q:</m>1</p>
					<p><m>A:</m>1</p>
				</div>
							</div>
		</div>
	</div>
	</main>
    <!--/* Container End */-->
    <footer>

    </footer>
<!--/* Interface End */-->
</div>
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
	workerMod:'common',//锁定worker模块
	useWorker:true,//是否使用worker
	lang:{"vs_name":"VSong","vs_title":"维颂科技","vs_url":"http:\/\/vsong.tv\/?mod=vsong","vs_version":"2.0","drum":"架子鼓","guitar":"吉他","piano":"钢琴\/键盘","saxphone":"萨克斯","violin":"提琴"},
	subjects:["drum","guitar","piano","saxphone","violin"],
	enabled:["drum"]};
</script>
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'main';root.mod = 'home';root.page = 'help';root.packURL = '/main/pack/help/main-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10000","gender":"0","group":"0","username":"user_113554","type":"1"};root.ecode = 'ff0d85614a61306eb4d52653a0f507a3';root.execute(root.packURL,root.mainProgress || null, root.mainComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
