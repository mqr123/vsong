<?php
if(!empty($this->param[0])){
	$uid=$this->param[0];
	$page= isset($this->param[1]) && is_numeric($this->param[1])?$this->param[1]:1;
	$data=new DB('member_buy');
	$result=$data->where("`uid`=$uid and `stats`=0")->limit(10,$page)->select();
	$this->assign('data',$result);
	$this->assign('uid',$uid);
	$this->display();
}