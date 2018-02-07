<?php
//获取登陆者的UID
$uid = $_G['user']['uid'];
$where = "`uid` = '$uid'";
$db = new DB('school');

if(!empty($this->param[0])&&$this->param[0]=='post'){
	//机构修改部分
	$form = $this->form('school',$where);
	$success = '修改成功';
	$error = '修改失败';
	$sids = $db->field('sid')->where($where)->search();
	$sid = $sids[0]['sid'];
	$re = $db->field('stats,name,ceo,license')->where($where)->search();
	if(isset($form->data['license'])){
		$base64_img = json_decode(trim($form->data['license']));
		$base64_img=$base64_img->src;
		$max = 1000;
		$dir = $sid>$max?floor($sid / $max):0;
		$path = "data/license/$dir/";
		$this->createDir($path);
		if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
			$type = $result[2];
			if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){
				$license = $path."$sid.png";
				if(file_put_contents($license, base64_decode(str_replace($result[1], '', $base64_img)))){
					$license = str_replace('../../..', '', $license);
				}
				
			}
		}
	}else{
		$license = null;
	}	
	//机构名称或者法人变更的时候，营业执照也需要变更，
	//同时审核状态变为审核中（提示机构不能随意变更，审核过程中后台管理中心不能进入）
	if($re[0]['name']!=($form->data['name'])||$re[0]['ceo']!=($form->data['ceo'])){
		if($re[0]['license']!=$license){
			$result = array('type'=>'error','msg'=>'请上传营业执照');
			$this->json($result,1);exit;
		}
		$stats = 0;
	}else if($re[0]['license']==$license){
		$stats = 0;
	}else if($license==null){
		$license = $re[0]['license'];
		$stats=$re[0]['stats'];
	}else{
		$stats=$re[0]['stats'];
	}
	
	$county=!empty($form->data['county'])?$form->data['county']:' ';
	$town=!empty($form->data['town'])?$form->data['town']:' ';
	$form->set('stats',$stats)//设置表单中没有但是需要更改的字段
		 ->set('town',$town)
		 ->set('county',$county)
		 ->set('license',$license)             
	    //打包需要修改的字段
		->pack('name,ceo,license,summery,tel,address,province,city,county,town,district,stats')
		->submit('update',$success,$error);
		$result=$form->result();
		if($result['type']=='success'){
			//如果修改成功清除缓存
			$this->clear('school');
		}
	$this->json($result,1);	
}else{
	//机构信息展示部分	
	$school = new DB('school');
	$data = $school
	->field('name,ceo,tel,summery,province,city,county,town,address,license,volume,dateline,dateout,`update`,stats,sid')
	->where($where)
	->cache(1800)
	->select();
	$this->assign('data',$data);
	$this->display();
}

?>