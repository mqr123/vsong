<?php
$page=isset($this->param[0])&&is_numeric($this->param[0])?$this->param[0]:1;
$uid=$_G['user']['uid'];
$school=new DB('school');
$res=$school->field('sid')->where("uid=$uid")->search();
$sid=$res[0]['sid'];
$db=new DB('user as a','member as b');

$actionArray = array('delete','post');
if(!empty($_G['param'][0]) && in_array($_G['param'][0], $actionArray)){
		if($_G['param'][0]=='post'){
			$this->clear('user as a,vs_member as b');
			$form = $this->form('student');
			$d=$form->data['uid'];
			$where="a.stats=0 and a.type=0 and a.uid=b.uid and b.sid=$sid and a.phone like '%$d%'";
			$data=$db->field('a.uid,a.phone,a.username,a.gender')
				->where($where)
				->limit(15,$page)
				->cache(1800)
				->select();
		foreach($data['list'] as $k=>$v){
			$data['list'][$k]['url']='home/stuInfo/'.$v['uid'];
			$data['list'][$k]['image_url']='../avatar/big/'.$v['uid'].'/'.$v['gender'];
		}
			$this->msg('','success',$data);
			exit;
}else{
	
//	$this->json($_POST,1);
//	exit;
	if($_POST['ecode'] != $this->ecode)$this->msg('非法操作');
	$ids=$_POST['ids'];
	$ids=json_decode($_POST['ids']);
	$ids=implode(',',$ids);
	$where="uid in ($ids)";
	$data=new DB('user');
	$result=$data->where($where)->update(array('stats'=>-1));
	$nums=$data->field('count("uid") as num')->where($where)->search();
	if($result){
		$row=$school->field('volume')->where('sid='.$sid)->search();
		$volume=(int)$row[0]['volume']-(int)$nums[0]['num'];
		$a=$school->where('sid='.$sid)->update(array('volume'=>$volume));
		if($a){
			$this->clear('user as a,vs_member as b');
			$res=array('type'=>'success','msg'=>'删除成功');
			$this->json($res,1);
		}
	}
	else{
		$res=array('type'=>'error','msg'=>'删除失败');
			$this->json($res,1);
	}
}
 	exit;
}else{
$data=$db->field('a.uid,a.phone,a.username,a.gender')
	->where("a.stats=0 and a.type=0 and a.uid=b.uid and b.sid=$sid")
	->limit(15,$page)
	->cache(1800)
	->select();
}
//var_dump($data);
$this->assign('data',$data);
$this->display();