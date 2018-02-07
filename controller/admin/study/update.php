<?php

$id=$this->param[0];	
$where='id='.$id;

if(!empty($this->param[1]) && $this->param[1] == 'post'){
	
	$form		= $this->form('study',$where);
	$success	= '修改成功';
	$error		= '修改失败';
	$field      = 'name,link,level,price';
	$form   
				->pack($field)
				->submit('update', $success, $error);
	$result = $form->result();
	if($result['type'] == 'success'){
		$this->clear('study','studyList');
	}
	echo $this->json($result);exit;
}else{
	
	$study = new DB('study');
	$data = $study->where($where)->select();
	$_G['data'] = $data['list'][0];
	
	$this->display();
}




















//if(!empty($this->param[1]) && $this->param[1] == 'post'){
//  $check=array(
//      'name' =>array(
//          'min'	=> array(1,'修改的教学名称不能小于1个字符')
//      ),
//      'level' =>array(
//          'min'	=> array(1,'修改的等级不能小于1个字符')
//      ),
//      'price' =>array(
//          'min'	=> array(1,'修改的价格不能小于1个字符')
//      )
//
//  );
//	$id=$this->param[0];
//	$where='id='.$id;
//	// #表单处理器
//  $form		= $this->form('study',$where);
//	$success	= '修改成功';
//  $error		= '修改失败';
////	网址
//  $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
//	$form
//      ->check($check)
//      #数据唯一性
//      ->only('name,link')
//      ->set('link',$url)
//      ->pack('name,link,level,price')
//      ->submit('update', $success, $error);
//
//	$result = $form->result();
////	#清理缓存
//	if($result['type'] == 'success'){
//		$this->clear('study','data');
//	}
//	$json = $this->json($result);
//	$this->write('test.json',$json);
//	#输出处理结果
//	echo $json;exit;
//
//}else{
//	$id=$this->param[0];
//
//	$data=new DB('study');
//	$result=$data->where('id='.$id)->select();
//	$this->assign('result', $result);
//	$this->display();#显示模板
//}



