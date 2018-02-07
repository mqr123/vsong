<?php exit;?>	<div class="details">
	<!---->
<nav>
	<div class="det-headImage">
		<div class="det-img">
			<img src="/school/../avatar/big/10017/0"/>
		</div>
		<span class="stu-sex">
			<i class="icon_s icon-gender" gender="0"></i>
		</span>
	</div>
		<a class="btn pjax s" href="/school/home/stuInfo/10017">个人资料</a>
		<a class="btn pjax s" href="/school/home/log/10017">学习记录</a>
		<a class="btn pjax s" href="/school/home/can/10017">仓库管理</a>
		<a class="btn pjax s" href="/school/home/buy/10017">购买记录</a>
		<a class="btn pjax s" href="/school/home/recharge/10017">充值记录</a>
	    <a href="/school/home/student" class="btn pjax" style="float: right;">返回</a>
</nav>
		<!--  -->
		<form action="/school/home/stuInfo/10017-post" id="details-box">
			<div class="details-cont">
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>用户名</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="username" value="bbbbbb"/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>手机号</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="phone" value="13772811380"/>
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>姓名</span><span>*</span></div>
						<div class=" detail-ipt">
							<input type="text" name="realname" value="微熊"/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>年龄</span><span>*</span></div>
						<div class=" detail-ipt">
							<input type="text" name="age" value=""/>
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>身份证号</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="idcard" value="610121198606192244"/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>邮箱</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="email" value=""/>
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>微信</span></div>
						<div class="detail-ipt">
							<input type="text" name="openid" value=""/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>QQ</span></div>
						<div class="detail-ipt">
							<input type="text" name="qq" value=""/>
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="label">
						<div class="item"><span>家长姓名</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="parents" value=""/>
						</div>
					</div>
					<div class="label r">
						<div class="item"><span>家长电话</span><span>*</span></div>
						<div class="detail-ipt">
							<input type="text" name="parents_phone" value=""/>
						</div>
					</div>
				</div>
				
				<div class="det-conts">
					<div class="item"><span>所在地址</span><span>*</span></div>
					<div class="district">
						<!--  -->
						<span class="vs-district" id="vsDistrict1" style="margin:20px auto"></span>
						<!--  -->
						<div class="detail-ipt">
							<input class="detIpt" type="text" name="address" value=""  placeholder="请输入具体门牌号" />
						</div>
					</div>
				</div>
				<div class="det-conts">
					<div class="item"><span>个人简介</span></div>
					<textarea class="summary" name="summery" placeholder="100字以内" form="details-box"></textarea>
				</div>
				<div class="det-conts">
					<div class="etails_btn btn">保存</div>
				</div>
			</div>
		</form>
		<!--  -->
	</div>
