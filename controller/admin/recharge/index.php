<?php
if(!empty($this->param[0])&&$this->param[0]=='sum'){
	$uid=is_numeric(trim($_POST['uid']))?trim($_POST['uid']):'';
	if($uid==''){
		$where='stats=0';
	}
	else{
		$where="`uid`=$uid and stats=0";
	}
	$recharge=new DB('member_recharge');
	$sum=$recharge->field('sum(amount) as sum')->where($where)->search();
	$total=$recharge->field('count(*) as total')->where($where)->search();
	$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
	$data = $recharge->field('*')
		->where($where)
		->order('time', TRUE)
    	->limit(6 , $page)
    	->select();
	if(!empty($data['list'])){
		$this->assign('data', $data);
		$this->assign('sum', $sum);
		$this->assign('total',$total);
		$this->display();
	}else{
		$this->display();
	}
	
}else{
//获取一个参数来作为 page
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$recharge	= new DB('member_recharge');
$sum=$recharge->field('sum(amount) as sum')->where('stats=0')->search();
$total=$recharge->field('count(*) as total')->where('stats=0')->search();
$data = $recharge->field('*')
	->where('stats=0')
	->order('time', TRUE)
    ->limit(6, $page)
    ->select();

	
	if(!empty($data['list'])){
		$this->assign('data', $data);
		$this->assign('sum', $sum);
		$this->assign('total',$total);
		$this->display();
	}else{
		$this->display();
	}
}  
