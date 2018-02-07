<?php
//按用户名手机号模糊查询
$user	= new DB('user as a','member as b','school as c');
$page	= isset($this->param[1]) && is_numeric($this->param[1])?$this->param[1]:1;
if(!empty($this->param[1])&&$this->param[1]=='post'){	
	$search = trim($_POST['search']);
	$field='username';
	if(is_numeric($search)){
		$field = 'phone';
	}
	$where= "a.uid=b.uid and (b.sid=0 or b.sid=c.sid) and $field like '%$search%'";
	$data   = $user->field('a.username,a.uid,a.phone,a.type,b.sid,a.gender,c.name,a.stats')
			->where($where)
			->order('a.uid','desc')
			->group('a.username')
    		->limit(6, $page)
			->select();
	 $this->assign('data', $data);
	 $this->assign('school', $search);
	 $this->display();
}
//查询数量
else if(!empty($this->param[0])&&$this->param[0]=='num'){
	$num =$_POST['num'];
	if($num!=''){
		$type=$num=='_member'?0:1;
		$where= "a.uid=b.uid and (b.sid=0 or b.sid=c.sid) and type=$type";
	}else{
		$where= "a.uid=b.uid and (b.sid=0 or b.sid=c.sid)";
	}
		$data   = $user->field('a.username,a.uid,a.phone,a.type,b.sid,a.gender,c.name,a.stats')
			->where($where)
			->order('a.uid','desc')
			->group('a.username')
	    	->limit(6, $page)
			->select();
	 	$this->assign('data', $data);
	 	$this->assign('school', $num);
	 	$this->display();
}
else{
	$school=isset($this->param[0])&&$this->param[1]!='ye'?$this->param[0]:'ye';
	if($school=='ye'){
		$where= "a.uid=b.uid and (b.sid=0 or b.sid=c.sid)";	
	}
	else if($school=='_member'||$school=='_school'){
		$type=$school=='_member'?0:1;
		$where= "a.uid=b.uid and (b.sid=0 or b.sid=c.sid) and type=$type";
	}
	else{
	$field='username';
	if(is_numeric($school)){
		$field = 'phone';
	}
	$where= "a.uid=b.uid and (b.sid=0 or b.sid=c.sid) and $field like '%$school%'";
}
	$data   = $user->field('a.username,a.uid,a.phone,a.type,b.sid,a.gender,c.name,a.stats,c.stats')
		->where($where)
		->order('a.uid','desc')
		->group('a.username')
    	->limit(6, $page)
		->select();
if(!empty($data['list'])){
	 $this->assign('data', $data);
	 $this->assign('school', $school);
	 $this->display();
 
}
else{
	//有用户未加盟机构的情况
	$users=new DB('user as a','member as b');
	$data=$users
		 ->field('a.username,a.uid,b.sid,a.phone,a.gender,a.dateline,a.type')
		 ->where('a.type=0 and a.uid=b.uid')
		 ->group('a.username')
		 ->select();
	$this->assign('data', $data);
//	var_dump($data);
//	die;
	$this->assign('school', $school);
	$this->display();
	}
}