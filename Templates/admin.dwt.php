<?php require_once("../inc/inc_function.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />  
<meta name="DESCRIPTION" content="" /> 
<meta name ="author" content="富視網科技網頁設計" />  
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" />
<meta name="publisher" content="富視網科技網頁設計" />
<meta name="copyright" content="富視網科技網頁設計" />
<meta name="robots" content="noindex,nofollow" />
<meta name="revisit-after" content="7 days" />
<meta name="rating" content="general" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="zh-tw" />
<meta http-equiv="expires" content="0" />
<meta name="spiders" content="all" />  
<meta name="webcrawlers" content="all" />
<link rel='icon' href='../admin/favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='../admin/favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='../admin/favicon.ico' type='image/x-icon' />
<!-- TemplateBeginEditable name="doctitle" -->
<title>後台管理系統</title>
<!-- TemplateEndEditable -->
<link rel="stylesheet" type="text/css" href="<?php echo $SiteBaseUrl; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css"/>
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/layout-font-rewrite.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/essentials.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/layout_front.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/header-1.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme"/>
      
<link href="css/jquery.miniColors.css" rel="stylesheet" type="text/css" />
<link href="css/jQuery-Tags-Input/jquery.tagsinput.css" rel="stylesheet" type="text/css" />
<link href="css/tipsy.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery.d.checkbox.css" rel="stylesheet" type="text/css" />
<link href="../css/fontsizer.css" rel="stylesheet" type="text/css" />
<link href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<link href="css/vertical-accordion-menu/skins/grey.css" rel="stylesheet" type="text/css" />
<!--<link href="../admin/css/incstyle.css" rel="stylesheet" type="text/css" />-->
<link href="../admin/css/styleless.css" rel="stylesheet" type="text/css" />
<link href="../admin/css/obj-style.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="css/introjs.min.css" rel="stylesheet" type="text/css" />
<link href="css/cropper.css" rel="stylesheet" type="text/css" />
<link rel="../stylesheet" href="css/jquery.nailthumb.1.1.min.css" />
<link rel="stylesheet" href="css/colorbox/colorbox.css" />
<style type="text/css">input.blur {color: #999;}</style>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript">var plugin_path = '<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/';</script>
<!--<script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>-->
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script type="text/javascript" language="javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script>
$(document).ready(function(){$(".colorbox_iframe").colorbox({iframe:!0,width:"90%",height:"90%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_small").colorbox({iframe:!0,width:"1000px",height:"80%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_cd").colorbox({iframe:!0,width:"99%",height:"99%",fixed:!0,rel:"nofollow"});$(".youtube").colorbox({iframe:true, innerWidth:900, innerHeight:506});});
</script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/minwt.auto_full_height.mini.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<script type="text/javascript" src="../js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="js/cropper.js"></script>
<script type="text/javascript" src="../js/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript" src="../js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="../js/noty/layouts/center.js"></script>
<!-- You can add more layouts if you want -->
<script type="text/javascript" src="../js/noty/themes/default.js"></script>
<script type="text/javascript"> 
function generatetip(a,b){var c=noty({text:a,type:b,dismissQueue:!0,modal:!0,layout:"center",theme:"defaultTheme"});console.log("html: "+c.options.id)};
</script>
<script type="text/javascript" src="js/jquery.miniColors.min.js">/*顏色選擇*/</script>
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script type="text/javascript">$(function(){$("#SiteKeyWord,#skeyword").tagsInput({width:"auto",defaultText:"\u52a0\u5165\u95dc\u9375\u5b57"})});</script> 
<script type="text/javascript" src="js/jquery.hint.js"></script>
<script type="text/javascript">$(function(){$("input[title!='']").hint();}); // title="?"</script>
<script type="text/javascript" src="../js/selectboxes.js">/*連動選單*/</script>
<script language="javascript" src="../js/jquery.jeditable.js">/*原地編輯*/</script>
<script language="javascript" src="js/jquery.qtip-1.0.0-rc3.min.js">/*Tip*/</script>
<script language="javascript" src="js/intro.min.js"></script>
<script language="javascript" src="js/jquery.tipsy.js">/*Tip*/</script>
<script type="text/javascript">$(function(){$("a[rel=tipsy]").tipsy({fade:!0,gravity:"w"});$("a[rel=tipsy_n]").tipsy({fade:!0,gravity:"s"});$("a[rel=tipsy_l]").tipsy({fade:!0,gravity:"ne"});$("a[rel=tipsy_html]").tipsy({fade:!0,gravity:"s",html:!0})});</script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.cookie.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.dcjqaccordion.2.7.min.js'></script> 
<script type="text/javascript">
$(document).ready(function(a){a("#accordion-2, #accordion-3").dcAccordion({eventType:"click",autoClose:!1,saveState:!0,disableLink:!0,speed:"fast",classActive:"active",showCount:!1})});</script>
<!-- jquery-vertical-accordion-menu END-->
<script type="text/javascript">
$.editable.addInputType("datepicker",{element:function(){var a=$('<input class="input" />');a.attr("readonly","readonly");$(this).append(a);return a},plugin:function(){$("input",this).datepicker({changeMoneth:!0,changeYear:!0,dateFormat:"yy-mm-dd"})}});
</script> 
<script type="text/javascript" src="../js/jquery.corners.min.js"></script>
<script language=javascript src="js/address.js"></script><!--引入郵遞區號.js檔案-->
<script type="text/javascript" src="../js/iframe.js"></script>
<script type="text/javascript" src="../js/fontsizer.jquery.js"></script>
<script src="../js/jquery.d.checkbox.min.js"></script> 
<script>
$(document).ready(function(){$(":checkbox").d_checkbox();$(":radio").d_radio()});
</script>
<script type="text/javascript">$(document).ready(function(){$(".rounded").corners()});</script>
<!-- [ Sort Table ] --> 
<script language="javascript" src="../js/jquery.tablesorter.min.js"></script>
<script type="text/javascript">$(document).ready(function(){$("#TBSort").tablesorter({widgets:["zebra"]})}); </script>
<!-- [ Sort Table End ] -->
<!-- [ reflection ] -->
<script type="text/javascript" src="../js/reflection.js"></script> 
<script type="text/javascript">$(document).ready(function(){$("#ref_thumb img").reflect()});</script>
<script type="text/javascript">function MM_preloadImages(){var a=document;if(a.images){a.MM_p||(a.MM_p=[]);var b,d=a.MM_p.length,c=MM_preloadImages.arguments;for(b=0;b<c.length;b++)0!=c[b].indexOf("#")&&(a.MM_p[d]=new Image,a.MM_p[d++].src=c[b])}};</script>
<!-- [ reflection End ] -->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<!-- TemplateBeginEditable name="head" --> 
<!-- TemplateEndEditable -->
</head>
<style type="text/css"><?php if ($_SESSION['lang'] == 'en') { ?>#wrapper #Content_containter #Main_content { background-image:url(images/Main_content_en_bg.jpg); background-repeat:no-repeat; background-position:205px 0px;}<?php } else if ($_SESSION['lang'] == 'zh-cn') { ?>#wrapper #Content_containter #Main_content { background-image:url(images/Main_content_cn_bg.jpg); background-repeat:no-repeat; background-position:205px 0px;}<?php } else if ($_SESSION['lang'] == 'jp') { ?>#wrapper #Content_containter #Main_content { background-image:url(images/Main_content_jp_bg.jpg); background-repeat:no-repeat; background-position:205px 0px;}<?php } ?>#Mg_Logo img:hover { background-image:url(images/slogo_nw2.png);}.home_lang{position:absolute;color:#FFF;width:120px;height:30px;right:10px;top:70px;text-align:right}@media only screen and (max-width: 991px) {.home_lang{left:10px;right:inherit;top:66px}} </style>
<body onload="MM_preloadImages('css/mega_menu_styles/skins/images/bg_white.png', 'css/mega_menu_styles/skins/images/bg_hdr.png','css/mega_menu_styles/skins/images/bg_sub_left.png', 'css/mega_menu_styles/skins/images/bg_sub.png')">

<div id="wrapper" class="clearfix">

<aside id="aside" style="top:115px; z-index:100; background-color:#EEE; background: -webkit-gradient(linear,left top,right top,color-stop(93%,#EEE),color-stop(100%,#DDD)); border-right:solid 1px #DDD">		
<!-- TemplateBeginEditable name="左選單" -->
<?php require_once("../admin/require_leftmainmenu_default.php"); ?>
<!-- TemplateEndEditable -->				
</aside>

     <div id="header" class="header-sm clearfix"> 
    <!-- HEADER -->
    <header id="header"> 
            <button id="mobileMenuBtn"></button>
            <!-- Logo --> 
            <span class="logo pull-left"> <a href="index.php?lang=<?php echo $_SESSION['lang'] ?>" id="Mg_Logo"><img src="images/slogo_nw1.png" class="img-responsive"/></a></span>
            <div class="home_lang">
        <?php //require("inc_managelangselect_index.php"); ?>
      </div>
            <nav> 
        
        <!-- OPTIONS LIST -->
        <ul class="nav pull-right">
                
                <!-- USER OPTIONS -->
                <li class="dropdown pull-left"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <img class="user-avatar" alt="" src="assets/images/noavatar.jpg" height="35" /> <span class="user-name"> <span class="hidden-xs"> <?php echo $_SESSION['MM_Username']; ?> <i class="fa fa-angle-down"></i> </span> </span> </a>
            <ul class="dropdown-menu hold-on-click">
                    <li> <a href="manage_siteconfig.php?wshop=<?php echo $wshop;?>&amp;Opt_Config=settingpage_bs&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-cogs"></i> 網站資訊</a> </li>
                    <li> <a href="manage_state.php?wshop=<?php echo $wshop;?>&amp;Opt_State=settingpage_user&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-address-card-o" aria-hidden="true"></i> 個人資料</a> </li>
                    <li class="divider"></li>
                    <li> 
                <!-- logout --> 
                <a href="<?php echo $logoutAction ?>"><i class="fa fa-power-off"></i> 登出</a> </li>
                  </ul>
          </li>
                <!-- /USER OPTIONS -->
                
              </ul>
        <!-- /OPTIONS LIST --> 
        
      </nav>
          </header>
    <!-- /HEADER --> 
  </div>
        <?php require("require_mainmenu_sty03.php"); ?>

        
    <section id="middle" style="padding:0px">
    <!--<div id="content" class="dashboard"> -->
    <div class="panel panel-default">
	<div class="panel-body">
    <div class="row"><!-- row -->
    <?php require("inc_managelangselect.php"); ?>
    <!-- TemplateBeginEditable name="主內容" -->
	<!-- TemplateEndEditable -->
    <div class="clearfix"></div>
    </div><!-- \row -->
    </div>
    <!--</div>-->
    </div>
    </section>
        
</div>



<footer id="footer" style="background-color:#333; color:#FFF; text-align:center;">
        <div class="container">
    <div class="row"> <br>
            <?php require_once("require_manage_proverb.php"); ?>
            <?php require_once("require_manage_footer_login.php"); ?>
            <br>
            <br>
          </div>
  </div>
</footer>


</body>
<script type="text/javascript" src="assets/js/app.js"></script>
<script language="javascript">jQuery(document).ready(function(){fontResizer("80%","90%","100%");jQuery("div#fontdisplay").css("display","block")});</script>
</html>