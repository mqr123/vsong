<?php
$page	= isset($this->param[1]) && is_numeric($this->param[1])?$this->param[1]:1;
$user	= new DB('user as a','member as b','school as c');
$school = isset($this->param[0])?$this->param[0]:'ye';
if($school!='ye'){
		$where="a.stats=0 and a.type=0 and a.uid=b.uid and b.sid=c.sid and c.name='$school'";
	}else{
		$where="a.stats=0 and a.type=0 and a.uid=b.uid and (b.sid=0 or b.sid=c.sid)";
	}
if(!empty($this->param[0])&&$this->param[0]=='post'){
	$search=trim($_POST['school']);
	if($search!=''){
		$where1="a.stats=0 and a.type=0 and a.uid=b.uid and b.sid=c.sid and c.name='$search'";
	}else{
		$where1="a.stats=0 and a.type=0 and a.uid=b.uid and (b.sid=0 or b.sid=c.sid)";
		
	}
	if($search!=''){
		$user_num = $user->field('count(*)')
			->where($where1)
			->group('a.username')
			->search();
		$this->assign('user_num', count($user_num));
	}
	$data   = $user->field('a.username,a.uid,a.phone,a.type,b.sid,a.gender,c.name,a.stats')
			->where($where1)
			->order('a.uid','desc')
			->group('a.username')
	    	->limit(6, $page)
			->select();

	if($search!=''){ //查询已加盟机构名称，看该机构下学员充值额与消费额
		$arr=array();
		$res=$data['list'];
		foreach($res as $k=>$v){
			array_push($arr,$v['uid']);
		}	
		$str=implode(',',$arr);
		if($str!=''){
			$db=new DB('member_recharge');
			$recharge=$db->field("sum(amount) as sum")->where("uid in ($str)")->search();
			$recharge=!empty($recharge)?$recharge[0]['sum']:0;
			$db_buy=new DB('member_buy');
			$buy=$db_buy->field("sum(price) as buy")->where("uid in ($str)")->search();
			$buy=!empty($buy)?$buy[0]['buy']:0;
		}else{
			$recharge=0;
			$buy = 0;
		}
		 $this->assign('recharge', $recharge);
		 $this->assign('buy', $buy);
	}
		 $this->assign('data', $data);
		 $this->assign('search', $search);
		 
		 $this->display();
		
}
else{
$data   = $user->field('a.username,a.uid,a.phone,a.type,b.sid,a.gender,c.name,a.stats')
		->where($where)
		->order('a.uid','desc')
		->group('a.username')
	    ->limit(6, $page)
		->select();
if(!empty($data['list'])){
	 $this->assign('data', $data);
	 $this->assign('search', $school);
	 $this->display();
 
}else{
	//如果无机构.但是有用户
	$users=new DB('user as a','member as b');
	$data=$users
		 ->field('a.username,a.uid,b.sid,a.phone,a.gender,a.dateline,a.type')
		 ->where('a.type=0 and a.uid=b.uid')
		 ->select();
	$this->assign('data', $data);
	$this->display();
	}
}

#+-------------------------------------------------------+

#设置页面缓存
#$this->setConfig('cache', true);

//setCacheHeader(300,'text/html;charset=utf-8',"userlist-$page.html");//设置浏览器缓存

