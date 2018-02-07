<?php
setCacheHeader(0,'application/javascript;charset=utf-8','worker.js');
if(!isset($this->param[1]))exit;
$user = $_G['user'];
if($_G['user']['uid']){
	$db = new DB('user as u','member_level as l');
	$db->field('u.uid,u.username,u.gender,u.type,u.group,u.dateline,l.level,l.score,l.exp,l.number,l.multiple');
	$user = $db->where("u.uid='".$_G['user']['uid']."' and u.uid=l.uid")->search(0);
	#没有
	if(!$user['uid']){
		$ins = new DB('member_level');
		$ins->insert(array('uid'=>$_G['user']['uid']),1);
		$user = $_G['user'];
		$user['level']		= 0;
		$user['score']		= 0;
		$user['number']		= 0;
		$user['exp']		= 0;
		$user['multiple']	= 0;
	}
}
$data = array(
	'user'		=> $user,
	'version'	=> __VERSION__
);
echo 'this.postMessage('.$this->json($data).');';exit;