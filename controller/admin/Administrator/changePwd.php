<?php
if(!empty($this->param[0])&&$this->param[0]=='post'){
	$username=$_SESSION['username'];
	$where="username='$username'";
	$admin=new DB('sys_admin');
	$result=$admin->field('password,salt')->where($where)->search();
	$form=$this->form('sys_admin',$where);
	$password1=md5(md5($form->data['password1']).$result[0]['salt']);
	if($result[0]['password']!=$password1){
		$row=array('type'=>'error','msg'=>'旧密码错误');
		echo $this->json($row);exit;
	}
	if($form->data['password']!=$form->data['password2']){
		$row=array('type'=>'error','msg'=>'两次密码不一致');
		echo $this->json($row);exit;
	}
	$check = array(
		'password'	=> array(
			'min'	=> array(6,'密码不能小于6个字符')
		),
	);
	$success='修改成功';
	$error='修改失败';
	$salt=$this->formhash();
	$password=md5(md5($form->data['password']).$salt);
	$form->hash('formhash')
		 ->check($check)
		 ->set('password',$password)
		 ->set('salt',$salt)
		 ->pack('password,salt')
		 ->submit('update',$success,$error);
	$re=$form->result();
	if($re['type']=='success'){
		$this->clear('sys_admin','data');
	}
	echo $this->json($re);exit;
}
$this->display();