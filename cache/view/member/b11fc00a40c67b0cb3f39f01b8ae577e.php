<?php exit;?>	<div class="backpack">
		<!---->
		<div class="build">
			<span></span>
			<p>暂无数据~</p>
		</div>
		<!---->
	</div>

		</div></div>
	</div>
</main>
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
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'member';root.mod = 'manage';root.page = 'buy';root.packURL = '/member/pack/buy/member-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10001","gender":"0","group":"0","username":"user_124334","type":"0"};root.ecode = '4c43fc053e637bd7a9a03a03be399bbb';root.execute(root.packURL,root.memberProgress || null, root.memberComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
