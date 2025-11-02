<!doctype html>
<html><!-- InstanceBegin template="/Templates/board001.dwt.php" codeOutsideHTMLIsLocked="false" --><head>
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
<meta name="robots" content="<?php echo $SitePrivate ?>">
<meta name="googlebot" content="<?php echo $SitePrivate ?>">
<meta name="distribution" content="global">
<meta name="content-Language" content="<?php if($_GET['lang'] == "en") {echo "en";} else if($_GET['lang'] == "zh-cn"){echo "zh-cn";} else if($_GET['lang'] == "jp") {echo "jp";}else if($_GET['lang'] == "kr") {echo "kr";}else {echo "zh-tw";}?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php if($SiteIcon != ""){echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>">
<link rel='bookmark' href='<?php if($SiteIcon != ""){echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>' type='image/x-icon'>
<!-- FB發布屬性 -->
<meta property="og:title" content="<?php echo $og_Title; ?>">
<meta property="og:type" content="<?php echo $og_Type; ?>">
<meta property="og:url" content="<?php echo $og_Url; ?>">
<meta name="twitter:image" content="<?php echo $og_Image; ?>">
<meta property="og:image" content="<?php echo $og_Image; ?>">
<meta property="og:site_name" content="<?php echo $SiteName; ?>">
<meta property="og:description" content="<?php echo $og_Description; ?>" >
<meta itemprop="image" content="<?php echo $og_Image; ?>">
<meta name="google-site-verification" content="<?php echo $GoogleVerificationCode; ?>">
<meta name="msvalidate.01" content="<?php echo $YahooVerificationCode; ?>">
<meta property="fb:admins" content="<?php echo $FBAdminID; ?>"/>
<meta property="fb:app_id" content="<?php echo $FBAppID; ?>"/>
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $Title_Word ?></title>
<!-- InstanceEndEditable -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/css/layout-font-rewrite.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/css/color_scheme/color.css" rel="stylesheet" type="text/css" id="color_scheme" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>fonts/Geomanist/stylesheet.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jqui/smoothness/jquery-ui-1.8.17.custom.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>elastic.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>css3menu.css" type="text/css" />
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>easytooltip/easyTooltip.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>easytooltip/footable.standalone.min.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>tipsy.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery.rater/jquery.rater.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery.nailthumb.1.1.min.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>photoFrame/photoFrame.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>prettyPhoto.css">
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>xbreadcrumbs/xbreadcrumbs.css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-1.8.2.min.js"></script>
<!-- InstanceBeginEditable name="head" -->
<?php
switch($MSTMP)
{
	case "userdefault":
		echo "<link href=\"". $TplCssPath ."/incstyle_".$tplname_original.".css\" rel=\"stylesheet\" type=\"text/css\" />";
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
<script src="includes/ice/ice.js" type="text/javascript"></script>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/skitter-master/dist/jquery.skitter.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/js/view/demo.revolution_slider.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.cookie.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.timers.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.dropshadow.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>minwt.auto_full_height.mini.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>footable.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>elastic.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jcolumn-0.2.0.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.spritely-0.5.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>imgcentering.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.tipsy.js" ></script>
<script type="text/javascript">$(function() {$('a[rel=tipsy]').tipsy({fade: true, gravity: 'w'});});</script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.rater/jquery.rater.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.bubbleup.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.photoFrame.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/layouts/center.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/themes/default.js"></script>
<script type="text/javascript">function generatetip(a,b){var c=noty({text:a,type:b,dismissQueue:!0,modal:!0,layout:"center",theme:"defaultTheme"});console.log("html: "+c.options.id)};</script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">jQuery(document).ready(function(){var a=$("#abgne_float_left_menu, #abgne_float_right_menu").offset().top;$(window).scroll(function(){$("#abgne_float_left_menu, #abgne_float_right_menu").animate({top:$(window).scrollTop()+a+"px"},{queue:!1,duration:500})});$body=window.opera?"CSS1Compat"==document.compatMode?$("html"):$("body"):$("html,body");$("#abgne_float_left_top, #abgne_float_right_top").click(function(){$body.animate({scrollTop:"0px"},400)});$("#abgne_float_left_bottom, #abgne_float_right_bottom").click(function(){$body.animate({scrollTop:$("#footer").offset().top},800)});$("#abgne_float_left_context, #abgne_float_right_context").click(function(){$body.animate({scrollTop:$("#wrapper").offset().top},800)})});</script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.blockUI.js"></script>
<!--[if lte IE 6]>
<script language="javascript">
$(document).ready(function(){$.blockUI({message:'<table width="600" border="0" cellspacing="0" cellpadding="5"><tr><td width="14%" rowspan="2"><img src="ie6die/ie6-die.png" width="100" height="102" /></td><td width="86%" align="left"><span title="" closure_uid_ymkxka="66"><h3><strong>\u60a8\u6b63\u5728\u4f7f\u7528\u7684\u662f\u4ee5IE6\u70ba\u6838\u5fc3\u7684\u700f\u89bd\u5668\u700f\u89bd\u7db2\u9801\uff01</strong></h3><hr /></span> \u70ba\u4e86\u700f\u89bd\u7db2\u9801\u66f4\u5b89\u5168\u3001\u66f4\u5feb\u901f\uff0c\u8cbc\u5fc3\u5efa\u8b70\u60a8\u5347\u7d1a\u5230\u8f03\u65b0\u7684\u7248\u672c\uff0c\u6216\u662f\u6539\u7528\u5176\u4ed6\u7684\u700f\u89bd\u5668\uff0c\u4ee5\u7372\u5f97\u66f4\u597d\u7684\u4f7f\u7528\u9ad4\u9a57\u3002\u4e0b\u9762\u662f\u4e00\u4efd\u76ee\u524d\u5ee3\u53d7\u6b61\u8fce\u7684\u700f\u89bd\u5668\u5217\u8868\u3002\u53ea\u8981\u9ede\u9078\u5716\u793a\uff0c\u5373\u53ef\u9023\u5230\u5404\u81ea\u7684\u5b98\u65b9\u4e0b\u8f09\u9801\u9762\uff01<hr /></td></tr><tr><td  align="left"><a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx"><img src="ie6die/01.png" width="49" height="24" /></a><a href="http://www.mozilla.com/firefox/"><img src="ie6die/02.png" width="95" height="24" /></a><a href="http://www.google.com/chrome"><img src="ie6die/03.png" width="96" height="24" /></a><a href="http://www.apple.com/safari/download/"><img src="ie6die/04.png" width="87" height="24" /></a><a href="http://www.opera.com/download/"><img src="ie6die/05.png" width="83" height="24" /></a></td></tr></table>',
overlayCSS:{backgroundColor:"#fff"},css:{width:"600px",backgroundColor:"#000",opacity:0.6,color:"#fff",padding:"5px"}})});
</script> 
<![endif]-->
<!--[if IE 6]>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>iepngfix_tilebg.js"></script> 
<![endif]-->
<?php if ($SiteIndicate == 0) { ?>
<script language="javascript" type="text/javascript">
$(document).ready(function(){$.blockUI({message:'<table width="600" border="0" cellspacing="0" cellpadding="5"><tr><td width="14%" rowspan="2"><img src="images/work.png" width="100" height="102" /></td><td width="86%" align="left"><span title="" closure_uid_ymkxka="66"><h3><strong>目前網站暫時關閉中</strong></h3><hr /></span><?php if($SiteIndicateDesc != "") { ?><?php echo $SiteIndicateDesc; ?><?php } else { ?>為了讓使用者有更良好的體驗，目前網站在維護中，貼心的建議您喝杯咖啡好好放鬆一下心情，請大家耐心等候。<?php } ?><hr /></td></tr></table>',
overlayCSS:{backgroundColor:"#fff"},css:{width:"600px",backgroundColor:"#000",opacity:0.6,color:"#fff",padding:"5px"}})});
</script>
<?php } ?>
<?php if($GoogleAnalyticsCodeID != '') { ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $GoogleAnalyticsCodeID; ?>', 'auto');
  ga('send', 'pageview');

</script>
<?php } ?>
<?php if($FBPixelCodeID != '') { ?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '<?php echo $FBPixelCodeID; ?>', {
em: 'insert_email_variable,'
});
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=<?php echo $FBPixelCodeID; ?>&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
<?php } ?>
<meta charset="utf-8">
</head>
<body>
<div id="Top_Content">
  <?php require("require_top.php"); ?>
</div>
<div id="Bk_Anime_Wrapper">
  <div id="Bk_Anime_Destroy"></div>
  <div id="Bk_Bottom_Wrapper">
    <?php if ($wrp_full == "1") { ?>
    <div id="header_full" >
      <div id="context">
        <div id="wrapper">
          <?php if ($MSTMP == 'default') { ?>
          <br>
          <div style="position:absolute;"><a href="index.php"><img src="../../images/logo.png" alt="logo" width="150" height="58"></a> </div>
          <br>
          <br>
          <div style="text-align:right;">
            <?php require_once("require_epaper_send.php"); ?>
          </div>
          <?php } else { ?>
          <?php require($TplPath . "/header.php"); ?>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php if ($TmpMainMenuLocation == '1') { // 當自定選單採用100%寬度時採用?>
    <div id="apDiv_outmenu">
      <div style="position:relative; width:<?php echo ($TmpWebWidth+$Tmp_Wrp_R_M_Width+$Tmp_Wrp_L_M_Width) .  $TmpWebWidthUnit; ?>; margin-left:auto; margin-right:auto;">
        <div id="apDiv_dftmenu">
          <?php require_once("mainmenu_userdfcustom.php"); ?>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php } ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="Main_Wrapper" none="true">
      <tr>
        <td id="Left_Background">&nbsp;</td>
        <td id="Middle_Wrapper"><div style="position:relative;"><!--For FireFox-->
            <div id="abgne_float_right_menu" style="display:none"> <img src="images/floatmenu_tb.png" width="50" height="20">
              <div id="abgne_float_right_top"> <img src="images/floatmenu_top_A.png" width="50" height="35"> </div>
              <div id="abgne_float_right_context"> <a href="index.php"><img src="images/floatmenu_home_A.png" width="50" height="35"></a>
                <?php if ($OptionCartSelect == '1') { ?>
                <a href="cart.php?Opt=showpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/floatmenu_cart_A.png" width="50" height="35"></a>
                <?php } ?>
                <a href="javascript:history.go(-1); "><img src="images/floatmenu_back_A.png" width="50" height="35"></a> </div>
              <div id="abgne_float_right_bottom"> <img src="images/floatmenu_down_A.png" width="50" height="35"> </div>
              <img src="images/floatmenu_db.png" width="50" height="20"> </div>
          </div>
          <div class="mdl WrpBoardStyle">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="mdl_t_l"></td>
                <td class="mdl_t_c"></td>
                <td class="mdl_t_r"></td>
              </tr>
              <tr>
                <td class="mdl_c_l"></td>
                <td class="mdl_c_c"><div id="wrapper"> 
                    <!--<div id="abgne_float_lang_menu"> 
    	<?php //require("inc/inc_frontlangselect.php"); ?>
    </div>--> 
                    <!--<div id="abgne_float_left_menu">
    	<div id="abgne_float_left_top">
        	<img src="../images/floatmenu_top.png" width="50" height="50" />
        </div>
        <div id="abgne_float_left_context">
        	<a href="index.php"><img src="../images/floatmenu_home.png" width="50" height="50" /></a>
            <a href="javascript:history.go(-1); "><img src="../images/floatmenu_back.png" width="50" height="50" /></a>
        </div>
        <div id="abgne_float_left_bottom">
        	<img src="../images/floatmenu_down.png" width="50" height="50" />
        </div>
    </div>-->
                    <?php if ($wrp_full == "0") { ?>
                    <div id="header" _height="none" >
                      <div id="context">
                        <?php if ($MSTMP == 'default') { ?>
                        <br>
                        <div style="position:absolute;"><a href="index.php"><img src="../../images/logo.png" alt="logo" width="150" height="58"></a> </div>
                        <br>
                        <br>
                        <div style="text-align:right;">
                          <?php require_once("require_epaper_send.php"); ?>
                        </div>
                        <?php } else { ?>
                        <?php require($TplPath . "/header.php"); ?>
                        <?php } ?>
                      </div>
                    </div>
                    <?php } ?>
                    <div id="mainmenu" style="position:relative;">
                      <?php  
    switch($MSMenu)
    { 
        case '0': // 客製化
            require_once("mainmenu_custom.php");		
            break;
        case '1': // 樣板
			//if ($MSLMenu != 1) { // 
			    if ($TmpMenuSelect == '0') { // 樣板使用系統預設 1:獨立樣板
            		require_once("mainmenu_dfcustom.php");
			//	}
			}	
            break;
        default:
            //require_once("mainmenu_custom.php");		
            break;
    }
	?>
                      <?php if ($TmpMainMenuLocation == '1' && $wrp_full == "0") { // 當自定選單採用100%寬度時採用?>
                      <div id="apDiv_outmenu">
                        <div id="apDiv_dftmenu">
                          <?php require_once("mainmenu_userdfcustom.php"); ?>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                    <!--  Banner  -->
                    <div id="banner" _height="none">
                      <div class="mdbanner BannerBoardStyle">
                        <div class="mdbanner_t">
                          <div class="mdbanner_t_l"> </div>
                          <div class="mdbanner_t_r"> </div>
                          <div class="mdbanner_t_c"><!--標題--></div>
                          <div class="mdbanner_t_m"><!--更多--></div>
                        </div>
                        <!--mdbanner_t-->
                        <div class="mdbanner_c g_p_hide">
                          <div class="mdbanner_c_l g_p_fill"> </div>
                          <div class="mdbanner_c_r g_p_fill"> </div>
                          <div class="mdbanner_c_c"> 
                            <!-- <div class="mdbanner_m_t"></div>
					<div class="mdbanner_m_c">  -->
                            <div id="context">
                              <?php 
		if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $TmpHomeBannerSelect == '1') { // 當目前版面為首頁時讀取首頁橫幅
				include("require_banner_homeimage.php"); // 共通
		}else {
		// 當版型修改的功能被關閉時 統一使用共通樣版
		if ($OptionTmpSelect == '0' && $TmpBanner != '0') {$TmpBanner = '1'; }
		//{
			switch($TmpBanner)
			{
				case "0":
					// 不使用
				break;
				case "1":
					include("require_banner.php"); // 共通
				break;
				case "2":
					include("require_tmpbanner.php"); // 獨立
				break;
				case "3":
				    if($TmpBannerChooseSelect == '1')
					{
						include("require_selectbanner.php"); // 單圖選擇
					}else{
						require($TplPath . "/bannerpic.php"); // 單圖
					}
					
				break;
				case "4":
					include("require_tmpbannermuli.php"); // 獨立
				break;
				default:
				break;
			}
		}
		//}
		?>
                            </div>
                            <!--</div>
					<div class="mdbanner_m_b"></div>--> 
                          </div>
                        </div>
                        <!--mdbanner_c-->
                        <div class="mdbanner_b">
                          <div class="mdbanner_b_l"> </div>
                          <div class="mdbanner_b_r"> </div>
                          <div class="mdbanner_b_c"> </div>
                        </div>
                        <!--mdbanner_b--> 
                      </div>
                      <!--mdbanner--> 
                    </div>
                    <!--  Banner  END -->
                    <div id="mqo" _height="none">
                      <?php if($TmpPublishIndicate == '1' && $OptionPublishSelect == '1'){ ?>
                      <?php require_once("require_publish_marquee_sty01.php");?>
                      <?php  } ?>
                    </div>
                    <!-- InstanceBeginEditable name="導覽列" -->
<?php if ($TmpWrpViewLineLocate == '2') { ?>               
<!--導覽列外框-->
<div style="position:relative;">
<div class="mdviewline ViewlineBoardStyle">
	<div class="mdviewline_t">
			<div class="mdviewline_t_l"> </div>
			<div class="mdviewline_t_r"> </div>
			<div class="mdviewline_t_c"><!--標題--></div>
			<div class="mdviewline_t_m"><!--更多--></div>
	</div><!--mdviewline_t-->
	<div class="mdviewline_c g_p_hide">
			<div class="mdviewline_c_l g_p_fill"> </div>
			<div class="mdviewline_c_r g_p_fill"> </div>
			<div class="mdviewline_c_c">
					<!-- <div class="mdviewline_m_t"></div>
					<div class="mdviewline_m_c">  --> 
			    <!--導覽列外框--> 
                <?php require("require_attractions_viewline.php"); ?>
                <!--導覽列外框-->
  				<!--</div>
					<div class="mdviewline_m_b"></div>-->
			</div>
	</div><!--mdviewline_c-->
	<div class="mdviewline_b">
			<div class="mdviewline_b_l"> </div>
			<div class="mdviewline_b_r"> </div>
			<div class="mdviewline_b_c"> </div>
	</div><!--mdviewline_b-->
</div><!--mdviewline-->
</div>
<!-- 導覽列外框-->
<?php } ?>
<!-- InstanceEndEditable -->
                    <div id="Left_column">
                      <div id="context">
                        <?php 
			if($_GET['tp'] == 'Blog' || $Tp_Page == 'Blog'){
				require_once("require_leftmenu_blog_column.php");
			}else if ($_GET['tp'] == 'Home' || $Tp_Page == 'Main' || $Tp_Page == 'Home'){
				require_once("require_leftmenu_home_column.php");
			} else {
				require_once("require_leftmenu_column.php");
			}
		?>
                      </div>
                    </div>
                    <div id="shangxia">
                      <div id="shang"></div>
                      <div id="comt"></div>
                      <div id="xia"></div>
                    </div>
                    <div id="Content_containter" _height="auto">
                      <div id="Main_content">
                        <div id="context" > <!-- InstanceBeginEditable name="主內容" -->
        <div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container">
<?php if ($TmpWrpViewLineLocate == '1') { ?>               
<!--導覽列外框-->
<div style="position:relative;">
<div class="mdviewline ViewlineBoardStyle">
	<div class="mdviewline_t">
			<div class="mdviewline_t_l"> </div>
			<div class="mdviewline_t_r"> </div>
			<div class="mdviewline_t_c"><!--標題--></div>
			<div class="mdviewline_t_m"><!--更多--></div>
	</div><!--mdviewline_t-->
	<div class="mdviewline_c g_p_hide">
			<div class="mdviewline_c_l g_p_fill"> </div>
			<div class="mdviewline_c_r g_p_fill"> </div>
			<div class="mdviewline_c_c">
					<!-- <div class="mdviewline_m_t"></div>
					<div class="mdviewline_m_c">  --> 
			    <!--導覽列外框--> 
                <?php require("require_attractions_viewline.php"); ?>
                <!--導覽列外框-->
  				<!--</div>
					<div class="mdviewline_m_b"></div>-->
			</div>
	</div><!--mdviewline_c-->
	<div class="mdviewline_b">
			<div class="mdviewline_b_l"> </div>
			<div class="mdviewline_b_r"> </div>
			<div class="mdviewline_b_c"> </div>
	</div><!--mdviewline_b-->
</div><!--mdviewline-->
</div>
<!-- 導覽列外框-->
<?php } ?>
                </div>
            </div>
        </div>        
		</div>
        <?php
			switch($_GET['Opt'])
			{
				case "viewpage":
					include_once("require_attractions.php");				
					break;
				case "detailed":
					include_once("require_attractions_detailed.php");				
					break;
				default:
					include_once("require_attractions.php");
					break;
			}
		?>
      	<!-- InstanceEndEditable --> </div>
                      </div>
                      <div id="Right_column">
                        <div id="context"> <!-- InstanceBeginEditable name="右選單" -->
     	
        <!-- InstanceEndEditable -->
                          <?php 
		    if($wrp_column_plus == '1') {
				if($_GET['tp'] == 'Blog' || $Tp_Page == 'Blog'){
					//require_once("require_leftmenu_blog_column.php");
				}else if ($_GET['tp'] == 'Home' || $Tp_Page == 'Main' || $Tp_Page == 'Home'){
					require_once("require_rightmenu_home_column.php");
				} else {
					require_once("require_rightmenu_column.php");
				}
			}
		?>
                        </div>
                      </div>
                    </div>
                    <div style="clear:both"></div>
                    <?php if ($wrp_full == "0") { ?>
                    <div id="footer" _height="none"> 
                      <!--<div id="floatblock">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" align="left" valign="bottom"><img src="../images/left_float_footer.png" width="200" height="100" /></td>
            <td width="50%" align="right"><img src="../images/right_float_footer.png" width="200" height="150" /></td>
            <td>&nbsp;</td>
            </tr>
        </table> 
	</div> 	-->
                      <div id="context">
                        <?php require('require_tmpfooter.php'); ?>
                      </div>
                    </div>
                    <?php } ?>
                  </div></td>
                <td class="mdl_c_r"></td>
              </tr>
              <tr>
                <td class="mdl_b_l"></td>
                <td class="mdl_b_c"></td>
                <td class="mdl_b_r"></td>
              </tr>
            </table>
          </div>
          
          <!--mdl--></td>
        <td  id="Right_Background">&nbsp;</td>
      </tr>
    </table>
  </div>
  <?php if ($wrp_full == "1") { ?>
  <div id="footer_full">
    <div id="context">
      <?php require('require_tmpfooter.php'); ?>
    </div>
  </div>
  <?php } ?>
</div>
<!--<div id="board_footer">
	<img src="../images/board_bk.png" width="1000" height="60" /></div>--> 
<a href="#" class="scrollup">Scroll</a>
</body>
<script type="text/javascript">jQuery(document).ready(function() {$('img').addClass('img-responsive');});</script>
<script type="text/javascript">
$(function(){$(".div_table-cell img, .div_table-cell_frilinkqlink img").hover(function(){$(this).fadeTo("fast",0.5)},function(){$(this).fadeTo("fast",1)})});
</script>
<!-- [ 內容分頁 ] -->
<script type="text/javascript">
$(document).ready(function(){$("#page_break .num li:first").addClass("on");$("#page_break .num li").click(function(){$("#page_break div[id^='page_']").hide();$(this).hasClass("on")?$("#page_break #page_"+$(this).text()).show():($("#page_break .num li").removeClass("on"),$(this).addClass("on"),$("#page_break #page_"+$(this).text()).fadeIn("normal"))})});
</script>
<!-- [ 內容分頁 END] -->
<script type="text/javascript">
$(document).ready(function(){$(window).scroll(function(){100<$(this).scrollTop()?$(".scrollup").fadeIn():$(".scrollup").fadeOut()});$(".scrollup").click(function(){$("html, body").animate({scrollTop:0},600);return!1})});
</script>
<script type="text/javascript"> $('.Img_Center img').imgCentering({'forceSmart': true});</script>
<?php if($SiteAnimeCheck != '0') { ?>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>scrollReveal.min.js"> // 滾動特效</script>
<script> window.scrollReveal = new scrollReveal( {reset: <?php if($SiteAnimeCheck == '1') { ?>true<?php }?><?php if($SiteAnimeCheck == '2') { echo 'false'; }?>} );</script>
<?php } ?>
<?php require("require_magic.php"); ?>
<?php require("require_bulletin.php"); ?>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>xbreadcrumbs/xbreadcrumbs.js"></script>
<script type="text/javascript">$(document).ready(function(){$('#breadcrumbs-1').xBreadcrumbs();});</script>
<script type="text/javascript">
jQuery(document).ready(function() {
    /*var _leftheight = jQuery("#wrapper #Left_column #context").height();
        _rightheight = jQuery("#wrapper #Content_containter #Main_content #context").height();
        if(_leftheight > _rightheight ) {
            jQuery("#wrapper #Content_containter #Main_content #context").height(_leftheight);
        }
        else {
            jQuery("#wrapper #Left_column #context").height(_rightheight);
        }
    });*/
</script>
<!-- InstanceEnd --></html>