<?php
if(!empty($this->param[0])&&is_numeric($this->param[0])){
	$uid=$this->param[0];
	$this->assign('uid',$uid);
	$this->display();
}
else if(!empty($this->param[0])&&$this->param[0]=='post'){
	$uid=$this->param[1];

	$admin=new DB('sys_admin');
	$username=$_SESSION['username'];
	$id=$admin->field('id')->where("username='$username'")->search();
	$from=$id[0]['id'];
	$form=$this->form('message');
	$form->hash('formhash')
		 ->set('from',$from)
		 ->set('to',$uid)
		 ->set('type',0)
		 ->set('stats',0)
		 ->set('dateline',time())
		 ->pack('from,to,type,title,content,stats,dateline')
		 ->submit('insert');
	$result=$form->result();
	if($result['type']=='success'){
		 echo "<script>alert('发送成功');location.href='../index';</script>";
	}else{
		 echo "<script>alert('发送失败');location.href='../index';</script>";
	}
}
else if(!empty($this->param[0])&&$this->param[0]=='add'){
	$form=$this->form('message');
	$name=$form->data['name'];
	$school=new DB('school');
	$uid=$school->field('uid')->where("name='$name'")->search(0);
	if($form->data['num']<50 || $form->data['recharge']<10000){
		$result=array('type'=>'error','msg'=>'目标50人充值，总充值1万元，该机构还未完成');
	}else{
		$admin=new DB('sys_admin');
		$username=$_SESSION['username'];
		$id=$admin->field('id')->where("username='$username'")->search();
		$from=$id[0]['id'];
		$form=$this->form('message');
		$form->set('from',$from)
			 ->set('to',$uid['uid'])
			 ->set('type',0)
			 ->set('title','VSong平台提醒')
			 ->set('content',"恭喜您!目前招收学员有".$form->data['num'].'个,学员充值总金额'.$form->data['recharge'].'元')
			 ->set('stats',0)
			 ->set('dateline',time())
			 ->pack('from,to,type,title,content,stats,dateline')
			 ->submit('insert');
		$result=$form->result();
		if($result['type']=='success'){
			$result=array('type'=>'success','msg'=>'发送成功');
		}else{
			$result=array('type'=>'error','msg'=>'发送失败');
		}
	}
	$this->json($result,1);
}