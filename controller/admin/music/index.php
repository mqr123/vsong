<?php
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$music= new DB('music');
$data = $music->field('id,uid,name,price,author,singer,dateline,delay,style,level')
	->limit(5, $page)
	->select();
	
$this->assign('data', $data);
$this->display();
