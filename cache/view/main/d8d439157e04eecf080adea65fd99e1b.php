<?php exit;?><style>
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
	subjects:null,
	enabled:null};
</script>
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'main';root.mod = 'home';root.page = 'help';root.packURL = '/index/pack/help/main-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":"10000","gender":"0","group":"0","username":"user_113554","type":"1"};root.ecode = 'ff0d85614a61306eb4d52653a0f507a3';root.execute(root.packURL,root.mainProgress || null, root.mainComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
