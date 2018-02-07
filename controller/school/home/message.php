<?php
//设为已读
if(!empty($this->param[0])&&$this->param[0]=='post'){
	$form=$this->form('message');
	
	if(count(json_decode($form->data['ids']))<2){
		$id=json_decode($form->data['ids'])[0];
	}else{
		$id=implode(',',json_decode($form->data['ids']));
	}
	$form->hash('formhash');
	$db=new DB('message');
	$result=$db->where("id in ($id)")->update(array('stats'=>1));
	$this->json($result,1);

	
}

else{
$page=isset($this->param[1])&&is_numeric($this->param[1])?$this->param[1]:1;
$message=new DB('message');
$uid=$_G['user']['uid'];
$data=$message->field('id,type,title,dateline')
			  ->where("`to`=$uid and stats=1")
			  ->limit(5,$page)
			  ->select();
			  
$unread=$message->field('id,type,title,dateline')
			  ->where("`to`=$uid and stats=0")
			  ->limit(5,$page)
			  ->select();
	  
$this->assign('data',$data);
$this->assign('unread',$unread);
$this->display();
}