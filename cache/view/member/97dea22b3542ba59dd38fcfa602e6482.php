<?php exit;?><!---->
	
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