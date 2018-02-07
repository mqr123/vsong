<?php
 if(!empty($this->param[0])&&$this->param[0]=='post'){
 	$form=$this->form('user');
 	$phone=$form->data['phone'];
 	$where="`phone`=$phone and stats=0";
 	$db=new DB('user');
 	$d=$db->field('password,salt')->where($where)->search(0);
 	if(empty($d)){
 		$res=array('type'=>'error','msg'=>'用户不存在');
 	}else{
 		$password=md5(md5($form->data['password']).$d['salt']);
 		$form->hash('formhash');
 		$result=$form->result();
 		if($result['type']=='success'){
 			$a=$db->where($where)->update(array('password'=>$password));
 			if($a){
 				$res=array('type'=>'success','msg'=>'修改成功');
 			}else{
 				$res=array('type'=>'error','msg'=>'修改失败');
 			}
 		}	
 	}
 	$this->json($res,1);
 }
 $this->display();
?>