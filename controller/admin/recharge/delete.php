<?php
if(!empty($this->param[0])){
	$id=$this->param[0];
	$db=new DB('member_recharge');
	$res=$db->where("`id`=$id")->update(array('stats'=>-1));
	if($res){
		if(isset($this->param[1])&&$this->param[1]=='member'){
			echo "<script>alert('删除成功');location.href='../../member/index';</script>";
		}else{
			echo "<script>alert('删除成功');location.href='../index';</script>";	
		}
		
	}else{
		if(isset($this->param[1])&&$this->param[1]=='member'){
		echo "<script>alert('删除失败');location.href='../../member/index';</script>";
		}else{
			echo "<script>alert('删除成功');location.href='../index';</script>";	
		}
	}
}
?>