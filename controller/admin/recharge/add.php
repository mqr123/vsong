<?php
if(!empty($this->param[0]) && $this->param[0] == 'post'){
	
	
	$recharge = $this->form('member_recharge');
	$recharge->nsi = true;#不返回ID
	$success	= '添加成功';
	$error		= '添加失败';
	
	
	//$field = 'uid,way,amount,time';
	$recharge 	
		  		->set('time',time())
		  		->pack('uid,way,amount,time')
				->submit('insert',$success,$error);

	$result = $recharge->result();
	
	if($result['type'] == 'success'){
		$this->clear('recharge','rechargeList');
	}
//	var_dump($result);
//	die;
	echo $this->json($result);
	exit();
}else{
    
    $this->display();#显示模板
}

