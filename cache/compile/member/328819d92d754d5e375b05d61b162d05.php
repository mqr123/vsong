<?php $_G =& $this->getVariable('_G'); $data =& $this->getVariable('data'); $key =& $this->getVariable('key'); $school =& $this->getVariable('school'); $edu =& $this->getVariable('edu');  ?>
<!--<?php if ($_G['user']['uid']){ ?>-->
<?php include $this->compile('common/header'); ?>
	
	<!-- <?php foreach ((array)$data['list'] as $key) { ?> -->
	<form id="manageBox" action="<?php echo $this->url(('manage/index/post'));?>" method="post">
		<label class="col col_l">
			<span>用户名*</span>
			<input type="text" name="username" placeholder="请输入用户名" value="<?php echo $key['username'];?>" />
			<i></i>
		</label>
		<label class="col">
			<span>手机号*</span>
			<input  type="tel" maxlength="11" name="tellphone"  value="<?php echo $key['phone'];?>"/>
			
		</label>
		<label class="col col_l">
			<span>姓名*</span>
			<input type="text" name="realname"  value="<?php echo $key['realname'];?>"/>
		</label>
		<label class="col">
			<span>身份证*</span>
			<input type="text" name="idcard"  value="<?php echo $key['idcard'];?>"/>
			
		</label>
		<label class="col col_l">
			<span>微信*</span>
			<input type="text" name="openid" placeholder="请输入微信账号" value="<?php echo $key['openid'];?>"/>
		</label>
		<label class="col q">
			<span>QQ*</span>
			<input type="number" name="qq" placeholder="请输入常用QQ账号" value="<?php echo $key['qq'];?>"/>
		</label>
		
		<label class="col col_l">
			<span>家长姓名*</span>
			<input type="text" name="parents" placeholder="请输入家长姓名" value="<?php echo $key['parents'];?>"/>
		</label>
		<label class="col">
			<span>家长电话*</span>
			<input type="tel" maxlength="11" name="parents_phone" placeholder="请输入家长电话" value="<?php echo $key['parents_phone'];?>"/>
		</label>
		
		<label class="col col_l">
			<span>邮箱*</span>
			<input type="text" name="email" placeholder="请输入常用邮箱账号" value="<?php echo $key['email'];?>"/>
			
		</label>
		<label class="col">
			<span>注册ip*</span>
			<input type="text" name="ip"  value="<?php echo $key['ip'];?>" disabled/>
			
		</label>
		
		
		<!-- <?php if ($key['type']==0){ ?> -->
		<label>
			<span style="float:none">选择合作机构*</span>
			<span  class="vs-district subsite" style="max-width: 150%;float: none;height:auto;" >
				<span class="target">
					<!-- <?php if ($key['sid']==0){ ?> -->
					<p style="color: red;"> 注:机构加盟此项可不必选择</p>
					<a class="cur" data='choose'>请选择</a><span class="into_btn" style="margin-left: 20px;">进入了解个琴行</span>
					<ul>
						<!-- <?php if (!empty($school['list'])){ ?> -->
						<!-- <?php foreach ((array)$school['list'] as $k) { ?> -->
						<li data="<?php echo $k['sid'];?>"><?php echo $k['name'];?></li>
						<!-- <?php } ?> -->
						<!--<?php }else{ ?>-->
						<li data="0">维颂科技</li>
						<!--<?php } ?>-->
					</ul>
					<!-- <?php }else{ ?> -->
					<input type="text" disabled class="inputsid"  value="<?php echo $edu[0]['name'];?>"/>
					<!-- <?php } ?> -->
				</span>
			</span>
		</label>
		<!-- <?php } ?> -->
		
		<span style="display:block;">所在地址*</span>
		<!-- <?php if ($key['province']){ ?> -->

		<span class="vs-district address" value="<?php echo getDistrict($key);?>" ></span>
		<!-- <?php }else{ ?> -->
		<span class="vs-district address"></span>
		<!-- <?php } ?> -->
		<label class="address_l">
			<input type="text" name="address" placeholder="请输入街道及门牌号" value="<?php echo $key['address'];?>"/>
		</label>
		<label class="personinfo">
			<span>个人简介*</span>
			<textarea form="manageBox" maxlength="100" name="summery" placeholder="请输入个人简介（100字以内）"><?php echo $key['summery'];?></textarea>
			<span class="words">0/100字</span>
		</label>
		<div><span id="manageSubmit" class="mbtn"/>保存</span></div>	
	</form>
	<!-- <?php } ?> -->
	<div class="show-block">
		<span class="close-show-block"></span>
		<div class="show-info-school" style="text-align: center;">
			<!-- <?php foreach ((array)$school['list'] as $k) { ?> -->
			<a onclick="window.open('<?php echo $this->url(('../subsite/home/index/'.$k['uid']));?>')">
				<div class="show-infos">
					<div class="show-infos-img">
						<img src="<?php echo $_G['dir'];?>public/images/member/school-infos.png"/>
					</div>
					<div class="show-infos-name"><?php echo $k['name'];?></div>
					<div class="show-infos-adress"><?php echo $k['district'];?></div>
					<div class="show-infos-fo">了解详情</div>
				</div>
			</a>
			<!--<?php } ?>-->
			
			
		</div>
	</div>
<?php include $this->compile('common/footer'); ?>
<!--<?php }else{ ?>
<?php header('location:'.$this->url('../main/common/login')); ?>
<?php } ?>-->