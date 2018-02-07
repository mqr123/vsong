<?php $pjax =& $this->getVariable('pjax');  ?>

<?php if (!$pjax){ ?>
		</div>
	</div>
</main>

<!--<footer>
	<a href="<?php echo $this->url(('home/index'));?>"><span><i class="icons icon-first"></i><p>首页</p></span></a>
	<a href="javascript:;">
		<span><div class="modu_join"></div></span>
	</a>
	<a href="javascript:;" class="myInfo"><span><i class="icons icon-my"></i><p>我</p></span></a>
</footer>-->


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
<?php echo $this->resource('pack','mobile',3,'
	<file src="global" />
	<file src="dom" />
	<file src="box" />
	<file src="pjax" />
	<file src="midi" />
	<file src="cookie" />
	<file src="websql" />
	<file src="district" />
	<file src="mobile/init" />
	<file src="mobile/modules" />
	<file src="chart" />
	<file src="engine.controls" />
	<file src="engine" />
');?>
</body>
</html>
<?php } ?>
