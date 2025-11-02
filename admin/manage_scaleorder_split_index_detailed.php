<?php 
$UseMod = "Splitorder"; // 目前使用模組
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

$colname_RecordStaffListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordStaffListType = $_GET["lang"];
}
$coluserid_RecordStaffListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStaffListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStaffListType = sprintf("SELECT * FROM salary_staffitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordStaffListType, "text"),GetSQLValueString($coluserid_RecordStaffListType, "int"));
$RecordStaffListType = mysqli_query($DB_Conn, $query_RecordStaffListType) or die(mysqli_error($DB_Conn));
$row_RecordStaffListType = mysqli_fetch_assoc($RecordStaffListType);
$totalRows_RecordStaffListType = mysqli_num_rows($RecordStaffListType);

/* 取得類別列表 */
$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE userid=%s ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

$coluserid_RecordCarnumber = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCarnumber = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCarnumber = sprintf("SELECT * FROM erp_carnumber WHERE userid=%s && indicate=1 ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordCarnumber, "int"));
$RecordCarnumber = mysqli_query($DB_Conn, $query_RecordCarnumber) or die(mysqli_error($DB_Conn));
$row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
$totalRows_RecordCarnumber = mysqli_num_rows($RecordCarnumber);

$colname_RecordSplitorder = "-1";
if (isset($_GET['oid'])) {
  $colname_RecordSplitorder = $_GET['oid'];
}
$coluserid_RecordSplitorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorder = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorder = sprintf("SELECT * FROM erp_splitorder WHERE oid = %s && userid=%s", GetSQLValueString($colname_RecordSplitorder, "int"),GetSQLValueString($coluserid_RecordSplitorder, "int"));
$RecordSplitorder = mysqli_query($DB_Conn, $query_RecordSplitorder) or die(mysqli_error($DB_Conn));
$row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder);
$totalRows_RecordSplitorder = mysqli_num_rows($RecordSplitorder);

$colname_RecordSplitorderPhoto_before = "-1";
if (isset($_GET['oid'])) {
  $colname_RecordSplitorderPhoto_before = $_GET['oid'];
}
$coluserid_RecordSplitorderPhoto_before = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorderPhoto_before = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderPhoto_before = sprintf("SELECT * FROM erp_splitorderphoto WHERE aid = %s && userid=%s && state='before'", GetSQLValueString($colname_RecordSplitorderPhoto_before, "int"),GetSQLValueString($coluserid_RecordSplitorderPhoto_before, "int"));
$RecordSplitorderPhoto_before = mysqli_query($DB_Conn, $query_RecordSplitorderPhoto_before) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderPhoto_before = mysqli_fetch_assoc($RecordSplitorderPhoto_before);
$totalRows_RecordSplitorderPhoto_before = mysqli_num_rows($RecordSplitorderPhoto_before);

$colname_RecordSplitorderPhoto_after = "-1";
if (isset($_GET['oid'])) {
  $colname_RecordSplitorderPhoto_after = $_GET['oid'];
}
$coluserid_RecordSplitorderPhoto_after = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorderPhoto_after = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderPhoto_after = sprintf("SELECT * FROM erp_splitorderphoto WHERE aid = %s && userid=%s && state='after'", GetSQLValueString($colname_RecordSplitorderPhoto_after, "int"),GetSQLValueString($coluserid_RecordSplitorderPhoto_after, "int"));
$RecordSplitorderPhoto_after = mysqli_query($DB_Conn, $query_RecordSplitorderPhoto_after) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderPhoto_after = mysqli_fetch_assoc($RecordSplitorderPhoto_after);
$totalRows_RecordSplitorderPhoto_after = mysqli_num_rows($RecordSplitorderPhoto_after);

$colname_RecordSplitorderDetailed = "-1";
if (isset($_GET['oid'])) {
  $colname_RecordSplitorderDetailed = $_GET['oid'];
}
$coluserid_RecordSplitorderDetailed = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorderDetailed = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderDetailed = sprintf("SELECT * FROM erp_splitorderdetial WHERE oid = %s && userid=%s", GetSQLValueString($colname_RecordSplitorderDetailed, "int"),GetSQLValueString($coluserid_RecordSplitorderDetailed, "int"));
$RecordSplitorderDetailed = mysqli_query($DB_Conn, $query_RecordSplitorderDetailed) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderDetailed = mysqli_fetch_assoc($RecordSplitorderDetailed);
$totalRows_RecordSplitorderDetailed = mysqli_num_rows($RecordSplitorderDetailed);
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

<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery.jqprint/jquery.jqprint-0.3.js"></script>
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/invoice-print.min.css" rel="stylesheet" id="theme" />

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
      
      

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <a href="#" class="btn btn-primary btn-block" onClick="a()"><i class="fa fa-print" aria-hidden="true"></i> 列印本頁</a>
  <div class="panel-body p-0 bg-white" id="jq_print">
      <link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-print/css/bootstrap-print.min.css" rel="stylesheet" />
      <div style="max-width:1000px; margin-left:auto; margin-right:auto; padding:10px;">
      
      

      <table class="table m-b-0 table-condensed">
        <thead>
        <tr>
          <th colspan="4" class="title_bg"><h4 class="media-heading text-center"><?php echo $row_RecordCart['warehouse']; ?>拆分明細表</h4></th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td width="160" class="title_bg">拆分單號</td>
          <td><?php echo $row_RecordSplitorder['oserial']; ?></td>
          <td width="160" class="title_bg">預估天數</td>
          <td><?php echo $row_RecordSplitorder['Estimatedday']; ?></td>
        </tr>
        <tr>
          <td width="160" class="title_bg">拆分日期</td>
          <td width="380"><?php echo $row_RecordSplitorder['startdate']; ?></td>
          <td width="160" class="title_bg">完工日期</td>
          <td width="380"><?php echo $row_RecordSplitorder['enddate']; ?></td>
        </tr>
        <tr>
          <td width="160" class="title_bg">車號</td>
          <td width="380"><?php echo $row_RecordSplitorder['carnumber']; ?></td>
          <td width="160" class="title_bg">總重量</td>
          <td width="380"><?php echo $row_RecordSplitorder['bigweight']; ?></td>
        </tr>
        </tbody>
      </table>

  <?php if ($totalRows_RecordSplitorderPhoto_before > 0) { ?>
  
  <div style="background-color:#FFF; padding:10px; border:1px #CCCCCC dashed; margin-top:10px; margin-bottom:10px;">
  <h6><strong>拆分前</strong></h6>
	<div class="row">
      <?php do { ?>
      <div class="col-md-3 col-xs-6 col-p-3">
          <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="height:100px;">
            <img src="<?php echo $SiteImgUrl; ?><?php echo $row_RecordAccount['webname']; ?>/image/scaleorder_split/<?php echo GetFileThumbExtend($row_RecordSplitorderPhoto_before['pic']); ?>" data-fill="resize" data-board="0">
          </div></div>
      </div>
      <?php } while ($row_RecordSplitorderPhoto_before = mysqli_fetch_assoc($RecordSplitorderPhoto_before)); ?>
      
    </div>
  </div>
  <?php } ?>
  
  <?php if ($totalRows_RecordSplitorderPhoto_after > 0) { ?>
  <div style="background-color:#FFF; padding:10px; border:1px #CCCCCC dashed; margin-top:10px; margin-bottom:10px;">
  <h6><strong>拆分後</strong></h6>
	<div class="row">
      <?php do { ?>
      <div class="col-md-3 col-xs-6 col-p-3">
          <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="height:100px;">
            <img src="<?php echo $SiteImgUrl; ?><?php echo $row_RecordAccount['webname']; ?>/image/scaleorder_split/<?php echo GetFileThumbExtend($row_RecordSplitorderPhoto_after['pic']); ?>" data-fill="resize" data-board="0">
          </div></div>
      </div>
      <?php } while ($row_RecordSplitorderPhoto_after = mysqli_fetch_assoc($RecordSplitorderPhoto_after)); ?> 
  </div>
  </div>
  <?php } ?>
      
<div class="row">
  <div class="table-responsive">
	<table class="table table-bordered table-striped table-condensed">
		<thead>
			<tr>
				<th><i class="fa fa-sort-amount-asc"></i> 編號</th>
				<th><i class="fa fa-asterisk"></i> 代號</th>
				<th><i class="fa fa-clone"></i> 物料</th>
				<th><i class="fa fa-balance-scale"></i>重量</strong></th>
				<th colspan="3"><i class="fa fa-balance-scale"></i> 比例</th>
				</tr>
		</thead>
		<tbody>
        <?php $i=1; ?>
        <?php if ($totalRows_RecordSplitorderDetailed > 0) { ?>
         <?php do { ?>
		 <?php 
$colname_RecordScale = "-1";
if (isset($row_RecordSplitorderDetailed['code'])) {
  $colname_RecordScale = $row_RecordSplitorderDetailed['code'];
}
$coluserid_RecordScale = "-1";
if (isset($row_RecordSplitorder['userid'])) {
  $coluserid_RecordScale = $row_RecordSplitorder['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

//////////

$collang_RecordScaleViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordScaleViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordScaleViewLine_l1 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleViewLine_l1 = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleViewLine_l1 = sprintf("SELECT * FROM erp_scaleitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordScaleViewLine_l1, "text"),GetSQLValueString($coluserid_RecordScaleViewLine_l1, "int"));
$RecordScaleViewLine_l1 = mysqli_query($DB_Conn, $query_RecordScaleViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
$totalRows_RecordScaleViewLine_l1 = mysqli_num_rows($RecordScaleViewLine_l1);


if ($row_RecordScale['type1'] != '') {
	do {  //比較字串
		if (!(strcmp($row_RecordScaleViewLine_l1['item_id'], $row_RecordScale['type1']))) { $row_RecordSplitorderDetailed['code'] =  $row_RecordScaleViewLine_l1['itemname']; 
		}
	} while ($row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1));
	$rows = mysqli_num_rows($RecordScaleViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordScaleViewLine_l1, 0);
		  $row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
	  }
}
 ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row_RecordSplitorderDetailed['code']; ?></td>
				<td>
				
				
				<?php echo $row_RecordSplitorderDetailed['title']; ?>

                </td>
				<td><?php echo $row_RecordSplitorderDetailed['weight']; ?> kg</td>
				<td><?php echo $row_RecordSplitorderDetailed['percent']; ?> %</td>
			</tr>
            <?php $i++; ?>
            <?php 
			$NowTotalweight += $row_RecordSplitorderDetailed['weight'];
			$NowTotalpercent += $row_RecordSplitorderDetailed['percent'];

			//echo $row_RecordSplitorderDetailed['Totalweight']; 
			
			?>
            <?php } while ($row_RecordSplitorderDetailed = mysqli_fetch_assoc($RecordSplitorderDetailed)); ?>
            <?php } ?>
		</tbody>
        <tr>
				<td colspan="5" align="right">總重 <?php echo $NowTotalweight ?> kg / 比例 <?php echo $NowTotalpercent ?> %</td>
				</tr>
        <tfoot>
        </tfoot>
	</table>
    
</div>
     
            
    </div>
                                
      </div>
  
  </div>
  <a href="#" class="btn btn-primary btn-block" onClick="a()"><i class="fa fa-print" aria-hidden="true"></i> 列印本頁</a>

  <!-- end panel-body --> 
</div>
<!-- end panel -->
      
      
    </div>
    </div>
  </div>
  <!-- end #content --> 
  
  <!-- begin scroll to top btn --> 
  <div style="max-width:1000px; margin-left:auto; margin-right:auto; padding:10px;"><a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a></div> 
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

<script language="javascript">
	function  a(){$("#jq_print").jqprint();}
</script>

<script>
$(document).ready(function() {
	$(".imgLiquidFill").imgLiquid({fill:false});
});
</script>

<?php if(isset($_GET['GP_upload']) && $_GET['GP_upload'] == true) { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
</body>
</html>

<?php
mysqli_free_result($RecordScale);

mysqli_free_result($RecordCarnumber);

mysqli_free_result($RecordSplitorder);

mysqli_free_result($RecordSplitorderPhoto_before);

mysqli_free_result($RecordSplitorderPhoto_after);

mysqli_free_result($RecordSplitorderDetailed);
?>