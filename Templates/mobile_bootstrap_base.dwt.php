<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="keywords" content="<?php echo $Title_Keyword; ?>" />
<meta name="DESCRIPTION" content="<?php echo $Title_Desc; ?>" />
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
<link rel="stylesheet" type="text/css" href="<?php echo $TplCssPath; ?>/reset.css" media="screen">
<link href="<?php echo $TplCssPath; ?>/bootstrap.css" rel="stylesheet">
<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $TplCssPath; ?>/theme.css" rel="stylesheet">
<link href="<?php echo $TplCssPath; ?>/style.css" rel="stylesheet">
<link href="<?php echo $TplCssPath; ?>/CanvasMenu.css" rel="stylesheet">
<link href="<?php echo $TplCssPath; ?>/prettyPhoto.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $TplCssPath; ?>/zocial.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $TplCssPath; ?>/settings.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $TplCssPath; ?>/cbpAnimatedHeader.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $TplCssPath; ?>/royalslider.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $TplCssPath; ?>/pgwslideshow.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $TplCssPath; ?>/pgwslideshow_light.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $TplCssPath; ?>/jquery.navgoco.css" media="screen" />
<link rel="stylesheet" href="<?php echo $TplCssPath; ?>/font-awesome.min.css" type="text/css" media="screen">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="<?php echo $TplJsPath; ?>/jquery-1.11.3.min.js"></script>			
<script src="<?php echo $TplJsPath; ?>/bootstrap.min.js"></script>
<script src="<?php echo $TplJsPath; ?>/modernizr.js"></script>
<script src="<?php echo $TplJsPath; ?>/jquery.mobile.custom.min.js"></script>	
<script src="<?php echo $TplJsPath; ?>/CanvasMenu.js"></script>	
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.navgoco.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/cbpAnimatedHeader.min.js"></script>
<script src="<?php echo $TplJsPath; ?>/jquery.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.royalslider.min.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/pgwslideshow.min.js"></script>
<!-- slider settings -->
<script>
	//<![CDATA[
    $(document).ready(function() {
	if ($.fn.cssOriginal!=undefined)
	$.fn.css = $.fn.cssOriginal;
	$('.fullwidthbanner').revolution(
		{
			delay:9000,
			startwidth:1170,
			startheight:550,
			onHoverStop:"on",	
			navigationType:"none",		
			soloArrowLeftHOffset:0,
			soloArrowLeftVOffset:0,
			soloArrowRightHOffset:0,
			soloArrowRightVOffset:0,
			touchenabled:"on",			
			fullWidth:"on",
			shadow:0					
		});
	});
//]]>
</script>
<script>
$('document').ready(function () {
    $('.navbar-toggle').on('click', function () {
        $('.collapse, #mainContainer').toggleClass('in');
    });
});

$(window).resize(function () {
    if ($(window).width() > 768) {
        $('.collapse, #mainContainer').removeClass('in');
    };
});
</script>
<script src="<?php echo $TplJsPath; ?>/jquery.touchSwipe.min.js"></script>
<script src="<?php echo $TplJsPath; ?>/jquery.mousewheel.min.js"></script>				
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/scripts.js"></script>
<!-- carousel -->
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.carouFredSel-6.2.1-packed.js"></script>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($) {
	$("#slider_home").carouFredSel({ width : "100%", height : "auto",
	responsive : true,  circular : true, infinite	: false, auto : false,
	items : { width : 231, visible: { min: 1, max: 3 }
	},
	swipe : { onTouch : true, onMouse : true },
	scroll: { items: 3, },
	prev : { button : "#sl-prev", key : "left"},
	next : { button : "#sl-next", key : "right" }
	});
		});
		//]]>
	</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#mega-tp").navgoco({accordion: true});
});
</script> 
<!-- ACCORDION -->
<script type="text/javascript">
//<![CDATA[
$('.accordion').on('show hide', function (n) {
    $(n.target).siblings('.accordion-heading').find('.accordion-toggle i').toggleClass('fa-chevron-up fa-chevron-down');
});//]]>
</script> 
<!-- TemplateBeginEditable name="head" -->  
<!-- TemplateEndEditable -->
<?php if($GoogleAnalyticsCode != '') { ?> 
<?php echo $GoogleAnalyticsCode; ?>
<?php } ?>
<meta charset="utf-8">
</head>
<body>
    <!--header-->
    <div class="cbp-af-header" style="display:none">
	<div class="cbp-af-inner">
		<h1><?php require($TplPath . "/mobilelogo.php"); ?> </h1>
		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<i class="fa fa-bars"></i></button>  
					
					<!--menu-->
				<nav id="main_menu">   
					<div class="nav-collapse collapse">
                      <?php require("mainmenu_mobile.php"); ?>
					</div>
				</nav> 
			</div>
	</div>

	<div class="header">
		<div class="container">
		<!--logo-->
                    <div class="logo">
                         <?php require($TplPath . "/mobilelogo.php"); ?> 
					</div>
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<i class="fa fa-bars"></i></button>
					
					<!--menu-->
				<nav id="main_menu">   
					<div class="nav-collapse collapse">
                      <?php require("mainmenu_mobile.php"); ?>
					</div>
				</nav>
			</div>
		</div>
	<!--//header-->
	
    
    <!-- REVOLUTION SLIDER -->
            <?php //require("require_banner_homeimage_mobile.php"); ?>
    <!-- // END REVOLUTION SLIDER  -->
        
        
	<!--page--> 
           
    <!--banner-->
	<!--<div id="banner">
        <div class="container intro_wrapper">
            <div class="inner_content">
            	<?php if($TmpPublishIndicate == '1' && $OptionPublishSelect == '1'){ ?>
                	<?php require_once("require_publish_marquee_sty01.php");?> 
   			 	<?php  } ?>
            </div>
        </div>
	</div>-->
			
	<!--<div class="pad30"></div>-->
    
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
    
	<div class="container wrapper">
	<div class="inner_content">
	
	<!-- sidebar -->
		<div class="row">
			<div class="span3">
            <div id="accordion" class="accordion">	
								<div class="accordion-group">
									<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse">
									<i class="fa fa-chevron-down"></i>
									
									Catalogs</a>
									</div>
								
                                    <div class="accordion-body collapse in" id="collapse">
                                        <div class="accordion-inner ">
										   <?php require("require_tp_leftmenu_vertical_mega_menu_mobile.php"); ?>
										</div>
									</div>
							    </div>	
                            			
								
			</div>
            
            
			</div>
			
			<div class="span9">
			<!-- TemplateBeginEditable name="主內容" -->
            <!-- TemplateEndEditable -->
		    </div>
		</div>
	</div>
	</div>
	<!--//page-->
						
					<!--footer-->
		<div id="footer2">
		<div class="container">
			<div class="row">
				<div class="span12">
				<div class="copyright">
							<?php require("require_tmpfooter_mobile.php"); ?>
						</div>
						</div>
					</div>
				</div>
					</div>
					<!-- up to top -->
				<a href="#"><i class="go-top hidden-phone hidden-tablet fa fa-angle-double-up"></i></a>
				<!--//end--> 

</body>
<script type="text/javascript">
jQuery(document).ready(function() {
    $('img').addClass('img-responsive') ;
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