<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>

<?php 
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>

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

// 強制設定語系
$_GET['lang'] = "sp";
$_SESSION['lang'] = "sp";

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "") && $_GET['userid'] == $w_userid) {
  $deleteSQL = sprintf("DELETE FROM demo_tmphomecolumn WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));
  if($_GET['type'] == 'productlist' || $_GET['type'] == 'frilink' || $_GET['type'] == 'modlink' || $_GET['type'] == 'articlelist' || $_GET['type'] == 'fbfan' || $_GET['type'] == 'alllist' || $_GET['type'] == 'newslist' || $_GET['type'] == 'blogplist' || $_GET['type'] == 'blogcalendar' || $_GET['type'] == 'siteviewcount' || $_GET['type'] == 'sitewhoscount' || $_GET['type'] == 'alltypelist')
  {
	  // 鎖定
	  $updateSQLLock = sprintf("UPDATE demo_setting_fr SET %s=0 WHERE userid=%s",
	                       GetSQLValueString("Home" . $_GET['type'] . "Lock_sp", "none"),
						   GetSQLValueString($_GET['userid'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultLock = mysqli_query($DB_Conn, $updateSQLLock) or die(mysqli_error($DB_Conn));
  }
  $_SESSION['DB_Del'] = "Success";

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $deleteGoTo = "tmp_config_" . $_GET['board'] . "_column_sp.php?lang=" . $_SESSION['lang'] . "&board=" . $_GET['board'] . "&id_edit=" . $_GET['id_edit'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $deleteGoTo));
  ob_end_flush(); // 輸出緩衝區結束
  exit;
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "TmpColumnFree")) {
  $insertSQL = sprintf("INSERT INTO demo_tmphomecolumn (type, style, dftname, customname, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['style'], "text"),
					   GetSQLValueString($_POST['dftname'], "text"),
					   GetSQLValueString($_POST['dftname_sp'], "text"),
					   GetSQLValueString("sp", "text"),
                       GetSQLValueString($_POST['userid'], "int"));
					   
  if($_POST['type'] == 'productlist' || $_POST['type'] == 'frilink' || $_POST['type'] == 'modlink' || $_POST['type'] == 'articlelist' || $_POST['type'] == 'fbfan' || $_POST['type'] == 'alllist' || $_POST['type'] == 'newslist' || $_POST['type'] == 'blogplist' || $_POST['type'] == 'blogcalendar' || $_POST['type'] == 'siteviewcount' || $_POST['type'] == 'sitewhoscount' || $_POST['type'] == 'alltypelist')
  {
	  // 鎖定
	  //$_POST['type'];
	  $updateSQLLock = sprintf("UPDATE demo_setting_fr SET %s=1 WHERE userid=%s",
	  					   GetSQLValueString("Home" . $_POST['type'] . "Lock_sp", "none"),
						   GetSQLValueString($_POST['userid'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultLock = mysqli_query($DB_Conn, $updateSQLLock) or die(mysqli_error($DB_Conn));
  }
  $_SESSION['DB_Add'] = "Success";

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

$collang_RecordTmpColumn = "sp";
if (isset($_GET['lang'])) {
  $collang_RecordTmpColumn = "sp";
}
$coluserid_RecordTmpColumn = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpColumn = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpColumn = sprintf("SELECT * FROM demo_tmphomecolumn WHERE lang=%s && userid=%s", GetSQLValueString($collang_RecordTmpColumn, "text"),GetSQLValueString($coluserid_RecordTmpColumn, "int"));
$RecordTmpColumn = mysqli_query($DB_Conn, $query_RecordTmpColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn);
$totalRows_RecordTmpColumn = mysqli_num_rows($RecordTmpColumn);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpAddHomeColumn = "SELECT * FROM demo_tmpaddhomecolumn WHERE class != 'block'";
$RecordTmpAddHomeColumn = mysqli_query($DB_Conn, $query_RecordTmpAddHomeColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpAddHomeColumn = mysqli_fetch_assoc($RecordTmpAddHomeColumn);
$totalRows_RecordTmpAddHomeColumn = mysqli_num_rows($RecordTmpAddHomeColumn);

$coluserid_RecordSettingLock = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingLock = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingLock = sprintf("SELECT HomeproductlistLock_sp, HomefrilinkLock_sp, HomemodlinkLock_sp, HomearticlelistLock_sp, HomefbfanLock_sp, HomealllistLock_sp, HomenewslistLock_sp, HomesiteviewcountLock_sp, HomesitewhoscountLock_sp FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($coluserid_RecordSettingLock, "text"));
$RecordSettingLock = mysqli_query($DB_Conn, $query_RecordSettingLock) or die(mysqli_error($DB_Conn));
$row_RecordSettingLock = mysqli_fetch_assoc($RecordSettingLock);
$totalRows_RecordSettingLock = mysqli_num_rows($RecordSettingLock);

$colname_RecordTmp = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordTmp = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmp, "int"));
$RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
$totalRows_RecordTmp = mysqli_num_rows($RecordTmp);
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

<!-- ================== BEGIN X-Editable CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/css/bootstrap4-editable.min.css" rel="stylesheet" />
<!-- ================== END X-Editable CSS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 側邊欄位 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="row">
<div class="col-lg-6">
<!-- begin panel -->
<div class="panel panel-inverse" id="Step_Edit_Board"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 欄位設定</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <form id="form_TmpColumnList" name="form_TmpColumnList" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered">
    <div class="table-responsive">
        <table class="table table-striped m-b-0" id="data-table-default">
            <thead>
                <tr>
                    <th>欄位型態</th>
                    <th>自訂欄位標題</th>
                    <th>排序</th>
                    <th width="1%">操作</th>
                </tr>
            </thead>
            <tbody>
			<?php do { ?>
            <?php if ($totalRows_RecordTmpColumn > 0) { // Show if recordset not empty ?>
                <tr>
                    <td><?php echo $row_RecordTmpColumn['dftname']; ?></td>
                    <td><span class="ed_customname" id="customname_<?php echo $row_RecordTmpColumn['id']; ?>" data-pk="<?php echo $row_RecordTmpColumn['id']; ?>"><?php echo $row_RecordTmpColumn['customname']; ?></span><?php if ($row_RecordTmpColumn['type'] == 'fbfan') { ?><a href="fbid_home.php?wshop=<?php echo $wshop;?>&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank" data-original-title="該頁面下方FB粉絲頁作設定。" data-toggle="tooltip" data-placement="right" class="btn btn-xs btn-primary pull-right colorbox_iframe"><i class="fa fa-arrow-circle-right"></i> ID設定</a><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'frilink') { ?><a href="manage_frilink.php?wshop=<?php echo $wshop;?>&amp;Opt_Frilink=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank" data-original-title="加入外部連結網址。" data-toggle="tooltip" data-placement="right" class="btn btn-xs btn-primary pull-right"><i class="fa fa-arrow-circle-right"></i> 資料維護</a><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'modlink') { ?><a href="manage_modlink.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank" data-original-title="加入現有模組連結網址。" data-toggle="tooltip" data-placement="right" class="btn btn-xs btn-primary pull-right"><i class="fa fa-arrow-circle-right"></i> 資料維護</a><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'siteviewcount') { ?><a href="counter_home.php?wshop=<?php echo $wshop;?>&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定初始人數。" data-toggle="tooltip" data-placement="right" class="btn btn-xs btn-primary pull-right colorbox_iframe"><i class="fa fa-arrow-circle-right"></i> 起始人數</a></span><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'free') { ?> <i data-original-title="此項目可自行放置Html語法。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'alltypelist') { ?> <i class="fa fa-info-circle text-orange" data-original-title="此項目可依各選單項目之底層子選單做分類，顯示於各頁面中，每一頁面皆有自己的分類清單。" data-toggle="tooltip" data-placement="top"></i><a href="submenu_home.php?wshop=<?php echo $wshop;?>&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-xs btn-primary pull-right colorbox_iframe" data-original-title="設定標題名稱。" data-toggle="tooltip" data-placement="right"><i class="fa fa-arrow-circle-right"></i> 標題名稱</a><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'alllist') { ?> <i data-original-title="此項目可在每一頁面中加入主選單列表。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'bline') { ?> <i data-original-title="此項目會放置一高度5px之空白區塊。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productlist') { ?> <i data-original-title="此項目可加入產品分類選單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'newslist') { ?> <i data-original-title="此項目可加入最新訊息。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'articlelist') { ?> <i data-original-title="此項目可加入自訂之文章選單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productactlist') { ?> <i data-original-title="此項目可加入活動商品清單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'producthotlist') { ?> <i data-original-title="此項目可加入熱門商品清單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productsalelist') { ?> <i data-original-title="此項目可加入促銷商品清單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productnewslist') { ?> <i data-original-title="此項目可加入最新商品清單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productsearch') { ?> <i data-original-title="此項目可加入商品搜尋。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?></td>
                    <td id="Step_Sort"><span class="sortid" id="sortid_<?php echo $row_RecordTmpColumn['id']; ?>" data-pk="<?php echo $row_RecordTmpColumn['id']; ?>"><?php echo $row_RecordTmpColumn['sortid']; ?></span></td>
                    <td id="Step_Edit"><div class="btn-group"><?php if ($row_RecordTmpColumn['style'] == 'free') { ?><a href="tmp_config_home_column_setting_free.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> 修改</a><?php } else if($row_RecordTmpColumn['style'] == 'menu') { ?><a href="tmp_config_home_column_setting_menu.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> 修改</a><?php } else { ?><a href="tmp_config_home_column_setting.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> 修改</a><?php } ?><a href="tmp_config_<?php echo $_GET['board']; ?>_column_sp.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>" class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i> 刪除</a></div></td>
                </tr>
             <?php } // Show if recordset not empty ?>
            <?php } while ($row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn)); ?>   

            </tbody>
        </table>
    </div>
    
        <input type="hidden" name="MM_update" value="form_NewsItemEdit" />
      </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
</div>


<div class="col-lg-6">
<!-- begin panel -->
<div class="panel panel-inverse" id="Step_Edit_Board"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="tmp_config_<?php echo $_GET['board']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa fa-plus"></i> 可新增欄位</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-hover m-b-0">
            <thead>
                <tr>
                    <th>欄位型態</th>
                    <th>描述</th>
                    <th width="1%">操作</th>
                </tr>
            </thead>
            <tbody>
			<?php do { ?>
            <?php if (
		  ($row_RecordTmpAddHomeColumn['type'] == 'sitewhoscount' && ($row_RecordSettingLock['HomesitewhoscountLock_sp'] == '1')) || 
		  ($row_RecordTmpAddHomeColumn['type'] == 'siteviewcount' && ($row_RecordSettingLock['HomesiteviewcountLock_sp'] == '1')) || 
		  ($row_RecordTmpAddHomeColumn['type'] == 'frilink' && ($row_RecordSettingLock['HomefrilinkLock_sp'] == '1' OR $OptionFrilinkSelect == '0')) || 
		  ($row_RecordTmpAddHomeColumn['type'] == 'modlink' && ($row_RecordSettingLock['HomemodlinkLock_sp'] == '1')) || 
		  ($row_RecordTmpAddHomeColumn['type'] == 'productlist' && ($row_RecordSettingLock['HomeproductlistLock_sp'] == '1' OR $OptionProductSelect == '0')) || 
		  ($row_RecordTmpAddHomeColumn['type'] == 'articlelist' && ($row_RecordSettingLock['HomearticlelistLock_sp'] == '1' OR $OptionArticleSelect == '0')) || 
		  ($row_RecordTmpAddHomeColumn['type'] == 'fbfan' && ($row_RecordSettingLock['HomefbfanLock_sp'] == '1')) || 
		  ($row_RecordTmpAddHomeColumn['type'] == 'alllist' && ($row_RecordSettingLock['HomealllistLock_sp'] == '1')) || 
		  ($row_RecordTmpAddHomeColumn['type'] == 'newslist' && ($row_RecordSettingLock['HomenewslistLock_sp'] == '1' OR $OptionNewsSelect == '0'))
		  ) { ?>
          <?php } else { ?>
          <form name="TmpColumn" action="<?php echo $editFormAction; ?>" method="POST" id="TmpColumn<?php echo $row_RecordTmpAddHomeColumn['type']; ?>">
                <tr>
                    <td><?php echo $row_RecordTmpAddHomeColumn['dftname']; ?></td>
                    <td><?php echo $row_RecordTmpAddHomeColumn['desc']; ?></td>
                    <td id="Step_Add"><button type="submit" class="btn btn btn-primary btn-xs"><i class="fa fa-plus"></i> 新增</button></td>
                </tr>
             <input name="type" type="hidden" id="type" value="<?php echo $row_RecordTmpAddHomeColumn['type']; ?>" />
             <input name="dftname" type="hidden" id="dftname" value="<?php echo $row_RecordTmpAddHomeColumn['dftname']; ?>" />
             <input name="dftname_sp" type="hidden" id="dftname_sp" value="<?php echo $row_RecordTmpAddHomeColumn['dftname_sp']; ?>" />
             <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTmpAddHomeColumn['id']; ?>" />
             <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
             <input name="style" type="hidden" id="style" value="<?php echo $row_RecordTmpAddHomeColumn['style']; ?>" />
             <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
             <input name="location" type="hidden" id="location" value="left" />
             <input type="hidden" name="MM_insert" value="TmpColumnFree" />
          </form>
             <?php } // Show if recordset not empty ?>
            <?php } while ($row_RecordTmpAddHomeColumn = mysqli_fetch_assoc($RecordTmpAddHomeColumn)); ?> 
            </tbody>
        </table>
    </div>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
</div>
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
		//Highlight.init();
		//TableManageDefault.init();
		//Dashboard.init();
		//FormPlugins.init();
	});
</script>

<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip1',
                intro: '依照以下的步驟操作，您可加入功能至側邊欄位中。'
              },
			  {
                element: '#Step_Tip2',
                intro: '<img src="images/tip/tip031.jpg" width="300" height="300" /><br /><br />前台顯示結果。'
              },
			  {
                element: '#Step_Add_Board',
                intro: '此區塊為可新增的功能列表。'
              },
			  {
                element: '#Step_Edit_Board',
                intro: '此區塊為目前網站中顯示的功能列表。'
              },
			  {
                element: '#Step_Add',
                intro: '您可以點選按鈕新增功能。新增的項目會加入至左方區塊中並顯示於網站。'
              },
              {
                element: '#Step_Sort',
                intro: '<img src="images/tip/tip060.jpg" width="126" height="102" /><br /><br />點選文字可直接修改，更改數字即可排序。',
                position: 'bottom'
              },
              {
                element: '#Step_Edit',
                intro: '您可以對每個項目做細部修改。',
                position: 'bottom'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>
<script>
$('#data-table-default').editable({
	selector: ".ed_customname",
	url: 'sqledit/tmphomecolumn_jedit.php',
	type: 'text',
	name: 'customname',
	//title: '輸入標題',
	tpl: "<input type='text' style='width: 100%' maxlength='200'>",
	select2: {
		width: '100%',
		// THIS DOESN'T WORK AS IT SHOULD
		// hiding search box
		minimumResultsForSearch: -1
	},
	validate: function(value) {
		if ($.trim(value) == '') {
			return '值不能為空';
		}
	}
});
				
$('#data-table-default').editable({
	selector: ".sortid",
	url: 'sqledit/tmphomecolumn_jedit.php',
	type: 'text',
	name: 'sortid',
	//title: '輸入排序',
	tpl: "<input type='number' style='width: 80px' maxlength='200'>",
	select2: {
		width: '100%',
		// THIS DOESN'T WORK AS IT SHOULD
		// hiding search box
		minimumResultsForSearch: -1
	},
	validate: function(value) {
		if ($.trim(value) == '') {
			return '值不能為空';
		}
	}
});
</script>

<?php if(isset($_SESSION['DB_Add']) && $_SESSION['DB_Add'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Add"]); ?>
<?php } ?>
<?php if(isset($_SESSION['DB_Edit']) && $_SESSION['DB_Edit'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Edit"]); ?>
<?php } ?>
<?php if(isset($_SESSION['DB_Del']) && $_SESSION['DB_Del'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料移除成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Del"]); ?>
<?php } ?>
</body>
</html>

<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpColumn);

mysqli_free_result($RecordTmpAddHomeColumn);

mysqli_free_result($RecordSettingLock);
?>