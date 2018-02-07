<?php
//获取一个参数来作为 page
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$user	= new DB('game');
$data = $user->field('id,name,link,level,price,version,dateline,updatetime')
#+-------------------------------------------------------+
    #默认 MYSQL_ASSOC 模式
    #->type(MYSQL_BOTH)

    #设置缓存
//	->cache(3600,'gameList')

    #排序（字段，倒序）
	->order('id', true)

    #条数，页码
    ->limit(5, $page)
    #条件
    #->where("`uid`='10000'")

    #无缓存模式搜索数据，默认返回一组数据。
    #可选参数（key, value）当有key参数并且没有value参数时，返回value，当有value参数时，则判断是否相同，返回1或0
    #->search();

    #查询（缓存有效）
    ->select();
	if(!empty($data['list'])){
		$this->assign('data', $data);
	
		$this->display();
	}else{
		$this->display();
	}

