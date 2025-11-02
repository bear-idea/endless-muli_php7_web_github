<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html>
<!--<![endif]-->
<head>
<?php require($TplPath . "/template/header/view_tmp_header_meta.php"); ?>
<title><?php echo $Title_Word ?></title>
<?php require($TplPath . "/template/header/view_tmp_header_script_theme.php"); ?>
<?php require($TplPath . "/template/header/view_tmp_header_script_home.php"); ?>
<meta charset="utf-8">
</head>
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
	  <?php require($TplPath . "/template/others/view_tmp_lang_select.php"); ?>
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
  <div id="header" class="header-auto sticky noborder <?php if ($TmpMenuEffect == '1') { echo "sticky movetop";} else if($TmpMenuEffect == '2') { echo "sticky bottom";} else if($TmpMenuEffect == '3') { echo "sticky transparent";} ?> clearfix" <?php echo "data-show=\"mobile\""; ?> style="border: none; box-shadow:none"> 
<?php if($HomeStyle == 'homeboard021'){ ?>
  <!-- Top Bar -->
  <div id="topBar" style="display:none;">
    <div class="container">      
      <!-- right -->
	  <?php require($TplPath . "/template/others/view_tmp_lang_select.php"); ?>
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
          <?php require($TplPath . "/template/logo/view_tmp_mobilelogo.php"); ?>
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
  <?php 
		if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $TmpHomeBannerSelect == '1') { // 當目前版面為首頁時讀取首頁橫幅
				include("app/banner/require_banner_homeimage_mobile.php"); // 共通
		}else if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $HomeStyle == 'homeboard021'){
		        include("app/banner/require_banner_homefullimage_mobile.php");
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
					include("app/banner/require_banner.php"); // 共通
				break;
				case "2":
					include("app/banner/require_tmpbanner.php"); // 獨立
				break;
				case "3":
				    if($TmpBannerChooseSelect == '1')
					{
						include("app/banner/require_selectbanner.php"); // 單圖選擇
					}else{
						require($TplPath . "/bannerpic.php"); // 單圖
					}
					
				break;
				case "4":
					include("app/banner/require_tmpbannermuli.php"); // 獨立
				break;
				default:
				break;
			}
		}
		//}
  ?>
  <?php if ($TmpWrpViewLineLocate == '2') { ?>
      <?php require($TplPath . "/template/board/view_tmp_middle_viewline_top.php"); ?>  
      <section class="page-header page-header-xxs">
        <div class="container">
          <h1><?php echo $ModuleName; ?></h1>
          <?php require("app/".$Tp_MdName."/viewline/breadcrumbs.php"); ?>
        </div>
      </section>
      <?php require($TplPath . "/template/board/view_tmp_middle_viewline_bottom.php"); ?>  
  <?php } ?>
  <!--<section>-->
    <div class="container<?php if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && ($HomeStyle == 'homeboard001' || $HomeStyle == 'homeboard002') && $tplrwdhomeboxview == '1' && ($tplrwdboxedhome == '4' || $tplrwdboxedhome == '0')){echo "_full";}elseif($tplrwdboxed == '0') {echo "_full";}?>">
	<?php if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $HomeStyle == 'homeboard021'){ /* 使用滿板橫幅 */  ?>
    <?php } else { ?>
    <div class="row">
		<?php if($TmpPublishIndicate == '1' && $OptionPublishSelect == '1'){ ?>
			<?php require_once("app/publish/require_publish_marquee_sty01.php");?>
        <?php  } ?>
    </div>
    <?php if ((@$_GET['tp'] == 'Home' || $Tp_Page == 'Main' || $Tp_Page == 'Home')){ ?>
    	<?php if($HomeStyle == "homeboard001") { ?>
            <div id="l_column">
            <?php require_once("app/tmp/column/home/block.php") ; /* 左欄位區塊(首頁) */ ?>
            </div>
        <?php } else { ?>
        <?php } ?>
    <?php } else { ?>
    	<?php if($tplname_original == "board010") { ?>
        <?php } else { ?>
        	<div id="l_column">
            <?php require_once("app/tmp/column/inner/block.php"); /* 左欄位區塊 */ ?>
            </div>
        <?php } ?>
    <?php } ?>
	<?php } ?>
      <div id="m_column" >
      <div class="row">      
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php require($view_module_page_block); /* 主內容區塊 */ ?>
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
          <?php require('app/tmp/footer/inner/footer.php'); ?>
        </div>
      </div>
    </div>
  </footer>
  <!-- /FOOTER --> 

  <?php /* 主選單顯示模式為側邊 頁尾資料為主選單 */ ?>
  <?php if($TmpMainmenuMod == '1' || $TmpFootmenuData == '1'){ require_once("app/tmp/slidepanel/mainmenu.php"); } ?>
  
  <?php if ($OptionCartSelect == '1' && $tplrwdfootmenuindicate == '1') { /* 購物車用選單 */ ?>
  <?php require_once("app/tmp/slidepanel/product.php"); ?>
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
</html>