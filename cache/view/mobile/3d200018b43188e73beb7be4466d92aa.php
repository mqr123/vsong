<?php exit;?><!--2017/11/06 maqianru-->
<div class="mobile_footer">
	<div>
		<span class="drop">
			<a href="/index/home/index">首页</a>
		</span>
		<span class="drop dropBtn" state='0'>
			<a class="icon_join"><i></i></a>
			<div class="drop_down">
				<a href="/index/home/advice">意见反馈</a>
				<a href="">常见问题</a>
			</div>
			<div class="fullMask"></div>
		</span>
		<span class="drop">
			<a class="myInfo"  href="javascript:;">个人中心</a>
		</span>
	</div>
</div>
	<div>
		<div class="advicePage">
			<div class="title">感谢您留下宝贵的建议，我们希望倾听您的声音！</div>
			<form id="adviceBox" action="/index/../main/home/advice/post" method="post">
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
					<input type="hidden" name="formhash" value="54ec738d"/>
				<div class="ad_btn"><span id="adviceBtn" class="fbtn mbtn">提交反馈</span></div>
			</form>
		</div>
	</div>

		</div>
	</div>
</main>

<!--<footer>
	<a href="/index/home/index"><span><i class="icons icon-first"></i><p>首页</p></span></a>
	<a href="javascript:;">
		<span><div class="modu_join"></div></span>
	</a>
	<a href="javascript:;" class="myInfo"><span><i class="icons icon-my"></i><p>我</p></span></a>
</footer>-->


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
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'mobile';root.mod = 'home';root.page = 'advice';root.packURL = '/index/pack/advice/mobile-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10000","gender":"0","group":"0","username":"user_113554","type":"1"};root.ecode = 'b80fe2ac5787a8b6285a25805405842f';root.execute(root.packURL,root.mobileProgress || null, root.mobileComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
