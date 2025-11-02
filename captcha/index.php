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
<script type="text/javascript">
function $(s)
{
    return document.getElementById(s);
};
function changeImg(){
	var s=$("Captcha")
	s.src=s.src+'?'+Math.ceil(Math.random() * 10000);
}
</script>
<img src="Captcha.php" border="0" alt="點擊切換驗證碼" id="Captcha" onclick="changeImg()" style="cursor:pointer;" /><br />
<br />
<br />
<br />
<body>
<div id="captcha1"> <?php echo $_SESSION['Captcha']; ?></div>
</body>
