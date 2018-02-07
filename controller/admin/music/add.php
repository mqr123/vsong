<?php
if(!empty($this->param[0]) && $this->param[0] == 'post'){
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
	 	)
	 );
	// #表单处理器
	 $form		= $this->form('music');

	// #处理结果提示
	$success	= '添加成功';
	$error		= '添加失败';
	
	$form
		#表单验证
		->check($check)
		#设置表单项
		->set('dateline',time())
		->set('delay', 4)
		->set('level', 53)
       
		#打包表单
		->pack('name,author,singer,price,dateline,style,delay,level')
	
		#提交表单
		->submit('insert', $success, $error);
		
	
	$result = $form->result();
	#清理缓存
	if($result['type'] == 'success'){
		$this->clear('music','musicList');
	}
	
	#输出处理结果
	echo $this->json($result);exit;

}else{
	$this->assign('param', $this->param);#向模板注入变量
	$this->display();#显示模板
}
