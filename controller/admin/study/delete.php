<?php
if(!empty($this->param[0]) && !empty($this->param[1]) && $this->pararm[0] = 'delete'){
	$id = $this->param[1];
	$where = '`id`='.$id;
	
	$study = new DB('study');
	$data  = $study->where($where)->delete();
	if($data){
		echo "<script>alert('删除成功');location.href='../index';</script>";
	}else{
		echo "<script>alert('删除失败');location.href='../index';</script>";
	}
}else{

	$this->display();
}
