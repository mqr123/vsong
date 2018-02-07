<?php exit;?><!---->

<style>
.information a.btn[href="/school/home/message/unread"]{font-weight: 800;}
.information a.btn[href="/school/home/message/unread"]:after,
.information>nav>a.btn.op:hover:after{content: "";position: absolute;width:65px;height: 2px;background: #00A09D;margin: 42px -65px;}
</style>



	<div class="information">
		<div class="information-header">
			<nav>
				<!---->
				<a class="btn pjax op" href="/school/home/message/unread" >未读消息</a>
				<a class="btn pjax op" href="/school/home/message/read" >已读消息</a>
				<a class="btn editBtn" >编辑</a>
				<!---->
				<div class="more-edit">
					<a class="btn infor_read">设为已读</a>
					<a class="btn infor_cancel">取消</a>
				</div>
			</nav>
		</div>
		<form action="/school/home/message/post" id="isRead">
		<input type="hidden" name="formhash" value="54ec738d">
		
		<!---->
		<div class="msg-cont">
		<!--  -->
			<div class="release-checkBox">  
			   <!---->
			</div > 
		</div>
		<!---->
	</div>
