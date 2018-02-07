<?php

$id=$this->param[0];	
$where='id='.$id;
if(!empty($this->param[1]) && $this->param[1] == 'post'){
	
	$form		= $this->form('train',$where);
	
	$success	= '修改成功';
	$error		= '修改失败';
	$field   	= 'name,link,level';
	$form   
				->pack($field)
				->submit('update', $success, $error);
				
	$result = $form->result();
	if($result['type'] == 'success'){
		$this->clear('train','trainList');
	}
	echo $this->json($result);exit;
}else{
	
	$train = new DB('train');
	$data = $train->where($where)->select();
	$this->assign('data', $data);
	$this->display();
}





