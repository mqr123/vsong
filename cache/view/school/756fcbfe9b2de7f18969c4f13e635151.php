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
		<form action="/school/home/buy/del" id='buyForm'>
			<input type="hidden" name="formhash" value="54ec738d" />
			<div class="buy-wrap">
				<table border="1" cellspacing="1" cellpadding="1">
					<tr>
						<th>购买类型</th>
						<th>名称</th>
						<th>价格</th>
						<th>购买时间</th>
						<th>操作</th>
					</tr>
					<!---->
				</table>
				<div class="ma-pager">
					<a href="/school/home/buy/10017" class="btn pjax">首页</a>
					<a class="btn prev-page">上一页</a>
					<!---->
					
					<a class="btn pjax next-page">下一页</a>
					<a id="next-num" href="/school/home/buy/10017-0" class="btn pjax">尾页</a>
				</div>
			</div>
		</form>
	</div>
