<?php 
$UseMod = "Tmp"; // 目前使用模組
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_tmp SET homestyle=%s WHERE id=%s",
                       GetSQLValueString($_POST['homestyle'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$colname_RecordTmp = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordTmp = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmp, "int"));
$RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
$totalRows_RecordTmp = mysqli_num_rows($RecordTmp);

$coluserid_RecordTmpBg = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBg = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBg = sprintf("SELECT TmpBg FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpBg, "int"));
$RecordTmpBg = mysqli_query($DB_Conn, $query_RecordTmpBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpBg = mysqli_fetch_assoc($RecordTmpBg);
$totalRows_RecordTmpBg = mysqli_num_rows($RecordTmpBg);
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 首頁樣板 <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 選擇資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <?php if ($row_RecordTmp['homeselect'] == '1') { ?>
  <div class="alert alert-green m-10"><i class="fa fa-info-circle"></i> <b>目前已設置此版型首頁為顯示。<a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=editpage&amp;lang=<?php echo $_SESSION['lang'] ?>&amp;id_edit=<?php echo $row_RecordTmp['id'] ?>" target="_parent" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 選擇模式</a></b></div>
  <?php } else { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前已設置此版型首頁為不顯示。<a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=editpage&amp;lang=<?php echo $_SESSION['lang'] ?>&amp;id_edit=<?php echo $row_RecordTmp['id'] ?>" target="_parent" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 選擇模式</a></b></div>
  <?php } ?>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" id="form1" name="form1">
       <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 版型 <i class="fa fa-info-circle text-white" data-original-title="您必須選擇您要的首頁風格後送出，而後再依照您所選取的風格去點選《版型設定》按鈕；您所選擇的風格即為目前此版型所要套用的首頁外觀。" data-toggle="tooltip" data-placement="top"></i></span></div>
      </div>
       <div class="form-group row">
          <label class="col-md-2 col-form-label">風格<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                                 <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 45px; top: 40px;"><a data-original-title="自由選擇模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_065.png" width="30" height="30" /></a></div><div style="position: absolute; left: 5px; top: 50px;"><a data-original-title="自訂欄位" data-toggle="tooltip" data-placement="right"><img src="images/mt_049.png" width="15" height="15" /></a></div><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><a data-original-title="此版面允許您替首頁畫面設定一專屬的《自訂欄位》區塊，和內頁版型是分開的，在主要內容部分您可以放置各模組的功能於區塊中，還可加入一空白的小區塊來放置您的內容，例如圖片、文字等...，版型外觀部分會延續《版型設定》的設定，更多的外觀可至其做修改。" data-toggle="tooltip" data-placement="right"><img src="images/homesty01.jpg" alt="" width="100" height="100" /></a></div>
                                 <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard001"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_1" value="homeboard001" <?php if ($OptionTmpHomeSelect != '1') { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_1">多模組</label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1') { ?><a href="tmp_config_homeboard001.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard001" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                  </div> 
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 34px; top: 41px;"><a data-original-title="自由選擇模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_065.png" width="30" height="30" /></a></div><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><a data-original-title="此版面在主要內容部分您可以放置各模組的功能於區塊中，可加入一空白的小區塊來放置您的內容，例如圖片、文字等...，版型外觀部分會延續《版型設定》的設定，更多的外觀可至其做修改。" data-toggle="tooltip" data-placement="right"><img src="images/homesty09.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard002"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_2" value="homeboard002" <?php if ($OptionTmpHomeSelect != '1') { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_2">多模組</label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1') { ?><a href="tmp_config_homeboard002.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard002" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div> 

                              <?php if ($row_RecordTmp['name'] != "board009" && $row_RecordTmp['name'] != "board010") { ?>
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><a data-original-title="此版面為一在螢幕畫面上下左右置中的區塊，您可以上傳多張的圖片並指定其轉場效果，圖片會依次做撥放，另外您可以替此區塊設置一外框、指定外框之外之背景，而此設定皆為獨立，為和內頁版型分開的設置。" data-toggle="tooltip" data-placement="right"><img src="images/homesty06.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard003"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_3" value="homeboard003" <?php if ($OptionTmpHomeSelect != '1') { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_3">圖片輪播</label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1') { ?><a href="tmp_config_homeboard003.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard003" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div> 
                              <?php } ?>
                              
                              <?php if ($row_RecordTmp['name'] != "board009" && $row_RecordTmp['name'] != "board010") { ?>
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><a data-original-title="此版面為一在螢幕畫面上下左右置中的區塊，您可以上傳多張的圖片並指定其轉場效果，圖片會依次做撥放，另外您可以替此區塊設置一外框、指定外框之外之背景，而此設定皆為獨立，為和內頁版型分開的設置。" data-toggle="tooltip" data-placement="right"><img src="images/homesty03.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard006"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_6" value="homeboard006" <?php if ($OptionTmpHomeSelect != '1') { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_6">圖片輪播</label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1') { ?><a href="tmp_config_homeboard006.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard006" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div> 
                              <?php } ?>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><a data-original-title="此版型為全螢幕圖片輪播，並可上傳多張圖片。" data-toggle="tooltip" data-placement="right"><img src="images/homesty08.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard021"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_21" value="homeboard021" <?php if ($OptionTmpHomeSelect != '1') { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_21">滿版輪播</label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1') { ?><?php if ($row_RecordTmp['name'] != "board009" && $row_RecordTmp['name'] != "board010") { ?><a href="tmp_config_homeboard021.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard021" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="tmp_config_homeboard021_rwd.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard021" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } ?><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><a data-original-title="此版面主要內容部分您可以放置各模組的功能於區塊中，並且可依據您放置的區塊大小來做排版【由左而右，由上而下，若有空缺則會自動填補】，區塊寬度分別為940px、700px、460px、220px，而高度您可採用預設值或自訂，只要配合您放置的區塊順序您就可產生【無限】的版面配置，而其區塊您可自由放置您的內容，例如圖片、文字等...，此風格【強制關閉橫幅】。" data-toggle="tooltip" data-placement="right"><img src="images/homesty05.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard004"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_4" value="homeboard004" <?php if ($OptionTmpHomeSelect != '1') { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_4">自由排版</label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1') { ?><a href="tmp_config_homeboard005.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard005" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              <?php } ?>
                              
                              <!--<div class="clearfix"></div>-->
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 25px; top: 40px;"><a data-original-title="<?php echo $ModuleName['News']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_001.png" width="30" height="30" /></a></div><div style="position: absolute; left: 80px; top: 50px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['News']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty00.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard007"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_7" value="homeboard007" <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_7"><?php echo $ModuleName['News']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1') { ?><a href="tmp_config_homeboard007.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard007" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div> 
                              
                             <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 25px; top: 40px;"><a data-original-title="<?php echo $ModuleName['Product']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_002.png" width="30" height="30" /></a></div><div style="position: absolute; left: 80px; top: 50px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['Product']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty00.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard008"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_8" value="homeboard008" <?php if ($OptionTmpHomeSelect == '1' && $OptionProductSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_8"><?php echo $ModuleName['Product']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionProductSelect == '1') { ?><a href="tmp_config_homeboard008.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard008" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 25px; top: 40px;"><a data-original-title="<?php echo $ModuleName['Project']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_032.png" width="30" height="30" /></a></div><div style="position: absolute; left: 80px; top: 50px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['Project']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty00.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard009"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_9" value="homeboard009" <?php if ($OptionTmpHomeSelect == '1' && $OptionProjectSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_9"><?php echo $ModuleName['Project']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionProjectSelect == '1') { ?><a href="tmp_config_homeboard009.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard009" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 25px; top: 40px;"><a data-original-title="<?php echo $ModuleName['Activities']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_014.png" width="30" height="30" /></a></div><div style="position: absolute; left: 80px; top: 50px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['Activities']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty00.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard010"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_10" value="homeboard010" <?php if ($OptionTmpHomeSelect == '1' && $OptionActivitiesSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_10"><?php echo $ModuleName['Activities']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionActivitiesSelect == '1') { ?><a href="tmp_config_homeboard010.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard010" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 25px; top: 40px;"><a data-original-title="<?php echo $ModuleName['Sponsor']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_011.png" width="30" height="30" /></a></div><div style="position: absolute; left: 80px; top: 50px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['Sponsor']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty00.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard011"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_11" value="homeboard011" <?php if ($OptionTmpHomeSelect == '1' && $OptionSponsorSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_11"><?php echo $ModuleName['Sponsor']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionSponsorSelect == '1') { ?><a href="tmp_config_homeboard011.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard011" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 25px; top: 40px;"><a data-original-title="<?php echo $ModuleName['Video']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_010.png" width="30" height="30" /></a></div><div style="position: absolute; left: 80px; top: 50px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['Video']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty00.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard012"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_12" value="homeboard012" <?php if ($OptionTmpHomeSelect == '1' && $OptionVideoSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_12"><?php echo $ModuleName['Video']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionVideoSelect == '1') { ?><a href="tmp_config_homeboard012.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard012" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 25px; top: 40px;"><a data-original-title="<?php echo $ModuleName['Partner']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_026.png" width="30" height="30" /></a></div><div style="position: absolute; left: 80px; top: 50px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['Partner']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty00.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard013"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_13" value="homeboard013" <?php if ($OptionTmpHomeSelect == '1' && $OptionPartnerSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_13"><?php echo $ModuleName['Partner']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1') { ?><a href="tmp_config_homeboard013.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard013" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="clearfix"></div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 30px; top: 37px;"><a data-original-title="<?php echo $ModuleName['News']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_001.png" width="20" height="20" /></a></div><div style="position: absolute; left: 30px; top: 59px;"><a data-original-title="<?php echo $ModuleName['Product']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_002.png" width="20" height="20" /></a></div><div style="position: absolute; left: 80px; top: 39px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><div style="position: absolute; left: 80px; top: 61px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['News']; ?>模組和<?php echo $ModuleName['Product']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty07.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard014"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_14" value="homeboard014" <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionProductSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_14"><?php echo $ModuleName['News']; ?>+<?php echo $ModuleName['Product']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionProductSelect == '1') { ?><a href="tmp_config_homeboard014.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard014" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 30px; top: 37px;"><a data-original-title="<?php echo $ModuleName['News']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_001.png" width="20" height="20" /></a></div><div style="position: absolute; left: 30px; top: 59px;"><a data-original-title="<?php echo $ModuleName['Project']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_032.png" width="20" height="20" /></a></div><div style="position: absolute; left: 80px; top: 39px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><div style="position: absolute; left: 80px; top: 61px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['News']; ?>模組和<?php echo $ModuleName['Project']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty07.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard015"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_15" value="homeboard015" <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionProjectSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_15"><?php echo $ModuleName['News']; ?>+<?php echo $ModuleName['Project']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionProjectSelect == '1') { ?><a href="tmp_config_homeboard015.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard015" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 30px; top: 37px;"><a data-original-title="<?php echo $ModuleName['News']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_001.png" width="20" height="20" /></a></div><div style="position: absolute; left: 30px; top: 59px;"><a data-original-title="<?php echo $ModuleName['Activities']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_014.png" width="20" height="20" /></a></div><div style="position: absolute; left: 80px; top: 39px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><div style="position: absolute; left: 80px; top: 61px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['News']; ?>模組和<?php echo $ModuleName['Activities']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty07.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard016"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_16" value="homeboard016" <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionActivitiesSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_16"><?php echo $ModuleName['News']; ?>+<?php echo $ModuleName['Activities']; ?></label> 
                                      </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionActivitiesSelect == '1') { ?><a href="tmp_config_homeboard016.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard016" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 30px; top: 37px;"><a data-original-title="<?php echo $ModuleName['News']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_001.png" width="20" height="20" /></a></div><div style="position: absolute; left: 30px; top: 59px;"><a data-original-title="<?php echo $ModuleName['Sponsor']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_011.png" width="20" height="20" /></a></div><div style="position: absolute; left: 80px; top: 39px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><div style="position: absolute; left: 80px; top: 61px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['News']; ?>模組和<?php echo $ModuleName['Sponsor']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty07.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard017"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_17" value="homeboard017" <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionSponsorSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_17"><?php echo $ModuleName['News']; ?>+<?php echo $ModuleName['Sponsor']; ?></label> 
                                    </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionSponsorSelect == '1') { ?><a href="tmp_config_homeboard017.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard017" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 30px; top: 37px;"><a data-original-title="<?php echo $ModuleName['News']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_001.png" width="20" height="20" /></a></div><div style="position: absolute; left: 30px; top: 59px;"><a data-original-title="<?php echo $ModuleName['Video']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_010.png" width="20" height="20" /></a></div><div style="position: absolute; left: 80px; top: 39px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><div style="position: absolute; left: 80px; top: 61px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['News']; ?>模組和<?php echo $ModuleName['Video']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty07.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard018"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_18" value="homeboard018" <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionVideoSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_18"><?php echo $ModuleName['News']; ?>+<?php echo $ModuleName['Video']; ?></label> 
                                    </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionVideoSelect == '1') { ?><a href="tmp_config_homeboard018.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard018" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 30px; top: 37px;"><a data-original-title="<?php echo $ModuleName['Product']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_002.png" width="20" height="20" /></a></div><div style="position: absolute; left: 30px; top: 59px;"><a data-original-title="<?php echo $ModuleName['Sponsor']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_011.png" width="20" height="20" /></a></div><div style="position: absolute; left: 80px; top: 39px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><div style="position: absolute; left: 80px; top: 61px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['Product']; ?>模組和<?php echo $ModuleName['Sponsor']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty07.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard019"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_19" value="homeboard019" <?php if ($OptionTmpHomeSelect == '1' && $OptionProductSelect == '1' && $OptionSponsorSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_19"><?php echo $ModuleName['Product']; ?>+<?php echo $ModuleName['Sponsor']; ?></label> 
                                    </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionProductSelect == '1' && $OptionSponsorSelect == '1') { ?><a href="tmp_config_homeboard019.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard019" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <?php if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") { ?><span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span><?php } else { ?><span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span><?php } ?> <div style="position:relative;" class="m-t-10"><div style="position: absolute; left: 42px; top: 19px;"><a data-original-title="橫幅圖片" data-toggle="tooltip" data-placement="right"><img src="images/mt_037.png" width="15" height="15" /></a></div><div style="position: absolute; left: 30px; top: 37px;"><a data-original-title="<?php echo $ModuleName['Project']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_032.png" width="20" height="20" /></a></div><div style="position: absolute; left: 30px; top: 59px;"><a data-original-title="<?php echo $ModuleName['Video']; ?>模組" data-toggle="tooltip" data-placement="right"><img src="images/mt_010.png" width="20" height="20" /></a></div><div style="position: absolute; left: 80px; top: 39px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><div style="position: absolute; left: 80px; top: 61px;"><a data-original-title="自訂內容" data-toggle="tooltip" data-placement="right"><img src="images/mt_054.png" width="15" height="15" /></a></div><a data-original-title="此版面左方會放置依<?php echo $ModuleName['Project']; ?>模組和<?php echo $ModuleName['Video']; ?>模組，右方可加入您要的內容，例如：圖片、Youtube影片、文字等等。版型則延續內頁版型的外觀。" data-toggle="tooltip" data-placement="right"><img src="images/homesty07.jpg" alt="" width="100" height="100" /></a></div>
                                  <div class="card-block p-0">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['homestyle'],"homeboard020"))) {echo "checked=\"checked\"";} ?> name="homestyle" type="radio" id="homestyle_20" value="homeboard020" <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionProductSelect == '1') { ?><?php } else { ?>disabled="disabled"<?php } ?>/>
                                            <label for="homestyle_20"><?php echo $ModuleName['Project']; ?>+<?php echo $ModuleName['Video']; ?></label> 
                                    </div>
                                      <div class="m-t-5">
                                      <?php if ($OptionTmpHomeSelect == '1' && $OptionNewsSelect == '1' && $OptionProductSelect == '1') { ?><a href="tmp_config_homeboard020.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=homeboard020" class="btn btn-xs btn-primary btn-block" style="text-align:center" data-original-title="您可在此修改您的版型" data-toggle="tooltip" data-placement="right"><i class="fab fa-connectdevelop"></i> 版型設定</a><?php } else { ?><a href="#" class="btn btn-xs btn-white btn-block" style="text-align:center" data-original-title="此模組未啟用" data-toggle="tooltip" data-placement="right" disabled="disabled"><i class="fa fa-lock"></i> 版型設定</a><?php } ?>
                                      </div>
                                  </div>
                              </div>
  
                 
             
          </div>
      </div>
      
       
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" <?php if ($OptionTmpHomeSelect != '1') { ?>disabled="disabled"<?php } ?>>送出目前選擇樣板</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTmp['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      
      
  <input type="hidden" name="MM_update" value="form1" />
  </form>
  
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
		<?php if ($row_RecordTmp['tmpleftfontcolor'] == "transparent") { ?>
			$("#tmpleftfontcolor").val("transparent");
		<?php } ?>
		
		$("#TransparentButtom2").click(function(){
			// 設定透明
			$("#tmpmiddlefontcolor").val("transparent")
		});
		<?php if ($row_RecordTmp['tmpmiddlefontcolor'] == "transparent") { ?>
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
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpBg);
?>