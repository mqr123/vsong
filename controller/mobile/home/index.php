<?php
//优秀学员展示
$member=new DB('member_recharge');
$data=$member->field('uid')->where('amount>=100 and stats=0')->search();
if(!empty($data)){
$arr=array();
foreach($data as $v)array_push($arr,$v['uid']);
$uid=implode(',',array_slice(array_unique($arr),0,6));
$db=new DB('member as a','user as b');
$realname=$db->field('a.realname')->where("a.uid=b.uid and a.uid in ($uid) and b.stats=0")->search();
}else{
	$realname='';
}

//优秀机构展示
	$schools=new DB('school as a','user as b');
	$u=$schools->field('a.uid')->where("a.volume>50 and b.stats=0 and a.uid=b.uid and a.stats=2")->search();
//	var_dump($u);
	
	if(empty($u)){
		$school='';
	}else{
		//获取机构下的学员的数量
		$school1=new DB('school as a','member as b');
		$arr=array();
		$arr_school=array();
		foreach($u as $v)array_push($arr,$v['uid']);
		foreach($arr as $val){
			$data=$school1->field('b.uid')
						 ->where("a.uid!=b.uid and a.sid=b.sid and a.uid=$val")
						 ->group('b.uid')
						 ->search();
			$arr1=array();
			foreach($data as $v)array_push($arr1,$v['uid']);
			$str=implode(',',$arr1);
			$db=new DB('user');
			$d=$db->field('uid')->where("uid in ($str) and stats=0")->search();
			$recharge=new DB('member_recharge');
			$arr_uid=array();
			for($i=0;$i<count($d);$i++){
				$uid=$d[$i]['uid'];
				$num=$recharge->field('uid')
				->where("uid=$uid and stats=0")
				->group('uid having sum(amount)>=200')
				->search(0);
				if(isset($num['uid'])){
					array_push($arr_uid,$num['uid']);
				}
			}
			//该机构下的每个学员充值数量是否超过200
			if(count($d)<=count($arr_uid)){
					$sid_name=new DB('member');
					$sid=$sid_name->field('sid')->where('`uid`='.$arr_uid[0])->search(0);
					$school_name=new DB('school');
					$schoolname=$school_name->field('uid,name')->where("`sid`=".$sid['sid'])->search(0);
					array_push($arr_school,$schoolname);
			}
		}
		$school=$arr_school;
}
$this->assign('realname',$realname);
$this->assign('school',$school);
$this->display();
?>