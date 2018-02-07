<?php
/*
 * 修改游戏模式数据
 * */
 
 $id=$this->param[0];	
$where='id='.$id;
if(!empty($this->param[1]) && $this->param[1] == 'post'){
	
	$form		= $this->form('game',$where);
	
	$success	= '修改成功';
	$error		= '修改失败';
	#定义修改字段
	$field      = 'name,updatetime,version,link,level,price';
	$form   	-> set('updatetime',time())
				-> pack($field)
				-> submit('update', $success, $error);
				
	$result = $form->result();
	if($result['type'] == 'success'){
		$this->clear('game','gameList');
	}
	echo $this->json($result);exit;
}else{
	
	$game = new DB('game');
	$data = $game->where($where)->select();
	$this->assign('data', $data);
	$this->display();
}
 
 
 
 
 #rul第二个参数的id不能为空
//if(!empty($this->param[1])&& !empty($this->param[0]) && $this->param[0]=='update'){
//	#id 与第二个参数同步
//	$id = $this->param[1];
//	#where条件id等于传递的id参数
//	$where = "`id` = '$id'";
//	//print_r($where);
//	#第一个参数不为空 且 id与第二个参数相同
//	if(($this->param[0]=='post') && ($id = $this->param[1])){
//		#引用from函数 
//		#game 要查询的表名，#where查询的条件
//		$form = $this->form('game',$where);
//		
//		#定义修改字段
//		$field = 'name,updatetime,version,link,level,price';
//		
//		$form 
//			  -> set('updatetime',time())
//			#数据的唯一性
//			  -> only('version','link')
//			#打包表单
//			  -> pack($field)
//			#提交表单
//			  -> submit('update');
//		$result = $form ->result();
//		#清理缓存
//		if($result['type'] == 'success'){
//			$this->clear('game','gameList');
//		}
//		#输出结果
//		echo $this->json($result);
//		exit();
//			  
//	
//	}else{
//	
//	$game = new DB('game');
//	
//	$data = $game-> where($where)->select();
//	$this->assign('data',$data);
//	$this-> display();
//	}
//	
//}







