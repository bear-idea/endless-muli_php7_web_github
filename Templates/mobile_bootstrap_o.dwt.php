<!doctype html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="<?php echo $TplCssPath; ?>/normalize.css" />
<!--Bootstrap-->
<link rel="stylesheet" href="<?php echo $TplCssPath; ?>/bootstrap-theme.css" />
<link rel="stylesheet" href="<?php echo $TplCssPath; ?>/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/bootstrap.min.js"></script>
<!--Bootstrap-->

<!--Main Menu File-->
<link href="<?php echo $TplCssPath; ?>/webslidemenu.color-theme.css" rel="stylesheet">
<link href="<?php echo $TplCssPath; ?>/webslidemenu.css" rel="stylesheet">
<link href="<?php echo $TplCssPath; ?>/queries.css" rel="stylesheet">
<!--Main Menu File-->
<link href="<?php echo $TplCssPath; ?>/jquery.navgoco.css" rel="stylesheet">
<!-- font awesome -->
<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- font awesome -->

<!--For Demo Only (Remove below css file and Javascript) -->
<link href="<?php echo $TplCssPath; ?>/styles.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- 初始 -->
			
<script src="<?php echo $TplJsPath; ?>/modernizr.js"></script>
<script type="text/javascript" src="<?php echo $TplJsPath; ?>/jquery.navgoco.min.js"></script>
<script src="<?php echo $TplJsPath; ?>/jquery.cookie.min.js"></script>
<!-- 元件 -->
<script src="<?php echo $TplJsPath; ?>/webslidemenu.js"></script>
<!-- 適應性 -->
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="<?php echo $TplJsPath; ?>/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="<?php echo $TplJsPath; ?>/ie-emulation-modes-warning.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function() {
    $("#mega-tp").navgoco({accordion: true});
});
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
<!-- TemplateBeginEditable name="head" -->  
<!-- TemplateEndEditable -->
<?php if($GoogleAnalyticsCode != '') { ?> 
<?php echo $GoogleAnalyticsCode; ?>
<?php } ?> 
<meta charset="utf-8">
</head>
<style>
.header{
	background:url(images/topbg.jpg) top center no-repeat;
}
.wsmenu-list li > .wsmenu-submenu{
	min-width:150px;
}
body{background-image:url(images/home/c_b_k.png)}
.wrapper { }
</style>
<?php //require("mainmenu_mobile.php"); ?>
<body>
<div class="wsmenucontainer clearfix">
<div class="wsmenucontent overlapblackbg"></div>
  <div class="wsmenuexpandermain slideRight">
  <a id="navToggle" class="animated-arrow slideLeft"><span></span></a>
  <?php require($TplPath . "/mobilesmalllogo.php"); ?>
  <a class="callusicon" href="tel:123456789"><span class="fa fa-phone"></span></a>
  </div>
  
  <div class="header">
      <div class="wrapper clearfix bigmegamenu">
      
      <?php require($TplPath . "/mobilelogo.php"); ?>
    
      <!--Main Menu HTML Code-->
          <nav class="wsmenu slideLeft clearfix">
            <?php require("mainmenu_mobile.php"); ?> 
          </nav>    
      <!--Menu HTML Code--> 

      
      </div>       
  </div>
  
  
<div class="wrapper">    
    <div class="container" style="">
    <div class="row">
        <div class="col-sm-3">
        
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
        <div class="col-sm-9">
			<!-- TemplateBeginEditable name="主內容" -->
            <!-- TemplateEndEditable -->
        </div>
    </div>          
</div>




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
            
            
            
			</div>
			
			<div class="span9">
			
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


       
          
            
</div>
</div>

  
</div>



					<!-- up to top -->
				<a href="#"><i class="go-top hidden-phone hidden-tablet fa fa-angle-double-up"></i></a>
				<!--//end--> 

</body>
<script type="text/javascript">
/*jQuery(document).ready(function() {
    $('img').addClass('img-responsive') ;
    });*/
</script>
</html>