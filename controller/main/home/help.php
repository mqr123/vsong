<?php
$db=new DB('help');
$data=$db->field('*')->where("1=1")->search();
$this->assign('data',$data);
$this->display();
?>