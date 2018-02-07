<?php
$uid=$_G['user']['uid'];
$where="uid=$uid";
$form=$this->form('user',$where);
$db=new DB('user');
$res=$db->field('password,salt')->where($where)->search(0);
if($res['password']!=md5(md5($form->data['prePwd']).$res['salt'])){
	$result=array('type'=>'error','msg'=>'旧密码错误');
}else{
	$success='修改成功';
	$error='修改失败';
	$salt=$this->formhash();
	$password=md5(md5($form->data['password']).$salt);
	$form->set('password',$password)
		 ->set('salt',$salt)
		 ->pack('password,salt')
		 ->submit('update',$success,$error);
	$result=$form->result();
	if($result['type']=='success'){
		$this->clear('user as a,vs_member as b');
	}	
}
$this->json($result,1);exit;
?>