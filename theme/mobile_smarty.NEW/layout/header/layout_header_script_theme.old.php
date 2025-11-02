<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />-->
<link href="<?php echo $TplPluginsPath; ?>/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsUserPath; ?>/css/essentials.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsUserPath; ?>/css/layout-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsPath; ?>/css/header-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsPath; ?>/css/layout-font-rewrite.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsPath; ?>/css/color_scheme/<?php echo $tplrwdbasiccolor; ?>.css" rel="stylesheet" type="text/css" id="color_scheme" />
<link href="<?php echo $TplAssetsPath; ?>/css/layout-shop-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsPath; ?>/css/section-separators.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsPath; ?>/css/plugin-hover-buttons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsPath; ?>/css/custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsPath; ?>/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplAssetsPath; ?>/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplPluginsPath; ?>/photoFrame/photoFrame.css" rel="stylesheet" type="text/css" />
<?php require_once("inc/inc_css_setting.mobile.smarty.min.php"); // 自訂樣式?>
<script type="text/javascript">var plugin_path = '<?php echo $TplAssetsPath; ?>/plugins/';</script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script><!-- JAVASCRIPT FILES -->
<script type="text/javascript" src="https://img.shop3500.com/twemoji.min.js"></script>
<script type="text/javascript" src="<?php echo $TplAssetsPath; ?>/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo $TplAssetsPath; ?>/plugins/jquery-cookie/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo $TplAssetsPath; ?>/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo $TplAssetsPath; ?>/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo $TplAssetsPath; ?>/js/view/demo.revolution_slider.js"></script>
<script type="text/javascript" src="<?php echo $TplPluginsPath; ?>/jcolumn/jcolumn.min.js"></script>
<script type="text/javascript" src="<?php echo $TplPluginsPath; ?>/soch/soch.min.js"></script>
<script type="text/javascript" src="<?php echo $TplPluginsPath; ?>/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo $TplPluginsPath; ?>/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo $TplPluginsPath; ?>/noty/layouts/center.js"></script>
<script type="text/javascript" src="<?php echo $TplPluginsPath; ?>/noty/themes/default.js"></script>
<script type="text/javascript">function generatetip(a,b){var c=noty({text:a,type:b,dismissQueue:!0,modal:!0,layout:"center",theme:"defaultTheme"});console.log("html: "+c.options.id)};</script>
<?php if($SiteAnimeCheck != '0') { ?>
<script type="text/javascript" src="<?php echo $TplPluginsPath; ?>/scrollReveal/scrollReveal.min.js"> // 滾動特效</script>
<script> window.scrollReveal = new scrollReveal( {reset: <?php if($SiteAnimeCheck == '1') { ?>true<?php }?><?php if($SiteAnimeCheck == '2') { echo 'false'; }?>} );</script>
<?php } ?>
<?php if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $HomeStyle == 'homeboard021'){ ?>
<?php } else { ?>
<script type="text/javascript" src="<?php echo $TplPluginsPath; ?>/photoFrame/jquery.photoFrame.js"></script><?php // 圖片滿版BUG ?>
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
<?php if($GoogleAnalyticsGTM != '') { ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $GoogleAnalyticsGTM; ?>');</script>
<!-- End Google Tag Manager -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $GoogleAnalyticsGTM; ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php } ?>