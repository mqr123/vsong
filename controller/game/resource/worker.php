<?php

if(empty($_G['param'][2]) || !$_G['user']['uid']){
	$this->worker(array('type'=> 'error','msg'=> '非法操作'));
}
function wQuery1($table,$where){
	$db = new DB($table);
	return $db->where($where)->search(0);
}
function wQuery2($uid){
	$db = new DB('user as u','member_level as l');
	$db->field('u.uid,u.username,u.gender,u.type,u.group,l.level,l.multiple');
	return $db->where("u.uid='$uid' and u.uid=l.uid")->search(0);
}
$uid = $_G['user']['uid'];
$user = wQuery2($uid);

$table = $_G['param'][0] && in_array($_G['param'][0],array('music','study','train'))?$_G['param'][0]:'musuc';
$scid = $_G['param'][1];
$mcid = $_G['param'][2];
$lang = array(
	'music'	=> '歌曲',
	'study'	=> '教材',
	'train'	=> '练习'
);

$myWhere = "`id`='$scid' and `uid`='$uid'";
$scene = wQuery1('scene',"`id`='$scid'");
if(!$scene)$this->worker(array('type'=> 'error','msg'=> '场景不存在','code'=>100));


/*** 今日免费 ***/
/*++++++++++++++++
//if($scene['price']>0 && !wQuery1('my_scene', $myWhere))$this->worker(array('type'=> 'error','msg'=> '尚未购买该场景','code'=>101));
++++++++++++++++++*/


$myWhere = "`id`='$mcid' and `uid`='$uid'";
$music = wQuery1($table,"`id`='$mcid'");

/*** 今日免费 ***/
/*+++++++++++++++++
if($music['price'] > 0 && !wQuery1('my_'.$table, $myWhere)){
	$music['demo'] = 30;
	//$this->worker(array('type'=> 'error','msg'=> $lang[$table].'《'.$music['title'].'》未购买','code'=>102));
}
++++++++++++++++*/

if($music['level'] > $user['level'])$this->worker(array('type'=> 'error','msg'=> '等级不够','code'=>103));

/*
$user['exp'] = array(100,500);
$user['score'] = floor((900 / 13)*100)/100;
*/



$folder = $scid>1000?floor($scid / 1000):0;
$dir = $folder>1000?floor($folder/100):0;
$file = "data/$table/$dir/$folder/$mcid";
$path = __ROOT__."/$file";

if(!file_exists($path.'.mid'))$this->worker(array('type'=> 'error','msg'=> '音乐数据文件不存在.','code'=>104));

$data = array(
	'type'	=> 'success',
	'msg'	=> '验证成功',
	'data'	=> array(
		'user'	=> $user,
		'music'	=> $music,
		'mid'	=> 'data:audio/mid;base64,'.base64_encode(file_get_contents($path.'.mid'))
	)
);

if(file_exists($path.'.ogg')){
	$data['data']['src'] = $file.'.ogg';
	//$data['data']['sound'] = 'data:audio/ogg;base64,'.base64_encode(file_get_contents($path.'.ogg'));
}

$this->worker($data);