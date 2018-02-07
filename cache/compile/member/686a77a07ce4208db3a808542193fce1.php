<?php $pjax =& $this->getVariable('pjax');  ?>
<?php if (!$pjax){ ?>
		</div></div>
	</div>
</main>
<?php if ( !$this->pjax){ ?>
    <footer>
		<div class="warp">
			<ul>
				<li>关于维颂</li>
				<li>服务条款</li>
				<li>广告服务</li>
				<li>维颂招聘</li>
				<li>隐私政策</li>
				<li>用户服务协议</li>
			</ul>
			<p>Copyright &copy; 2017 <a target="_blank" href="https:vsong.tv">VSong.TV</a> 浙ICP备17002031号</p>
			<p>维颂电子科技版权所有 维颂电子科技有限公司文化经营许可</p>
		</div>
    </footer>
<?php } ?>
<script>
var VSong = {
	//引擎版本号
	engineVersion:'<?php echo $this->lang('vs_version');?>',
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
	lang:<?php echo $this->json($this->language);?>
};
</script>
<?php echo $this->resource('pack','member',3,'
	<file src="global" />
	<file src="dom" />
	<file src="box" />
	<file src="pjax" />
	<file src="midi" />
	<file src="cookie" />
	<file src="websql" />
	<file src="district" />
	<file src="member/init" />
	<file src="member/modules" />
	<file src="chart" />
	<file src="engine.controls" />
	<file src="engine" />
');?>
</body>
</html>
<?php } ?>
