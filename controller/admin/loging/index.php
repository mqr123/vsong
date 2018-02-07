<?php
$page=$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$log=new DB('sign_log');
$data=$log->limit(20,$page)->select();
$this->assign('data',$data);
$this->display();