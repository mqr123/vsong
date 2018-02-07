<?php if (!$this->pjax){ ?>
		</div>
	</div>
</main>

<footer>
	<div class="warp">
		
	</div>
</footer>
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
	lang:<?php echo $this->json($this->language);?>
};
</script>
<?php echo $this->resource('pack','main',3,'
	<file src="global" />
	<file src="dom" />
	<file src="box" />
	<file src="pjax" />
	<file src="websql" />
	<file src="district" />
	<file src="school/modules" />
	<file src="school/init" />
	<file src="engine.controls" />
	<file src="engine" />
');?>
</body>
</html>
<?php } ?>
