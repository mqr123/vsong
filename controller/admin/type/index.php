<?php
if(!empty($this->param[1])&&$this->param[1]=='post'){
	$id=$this->param[0];
	$where='id='.$id;
	$form		= $this->form('type',$where);
	$success	= '修改成功';
	$error		= '修改失败';
	$form->hash('formhash')
		 ->pack('name,title,order')
		 ->submit('update',$success,$error);
	$result=$form->result();
	if($result['type']=='success'){
		$this->clear('type','data');
		echo "<script>alert('修改成功');location.href='../index';</script>";
		exit;
	}
	else{echo "<script>alert('修改失败');location.href='../index';</script>";
		exit;
	}

}
else{
	$one=new DB('type');
	$data=$one->where('upid=0')
	->select();
	$this->assign('data',$data);
    $this->display();
}