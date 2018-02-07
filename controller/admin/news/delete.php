<?php
if(isset($this->param[0])){
	$id=$this->param[0];	
	$data=new DB('news');
	$result=$data->where('id='.$id)->delete();
if($result){
		$db=new DB('news_content');
		$res=$db->where('nid='.$id)->delete();
		if($res){
		  echo "<script>alert('删除成功');location.href='../index';</script>";
		}else{echo "<script>alert('删除失败');location.href='../index';</script>";}
	}else{
		  echo "<script>alert('删除失败');location.href='../index';</script>";
		 }
}