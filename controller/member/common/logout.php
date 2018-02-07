<?php
session_start();
$uid=$_G['user']['uid'];
$log=new DB('sign_log');
$data=$log->field('id,exittime')->where("uid=$uid")->order('id','desc')->search();
$id=end($data)['id'];
$log->where("id=$id")->update(array('exittime'=>time()));
if(isset($_SESSION['school_user'])){
	unset($_SESSION['school_user']);
	$this->cookie('is_school_session','',-3600);	
}
$this->cookie('author','',-3600);
$this->cookie('is_school_name','',-3600);
$this->cookie('school_stats','',-3600);
echo "this.postMessage(".$this->json(array('type'=>'success')).")";exit;
 
?>