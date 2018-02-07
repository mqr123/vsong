<?php
$uid=isset($this->param[1])&&is_numeric($this->param[1])?$this->param[1]:0;
$_G['uid']=$uid;
$db=new DB('school');
$summery=$db->field('summery')->where("uid=$uid")->search();
$summery=!empty($summery)?$summery[0]['summery']:'';
$data=$db->field('name,tel,district,address')->where("uid=$uid")->select();
$data=!empty($data['list'])?$data['list']:'';
$this->assign('summery',$summery);
$this->assign('data',$data);
//$this->assign('uid',$uid);
$this->display();