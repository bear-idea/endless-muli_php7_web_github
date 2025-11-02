<?php
session_start();
if(isset($_POST['Captcha'])) {
	if( $_POST['Captcha'] == $_SESSION['Captcha']){
		echo '<font color=blue>桄痐鎢淏';
	}else {
		echo '<font color=red>桄痐鎢渣昫';
	}
}
?>
<?php
$array = array(
		"width"=>150,
		"height"=>50,
		"strlen"=>5,
		"font"=>"fonts/DejaVuSerif.ttf",
		"sid"=>"Captcha"
	);
include("Captcha.class.php");
$new = new Captcha($array);
?>
<script type="text/javascript">
function $(si)
{
    return document.getElementById(si);
};
function changeImg(){
	var s=$("Captcha")
	s.src=s.src+'?'+Math.ceil(Math.random() * 10000);
}
</script>
<img src="Captcha.php" border="0" alt="點擊切換驗證碼" id="Captcha" onclick="changeImg()" style="cursor:pointer;" />
<?php echo $_SESSION['Captcha']; ?>