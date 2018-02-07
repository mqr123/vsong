<?php
if(!empty($this->param[0])&&$this->param[0]=='delete'){
	$form=$this->form('message');
	$id=$form->data['ids'];
	$db=new DB('message');
	$res=$db->where("id=$id")->delete();
	if($res){
		$res=array('type'=>'success','msg'=>'删除成功');
	}else{
		$res=array('type'=>'error','msg'=>'删除失败');	
		}
	$this->json($res,1);
}