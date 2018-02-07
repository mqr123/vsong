<?php
if(empty($this->param)){
	echo "<script>location.href='index';</script>";
}
if(!empty($this->param[0])){
	$id=$this->param[0];
	$data=new DB('sys_admin');
	$result=$data->where('id='.$id)->delete();
	if($result){
		echo "<script>alert('删除成功');location.href='../index';</script>";
	}else{echo "<script>alert('删除失败');location.href='../index';</script>";}
}