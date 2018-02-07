<?php
$id=$this->param[0];
$db=new DB('message');
$res=$db->where("id=$id")->update(array('stats'=>1));
$data=$db->field('content,dateline')->where("id=$id")->select();
$this->assign('data',$data);
$this->display();