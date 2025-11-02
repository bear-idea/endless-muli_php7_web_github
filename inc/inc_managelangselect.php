<?php
	//initialize the session
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	switch($_GET['lang'])
	{
		case "zh-tw":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "繁體";
			break;
		case "zh-cn":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "簡體";
			break;
		case "en":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "英文";
			break;	
		case "jp":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "日文";
			break;	
		default:
			$_SESSION['lang'] = $defaultlang;
			$langname = "繁體";
	}
 ?>
<style type="text/css"> 
<!--
 
#LangMenu {
	width: 200px;
	margin-right: 35px;
}
 
#LangMenu ul#menu {
	
	margin: 0px 0px;
	list-style: none;
	display: inline-block;
}
    
#LangMenu ul#menu li {
	padding: 0px;
	float: right;
	position: relative;
	margin-left: 5px;
	margin-right: 5px;
	width: 25px;
	height: 25px;
}
 
#LangMenu ul#menu li a {
	position: absolute;
	
}
 
#LangMenu ul#menu li img {
	position: absolute;
	width: 25px;
	top: 0px;
	left: 0px;
	padding: 0px;
	border: none;
	overflow: hidden;
	margin-top: 0;
	margin-right: 30px;
	margin-bottom: 0;
	margin-left: 0;
}
-->
</style>
<script type="text/javascript" src="../js/jquery.bubbleup.js"> // 冒泡</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php require("require_mainmenu_viewline.php"); ?></td>
    <td><span id="LangMenu" style="display:none;">

  <ul id="menu">
  	<?php if ($LangChooseJP == '1') { ?>
    <li> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=viewpage&amp;lang=jp"><img src="images/lang/jp.png" alt="日本語"/></a> </li> 
    <?php } ?>
	<?php if ($LangChooseEN == '1') { ?>
    <li> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;=viewpage&amp;lang=en"><img src="images/lang/us.png" alt="English"/></a> </li>
    <?php } ?>
	<?php if ($LangChooseZHCN == '1') { ?>
    <li> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;=viewpage&amp;lang=zh-cn"><img src="images/lang/cn.png" alt="简体中文"/></a> </li>
    <?php } ?>
	<?php //if ($LangChooseZHTW == '1') { ?>
    <li> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;=viewpage&amp;lang=zh-tw"><img src="images/lang/tw.png" alt="繁體中文"/></a> </li>
    <?php //} ?> 
</ul>
</span>
</td>
  </tr>
</table>

<img src="../admin/images/<?php echo $_SESSION['lang']; ?>/icon/lang.png" width="26" height="26" alt="" />
<script type="text/javascript"> 
$(function(){
 
    $("span#LangMenu ul#menu li img").bubbleup({
		tooltip: true,// 顯示標題
		scale:35,// 放大圖片寬度
		//fontFamily:'Helvetica, Arial, sans-serif',//
		color:'#333333',// 提示字體顏色
		fontSize:12,// 提示字體大小
		fontWeight:'bold',// 字體粗細
		margin:'50 0 0 0', // 設定Alt文字位置
		inSpeed:'fast',// 滑鼠放大速度
		outSpeed:'fast'// 滑鼠縮小速度
		
	});    
});
</script>
