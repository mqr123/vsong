<?php
	$uid=$_G['user']['uid'];
	if(!empty($this->param[0])&&$this->param[0]=='post'){
		
		$member=new DB('member');
		$res=$member->field('uid,idcard')->where('uid='.$uid)->search();
		if(empty($res[0]['idcard'])){
			$result=array('type'=>'er','msg'=>'请完善个人信息');
			$this->json($result,1);
		}
		
		$form= $this->form('school');
		$name=$form->data['name'];
		$county=!empty($form->data['county'])?$form->data['county']:'';
		$town=!empty($form->data['town'])?$form->data['town']:'';
		$success	= '添加成功';
		$error		= '添加失败';
		$base64_img = trim($form->data['license']);
	   	$form->only('name')
	   		->set('dateline',time())
	   		->set('dateout',strtotime('+1 year'))
	   		->set('uid',$uid)
	   		->set('town',$town)
	   		->set('county',$county)
	   		->set('fav',0)
	   		->set('like',0)
	   		->set('stats',0)
	   		->set('order',0)
	   		->set('level',0)
	   		->set('volume',0)
			->pack('uid,name,ceo,tel,summery,address,district,province,city,county,town,volume,dateline,dateout,level,fav,like,stats,order')
			->submit('insert', $success, $error);
		  $results = $form->result(); 
		if($results['type'] == 'success'){
			$max = 1000;
			$school=new DB('school');
			$sids=$school->field('sid')->where("uid=$uid")->search();
			$sid=$sids[0]['sid'];
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
			$school->where("sid=$sid")->update(array('license'=>$license));
			$this->clear('school');
			$this->clear('user as a,vs_member as b');
			$where="name='$name'";
			$sid=$school->field('sid')->where($where)->search();
			$member=new DB('user');
			$member->where('uid='.$uid)->update(array('type'=>1));
			$m=new DB('member');
			$m->where('uid='.$uid)->update(array('sid'=>$sid[0]['sid']));
		}
		 $this->json($results,1);	
	}
	$db = new DB('school');
	$data=$db->field('name,ceo,tel,summery,address,district,license,dateline,dateout,stats')
			->where("uid=$uid")
			->cache(1800)
			->select();
	$this->assign('data',$data);
	$this->display();
	/*
	$sql = $db->field('name,ceo,tel,summery,address,district,license,dateline,dateout,stats')
	$db = new DB('school');
			->where("uid=$uid")->sql();			
	$file = __ROOT__.'/cache/database/'.$db->table.'/'. md5($sql.'1800').'.php';
	*/
?>