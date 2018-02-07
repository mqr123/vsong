<?php
if(!empty($this->param[0])){
	$uid=$this->param[0];
	$data=new DB('member_level');
	$result=$data->where('uid='.$uid)->select();
	$this->assign('data',$result);
	$this->display();
}