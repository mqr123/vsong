<?php
$id=$this->param[0];	
$where='id='.$id;
if(!empty($this->param[1]) && $this->param[1] == 'post'){
	$check = array(
	 	'question'	=> array(
	 		'min'	=> array(1,'请输入问题？'), 		
	 		),
	 	'answer'	=> array(
	 		'min'	=> array(1,'请填写答案！')
	 	)	 
	 );
	$form		= $this->form('help',$where);
	$success	= '修改成功';
	$error		= '修改失败';
	$form->check($check)	   
		->pack('question,answer')
		->submit('update', $success, $error);
	$result = $form->result();
	if($result['type'] == 'success'){
		$this->clear('help','data');
	}
	echo $this->json($result);exit;
}else{
	$data=new DB('help');
	$result=$data->where($where)->select();
	$this->assign('result', $result);
	$this->display();
}



