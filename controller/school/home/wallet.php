<?php
$uid=$_G['user']['uid'];
$school=new DB('school');
$sid=$school->field('sid')->where("uid=$uid")->search(0,'sid');
$db=new DB('user as a','member as b');
$data=$db->field('a.uid')
	->where("a.stats=0 and a.type=0 and a.uid=b.uid and b.sid=$sid")
	->search();
if(empty($data)){
	$sum=0;
}else{
	$buy=new DB('member_buy');
	$arr=array();
	foreach($data as $v)array_push($arr,$v['uid']);
	$str_uid=implode(',',$arr);
	$price=$buy->field('sum(price) as sum')->where("uid in ($str_uid)")->search();
	$sum=0;
	foreach($price as $v)$sum+=$v['sum'];
//	var_dump($sum);
}

//die;
$this->assign('sum',$sum);

$this->display()
?>