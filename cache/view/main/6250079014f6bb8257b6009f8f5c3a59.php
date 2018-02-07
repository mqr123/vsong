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
<body loading="500" mod="home" page="advice" app="main" content="drum">
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
			        			            <a class="btn min600  pjax" href="/main/home/help"><span>帮助</span></a>
			        			            <a class="btn min600 open pjax" href="/main/home/advice"><span>意见反馈</span></a>
			                </nav>
    </header>
    <!--/* Header End */-->
    
	<!--/* Navigation Start */-->
	<nav id="nav"></nav>
    <!--/* Navigation End */-->
    
    <!--/* Container Start */-->
    <main id="container">
<style>
	.advicePage{background: #fff;border-radius: 10px;margin: 100px auto 0;width: 70%;}
	.advicePage>form{padding: 30px;padding-top: 10px;}
	.advicePage label{display: block;}
	.advicePage label>span{display: block;color: #9fb1b1;}
	textarea::-webkit-input-placeholder,input::-webkit-input-placeholder {color: #9fb1b1;}
	input::selection,textarea::selection{background: none;color: white;}
	form .ad input,form .ad textarea {box-sizing: border-box;line-height: 24px;width: 100%;color: #00a09d;background: #e8f2f2;padding: 10px;border-radius: 5px;margin: 5px 0;}
	textarea::-webkit-input-placeholder,input::-webkit-input-placeholder {color: #9fb1b1;}
	.advicePage form input[type='text']:focus,.advicePage form textarea:focus{background:#bdeeee;transition-duration: .3s;}
	.advice_text{position: relative;}
	.advice_text .words{position: absolute;bottom: 15px;right: 0;}
	textarea{resize: none;height: 200px;}
	.advicePage label>input[type^="t"]{max-width: none;}
	.mbtn{display:inline-block;color:white;background:#a7bfbf;padding: 15px 100px;font-size:22px;font-weight: bold;text-align: center;border-radius: 50px;letter-spacing: 10px;}
	.mbtn:hover{background: #00a09d;box-shadow: 0 5px 20px #00a09d;-vs-animation:focus .3s linear alternate;}	
	.ad_btn{text-align: center;margin-top: 60px;}
	.advicePage .title{color: #000;padding: 20px 30px;border-bottom: 1px solid #ddd;}
	
	.advicePage .items>.label{white-space: normal;}
	.advicePage .label .btn{display: inline-block;color: #00A09D;margin-right: 5%;margin-bottom: 5px;}
	.advicePage input[type="radio"]{margin-left: 0;}
	.advicePage input[type="radio"]:checked,.advicePage input[type="radio"]:active{border-color:#00a09d;}
	
	
	.verify{display: inline-block;width: 90px;height: 20px;line-height: 54px;vertical-align: middle;}
	@media only screen and (max-width:1200px){
		.mbtn{padding: 10px 80px;font-size: 20px;}
	}
	@media only screen and (max-width:480px){
		.advicePage>form{padding: 10px;font-size: 14px;}
		.mbtn{padding: 5px 20px;font-size: 14px;letter-spacing: 3px;}
		.advicePage form textarea{resize: none;height: 200px;line-height: 20px;}
		.advice_text .words{bottom: 10px;font-size: 12px;margin: 0;}
		.advicePage .title{padding: 10px;font-size: 14px;}
		.ad_btn{margin-top: 10px;}
		.advicePage input[type="radio"]{transform: scale(.8);}
	}
</style>
	<div class="advicePage">
		<div class="title">感谢您留下宝贵的建议，我们希望倾听您的声音！</div>
		<form id="adviceBox" action="/main/home/advice/post" method="post">
			<div class="items">
            	<div class="label">
                      <label class="btn"><input name="type" type="radio"  value="0" checked>教学</label>
                      <label class="btn"><input name="type" type="radio"  value="1">游戏</label>
                      <label class="btn"><input name="type" type="radio"  value="2">练习</label>
                      <label class="btn"><input name="type" type="radio"  value="3">技术</label>
                      <label class="btn"><input name="type" type="radio"  value="4">产品</label>
                </div>
            </div>
			<label class="advice_text ad">
				<span>您的建议*</span>
				<textarea maxlength="500" name="connect" placeholder="请输入您对本系统的意见与建议"></textarea>
				<span class="words">0/500字</span>
			</label>
			<label class="ad">
				<span>联系方式*</span>
				<input type="text" name="phone" placeholder="请留下真实的联系方式（邮箱、QQ），方便我们答疑解惑！"/>
			</label>
			<div class="ad" >
				<span style="display: inline-block;color: #00a09d;width: 50px;height: 54px;line-height: 54px;text-align: center;vertical-align: middle;">验证码</span>
			    <a id="vcode" url="/main/home/verify/vcode-100-30-24" style="display: inline-block;width: 90px;height: 54px;line-height: 54px;border: 1px solid transparent;">
			    	<i class="btn verify" style="background-image:url(/main/home/verify/vcode-100-30-24);"></i>
			    </a>
			    <input type="text" name="vcode" maxlength="4" style="width:200px;" placeholder="请输入验证码" />
            </div>
			<input type="hidden" name="formhash" value="54ec738d"/>
			<div class="ad_btn"><span id="adviceBtn" class="fbtn mbtn">提交</span></div>
		</form>
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
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'main';root.mod = 'home';root.page = 'advice';root.packURL = '/main/pack/advice/main-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10007","gender":"1","group":"0","username":"user001","type":"0"};root.ecode = '0b638bcd2b31a2864efdfa4a876ea18d';root.execute(root.packURL,root.mainProgress || null, root.mainComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
