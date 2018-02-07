<?php
if(!empty($this->param[0])){
	$uid=$this->param[0];
	$data=new DB('user');
	$result=$data->where('uid='.$uid)->select();
	var_dump($result['list'][0]['ip']);
	
	
	
	
	$this->assign('data',$result);
	$this->display();
}