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
else if(!empty($this->param[0])&&$this->param[0]=='add'){//充值发送
	$form=$this->form('message');
	$name=$form->data['name'];
	if(empty($name)){
		$result=array('type'=>'error','msg'=>'请输入机构名称');
		$this->json($result,1);
	}
	$school=new DB('school');
	$u=$school->field('uid')->where("name='$name'")->search(0);
	if($form->data['num']<50){
		$result=array('type'=>'error','msg'=>'该机构学员数量不足');
	}else{
		if($form->data['recharge']>10000){
			//获取机构下的学员的数量
			$school=new DB('school as a','member as b');
			$data=$school->field('b.uid')
						 ->where("a.name='$name' and a.uid!=b.uid and a.sid=b.sid")
						 ->group('b.uid')
						 ->search();
			$arr=array();
			foreach($data as $v){
				array_push($arr,$v['uid']);
			}
			$str=implode(',',$arr);
			$db=new DB('user');
			$d=$db->field('uid')->where("uid in ($str) and stats=0")->search();
			$recharge=new DB('member_recharge');
			$arr_uid=array();
			//查看该机构充值数超过200的学员
			for($i=0;$i<count($d);$i++){
				$uid=$d[$i]['uid'];
				$num=$recharge->field('uid')
				->where("uid=$uid and stats=0")
				->group('uid having sum(amount)>200')
				->search(0);
				if(isset($num['uid'])){
					array_push($arr_uid,$num['uid']);
				}
				
			}
			//该机构下的每个学员充值数量是否超过200
			if(count($d)<=count($arr_uid)){
				$admin=new DB('sys_admin');
				$username=$_SESSION['username'];
				$id=$admin->field('id')->where("username='$username'")->search();
				$from=$id[0]['id'];
				$form=$this->form('message');
				$form->set('from',$from)
					 ->set('to',$u['uid'])
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
			}else{
				$result=array('type'=>'error','msg'=>'学员个人充值不够');
			}			 
			
		}else{
			$result=array('type'=>'error','msg'=>'学员充值总数不够');
		}
	}
	$this->json($result,1);
	exit;
}else if(!empty($this->param[0])&&$this->param[0]=='buy'){//购买发送
	$form=$this->form('message');
	$name=$form->data['name'];
	if(empty($name)){
		$result=array('type'=>'error','msg'=>'请输入机构名称');
		$this->json($result,1);
	}
	$school=new DB('school');
	$u=$school->field('uid')->where("name='$name'")->search(0);
	if($form->data['num']<100){
		$result=array('type'=>'error','msg'=>'该机构学员数量不足');
	}else{
			//获取机构下的学员的数量
			$school=new DB('school as a','member as b');
			$data=$school->field('b.uid')
						 ->where("a.name='$name' and a.uid!=b.uid and a.sid=b.sid")
						 ->group('b.uid')
						 ->search();
			$arr=array();
			foreach($data as $v){
				array_push($arr,$v['uid']);
			}
//			var_dump($arr);
			$str=implode(',',$arr);
			$db=new DB('user');
			$d=$db->field('uid')->where("uid in ($str) and stats=0")->search();
			$buy=new DB('member_buy');
			$arr_uid=array();
			//查看该机构购买数超过100的学员
			for($i=0;$i<count($d);$i++){
				$uid=$d[$i]['uid'];
				$num=$buy->field('uid')
				->where("uid=$uid and stats=0")
				->group('uid having sum(price)>100')
				->search(0);
				if(isset($num['uid'])){
					array_push($arr_uid,$num['uid']);
				}
				
			}
//			var_dump($arr_uid);
//			die;
			//该机构下的每个学员购买数量是否超过100
			if(count($d)<=count($arr_uid)){
				$str_uid=implode(',',$arr_uid);
				$price=$buy->field('sum(price) as sum')->where("uid in ($str_uid)")->search();
				$money=0;
				foreach($price as $v){
					$money+=$v['sum'];
				}
				$admin=new DB('sys_admin');
				$username=$_SESSION['username'];
				$id=$admin->field('id')->where("username='$username'")->search();
				$from=$id[0]['id'];
				$form=$this->form('message');
				$form->set('from',$from)
					 ->set('to',$u['uid'])
					 ->set('type',0)
					 ->set('title','VSong平台提醒')
					 ->set('content',"恭喜您!目前招收学员有".$form->data['num'].'个,学员购买总金额'.$money.'元')
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
			}else{
				$result=array('type'=>'error','msg'=>'学员个人购买量不足');
			}			 
			
	}
	$this->json($result,1);
	exit;
}
