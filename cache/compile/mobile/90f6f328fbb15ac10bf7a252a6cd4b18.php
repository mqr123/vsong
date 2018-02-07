<?php include $this->compile('common/header'); ?>
<?php include $this->compile('common/nav'); ?>
	<div>
		<div class="advicePage">
			<div class="title">感谢您留下宝贵的建议，我们希望倾听您的声音！</div>
			<form id="adviceBox" action="<?php echo $this->url(('../main/home/advice/post'));?>" method="post">
				<div class="items">
	            	<div class="label">
	                      <label class="btn"><input name="type" type="radio"  value="0" checked>教学</label>
	                      <label class="btn"><input name="type" type="radio"  value="1">游戏</label>
	                      <label class="btn"><input name="type" type="radio"  value="2">练习</label>
	                      <label class="btn"><input name="type" type="radio"  value="3">技术</label>
	                      <label class="btn"><input name="type" type="radio"  value="4">产品</label>
	                </div>
	            </div>
				<label class="advice_text ad">
					<span>您的建议*</span>
					<textarea maxlength="500" name="connect" placeholder="请输入您对本系统的意见与建议"></textarea>
					<span class="words">0/500字</span>
				</label>
				<label class="ad">
					<span>联系方式*</span>
					<input type="text" name="phone" placeholder="请留下真实的联系方式（邮箱、QQ），方便我们答疑解惑！"/>
				</label>
					<input type="hidden" name="formhash" value="<?php echo $this->formhash();?>"/>
				<div class="ad_btn"><span id="adviceBtn" class="fbtn mbtn">提交反馈</span></div>
			</form>
		</div>
	</div>
<?php include $this->compile('common/footer'); ?>
