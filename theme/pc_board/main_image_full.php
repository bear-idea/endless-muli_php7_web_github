<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="keywords" content="<?php echo $Title_Keyword; ?>">
<meta name="description" content="<?php echo $Title_Desc; ?>">
<meta name="author" content="<?php if($WshopTopName != ""){echo $WshopTopName;} ?>"> 
<meta name="designer" content="Fullvision">  
<meta name="publisher" content="Fullvision">
<meta name="copyright" content="Fullvision">
<meta name="robots" content="index,follow"> 
<meta name="googlebot" content="index,follow">
<meta name="distribution" content="global">
<meta name="content-Language" content="<?php if($_GET['lang'] == "en") {echo "en";} else if($_GET['lang'] == "zh-cn"){echo "zh-cn";} else if($_GET['lang'] == "jp") {echo "jp";}else {echo "zh-tw";}?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php if($SiteIcon != ""){echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>">
<link rel='bookmark' href='<?php if($SiteIcon != ""){echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>' type='image/x-icon'>
<!-- FB發布屬性 -->
<meta property="og:title" content="<?php echo $Title_Word ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { echo $SiteFileUrl . "/" . $_GET['wshop'];} else {echo "http://" . $_SERVER['HTTP_HOST'];} ?>">
<meta name="twitter:image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta property="og:image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta property="og:site_name" content="<?php echo $SiteName; ?>">
<meta itemprop="image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta name="google-site-verification" content="<?php echo $GoogleVerificationCode; ?>">
<meta name="msvalidate.01" content="<?php echo $YahooVerificationCode; ?>">
<title><?php echo $Title_Word ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $SiteBaseUrl ?>fonts/font-awesome/css/font-awesome.min.css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-1.8.2.min.js"></script>
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>photoFrame/photoFrame.css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.photoFrame.js"> // 相框</script>
<script type="text/javascript">
$(function(){$(".photoFrame_base").photoFrame({skin:"base",direction:"all"});$(".photoFrame_stamp").photoFrame({skin:"stamp",direction:"all"});$(".photoFrame_glass01").photoFrame({skin:"glass01",direction:"all"});$(".photoFrame_glass02").photoFrame({skin:"glass02",direction:"all"});$(".photoFrame_corner").photoFrame({skin:"corner",direction:"all"});$(".photoFrame_pick").photoFrame({skin:"pick",direction:"all"});$(".photoFrame_photographic").photoFrame({skin:"photographic",direction:"all_bottomThree"});
$(".photoFrame_photographic01").photoFrame({skin:"photographic01",direction:"all_bottomThree"});$(".photoFrame_photographic02").photoFrame({skin:"photographic02",direction:"all"});$(".photoFrame_photographic03").photoFrame({skin:"photographic03",direction:"all"});$(".photoFrame_photographic04").photoFrame({skin:"photographic04",direction:"all"});$(".photoFrame_photographic05").photoFrame({skin:"photographic05",direction:"all"});$(".photoFrame_photographic06").photoFrame({skin:"photographic06",direction:"all"});
$(".photoFrame_photographic07").photoFrame({skin:"photographic07",direction:"all"});$(".photoFrame_photographic08").photoFrame({skin:"photographic08",direction:"all"});$(".photoFrame_photographic09").photoFrame({skin:"photographic09",direction:"all"})});
</script>  
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<!--[if lte IE 6]>
<script language="javascript">
$(document).ready(function(){$.blockUI({message:'<table width="600" border="0" cellspacing="0" cellpadding="5"><tr><td width="14%" rowspan="2"><img src="ie6die/ie6-die.png" width="100" height="102" /></td><td width="86%" align="left"><span title="" closure_uid_ymkxka="66"><h3><strong>\u60a8\u6b63\u5728\u4f7f\u7528\u7684\u662f\u4ee5IE6\u70ba\u6838\u5fc3\u7684\u700f\u89bd\u5668\u700f\u89bd\u7db2\u9801\uff01</strong></h3><hr /></span> \u70ba\u4e86\u700f\u89bd\u7db2\u9801\u66f4\u5b89\u5168\u3001\u66f4\u5feb\u901f\uff0c\u8cbc\u5fc3\u5efa\u8b70\u60a8\u5347\u7d1a\u5230\u8f03\u65b0\u7684\u7248\u672c\uff0c\u6216\u662f\u6539\u7528\u5176\u4ed6\u7684\u700f\u89bd\u5668\uff0c\u4ee5\u7372\u5f97\u66f4\u597d\u7684\u4f7f\u7528\u9ad4\u9a57\u3002\u4e0b\u9762\u662f\u4e00\u4efd\u76ee\u524d\u5ee3\u53d7\u6b61\u8fce\u7684\u700f\u89bd\u5668\u5217\u8868\u3002\u53ea\u8981\u9ede\u9078\u5716\u793a\uff0c\u5373\u53ef\u9023\u5230\u5404\u81ea\u7684\u5b98\u65b9\u4e0b\u8f09\u9801\u9762\uff01<hr /></td></tr><tr><td  align="left"><a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx"><img src="ie6die/01.png" width="49" height="24" /></a><a href="http://www.mozilla.com/firefox/"><img src="ie6die/02.png" width="95" height="24" /></a><a href="http://www.google.com/chrome"><img src="ie6die/03.png" width="96" height="24" /></a><a href="http://www.apple.com/safari/download/"><img src="ie6die/04.png" width="87" height="24" /></a><a href="http://www.opera.com/download/"><img src="ie6die/05.png" width="83" height="24" /></a></td></tr></table>',
overlayCSS:{backgroundColor:"#fff"},css:{width:"600px",backgroundColor:"#000",opacity:0.6,color:"#fff",padding:"5px"}})});
</script> 
<![endif]-->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<?php
switch($MSTMP)
{
	case "userdefault":
		echo "<link href=\"". $TplCssPath ."/incstyle_free.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"". $TplCssPath ."/styleless.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"". $TplCssPath . "/vertical-mega-menu/vertical_menu_basic.css\" rel=\"stylesheet\" type=\"text/css\" />";
		break;		
	default:
?>
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<?php
		break;
}
?>
<?php require_once("inc/inc_css_setting.min.php"); // 自訂樣式?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $TmpWebWidth = "960"; ?>
<style type="text/css">
#Bk_Anime_Wrapper, #Bk_Home_Anime_Wrapper , #Bk_Home_Bottom_Wrapper, #Bk_Home_Body_Wrapper  {
	margin-top:0px;
}
.theDiv {
	min-height: <?php echo ("500" + $Tmp_Home_M_T_Height + $Tmp_Home_M_B_Height) .  "px"; ?>;
	min-width: <?php echo ($TmpWebWidth + $Tmp_Home_R_M_Width + $Tmp_Home_L_M_Width) .  $TmpWebWidthUnit; ?>;
	position: absolute;
	top: 50%;
	left: 50%;/* 邊界減去一半的寬高 */
	margin-top: -<?php echo ("500" + $Tmp_Home_M_T_Height + $Tmp_Home_M_B_Height)/2 .  "px"; ?>;
	margin-right: 0;
	margin-bottom: 0;
	margin-left: -<?php echo ($TmpWebWidth + $Tmp_Home_R_M_Width + $Tmp_Home_L_M_Width)/2 .  $TmpWebWidthUnit; ?>;	
}
.theDiv img{
	max-width: <?php echo ($TmpWebWidth) .  $TmpWebWidthUnit; ?>;
	overflow:hidden;
}
#Homefooter {
	height:60px;
}
#HomeEnter {
	position: absolute;
	margin-right: <?php echo $TmpHomeEnterMarginRight; ?>px;
	margin-bottom: <?php echo $TmpHomeEnterMarginBottom; ?>px;
	bottom: 0px;
	right: 0px;
}
.box_skitter_normal{ /*padding-top:60px;*/}
#Homelogo{ z-index:100;}
</style>
</head>
<body style="background-image:none; background-color:none;">
<div id="Top_Content"><?php require("require_top.php"); ?></div>
<div id="Bk_Home_Body_Wrapper">
<div id="Bk_Home_Anime_Wrapper">
<div id="Bk_Anime_Destroy"></div>
<div id="Bk_Home_Bottom_Wrapper">
<div class="theDiv">
<div style="position:relative;"><!--For FireFox-->
<div id="abgne_float_right_menu" style="display:none">
    	<img src="images/floatmenu_tb.png" width="50" height="20" />
    	<div id="abgne_float_right_top">
    	  <img src="images/floatmenu_top_A.png" width="50" height="35" />
  	  </div>
        <div id="abgne_float_right_context">
        	<a href="index.php"><img src="images/floatmenu_home_A.png" width="50" height="35" /></a>
            <?php if ($OptionCartSelect == '1') { ?>
            <a href="cart.php?Opt=showpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/floatmenu_cart_A.png" width="50" height="35" /></a>
            <?php } ?>
            <a href="javascript:history.go(-1); "><img src="images/floatmenu_back_A.png" width="50" height="35" /></a>
        </div>
        <div id="abgne_float_right_bottom">
        	<img src="images/floatmenu_down_A.png" width="50" height="35" />
        </div>
        <img src="images/floatmenu_db.png" width="50" height="20" />
</div>
</div>
<!--標題外框-->
<div class="mdhome HomeBoardStyle">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="mdhome_t_l"></td>
    <td class="mdhome_t_c"></td>
    <td class="mdhome_t_r"></td>
  </tr>
  <tr>
    <td class="mdhome_c_l"></td>
    <td class="mdhome_c_c">
  <!--標題外框-->
  
  <div style="height:440px; width:960px; position:relative;">
  <?php require($TplPath . "/homelogo.php"); ?>
  <div style="height:440px; overflow:hidden;"><?php require('require_banner_homeimage.php'); ?></div>
  <div id="HomeEnter" class="light_div"  data-scroll-reveal='enter right after 0.2s'><a href="<?php if($HomeType != ""){?><?php echo $SiteBaseUrl . url_rewrite(strtolower($HomeType),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php }else{ echo "#";} ?>"><?php if ($TmpHomeEnterSelect == '1' && $TmpHomeEnterPic != '' /* 若選取的按鈕為自訂圖示並且圖片圖片存在 */) { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpHomeEnterPicSource; ?>/image/<?php echo $TmpHomeEnterPic; ?>"/><?php } else { ?><div data-scroll-reveal='enter right after 0.2s'><img src="images/enter/<?php echo $TmpHomeEnterDefaultPic; ?>" /></div><?php } ?></a></div>    
   
	</td>
    <td class="mdhome_c_r"></td>
  </tr>
  <tr>
    <td class="mdhome_b_l"></td>
    <td class="mdhome_b_c"></td>
    <td class="mdhome_b_r"></td>
  </tr>
</table>
<div id="Homefooter" _height="none">
  	<div id="context" style="text-align:center;">
       <?php require('require_tmpfooter.php'); ?>
    </div>
    </div>
</div><!--mdhome-->

</div>

</div>
</div>

</div>
<!--<div id="board_footer">
	<img src="../images/board_bk.png" width="1000" height="60" /></div>-->
</body>
<script type="text/javascript">
$(function(){$(".light_div img").hover(function(){$(this).fadeTo("fast",0.5)},function(){$(this).fadeTo("fast",1)})});
</script>
<script type="text/javascript" src="js/scrollReveal.min.js"> // 滾動特效</script>
<script> window.scrollReveal = new scrollReveal( {reset: true} );</script>
</html>