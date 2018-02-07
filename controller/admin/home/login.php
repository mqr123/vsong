<?php
if(!empty($this->param[0])&&$this->param[0]=='post'){
$form = $this->form('sys_admin');
$account = $form->data['account'];
$field = 'username';
if(is_numeric($account)){
	$field = mb_strlen($account) == 11?'phone':'id';
}
$where = "$field='$account' and stats = 0";
$user = new DB('sys_admin');
$row = $user->field('id,username,password,salt,phone')
			 ->where($where)
			 ->search();

if(empty($row)){
	$result=array('type'=>'error','msg'=>'用户不存在');
	echo $this->json($result);exit;
}else{
	$password = md5(md5($form->data['password']).$row[0]['salt']);
}
if($row[0]['password'] != $password){
	$result=array('type'=>'error','msg'=>'密码错误');
	echo $this->json($result);exit;
	}

else{	
		$data = $user->where($where)
		->field('id,username,roleid')
		->select();
		$time=array('datetime'=>time());
		$result=$user->where('id='.$data['list'][0]['id'])->update($time);
			if($result){
				$_SESSION['username']=$data['list'][0]['username'];
				$_SESSION['roleid']=$data['list'][0]['roleid'];
				$result=array('type'=>'success','msg'=>'登录成功');
				echo $this->json($result);exit;
			}
	}
}
$this->display();