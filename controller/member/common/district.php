<?php

$where =!empty($this->param[0])?"`upid`='".$this->param[0]."'":"`level`='1'";
$db = new DB('district');
$data = $db->cache(3600*24*366)->field('id,name,level,upid')->where($where)->select();
echo 'this.postMessage('.$this->json($data).');';exit;