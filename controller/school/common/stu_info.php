<?php
//机构中某个学员的公共图像
	$uid=isset($this->param[0])&&is_numeric($this->param[0])?$this->param[0]:'';
	$db=new DB('user as a','member as b');
	$data=$db->field('a.gender')->where("a.uid=$uid and a.uid=b.uid")->search(0);
	$d=!empty($data)?$data['gender']:0;
	$this->assign('gender',$d);
	$this->assign('uid',$uid);
	 
?>