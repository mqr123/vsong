<?php
if(!empty($this->param[0])&&$this->param[0]=='sum'){
	$uid=is_numeric(trim($_POST['uid']))?trim($_POST['uid']):'';
	if($uid==''){
		$where='stats=0';
	}
	else{
		$where="`uid`=$uid and stats=0";
	}
	$mbuy=new DB('member_buy');
	$sum=$mbuy->field('sum(price) as sum')->where($where)->search();
	$buy=$mbuy->field('count(*) as buy')->where($where)->search();
	$page = isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
	$data = $mbuy->field('*')
		->where($where)
		->order('dateline', TRUE)
    	->limit(6 , $page)
    	->select();
	if(!empty($data['list'])){
		$this->assign('data', $data);
		$this->assign('sum', $sum);
		$this->assign('buy', $buy);
		$this->display();
	}else{
		$this->display();
	}
	
}else{
//获取一个参数来作为 page
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$user	= new DB('member_buy');
$sum=$user->field('sum(price) as sum')->search();
$buy=$user->field('count(*) as buy')->search();
$data = $user->field('*')
	->where("stats=0")
	->order('dateline', TRUE)
    ->limit(6, $page)
    ->select();
	if(!empty($data['list'])){
		$this->assign('data', $data);
		$this->assign('sum', $sum);
		$this->assign('buy', $buy);
		$this->display();
	}else{
		$this->display();
	}
}  
