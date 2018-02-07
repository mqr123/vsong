<?php
if(!empty($this->param[0])){
	
	$uid=$this->param[0];

	$where		="`uid`=$uid and stats=0";
	$page		= isset($this->param[1]) && is_numeric($this->param[1])?$this->param[1]:1;
	$recharge	= new DB('member_recharge');
	$sum		= $recharge->field('sum(amount) as sum')->where($where)->search();

	$data 		= $recharge->field('*')
				->where($where)
				->order('time', TRUE)
			   	->limit(6, $page)
			    ->select();
	$this->assign('sum', $sum[0]['sum']?$sum[0]['sum']:0);
	if(!empty($data['list'])){
		$this->assign('data', $data);
		$this->assign('uid',$uid);
		$this->display();
	}else{
		$this->assign('uid',$uid);
		$this->display();
	}
	
}