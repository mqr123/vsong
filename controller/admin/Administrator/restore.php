<?php

if(!empty($this->param[1])){
	$id = $this->param[1];
	$where ="`id`= '$id'";
	print_r($where);
	if(($this->param[0]=='restore') && ($id = $this->param[1])){

		$admin  = new DB('sys_admin');
		$result = $admin->where($where)->update(array('stats'=>0));
		if($result){
			echo "<script>alert('恢复成功');location.href='../index';</script>";
		}else{
			echo "<script>alert('恢复失败');location.href='../index';</script>";
		}
	}
}