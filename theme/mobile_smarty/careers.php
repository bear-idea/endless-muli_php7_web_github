<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html><!-- InstanceBegin template="/Templates/mobile_smarty.dwt.php" codeOutsideHTMLIsLocked="false" -->
<!--<![endif]-->
<head>
<?php require($TplPath . "/layout/header/layout_header_meta.php"); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title> <?php echo $Title_Word ?></title>
<!-- InstanceEndEditable -->
<?php require($TplPath . "/layout/header/layout_header_script_theme.php"); ?>
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
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
<body class="smoothscroll enable-animation bg-style-color <?php if(($Tp_Page == 'Main' || $Tp_Page == 'Home')){ if($tplrwdhomeboxview =='1' && $tplrwdboxedhome == '1') { echo "boxed"; } }else{ if($tplrwdboxed == '1') { if (($Tp_Page == 'Main' || $Tp_Page == 'Home') && $HomeStyle == 'homeboard021') {}else{echo "boxed";}} }?><?php //if($tplrwdboxed == '1') { if (($Tp_Page == 'Main' || $Tp_Page == 'Home') && $HomeStyle == 'homeboard021') {}else{echo "boxed";}}?> clearfix">
<div id="Bk_Anime_Wrapper">
<div id="Bk_Bottom_Wrapper"> 
<!-- wrapper -->
<div id="wrapper">
<?php if($HomeStyle != 'homeboard021' || ($Tp_Page != 'Main' && $Tp_Page != 'Home')){ ?>
  <!-- Top Bar -->
  <div id="topBar">
    <div class="container">      
      <!-- right -->
	  <?php require("inc/inc_frontlangselect_mobile.php"); ?>
      <!-- left -->
      <ul class="top-links list-inline pull-left">
        <?php if($_SERVER['HTTP_HOST'] == 'www.shopneo.com.tw') { ?>
        <li><a href="https://www.shopneo.com.tw"><img src="<?php echo $SiteBaseUrl ?>images/home/shop3500.png" width="37" height="20" style="border:none;"/></a></li>
        <?php } ?>
        <?php if($_SERVER['HTTP_HOST'] == 'www.1881shop.com') { ?>
        <li><a href="http://www.1881shop.com"><img src="<?php echo $SiteBaseUrl ?>images/home/logo_1881Shop_line_s.png" height="20" style="border:none;"/></a></li>
        <?php } ?>
        <!--<li id="Show_TopName"><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $WshopTopName; ?></a></li>-->
      </ul>
    </div>
  </div>
  <!-- /Top Bar -->
<?php } ?>
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
  <div id="header" class="header-auto sticky noborder <?php if ($TmpMenuEffect == '1') { echo "sticky movetop";} else if($TmpMenuEffect == '2') { echo "sticky bottom";} else if($TmpMenuEffect == '3') { echo "sticky transparent";} ?> clearfix" <?php echo "data-show=\"mobile\""; ?> style="border: none; box-shadow:none"> 
<?php if($HomeStyle == 'homeboard021'){ ?>
  <!-- Top Bar -->
  <div id="topBar" style="display:none;">
    <div class="container">      
      <!-- right -->
	  <?php require("inc/inc_frontlangselect_mobile.php"); ?>
      <!-- left -->
      <ul class="top-links list-inline pull-left">
        <?php if($_SERVER['HTTP_HOST'] == 'www.shopneo.com.tw') { ?>
        <li><a href="https://www.shopneo.com.tw"><img src="<?php echo $SiteBaseUrl ?>images/home/shop3500.png" width="37" height="20" style="border:none;"/></a></li>
        <?php } ?>
        <?php if($_SERVER['HTTP_HOST'] == 'www.1881shop.com') { ?>
        <li><a href="http://www.1881shop.com"><img src="<?php echo $SiteBaseUrl ?>images/home/logo_1881Shop_line_s.png" height="20" style="border:none;"/></a></li>
        <?php } ?>
        <!--<li id="Show_TopName"><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $WshopTopName; ?></a></li>-->
      </ul>
    </div>
  </div>
  <!-- /Top Bar -->
<?php } ?>
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
                  <?php require("app/mainmenu/mainmenu_dftype.php"); ?>
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
  <div id="HeaderAfterBanner">
  <div class="container" style="z-index:1000">
  <div id="topNav">
    <div id="apDiv_outmenu">
      <div class="navbar-collapse nav-main-collapse collapse" style="width:100%">
        <nav class="nav-main">
          <ul id="topMain" class="nav nav-pills nav-main list-group">
            <?php require("app/mainmenu/mainmenu_dftype.php"); ?>
          </ul>
        </nav>
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
        <?php require($TplPath . "/layout/board/layout_board_middle_viewline_top.php"); ?>  
        <section class="page-header page-header-xxs">
            <h1><!-- InstanceBeginEditable name="標題文字" -->    
			<?php echo $ModuleName['Careers']; ?>
			<!-- InstanceEndEditable --></h1>
            <!-- InstanceBeginEditable name="導覽列" -->
                                    <?php require("require_careers_viewline_mobile.php"); ?>
                    <!-- InstanceEndEditable -->
        </section>
        <?php require($TplPath . "/layout/board/layout_board_middle_viewline_bottom.php"); ?> 
    <?php } ?>
  <!--<section>-->
    <div class="container<?php if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && ($HomeStyle == 'homeboard001' || $HomeStyle == 'homeboard002') && $tplrwdhomeboxview == '1' && ($tplrwdboxedhome == '4' || $tplrwdboxedhome == '0')){echo "_full";}elseif($tplrwdboxed == '0') {echo "_full";}?>">
	<?php if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $HomeStyle == 'homeboard021'){ /* 使用滿板橫幅 */  ?>
    <?php } else { ?>
    <div class="row">
		<?php if($TmpPublishIndicate == '1' && $OptionPublishSelect == '1'){ ?>
			<?php require_once("require_publish_marquee_sty01.php");?>
        <?php  } ?>
    </div>
    <?php if ((@$_GET['tp'] == 'Home' || $Tp_Page == 'Main' || $Tp_Page == 'Home')){ ?>
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
	<?php } ?>
      <div id="m_column" >
      <div class="row">      
        <div class="col-lg-12 col-md-12 col-sm-12">
		<!-- InstanceBeginEditable name="主內容" -->
        	<?php if ($TmpWrpViewLineLocate == '1') { ?>               
            	<?php require($TplPath . "/layout/board/layout_board_middle_viewline_top.php"); ?>  
            	<section class="page-header page-header-xxs">
            		<h1><?php echo $ModuleName[$Tp_Page]; ?></h1>
					<?php require('app/viewline/require_'.$Tp_MdName.'_viewline_mobile.php'); ?>
            	</section>
            	<?php require($TplPath . "/layout/board/layout_board_middle_viewline_bottom.php"); ?> 
        	<?php } ?>
      	<?php
			switch($_GET['Opt'])
			{
				case "viewpage":
					include_once("require_careers.php");				
					break;
				case "detailed":
					include_once("require_careers_detailed.php");				
					break;
				default:
					include_once("require_careers.php");
					break;
			}
		?>
      	<!-- InstanceEndEditable --> 
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
<?php require("app/other/effect/magic.php"); ?> 
<?php require("app/other/bulletin/bulletin.php"); ?>
<?php if ($OptionSocialChatSelect == '1') { ?>
<?php require("app/other/chat/soch.php"); ?>
<?php } /* 購物車用選單 */ ?>
<!-- PRELOADER --> 
<!--<div id="preloader">
			<div class="inner">
				<span class="loader"></span>
			</div>
		</div>--><!-- /PRELOADER -->

</body>
<script>twemoji.parse(document.body);</script> 
<!-- InstanceEnd --></html>