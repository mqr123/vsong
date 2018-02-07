<?php exit;?><!---->
	<div class="school">
		<h2 class="logo"></h2>
		<div class="check">
			<span class="schoolImg"></span>
			<form onsubmit="$('#schoolCheck').click();return false"  action="/member/home/school/post" class="checkBox flt-r" method="post">
				<h3 type="tips">
					<i size="72" class="icon smile-warn flt-l"></i>
					<p>为了安全起见，请再次输入您的登陆密码</p>
				</h3>
				<label>
					<span>账号</span>
					user_113554				</label>
				<label>
					<span>密码</span>
					<input type="password" name="password" placeholder="请输入密码" />
				</label>
				<div>
					<a id="schoolCheck" class="mbtn">验证</a>
				</div>
			</form>
		</div>
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
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'member';root.mod = 'home';root.page = 'school';root.packURL = '/member/pack/school/member-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10000","gender":"0","group":"0","username":"user_113554","type":"1"};root.ecode = 'f8d71d17d7484ef38ad38a7d3eb3b778';root.execute(root.packURL,root.memberProgress || null, root.memberComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
<!---->
