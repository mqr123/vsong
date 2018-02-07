<?php

if(!empty($this->param[0]) && $this->param[0] === $this->ecode){
	function getSMSCode($phone, $ip, $times = 600, $code = null){
		$time = time() - $times;
		$db =  new DB('sms');
		$where = "`ip`='$ip' and `phone`=>'$phone' and `dateline`>'$time' and `used`='0'";
		if($code)$where .= " and `code`='$code'";
		return $db->where($where)->field('code')->search($code === false?null:0);
	}
	
	
	$post = $this->form('sms')->data;
	if(!isset($post['formhash']) || empty($post['ip']) || $post['formhash'] != $this->formhash()){
		echo $this->json(array('type'=>'error','msg'=>'非法操作'));exit;
	}
	#验证短信
	if(!empty($post['code']) && !empty($post['phone'])){
		$result = getSMSCode($post['phone'], $post['ip'], 600, $post['code']);
		if(!empty($result['code'])){
			echo $this->json(array('type'=>'success','msg'=>'验证成功'));
			$db = new DB('sms');
			$db->where("`phone`=>'".$post['phone']."' and `ip`=>'".$post['ip']."' and `code`='".$post['code']."'")->update(array('used'=>1));
		}else{
			echo $this->json(array('type'=>'error','msg'=>'验证失败'));
		}
		unset($result);exit;
	}
	
	#发送短信
	
	if(empty($post['phone']) || !preg_match('/^(1[3-9]{1}[0-9]{9})$/', $post['phone'])){
		echo $this->json(array('type'=>'error','msg'=>'手机号码不正确','form'=>$post));
		unset($post);exit;
	}
	$db = new DB('sms');
	$data = $db->where("`phone`='".$post['phone']."' and `ip`='".$_G['ip']."' and `dateline`>'".(time()-3600)."'")
		->field('code')
		->limit(10,1)
		->order('dateline',true)
		->cache(0)->search();

	if(count($data)>=3){
		echo $this->json(array('type'=>'error','msg'=>'1小时内只能发送 3 条短信'));exit;
	}
	
	$code = rand(1000,9999);#要发送的验证码
	
	$db = new DB('sms');
	$result = $db->insert(array('ip'=>$_G['ip'],'code'=>$code,'phone'=>$post['phone'],'dateline'=>time() + (count($data) >=2?3600:60)),1);
	
	if($result){
		$msg = '发送成功( '.$code.' )';
		echo $this->json(array('type'=>'success','msg'=>$msg,'form'=>$post));
	}else{
		echo $this->json(array('type'=>'error','msg'=>'发送失败','form'=>$post));
	}

	unset($post);exit;
}
echo $this->json(array('type'=>'error','msg'=>'非法操作'));exit;