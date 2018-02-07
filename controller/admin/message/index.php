<?php
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$message = new DB('sys_admin as a','member as b','message as c','user as d');
$data = $message->field('c.*,a.username,b.realname')
			  ->where("c.from=a.id and c.to=d.uid or c.to=b.uid")
			  ->limit(10,$page)
			  ->group('id')
			  ->select();
//总消息记录	
$msg = new DB('message');		  
$nums = $msg->field('count(*) as msgs')->search();

$noread = $msg->field('count(*) as msgs')->where('stats=0')->search();
$read = $msg->field('count(*) as msgs')->where('stats=1')->search();
//var_dump($noread);exit;

$this->assign('data',$data);
$this->assign('nums',$nums);
$this->assign('noread',$noread);
$this->assign('read',$read);

$this->display();
?>