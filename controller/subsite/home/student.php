<?php
$uid=isset($this->param[0])&&is_numeric($this->param[0])?$this->param[0]:'';

//关于我们
if(empty($uid)){
	$uid=!empty($_G['user']['uid'])?$_G['user']['uid']:0;
}else{
$_G['uid']=$uid;
}

$db=new DB('school');
$member=new DB('school as a','member as b','user as c');
$sid=$db->field('sid')->where("uid=$uid")->search();
$sid=!empty($sid)?$sid[0]['sid']:-1;
$data=$member->field('c.username,b.age')
			->where("c.stats=0 and c.type=0 and c.uid=b.uid and b.sid=$sid")
			->limit(4,1)
			->group('c.username')
			->select();
$this->assign('data',$data);
$this->display();