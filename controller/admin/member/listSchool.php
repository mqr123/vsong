<?php
$page=isset($this->param[1]) && is_numeric($this->param[1])?$this->param[1]:1;
$user	= new DB('user as a','school as b');
if(!empty($this->param[1])&&$this->param[1]=='post'){
$ceo    = trim($_POST['ceo']);
$where	= "a.uid=b.uid and a.type=1 and (b.ceo like '%$ceo%' or b.name like '%$ceo%')";
$data 	= $user->field('b.sid,a.uid,b.tel,b.ceo,b.dateline,b.name,b.stats')
		->where($where)
	    ->limit(2, $page)
	    ->select();
 		$this->assign('data', $data);
 		$this->assign('school', $ceo);
		$this->display();
}else if(!empty($this->param[1])&&$this->param[1]=='stats'){
	$stats=$_POST['num'];
	if($stats!=''){
		if($stats=='_stats0'){$s=0;}
		else if($stats=='_stats1'){$s=1;}
		else if($stats=='_stats2'){$s=2;}
		$where	= "a.uid=b.uid and a.type=1 and b.stats=$s";
	}else{
		$where	= "a.uid=b.uid and a.type=1";
	}
		$data 	= $user->field('b.sid,a.uid,b.tel,b.ceo,b.dateline,b.name,b.stats')
				->where($where)
			    ->limit(2, $page)
			    ->select();
 		$this->assign('data', $data);
 		$this->assign('school', $stats);
		$this->display();	
}
else{
$school=isset($this->param[0])&&$this->param[1]!='ye'?$this->param[0]:'ye';
if($school=='ye'){
		$where= "a.uid=b.uid and a.type=1";	
	}
else if($school=='_stats0'||$school=='_stats1'||$school=='_stats2'){	
		if($school=='_stats0'){$s=0;}
		else if($school=='_stats1'){$s=1;}
		else if($school=='_stats2'){$s=2;}
		$where	= "a.uid=b.uid and a.type=1 and b.stats=$s";
	}
else{
$where	= "a.uid=b.uid and a.type=1 and (b.ceo like '%$school%' or b.name like '%$school%')";
}
$data 	= $user->field('b.sid,a.uid,b.tel,b.ceo,b.dateline,b.name,b.stats')
		-> where($where)
    	-> limit(2, $page)
    	-> select();
 		$this->assign('data', $data);
 		$this->assign('school', $school);
		$this->display();
}