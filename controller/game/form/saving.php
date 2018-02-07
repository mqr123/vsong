<?php
if(!$this->user['uid'])exit;
function getUserLevel($uid){
	$db = new DB('member_level');
	//次数，得分，力度，准确度，节拍，速度
	$db->field('number,exp,level,score,intensity,accuracy,speed');
	$data =  $db->where("`uid`='$uid'")->search(0);
	foreach($data as $key => $value)$data[$key] = $value * 1;
	return $data;
}
$form = $this->form('member_log')->hash('formhash')->pack('starttime,overtime,score,intensity,accuracy,speed,mode');
$result = $form->result();
if($result['type'] === 'error')$this->msg($result['msg'],'error', $result);
$user = getUserLevel($this->user['uid']);
$formData = array(
	'uid'	=> $_G['user']['uid'],
	'mode'	=> $result['data']['mode'],
	'starttime'	=> $result['data']['starttime'],
	'overtime'	=> $result['data']['overtime']
);
foreach(array('score','intensity','accuracy') as $key){
	$user[$key] += $result['data'][$key];
	$formData[$key] = $result['data'][$key];
}

$user['number'] += 1;

//等级算法
$user['exp'] += $user['level'] * ($result['data']['score'] / 100) * 10;
if($user['exp'] >= pow($user['level'],3) * 10){
	$user['level'] += 1;
	$user['exp'] = 0;
}


if(isset($result['data']['speed'])){
	$user['speed'] = max($user['speed'],$result['data']['speed']);
	$formData['speed'] = $result['data']['speed'];
}
$ins = new DB('member_log');
$ins->insert($formData);
$updt = new DB('member_level');
$updt->where("`uid`='".$_G['user']['uid']."'")->update($user);

$this->msg(null,'success');
