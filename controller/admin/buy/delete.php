<?php
if(!empty($this->param[0])){
	$id=$this->param[0];
	$db=new DB('member_buy');
	$res=$db->where("`id`=$id")->update(array('stats'=>-1));
	if($res){	
			echo "<script>alert('删除成功');location.href='../index';</script>";	
	}else{
			echo "<script>alert('删除成功');location.href='../index';</script>";	
	}
}
?>