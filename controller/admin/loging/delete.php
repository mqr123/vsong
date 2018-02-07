<?php
if(!empty($this->param[1])&&$this->param[0]=='delete'&&$this->param[1]!='time'){
	$id=$this->param[1];
	$log=new DB('sign_log');
	$re=$log->where("id=$id")->delete();
	if($re){
		echo "<script>alert('删除成功');location.href='../index';</script>";
	}else{echo "<script>alert('删除失败');location.href='../index';</script>";}
}else if(!empty($this->param[1])&&$this->param[0]=='delete'&&$this->param[1]=='time'){
	$mytime=strtotime("-1 year");//获取一年前时间戳 
	$log=new DB('sign_log');
	$res=$log->field('id')->where("exittime < $mytime")->search();
	$arr=array();
	foreach($res as $key=>$v){
		foreach($v as $val){
			array_push($arr,$val);
		}
	}
	$str=implode(',',$arr);
	if($str!=''){
		$re=$log->where("id in ($str)")->delete();
		if($re){
			echo "<script>alert('删除成功');location.href='../index';</script>";
		}
		else{echo "<script>alert('删除失败');location.href='../index';</script>";}
	}else{
		echo "<script>alert('删除成功');location.href='../index';</script>";
	}
}