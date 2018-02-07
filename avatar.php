<?php
if(empty($_SERVER['PATH_INFO']))exit;
$list = explode('/',trim($_SERVER['PATH_INFO'],'/'));
if(count($list)<2)exit;
function avatar($uid = 0, $size = 'small'){
	$max = 1000;
	$fol = 0;
	$dir = $uid>$max?floor($uid / $max):0;
	if($dir > $max)$fol = floor($dir/$max);
	$path = __DIR__."/data/avatar/$fol/$dir/$uid-$size.png";
	if(file_exists($path))return $path;
	return __DIR__.'/public/images/avatar-'.$size.'.png';
}
function setCacheHeader($cache = 300, $mimetype = 'image/png', $filename = null, $attachment = false){	
	$time = gmdate("D, d M Y H:i:s", time() + $cache)." GMT";
	if($filename)header('Content-Disposition:'.($attachment?'attachment;':'').' filename='.$filename); 
	header("Content-Type: $mimetype");
	header("Expires: $time");
	header('Pragma: cache'); 
	header("Cache-Control: max-age=$cache");
}

setCacheHeader(isset($list[2])?0:3600,'image/png',$list[0]);
$file = avatar($list[1], $list[0]);
readfile($file);
