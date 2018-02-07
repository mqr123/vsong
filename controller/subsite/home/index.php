<?php
$uid=isset($this->param[0])&&is_numeric($this->param[0])?$this->param[0]:'';
$db=new DB('school');
$summery=$db->field('sid,summery')->where("uid=$uid")->search();
$summerys=!empty($summery)?$summery[0]['summery']:'';

//学员展示
$member=new DB('school as a','member as b','user as c');
$sid=!empty($summery)?$summery[0]['sid']:-1;
$data=$member->field('c.username,b.age')
			->where("c.stats=0 and c.type=0 and c.uid=b.uid and b.sid=$sid")
			->limit(4,1)
			->group('c.username')
			->select();
$this->assign('summery',$summerys);
$this->assign('data',$data);
$this->display();