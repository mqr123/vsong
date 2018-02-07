<?php
	include(__ROOT__.'/controller/school/common/stu_info.php');
	$db=new DB('member_buy');
	if(!empty($this->param[0])&&$this->param[0]=='del'){
		$form=$this->form('member_buy');
		$id=$form->data['ids'];
		$form->hash('formhash');
		$result=$form->result();
		if($result['type']=='success'){
			$data=$db->where("`id`=$id")->update(array('stats'=>-1));
			if($data){
				$this->clear('member_buy');
				$re=array('type'=>'success','msg'=>'删除成功');
			}else{
				$re=array('type'=>'error','msg'=>'删除失败');
			}
		}
		$this->json($re,1);
	}else{
	$uid=$this->param[0];
	$page=isset($this->param[1])&&is_numeric($this->param[1])?$this->param[1]:1;
	$data=$db->field('*')->cache(1800)->where("`uid`=$uid and stats=0")->limit(20,$page)->select();
	$this->assign('data',$data);
	$this->display();
	}
?>