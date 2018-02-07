<?php $_G =& $this->getVariable('_G'); $types =& $this->getVariable('types'); $tab =& $this->getVariable('tab'); $unread =& $this->getVariable('unread'); $key =& $this->getVariable('key'); $data =& $this->getVariable('data');  ?>
<?php include $this->compile('common/header'); ?>
<!--<?php 
	$p = !empty($_G['param'][0])?$_G['param'][0]:'news';
$types = array('read','edit');
$tab = !empty($_G['param'][0]) && in_array($_G['param'][0],$types)?$_G['param'][0]:'unread';
?>-->

<style>
.information a.btn[href="<?php echo $this->url(('home/message/'.$p));?>"]{font-weight: 800;}
.information a.btn[href="<?php echo $this->url(('home/message/'.$p));?>"]:after,
.information>nav>a.btn.op:hover:after{content: "";position: absolute;width:65px;height: 2px;background: #00A09D;margin: 42px -65px;}
</style>



	<div class="information">
		<div class="information-header">
			<nav>
				<!--<?php if ($tab == 'unread'){ ?>-->
				<a class="btn pjax op" href="<?php echo $this->url(('home/message/unread'));?>" >未读消息</a>
				<a class="btn pjax op" href="<?php echo $this->url(('home/message/read'));?>" >已读消息</a>
				<a class="btn editBtn" >编辑</a>
				<!--<?php }else if ($tab == 'read'){ ?>-->
				<a class="btn pjax op" href="<?php echo $this->url(('home/message/unread'));?>" >未读消息</a>
				<a class="btn pjax op" href="<?php echo $this->url(('home/message/read'));?>" >已读消息</a>
				<!--<?php } ?>-->
				<div class="more-edit">
					<a class="btn infor_read">设为已读</a>
					<a class="btn infor_cancel">取消</a>
				</div>
			</nav>
		</div>
		<form action="<?php echo $this->url(('home/message/post'));?>" id="isRead">
		<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>">
		
		<!--<?php if ($tab == 'unread'){ ?>-->
		<div class="msg-cont">
		<!-- <?php foreach ((array)$unread['list'] as $key) { ?> -->
			<div style="position: relative;"> 
				<div class="unRead a"  data-id="<?php echo $key['id'];?>" url="<?php echo $this->url(('home/msgInfo/'.$key['id']));?>">
					<i></i>
					<!--<?php if ($key['stats']== 0){ ?>-->
					<span class="icon_s newMessageIcons icon-readBig" type="0"> </span>
					<!--<?php }else{ ?>-->
					<span class="icon_s newMessageIcons icon-readBig" type="1"> </span>
					<!--<?php } ?>-->
					<div class="unRead-headimage">
						<span class="icon_s icon-unRead icon_reads"systems="2"></span>
					</div>
					<!-- <?php if ($key['type']==0){ ?> -->
					<h5>维颂小秘书</h5>
					<!-- <?php } ?> -->
					<p><?php echo $key['title'];?></p>
					<span class="date"><?php echo date('Y-m-d H:i:s',$key['dateline']);?></span>
				</div>
				<a class="btn btn-msg" url='<?php echo $this->url(("home/deleteinfo/delete"));?>'>删除</a>
			</div>
		<!-- <?php } ?> -->
			<div class="release-checkBox">  
			   <!--<?php for ($i=1;$i <= $unread['total'];$i+=1) { ?>-->
			   <?php if ($unread['page'] == $i){ ?>
			   <a class="btn checked">第<?php echo $i;?>页</a>
			   <?php }else{ ?>
			   <a class="btn pjax" href="<?php echo $this->url(('home/message/unread-'.$i));?>">第<?php echo $i;?>页</a>
			   <?php } ?>
			   <!--<?php } ?>-->
			</div > 
		</div>
		<!--<?php }else if ($tab == 'read'){ ?>-->
		<div class="msg-cont">
		<!-- <?php foreach ((array)$data['list'] as $key) { ?> -->
		 	<div style="position: relative;">
				<div class="reade"  data-id="<?php echo $key['id'];?>" url="<?php echo $this->url(('home/msgInfo/'.$key['id']));?>">
					<div class="unRead-headimage">
						<span class="icon_s icon-unRead icon_reads"systems="2"></span>
					</div>
					<!-- <?php if ($key['type']==0){ ?> -->
					<h5>维颂小秘书</h5>
					<!-- <?php } ?> -->
					<p><?php echo $key['title'];?></p>
					<span class="date"><?php echo date('Y-m-d H:i:s',$key['dateline']);?></span>
				</div>
				<a class="btn btn-msg" url='<?php echo $this->url(("home/deleteinfo/delete"));?>'>删除</a>
			</div>
			<!-- <?php } ?> -->
			<div class="release-checkBox">  
			   <!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
			   <?php if ($data['page'] == $i){ ?>
			   <a class="btn checked">第<?php echo $i;?>页</a>
			   <?php }else{ ?>
			   <a class="btn pjax" href="<?php echo $this->url(('home/message/read-'.$i));?>">第<?php echo $i;?>页</a>
			   <?php } ?>
			   <!--<?php } ?>-->
			</div > 
		</div>
		</form>
		<!--<?php } ?>-->
	</div>
<?php include $this->compile('common/footer'); ?>