<?php

$uid=$_G['user']['uid'];
if(!empty($this->param[0])&&$this->param[0]=='post'){
	$form=$this->form('member_recharge');
	$form->nsi = true;#不返回ID
	$member=new DB('member');
	$success='充值成功';
	$error='充值失败';
	$res=$member->field('uid')->where('uid='.$form->data['uid'])->search();
	if(empty($res[0]['uid'])){
		$result=array('type'=>'error','msg'=>'用户不存在');
	}
//	else if(empty($res[0]['idcard'])){
//		$result=array('type'=>'er','msg'=>'请完善个人信息');
//	}
	else{
		$form->set('time',time())
			 ->pack('uid,way,time,amount')
			 ->submit('insert',$success,$error);
		$result=$form->result();
	}
	$this->json($result,1);
}
$this->display();