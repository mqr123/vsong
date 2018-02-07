<?php
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$user	= new DB('news');
$data 	= $user->field('*')
		->limit(5, $page)
		->select();
$this->assign('data', $data);
$this->display();