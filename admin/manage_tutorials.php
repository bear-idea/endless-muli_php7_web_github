<?php 
ob_start(); // 開啟輸出緩衝區
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
<html lang="zh-Hant"><!-- InstanceBegin template="/Templates/admin_color.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>後台管理系統 - <?php echo $row_RecordAccount['name'];?></title>
<!-- InstanceEndEditable -->
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
<link rel="stylesheet" type="text/css" href="<?php echo $SiteBaseUrl; ?>fonts/twemoji-awesome/dist/twemoji-awesome.min.css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui-timepicker-addon/dist/jquery-ui-timepicker-addon.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/font-awesome/5.6/css/fontawesome-all.min.css" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/glyphicon/css/glyphicon.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/style.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/style-responsive.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/theme/default.min.css" rel="stylesheet" id="theme" />
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.11/dist/css/bootstrap-select.min.css">
<!-- ================== END FORM CSS STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/pace/pace.min.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN BASE JS ================== --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.11/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<!-- ================== END NECESSARY ALL PAGE JS ================== --> 

<!-- InstanceBeginEditable name="head" -->
<link type="text/css" rel="stylesheet" href="css/jquery.snippet.css">
<script type="text/javascript" src="js/jquery.snippet.js"></script>
<script type="text/javascript">
	$(function(){
		// pre.js 使用 JavaScript 高亮顯示
		$('pre.js').snippet('javascript', {
			style: 'darkblue'
		});
 
		// pre.html 使用 HTML 高亮顯示
		// 並且不顯示行號
		$('pre.html').snippet('html', {
			style: 'pablo'
		});
 
		// pre.css 使用 CSS 高亮顯示
		$('pre.css').snippet('css', {
			style: 'berries-dark'
		});
 
		// pre.php 使用 PHP 高亮顯示
		$('pre.php').snippet('php', {
			style: 'golden'
		});
	});
</script>
<!-- InstanceEndEditable -->
</head>
<body>


<!-- begin #page-loader -->
<!--<div id="page-loader" class="fade show"><span class="spinner"></span></div>-->
<!-- end #page-loader --> 
<!-- begin #page-container -->
<div id="page-container" class="page-header-fixed page-sidebar-fixed page-with-wide-sidebar"> 
  <!-- begin #header -->
  <div id="header" class="header navbar-default"> 
    <!-- begin navbar-header -->
    <div class="navbar-header"> <a href="index.php?lang=<?php echo $_SESSION['lang'] ?>" class="navbar-brand"><img src="images/loginpic_b.png" class="img-fluid" style="max-height:50px; margin-top:-8px;"></a>
    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
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
          <a href="manage_siteconfig.php?wshop=<?php echo $wshop;?>&amp;Opt_Config=settingpage_bs&amp;lang=<?php echo $_SESSION['lang']; ?>" class="dropdown-item"><i class="fa fa-cogs"></i> 網站資訊</a>
          <a href="manage_state.php?wshop=<?php echo $wshop;?>&amp;Opt_State=settingpage_user&amp;lang=<?php echo $_SESSION['lang']; ?>" class="dropdown-item"><i class="fa fa-user-circle" aria-hidden="true"></i> 個人資料</a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo $logoutAction ?>" class="dropdown-item"><i class="fa fa-sign-out-alt fa-fw"></i> 登出</a>
          </div>
      </li>
    </ul>
    <!-- end header navigation right --> 
  </div>
  <!-- end #header --> 
  
  <!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
                <!-- end sidebar user -->
                     <ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								
							</div>
							<div class="info">
								<b class="caret pull-right"></b>
								<?php echo $_SESSION['MM_Username']; ?>
								<small>Website Management</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
                            <li><a href="manage_state.php?wshop=<?php echo $wshop;?>&amp;Opt_State=settingpage_user&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-cog"></i> 個人資料</a></li>
                        </ul>
					</li>
				</ul>
				<!-- begin sidebar user -->
                <!-- InstanceBeginEditable name="左選單" -->
    	<?php require_once("require_leftmainmenu_tutorials.php"); ?>
    	<!-- InstanceEndEditable -->
				<ul class="nav"><li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li></ul>
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
        
  <!-- begin #content -->
  <div id="content_full" class="content" style="padding:15px">
    <div class="row">
    <div class="col-lg-12">
      <?php //require("require_mainmenu_viewline.php"); ?>
      <?php //require("inc_managelangselect.php"); ?>
      <!-- InstanceBeginEditable name="主內容" -->
        <?php
			switch($_GET['Opt_Tutorials'])
			{
				case "viewpage":
					require("tutorial/require_tutorial_faq.php");			
					break;
				case "faq":
					require("tutorial/require_tutorial_faq.php");			
					break;
				case "faq01":
					require("tutorial/require_tutorial_faq01.php");			
					break;
				case "faq02":
					require("tutorial/require_tutorial_faq02.php");			
					break;
				case "faq03":
					require("tutorial/require_tutorial_faq03.php");			
					break;
				case "faq04":
					require("tutorial/require_tutorial_faq04.php");			
					break;
				case "faq05":
					require("tutorial/require_tutorial_faq05.php");			
					break;
				case "tu00_1":
					require("tutorial/require_tutorial00_1.php");			
					break;
				case "tu00_2":
					require("tutorial/require_tutorial00_2.php");			
					break;
				case "tu00_3":
					require("tutorial/require_tutorial00_3.php");			
					break;
				case "tu00_4":
					require("tutorial/require_tutorial00_4.php");			
					break;
				case "tu01":
					require("tutorial/require_tutorial01.php");			
					break;
				case "tu02":
					require("tutorial/require_tutorial02.php");			
					break;
				case "tu03":
					require("tutorial/require_tutorial03.php");			
					break;
				case "tu04":
					require("tutorial/require_tutorial04.php");			
					break;
				case "tu05":
					require("tutorial/require_tutorial05.php");			
					break;
				case "tu06":
					require("tutorial/require_tutorial06.php");			
					break;
				case "tu07":
					require("tutorial/require_tutorial07.php");			
					break;
				case "tu08":
					require("tutorial/require_tutorial08.php");			
					break;
				case "tu09":
					require("tutorial/require_tutorial09.php");			
					break;
				case "tu10":
					require("tutorial/require_tutorial10.php");			
					break;
				case "tu11":
					require("tutorial/require_tutorial11.php");			
					break;
				case "tu12":
					require("tutorial/require_tutorial12.php");			
					break;
				case "tu13":
					require("tutorial/require_tutorial13.php");			
					break;
				case "tu14":
					require("tutorial/require_tutorial14.php");			
					break;
				case "tu15":
					require("tutorial/require_tutorial15.php");			
					break;
				case "tu16":
					require("tutorial/require_tutorial16.php");			
					break;
				case "tu17":
					require("tutorial/require_tutorial17.php");			
					break;
				case "tu18":
					require("tutorial/require_tutorial18.php");			
					break;
				case "tu19":
					require("tutorial/require_tutorial19.php");			
					break;
				case "tu20":
					require("tutorial/require_tutorial20.php");			
					break;
				case "tu21":
					require("tutorial/require_tutorial21.php");			
					break;
				case "tu22":
					require("tutorial/require_tutorial22.php");			
					break;
				case "tu23":
					require("tutorial/require_tutorial23.php");			
					break;
				case "tu24":
					require("tutorial/require_tutorial24.php");			
					break;
				case "tu25":
					require("tutorial/require_tutorial25.php");			
					break;
				case "tu26":
					require("tutorial/require_tutorial26.php");			
					break;
				case "tu27":
					require("tutorial/require_tutorial27.php");			
					break;
				case "tu28":
					require("tutorial/require_tutorial28.php");			
					break;
				case "tu29":
					require("tutorial/require_tutorial29.php");			
					break;
				case "tu30":
					require("tutorial/require_tutorial30.php");			
					break;
				case "tu31":
					require("tutorial/require_tutorial31.php");			
					break;
				case "tu32":
					require("tutorial/require_tutorial32.php");			
					break;
				case "tu33":
					require("tutorial/require_tutorial33.php");			
					break;
				case "tu34":
					require("tutorial/require_tutorial34.php");			
					break;
				case "tu35":
					require("tutorial/require_tutorial35.php");			
					break;
				case "tu36":
					require("tutorial/require_tutorial36.php");			
					break;
				case "tu37":
					require("tutorial/require_tutorial37.php");			
					break;
				case "tu38":
					require("tutorial/require_tutorial38.php");			
					break;
				default:
					require("tutorial/require_tutorial_faq.php");	
					break;
			}
		?>
		<!-- InstanceEndEditable -->
    </div>
    </div>
  </div>
  <!-- end #content --> 
  
  <!-- begin #footer -->
  <div id="footer" class="footer" style="background-color:#333; color:#FFF; text-align:center; margin-left:210px; margin-right:0"> 
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
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-eonasdan-datetimepicker/build/locale/zh-tw.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<!-- ================== END FORM LEVEL JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<!-- ================== END PAGE LEVEL JS ================== --> 

<script>
	$(document).ready(function() {
		App.init();
		$(".select2").select2({// 隐藏搜索框 
     		 //minimumResultsForSearch: Infinity
		});
		//Highlight.init();
		//TableManageDefault.init();
		//Dashboard.init();
		//FormPlugins.init();
		$(".colorbox_iframe").colorbox({iframe:!0,width:"90%",height:"90%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_small").colorbox({iframe:!0,width:"1000px",height:"80%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_cd").colorbox({iframe:!0,width:"99%",height:"99%",fixed:!0,rel:"nofollow"});$(".youtube").colorbox({iframe:true, innerWidth:900, innerHeight:506});
		
        // 點選文字框即全選其文字
		$("input[type='number']").on("click", function () {
		 	$(this).select();
		});
		
		// οnfοcus="this.select()" // 加入至input

	});
</script>
</body>
<!-- InstanceEnd --></html>
<?php 
//$endTime = getMicroTime(); //页面结尾定义
//echo getRunTime($startTime, $endTime); //最后调用函数
?>