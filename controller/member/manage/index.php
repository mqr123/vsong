<?php

$uid=$_G['user']['uid'];
$where='uid='.$uid;
$success	= '修改成功';
$error		= '修改失败';
$member=new DB('member');

//个人资料查找，为空的时候进行加入
$re=$member->field('uid')->where($where)->search();
if(empty($re)){
	$member->insert(array('uid'=>$uid,'sid'=>0));
}
//个人信息 的修改
if(!empty($this->param[0])&&$this->param[0]=='post'){
	
	$form	= $this->form('member',$where);
	//先修改用户表信息
	$user=new DB('user');
	$arr=array('username'=>$form->data['username'],'phone'=>$form->data['tellphone']);
	$result=$user->where($where)->update($arr);
	if($result!==false||0!==$result){
		//如果成功则继续修改个人信息
		if(isset($form->data['sid'])){
			//如果用户选择了机构
			$sid=$form->data['sid'];
			$nums=$form->data['sid'];
		}else{
			$sids=$member->field('sid')->where($where)->select();
			$sid=$sids['list'][0]['sid'];
			$nums=null;
		}

		$county=!empty($form->data['county'])?$form->data['county']:'0';
		$town=!empty($form->data['town'])?$form->data['town']:'0';
		$user = $form->set('town',$town)
   			->set('county',$county)
			->set('sid',$sid)//设置表单
			->pack('realname,province,city,county,town,idcard,parents,parents_phone,email,openid,qq,address,district,summery,sid')//打包需要修改的表单
		 	->submit('update', $success, $error);
		$result = $form->result();
		if($user!==false||0!==$user){
			$result['type']='success';
		}
		if($result['type'] == 'success'){
				//修改成功,清除缓存
				$this->clear('user as a,vs_member as b');
				//如果选择了机构,就给机构学生数量+1
				if(!empty($nums)){
					$where1='sid='.$nums;
					$db=new DB('school');
					$row=$db->field('volume')->where($where1)->search();
					$row[0]['volume']++;
					$volume=$row[0]['volume'];
					$db->where($where1)->update(array('volume'=>$volume));
			}	
		}
	 $this->json($result,1);exit;
	}
}
else{
	//个人信息的查看
	$db=new DB('user as a','member as b');
	$where1="a.uid=$uid and a.uid=b.uid";
	$data=$db->field('a.username,a.phone,a.ip,b.realname,b.idcard,b.openid,b.qq,b.parents,b.parents_phone,b.email,b.address,b.summery,b.sid,a.type,b.district,b.province,b.city,b.county,b.town')
		 	->where($where1)
			->group('username')
		 	->cache(1800)
		 	->select();
		/////获取机构的审核状态，根据不同跳转显示不同页头
		$school=new DB('school');
//		$stats = $school->field('stats')->where($where)->search();
//		$_G['user']['stats'] = !empty($stats)?$stats[0]['stats']:'';
		if(empty($data['list'])){
			
			$this->display();
		}
		else{
			if($data['list'][0]['sid']==0){
				$s=$school->field('sid,name,uid,district')->where('stats=2')->select();
				$this->assign('school',$s);
			}else{
				$sid=$data['list'][0]['sid'];
				$s=$school->field('name')->where("sid=$sid")->search();
				$this->assign('edu',$s);
			}
		$this->assign('data',$data);
		$this->display();
	}
}