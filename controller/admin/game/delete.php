<?php
/*
 * 根据id删除游戏模式
 * */
 # url地址传递的第一个与第二个参数不为空，且第一个参数为delete，执行以下操作
if(!empty($this->param[0]) && !empty($this->param[1]) && $this->param[0]='delete'){
	$id=$this->param[1];
	$where = '`id` = '.$id;
	#对表game进行 操作
	$game = new DB('game');
	$result = $game->where($where)->delete();
	
	if($result){
		echo "<script>alert('删除成功');location.href='../index';</script>";
	}else{echo "<script>alert('删除失败');location.href='../index';</script>";}
}else{
	$this->display();
}
