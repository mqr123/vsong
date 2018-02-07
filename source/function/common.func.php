<?php
function getDistrict($key = array()){
	if(!is_array($key))return '';
	$dist = '';
	foreach(array('province','city','county','town') as $k){
		if(isset($key[$k]) && $key[$k] != '0')$dist .= $key[$k].',';
	}
	return trim($dist,',');
}
#浏览器缓存
#缓存时间，文档类型(可包含字符集)，文件名称
function setCacheHeader($cache = 300, $mimetype = 'text/html', $filename = null, $attachment = false){	
	$time = gmdate("D, d M Y H:i:s", time() + $cache)." GMT";
	if($filename)header('Content-Disposition:'.($attachment?'attachment;':'').' filename='.$filename); 
	header("Content-Type: $mimetype");
	header("Expires: $time");
	header('Pragma: cache'); 
	header("Cache-Control: max-age=$cache");	
}
#自定以错误
function showError($level = 0, $message = '', $path = '', $line = 0){
	switch($level){
		case E_NOTICE		:
		case E_USER_NOTICE	: $level = 1;$type = '通知';break;
		case E_WARNING		:
		case E_USER_WARNING	: $level = 2;$type = '警告';break;
		case E_ERROR		:
		case E_USER_ERROR	: $level = 3;$type = '错误';break;
		default				: $level = 4;$type = '未知错误';break; 
	}
	$dir = pathinfo($path, PATHINFO_DIRNAME);
	$before = array(
		"$dir/",
		'Undefined variable',
		'failed to open stream: ',
		'No such file or directory',
		'Invalid error type specified',
		'Use of undefined constant',
		'assumed',
		'.php'
	);
	$after = array(
		'[ROOT]',
		'未定义变量',
		'打开文件失败：',
		'文件不存在',
		'指定的错误类型无效',
		'使用未定义常数',
		'假定',
		'.tv'
	);
	$message = str_replace($before, $after, $message);
	$path = str_replace('.php','',$path);
	$path = '<span style="color:#c30">[ROOT]</span>/'.trim(str_replace(pathinfo($path,PATHINFO_DIRNAME),'',$path),'\\');
	$content = '<div style="font-size:14px;padding:10px;margin:10px 0;line-height:30px;color:#555; max-width:900px;'
		.'background:#f5f5f5; border:1px solid #ddd; font-family:\'Microsoft Yahei\'">'
		.'<div><span style="color:#aaa;float:right">等级：<a style="color:#d30">'.$level.'</a> 级</span><b style="color:#333;font-size:16px;font-weight:400">%s</b>：</div>'
		.'<div style="padding:5px 10px; background:#fff;margin:5px;border:1px solid #eee;">%s</div>'
		.'<div style="padding:0 10px;"><span style="float:right">第 <a style="color:#d30">%d</a> 行</span>路径：<font color="gray">%s</font></div></div>';
	printf($content, $type, $message, $line, $path);
}
//查看内存使用
function runinfo(){
	global $runtime;
	$id = "useMemory-".time();
	echo "<script id=\"$id\">window.runinfo = {
	memory:'".(floor(memory_get_usage()/1024*1000)/1000)." KB',
	runtime:". floor((time() + microtime() - $runtime) * 100000)/100000 ."};
	console.log('SERVER:',runinfo);
	try{document.body.removeChild(document.getElementById('$id'))}
	catch(e){}</script>";
}
//分类列表 传递一个父级分类ID返回所有子分类
function getChilds($cate,$upid){
	$arr=array();
	foreach ($cate as $v) {
		if ($v['upid']==$upid) {
			$arr[]=$v;
			$arr=array_merge($arr,getChilds($cate,$v['id']));
		}
	}
	return $arr;
}