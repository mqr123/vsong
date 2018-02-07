<?php
$sid=$this->param[0];
$school=new DB('school');
//$uid = $school->field('uid')->where('sid='.$sid)->search();

if(!empty($this->param[1])&&$this->param[1]=='yes'){
	$re=$school->where('sid='.$sid)->update(array('stats'=>2,'update'=>time()));
//	$member=new DB('user');
//	$member->where('uid='.$uid[0]['uid'])->update(array('type'=>1));
	if($re){
		echo "<script>alert('审核通过');location.href='../listSchool';</script>";
	}
}
else if(!empty($this->param[1])&&$this->param[1]=='no'){
	$re=$school->where('sid='.$sid)->update(array('stats'=>1,'update'=>time()));
	if($re){
		echo "<script>alert('审核未通过');location.href='../listSchool';</script>";
	}
}
else if(!empty($this->param[1])&&$this->param[1]=='stop'){
	$re=$school->where('sid='.$sid)->update(array('stats'=>3,'update'=>time()));
	if($re){
		echo "<script>alert('禁止使用');location.href='../listSchool';</script>";
	}
}