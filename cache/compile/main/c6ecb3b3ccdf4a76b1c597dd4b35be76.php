<?php $pjax =& $this->getVariable('pjax'); $subjects_list =& $this->getVariable('subjects_list'); $subjects_enabled =& $this->getVariable('subjects_enabled');  ?>
<?php if (!$pjax){ ?>
	</main>
    <!--/* Container End */-->
    <footer>

    </footer>
<!--/* Interface End */-->
</div>
<script>
var VSong = {
	//程序版本号
	version: <?php echo __VERSION__;?>,
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
	useWorker:true,//是否使用worker
	lang:<?php echo $this->json($this->language);?>,
	subjects:<?php echo $this->json($subjects_list);?>,
	enabled:<?php echo $this->json($subjects_enabled);?>
};
</script>
<?php echo $this->resource('pack','main',3,'
	<file src="global" />
	<file src="dom" />
	<file src="box" />
	<file src="pjax" />
	<file src="midi" />
	<file src="cookie" />
	<file src="websql" />
	<file src="district" />
	<file src="main/login" />
	<file src="main/modules" />
	<file src="main/init" />
	<file src="engine.controls" />
	<file src="engine" />
');?>
</body>
</html>
<?php } ?>
