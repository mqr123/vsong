<?php $_G =& $this->getVariable('_G'); $school =& $this->getVariable('school'); $realname =& $this->getVariable('realname'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/header'); ?>
<?php include $this->compile('common/nav'); ?>
	<div class="mobile-box">
		<div class="mobile-cont">
			<!--关于我们-->
			<div class="about-us">
				<div class="big-img">
					<div class="scroll scroll_show" id="home-cover">
						<!--scroll_img-->
						<div class="scroll_img">
							<div class="imgs" data-index='0'><img src="<?php echo $_G['dir'];?>public/images/mobile/scroll.png"/></div>
							<div class="imgs" data-index='1'><img src="<?php echo $_G['dir'];?>public/images/subsite/scroll_0.png"/></div>
						</div>
						<!--scroll_page-->
						<div class="scroll_page">
							<span data-index='0'></span>
							<span data-index='1'></span>
						</div>
						
						<!--scroll_title-->
						<div class="warp scroll_ctrl">
							<div class="warp">
								<a class="btn fbtn flt-l" data-action='left'><i class="icon_o o-left"></i></a>
								<a class="btn fbtn flt-r" data-action='right'><i class="icon_o o-right"></i></a>
							</div>
						</div>
					</div>
					<!--<div class="big-image-logo"></div>-->
				</div>
				<div class="mobile-title"><h3>认识维颂智能音乐教学</h3></div>
				<div class="mobile-aboutUs"><p>ABOUT US</p></div>
				<div class="summary-cont">
					<p>西安维颂科技开发有限公司是一家专注于音乐教学软件开发及推广的科技型互联网企业,2016年注册于杭州市滨江区。当时为杭州维颂科技有限公司，2017年8月迁入西安，更为现名。</p>
					<p>现集一批高素质的软件开发人才，在深耕于音乐研究及音乐教学十多年的天才软件程序员的带领下，历时四年，现已完成一整套云数据音乐教学软件，创建整合各音乐培训机构的线上O2O平台。架子鼓智能教学软件2.0版正式发布，其他电子乐器教学软件在陆续开发中。探索和开发音乐线上教学的新模式是公司的发展方向，引领音乐智能教学的方向是公司的发展目标，打造音乐培训领域的航母是公司的愿景。</p>
				</div>
				<div class="parent-talk">
					<img src="<?php echo $_G['dir'];?>public/images/mobile/prtalk.png"/>
					<span>家长说</span>
					<p>孩子学音乐，三天打渔两天晒网、学费贵、没有时间陪孩子一起学，怎么办？</p>
				</div>
				<div class="vs-talk">
					<p>我们的开发团队以游戏方式引导 孩子进入学习状态，通过云数据 分析孩子的特性，并给出针对性 的教育解决方案；</br>共享教材、乐谱、模型，场景等资源库，可更换3D界面；</br>跨平台支持，并将数据图形化，将孩子特性反馈到机构和家长端。使得家长能够实时跟踪孩子的学习状况。</p>
					<span>维颂说</span>
					<img src="<?php echo $_G['dir'];?>public/images/mobile/vstalk.png"/>
				</div>
			</div>
			<!--三种模式-->
			<div class="three-model">
				<div class="model-title">
					<a href="javascript:;"><span class="teac"><div class="moduMask">教学模式</div></span></a>
					<a href="javascript:;"><span class="test"><div class="moduMask">练习模式</div></span></a>
					<a href="javascript:;"><span class="game"><div class="modu_mask moduMask">游戏模式</div></span></a>
				</div>
				<div class="model-cont">
					<img src="<?php echo $_G['dir'];?>public/images/mobile/youxi_page.png" alt="" />
				</div>
				<div class="model-summery">
					<p>以游戏方式引导孩子进入学习状态，</p>
					<p>在通过兴趣教学从而达到教育目的。</p>
				</div>
			</div>
			<!--机构排行-->
			<div class="school-rank">
				<div class="mobile-title-school"><h3>维颂优秀加盟机构</h3></div>
				<div class="mobile-title-school"><p>EXCELLENT ORGANIZATION</p></div>
				<!--<?php if (!empty($school)){ ?>-->
				<div class="school-box">
					<!--<?php if (count($school)>9){ ?>
					<?php $s=9; ?>
					<?php }else{ ?>
						<?php $s=count($school); ?>
					<?php } ?>-->
					<!--<?php for ($i=0; $i<$s; $i++) { ?>-->
					<a href="<?php echo $this->url(('../subsite/home/index/'.$school[$i]['uid']));?>">
						<div class="school-show">
							<p><?php echo $school[$i]['name'];?></p>
							<span></span>
						</div>
					</a>
					<!--<?php } ?>-->
				</div>
				<!--<?php }else{ ?>-->
				<div class="school-image">
					<img src="<?php echo $_G['dir'];?>public/images/mobile/youxiu-school.png"/>
				</div>
				<!--<?php } ?>-->
			</div>
			<!--学员展示-->
			<div class="student-show">
				<div class="mobile-title-school"><h3>维颂优秀优秀学员展示</h3></div>
				<div class="mobile-title-school"><p>EXCELLENT STUDENT</p></div>
				<!---->
				<div class="student-images">
					<!--<?php if (!empty($realname)){ ?>-->
					<!--<?php foreach ((array)$realname as $key) { ?>-->
					<div class="student-img">
						<div class="stu-img">
							<img src="<?php echo $_G['dir'];?>public/images/mobile/common-headImg.png" alt="" />
						</div>
						<p class="stu-name"><?php echo $key['realname'];?></p>
						<p class="stu-type">架子鼓</p>
					</div>
					<!--<?php } ?>-->
					<!--<?php }else{ ?>-->
					
					<!--<?php } ?>-->
					
				</div>
			</div>
			<!--联系我们-->
			<div class="contact-us">
				<div class="mobile-title-school"><h3>联系我们</h3></div>
				<div class="mobile-title-school"><p>CONTACT US</p></div>
				<div class="contact-list">
					<i class="icons icon-phone"></i>
					<p>122222222252</p>
				</div>
				<div class="contact-list">
					<i class="icons icon-email"></i>
					<p>122222222252@qq.com</p>
				</div>
				<div class="contact-list">
					<i class="icons icon-time"></i>
					<p>周一到周五 9:00-18:00</p>
				</div>
				<div class="contact-list">
					<i class="icons icon-dress"></i>
					<p>西安市长安区金凤路838号曲江369互联网创新创业基地</p>
				</div>
			</div>
		</div>
	</div>
<?php include $this->compile('common/footer'); ?>
