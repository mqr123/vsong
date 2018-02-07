<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/header'); ?>
<!--<?php foreach ((array)$data['list'] as $key) { ?>-->
	<form action="<?php echo $this->url(('home/index/post'));?>" id="school-btn">
		<div class="school-box">
			<!--<?php if ($key['aid']==0){ ?>
			<?php }else{ ?>-->
			<label>
				<div class="item">
					<span>代理商AID</span><span>*</span>
					<div class="school-ipt">
						<input type="text" name="aid" value="<?php echo $key['aid'];?>"/>
					</div>
				</div>
			</label>
			<!--<?php } ?>-->
			<label>
				<div class="label">
					<div class="item"><span>机构名称</span><span>*</span></div>
					<div class="school-ipt">
						<input type="text" name="name" value="<?php echo $key['name'];?>"/>
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>法人姓名</span><span>*</span></div>
					<div class="school-ipt">
						<input type="text" name="ceo" value="<?php echo $key['ceo'];?>"/>
					</div>
				</div>
			</label>
			<label>
				<div class="label">
					<div class="item"><span>联系电话</span><span>*</span></div>
					<div class="school-ipt">
						<input type="text" name="tel" value="<?php echo $key['tel'];?>">
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>学生数量</span><span>*</span></div>
					<div class="school-ipt">
						<input type="text" name="volume" disabled value="<?php echo $key['volume'];?>"/>
					</div>
				</div>
			</label>
			
			<label>
				<div class="label">
					<div class="item"><span>申请时间</span><span>*</span></div>
					<div class="school-ipt">
						<input disabled value="<?php echo date('Y-m-d',$key['dateline']);?>"/>
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>到期时间</span><span>*</span></div>
					<div class="school-ipt">
						<input disabled value="<?php echo date('Y-m-d',$key['dateout']);?>"/>
					</div>
				</div>
			</label>
			<label>
				<div class="label">
					<div class="item"><span>审核时间</span><span>*</span></div>
					<div class="school-ipt">
						<input disabled value="<?php echo date('Y-m-d',$key['update']);?>"/>
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>审核状态</span><span>*</span></div>
					<div class="school-ipt">
						<!-- <?php if ($key['stats']==0){ ?> -->
						<input type="text" disabled  value="审核中"/>
						<!-- <?php }else if ($key['stats']==1){ ?> -->
						<input type="text" disabled  value="审核未通过"/>
						<!-- <?php }else if ($key['stats']==2){ ?> -->
						<input type="text" disabled  value="审核通过"/>
						<!-- <?php } ?> -->
					</div>
				</div>
			</label>
			<label>
				<div class="label l">
					<div class="item"><span>所在地址</span><span>*</span></div>
					<div class="district">
						<span class="vs-district"  value="<?php echo getDistrict($key);?>" style="margin:20px auto"></span>
					</div>
				</div>
				<div class="label r">
					<div class="item"><span>街道</span><span>*</span></div>
					<div class="ipt school-ipt">
						<input type="text" name="address" value="<?php echo $key['address'];?>" />
					</div>
				</div>
				<!--<div class="laber r">
					
				</div>-->
			</label>
			<div class="summery-box">
				<div class="item" style="padding-bottom: 1%;"><span>机构简介</span><span>*</span></div>
				
				<textarea form="school-btn" maxlength="300" name="summery" class="text-box"><?php echo $key['summery'];?></textarea>
				<span class="words"></span>
			</div>
			<div class="up_load">
				<div class="item"><span class="item_span">营业执照 </span><span>*</span></div>
				<label class="btn ilb upload" style="background: url(/<?php echo $key['license'];?>);background-size: 100% 100%;">
					<input type="file" id="license" name="license" class="hide">
				</label>
				<!--<img src="/<?php echo $key['license'];?>" style="width: 100px;height: auto;">-->
			</div>
			<div class="schBtn">
				<div class="school_btn">保存</div>
			</div>
		</div>
	</form>
	<!--<?php } ?>-->
<?php include $this->compile('common/footer'); ?>