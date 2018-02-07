<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/header'); ?>
	<div class="details">
	<?php include $this->compile('common/stuInfoHeader'); ?>
		<!-- <?php foreach ((array)$data['list'] as $key) { ?> -->
		<form action="<?php echo $this->url(('home/stuInfo/'.$key['uid'].'-post'));?>" id="details-box">
			<div class="details-cont">
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>用户名</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="username" value="<?php echo $key['username'];?>"/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>手机号</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="phone" value="<?php echo $key['phone'];?>"/>
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>姓名</span><span>*</span></div>
						<div class=" detail-ipt">
							<input type="text" name="realname" value="<?php echo $key['realname'];?>"/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>年龄</span><span>*</span></div>
						<div class=" detail-ipt">
							<input type="text" name="age" value="<?php echo $key['age'];?>"/>
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>身份证号</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="idcard" value="<?php echo $key['idcard'];?>"/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>邮箱</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="email" value="<?php echo $key['email'];?>"/>
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>微信</span></div>
						<div class="detail-ipt">
							<input type="text" name="openid" value="<?php echo $key['openid'];?>"/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>QQ</span></div>
						<div class="detail-ipt">
							<input type="text" name="qq" value="<?php echo $key['qq'];?>"/>
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>家长姓名</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="parents" value="<?php echo $key['parents'];?>"/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>家长电话</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="parents_phone" value="<?php echo $key['parents_phone'];?>"/>
						</div>
					</div>
				</div>
				
				<div class="det-conts">
					<div class="item"><span>所在地址</span><span>*</span></div>
					<div class="district">
						<!-- <?php if ($key['province']){ ?> -->
						<span class="vs-district" id="vsDistrict1" style="margin:20px auto" value="<?php echo getDistrict($key);?>"></span>
						<!-- <?php }else{ ?> -->
						<span class="vs-district" id="vsDistrict1" style="margin:20px auto"></span>
						<!-- <?php } ?> -->
						<div class="detail-ipt">
							<input class="detIpt" type="text" name="address" value="<?php echo $key['address'];?>"  placeholder="请输入具体门牌号" />
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="item"><span>个人简介</span></div>
					<textarea class="summary" name="summery" placeholder="100字以内" form="details-box"><?php echo $key['summery'];?></textarea>
				</div>
				<div class="det-conts">
					<div class="etails_btn btn">保存</div>
				</div>
			</div>
		</form>
		<!-- <?php } ?> -->
	</div>
<?php include $this->compile('common/footer'); ?>