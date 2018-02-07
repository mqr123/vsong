<?php
if(empty($this->param)){
	echo "<script>location.href='index';</script>";
}
if(!empty($this->param[0])){
	$data=new DB('user');
	$result=$data->where('uid='.$this->param[0])->update(array('stats'=>-1));
	$s=new DB('member');
	$sids=$s->field('sid')->where('uid='.$this->param[0])->search();
	if($result){
		$school=new DB('school');
		$row=$school->field('volume')->where('sid='.$sids[0]['sid'])->search();
		if(!empty($row)){
		$row[0]['volume']--;
		$volume=$row[0]['volume'];
		$a=$school->where('sid='.$sids[0]['sid'])->update(array('volume'=>$volume));
		}else{
			 echo "<script>alert('删除成功');location.href='../index';</script>";
		}
		if($a){
		 echo "<script>alert('删除成功');location.href='../index';</script>";
		}
	}else{echo "<script>alert('删除失败');location.href='../index';</script>";}
}