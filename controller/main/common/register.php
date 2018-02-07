<?php
if(!empty($this->param[1]) && $this->param[0] == 'post'){
	if($this->param[1] != $this->ecode)$this->msg('非法操作');
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
	$form = $this->form('user');
	
	$ip = $this->clientIP();
	
	#加密用户密码
	$salt		= $this->formhash();
	$username	= isset($form->data['username'])?$form->data['username']:'';
	$gender		= isset($form->data['gender'])?$form->data['gender']:0;
	$password	= md5(md5($form->data['password']).$salt);

	#处理结果提示
	$success	= '注册成功';
	$error		= '注册失败';
	
	if(!isset($form->data))$this->msg('表单错误');
	#
	$smsCode	= !empty($form->data['smscode'])?$form->data['smscode']:'';
	
	if(!$smsCode)$this->msg('手机验证码不能为空');
	
	$where = "`ip`='$ip' and `phone`='".$form->data['phone']."' and `code`='$smsCode' and `used`='0'";
	$db =  new DB('sms');
	$code = $db->where($where)->field('code')->search(0);
	if(empty($code['code']))$this->msg('手机验证码无效或已过期');

	#验证表单hash值
	$form->hash('formhash')
		
		#验证码
		#->verify('vcode',$this->cookie('vcode'))
		
		#表单验证
		->check($check)

	
		#数据唯一性
		->only('username,phone', false, '用户名或手机已被其他用户注册')
	
		#设置表单项
		->set('ip', $ip)
		->set('dateline', time())
		->set('salt', $salt)
		->set('password', $password);

	
	#提交表单
	$form->pack('username,password,phone,gender,ip,salt,dateline')->submit('insert', $success, $error);
	
	$result = $form->result();

	#将短信验证码设为已使用状态
	if($result['type'] == 'success'){
		
		#短信验证设为已使用
		$this->form('sms',$where,array('used'=>1))->submit('update');
		
		if(!empty($result['data']['id'])){
			$uid = $result['data']['id'];
			#写入等级表
			$ins = new DB('member_level');
			$ins->insert(array('uid'=>$uid),1);
			
			$this->cookie('author',"$uid\t$username\t$gender\t0\t0",3600);
			$result['data'] = array(
				'uid'		=> $uid,
				'username'	=> $username,
				'gender'	=> $gender,
				'type'		=> 0,
				'group'		=> 0,
				'level'		=> 0,
				'exp'		=> 0,
				'score'		=> 0,
				'multiple'	=> 1,
				'number'	=> 0
			);
		}
	}
	
	#输出处理结果
	$this->json($result,1);
	exit;
}
$this->display();