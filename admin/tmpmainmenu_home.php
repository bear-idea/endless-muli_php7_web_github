<?php 
$UseMod = "TmpMainMenu"; // 目前使用模組
//ob_start(); // 開啟輸出緩衝區
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE demo_tmp SET tmpmainmenu=%s WHERE id=%s",
                       GetSQLValueString($_POST['TmpMainMenuSelect'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenuListType = "SELECT * FROM demo_tmpitem WHERE list_id = 5";
$RecordTmpMainMenuListType = mysqli_query($DB_Conn, $query_RecordTmpMainMenuListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenuListType = mysqli_fetch_assoc($RecordTmpMainMenuListType);
$totalRows_RecordTmpMainMenuListType = mysqli_num_rows($RecordTmpMainMenuListType);

$colname_RecordTmpMainMenuBoardStyle = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpMainMenuBoardStyle = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenuBoardStyle = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmpMainMenuBoardStyle, "int"));
$RecordTmpMainMenuBoardStyle = mysqli_query($DB_Conn, $query_RecordTmpMainMenuBoardStyle) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenuBoardStyle = mysqli_fetch_assoc($RecordTmpMainMenuBoardStyle);
$totalRows_RecordTmpMainMenuBoardStyle = mysqli_num_rows($RecordTmpMainMenuBoardStyle);

$colid_RecordTmpMainMenu = "-1";
if (isset($row_RecordTmpMainMenuBoardStyle['tmpmainmenu'])) {
  $colid_RecordTmpMainMenu = $row_RecordTmpMainMenuBoardStyle['tmpmainmenu'];
}
$coluserid_RecordTmpMainMenu = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpMainMenu = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenu = sprintf("SELECT * FROM demo_tmpmainmenu WHERE id=%s && (userid=%s || userid=1)", GetSQLValueString($colid_RecordTmpMainMenu, "int"),GetSQLValueString($coluserid_RecordTmpMainMenu, "int"));
$RecordTmpMainMenu = mysqli_query($DB_Conn, $query_RecordTmpMainMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainMenu);
$totalRows_RecordTmpMainMenu = mysqli_num_rows($RecordTmpMainMenu);
?>
<!DOCTYPE html>
<html lang="zh-TW">
<!--<![endif]-->
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
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/theme/default.min.css" rel="stylesheet" id="theme" />
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/intro-js/introjs.min.css" rel="stylesheet" />
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
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/intro-js/intro.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/imgLiquid/js/imgLiquid-min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
<!-- ================== END NECESSARY ALL PAGE JS ================== --> 
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- ================== BEGIN Datatables CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.dataTables.min.css" rel="stylesheet" />
<!--<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" />-->
<!-- ================== END Datatables CSS ================== -->

<!-- ================== BEGIN X-Editable CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/css/bootstrap4-editable.min.css" rel="stylesheet" />
<!-- ================== END X-Editable CSS ================== -->

<!-- ================== BEGIN Datatables JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/responsive.bootstrap4.min.js"></script>
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>-->
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>-->
<!--<script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>-->
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/tmpmainmenu_datatable_get.js"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<style>
.cards tbody tr{float:left;width:20rem;margin:.5rem;border:none;border-radius:.35rem;box-shadow:0 0 2px rgba(0,0,0,.2),0 4px 4px -2px rgba(0,0,0,.2)}.cards tbody td{display:block}.cards tbody td .hidden-text{width:9rem;overflow:hidden;height:20px}
#navcss3 ul li:hover a,#navcss3 li:hover li a{color:#CF0;line-height:35px;width:150px}
#navcss3{margin:0;line-height:100%;padding:0; width:500px;}
#navcss3 .topmainmenu_l{float:left}
#navcss3 .topmainmenu_r{float:left}
#navcss3 li{float:left;position:relative;list-style:none;display: inline;}
#navcss3 a{display:inline-block;background-repeat:no-repeat;text-align:center}
#navcss3 a:hover{background-repeat:no-repeat;text-decoration:none}
#navcss3 ul li:hover a,#navcss3 li:hover li a{background-image:none;color:#000;margin:0;width:180px;line-height:25px;background-color:#FFF;text-align:left;font-weight:400;font-size:small;border-color:#EAEAEA;border-style:dotted;border-width:0 0 1px}
#navcss3 ul li:hover a:hover{background-color:#666}
#navcss3 ul a:hover{color:#fff!important;background-color:#C30;padding:0}
#navcss3 li:hover >ul{display:block}
#navcss3 ul{display:none;margin:5px;padding:5px;width:180px;position:absolute;border:solid 1px #b4b4b4;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;background-color:#FFF}
#navcss3 ul li{float:none;margin:0;padding:0}
#navcss3 ul ul{left:180px;top:0}
#navcss3:after{content:".";display:block;clear:both;visibility:hidden;line-height:0;height:0}
#navcss3{display:inline-block}
html[xmlns] #navcss3{display:block}
* html #navcss3{height:1%;}
</style>

</head>
<body>


<!-- begin #page-loader -->
<!--<div id="page-loader" class="fade show"><span class="spinner"></span></div></div>-->
<!-- end #page-loader --> 
<!-- begin #page-container -->
<div id="page-container" class="page-header-fixed page-sidebar-fixed page-without-sidebar p-0">
  <!-- begin #header -->
  
  <!-- end #header --> 
        
  <!-- begin #content -->
  <div id="content_full" class="content" style="padding:15px">
    <div class="row">
    <div class="col-lg-12">
      
      <div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 主選單 <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="tmp_config_<?php echo $row_RecordTmpMainMenuBoardStyle['name']; // 為版型風格?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpMainMenuBoardStyle['id']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 選擇資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
  <div class="row">
      <div class="col-md-12">
        <div class="card bg-grey-transparent-1">
          <div class="card-block">
            <?php if($row_RecordTmpMainMenuBoardStyle['tmpmainmenu'] != "") { ?>
            <?php 
			/* 判斷選單狀態 */
			switch($row_RecordTmpMainMenu['tmp_mainmenu_location'])
			{
				case "0":
					$img_num = "0";
					$img_desc = "主選單可在目前使用的樣板中調整位置";			
					break;
				case "1":
					$img_num = "1";	
					$img_desc = "主選單強制置於頁首區塊和橫幅區塊之間";	
					break;
				default:
					break;
			}
		   ?>
            <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpMainMenu['userid'] == '1') { ?>
            <div class="pull-left m-r-10" style="width:100%">
              <span class="label label-purple" data-original-title="目前套用背景編號" data-toggle="tooltip" data-placement="right">#No.<?php echo $row_RecordTmpMainMenu['id']; ?></span>
              <span class="label label-purple"><?php echo $row_RecordTmpMainMenu['type']; ?></span>
              <div class="img-thumbnail m-b-5 m-t-5">
              <div class="" style="width:100%; height:100px;">
              	<ul id="navcss3" style="background-image:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_o_img']; ?>); width:100%; background-position:bottom;">
			<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_l_img'] != '') { ?><li class="topmainmenu_l" style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;display:<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_l_img'] == '') {echo 'none'; } ?>"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_l_img']; ?>"/></li><?php } ?>
            <?php if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } else { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="images/block.png" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } ?>
            <?php if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image<?php echo $i; ?>','','<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>',0)"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_img']; ?>" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; id="Image<?php echo $i; ?>" /></a></li>
            <?php } else { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="images/block.png" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } ?>
  			<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_r_img'] != '') { ?><li class="topmainmenu_r" style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;float:left; display:<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_r_img'] == '') {echo 'none'; } ?>"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_r_img']; ?>"/></li><?php } ?>
            </ul>
              </div>
              </div>
               
        <span class="label label-success"><?php echo $img_desc; ?></span>
        
            </div>
            <?php } else { ?>
            <div class="pull-left m-r-10" style="width:100%">
              <span class="label label-purple" data-original-title="目前套用背景編號" data-toggle="tooltip" data-placement="right">#No.<?php echo $row_RecordTmpMainMenu['id']; ?></span>
              <span class="label label-purple"><?php echo $row_RecordTmpMainMenu['type']; ?></span>
              <div class="img-thumbnail m-b-5 m-t-5">
              <div class="" style="width:100%; height:100px;">
              	<ul id="navcss3" style="background-image:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_o_img']; ?>); width:100%; background-position:bottom;">
			<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_l_img'] != '') { ?><li class="topmainmenu_l" style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;display:<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_l_img'] == '') {echo 'none'; } ?>"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_l_img']; ?>"/></li><?php } ?>
            <?php if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } else { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="images/block.png" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } ?>
            <?php if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image<?php echo $i; ?>','','<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>',0)"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_img']; ?>" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; id="Image<?php echo $i; ?>" /></a></li>
            <?php } else { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="images/block.png" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } ?>
  			<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_r_img'] != '') { ?><li class="topmainmenu_r" style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;float:left; display:<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_r_img'] == '') {echo 'none'; } ?>"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_r_img']; ?>"/></li><?php } ?>
            </ul>
              </div>
              </div>
               
        <span class="label label-success"><?php echo $img_desc; ?></span>
        
            </div>
            <?php } ?>
            
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何主選單。</b></div>
            <?php } ?>
          </div>
        </div>
      </div>
      
    </div>
  
  <form action="<?php echo $editFormAction; ?>" method="POST" name="Form_Choose" id="Form_Choose" data-parsley-validate=""> 
    
    <div class="row justify-content-end">
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="4"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 類別</span></span>
            <select name="type" class="form-control search_filter" id="col4_filter">
            <option value="" selected="selected">全部</option>
              <?php
do {  
?>
              <option value="<?php echo $row_RecordTmpMainMenuListType['itemname']?>"><?php echo $row_RecordTmpMainMenuListType['itemname']?></option>
                  <?php
} while ($row_RecordTmpMainMenuListType = mysqli_fetch_assoc($RecordTmpMainMenuListType));
  $rows = mysqli_num_rows($RecordTmpMainMenuListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpMainMenuListType, 0);
	  $row_RecordTmpMainMenuListType = mysqli_fetch_assoc($RecordTmpMainMenuListType);
  }
?>
          </select>
        </div>
      </div>
      
      <div class="col-md-5 m-b-10">
        <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 標題 / 編號</span></span>
          <input type="text" class="form-control global_filter" placeholder="" id="global_filter">
          <div class="input-group-append" style="display:none">
            <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#collapseOne"> <span class="caret"></span> </button>
          </div>
        </div>
      </div>
    </div>
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body bg-aqua-transparent-1 m-t-10">
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>
      </div>
    </div>
    
    <table id="data-table-default" class="table table-bordered table-hover cards" style="width:100%">
      <thead>
        <tr>
          
          <th data-priority="1"><strong>可選擇主選單<div id="error_action"></div></strong></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
         
          <td><button type="button" id="reset_table" class="btn btn-default btn-sm pull-right"><i class="fa fa-sync"></i> 清除狀態</button></td>
        </tr>
      </tfoot>
    </table>
    <button type="submit" class="btn btn btn-primary btn-block m-t-10">送出</button>
    <input type="hidden" name="MM_update" value="form" />
    <input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>" />
    <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
  </form>  
  	<script>
	//$.fn.editable.defaults.mode = 'inline';
	$(document).ready(function() {	
		TableManageDefault.init();	   
	});
	</script> 
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
      
      
    </div>
    </div>
  </div>
  <!-- end #content --> 
  
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
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<!-- ================== END FORM LEVEL JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<!-- ================== END PAGE LEVEL JS ================== --> 

<script>
	$(document).ready(function() {
		App.init();
		$(".select2").select2({// 隐藏搜索框 
      minimumResultsForSearch: Infinity});
	  $(".colorpicker-element").colorpicker({format:"hex"});
		//Highlight.init();
		//TableManageDefault.init();
		//Dashboard.init();
		//FormPlugins.init();
	  $("#TransparentButtom1").click(function(){
			// 設定透明
			$("#tmpleftfontcolor").val("transparent")
		});
		<?php if ($row_RecordTmpMainMenu['tmpleftfontcolor'] == "transparent") { ?>
			$("#tmpleftfontcolor").val("transparent");
		<?php } ?>
		
		$("#TransparentButtom2").click(function(){
			// 設定透明
			$("#tmpmiddlefontcolor").val("transparent")
		});
		<?php if ($row_RecordTmpMainMenu['tmpmiddlefontcolor'] == "transparent") { ?>
			$("#tmpmiddlefontcolor").val("transparent");
		<?php } ?>
	});
</script>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
</body>
</html>
<?php
mysqli_free_result($RecordTmpMainMenuListType);

mysqli_free_result($RecordTmpMainMenuBoardStyle);

mysqli_free_result($RecordTmpMainMenu);
?>