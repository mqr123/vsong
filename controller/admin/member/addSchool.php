<?php
$uid=$this->param[0];
if(!empty($this->param[1]) && $this->param[1] == 'post'){
	$form= $this->form('school');
	$name=$form->data['name'];
	$success	= '添加成功';
	$error		= '添加失败';
	$name=$form->data['name'];
   	$form->hash('formhash')
   		->only('name')
   		->set('dateline',time())
   		->set('dateout',strtotime('+1 year'))
   		->set('uid',$uid)
   		->set('fav',0)
   		->set('like',0)
   		->set('stats',0)
   		->set('order',0)
   		->set('level',0)
   		->set('volume',0)
		->pack('uid,name,ceo,tel,summery,address,volume,dateline,dateout,level,fav,like,stats,order')
		->submit('insert', $success, $error);
	  $result = $form->result();  
	if($result['type'] == 'success'){
		$this->clear('school','data');
	}
	$school=new DB('school');
	$where="name='$name'";
	$sid=$school->field('sid')->where($where)->search();
	$member=new DB('user');
	$member->where('uid='.$uid)->update(array('type'=>1));
	$m=new DB('member');
	$m->where('uid='.$uid)->update(array('sid'=>$sid[0]['sid']));
	$this->json($result,1);	

}else{
	$this->assign('uid',$uid);
	$this->display();
}


