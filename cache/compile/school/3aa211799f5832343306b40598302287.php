<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/header'); ?>

	<div class="student-box">
		<div class="stu-header">
   	  		<div class="add add-btn t">
   	  	 		<i class="icon_s icon-add icon_s-box"></i>
   	  	 	</div>
   	  	 	<a class="add delete-btn t btn pjax">
	   	  		
	            <form action="<?php echo $this->url(('home/student/delete'));?>" id="delete"></form>
	   	  			<i class="icon_s icon-delete icon_s-box"></i>
	   	  	 	
   	  	 	</a>
            <form action="<?php echo $this->url(('home/student/post'));?>" id="school" method="post">
   	  	 	<div class="add stu-search">
   	  	 		<div class="search-btn t">
   	  				<i class="icon_s icon-search icon_s-box"></i>
   	  	 		</div>
   	  	 		<input type="text" name="uid" id="uid" placeholder="请输入要查找学员的电话"/>
   	  	 	</div>
            </form>
   	  	</div>
   	  	<div class="stu-cont">
   	  		<div class="isDeleat">
   	  			<span class="cancelBtn">取消</span>
   	  			<span class="deleatBtn">删除</span>
   	  		</div>
   	  		
            <!-- <?php foreach ((array)$data['list'] as $key) { ?>  -->
        
   	  		<div class="students" url="<?php echo $this->url(('home/stuInfo/'.$key['uid']));?>" data-id="<?php echo $key['uid'];?>">
   	  			<i></i>
   	  			<div class="students-headImg">
   	  				<img src="<?php echo $this->url(('../avatar/big/'.$key['uid'].'/'.$key['gender']));?>"/>
   	  			</div>
   	  			<p class="student-uid"><?php echo $key['uid'];?></p>
   	  			<p class="student-name"><?php echo $key['username'];?></p>
   	  			<p class="student-phone"><?php echo substr_replace($key['phone'], '****', 3, 4);?></p>
   	  			<span class="student-right_jt">
   	  				<i class="icon_s icon-nor"></i>
   	  			</span>
   	  			<span class="student-sex">
   	  				<i class="icon_s icon-gender" gender="<?php echo $key['gender'];?>"></i>
   	  			</span>
   	  		</div>
            <!-- <?php } ?> -->
   	  		

		<div style="text-align: center; margin-top: 10px;"class="checked-box">  
		   <!--<?php for ($i=1;$i <= $data['total'];$i+=1) { ?>-->
		   <?php if ($data['page'] == $i){ ?>
		   <a class="btn checked">第<?php echo $i;?>页</a>
		   <?php }else{ ?>
		   <a class="btn pjax" href="<?php echo $this->url(('home/student/'.$i));?>">第<?php echo $i;?>页</a>
		   <?php } ?>
		   <!--<?php } ?>-->
		</div >     
	</div>
<?php include $this->compile('common/footer'); ?>