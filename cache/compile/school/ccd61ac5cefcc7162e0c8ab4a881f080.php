<?php $_G =& $this->getVariable('_G'); $types =& $this->getVariable('types'); $tab =& $this->getVariable('tab'); $data =& $this->getVariable('data'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/header'); ?>
<!--<?php 
	 $p = !empty($_G['param'][0])?$_G['param'][0]:'news';
$types = array('enrol','product','issuance');

$tab = !empty($_G['param'][0]) && in_array($_G['param'][0],$types)?$_G['param'][0]:'news';
?>-->

<style>
.release a.btn[href="<?php echo $this->url(('home/release/'.$p));?>"]{font-weight: 800;}
.release a.btn[href="<?php echo $this->url(('home/release/'.$p));?>"]:after,
.release>nav>a.btn.op:hover:after{content: "";position: absolute;width:35px;height: 2px;background: #00A09D;margin: 42px -33px;}
</style>

<div class="release">
	<div class="release-header">
		<nav>
			<a class="btn pjax bottom-line op" href="<?php echo $this->url(('home/release/news'));?>">新闻</a>
			<a class="btn pjax bottom-line op" href="<?php echo $this->url(('home/release/enrol'));?>">招生</a>
			<a class="btn pjax bottom-line op" href="<?php echo $this->url(('home/release/product'));?>">产品</a>
			<a class="btn pjax bottom-line op" href="<?php echo $this->url(('home/release/issuance'));?>">发布</a>
		</nav>
	</div>
	<!---------------------新闻部分-------------------->
	<form action="<?php echo $this->url(('home/release/p-post'));?>" id="issuance">
		<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>" />
		<!--<?php if ($tab == 'news'){ ?>-->
		<!--<?php if (empty($data['list'])){ ?>-->
		<div class="build">
			<span></span>
			<p>暂无数据~</p>
		</div>
		<!--<?php }else{ ?>-->
		<!-- <?php foreach ((array)$data['list'] as $key) { ?> -->
		<div class="release-cont" id="rel_del">
			<div class="release-conts rel_cont" data-id="<?php echo $key['id'];?>">
				<i></i>
				<div class="release-image">
				<!-- <?php if ($key['files']){ ?> -->
					<img src="/<?php echo $key['files'];?>"/>
				<!-- <?php }else{ ?> -->
					<img src="<?php echo $this->url(('../public/images/school/default.png'));?>"/>
				<!-- <?php } ?> -->
				</div>
				<p class="news-title"><?php echo $key['title'];?></p>
				<p class="news-summery"><?php echo $key['summery'];?></p>
				<p class="new-date"><?php echo date('Y-m-d H:i:s',$key['datetime']);?></p>
				<div class="news-box">
					<div class="news-lsdz">
						<span class="icon_s icon-zhuan"></span>
						<p><?php echo $key['forwarding'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-cang"></span>
						<p><?php echo $key['collection'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-zan"></span>
						<p><?php echo $key['likes'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-liulan"></span>
						<p><?php echo $key['browse'];?></p>
					</div>
				</div>
				<!--href="<?php echo $this->url(('home/newsdelete/'.$key['id']));?>"-->
				<a  class="btn new_deleteBtn">删除</a>
			</div>
			<!--<a class="relea btn pjax" href="<?php echo $this->url(('home/release/issuance'));?>" ><span class="relea_btn">我要发布</span></a>-->
		</div>
		<!-- <?php } ?> -->
		<div class="release-checkBox">  
		   <!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
		   <?php if ($data['page'] == $i){ ?>
		   <a class="btn checked">第<?php echo $i;?>页</a>
		   <?php }else{ ?>
		   <a class="btn pjax" href="<?php echo $this->url(('home/release/news-'.$i));?>">第<?php echo $i;?>页</a>
		   <?php } ?>
		   <!--<?php } ?>-->
		</div >  
		<!--<?php } ?>-->
		<!---------------------发布-------------------->
		<!--<?php }else if ($tab == 'issuance'){ ?>-->
		<!--<form action="<?php echo $this->url(('home/release/p-post'));?>" id="issuance">
			<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>" />-->
		<div class="issuance">
			<div class="issuance-title">
				<div style="display: inline-block;margin-right: 10px;"><span>发布类型</span><i>*</i></div>
				<div class="ilb">新闻<input type="radio" checked name="type" value="0" /></div>
				<div class="ilb">招生<input type="radio" name="type" value="1" /></div>
				<div class="ilb">产品<input type="radio" name="type" value="2" /></div>
			</div>
			<div class="issuance-title">
				<div><span>标题</span><i>*</i></div>
				<div class="news_ipt-title">
					<input type="text" name="title" maxlength="30" placeholder="请输入新闻标题（10字以内）" />
				</div>
			</div>
			<div class="issuance-title">
				<div><span>简介</span><i>*</i></div>
				<div class="news_ipt-title">
					<input type="text" name="summery" maxlength="50" placeholder="请输入新闻介绍（50字以内）" />
				</div>
			</div>
			<div class="issuance-cont" style="display: block;">
				<div><span>内容</span><i>*</i></div>
				<div class="issuance-conts">
					<div class="issuance_span" style="position: relative;">
						<button type="button" class="issuance_spans btn" data-name="undo"></button>
						<button type="button" class="issuance_spans btn" data-name="redo"></button>
						<button type="button" class="issuance_spans btn" data-name="bold"></button>
						<button type="button" class="issuance_spans btn" data-name="italic"></button>
						<button type="button" class="fontsize btn" data-name="fontsize"></button>
						<button type="button" class="issuance_spans btn" data-name="underline"></button>
						<button type="button" class="issuance_spans btn" data-name="justifyLeft"></button>
						<button type="button" class="issuance_spans btn" data-name="justifyCenter"></button>
						<button type="button" class="issuance_spans btn" data-name="justifyRight"></button>
						<!--<button type="button" class="issuance_spans btn hide_span uploadImage"></button>-->
						<div class="fontsize-show">
							<button type="button" class="font_size btn">小标题</button>
							<button type="button" class="font_size btn">中标题</button>
							<button type="button" class="font_size btn">大标题</button>
						</div>
					</div>
					<div class="over-auto">
						<div  class="issuance_editCont" id="wysiwyg" contenteditable>
							
						</div>
					</div>
				</div>
			</div>
			<div class="issuance-up_img">
				<div><span>上传封面图片</span><i>*</i></div>
				<label class="btn ilb up_loads">
					<input type="file" name="files"  id="coverchange" class="hide">
				</label>
				<div style="font-size: 14px;color: #adb2b2;">请上传2M以内的jpg或png格式的图片</div>
			</div>
			<div class="issuance-btn">
				<span class="issuanceBtn btn">立即发布</span></div>
		</div>
	</form>
	
	<!---------------------招生部分-------------------->
	<!--<?php }else if ($tab == 'enrol'){ ?>-->
		<!--<?php if (empty($data['list'])){ ?>-->
		<div class="build">
			<span></span>
			<p>暂无数据~</p>
		</div>
		<!--<?php }else{ ?>-->
		<!-- <?php foreach ((array)$data['list'] as $key) { ?> -->
		<div class="release-cont" id="rel_del">
			<div class="release-conts rel_cont" data-id="<?php echo $key['id'];?>">
				<i></i>
				<div class="release-image">
				<!-- <?php if ($key['files']){ ?> -->
					<img src="/<?php echo $key['files'];?>"/>
				<!-- <?php }else{ ?> -->
					<img src="<?php echo $this->url(('../public/images/school/default.png'));?>"/>
				<!-- <?php } ?> -->
				</div>
				<p class="news-title"><?php echo $key['title'];?></p>
				<p class="news-summery"><?php echo $key['summery'];?></p>
				<p class="new-date"><?php echo date('Y-m-d H:i:s',$key['datetime']);?></p>
				<div class="news-box">
					<div class="news-lsdz">
						<span class="icon_s icon-zhuan"></span>
						<p><?php echo $key['forwarding'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-cang"></span>
						<p><?php echo $key['collection'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-zan"></span>
						<p><?php echo $key['likes'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-liulan"></span>
						<p><?php echo $key['browse'];?></p>
					</div>
				</div>
				<!--href="<?php echo $this->url(('home/newsdelete/'.$key['id']));?>"-->
				<a  class="btn new_deleteBtn">删除</a>
			</div>
			<!--<a class="relea btn pjax" href="<?php echo $this->url(('home/release/issuance'));?>" ><span class="relea_btn">我要发布</span></a>-->
		</div>
		<!-- <?php } ?> -->
		<div class="release-checkBox">  
		   <!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
		   <?php if ($data['page'] == $i){ ?>
		   <a class="btn checked">第<?php echo $i;?>页</a>
		   <?php }else{ ?>
		   <a class="btn pjax" href="<?php echo $this->url(('home/release/enrol-'.$i));?>">第<?php echo $i;?>页</a>
		   <?php } ?>
		   <!--<?php } ?>-->
		</div > 
		<!--<?php } ?>-->
	
	
	<!---------------------产品部分-------------------->
	<!--<?php }else if ($tab == 'product'){ ?>-->
	<!--<?php if (empty($data['list'])){ ?>-->
	<div class="build">
		<span></span>
		<p>暂无数据~</p>
	</div>
	<!--<?php }else{ ?>-->
	<!-- <?php foreach ((array)$data['list'] as $key) { ?> -->
		<div class="release-cont" id="rel_del">
			<div class="release-conts rel_cont" data-id="<?php echo $key['id'];?>">
				<i></i>
				<div class="release-image">
				<!-- <?php if ($key['files']){ ?> -->
					<img src="/<?php echo $key['files'];?>"/>
				<!-- <?php }else{ ?> -->
					<img src="<?php echo $this->url(('../public/images/school/default.png'));?>"/>
				<!-- <?php } ?> -->
				</div>
				<p class="news-title"><?php echo $key['title'];?></p>
				<p class="news-summery"><?php echo $key['summery'];?></p>
				<p class="new-date"><?php echo date('Y-m-d H:i:s',$key['datetime']);?></p>
				<div class="news-box">
					<div class="news-lsdz">
						<span class="icon_s icon-zhuan"></span>
						<p><?php echo $key['forwarding'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-cang"></span>
						<p><?php echo $key['collection'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-zan"></span>
						<p><?php echo $key['likes'];?></p>
					</div>
					<div class="news-lsdz">
						<span class="icon_s icon-liulan"></span>
						<p><?php echo $key['browse'];?></p>
					</div>
				</div>
				<!--href="<?php echo $this->url(('home/newsdelete/'.$key['id']));?>"-->
				<a  class="btn new_deleteBtn">删除</a>
			</div>
			<!--<a class="relea btn pjax" href="<?php echo $this->url(('home/release/issuance'));?>" ><span class="relea_btn">我要发布</span></a>-->
		</div>
		<!-- <?php } ?> -->
		<div class="release-checkBox">  
		   <!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
		   <?php if ($data['page'] == $i){ ?>
		   <a class="btn checked">第<?php echo $i;?>页</a>
		   <?php }else{ ?>
		   <a class="btn pjax" href="<?php echo $this->url(('home/release/product-'.$i));?>">第<?php echo $i;?>页</a>
		   <?php } ?>
		   <!--<?php } ?>-->
		</div > 
	<!--<?php } ?>-->
	<!--<?php } ?>-->
	
</div>
<?php include $this->compile('common/footer'); ?>