<?php
/*
* Date:2009-07-30
* Author:Wy
* content:root@jksing.com
* php Captcha soft
* Captcha.class.php
**********/

class Captcha{

	private $width;
	private $height;
	private $code;
	private $strlen;
	private $font;
	private $image;

	function __construct($Captcha) {

		$this->width 	= $Captcha['width'];
		$this->height 	= $Captcha['height'];
		$this->strlen 	= $Captcha['strlen'];
		$this->font 	= $Captcha['font'];
		$this->code 	= $this->Captcha_code($this->strlen);
		session_start();
		if(!isset($_SESSION[$Captcha['sid']])){
			session_register($Captcha['sid']);
		}
		$_SESSION[$Captcha['sid']] 	= $this->code;
		$this->image_create();
		$this->image_gradient();
		$this->image_line();
		$this->image_word();
		$this->image_out();

	}

	private function image_create(){
		if ( ! function_exists('imagegd2')){
			exit;
		}
		$this->image = imagecreatetruecolor($this->width, $this->height);
	}

	private function image_gradient($direction = null) {
			$color1 = imagecolorallocate($this->image, mt_rand(200, 255), mt_rand(200, 255), mt_rand(150, 255));
			$color2 = imagecolorallocate($this->image, mt_rand(200, 255), mt_rand(200, 255), mt_rand(150, 255));
			$directions = array('horizontal', 'vertical');
			if ( ! in_array($direction, $directions))
			{
				$direction = $directions[array_rand($directions)];
				if (mt_rand(0, 1) === 1)
				{
					$temp = $color1;
					$color1 = $color2;
					$color2 = $temp;
				}
			}
			$color1 = imagecolorsforindex($this->image, $color1);
			$color2 = imagecolorsforindex($this->image, $color2);
			$steps = ($direction === 'horizontal') ? $this->width : $this->height;
			$r1 = ($color1['red'] - $color2['red']) / $steps;
			$g1 = ($color1['green'] - $color2['green']) / $steps;
			$b1 = ($color1['blue'] - $color2['blue']) / $steps;
			if ($direction === 'horizontal') {
				$x1 =& $i;
				$y1 = 0;
				$x2 =& $i;
				$y2 = $this->height;
			} else {
				$x1 = 0;
				$y1 =& $i;
				$x2 = $this->width;
				$y2 =& $i;
			}
			for ($i = 0; $i <= $steps; $i++) {
				$r2 = $color1['red'] - floor($i * $r1);
				$g2 = $color1['green'] - floor($i * $g1);
				$b2 = $color1['blue'] - floor($i * $b1);
				$color = imagecolorallocate($this->image, $r2, $g2, $b2);
				imageline($this->image, $x1, $y1, $x2, $y2, $color);
			}
	}
	
	private function image_line(){

		for ($i = 0, $count = mt_rand(5, $this->strlen * 4); $i < $count; $i++) {
			$color = imagecolorallocatealpha($this->image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(100, 255), mt_rand(50, 120));
			imageline($this->image, mt_rand(0, $this->height), 0, mt_rand(0, $this->width), $this->height, $color);
		}

	}

	private function image_word(){

		$default_size = min($this->width, $this->height * 2) / (strlen($this->code) + 1);
		$spacing = (int) ($this->width * 0.9 / strlen($this->code));

		for ($i = 0, $strlen = strlen($this->code); $i < $strlen; $i++){
			$font = $this->font;
			$color = imagecolorallocate($this->image, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150));
			$angle = mt_rand(-40, 20);
			$size = $default_size / 10 * mt_rand(8, 12);
			$box = imageftbbox($size, $angle, $font, $this->code[$i]);
			$x = $spacing / 4 + $i * $spacing;
			$y = $this->height / 2 + ($box[2] - $box[5]) / 4;
			imagefttext($this->image, $size, $angle, $x, $y, $color, $font, $this->code[$i]);
		}
	}
	
	private function Captcha_code ($length = 4){
		$str = 'abcdefghijkmnpqrstuvwxyz23456789';
		$result = '';
		$l = strlen($str)-1;
		$num=0;
		for($i = 0;$i < $length;$i ++){
			$num = rand(0,$l);
			$result.=$str[$num];
		}
		return $result;
	}

	private function image_out(){
		Header("Content-type: image/PNG");
		ImagePNG($this->image);
		ImageDestroy($this->image);
	}
}
?>