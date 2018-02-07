<?php exit;?><style>
#download-page>.top{ background-color:rgba(0,0,0,.5)}
#download-page>.top{ margin-top:68px;}
#download-page>.top>.center{ text-align:center; height:100%;}
#download-page>.top>.center>.logo{ display:block; height:50%; background-size:contain;}
#download-page>.top>.center>p{ margin-top:-4%; font-size:140%; font-family:"Courier New", Courier, monospace; font-weight:100;}
#download-page>.bottom{ text-align-last:justify; padding:2% 10%; min-height:120px; background-color:rgba(220,255,250,.75);}
#download-page>.bottom>span>a{ margin:20px auto;}
#download-page>.bottom>span>a>span{ display:inline-block;border-radius:50%; padding:20px;background-color:rgba(0,0,0,.8);}
#download-page>.bottom>span>a>p{color:#000; line-height:40px;}
#download-page>.bottom>span>a:hover>span{ background-color:#fff;}
#download-page>.bottom>span>a:hover>p{color:#fff; text-shadow:0 0 5px #000;}
</style>
<div id="download-page">
	<div class="fxd full top">
    	<div class="center">
         	<a class="btn logo"></a>
        	<p>Copyright &copy; 2017 VSong.TV 浙ICP17002301号</p>
    	</div>
    </div>
	<div class="fxd fx b bottom">
    	<span class="mb800">
    	<a class="btn" data-type="pc" tabindex="1"><span class="s5" size="90"><i class="icon icon-pc" size="90"></i></span><p>下载电脑版</p></a>
    	<a class="btn" data-type="android" tabindex="2"><span class="s5" size="90"><i class="icon icon-android" size="90"></i></span><p>下载安卓版</p></a>
        </span>
        <span class="mb800">
    	<a class="btn" data-type="ios" tabindex="3"><span class="s5" size="90"><i class="icon icon-ios" size="90"></i></span><p>下载苹果版</p></a>
    	<a class="btn" data-type="pad" tabindex="4"><span class="s5" size="90"><i class="icon icon-pad" size="90"></i></span><p>下载iPad版</p></a>
        </span>
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
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'main';root.mod = 'home';root.page = 'download';root.packURL = '/main/pack/download/main-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10000","gender":"0","group":"0","username":"user_113554","type":"1"};root.ecode = 'ff0d85614a61306eb4d52653a0f507a3';root.execute(root.packURL,root.mainProgress || null, root.mainComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
