<?php
$success	= '修改成功';
$error		= '修改失败';
$member=new DB('member');
//个人信息 的修改
if(!empty($this->param[1])&&$this->param[1]=='post'){
	$uid=$this->param[0];
	$where="uid=$uid";
	$form		= $this->form('member',$where);
	//先修改用户表信息
	$user=new DB('user');
	$arr=array('username'=>$form->data['username'],'phone'=>$form->data['phone']);
	$result=$user->where($where)->update($arr);
	if($result!==false||0!==$result){
		//如果成功则继续修改个人信息
		$county=!empty($form->data['county'])?$form->data['county']:'';
		$town=!empty($form->data['town'])?$form->data['town']:'';
		$form->set('town',$town)
   			->set('county',$county)
			->pack('realname,idcard,age,parents,parents_phone,email,openid,qq,province,city,county,town,district,address,summery')//打包需要修改的表单
		 	->submit('update', $success, $error);
		$res = $form->result();
	 $this->json($res,1);
	}
}
else {
	
	//个人信息的查看
	$uid=$this->param[0];
	$db=new DB('user as a','member as b');
	$where="a.uid=$uid and a.uid=b.uid";
	$data=$db->field('a.uid,a.username,a.gender,a.phone,b.realname,b.age,b.idcard,b.openid,b.qq,b.parents,b.parents_phone,b.email,b.address,b.summery,b.district,b.province,b.city,b.county,b.town')
		 ->where($where)
		 ->select();
		
		$gender=$data['list'][0]['gender'];
		$this->assign('data',$data);
		$this->assign('gender',$gender);
		$this->assign('uid',$uid);
		$this->display();	
}

