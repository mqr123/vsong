<?php
if(!empty($this->param[0]) && $this->param[0] == 'post'){
	$user=$this->form('user');
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
	$salt		= $this->formhash();
	$password	= md5(md5($user->data['password']).$salt);
	$success	= '增加成功';
	$error		= '增加失败';
	$username=$user->data['username'];
	$user->hash('formhash')
		->check($check)
		->only('username,phone')
		->set('password', $password)
		->set('salt', $salt)
		->set('type', 0)
		->set('stats', 0)
		->set('ip', $this->clientIP())
		->set('dateline', time())
		->pack('username,password,salt,phone,gender,type,ip,dateline,stats')
		->submit('insert', $success, $error);
	$result = $user->result();
	if($result['type'] == 'success'){
		$this->clear('user','userList');
		$users=new DB('user');
		$data=$users->field('uid')->where("username='$username'")->search();
		$member = new DB('member');
		$member -> insert(array('uid'=>$data[0]['uid']),1);
		$db = new DB('member_level');
		$db->insert(array('uid'=>$data[0]['uid']),1);
		
		$re = $user->result();
		
		if($re['type'] == 'success'){
			$this->clear('member','data');
			}
			echo $this->json($result);exit;
		}
		echo $this->json($result);exit;
	}
else{
	$this->display();
}