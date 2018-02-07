<?php
$page	= isset($this->param[1]) && is_numeric($this->param[1])?$this->param[1]:1;
$user	= new DB('user as a','member as b','school as c');
if(!empty($this->param[0])&&$this->param[0]=='post'){

$school=trim($_POST['school']);
	if($school!=''){
		$where="a.stats=0 and a.type=0 and a.uid=b.uid and b.sid=c.sid and c.name like '%$school%'";
	}else{
		$where="a.stats=0 and a.type=0 and a.uid=b.uid and (b.sid=0 or b.sid=c.sid)";
	}
	//var_dump($where);exit;
	$data   = $user->field('a.username,a.uid,a.phone,a.type,b.sid,a.gender,c.name,a.stats')
		->where($where)
		->order('a.uid','desc')
		->group('a.username')
	    ->limit(10, $page)
		->select();
		 $this->assign('data', $data);

		 $this->display();
}
else{
	$data   = $user->field('a.username,a.uid,a.phone,a.type,b.sid,a.gender,c.name,a.stats')
		->where('a.stats=0 and a.type=0 and a.uid=b.uid and (b.sid=0 or b.sid=c.sid)')
		->order('a.uid','desc')
		->group('a.username')
	    ->limit(10, $page)
		->select();
if(!empty($data['list'])){
	 $this->assign('data', $data);
	 $this->display();
 
}else{
	//如果无机构.但是有用户
	$users=new DB('user as a','member as b');
	$data=$users
		 ->field('a.username,a.uid,b.sid,a.phone,a.gender,a.dateline,a.type')
		 ->where('a.type=0 and a.uid=b.uid')
		 ->select();
	$this->assign('data', $data);
	$this->display();
	}
}

#+-------------------------------------------------------+

#设置页面缓存
#$this->setConfig('cache', true);

//setCacheHeader(300,'text/html;charset=utf-8',"userlist-$page.html");//设置浏览器缓存

