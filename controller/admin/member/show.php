<?php
$uid=$this->param[0];
$where='uid='.$uid;
$success	= '修改成功';
$error		= '修改失败';
$db	= new DB('school');
$member=new DB('member');

if(!empty($this->param[1]) && $this->param[1] == 'post'){	
	$form		= $this->form('member',$where);
	if(isset($form->data['sid'])){
		$sid=$form->data['sid'];
		$nums=$form->data['sid'];
	}else{
		$sids=$member->field('sid')->where($where)->select();
		$sid=$sids['list'][0]['sid'];
		$nums = null;
	}
	$form->hash('formhash')
		 ->set('sid',$sid)
		 ->pack('realname,age,idcard,email,openid,qq,summery,sid')
		 ->submit('update', $success, $error);
	$result = $form->result();
	if($result['type'] == 'success'){
			$this->clear('member','data');
			if($nums){
				//$sid=$form->data['sid'];
				$where1='sid='.$nums;
			$row=$db->field('volume')->where($where1)->search();
			$row[0]['volume']++;
			$volume=$row[0]['volume'];
			$db->where($where1)->update(array('volume'=>$volume));
			}	
		}
	echo $this->json($result);exit;
}
if(!empty($this->param[1]) && $this->param[1] == 'add'){
		$school		= $this->form('school',$where);
		$school->hash('formhash')
		 	   ->pack('name,summery,ceo,tel')
		 	   ->submit('update', $success, $error);
		$result = $school->result();
		if($result['type'] == 'success'){
			$this->clear('school','data');
		}
		echo $this->json($result);exit;
	}
else{
	$user	= new DB('user as a','member as b');
	$data = $user->where("a.uid=b.uid and a.uid=$uid") ->select();
	$sid=$data['list'][0]['sid'];
	$s=new DB('school');
	$school=$s->field('name')->where('sid='.$sid)->search();
	$result = $db->where('sid='.$data['list'][0]['sid'])->select();
	$results = $db->field('sid,name')->where('stats=2')->select();
	$this->assign('data', $data);
	$this->assign('uid', $uid);
	$this->assign('result', $result);
	$this->assign('school', $school);
	$this->assign('results', $results);
	$this->display();
}