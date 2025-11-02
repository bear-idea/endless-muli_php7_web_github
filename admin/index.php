<?php
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
<meta charset="utf-8" />
<title>後台管理系統 - <?php echo $row_RecordAccount['name'];?></title> 
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta name="robots" content="noindex,nofollow" />
<meta content="" name="description" />
<meta content="" name="author" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
<!-- ================== BEGIN BASE CSS STYLE ================== -->
<?php //$SiteBaseAdminPath="admin_color/"; ?>
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/flag-icon/css/flag-icon.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui-timepicker-addon/dist/jquery-ui-timepicker-addon.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/font-awesome/5.6/css/fontawesome-all.min.css" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/glyphicon/css/glyphicon.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/style.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/style-responsive.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/intro-js/introjs.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/colorbox/css/colorbox.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/src/parsley.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-smart-wizard/src/css/smart_wizard.min.css" rel="stylesheet" />
<!-- ================== END NECESSARY ALL PAGE JS ================== --> 

<!-- ================== BEGIN FORM CSS STYLE ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/inputs-ext/bootstrap-datetimepicker/css/datetimepicker.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<!-- ================== END FORM CSS STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/pace/pace.min.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN BASE JS ================== --> 
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui-timepicker-addon/dist/jquery-ui-timepicker-addon.min.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui-timepicker-addon/dist/jquery-ui-sliderAccess.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>  
<!--[if lt IE 9]>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]--> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/js-cookie/js.cookie.min.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/js/theme/default.min.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/js/apps.min.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/dist/parsley.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/dist/i18n/zh_tw.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/intro-js/intro.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/imgLiquid/js/imgLiquid-min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<!-- ================== END NECESSARY ALL PAGE JS ================== -->

<script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2213_RC01/embed_loader.js"></script>

<style type="text/css">
#Tip_Box{padding:20px}
.InnerPage_design{float:right;margin:1px 1px 1px 5px}
.InnerPage_design a{font-weight:700;border:1px solid #337fed;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;text-shadow:1px 1px 0 #1570cd;-webkit-box-shadow:inset 1px 1px 0 0 #97c4fe;-moz-box-shadow:inset 1px 1px 0 0 #97c4fe;box-shadow:inset 1px 1px 0 0 #97c4fe;white-space:nowrap;vertical-align:middle;color:#fff;background:transparent;cursor:pointer;background-color:#3d94f6;padding:2px;text-decoration:none}
.InnerPage_design a:hover,.InnerPage_design a:focus{filter:progid: DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0',endColorstr='#3d94f6');background:0 color-stop(100%,#3d94f6));background-color:#1e62d0}
#Mg_Logo img:hover{background-image:url(images/slogo_nw2.png)}
.Menu_ListView_Icon_Board{-moz-background-size:cover;-webkit-background-size:cover;-o-background-size:cover;background-size:cover;text-shadow:#e0e0e0 0 0 11px;color:#000;font-weight:bolder;font-size:1em}
.Menu_ListView_Icon_Board_Block{-moz-background-size:cover;-webkit-background-size:cover;-o-background-size:cover;background-size:cover;text-shadow:#e0e0e0 0 0 11px;color:#000;font-weight:bolder;font-size:1em;margin:5px}
.cl_green{background-color:#b2df81;background-image:url(images/mt_color_style01.png)}
.cl_green2{background-color:#79d5b3;background-image:url(images/mt_color_style01.png)}
.cl_purple{background-color:#C0C0E0;background-image:url(images/mt_color_style01.png)}
.cl_purple2{background-color:#84909f;background-image:url(images/mt_color_style01.png)}
.cl_blue{background-color:#ebf0a8;background-image:url(images/mt_color_style01.png)}
.cl_blue2{background-color:#95c7e4;background-image:url(images/mt_color_style01.png)}
.cl_blue3{background-color:#9eb880;background-image:url(images/mt_color_style01.png)}
.cl_blue4{background-color:#ffae9a;background-image:url(images/mt_color_style01.png)}
.cl_red{background-color:#f48181;background-image:url(images/mt_color_style01.png)}
.cl_red_n{background-color:#f48181;background-image:url(images/mt_color_style14.png)}
.cl_orange{background-color:#f3ad79;background-image:url(images/mt_color_style01.png)}
.cl_orange_n{background-color:#f3ad79;background-image:url(images/mt_color_style14.png)}
.cl_pink{background-color:#94999f;background-image:url(images/mt_color_style01.png)}
.cl_pink2{background-color:#d3a4c6;background-image:url(images/mt_color_style01.png)}
.cl_yellow{background-color:#f5d6a4;background-image:url(images/mt_color_style01.png)}
.cl_yellow2{background-color:#f5e7a4;background-image:url(images/mt_color_style01.png)}
.cl_brown{background-color:#d4c0aa;background-image:url(images/mt_color_style01.png)}
.cl_gray{background-color:#acb8c3;background-image:url(images/mt_color_style01.png)}
.cl_gray2{background-color:#dcdee1;background-image:url(images/mt_color_style01.png)}
#container_freewall,#container_freewall0,#container_freewall1,#container_freewall2,#container_freewall3,#container_freewall4,#container_freewall5{width:100%}
#container_freewall .Menu_ListView_Icon_Board,#container_freewall0 .Menu_ListView_Icon_Board,#container_freewall1 .Menu_ListView_Icon_Board,#container_freewall2 .Menu_ListView_Icon_Board,#container_freewall3 .Menu_ListView_Icon_Board,#container_freewall4 .Menu_ListView_Icon_Board,#container_freewall5 .Menu_ListView_Icon_Board{width:100px;height:100px;border:1px solid #E3E3E3;box-shadow:rgba(0,0,0,0.1) 0 0 8px;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 8px;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 8px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px}
#container_freewall .Menu_ListView_Icon_Board:hover,#container_freewall0 .Menu_ListView_Icon_Board:hover,#container_freewall1 .Menu_ListView_Icon_Board:hover,#container_freewall2 .Menu_ListView_Icon_Board:hover,#container_freewall3 .Menu_ListView_Icon_Board:hover,#container_freewall4 .Menu_ListView_Icon_Board:hover,#container_freewall5 .Menu_ListView_Icon_Board:hover{background-color:#C7E3F1;box-shadow:rgba(0,0,0,0.1) 0 0 8px;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 8px;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 8px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px}
.home_lang{position:absolute;color:#FFF;width:120px;height:30px;right:10px;top:70px;text-align:right}
@media only screen and (max-width: 991px) {
.home_lang{left:10px;right:inherit;top:66px}
}
.demo-modal{background-color:#FFF;box-shadow:0 11px 15px -7px rgba(0,0,0,0.2),0 24px 38px 3px rgba(0,0,0,0.14),0 9px 46px 8px rgba(0,0,0,0.12);padding:24px;width:60%;position:relative;display:none}
.demo-close{display:block;position:absolute;top:-35px;right:0;z-index:10000;outline:none;font-size:30px;line-height:30px;transition:transform .3s ease-in-out;color:#FFF}
.demo-close:hover{transform:rotate(360deg);color:#FFF}

.panel-heading .nav-tabs {
    margin-top: -30px;
    margin-right: -15px;
}
</style>

</head>
<body>
<!-- begin #page-loader -->
<!--<div id="page-loader" class="fade show"><span class="spinner"></span></div></div>-->
<!-- end #page-loader --> 
<!-- begin #page-container -->
<div id="page-container" class="page-header-fixed page-sidebar-fixed page-without-sidebar">
  <!-- begin #header -->
  <div id="header" class="header navbar-default"> 
    <!-- begin navbar-header -->
    <div class="navbar-header"> <a href="index.php?lang=<?php echo $_SESSION['lang'] ?>" class="navbar-brand"><img src="images/loginpic_b.png" class="img-fluid" style="max-height:50px; margin-top:-8px;"></a>
                <!--<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>-->
      <button type="button" class="navbar-toggle p-0 m-r-5" data-toggle="collapse" data-target="#top-navbar"> <span class="fa-stack fa-lg text-inverse m-t-2"> <i class="far fa-square fa-stack-2x"></i> <i class="fa fa-cog fa-stack-1x"></i> </span> </button>
    </div>
    <!-- end navbar-header --> 
    
    <!-- begin navbar-collapse -->
    <?php require("require_mainmenu_sty04.php"); ?>
    <!-- end navbar-collapse --> 
    
    <!-- begin header-nav -->
	
    <ul class="navbar-nav navbar-right">
      <li class="dropdown" style="margin-top:12px;"><?php require("inc_managelangselect_index.php"); ?></li>
      <li class="dropdown navbar-user"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <span class="d-none d-md-inline"><?php echo $_SESSION['MM_Username']; ?></span> <b class="caret"></b> </a>
        <div class="dropdown-menu dropdown-menu-right"> 
          <a href="manage_siteconfig.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_bs&amp;lang=<?php echo $_SESSION['lang']; ?>" class="dropdown-item"><i class="fa fa-cogs"></i> 網站資訊</a>
          <a href="manage_state.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_user&amp;lang=<?php echo $_SESSION['lang']; ?>" class="dropdown-item"><i class="fa fa-user-circle" aria-hidden="true"></i> 個人資料</a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo $logoutAction ?>" class="dropdown-item"><i class="fa fa-sign-out-alt fa-fw"></i> 登出</a>
          </div>
      </li>
    </ul>
    <!-- end header navigation right --> 
  </div>
  <!-- end #header --> 
  
  <!-- begin #content -->
  <div id="content_full" class="content" style="padding:15px">
    <div class="row">
      <div class="col-md-7 col-sm-12 col-xs-12">
        <!-- begin panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                    data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
            <h4 class="panel-title">模組一覽 <?php require("require_lang_show.php"); ?></h4>
          </div>
          <div class="panel-body">
            <div id="container_freewall">
              <?php
			  switch($SiteModChoose)
			  {
				case "0":
					require("require_manage_home_mod_select_view.php");
					break;
				case "1":
					require("require_manage_home_mod_select_view_scale.php");
					break;
				case "2":
					require("require_manage_home_mod_select_view_invoicing.php");
					break;
				case "3":
					require("require_manage_home_mod_select_view_salary.php");
					break;
				case "4":
					require("require_manage_home_mod_select_view_mail.php");
					break;
				default:
					require("require_manage_home_mod_select_view.php");
					break;
			  }
			  ?>
            </div>
          </div>
        </div>
        <!-- end panel -->

          <!-- begin panel -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                                                                                                                                                                                                                                                                                                            data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
                  <h4 class="panel-title">Google Trends</h4>
              </div>
              <div class="list-group">
                  <a href="https://trends.google.com/trends/?geo=TW" class="list-group-item rounded-0 list-group-item-action d-flex justify-content-between align-items-center text-ellipsis" target="_blank">
                      <i class="fas fa-lg fa-chart-area"></i> 探索世界搜尋趨勢
                      <span class="badge bg-teal fs-10px">GO</span>
                  </a>
                  <a href="https://trends.google.com/trends/trendingsearches/daily?geo=TW" class="list-group-item rounded-0 list-group-item-action d-flex justify-content-between align-items-center text-ellipsis" target="_blank">
                      <i class="fas fa-lg fa-chart-area"></i> 台灣每日搜尋趨勢
                      <span class="badge bg-teal fs-10px">GO</span>
                  </a>
                  <a href="https://trends.google.com.tw/trends/explore" class="list-group-item rounded-0 list-group-item-action d-flex justify-content-between align-items-center text-ellipsis" target="_blank">
                      <i class="fas fa-lg fa-chart-area"></i> 探索趨勢
                      <span class="badge bg-teal fs-10px">GO</span>
                  </a>
              </div>
          </div>
          <!-- end panel -->

          <!-- begin panel -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                                                                                                                                                                                                                                                                                                            data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
                  <h4 class="panel-title">每日搜尋趨勢</h4>
              </div>
              <div class="panel-body">
                  <script type="text/javascript"> trends.embed.renderWidget("dailytrends", "", {"geo":"TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
              </div>
          </div>
          <!-- end panel -->

          <!-- begin panel -->
          <div class="panel panel-default panel-with-tabs" data-sortable-id="ui-widget-10">
              <div class="panel-heading ui-sortable-handle">

                  <h4 class="panel-title">探索</h4>
                  <ul class="nav nav-tabs pull-right">
                      <li class="nav-item"><a href="#tab-trends-1" data-toggle="tab" class="nav-link active"><i class="fa fa-newspaper"></i> <span class="d-none d-md-inline">新聞</span></a></li>
                      <li class="nav-item"><a href="#tab-trends-2" data-toggle="tab" class="nav-link"><i class="fa fa-map-marker"></i> <span class="d-none d-md-inline">網頁</span></a></li>
                      <li class="nav-item"><a href="#tab-trends-3" data-toggle="tab" class="nav-link"><i class="fab fa-youtube"></i> <span class="d-none d-md-inline">YOUTUBE</span></a></li>
                      <li class="nav-item"><a href="#tab-trends-4" data-toggle="tab" class="nav-link"><i class="fa fa-shopping-cart"></i> <span class="d-none d-md-inline">購物</span></a></li>

                  </ul>
              </div>
              <div class="panel-body">
                  <div class="tab-content">
                      <div class="tab-pane fade show active" id="tab-trends-1">
                          <script type="text/javascript"> trends.embed.renderExploreWidget("RELATED_QUERIES", {"comparisonItem":[{"geo":"TW","time":"today 3-m"}],"category":0,"property":"news"}, {"exploreQuery":"date=today%203-m&geo=TW&gprop=news","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                      </div>
                      <div class="tab-pane fade" id="tab-trends-2">
                          <script type="text/javascript"> trends.embed.renderExploreWidget("RELATED_QUERIES", {"comparisonItem":[{"geo":"TW","time":"today 3-m"}],"category":0,"property":""}, {"exploreQuery":"date=today%203-m&geo=TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                      </div>
                      <div class="tab-pane fade" id="tab-trends-3">
                          <script type="text/javascript"> trends.embed.renderExploreWidget("RELATED_QUERIES", {"comparisonItem":[{"geo":"TW","time":"today 3-m"}],"category":0,"property":"youtube"}, {"exploreQuery":"date=today%203-m&geo=TW&gprop=youtube","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                      </div>
                      <div class="tab-pane fade" id="tab-trends-4">
                          <script type="text/javascript"> trends.embed.renderExploreWidget("RELATED_QUERIES", {"comparisonItem":[{"geo":"TW","time":"today 3-m"}],"category":0,"property":"froogle"}, {"exploreQuery":"date=today%203-m&geo=TW&gprop=froogle","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                      </div>
                  </div>
              </div>

          </div>
          <!-- end panel -->

          <!-- begin panel -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                                                                                                                                                                                                                                                                                                            data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
                  <h4 class="panel-title">重設版面</h4>
              </div>
              <div class="panel-body">
                  <a href="javascript:;" class="btn btn-default btn-block btn-rounded" data-click="reset-local-storage"><b>重設版面</b></a>              </div>
          </div>
          <!-- end panel -->

      </div>
      <div class="col-md-5 col-sm-12 col-xs-12">
          <!-- begin panel -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                                                                                                                                                                                                                                                                                                            data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
                  <h4 class="panel-title">Weather</h4>
              </div>
              <div class="panel-body">
                  <a class="weatherwidget-io" href="https://forecast7.com/zh-tw/25d03121d57/taipei-city/" data-label_1="Taiwan" data-label_2="WEATHER" data-font="微軟正黑體 (Microsoft JhengHei)" data-icons="Climacons" data-theme="pure" >Taiwan WEATHER</a>
                  <script>
                      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                  </script>
              </div>
          </div>
          <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                    data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
            <h4 class="panel-title">&nbsp;</h4>
          </div>
          <div class="panel-body cl_red_n" style=" color:#FFF; overflow: hidden;">
          <div class="stats-icon stats-icon-lg" style="font-size: 128px;right: 0px;color: #fff;width: 128px;height: 50px; line-height: 50px; text-shadow: 3px 7px rgba(0,0,0,0.25);opacity: .15; float:right;"><i class="fa fa-user fa-fw"></i></div>
          	<div class="box" style="margin:0; background-color:transparent">
            <!-- default, danger, warning, info, success -->

            <div class="box-title">
                    <!-- add .noborder class if box-body is removed -->
                    <h4 style="color:#FFF"><?php echo $row_RecordAccount['name'];?></h4>
                    <small class="block">&nbsp;</small> <i class="fa fa-address-book-o" aria-hidden="true"></i> </div>
            <div class="box-body text-left" style="height: 60px;"> 啟用日：
                    <?php if($row_RecordAccount['webenabledate'] == '') {echo "------";}else{$dt = new DateTime($row_RecordAccount['webenabledate']); echo $dt->format('Y-m-d');} ?>
                    /

                    續約日：
                    <?php if($row_RecordAccount['webrenewdate'] == '') {echo "------";}else{$dt = new DateTime($row_RecordAccount['webrenewdate']); echo $dt->format('Y-m-d');} ?>
                    <br>
                    到期日：
                    <?php
									if($row_RecordAccount['webrenewdate'] == ''){$row_RecordAccount['webrenewdate'] = $row_RecordAccount['webenabledate'];}
									if($row_RecordAccount['usetime'] == ''){$row_RecordAccount['usetime'] = 0;}
									if($row_RecordAccount['webenabledate'] != ''){
									$endday = count_date($row_RecordAccount['webrenewdate'],$row_RecordAccount['usetime']);
									echo $endday;
									} else { echo "------";}
							    ?>
                    /
                    尚餘天數：
                    <?php if ($row_RecordAccount['webrenewdate'] != '' && $row_RecordAccount['usetime'] != '') { ?>
                    <?php
					$t_end = count_date($row_RecordAccount['webrenewdate'],$row_RecordAccount['usetime']);
					$t_now = date("Y-m-d");
					$t_dt = margin($t_now, $t_end);
						//echo $t_dt;
					?>
                    <?php
		if($t_dt <= 0){
			$t_dt = 0;
		?>
                    <strong><?php echo $t_dt . "天"; ?></strong><span style="background-color:#999; color:#FFF; padding:2px; margin-left:5px;"><?php echo '已到期'; ?></span>
                    <?php
		} else if ($t_dt <= 90){
		?>
                    <strong><?php echo $t_dt . "天"; ?></strong><span style=" background-color:#FF9933; color:#FFF; padding:2px; margin-left:5px;"><?php echo '<三個月'; ?></span>
                    <?php
		} else if ($t_dt <= 30){
		?>
                    <strong><?php echo $t_dt . "天"; ?></strong><span style=" background-color:#C00; color:#FFF; padding:2px; margin-left:5px;"><?php echo '<一個月'; ?></span>
                    <?php
		} else {
		?>
                    <?php echo $t_dt . "天"; ?>
                    <?php
		}
		?>
                    <?php } ?>
                  </div>
          </div>
          </div>
        </div>
        <!-- end panel -->

        <!-- begin panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                    data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
            <h4 class="panel-title">&nbsp;</h4>
          </div>
          <div class="panel-body cl_orange_n" style=" color:#FFF; overflow: hidden;">
          <div class="stats-icon stats-icon-lg" style="font-size: 128px;right: 0px;color: #fff;width: 128px;height: 50px; line-height: 50px; text-shadow: 3px 7px rgba(0,0,0,0.25);opacity: .15; float:right;"><i class="fa fa-signal fa-fw"></i></div>
          <div class="box" style="margin:0; background-color:transparent;">

            <!-- default, danger, warning, info, success -->

            <div class="box-title">
                    <!-- add .noborder class if box-body is removed -->
                    <h4 style="color:#FFF"><?php echo $row_RecordAccount['hot'];?> 總瀏覽人次</h4>
                    <small class="block">&nbsp;</small> <i class="fa fa-bar-chart-o"></i> </div>
            <div class="box-body text-left" style="height: 60px;"> 今日：<?php echo $row_RecordAccount['nhot'];?> /
                    昨日：<?php echo $row_RecordAccount['yhot'];?> /
                    本月：<?php echo $row_RecordAccount['yhot'];?> /
                    上月：<?php echo $row_RecordAccount['ymhot'];?> </div>
          </div>
          </div>
        </div>
        <!-- end panel -->

        <!-- begin panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                    data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
            <h4 class="panel-title">OverView</h4>
          </div>
          <div class="panel-body">
          <?php require_once("require_overview_list.php"); ?>
          </div>
        </div>
        <!-- end panel -->

        <!-- begin panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a><a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a><a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                    data-click="panel-expand"> <i class="fa fa-expand"></i> </a> </div>
            <h4 class="panel-title">Calendar</h4>
          </div>
          <div class="panel-body">
          <div id="datepicker-inline" class="datepicker-full-width overflow-y-scroll position-relative"><div></div></div>
          </div>
        </div>
        <!-- end panel -->


          <!-- begin panel -->
          <div class="panel panel-default panel-with-tabs" data-sortable-id="ui-widget-19">
              <div class="panel-heading ui-sortable-handle">

                  <h4 class="panel-title"><i class="fal fa-code-branch"></i> <?php echo date("Y")-1; ?> 年度排行</h4>
                  <ul class="nav nav-tabs pull-right">
                      <li class="nav-item"><a href="#tab-trends-speed-1" data-toggle="tab" class="nav-link active"><i class="fas fa-key"></i> <span class="d-none d-md-inline">關鍵字</span></a></li>
                      <li class="nav-item"><a href="#tab-trends-speed-2" data-toggle="tab" class="nav-link"><i class="fas fa-users"></i> <span class="d-none d-md-inline">人物</span></a></li>
                      <li class="nav-item"><a href="#tab-trends-speed-3" data-toggle="tab" class="nav-link"><i class="fas fa-user-secret"></i> <span class="d-none d-md-inline">政治人物</span></a></li>
                      <li class="nav-item"><a href="#tab-trends-speed-4" data-toggle="tab" class="nav-link"><i class="fas fa-quote-right"></i> <span class="d-none d-md-inline">議題</span></a></li>
                      <li class="nav-item"><a href="#tab-trends-speed-5" data-toggle="tab" class="nav-link"><i class="fas fa-video"></i> <span class="d-none d-md-inline">戲劇</span></a></li>
                      <li class="nav-item"><a href="#tab-trends-speed-6" data-toggle="tab" class="nav-link"><i class="fas fa-camera-movie"></i> <span class="d-none d-md-inline">電影</span></a></li>
                  </ul>
              </div>
              <div class="panel-body">
                  <div class="tab-content">
                      <div class="tab-pane fade show active" id="tab-trends-speed-1">
                          <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2884_RC01/embed_loader.js"></script> <script type="text/javascript"> trends.embed.renderTopChartsWidget("a745f7ac-1697-4431-80e4-bb665a95adb6", {"geo":"TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}, 2021); </script>
                      </div>
                      <div class="tab-pane fade" id="tab-trends-speed-2">
                          <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2884_RC01/embed_loader.js"></script> <script type="text/javascript"> trends.embed.renderTopChartsWidget("ef2a0b88-6cf8-4fa7-809f-356932323910", {"geo":"TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}, 2021); </script>
                      </div>
                      <div class="tab-pane fade" id="tab-trends-speed-3">
                          <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2884_RC01/embed_loader.js"></script> <script type="text/javascript"> trends.embed.renderTopChartsWidget("b6545a3c-3c4f-48e8-8172-05f28bf44716", {"geo":"TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}, 2021); </script>
                      </div>
                      <div class="tab-pane fade" id="tab-trends-speed-4">
                          <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2884_RC01/embed_loader.js"></script> <script type="text/javascript"> trends.embed.renderTopChartsWidget("2ea2b681-1a0c-4286-b518-1e88d2c070bf", {"geo":"TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}, 2021); </script>
                      </div>
                      <div class="tab-pane fade" id="tab-trends-speed-5">
                          <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2884_RC01/embed_loader.js"></script> <script type="text/javascript"> trends.embed.renderTopChartsWidget("cae44608-42ed-497a-9adc-2ad8450480a9", {"geo":"TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}, 2021); </script>
                      </div>
                      <div class="tab-pane fade" id="tab-trends-speed-6">
                          <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2884_RC01/embed_loader.js"></script> <script type="text/javascript"> trends.embed.renderTopChartsWidget("5da6880c-9d9a-43d6-b755-68995a6945f0", {"geo":"TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}, 2021); </script>
                      </div>
                  </div>
              </div>

          </div>
          <!-- end panel -->


      </div>
    </div>
    
  </div>
  <!-- end #content --> 
  
  <!-- begin #footer -->
  <div id="footer" class="footer" style="background-color:#333; color:#FFF; text-align:center; margin:0"> 
  <?php require_once("require_manage_proverb.php"); ?>
  <?php require_once("require_manage_footer_login.php"); ?>
  </div>
  <!-- end #footer --> 
  
  <!-- begin scroll to top btn --> 
  <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a> 
  <!-- end scroll to top btn --> 
</div>
<!-- end page container --> 

<!-- ================== BEGIN FORM LEVEL JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-fileinput/js/plugins/piexif.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-fileinput/js/locales/zh-TW.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/selectboxes/selectboxes.js"></script>
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-validator/validator.min.js"></script>-->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker-mobile.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.zh-TW.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-TW.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<!-- ================== END FORM LEVEL JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<!-- ================== END PAGE LEVEL JS ================== --> 

<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/freewall/freewall.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/freewall/centering.js"></script> 

<script>
		jQuery( document ).ready( function () {
			var wall = new Freewall( "#container_freewall" );
			wall.reset( {
				selector: '.Menu_ListView_Icon_Board',
				animate: true,
				cellW: 116,
				cellH: 116,
				delay: 1,
				onResize: function () {
					wall.fitWidth();
				}
			} );
		
			wall.fitZone();
			// for scroll bar appear;
			//$(window).trigger("resize");
		} );
	</script> 
    <script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip1',
                intro: '您可以依照以下的步驟逐步建立您的網站。'
              },
			  <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDfPageSelect == '1') { ?>
              {
                element: '#Step_MainMenu',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 設置主選單</div><img src="images/tip/tip026.jpg" width="500" height="117" alt=""/><br /><br />設置您網站的選單模組、調整名稱及更換排序。',
				position: 'bottom'
              },
			  <?php } ?>
			  <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
			  {
                element: '#Step_Tmp',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 設定網站外觀</div><img src="images/tip/tip027.jpg" width="300" height="300" alt=""/><br /><br />選擇您網站的版型外觀或著設計您自己專屬的外觀。',
				position: 'bottom'
              },
			  {
                element: '#Step_Logo',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 設定您的Logo</div><img src="images/tip/tip028.jpg" width="428" height="184" alt=""/><br /><br />您可以選擇使用圖片或文字Logo。',
				position: 'bottom'
              },
			  <?php } ?>
			  {
                element: '#Step_Banner',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 設定您的橫幅</div><img src="images/tip/tip029.jpg" width="500" height="290" alt=""/><br /><br />可以上傳多張圖片依次撥放，並有30餘種特效可選擇。',
				position: 'bottom'
              },
			  {
                element: '#Step_Mod',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 新增各模組資料</div><img src="images/tip/tip030.jpg" width="300" height="300" alt=""/><br /><br />在最新訊息、產品資訊、活動花絮等模組打入資料，增加網站的內容。',
				position: 'bottom'
              },
			  <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1' && $Shop3500_Limit_Mod != "Shop3500_Blog") { ?>
			  {
                element: '#Step_Column',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 設定側邊欄位</div><img src="images/tip/tip031.jpg" width="300" height="300" alt=""/><br /><br />設定您側邊欄位所要加入的功能、加入影片、程式碼、人次統計等...',
				position: 'bottom'
              },
			  {
                element: '#Step_Column_Mod',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 加入側邊模組</div><img src="images/tip/tip032.jpg" width="300" height="300" alt=""/><br /><br />可設定最新訊息、產品資訊..等連結放置於網站側邊，加入前需在側邊欄位中將模組連結功能加入。',
				position: 'bottom'
              },
			  <?php } ?>
			  {
                element: '#Step_Psw',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 更改密碼</div><br />修改您的密碼讓您的帳號更為安全。',
				position: 'bottom'
              },
			  {
                element: '#Step_Basic',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 修改基本資料</div><br />填入您的公司名稱、電話、地址等資訊...',
				position: 'bottom'
              },
			  {
                element: '#Step_Key',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 修改網站關鍵字</div><br />填入您網站的基礎關鍵字、描述等...',
				position: 'bottom'
              },
			  {
                element: '#Step_Analytics',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> SEO分析及優化</div><img src="images/tip/tip033.jpg" width="300" height="202" alt=""/><br /><br />結合Google和Yahoo的功能，分析您的流量、關鍵字等，並透過Sitemap將你的資訊快速曝光於搜尋引勤中，有助於SEO。',
				position: 'bottom'
              },
              {
                element: '#Step_Update',
                intro: '<div style="font-weight:bolder; background-color:#2E0808; color:#FFFFFF; text-align:center; font-size:16px; padding:5px;"><i class="fa fa-tag"></i> 擴充升級</div><img src="images/tip/tip034.jpg" width="248" height="248" alt=""/><br /><br />若您想要有功能上的擴充，選擇您想要增加的功能，例如工程實績、常見問答、型錄下載或延長使用期限等...，透過超商繳費、ATM即可立即開通，開通之後不要忘了在自訂頁面中加入到您的主選單喔。',
				position: 'bottom'
              },
              {
                element: '#Step_View',
                intro: '設置完後您可觀看您的網站成果。',
                position: 'bottom'
              }
            ]
          });
          intro.start();
      }
</script>
<?php if($_SESSION['End_WebTime'] == ''){$_SESSION['End_WebTime'] = 'on';} ?>
<?php if ($row_RecordAccount['usetime'] != '0' && $t_dt <= 30 && $_SESSION['End_WebTime'] == 'on') { ?>
<?php $_SESSION['End_WebTime'] = 'off'; ?>
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">提示</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0">
                    <p><?php echo "您的網站到期日為" . $endday; ?> / <?php echo "尚餘" . $t_dt . "天到期"; ?><br/>
        <?php echo "若欲延長期限請點選【擴充升級】按鈕"; ?></p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">關閉</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
    $('#modal-alert').modal('show');
	});
  </script>
<?php } ?>
<script>
		$(document).ready(function() {
			App.init();
			//Highlight.init();
			$('#datepicker-inline').datepicker({
				todayHighlight: true
			});
			$(".colorbox_iframe").colorbox({iframe:!0,width:"90%",height:"90%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_small").colorbox({iframe:!0,width:"1000px",height:"80%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_cd").colorbox({iframe:!0,width:"99%",height:"99%",fixed:!0,rel:"nofollow"});$(".youtube").colorbox({iframe:true, innerWidth:900, innerHeight:506});
		});
	</script>
</body>
</html>
<?php 
//$endTime = getMicroTime(); //页面结尾定义
//echo getRunTime($startTime, $endTime); //最后调用函数
?>