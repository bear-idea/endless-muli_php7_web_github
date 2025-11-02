<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_POST["captcha"])) {
	if(($_SESSION['captcha_code'] == $_POST['captcha']) && (!empty($_SESSION['captcha_code'])) ) {
		//Passed!
		$captcha_msg="Thank you";
	}else{
		// Not passed 8-(
		$captcha_msg="invalid code";
		if(isset($_POST["MM_insert"])){
	  		unset($_POST["MM_insert"]);
		}
		if(isset($_POST["MM_update"])){
			unset($_POST["MM_update"]);
		}
	}
}
class CaptchaImage {
	var $font = "verdana.ttf";
	function hex_to_dec($hexcolor){
	//convert hex hex values to decimal ones
	$dec_color=array('r'=>hexdec(substr($hexcolor,0,2)),'g'=>hexdec(substr($hexcolor,2,2)),'b'=>hexdec(substr($hexcolor,4,2)));
	return $dec_color;
	}
	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz'; 
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}
	function CaptchaImage($width='120',$height='30',$characters='6',$hex_bg_color='FFFFFF',$hex_text_color="FF0000",$hex_noise_color="CC0000", $img_file='captcha.jpg') {
		$rgb_bg_color=$this->hex_to_dec($hex_bg_color);
		$rgb_text_color=$this->hex_to_dec($hex_text_color);
		$rgb_noise_color=$this->hex_to_dec($hex_noise_color);
		$code = $this->generateCode($characters);
		/* font size will be 60% of the image height */
		$font_size = $height * 0.60;
		$image = @imagecreate($width, $height) or die('Cannot Initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, $rgb_bg_color['r'], $rgb_bg_color['g'],$rgb_bg_color['b']);
		$text_color = imagecolorallocate($image, $rgb_text_color['r'], $rgb_text_color['g'],$rgb_text_color['b']);
		$noise_color = imagecolorallocate($image, $rgb_noise_color['r'], $rgb_noise_color['g'],$rgb_noise_color['b']);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $code);
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code);
		/* save the image */
		imagejpeg($image,$img_file);
		imagedestroy($image);
		echo "<img src=\"$img_file?".time()."\" width=\"$width\" height=\"$height\" alt=\"security code\" id=\"captchaImg\">";
		$_SESSION['captcha_code'] = $code;
	}

}

function random_color(){
    mt_srand((double)microtime()*1000000);
    $c = '';
    while(strlen($c)<6){
        $c .= sprintf("%02X", mt_rand(0, 255));
    }
    return $c;
}

?>
<?php $captcha = new CaptchaImage(100,25,5,'000000','FFFFFF',random_color());?>