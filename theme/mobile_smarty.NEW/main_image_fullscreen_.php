<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html>
<!--<![endif]-->
<head>
<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=2">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="keywords" content="<?php echo $Title_Keyword; ?>" />
<meta name="description" content="<?php echo $Title_Desc; ?>" />
<meta name="author" content="<?php if($WshopTopName != ""){echo $WshopTopName;} ?>" />
<meta name="designer" content="Fullvision" />
<meta name="publisher" content="Fullvision" />
<meta name="copyright" content="Fullvision" />
<meta name="robots" content="<?php echo $SitePrivate ?>" />
<meta name="googlebot" content="<?php echo $SitePrivate ?>" />
<meta name="distribution" content="global" />
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
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />-->
<link href="<?php echo $SiteBaseUrl ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/layout-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/header-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/layout-font-rewrite.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/color_scheme/<?php echo $tplrwdbasiccolor; ?>.css" rel="stylesheet" type="text/css" id="color_scheme" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/layout-shop-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>photoFrame/photoFrame.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
<?php require_once("inc/inc_css_setting.mobile.smarty.min.php"); // 自訂樣式?>
<script type="text/javascript">var plugin_path = '<?php echo $SiteBaseUrl; ?>assets/plugins/';</script>
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery.mCustomScrollbar.css" rel="stylesheet" />
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.mCustomScrollbar.concat.min.js"></script>
<style type="text/css">
.mdhome{min-height:1px; _height:1px}
.mdhome_t{position:relative; font-size:12px}
.mdhome_t_l, .mdhome_t_r{position:absolute; top:0px; font-size:1px; overflow:hidden}
.mdhome_t_l{left:0}
.mdhome_t_r{right:0; float:right}
.mdhome_t_m{position:absolute; text-align:left; height:20px; line-height:20px}
.mdhome_t_m h3{font-size:14px; width:120px}
.mdhome_t_c{position:relative; text-align:left; overflow:hidden}
.mdhome_t_c span.a_a{text-decoration:none}
.mdhome_c{position:relative; /*overflow:hidden*/} /* 去除overflow */
.mdhome_c .mdhome_m_t, .mdhome_c .mdhome_m_c, .mdhome_c .mdhome_m_b{padding:0 0px}
.mdhome_c .mdhome_m_t, .mdhome_c .mdhome_m_b{text-align:left}
.mdhome_c_l, .mdhome_c_r{position:absolute; top:0; font-size:1px}

.mdhome_c_l{left:0}
.mdhome_c_r{right:0}
.mdhome_c_c{position:relative; zoom:1}
.mdhome_b{position:relative; overflow:hidden}
.mdhome_b_l, .mdhome_b_r{position:absolute; top:0; font-size:1px}
.mdhome_b_l{left:0}
.mdhome_b_r{right:0}
</style>
<!-- JAVASCRIPT FILES -->
<script type="text/javascript" src="https://img.shop3500.com/twemoji.min.js"></script> 
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/js/view/demo.revolution_slider.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jcolumn.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/layouts/center.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/themes/default.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.cookie.js"></script>
<script type="text/javascript">function generatetip(a,b){var c=noty({text:a,type:b,dismissQueue:!0,modal:!0,layout:"center",theme:"defaultTheme"});console.log("html: "+c.options.id)};</script>
<?php if($SiteAnimeCheck != '0') { ?>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>scrollReveal.min.js"> // 滾動特效</script>
<script> window.scrollReveal = new scrollReveal( {reset: <?php if($SiteAnimeCheck == '1') { ?>true<?php }?><?php if($SiteAnimeCheck == '2') { echo 'false'; }?>} );</script>
<?php } ?>
<?php if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $HomeStyle == 'homeboard021'){ ?>
<?php } else { ?>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.photoFrame.js"></script><?php // 圖片滿版BUG ?>
<?php } ?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php if ($SiteIndicate == 0) { ?>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.blockUI.js"></script>
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
<?php 
/*
		AVAILABLE BODY CLASSES:
		
		smoothscroll 			= create a browser smooth scroll
		enable-animation		= enable WOW animations

		bg-grey					= grey background
		grain-grey				= grey grain background
		grain-blue				= blue grain background
		grain-green				= green grain background
		grain-blue				= blue grain background
		grain-orange			= orange grain background
		grain-yellow			= yellow grain background
		
		boxed 					= boxed layout
		pattern1 ... patern11	= pattern background
		menu-vertical-hide		= hidden, open on click
		
		BACKGROUND IMAGE [together with .boxed class]
		data-background="assets/images/boxed_background/1.jpg"
	*/
?>
<body class="smoothscroll enable-animation bg-style-color clearfix">
<div id="Bk_Anime_Wrapper">
<div id="Bk_Bottom_Wrapper"> 
<!-- wrapper -->
<div id="wrapper"> 
  <!-- Top Bar -->
  <div id="topBar">
    <div class="container">      
      <!-- right -->
	  <?php require("inc/inc_frontlangselect_mobile.php"); ?>
      <!-- left -->
      <ul class="top-links list-inline pull-left">
        <?php if($_SERVER['HTTP_HOST'] == 'www.shop3500.com') { ?>
        <li><a href="http://www.shop3500.com"><img src="<?php echo $SiteBaseUrl ?>images/home/shop3500.png" width="37" height="20" style="border:none;"/></a></li>
        <?php } ?>
        <?php if($_SERVER['HTTP_HOST'] == 'www.1881shop.com') { ?>
        <li><a href="http://www.1881shop.com"><img src="<?php echo $SiteBaseUrl ?>images/home/logo_1881Shop_line_s.png" height="20" style="border:none;"/></a></li>
        <?php } ?>
        <!--<li id="Show_TopName"><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $WshopTopName; ?></a></li>-->
      </ul>
    </div>
  </div>
  <!-- /Top Bar -->
  <?php 
				/*
				AVAILABLE HEADER CLASSES

				Default nav height: 96px
				.header-md 		= 70px nav height
				.header-sm 		= 60px nav height

				.noborder 		= remove bottom border (only with transparent use)
				.transparent	= transparent header
				.translucent	= translucent header
				.sticky			= sticky header
				.static			= static header
				.dark			= dark header
				.bottom			= header on bottom
				.movetop        = header on bottom when move
				
				shadow-before-1 = shadow 1 header top
				shadow-after-1 	= shadow 1 header bottom
				shadow-before-2 = shadow 2 header top
				shadow-after-2 	= shadow 2 header bottom
				shadow-before-3 = shadow 3 header top
				shadow-after-3 	= shadow 3 header bottom

				.clearfix		= required for mobile menu, do not remove!

				Example Usage:  class="clearfix sticky header-sm transparent noborder"
				
				full-container 滿版
				*/
			?>
  <div id="header" class="header-auto <?php if ($TmpMenuEffect == '1') { echo "movetop";} else if($TmpMenuEffect == '2') { echo "bottom";} ?> sticky clearfix" data-show="mobile"> 
    <!-- TOP NAV -->
    <header id="topNav">
      <div class="container<?php if($tplrwdboxed == '3') {echo "_full";}?>">
        <?php if ($TmpMainmenuMod == '1') { ?>
        <button class="btn btn-mobile" id="sidepanel_btn"><i class="fa fa-bars" style="text-shadow:1px 1px 0px #FFFFFF"></i></button>
        <?php } else { ?>
        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse"><i class="fa fa-bars" style="text-shadow:1px 1px 0px #FFFFFF"></i></button>
        <?php } ?>
        
        <!-- Logo -->
        <div id="logo">
          <?php require($TplPath . "/mobilelogo.php"); ?>
        </div>
        <div style="clear:both"></div>
        <?php  // submenu-dark = dark sub menu ?>
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '1' && $TmpMainMenuLocation == '0' && $TmpMainmenuIndicate == 1) { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現) $TmpMainMenuLocation 為選單位置?>
        <div class="navbar-collapse nav-main-collapse collapse">
          <div id="apDiv_outmenu" data-scroll-reveal='enter right after 0.3s'>
           <div class="container">
            <nav class="nav-main">
              <div id="apDiv_dftmenu" >
                <ul id="topMain" class="nav nav-pills nav-main">
                  <?php require("mainmenu_dftype_mobile.php"); ?>
                </ul>
              </div>
            </nav>
           </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </header>
    <!-- /Top Nav --> 
  </div>
  
  <?php if ($row_RecordTmpConfig['tmpheadermodselect'] == '1') { /* 自設標題內容區 */ ?>
  <div id="TmpHeaderContext">
  <?php echo $row_RecordSystemConfigOtr['tmpheadercontext'];  ?>
  </div>
  <?php } ?>
  
  <!-- /PAGE HEADER -->
  <?php if ($TmpMainMenuLocation == '1' && $wrp_full == "0" && $TmpMainmenuIndicate == 1) { // 當自定選單採用100%寬度時採用?>
  <div <?php if ($TmpMainMenuOImg != "") { ?>style="background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuOImg; ?>); background-repeat: repeat-x;"<?php } ?>>
  <div id="HeaderAfterBanner">
  <div class="container" style="z-index:1000">
  <div id="topNav">
    <div id="apDiv_outmenu">
      <div class="navbar-collapse nav-main-collapse collapse" style="width:100%">
        <nav class="nav-main">
          <ul id="topMain" class="nav nav-pills nav-main list-group">
            <?php require("mainmenu_dftype_mobile.php"); ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <?php } ?>
  
  <!-- SLIDER -->
  <?php 
		if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $TmpHomeBannerSelect == '1') { // 當目前版面為首頁時讀取首頁橫幅
				include("require_banner_homeimage_mobile.php"); // 共通
		}else if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $HomeStyle == 'homeboard021'){
		        include("require_banner_homefullimage_mobile.php");
		}else {
		// 當版型修改的功能被關閉時 統一使用共通樣版
		if ($OptionTmpSelect == '0' && $TmpBanner != '0') {$TmpBanner = '1'; }
		//{
			switch($TmpBanner)
			{
				case "0":
					// 不使用
					//include("require_banner_slick.php"); // 共通
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
  <!-- /SLIDER -->
  
  <?php 
                /*PAGE HEADER 
                
                CLASSES:
                    .page-header-xs	= 20px margins
                    .page-header-md	= 50px margins
                    .page-header-lg	= 80px margins
                                .page-header-xlg= 130px margins
                    .dark		= dark page header
                    .light		= light page header*/
            ?>
  <?php if ($TmpWrpViewLineLocate == '2') { ?>
  <!--導覽列外框-->
  <div style="position:relative;" class="hidden-xs">
    <div class="mdviewline ViewlineBoardStyle">
      <div class="mdviewline_t">
        <div class="mdviewline_t_l"> </div>
        <div class="mdviewline_t_r"> </div>
        <div class="mdviewline_t_c"><!--標題--></div>
        <div class="mdviewline_t_m"><!--更多--></div>
      </div>
      <!--mdviewline_t-->
      <div class="mdviewline_c g_p_hide">
        <div class="mdviewline_c_l g_p_fill"> </div>
        <div class="mdviewline_c_r g_p_fill"> </div>
        <div class="mdviewline_c_c"> 
          <!-- <div class="mdviewline_m_t"></div>
                                <div class="mdviewline_m_c">  --> 
          <!--導覽列外框-->
          <section class="page-header page-header-xxs">
            <div class="container">
              <h1>&nbsp; </h1>
</div>
          </section>
          <!--導覽列外框--> 
          <!--</div>
                                              <div class="mdviewline_m_b"></div>--> 
        </div>
      </div>
      <!--mdviewline_c-->
      <div class="mdviewline_b">
        <div class="mdviewline_b_l"> </div>
        <div class="mdviewline_b_r"> </div>
        <div class="mdviewline_b_c"> </div>
      </div>
      <!--mdviewline_b--> 
    </div>
    <!--mdviewline--> 
  </div>
  <!-- 導覽列外框-->
  <?php } ?>
  <!--<section>-->
    <div class="container<?php if($tplrwdboxed == '0') {echo "_full";}?>">
    <div class="row">
		<?php if($TmpPublishIndicate == '1' && $OptionPublishSelect == '1'){ ?>
			<?php require_once("require_publish_marquee_sty01.php");?>
        <?php  } ?>
    </div>
    <?php if ($_GET['tp'] == 'Home' || $Tp_Page == 'Main' || $Tp_Page == 'Home'){ ?>
    	<?php if($HomeStyle == "homeboard001") { ?>
            <div id="l_column">
            <?php require_once("require_leftmenu_home_column_mobile.php"); ?>
            </div>
        <?php } else { ?>
        <?php } ?>
    <?php } else { ?>
    	<?php if($tplname_original == "board010") { ?>
        <?php } else { ?>
        	<div id="l_column">
            <?php require_once("require_leftmenu_column_mobile.php"); ?>
            </div>
        <?php } ?>
    <?php } ?>
      <div id="m_column" >
      <div class="row">      
        <div class="col-lg-12 col-md-12 col-sm-12">
<?php
			switch($Tp_Page)
			{
				case "Home":
					include_once("require_main_mobile.php");				
					break;			
				default:
					include_once("require_main_mobile.php");
					break;
			}
		?>
      	</div>
      </div>
      </div>
    </div>
  <!--</section>-->
  <!-- / --> 
  
  
  
  <!-- FOOTER -->
  <div style="clear:both"></div>
  <footer id="footer">
    <div class="container<?php if($tplrwdboxed == '3') {echo "_full";}?>">
      <div class="row">
        <div class="col-md-12 nomargin">
          <?php require('require_tmpfooter_mobile.php'); ?>
        </div>
      </div>
    </div>
  </footer>
  <!-- /FOOTER --> 
  <?php /* 主選單顯示模式為側邊 頁尾資料為主選單 */ ?>
  <?php if($TmpMainmenuMod == '1' || $TmpFootmenuData == '1'){ require_once("require_footer_menu_slidepanel_mainmenu.php"); } ?>
  
  <?php if ($OptionCartSelect == '1' && $tplrwdfootmenuindicate == '1') { /* 購物車用選單 */ ?>
  <?php require_once("require_footer_menu_slidepanel_product.php"); ?>
  <?php } ?>
  
  
</div>
</div>
</div>
<!-- /wrapper --> 

<!-- SCROLL TO TOP --> 
<a href="#" id="toTop"></a> 
<?php require("require_bulletin.php"); ?>
<!-- PRELOADER --> 
<!--<div id="preloader">
			<div class="inner">
				<span class="loader"></span>
			</div>
		</div>--><!-- /PRELOADER -->

</body>
<script>twemoji.parse(document.body);</script> 
</html>