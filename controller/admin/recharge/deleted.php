<?php
//获取一个参数来作为 page
$recharge=new DB('member_recharge');
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$data = $recharge->field('*')
	->where('stats=-1')
	->order('time', TRUE)
    ->limit(6, $page)
    ->select();
	if(!empty($data['list'])){
		$this->assign('data', $data);
		$this->display();
	}else{
		$this->display();
	}

?>