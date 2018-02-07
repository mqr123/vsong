<?php
if(!empty($this->param[0]) && $this->param[0] == 'post'){
	$form		= $this->form('news');
	if (!empty($form->data['files'])){
		$time=date('Ymd',time());
		$imgtime=date('His',time());
		$path = "data/news/$time/";
		$this->createDir($path);
		$arr=array();
		$num=0;
		foreach(json_decode($form->data['files']) as $v){
			$img=json_decode( json_encode( $v),true)['result'];
			if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $img, $result)){
	    		$type = $result[2];
	    	if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){
	        	$files = $path."$imgtime"."-".$num.".png";
	        	if(file_put_contents($files, base64_decode(str_replace($result[1], '', $img)))){
	            	$files = str_replace('../../..', '', $files);
	        		}
	    		}
			}
			$num++;
			array_push($arr,$files);
		}
		$file=json_encode($arr);
	}else{
		$file='';
	}
	 $success	= '添加成功';
	 $error		= '添加失败';
	 $form->hash('formhash')		
			 	->set('datetime',time())
			 	->set('forwarding',0)
			 	->set('likes',0)
			 	->set('collection',0)
			 	->set('browse',0)
				->pack('title,summery,datetime,type,forwarding,likes,collection,browse')
				->submit('insert', $success, $error);  
		$result = $form->result(); 
		if($result['type'] == 'success'){
				$this->clear('news','data');
				$id=$result['data']['id'];
				$content= $this->form('news_content');
				$content
					->set('nid',$id)
					->set('files',$file)
					->pack('nid,content,files')
					->submit('insert');
			$result = $content ->result();
			if($result['type']=='success'){
				$this->clear('news_content','data');
			}	
	}
	$this->json($result,1);
}else{
	$this->display();
}