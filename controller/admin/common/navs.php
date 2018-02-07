<?php
$db = new DB('admin_navs');
$roleid=$db->field('roleid')->search();
$arr=array();
function getroleid($roleid){
	$db = new DB('admin_navs');
	if($_SESSION['roleid']==0){
		return $db->field('*')->where("`id` in ($roleid) and `upid`=0")->select();
	}else{
		return $db->field('*')->where("`id` in ($roleid)")->select();
	}		
}
foreach($roleid as $v){
	$role=explode(',',$v['roleid']);
	if(in_array($_SESSION['roleid'], $role)){
		$db = new DB('admin_navs');
		$admin=$v['roleid'];
		$id=$db->field('id')->where("roleid ='$admin'")->search();
		foreach ($id as $k=>$val){
			array_push($arr,$val['id']);
		}
	}
}
$auth=implode(',',array_unique($arr));
$data=getroleid($auth);
$navs=array();
function getNavChild($upid){
	$db = new DB('admin_navs');
	return $db->field('*')->where("`upid`='$upid'")->search();
}
foreach ($data['list'] as $value){
		$child = getNavChild($value['id']);
		if(is_array($child))$value['children'] = $child;
		array_push($navs,$value);
}
 echo 'var navs = '.json_encode($navs);exit;
?>
