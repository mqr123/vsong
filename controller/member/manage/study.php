<?php
$uid=$_G['user']['uid'];
if(!empty($_G['param'][0])){
	$time = base64_decode($_G['param'][0]);
	$before = strtotime("$time 00:00:00");
	$after = strtotime("$time 23:59:59");
}else{
	$time = time();
	$before  = strtotime(date('Y-m-d 00:00:00', $time));
	$after  = strtotime(date('Y-m-d 23:59:59', $time));
}


$where = "`uid` = '$uid' and (`overtime`>'$before' and `overtime`<'$after')"; 
//var_dump($where);exit;
$user = new DB('member_log');

$data = $user->field('*')->where($where)->select();



$level = new DB('member_level');

$total = $level->field('*')->where("`uid` = '$uid'")->select();
//var_dump($total);exit;
#+-------------------------------------------------------+
$this->assign('data', $data);
$this->assign('total', $total);
$this->display();