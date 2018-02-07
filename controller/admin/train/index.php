<?php
//获取一个参数来作为 page
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$user	= new DB('train');
$data = $user->field('id,name,link,level')
#+-------------------------------------------------------+
    #默认 MYSQL_ASSOC 模式
    #->type(MYSQL_BOTH)

    # true 为无缓冲模式
    #->unbuffered(false)

    #设置缓存
//	->cache(3600,'trainList')

    #排序（字段，倒序）
//	->order('dateline', true)

    #条数，页码
    ->limit(15, $page)
    ->select();
	if(!empty($data['list'])){
	 $this->assign('data', $data);
	 $this->display();
	 
	}else{
		
		$this->display();
		
	}
