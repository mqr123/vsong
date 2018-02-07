<?php
if(!empty($this->param[0])){
	$id			= $this->param[0];
	$news 		= new DB('news as n','news_content as nc'); 
	if(!empty($this->param[1]) && $this->param[1] == 'post'){
	   $id		= $this->param[0];
	   $title=trim($_POST['title']);
	   $summery=trim($_POST['summery']);
	   $content=trim($_POST['content']);
	  if(empty($_FILES['files']['name'])){
				$files='';
		}
		$new=new DB('news');
		$result=$new->where('id='.$id)->update(array('title'=>$title,'summery'=>$summery));
		if($result!==false||0!==$result){
			$news_content=new DB('news_content');
			$res=$news_content
					->where('nid='.$id)
					->update(array('content'=>$content,'files'=>$files));
			if($res!==false||0!==$res){
				echo "<script>alert('修改成功');location.href='../index';</script>";exit;
			}else{
				echo "<script>alert('修改失败');location.href='../index';</script>";exit;
			}
		}else{echo "<script>alert('修改失败');location.href='../index';</script>";exit;}
	   
	}else{
		$data = $news->field('*')->where("n.id=nc.nid and n.id=$id")->select();
		$this->assign('data', $data);
		$this->display();
		
	}
}


