<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/header'); ?>
	<div class="readmsg-box">
		<div class="readmsg-header">
			
			<a href="<?php echo $this->url(('home/message/read'));?>" class="btn pjax back">返回</a>
		</div>
		<!-- <?php foreach ((array)$data['list'] as $key) { ?> -->
		<div class="readmsg-cont">
			<div class="unRead-headimage">
				<span class="icon_s icon-unRead icon_reads"systems="0"></span>
			</div>
			<div class="read_cont">
				<span class="triangle"></span>
				<?php echo $key['content'];?>
				
			</div>
			<div class="read_date"><?php echo date('Y-m-d H:i:s',$key['dateline']);?></div>
		</div>
		<!-- <?php } ?> -->
	</div>
<?php include $this->compile('common/footer'); ?>