<?php
if(!empty($this->param[0])&&$this->param[0]=='post'){
	$admin=new DB('sys_admin');
	$username=$_SESSION['username'];
	$id=$admin->field('id')->where("username='$username'")->search(0);
	$from=$id['id'];
	$check = array(
		'title'	=> array(
			'min'	=> array(0,'标题不能为空')
			),
		'content'	=> array(
			'min'	=> array(0,'内容不能为空')
		)
	);
	$db=new DB('user');
	$message=new DB('message');
	$form=$this->form('message');
	if(empty($form->data['to'])){
		$where=$form->data['user']=='all'?'1=1':
			   ($form->data['user']=='男'?'gender=1':(
			   ($form->data['user']=='女'?'gender=1':(
			   ($form->data['user']=='0'?'type=0':(
			   ($form->data['user']=='1'?'type=1':(
			   ($form->data['user']=='2'?'type=2':'1=1')))))))));
		$data=$db->field('uid')->where($where)->search();
		for ($i=0; $i <count($data) ; $i++) { 
			$to=$data[$i]['uid'];
			$result=$message->insert(array(
							'from'    =>$from,
							'to'      =>$to,
							'type'    =>0,
							'stats'   =>0,
							'dateline'=>time(),
							'title'   =>$form->data['title'],
							'content' =>$form->data['content']));
		}
		if($result){
			$result=array('msg'=>'发送成功');
			echo "<script>alert('".$result['msg']."');location.href='../message/index';</script>";
		}
	}else{
		$to=$form->data['to'];
		$re=$db->field('uid')->where("`uid`=$to")->search(0);
		if($re){
		$form->hash('formhash')
		     ->check($check)
		     ->set('from',$from)
		 	 ->set('to',$to)
		 	 ->set('type',0)
		 	 ->set('stats',0)
		  	 ->set('dateline',time())
		 	 ->pack('from,to,type,title,content,stats,dateline')
			 ->submit('insert','发送成功','发送失败');
		$result=$form->result();
		if($result['type']=='success'){
			$this->clear('message');
		}
	}else{
		$result=array('msg'=>'用户不存在');
		echo "<script>alert('".$result['msg']."');</script>";
		$this->display();
		exit;
		}
		echo "<script>alert('".$result['msg']."');location.href='../../index';</script>";
	}
}
$this->display();