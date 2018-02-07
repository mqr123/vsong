<?php
session_start();
if(!empty($this->param[0])&&$this->param[0]=='post'){
	$username=$_G['user']['username'];
	$form=$this->form('user');
	$password1=$form->data['password'];
	$db=new DB('user');
	$school = new DB('school');
	$where="username='$username'";
	$user=$db->field('password,salt')->where($where)->search();
	$where1 = 'uid='.$_G['user']['uid'];
	$stats = $school->field('stats')->where($where1)->search();
	
	if($stats[0]['stats']!=2){
		$result=array('type'=>'error','msg'=>'目前您你机构处于审核中，不能进入');	
	}else{
		$password=md5(md5($password1).$user[0]['salt']);
		if($password!=$user[0]['password']){
			$result=array('type'=>'error','msg'=>'密码错误');
		}else{
			$_SESSION['school_user']=$username;
			$result=array('type'=>'success','msg'=>'验证通过');
			$this->cookie('is_school_session', isset($_SESSION['school_user'])?$_SESSION['school_user']:'');
		}	
	}
	$this->json($result,1);exit;
}
$this->display();