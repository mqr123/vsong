<?php
if(isset($this->param[0])){
	$id=$this->param[0];
	$music = new DB('music');
	$data = $music->where('id='.$id)->delete();
	if($data){
		echo "<script>alert('删除成功！');location.href='../index';</script>";
		
	}else{
		
		echo "<script>alert('删除失败！');location.href='../index';</script>";
	}
}
?>  