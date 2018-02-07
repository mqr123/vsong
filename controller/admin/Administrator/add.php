<?php
if(!empty($this->param[0]) && $this->param[0] == 'post'){
	$check = array(
		'username'	=> array(
			'min'	=> array(3,'用户名不能小于3个字符'),
			'max'	=> array(15,'用户名不能大于3个字符'),
			'match'	=> array('/^(['.chr(0xa1).'-'.chr(0xff).']{1}|[a-zA-Z]{1})+(['.chr(0xa1).'-'.chr(0xff).']|\w|\d|_)+$/','用户名格式不正确')
			),
		'password'	=> array(
			'min'	=> array(6,'密码不能小于6个字符')
		),
		'phone'	=> array(
			'min'	=> array(11,'手机格式不正确'),
			'max'	=> array(11,'手机格式不正确'),
			'match'	=> array('/^(1[3-9]{1}[0-9]{9})$/','手机格式不正确')
		)
	);
	$form		= $this->form('sys_admin');
	$salt		= $this->formhash();
	$password	= md5(md5($form->data['password']).$salt);
	$success	= '增加成功';
	$error		= '增加失败';
	$form->hash('formhash')
		 ->check($check)
		 ->only('username,phone')
		 ->set('stats', 0)
		 ->set('password', $password)
		 ->set('salt', $salt)
		->pack('username,password,salt,phone,roleid,realname,email,birth,stats')
		->submit('insert', $success, $error);
	$result = $form->result();
	if($result['type'] == 'success'){
		$this->clear('sys_admin','data');
	}
	$this->json($result,1);
}else{
	$this->display();
}