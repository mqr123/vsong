<?php
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$user	= new DB('sys_admin');
$data = $user
//	->cache(3600,'userlist')
    ->limit(20, $page)
    ->select();
$this->assign('data', $data);

#+-------------------------------------------------------+

#设置页面缓存
#$this->setConfig('cache', true);
#强制编译（建议仅在调试模板时开启）

//setCacheHeader(300,'text/html;charset=utf-8',"userlist-$page.html");//设置浏览器缓存

$this->display();
