<?php
if(!empty($this->param[1]) && $this->param[1] == 'post'){
	$id=$this->param[0];
	$where='id='.$id;
 $check = array(
	 	'name'	=> array(
	 	   'min'	=> array(1,'名称栏不能为空！'), 		
	 	),
	 	 'author'    =>array(
	 	  'min'     =>array(1,'发布人栏不能为空！'),
	 	 ), 
	 	 'singer'  =>array(
	 	  'min'     =>array(1,'艺人栏不能为空！'),
	 	 ),
	 	 'price'	=> array(
	 	 'match'	=> array('/^(0|([1-9]\d{0,9}(\.\d{1,2})?))$/','价钱格式不正确') 		
	 	), 	
	 	'style'	=> array(
	 	   'min'	=> array(1,'音乐风格栏不能为空！'), 		
	 	)
	 	
	 );
//	// #表单处理器
	$form		= $this->form('music',$where);
	$success	= '修改成功';
	$error		= '修改失败';
	$form
	     ->set('dateline', time())
		 ->pack('name,author,singer,style,price,dateline')
		 ->submit('update', $success, $error);
	
	$result = $form->result();
       
	#清理缓存
	if($result['type'] == 'success'){
		$this->clear('music','musicList');
	}
	$json = $this->json($result);
	#输出处理结果
	echo $json;exit;

}else{
	$id=$this->param[0];
	$data=new DB('music');
	$result=$data->where('id='.$id)->select();
	
	$this->assign('result', $result);
	$this->assign('param', $this->param);#向模板注入变量
	$this->display();#显示模板
}



