<?php
//获取一个参数来作为 page
$log=new DB('member_log');
$page	= isset($this->param[1]) && is_numeric($this->param[1])?$this->param[1]:1;
$uid=isset($this->param[0])?$this->param[0]:0;
$data = $log->field('*')
	->where("`uid`=$uid and `stats`=-1")
    ->limit(6, $page)
    ->select();
	if(!empty($data['list'])){
		$this->assign('data', $data);
		$this->assign('uid',$uid);
		$this->display();
	}else{
		$this->assign('uid',$uid);
		$this->display();
	}
?>