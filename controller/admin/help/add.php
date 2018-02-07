<?php
if(!empty($this->param[0]) && $this->param[0] == 'post'){
//	 $check = array(
//	 	'question'	=> array(
//	 		'min'	=> array(1,'请输入问题？'), 		
//	 		),
//	 	'answer'	=> array(
//	 		'min'	=> array(1,'请填写答案！')
//	 	) 
//	 );
	$form		= $this->form('help');
	$success	= '添加成功';
	$error		= '添加失败';
	$form
		//->hash('formhash')
		// ->check($check)
		 ->pack('question,answer')
		->submit('insert', $success, $error);
	$result = $form->result();
	if($result['type'] == 'success'){
		$this->clear('help','data');
	}
	echo $this->json($result);exit;
}else{
	$this->display();
}