<?php
if(!empty($this->param[0])&&$this->param[0]=='username'){
	$username=isset($_POST['username'])?trim($_POST['username']):'';
	$db=new DB('user');
	$res=$db->field('uid')->where("`username`= $username and stats=0")->search(0);
	if(!empty($res)){
		$result=array('type'=>'success','msg'=>'用户名已存在');
		$this->json($result,1);
	}
	
}else if(!empty($this->param[0])&&$this->param[0]=='phone'){
	$phone=isset($_POST['phone'])?$_POST['phone']:'';
//	var_dump($phone);
//	die;
	$db=new DB('user');
	$res=$db->field('uid')->where("`phone`=$phone and stats=0")->search(0);
	if(!empty($res)){
		$result=array('type'=>'success','msg'=>'手机号已存在');
		$this->json($result,1);
	}	
}
?>