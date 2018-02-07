<?php
//验证学员的账号与手机号  是否存在
if(!empty($this->param[0])&&$this->param[0]=='username'){
	$username=isset($_POST['username'])?$_POST['username']:'';
	$db=new DB('user');
	$res=$db->field('uid')->where("`username`=$username and stats=0")->search(0);
	if(!empty($res)){
		$result=array('type'=>'success','msg'=>'用户名已存在');
		$this->json($result,1);
	}
	
}else if(!empty($this->param[0])&&$this->param[0]=='phone'){
	$phone=isset($_POST['phone'])?$_POST['phone']:'';
	$db=new DB('user');
	$res=$db->field('uid')->where("`phone`=$phone and stats=0")->search(0);
	if(!empty($res)){
		$result=array('type'=>'success','msg'=>'手机号已存在');
		$this->json($result,1);
	}
	
}
?>