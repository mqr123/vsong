<?php
	$user=$this->form('user');
	$salt	= $this->formhash();
	$password	= md5(md5($user->data['password']).$salt);
	$success	= '增加成功';
	$error		= '增加失败';
	$username=$user->data['username'];
	$email=$user->data['email'];
	$parents=$user->data['parents'];
	$parents_phone=$user->data['parents_phone'];
	$user
	// ->hash('formhash')
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
		
		$users=new DB('user');
		$data=$users->field('uid')->where("username='$username'")->search();
		$uid=$_G['user']['uid'];
		$school=new DB('school');
		$res=$school->field('sid,volume')->where("uid=$uid")->search();
		$sid=$res[0]['sid'];
		$res[0]['volume']++;
		
		$volume=$res[0]['volume'];
		$school->where("uid=$uid")->update(array('volume'=>$volume));
		$this->clear('school');
		$member = new DB('member');
		$arr=array('uid'=>$data[0]['uid'],
				   'sid'=>$sid,
				   'email'=>$email,
				   'parents'=>$parents,
				   'parents_phone'=>$parents_phone,
					);
		$member -> insert($arr,1);
		$db = new DB('member_level');
		$db->insert(array('uid'=>$data[0]['uid']),1);
		$re = $user->result();
		
		if($re['type'] == 'success'){
			$this->clear('user as a,vs_member as b');
			}
			echo $this->json($result);exit;
		}
		echo $this->json($result);exit;