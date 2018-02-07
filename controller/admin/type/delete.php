<?php
if(empty($this->param)){
	echo "<script>location.href='index';</script>";
}
if(!empty($this->param[0])){
	$id=$this->param[0];
	$data=new DB('type');
	$result1=$data->select();
	$a=getChilds($result1['list'],$id);
	if($a){
      	$arr=array();
      	foreach($a as $v){
      		 $arr[]=$v['id'];
      }
  $str='('.implode(',',$arr).')';
 	$where="id in".$str.""; 
  if($data->where('id='.$id)->delete()&&$data->where($where)->delete()){
  		echo "<script>alert('删除成功');location.href='../index';</script>";
  }
  else{echo "<script>alert('删除失败');location.href='../index';</script>";}

}
else if($data->where('id='.$id)->delete()){
	echo "<script>alert('删除成功');location.href='../index';</script>";
	}
	else{
		echo "<script>alert('删除失败');location.href='../index';</script>";
	}
}