<?php
//增加三级分类
if(!empty($this->param[0])&&$this->param[0]=='post'){
	$form		= $this->form('type');
	$success	= '增加成功';
	$error		= '增加失败';
	$upid=$form->data['upid'];
	$form->hash('formhash')
		 ->only('name')
		 ->set('level',4)
		 ->pack('name,title,upid,level,order')
		 ->submit('insert',$success,$error);
	$result=$form->result();
	if($result['type']=='success'){
		$this->clear('type','data');
		echo "<script>alert('添加成功');location.href='../index4/".$upid."';</script>";
		exit;
	}
	else{echo "<script>alert('添加失败');location.href='../index4/".$upid."';</script>";
		exit;
	}
}