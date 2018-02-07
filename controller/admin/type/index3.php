<?php

if(!empty($this->param[1])&&$this->param[1]=='post'){
	$id=$this->param[0];
	$where='id='.$id;
	$form		= $this->form('type',$where);
	$success	= '修改成功';
	$error		= '修改失败';
	$upid=$form->data['upid'];
	$form->hash('formhash')
		 ->pack('name,title,order')
		 ->submit('update',$success,$error);
	$result=$form->result();
	if($result['type']=='success'){
		$this->clear('type','data');
		echo "<script>alert('修改成功');location.href='../index3/".$upid."';</script>";
		exit;
	}
	else{echo "<script>alert('修改失败');location.href='../index3/".$upid."';</script>";
		exit;
	}

}
else{
	$id=$this->param[0];
	$one=new DB('type');
	$data=$one->where('upid='.$id)->select();
	$san=$one->field('upid,id,name')->where('id='.$id)->search();
	$er=$one->field('id,name')->where('id='.$san[0]['upid'])->search();
	$this->assign('data',$data);
	$this->assign('er',$er);
	$this->assign('san',$san);
	$this->assign('id',$id);
    $this->display();
}