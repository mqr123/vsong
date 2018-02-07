<?php exit;?><!doctype html>
<!--[if !IE]><!--><html class="w3c cur" _manifest="/index/home/cache/index"><!--<![endif]-->
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
<body loading="500" mod="home" page="index" app="main" content="drum">
<div class="fxd full" id="loading"></div>
<div class="fxd full" id="background">
  <div class="bg fxd full" style="background-image:url(/index/../public/images/main/bg-drum.jpg)"></div>
</div>
<a class="btn fullscreen min500"><i class="icon icon-screen" size="36"></i></a>
<div class="fxd t r" id="member-menu"></div>
<!--/* Interface Start */-->
<div class="fxd full" id="interface">
    <!--/* Header Start */-->
    <header class="fxd fx t bgc-dark justify">
    	<nav class="nav flt-r usermenu"></nav>
    	<nav class="nav comm">
        			            <a class="btn min600 open pjax" href="/index/home/index"><span>首页</span></a>
			        						<a class="btn min600" target="_blank" onclick="$('a.btn.min600.open').removeClass('open');$(this).addClass('open')" href="/index/../member/home/summary"><span>公司简介</span></a>
			        			            <a class="btn min600  pjax" href="/index/home/download"><span>下载</span></a>
			        			            <a class="btn min600  pjax" href="/index/home/help"><span>帮助</span></a>
			        			            <a class="btn min600  pjax" href="/index/home/advice"><span>意见反馈</span></a>
			                </nav>
    </header>
    <!--/* Header End */-->
    
	<!--/* Navigation Start */-->
	<nav id="nav"></nav>
    <!--/* Navigation End */-->
    
    <!--/* Container Start */-->
    <main id="container">
<style>
#play-mode,body[content] #disable-tips{ display:none;}
body[content] #play-mode,#disable-tips{ display:block;}
.logo{background-size:contain; height:30%; width:45%; top:10%;}
</style>
<div class="fxd r logo"></div>
<nav class="fxd justify" id="tab-tools">
  <a class="btn fbtn" data-action="left"><i class="icon icon-left" size="90"></i></a>
  <a class="btn fbtn" data-action="right"><i class="icon icon-right" size="90"></i></a>
</nav>
<div class="fxd list-box right r">
	<div class="list-box-head">
      <i></i>
      <div></div>
    </div>
    	<div id="play-mode" class="list-box-cont">
    	<a class="btn big fbtn vs-font" href="/index/home/list/drum-study" data-action="study"><span>教学模式</span></a>
    	<a class="btn big fbtn vs-font" href="/index/home/list/drum-train" data-action="train"><span>练习模式</span></a>
    	<a class="btn big fbtn vs-font" href="/index/home/list/drum-games" data-action="games"><span>游戏模式</span></a>
    </div>
	<div id="disable-tips" class="list-box-cont" align="center">
    	<div style="margin-bottom:30px;"><i class="icon icon-hello"></i></div>
        <div type="tips">
    	<i class="icon smile-warn" size="72"></i>
        [<a id="subjects-name">架子鼓</a>] 未开启
        </div>
        <p style="margin-right:20px; text-align:right;">敬请期待！</p>
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
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'main';root.mod = 'home';root.page = 'index';root.packURL = '/index/pack/index/main-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10000","gender":"0","group":"0","username":"user_113554","type":"1"};root.ecode = 'ff0d85614a61306eb4d52653a0f507a3';root.execute(root.packURL,root.mainProgress || null, root.mainComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
