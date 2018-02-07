<?php
//var_dump(!empty($this->param[1]));
//die;
if(!empty($this->param[0])  && strlen($this->param[0]) === 32){
	#用户表名
	$table = 'user';
	#得到表单数据
	$post = $this->form($table)->data; 
	
	#判断是否传入帐号
	if(empty($post['account']) || mb_strlen($post['account'])< 3){
		unset($post);
		$this->msg('帐号不能小于 3 个字符');
		
	}
	#判断是否传入密码
	if(empty($post['password']) || strlen($post['password'])<6){
		unset($post);
		$this->msg('密码不能小于 6 个字符');
	}
	#判断字段
	$field = 'username';
	if(is_numeric($post['account'])){
		$field = strlen($post['account']) == 11?'phone':'uid';
	}
	#查找用户
	$user = new DB('user as u','member_level as l');
	$user->field('u.*,l.level,l.score,l.exp,l.number,l.multiple');
	$data = $user->where("u.$field='".$post['account']."' and u.uid=l.uid")->search(0);
	#用户不存在
	if(!$data){
		unset($post,$user,$data);
		$this->msg('用户不存在');
	}
	#伪删除用户
	if($data['stats'] == -1){
		unset($post,$user,$data);
		$this->msg('该帐号被禁止登陆，请联系管理员了解原因！');
	}
	#验证密码
	if($data['password'] != md5(md5($post['password']).$data['salt'])){
		unset($post,$user,$data);
		$this->msg('密码不正确');
	}
	
	//添加日志信息      
	$form=$this->form('sign_log');
	$form->set('ip',$this->clientIP())
		 ->set('uid',$data['uid'])
		 ->set('dateline',time())
		 ->pack('ip,uid,dateline')
		 ->submit('insert');
	
	
	#储存cookie
	$this->cookie('author', $data['uid']."\t".$data['username']."\t".$data['gender']."\t".$data['type']."\t".$data['group'],3600);
	#查看机构的审核状态，并存储为cookie
	if($data['type'] >= 1){
		$db = new DB('school');
		$stats = $db->where("`uid`='".$data['uid']."'")->field('stats')->search(0,'stats');
		
		$this->cookie('school_stats',$stats,3600);
	}
	unset($post,$user,$data['password'],$data['salt'],$data['phone'],$data['ip'],$data['stats']);
	$this->msg('登录成功','success',array(
		'data' =>array(
			'uid'		=> $data['uid'],
			'username'	=> $data['username'],
			'gender'	=> $data['gender'],
			'group'		=> $data['group'],
			'type'		=> $data['type'],
			'level'		=> $data['level'],
			'exp'		=> $data['exp'],
			'score'		=> $data['score'],
			'multiple'	=> $data['multiple'],
			'number'	=> $data['number'],
			
		)
	));
}
$this->display();
exit;
//echo $this->json(array('type'=>'error','msg'=>'非法操作'));exit;