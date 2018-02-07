<?php
//新闻
if(!empty($this->param[1]) && $this->param[1]=='post'){
	
	$form		= $this->form('news');
	//删除新闻
	if(isset($form->data['ids'])){
		if(count(json_decode($form->data['ids']))<2){
			$id=$form->data['ids'];
		}
		$news=new DB('news');
		$news_content=new DB('news_content');
		$res=$news->where("id=$id")->delete();
		if($res){
			$re=$news_content->where("nid=$id")->delete();
			if($re){$result=array('type'=>'success','msg'=>'删除成功');}
			else{$result=array('type'=>'error','msg'=>'删除失败');}
			$this->json($result,1);
		}
	}
	
	//发布新闻
	$file=isset($form->data['license'])?$form->data['license']:'';
	$success	= '成功';
	$error		= '失败';
	$form 		->hash('formhash')
	            ->set('datetime',time())
			 	->set('forwarding',0)
			 	->set('likes',0)
			 	->set('collection',0)
			 	->set('browse',0)
				->set('uid',$_G['user']['uid'])
				->pack('uid,title,summery,datetime,type,forwarding,likes,collection,browse')
				->submit('insert', $success, $error);  
		$result = $form->result(); 
		if($result['type'] == 'success'){
		$id=$result['data']['id'];
		
		if($file!=''){
		$base64_img = json_decode(trim($file));
		$base64_img=$base64_img->src;
		$max = 1000;
		$dir = $id>$max?floor($id / $max):0;
		$path = "data/files/$dir/";
		$this->createDir($path);
		if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
			$type = $result[2];
			if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){
				$files = $path."$id.png";
				if(file_put_contents($files, base64_decode(str_replace($result[1], '', $base64_img)))){
					$files = str_replace('../../..', '', $files);
				}
				
			}
		}
	}
		$filess=!empty($files)?$files:'';
				$this->clear('news','data');
				$content= $this->form('news_content');
				$content
					->set('nid',$id)
					->set('files',$filess)
					->pack('nid,content,files')
					->submit('insert');
			$res = $content ->result();
			// $msg=$res['msg'];
			if($res['type']=='success'){
				$this->clear('news_content','data');
			}
			$this->json($res,1);
	}
}else{
	$uid=$_G['user']['uid'];
	if(!empty($this->param[0])&&$this->param[0]=='news'){
		$where="a.uid=$uid and a.id=b.nid and a.type=0";
	}else if(!empty($this->param[0])&&$this->param[0]=='enrol'){
		$where="a.uid=$uid and a.id=b.nid and a.type=1";
	}
	else if(!empty($this->param[0])&&$this->param[0]=='product'){
		$where="a.uid=$uid and a.id=b.nid and a.type=2";
	}else{$where='1=1';}
$page=isset($this->param[1])&&is_numeric($this->param[1])?$this->param[1]:1;
$db=new DB('news as a','news_content as b');
$data=$db->field('b.files,a.*')
         ->where($where)
         ->limit(3,$page)
         ->select();
$this->assign('data',$data);
$this->display();
}

?>