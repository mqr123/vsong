<?php
$username=$_SESSION['username'];
$admin=new DB('sys_admin');
$where="username='$username'";
$data=$admin->where($where)->select();
$this->assign('data',$data);
$this->display();