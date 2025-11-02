<!doctype html>
<html><head>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="keywords" content="<?php echo $Title_Keyword; ?>" />
<meta name="description" content="<?php echo $Title_Desc; ?>" />
<meta name="author" content="<?php if($WshopTopName != ""){echo $WshopTopName;} ?>" /> 
<meta name="designer" content="Fullvision" />
<meta name="publisher" content="Fullvision" />   
<meta name="copyright" content="Fullvision" /> 
<meta name="robots" content="index,follow" /> 
<meta name="googlebot" content="index,follow" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="<?php if($_GET['lang'] == "en") {echo "en";} else if($_GET['lang'] == "zh-cn"){echo "zh-cn";} else if($_GET['lang'] == "jp") {echo "jp";}else {echo "zh-tw";}?>" />
<link rel="Shortcut Icon" type="image/x-icon" href="<?php if($SiteIcon != ""){echo $MySiteUrl; ?>/<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>" />
<link rel='bookmark' href='<?php if($SiteIcon != ""){echo $MySiteUrl; ?>/<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>' type='image/x-icon' />
<!-- FB發布屬性 -->
<meta property="og:title" content="<?php echo $Title_Word ?>" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { echo $MySiteUrl . "/" . $_GET['wshop'];} else {echo "http://" . $_SERVER['HTTP_HOST'];} ?>" />
<meta name="twitter:image" content="<?php echo $MySiteUrl; ?>/<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?>" />
<meta property="og:image" content="<?php echo $MySiteUrl; ?>/<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?>" />
<meta property="og:site_name" content="<?php echo $SiteName; ?>" />
<meta itemprop="image" content="<?php echo $MySiteUrl; ?>/<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?>">
<meta name="google-site-verification" content="<?php echo $GoogleVerificationCode; ?>" />
<meta name="msvalidate.01" content="<?php echo $YahooVerificationCode; ?>" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Sample</title>
<!-- TemplateEndEditable -->
<link rel="stylesheet" href="<?php echo $TplCssPath; ?>/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo $TplCssPath; ?>/bootstrap-theme.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo $TplCssPath; ?>/font-awesome.min.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo $TplCssPath; ?>/style.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo $TplCssPath; ?>/responsive.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo $TplCssPath; ?>/footable.core.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo $TplCssPath; ?>/jquery.smartmenus.bootstrap.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo $TplCssPath; ?>/webslidemenucolortheme.css" media="screen">
<link href="<?php echo $TplCssPath; ?>/webslidemenu.css" rel="stylesheet">
<link href="<?php echo $TplCssPath; ?>/jquery.navgoco.css" rel="stylesheet">
<link href="css/jquery.nailthumb.1.1.min.css" type="text/css" rel="stylesheet">
<link href="<?php echo $TplCssPath; ?>/styles.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.navgoco.min.js"></script>
<script src="<?php echo $TplJsPath; ?>/jquery.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.migrate.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/modernizrr.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/bootstrap.min.js"></script>
<script type="text/javascript" src="js/freewall.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.fitvids.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/nivo-lightbox.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.appear.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/count-to.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.textillate.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.lettering.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.parallax.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/script.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.navgoco.min.js"></script>
<script src="<?php echo $TplJsPath; ?>/jquery.cookie.min.js"></script>
<script src="<?php echo $TplJsPath; ?>/webslidemenu.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.smartmenus.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.smartmenus.bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">jQuery(document).ready(function() {jQuery('.nailthumb-container').nailthumb();});</script>
<script src="<?php echo $TplJsPath; ?>/jquery.masonry.min.js"></script>
<script src="<?php echo $TplJsPath; ?>/jquery.imagesloaded.js" /></script></script>
<script src="<?php echo $TplJsPath; ?>/modernizr-transitions.js" /></script></script>
<script src="<?php echo $TplJsPath; ?>/footable.js" /></script></script>
<script type="text/javascript">$(function () {$('.footable').footable(breakpoints: {phone: 480,tablet: 1024});});</script>
<script type="text/javascript">$(document).ready(function() {$("#mega-tp").navgoco({accordion: true});});</script> 
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="<?php echo $TplJsPath; ?>/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="<?php echo $TplJsPath; ?>/ie-emulation-modes-warning.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php if ($SiteIndicate == 0) { ?>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script language="javascript">
$(document).ready(function(){$.blockUI({message:'<table width="600" border="0" cellspacing="0" cellpadding="5"><tr><td width="14%" rowspan="2"><img src="images/work.png" width="100" height="102" /></td><td width="86%" align="left"><span title="" closure_uid_ymkxka="66"><h3><strong>目前網站暫時關閉中</strong></h3><hr /></span><?php if($SiteIndicateDesc != "") { ?><?php echo $SiteIndicateDesc; ?><?php } else { ?>為了讓使用者有更良好的體驗，目前網站在維護中，貼心的建議您喝杯咖啡好好放鬆一下心情，請大家耐心等候。<?php } ?><hr /></td></tr></table>',
overlayCSS:{backgroundColor:"#fff"},css:{width:"600px",backgroundColor:"#000",opacity:0.6,color:"#fff",padding:"5px"}})});
</script> 
<?php } ?>
<!-- TemplateBeginEditable name="head" -->  
<!-- TemplateEndEditable -->
<link rel="stylesheet" type="text/css" href="<?php echo $TplCssPath; ?>/colors/<?php echo $Css_Theme_Color; ?>.css" title="<?php echo $Css_Theme_Color; ?>" media="screen">
<?php if($GoogleAnalyticsCode != '') { ?> 
<?php echo $GoogleAnalyticsCode; ?>
<?php } ?> 
<style>
.wsmenu-list li > .wsmenu-submenu{min-width:150px;}
.callusicon, .callusicon:focus, callusicon:hover {color:<?php if($TmpMobileMenuColor != "") {echo $TmpMobileMenuColor;} else {echo "#FFF";} ?>}
.animated-arrow span, .animated-arrow span:before, .animated-arrow span:after {background:<?php if($TmpMobileMenuColor != "") {echo $TmpMobileMenuColor;} else {echo "#FFF";} ?>}
</style>
<meta charset="utf-8">
</head>
<body>

<div class="wsmenucontainer clearfix">
<div class="wsmenucontent overlapblackbg"></div>
  <div class="wsmenuexpandermain slideRight">
  <a id="navToggle" class="animated-arrow slideLeft"><span></span></a>
  <?php require($TplPath . "/mobilesmalllogo.php"); ?>
  <?php if ($SitePhone != '' || $SiteCell != '') { ?>
  <a class="callusicon" href="tel:<?php if ($SitePhone != '') { echo $SitePhone; } else if ($SiteCell != ''){echo $SiteCell;} ?>"><span class="fa fa-phone"></span></a>
  <?php } ?>
  </div>
  <div class="header">
      <div class="wrapper clearfix bigmegamenu">
      <?php require($TplPath . "/mobilelogo.php"); ?>
          <nav class="wsmenu slideLeft clearfix <?php echo $Menu_Theme_Color; ?>">
            <?php require("mainmenu_mobile.php"); ?> 
          </nav>
      </div>     
  </div>
  <div id="container" class="<?php echo $Mobile_Width_Style; ?>" style="background: rgba(100%,100%,100%,0.6);">
    <header class="clearfix" style="display:none">
      <div class="top-bar <?php echo $TmpMobileBgTopLineStyle ?>">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <!-- Start 標題資訊 -->
              <!-- End 標題資訊 -->
            </div>
            <div class="col-md-6">
              <!-- Start Social Links -->
              <ul class="social-list">
              <?php if($_SERVER['HTTP_HOST'] == 'www.shop3500.com' || $_SERVER['HTTP_HOST'] == 'blog.shop3500.com') { ?>
                <li>
                  <a class="home itl-tooltip" data-placement="bottom" title="Shop3500" href="index.php"><i class="fa fa-home"></i></a>
                </li>
                <?php } else { ?>
                <li>
                  <a class="home itl-tooltip" data-placement="bottom" title="Home" href="index.php"><i class="fa fa-home"></i></a>
                </li>
                <?php } ?>
                <!--<li>
                  <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a>
                </li>
                <li>
                  <a class="dribbble itl-tooltip" data-placement="bottom" title="Dribble" href="#"><i class="fa fa-dribbble"></i></a>
                </li>
                <li>
                  <a class="linkdin itl-tooltip" data-placement="bottom" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                </li>
                <li>
                  <a class="flickr itl-tooltip" data-placement="bottom" title="Flickr" href="#"><i class="fa fa-flickr"></i></a>
                </li>
                <li>
                  <a class="tumblr itl-tooltip" data-placement="bottom" title="Tumblr" href="#"><i class="fa fa-tumblr"></i></a>
                </li>
                <li>
                  <a class="instgram itl-tooltip" data-placement="bottom" title="Instagram" href="#"><i class="fa fa-instagram"></i></a>
                </li>
                <li>
                  <a class="vimeo itl-tooltip" data-placement="bottom" title="vimeo" href="#"><i class="fa fa-vimeo-square"></i></a>
                </li>
                <li>
                  <a class="skype itl-tooltip" data-placement="bottom" title="Skype" href="#"><i class="fa fa-skype"></i></a>
                </li>-->
              </ul>
              <!-- End Social Links -->
            </div>
          </div>
        </div>
      </div>
      <!-- End Top Bar -->
      
      <!-- Start Header ( Logo & Naviagtion ) -->
      <div class="navbar navbar-default navbar-top">
        <div class="container">
		
          <div class="navbar-header">
		  <?php require($TplPath . "/mobilelogo.php"); ?>
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <!--<i class="fa fa-bars"></i>--> - MENU -
            </button>
            <!-- End Toggle Nav Link For Mobiles -->
            
          </div>
          
          <div class="navbar-collapse collapse">
            <!-- Start Navigation List -->
            <?php require("mainmenu_mobile.php"); ?>
            <!-- End Navigation List -->
          </div>
          <!--/.nav-collapse -->
        </div>
      </div>
      <!-- End Header ( Logo & Naviagtion ) -->
      
    </header>
    <!-- End Header -->
    
    
    
    <div id="main-slide" class="carousel slide" data-ride="carousel">

                <!-- Carousel inner -->
                <?php require("require_banner_homeimage_mobile.php"); ?>
                <!--/ Carousel item end -->

                
      </div>
            
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:10px 0; background: url(images/patterns/<?php echo $TmpMobileBgTitleLine; ?>.png) center #f9f9f9; display:none">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 style="color:<?php echo $TmpMobileBgTitleLineFontColor; ?>">
            <!-- TemplateBeginEditable name="標題文字" -->    
			<?php echo $ModuleName['About']; ?>
			<!-- TemplateEndEditable -->
            </h2>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Banner -->
    <div id="content1">
	<div class="container">
    <div class="row">
     	<div class="col-md-12">
            <div id="mqo" _height="none">
            <?php if($TmpPublishIndicate == '1' && $OptionPublishSelect == '1'){ ?>
                <?php require_once("require_publish_marquee_sty01.php");?> 
            <?php  } ?>
            </div>
    	</div>
    </div>
    </div>
    </div>
    

    <!-- Start Content -->
		<div id="content">
			<div class="container">
    
				<div class="row sidebar-page">        
					
					
                    
					<!-- Page Content -->
					<div class="col-md-9 page-content">
						<!-- TemplateBeginEditable name="主內容" -->
                        <!-- TemplateEndEditable -->
					</div>
					<!-- End Page Content-->
					
					<!--Sidebar-->
					<div class="col-md-3 sidebar right-sidebar">

						<!-- Categories Widget -->
                        
						<div class="widget widget-categories">
							<h4>Categories <span class="head-line"></span></h4>
							<?php require("require_tp_leftmenu_vertical_mega_menu_mobile.php"); ?>
						</div>

					</div>
					<!--End sidebar-->
					
					
					
				</div>
			</div>
		</div>
		<!-- End Content -->
    
    


    <!-- Start Footer -->
    <footer>
      <div class="container">  
      <div class="footer-widget">
          <div class="row">
            <div class="col-md-12">
              <?php require("require_tmpfooter_mobile.php"); ?>
            </div>            
          </div>
        </div>
      </div>
    </footer>
    <!-- End Footer -->
    
  </div>
  
  
</div>

  <!-- End Container -->
  
  <!-- Go To Top Link -->
  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
  
  <div id="loader">
    <div class="spinner">
      <div class="dot1"></div>
      <div class="dot2"></div>
    </div>
  </div>

</body>
<script type="text/javascript">
jQuery(document).ready(function() {
    $('.container img').addClass('img-responsive') ;
    });
</script>
<script type="text/javascript">
jQuery(document).ready(function($){
	//move nav element position according to window width
	moveNavigation();
	$(window).on('resize', function(){
		(!window.requestAnimationFrame) ? setTimeout(moveNavigation, 300) : window.requestAnimationFrame(moveNavigation);
	});

	//mobile version - open/close navigation
	$('.cd-nav-trigger').on('click', function(event){
		event.preventDefault();
		if($('header').hasClass('nav-is-visible')) $('.moves-out').removeClass('moves-out');
		
		$('header').toggleClass('nav-is-visible');
		$('.cd-main-nav').toggleClass('nav-is-visible');
		$('.cd-main-content').toggleClass('nav-is-visible');
	});

	//mobile version - go back to main navigation
	$('.go-back').on('click', function(event){
		event.preventDefault();
		$('.cd-main-nav').removeClass('moves-out');
	});

	//open sub-navigation
	$('.cd-subnav-trigger').on('click', function(event){
		event.preventDefault();
		$('.cd-main-nav').toggleClass('moves-out');
	});

	function moveNavigation(){
		var navigation = $('.cd-main-nav-wrapper');
  		var screenSize = checkWindowWidth();
        if ( screenSize ) {
        	//desktop screen - insert navigation inside header element
			navigation.detach();
			navigation.insertBefore('.cd-nav-trigger');
		} else {
			//mobile screen - insert navigation after .cd-main-content element
			navigation.detach();
			navigation.insertAfter('.cd-main-content');
		}
	}

	function checkWindowWidth() {
		var mq = window.getComputedStyle(document.querySelector('header'), '::before').getPropertyValue('content').replace(/"/g, '').replace(/'/g, "");
		return ( mq == 'mobile' ) ? false : true;
	}
});
</script>
</html>