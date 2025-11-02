<?php
	//initialize the session
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	switch($_GET['lang'])
	{
		case "zh-tw":
			$_SESSION['lang'] = $_GET['lang'];
			break;
		case "zh-cn":
			$_SESSION['lang'] = $_GET['lang'];
			break;
		case "en":
			$_SESSION['lang'] = $_GET['lang'];
			break;	
		case "jp":
			$_SESSION['lang'] = $_GET['lang'];
			break;	
		default:
			$_SESSION['lang'] = $defaultlang;
	}
 ?>
<style type="text/css"> 
div#LangMenu{float:right; font-size:medium}
div#LangMenu ul#menu{ margin:0px 0px;  list-style:none;  display:inline-block}
div#LangMenu ul#menu li{ padding:0px;  float:right;  position:relative;  margin-left:5px;  margin-right:5px;  width:25px;  height:25px}
div#LangMenu ul#menu li a{ position:absolute}
div#LangMenu ul#menu li img{position:absolute; width:25px; top:0px; left:0px; padding:0px; border:none; overflow:hidden; margin-top:0; margin-right:8px; margin-bottom:0; margin-left:0}
</style>
<div id="LangMenu">
  <ul id="menu">
    <?php if ($LangChooseJP == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=jp"><img src="images/lang/jp.png" alt="日本語"/></a> </li> 
    <?php } ?>
	<?php if ($LangChooseEN == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=en"><img src="images/lang/us.png" alt="English"/></a> </li>
    <?php } ?>
	<?php if ($LangChooseZHCN == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=zh-cn"><img src="images/lang/cn.png" alt="简体中文"/></a> </li>
    <?php } ?>
	<?php if ($LangChooseZHTW == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=zh-tw"><img src="images/lang/tw.png" alt="繁體中文"/></a> </li>
    <?php } ?> 
    <?php if ($GOOGLEICONChoose == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php $_SESSION['lang']?>"><img src="images/lang/google.png" alt="Google+"/></a></li>
    <?php } ?> 
    <?php if ($FBICONChoose == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php $_SESSION['lang']?>"><img src="images/lang/fb.png" alt="Facebook"/></a> </li>
    <?php } ?>
    <?php if ($PLURKICONChoose == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php $_SESSION['lang']?>"><img src="images/lang/plk.png" alt="Plurk"/></a> </li>
    <?php } ?>
    <?php if ($SITEMAPICONChoose == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php $_SESSION['lang']?>"><img src="images/lang/sitemap.png" alt="網站地圖"/></a> </li>
    <?php } ?>
    <?php if ($RSSICONChoose == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php $_SESSION['lang']?>"><img src="images/lang/rss.png" alt="RSS"/></a> </li>
    <?php } ?>
    <?php if ($MSNICONChoose == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php $_SESSION['lang']?>"><img src="images/lang/msn.png" alt="客服"/></a> </li>
    <?php } ?>
    <?php if ($MAILICONChoose == '1') { ?>
    <li> <a href="index.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php $_SESSION['lang']?>"><img src="images/lang/mail.png" alt="E-mail"/></a> </li>
    <?php } ?>
  </ul>
</div>
<div style="clear: both;"></div>

<script type="text/javascript"> 
$(function(){ 
    $("div#LangMenu ul#menu li img").bubbleup({
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


