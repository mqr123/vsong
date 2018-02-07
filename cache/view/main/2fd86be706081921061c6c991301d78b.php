<?php exit;?><style>
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
    	<a class="btn big fbtn vs-font" href="/main/home/list/drum-study" data-action="study"><span>教学模式</span></a>
    	<a class="btn big fbtn vs-font" href="/main/home/list/drum-train" data-action="train"><span>练习模式</span></a>
    	<a class="btn big fbtn vs-font" href="/main/home/list/drum-games" data-action="games"><span>游戏模式</span></a>
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
	subjects:null,
	enabled:null};
</script>
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'main';root.mod = 'home';root.page = 'index';root.packURL = '/main/pack/index/main-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10001","gender":"0","group":"0","username":"user_124334","type":"0"};root.ecode = '55037d88e20fb5892e9129ec8b3626ee';root.execute(root.packURL,root.mainProgress || null, root.mainComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
