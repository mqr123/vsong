<?php
class Verify{
	private $conf = array(
		'font'		=> '',
		'code'		=> '',
		'size'		=> 20,
		'width'		=> 80,
		'height'	=> 30,
		'rotate'	=> 0,
		'padding'	=> 0,
		'bg'		=> false
	);
	private $rgb = null;
	public function __construct($conf = array(), $rgb = null){
		foreach($conf as $key => $val)$this->conf[$key] = $val;
		$this->rgb = $rgb;
		unset($conf);
	}
	private function color($image){
		if(!$this->rgb)return imagecolorallocate($image, mt_rand(0,156), mt_rand(0,156), mt_rand(0,156));
		return imagecolorallocate($image,$this->rgb[0], $this->rgb[1], $this->rgb[2]);
	}
	public function draw(){
		$image = imagecreate($this->conf['width']+($this->conf['padding']*2),$this->conf['height']+($this->conf['padding']*2));
		if ($this->conf['bg']){
			imagecolorallocate($image,mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
		}else{
			imagecolortransparent($image,imagecolorallocate($image,255,255,255));
		}
		
		imageinterlace($image, false);
		$this->codelen = mb_strlen($this->conf['code']);
		if ($this->conf['bg']){
			#线条
			for ($i=0;$i< $this->codelen/2;$i+=1){
				$color = imagecolorallocate($image,mt_rand(100,220),mt_rand(100,220),mt_rand(100,220));
				imageline($image,mt_rand(0,$this->conf['width']),mt_rand(0,$this->conf['height']),mt_rand(0,$this->conf['width']),mt_rand(0,$this->conf['height']),$color);
			}
			#雪花
			for ($i=0;$i<2 * $this->codelen;$i+=1){
				$color = imagecolorallocate($image,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
				imagestring($image,mt_rand(1,5),mt_rand(0,$this->conf['width']),mt_rand(0,$this->conf['height']) + $this->conf['padding'],'*',$color);
			}
			#文字.
			$_x = ($this->conf['width'] - $this->conf['padding'] ) / $this->codelen;
			for ($i=0;$i<$this->codelen;$i+=1){
				$left = $_x * $i + mt_rand(1,$this->codelen) + $this->conf['padding'];
				$top = $this->conf['height'] / 1.5 + $this->conf['padding'];
				imagettftext($image,$this->conf['size'],mt_rand(-30,30),$left,$top,$this->color($image),$this->conf['font'],$this->conf['code'][$i]);
			}
		}else{
			#文字.
			$_x = ($this->conf['width'] - $this->conf['padding'] ) / $this->codelen;
			for ($i=0;$i<$this->codelen;$i+=1){
				$left = $_x * $i  + $this->conf['padding'];
				$top = $this->conf['height'] / 1.5 + $this->conf['padding'];
				imagettftext($image,$this->conf['size'],0,$left,$top,$this->color($image),$this->conf['font'],$this->conf['code'][$i]);
			}
		}
		unset($this->conf);
		header("Content-type: image/png");
		#输出为png格式.
		imagepng($image);
	}

}
?>