<?php exit;?><!---->

<style>
.information a.btn[href="/school/home/message/read"]{font-weight: 800;}
.information a.btn[href="/school/home/message/read"]:after,
.information>nav>a.btn.op:hover:after{content: "";position: absolute;width:65px;height: 2px;background: #00A09D;margin: 42px -65px;}
</style>



	<div class="information">
		<div class="information-header">
			<nav>
				<!---->
				<a class="btn pjax op" href="/school/home/message/unread" >未读消息</a>
				<a class="btn pjax op" href="/school/home/message/read" >已读消息</a>
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
		 	<div style="position: relative;">
				<div class="reade"  data-id="1" url="/school/home/msgInfo/1">
					<div class="unRead-headimage">
						<span class="icon_s icon-unRead icon_reads"systems="2"></span>
					</div>
					<!--  -->
					<h5>维颂小秘书</h5>
					<!--  -->
					<p>法师打发</p>
					<span class="date">2017-09-30 15:24:30</span>
				</div>
				<a class="btn btn-msg" url='/school/home/deleteinfo/delete'>删除</a>
			</div>
			<!--  -->
		 	<div style="position: relative;">
				<div class="reade"  data-id="2" url="/school/home/msgInfo/2">
					<div class="unRead-headimage">
						<span class="icon_s icon-unRead icon_reads"systems="2"></span>
					</div>
					<!--  -->
					<h5>维颂小秘书</h5>
					<!--  -->
					<p>test</p>
					<span class="date">2017-10-09 17:34:10</span>
				</div>
				<a class="btn btn-msg" url='/school/home/deleteinfo/delete'>删除</a>
			</div>
			<!--  -->
		 	<div style="position: relative;">
				<div class="reade"  data-id="3" url="/school/home/msgInfo/3">
					<div class="unRead-headimage">
						<span class="icon_s icon-unRead icon_reads"systems="2"></span>
					</div>
					<!--  -->
					<h5>维颂小秘书</h5>
					<!--  -->
					<p>123</p>
					<span class="date">2017-10-11 09:38:24</span>
				</div>
				<a class="btn btn-msg" url='/school/home/deleteinfo/delete'>删除</a>
			</div>
			<!--  -->
			<div class="release-checkBox">  
			   <!---->
			   			   <a class="btn checked">第1页</a>
			   			   <!---->
			</div > 
		</div>
		</form>
		<!---->
	</div>
