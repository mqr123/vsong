<?php
if(empty($this->param[3]))exit;

require(__ROOT__.'/source/class/verify.class.php');
$font = __ROOT__.'/public/fonts/attractmorewomen.ttf';

$code = md5(rand());
$code = substr($code, strlen($code)-4, strlen($code));

$this->cookie($this->param[0], $code, time() + 3600);

$RGB = null;
$BG = false;
if(!empty($this->param[4])){
	if($this->param[4] == 1){
		$BG = true;
	}else{
		$RGB = explode('_',$this->param[4]);
	}
}

#第二个参数为 rgb 数组
$verify = new Verify(array(
	'code'		=> $code,
	'width'		=> $this->param[1]-4,
	'height'	=> $this->param[2]-2,
	'size'		=> $this->param[3]-2,
	'padding'	=> 1,
	'bg'		=> $BG,
	'font'		=> $font
),$RGB);
$verify->draw();
unset($verify, $data);
exit;