<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head> 
<meta name="keywords" content="<?php echo $Title_Keyword; ?>" />
<meta name="DESCRIPTION" content="<?php echo $Title_Desc; ?>" />
<meta name ="author" content="富視網科技網頁設計" /> 
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" /> 
<meta name="publisher" content="富視網科技網頁設計" />  
<meta name="copyright" content="富視網科技網頁設計" />
<meta name="robots" content="all" />
<meta name="robots" content="index,follow" />
<meta name="revisit-after" content="7 days" />
<meta name="rating" content="general" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="zh-tw" />
<meta http-equiv="expires" content="0" />
<meta name="spiders" content="all" />
<meta name="webcrawlers" content="all" />
<meta property="og:image" content="" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
<!-- FB發布屬性 -->
<meta property="og:title" content="<?php echo $Title_Word ?>" />
<meta property="og:type" content="" />
<meta property="og:url" content="" />
<meta property="og:image" content="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?>" />
<meta property="og:site_name" content="<?php echo $SiteName; ?>" />
<title><?php echo $Title_Word ?></title>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<link href="css/thiagosf-SkitterSlideshow/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
<script src="js/thiagosf-SkitterSlideshow/jquery.animate-colors-min.js"></script>
<script src="js/thiagosf-SkitterSlideshow/jquery.skitter.min.js"></script>
<link rel="stylesheet" href="css/jqui/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.timers.js"></script>
<script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="js/jquery.dropshadow.js"></script>
<script type="text/javascript" src="js/minwt.auto_full_height.mini.js"></script>
<link rel="stylesheet" href="css/elastic.css" />
<script type="text/javascript" src="js/elastic.js"></script>
<script type="text/javascript" src="js/MSClass.js"> // 跑馬燈</script>
<link rel="stylesheet" href="css/easytooltip/easyTooltip.css" />
<script type="text/javascript" src="js/jquery.spritely-0.5.js"> // 動態背景</script>
<script type="text/javascript" src="js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<script language="javascript" src="js/jquery.tipsy.js">/*Tip*/</script>
<link href="css/tipsy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
 $(function() {
   $('a[rel=tipsy]').tipsy({fade: true, gravity: 'w'});
 });
</script>
<link rel="stylesheet" href="css/jquery.rater/jquery.rater.css" />
<script type="text/javascript" src="js/jquery.rater/jquery.rater.js"> // 評分</script>
<script type="text/javascript" src="js/jquery.bubbleup.js"> // 冒泡</script>
<link rel="stylesheet" href="css/jquery.nailthumb.1.1.min.css" />
<script type="text/javascript" src="js/jquery.nailthumb.1.1.min.js"></script>
<link rel="stylesheet" href="css/photoFrame/photoFrame.css" />
<script type="text/javascript" src="js/jquery.photoFrame.js"> // 相框</script>
<script type="text/javascript">
$(function(){$(".photoFrame_base").photoFrame({skin:"base",direction:"all"});$(".photoFrame_stamp").photoFrame({skin:"stamp",direction:"all"});$(".photoFrame_glass01").photoFrame({skin:"glass01",direction:"all"});$(".photoFrame_glass02").photoFrame({skin:"glass02",direction:"all"});$(".photoFrame_corner").photoFrame({skin:"corner",direction:"all"});$(".photoFrame_pick").photoFrame({skin:"pick",direction:"all"});$(".photoFrame_photographic").photoFrame({skin:"photographic",direction:"all_bottomThree"});
$(".photoFrame_photographic01").photoFrame({skin:"photographic01",direction:"all_bottomThree"});$(".photoFrame_photographic02").photoFrame({skin:"photographic02",direction:"all"});$(".photoFrame_photographic03").photoFrame({skin:"photographic03",direction:"all"});$(".photoFrame_photographic04").photoFrame({skin:"photographic04",direction:"all"});$(".photoFrame_photographic05").photoFrame({skin:"photographic05",direction:"all"});$(".photoFrame_photographic06").photoFrame({skin:"photographic06",direction:"all"});
$(".photoFrame_photographic07").photoFrame({skin:"photographic07",direction:"all"});$(".photoFrame_photographic08").photoFrame({skin:"photographic08",direction:"all"});$(".photoFrame_photographic09").photoFrame({skin:"photographic09",direction:"all"})});
</script>  
<link href="css/prettyPhoto.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"> // lightbox</script>
<!-- [ 上下滑動 ] -->
<script type="text/javascript">
jQuery(document).ready(function(){var a=$("#abgne_float_left_menu, #abgne_float_right_menu").offset().top;$(window).scroll(function(){$("#abgne_float_left_menu, #abgne_float_right_menu").animate({top:$(window).scrollTop()+a+"px"},{queue:!1,duration:500})});$body=window.opera?"CSS1Compat"==document.compatMode?$("html"):$("body"):$("html,body");$("#abgne_float_left_top, #abgne_float_right_top").click(function(){$body.animate({scrollTop:"0px"},400)});$("#abgne_float_left_bottom, #abgne_float_right_bottom").click(function(){$body.animate({scrollTop:$("#footer").offset().top},
800)});$("#abgne_float_left_context, #abgne_float_right_context").click(function(){$body.animate({scrollTop:$("#wrapper").offset().top},800)})});
</script>
<!-- [ 上下滑動 End ] -->
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
<?php require_once("inc/inc_css_setting.mobile.bootstrap.min.php"); // 自訂樣式?>
<script src="includes/ice/ice.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
#Bk_Anime_Wrapper, #Bk_Home_Anime_Wrapper , #Bk_Home_Bottom_Wrapper, #Bk_Home_Body_Wrapper  {
	margin-top:0px;
}
/* 外框 */
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
  <div id="HomeEnter" class="light_div"  data-scroll-reveal='enter right after 0.2s'><a href="<?php if($HomeType != ""){echo strtolower($HomeType) . ".php?wshop=" . $_GET['wshop'] . "&Opt=viewpage&tp=" . $HomeType . "&aid=" . $HomeTypeID . "&lang=" . $defaultlang;}else{ echo "#";} ?>"><?php if ($TmpHomeEnterSelect == '1' && $TmpHomeEnterPic != '' /* 若選取的按鈕為自訂圖示並且圖片圖片存在 */) { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpHomeEnterPicSource; ?>/image/<?php echo $TmpHomeEnterPic; ?>"/><?php } else { ?><div data-scroll-reveal='enter right after 0.2s'><img src="images/enter/<?php echo $TmpHomeEnterDefaultPic; ?>" /></div><?php } ?></a></div> 
  </div>   
   
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
<!-- [ 內容分頁 ] -->
<script type="text/javascript">
$(document).ready(function(){$("#page_break .num li:first").addClass("on");$("#page_break .num li").click(function(){$("#page_break div[id^='page_']").hide();$(this).hasClass("on")?$("#page_break #page_"+$(this).text()).show():($("#page_break .num li").removeClass("on"),$(this).addClass("on"),$("#page_break #page_"+$(this).text()).fadeIn("normal"))})});
</script>
<!-- [ 內容分頁 END] -->
<!-- [ 區塊等高 ] -->
<script language="javascript"> 
/*
var l=document.getElementById("Left_column").scrollHeight,m=document.getElementById("Main_content").scrollHeight,r=document.getElementById("Rght_column").scrollHeight;layoutHeight=Math.max(l,m,r);document.getElementById("Left_column").style.height=layoutHeight+"px";document.getElementById("Rght_column").style.height=layoutHeight+"px";document.getElementById("Main_content").style.height=layoutHeight+"px";
*/
</script> 
<!-- [ 區塊等高 END] --> 

<!-- [ 背景動畫 ] -->
<script language="javascript">
//jQuery(document).ready(function() {
  //$('#Bk_Anime_Wrapper').pan({fps: 30 , speed: 3, dir: 'right', depth: 100});
  //$('#Bk_Anime_Destroy').pan({fps: 30, speed: 10, dir: 'up', depth: 70});
//});
</script>
<!-- [ 背景動畫 END] -->

<!-- [ 字形切換 ] -->
<script language="javascript">
/*jQuery(document).ready(function(){fontResizer("80%","90%","100%");jQuery("div#fontdisplay").css("display","block")});*/
</script>
<!-- [ 字形切換 End ] -->
<script type="text/javascript" src="js/scrollReveal.min.js"> // 滾動特效</script>
<script> window.scrollReveal = new scrollReveal( {reset: true} );</script>
</html>