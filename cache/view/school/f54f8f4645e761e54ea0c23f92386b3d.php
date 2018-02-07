<?php exit;?>	<div class="details">
		<!---->
<nav>
	<div class="det-headImage">
		<div class="det-img">
			<img src="/school/../avatar/big/10003/0"/>
		</div>
		<span class="stu-sex">
			<i class="icon_s icon-gender" gender="0"></i>
		</span>
	</div>
		<a class="btn pjax s" href="/school/home/stuInfo/10003">个人资料</a>
		<a class="btn pjax s" href="/school/home/log/10003">学习记录</a>
		<a class="btn pjax s" href="/school/home/can/10003">仓库管理</a>
		<a class="btn pjax s" href="/school/home/buy/10003">购买记录</a>
		<a class="btn pjax s" href="/school/home/recharge/10003">充值记录</a>
	    <a href="/school/home/student" class="btn pjax" style="float: right;">返回</a>
</nav>
		<form action="/school/home/log/del" id="logForm">
			<input type="hidden" name="formhash" value="54ec738d" />
			<div class="log-wrap">
				<table border="1" cellspacing="1" cellpadding="1">
					<tr>
						<th>教育模式</th>
						<th>开始时间</th>
						<th>得分</th>
						<th>力度</th>
						<th>速度</th>
						<th>准确度</th>
						<th>音准</th>
						<th>节拍(乐感)</th>
						<th>结束时间</th>
						<th>操作</th>
					</tr>
					<!---->
					<tr data-id ="2">
						<!---->
						<td>教学模式</td>
						<!---->
						<td>2017-10-11 10:37:26</td>
						<td>70.00</td>
						<td>60.00</td>
						<td>0.00</td>
						<td>0.00</td>
						<td>0.00</td>
						<td>0.00</td>
						<td>2017-10-11 10:39:06</td>
						<td><a class="btn logBtn">删除</a></td>
					</tr>
					<!---->
					<tr data-id ="3">
						<!---->
						<td>教学模式</td>
						<!---->
						<td>2017-10-11 11:39:06</td>
						<td>85.00</td>
						<td>90.00</td>
						<td>0.00</td>
						<td>0.00</td>
						<td>0.00</td>
						<td>0.00</td>
						<td>2017-10-11 11:39:06</td>
						<td><a class="btn logBtn">删除</a></td>
					</tr>
					<!---->
				</table>
					<div class="ma-pager">
					<a href="/school/home/log/10003" class="btn pjax">首页</a>
					<a class="btn prev-page">上一页</a>
					<!---->
										<a class="btn open">第1页</a>
										<!---->
					<a class="btn pjax next-page">下一页</a>
					<a id="next-num" href="/school/home/log/10003-1" class="btn pjax">尾页</a>
				</div>
				
			</div>
		</form>
	</div>
