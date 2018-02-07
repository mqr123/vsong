<?php
$id=$this->param[0];
$message=new DB('message');
$data=$message->field('*')->where("id=$id")->select();
$this->assign('data',$data);
$this->display();

