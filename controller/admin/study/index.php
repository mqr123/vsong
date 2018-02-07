<?php
//获取一个参数来作为 page
$page	= isset($this->param[0]) && is_numeric($this->param[0])?$this->param[0]:1;
$user	= new DB('study');
if(!empty($this->param[0])&&$this->param[0]=='post'){
	$this->clear('study');
	$likes  = $_POST['word'];
	
	$form	= $this->form('study');
	$where	= "name like '%$likes%'";
	$data 	= $user->field('*')->where($where)->select();

}else{
	$data = $user->field('id,name,link,level,price')
    #设置缓存
	//->cache(300,'studyList')
	#id排序
	->order('id', TRUE)
    #条数，页码
    ->limit(5, $page)
    ->select();
}   
	if(!empty($data['list'])){
		$this->assign('data', $data);
	
		$this->display();
	}else{
		$this->display();
	}
#+-------------------------------------------------------+
#设置页面缓存
#$this->setConfig('cache', true);
#强制编译（建议仅在调试模板时开启）
//setCacheHeader(300,'text/html;charset=utf-8',"userlist-$page.html");//设置浏览器缓存
//if(!empty($this->param[0])&&$this->param[0]=='post'){
//        $word=$_POST['word'];
//        var_dump($word);exit;
//        $data=new DB('study');
//        if(empty($word)){
//            $str= "请输入要查询的内容";
//        }else{
//            $sql=$data->where('name='.'%$word%')->select();
//            $result = mysql_query($sql);
//            $this->assign('result',$sql);#向模板注入变量
//        }
//    }else{
//    $this->display();
//}