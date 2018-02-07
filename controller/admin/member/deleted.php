<?php
if(!empty($this->param[1])&&$this->param[1]=='add'){
	$uid=$this->param[0];
	$db=new DB('user');
	$result=$db->where('uid='.$uid)->update(array('stats'=>0));
	$s=new DB('member');
	$sids=$s->field('sid')->where('uid='.$uid)->search();
	if($result){
		$school=new DB('school');
		$row=$school->field('volume')->where('sid='.$sids[0]['sid'])->search();
		if(!empty($row)){
			$row[0]['volume']++;
			$volume=$row[0]['volume'];
			$a=$school->where('sid='.$$sids[0]['sid'])->update(array('volume'=>$volume));
		}else{
			echo "<script>alert('恢复成功');location.href='../listMember';</script>";
		}
		if($a){
		echo "<script>alert('恢复成功');location.href='../listMember';</script>";
	}
	}else{
		echo "<script>alert('恢复失败');location.href='../deleted';</script>";
	}
}
else{
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$user	= new DB('user as a','member as b','school as c');
$data   = $user->field('a.username,a.uid,a.phone,a.type,b.sid,a.gender,c.name,a.stats')
		->where('a.stats=-1 and a.type=0 and a.uid=b.uid and (b.sid=0 or b.sid=c.sid)')
		->order('a.uid','desc')
		->group('a.username')
	    ->limit(10, $page)
		->select();
if(!empty($data['list'])){
	 $this->assign('data', $data);
	 $this->display();
 
}else{
	//如果无机构.但是有用户
	$users=new DB('user as a','member as b');
	$data=$users
		 ->field('a.username,a.uid,b.sid,a.phone,a.gender,a.dateline,a.type')
		 ->where('a.stats=-1 and a.type=0 and a.uid=b.uid')
		 ->group('a.username')
		 ->select();
		
	$this->assign('data', $data);
	$this->display();
	}
}