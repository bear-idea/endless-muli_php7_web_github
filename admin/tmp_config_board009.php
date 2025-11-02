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
<style type="text/css">
.tbutt{float:left; padding:5px; background-color:#666; color:#FFF; margin-right:5px; margin-left:0px; margin-top:0px; margin-bottom:10px}
.button_a{display:inline-block; border-width:1px 0; border-color:#BBB; border-style:solid; vertical-align:middle; text-decoration:none; color:#333}
.button_b{float:left; background:#e3e3e3; border-width:0 1px; border-color:#BBB; border-style:solid; margin:0 -1px; position:relative}
.button_c{display:block; line-height:0.6em; background:#f9f9f9; border-bottom:2px solid #eee}
.button_d{display:block; padding:0.1em 0.6em; margin-top:-0.6em; cursor:pointer}
.button_a:hover{border-color:#999; text-decoration:none}
.button_a:hover .button_b{border-color:#999; text-decoration:none}
#apDiv_config{position:fixed; width:230px; height:115px; z-index:1; float:right; right:0px; top:60px}
#wrapper_config div #apDiv_config div span a{color:#1C590D; font-size:9px}
#v_out_wrp_c{width:1000px; border:#CCC dashed 1px; margin-left:auto; margin-right:auto; color:#090}
#v_out_wrp{width:1000px; border:#CCC dashed 1px; margin-left:auto; margin-right:auto;}
.v_out_wrp_font{color:#CCC; font-size:30px; font-weight:bolder; padding:10px}
#v_out_wrp:hover{border:1px dashed #C30}
.v_out_wrp_bk{float:right; margin-right:5px; margin-top:5px; padding:5px; border:#CCC dashed 1px; }
#v_wrp{width:600px; margin-left:auto; margin-right:auto; margin-top:100px; border:#CCC dashed 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:20px; padding-left:20px; background-position:center center; background-repeat:no-repeat}
#v_wrp:hover{border:1px dashed #C30}
#v_wrp_header{border:#CCC dashed 1px; margin:5px; position:relative; min-height:230px}
#v_wrp_header:hover{border:#C30 dashed 1px}
#v_wrp_header_logo{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:5px; top:5px; border:#CCC dashed 1px}
#v_wrp_header_logo:hover{border:#C30 dashed 1px}
#v_wrp_header_menu{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:110px; top:5px; border:#CCC dashed 1px; width:430px; height:115px}
#v_wrp_header_menu:hover{border:#C30 dashed 1px}
#v_wrp_banner{border:#CCC dashed 1px; margin:5px; position:relative; min-height:100px}
#v_wrp_banner:hover{border:#C30 dashed 1px}
#v_wrp_l_column{border:#CCC dashed 1px; margin:5px; float:left; width:200px; position:relative; min-height:700px}
#v_wrp_l_column:hover{border:#C30 dashed 1px}
.v_wrp_l_column_board_style{border:1px #CCC dashed; position:relative; margin:5px}
#v_wrp_l_column_wrp_board_style:hover .v_wrp_l_column_board_style{border:#C30 dashed 1px}
#v_wrp_l_column_menu_style{border:1px #CCC dashed; position:relative; margin:5px; height:210px}
#v_wrp_l_column_menu_style:hover{border:#C30 dashed 1px}
#v_wrp_middle{border:#CCC dashed 1px; margin:5px; margin-left:215px; position:relative; min-height:700px}
#v_wrp_middle:hover{border:#C30 dashed 1px}
#v_wrp_middle_title_sicon{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:5px; top:5px; border:#CCC dashed 1px; width:150px; height:85px}
#v_wrp_middle_title_sicon:hover{border:#C30 dashed 1px}
#v_wrp_middle_title{border:#CCC dashed 1px; margin:5px; position:relative; min-height:160px}
#v_wrp_middle_title:hover{border:#C30 dashed 1px}
#v_wrp_middle_viewline{border:#CCC dashed 1px; margin:5px; position:relative; min-height:35px}
#v_wrp_middle_viewline:hover{border:#C30 dashed 1px}
#v_wrp_middle_content{border:#CCC dashed 1px; margin:5px; position:relative; min-height:300px}
#v_wrp_middle_content:hover{border:#C30 dashed 1px}
#v_wrp_footer{border:#CCC dashed 1px; margin:5px; clear:both; position:relative; min-height:120px}
#v_wrp_footer:hover{border:#C30 dashed 1px}
#v_wrp_md{width:600px; margin-left:auto; margin-right:auto; margin-top:10px; margin-bottom:100px; border:#CCC dashed 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:5px; padding-left:20px; background-position:center center; background-repeat:no-repeat; min-height:250px}
#v_wrp_sty{width:600px; margin-left:auto; margin-right:auto; margin-top:10px; margin-bottom:10px; border:#CCC dashed 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:5px; padding-left:20px; background-position:center center; background-repeat:no-repeat; min-height:250px}
.v_md{border:#CCC dashed 1px; height:100px; width:100px; padding:5px; text-align:center; margin-left:5px; margin-top:5px; float:left}
.v_md:hover{border:#C30 dashed 1px}
.InnerPage_design{float:right; margin-right:2px; margin-top:5px; margin-bottom:5px}
.InnerPage_design a{font-weight:400;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;border:1px solid #d83526;text-decoration:none;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fa665a',endColorstr='#d34639');background:0 color-stop(100%,#d34639) );background-color:#fa665a;color:#fff;display:inline-block;text-shadow:1px 1px 0 #98231a;-webkit-box-shadow:inset 1px 1px 0 0 #fab3ad;-moz-box-shadow:inset 1px 1px 0 0 #fab3ad;box-shadow:inset 1px 1px 0 0 #fab3ad;padding:0px 4px}
.InnerPage_design a:hover, .InnerPage_design a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d34639',endColorstr='#fa665a');background:0 color-stop(100%,#fa665a) );background-color:#d34639}
.InnerPage_design a:active{ position:relative;top:1px}
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 樣板 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="../tmp_demo_<?php echo $row_RecordTmp['name']; ?>.php?tmpid=<?php echo $_GET['id_edit'] ?>" target="_blank" class="btn btn-default btn-sm" id="Step_View" data-original-title="修改版型時您可透過預覽功能來檢視目前版型修改外觀" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> 預覽</a><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <?php if($row_RecordTmp['userid'] == $w_userid) { ?> 
  <div class="table-responsive">
<div style="padding:10px; margin:10px; position:relative; min-width:1000px;" id="wrapper_config">
  <div>
    
	<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_Tmp" id="form_Tmp">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
    <tr>
      <td>
     
       <div id="v_out_wrp">
       	<span class="v_out_wrp_font">外框架<!--<span class = "InnerPage_design" style="float:none;" id="Step_Change" ><a href="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?id_edit=<?php echo $_GET['id_edit'] ?>&amp;tmpid=<?php echo $_GET['id_edit'] ?>" data-original-title="建議螢幕解析度調整為1920*1080為最佳" style="font-size:24px;" data-toggle="tooltip" data-placement="top" ><strong> <i class="fa fa-chevron-circle-right"></i> 切換至所見即得設計模式</strong></a></span>--></span>
        <!--獨立背景-->
        <span class="v_out_wrp_bk">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpbottombackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmpbottombackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=裝飾拼貼圖片" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">上層裝飾</a>
        </span>
        
        <!--獨立背景-->
        <span class="v_out_wrp_bk">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpanimebackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmpanimebackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=裝飾拼貼圖片" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">中層裝飾</a>
        </span>
        <!--獨立背景-->
        <span class="v_out_wrp_bk" id="Step_WrpBg">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpbodybackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmpbodybackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=拼貼材質" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">底層背景</a>
        </span>
       	<div id="v_wrp">
        <span style="position: absolute; top: -80px; left: -160px; border: #CCC dashed 1px; padding: 5px;"><img src="images/sty09.jpg" width="100" height="100" /><br />
        <a href="tmp_config_md_style.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您要更換的版面結構" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">版面結構選擇</a>
        </span>
        <span style="position: absolute; top: 57px; right: -83px;">
        	<img src="images/z_line_c.png" width="82" height="1" /> 
        </span>
        <!--獨立外框--><!--獨立背景-->
        <span style="margin-right: 5px; margin-top: 150px; padding: 5px; border: #CCC dashed 1px; position: absolute; top: -110px; right: -152px;">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpwrpbackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmpwrpbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=拼貼材質" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">背景選擇</a>
        </span>
            	<div style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; left: -36px; top: -41px;" id="Step_Wrp">主框架<span style="font-size:16px;"> <a href="tmp_config_wrp_rwd.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定整體網站的文字顏色、超連結顏色、文字大小" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs" >更多設定 <i class="fa fa-chevron-circle-right"></i></a></span></div>
        	<div id="v_wrp_header">
            <!--獨立背景-->
        <span style="margin-left: 5px; margin-top: 80px; padding: 5px; border: #CCC dashed 1px;  position: absolute; bottom: 5px;">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpheaderbackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmpheaderbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=拼貼材質" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">背景選擇</a>
        </span>
            	<div id="v_wrp_header_logo"><span style="font-size:16px;"> <a href="tmp_config_wrp_header_logo.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定Logo的位置" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span><br />
            	 Logo</div>
                <div id="v_wrp_header_menu"><!--獨立選單-->
                <span style="margin-left: 5px; margin-top: 0px; padding: 5px; border: #CCC dashed 1px; position: absolute; top: 5px; right:5px; font-size:14px;" id="Step_MainMenu">
                <iframe src="tmp_config_mainmenu_view.php?id=<?php echo $row_RecordTmp['tmpmainmenu']  ?>" width="202" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
                <a href="tmpmainmenu_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您要更換的選單" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">選單選擇</a>
                </span>選單<span style="font-size:16px;" id="Step_MainMenuOther"> <a href="tmp_config_wrp_header_menu.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定選單的位置、選單的類型" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span></div>
                <span style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; right: 5px; bottom: 5px; text-align:right;"><span style="font-size:16px;"> <a href="tmp_config_wrp_header.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定主選單是否顯示、此區塊高度" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span><br />
                頁首區塊</span>
            </div>
            <div id="v_wrp_banner">
            <!--獨立外框--><!--獨立外框-->
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px; text-align:right;" id="Step_Banner"><span style="font-size:16px;"> <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定橫幅的類型" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span><br />
            	橫幅區塊</span>
            </div>
            <div style="position:relative; float:right; width:100%; margin-left:-215px; margin-right:0px;">
            <div id="v_wrp_l_column">
            <div id="v_wrp_l_column_wrp_board_style">
            <div id="v_wrp_l_column_menu_style">
            <!--獨立選單-->
                <span style="margin-left: 5px; margin-top: 5px; padding: 5px; border: #CCC dashed 1px;  position: absolute; top: 5px; right:5px;" id="Step_Style">
                <iframe src="tmp_config_leftmenu_view.php?id=<?php echo $row_RecordTmp['tmpleftmenu']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
                <a href="tmpleftmenu_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您要更換的選單樣式" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">樣式選擇</a>
                </span>
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:5px; position: absolute; right: 0px; bottom: 0px;">選單樣式</span>
            </div>
            <div class="v_wrp_l_column_board_style" style="height:60px;">
            <span style="color: #CCC; font-size:24px; font-weight:bolder; padding:5px; position: absolute; right: 0px; bottom: 0px;">側邊裝飾外框</span>
            </div>
            <div class="v_wrp_l_column_board_style" style="height:200px;">
            <!--獨立風格-->
                <span style="margin-left: 5px; margin-top: 5px; padding: 5px; border: #CCC dashed 1px;  position: absolute; top: 5px; right:5px;" id="Step_Board">
                <iframe src="tmp_config_block_view.php?id=<?php echo $row_RecordTmp['tmpblock']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
                <a href="tmpblock_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您要更換的側邊裝飾外框" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">風格選擇</a>
                </span>
            <span style="color: #CCC; font-size:24px; font-weight:bolder; padding:5px; position: absolute; right: 0px; bottom: 0px;">側邊裝飾外框</span>
            </div>
            </div>
            <!--獨立背景-->
        <span style="margin-left: 5px; margin-top: 80px; padding: 5px; border: #CCC dashed 1px;  position: absolute; bottom: 5px;">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpleftbackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmpleftbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=拼貼材質" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">背景選擇</a>
        </span>
            	<span style="color: #CCC; font-size:26px; font-weight:bolder; padding:10px; position: absolute; right: 0px; bottom: 5px; text-align:right"><span style="font-size:16px;"> <a href="tmp_config_wrp_l_column.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定區塊是否顯示標題、最小高度(區塊高度直必須大於選擇之背景高度，圖片才會完整顯示)" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span><br />
            	欄位區塊</span>
            </div>
            <div id="v_wrp_middle">
            <div id="v_wrp_middle_viewline">
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:2px; position: absolute; right: 5px; top: -8px;">導欄列</span>
            <span style="position: absolute; top: 10px; right: -72px;">
        	<img src="images/z_line_c.png" width="82" height="1" /> 
        </span>
        <span style="margin-left: 5px; margin-top: 5px; padding: 5px; border: #CCC dashed 1px; position: absolute; top: -50px; right: -185px;" id="Step_ViewLine">
                <iframe src="tmp_config_board_view.php?id=<?php echo $row_RecordTmp['tmpviewlineboard']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
                <a href="tmpviewlineboard_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您要更換的外框" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">外框選擇</a>
                </span>
            </div>
            <div id="v_wrp_middle_title">
            	<div id="v_wrp_middle_title_sicon"><span style="color: #CCC; font-size:20px; font-weight:bolder; padding:2px; position: absolute; right: 5px; top: 5px;">
            	  小圖示</span></div>
                <!--獨立背景-->
                <span style="margin-right: 5px; margin-top: 150px; padding: 5px; border: #CCC dashed 1px; position: absolute; top: 57px; right: -189px;">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmptitlelinebackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmptitlelinebackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=拼貼材質" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">背景選擇</a>
        </span>
                <span style="margin-left: 5px; margin-top: 5px; padding: 5px; border: #CCC dashed 1px; height: 75px; position: absolute; top: 5px; left:5px;" id="Step_Icon">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmptitlebackground']  ?>" width="64" marginwidth="0" height="32" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmptitlebackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=標題圖示" data-original-title="選擇您要更換的圖示" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">圖示選擇</a>
        </span>
            	<!--獨立外框-->
                <span style="position: absolute; top: 115px; right: -120px;">
        	<img src="images/z_line_f.png" width="130" height="123" /> 
        </span>
                <span style="margin-left: 5px; margin-top: 5px; padding: 5px; border: #CCC dashed 1px; position: absolute; top: 53px; right: -185px;" id="Step_Title">
                <iframe src="tmp_config_board_view.php?id=<?php echo $row_RecordTmp['tmptitleboard']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
                <a href="tmptitleboard_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您要更換的外框，此外框可和內文區塊外框作合併，但合併時建議外框選擇同樣式" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">外框選擇</a>
                </span>
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; left: 5px; bottom: 5px;">標題區塊<span style="font-size:16px;"> <a href="tmp_config_wrp_middle_title.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定文字顏色、文字位置、區塊高度" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span></span>
            </div>
            <div id="v_wrp_middle_content">
            	<!--獨立外框-->
                <span style="margin-left: 5px; margin-top: 5px; padding: 5px; border: #CCC dashed 1px; position: absolute; top: 5px; right:5px;" id="Step_Content">
                <iframe src="tmp_config_board_view.php?id=<?php echo $row_RecordTmp['tmpmiddleboard']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
                <a href="tmpmiddleboard_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您要更換的外框，此外框可和標題區塊外框作合併，但合併時建議外框選擇同樣式" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">外框選擇</a>
                </span>
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px;"><br />
            	內文區塊</span>
            </div>
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px; text-align:right;" id="Step_ContentOther"><span style="font-size:16px;"> <a href="tmp_config_wrp_m_column_mobile.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定此區塊內之兩區塊是否合併、區塊最小高度" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span><br />
            	中央區塊</span>
                <!--獨立背景-->
        <span style="margin-left: 5px; margin-top: 80px; padding: 5px; border: #CCC dashed 1px;  position: absolute; bottom: 5px;">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpmiddlebackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmpmiddlebackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=拼貼材質" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">背景選擇</a>
        </span>
            </div>
            </div>
            <div id="v_wrp_footer">
            <!--獨立背景-->
        <span style="margin-left: 5px; margin-top: 80px; padding: 5px; border: #CCC dashed 1px;  position: absolute; bottom: 5px;">
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpfooterbackground']  ?>" width="64" marginwidth="0" height="64" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmpfooterbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>&amp;type=拼貼材質" data-original-title="選擇您要更換的背景" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">背景選擇</a>
        </span>
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px;position: absolute; right: 5px; bottom: 5px; text-align:right;"><span style="font-size:16px;"> <a href="tmp_config_wrp_footer.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="您可在此設定文字顏色、最小高度" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span><br />
            	頁尾區塊</span>
            </div>
        </div>
       	<div id="v_wrp_md">
       	  <div class="v_out_wrp_font">功能模組設定</div>
        	<div class="v_md"><img src="images/mt_076.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_fbfan.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs">FB粉絲頁</a>
            </div>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionPublishSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_003.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_publish.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Publish']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionNewsSelect == '1') { ?>
            <div class="v_md" style="display:none"><img src="images/mt_001.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_news.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['News']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionProductSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_002.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_product.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Product']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionProjectSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_032.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_project.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Project']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionActitiviesSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_014.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_activities.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Activities']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionOrgSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_026.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_org.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Org']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionArtlistSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_027.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_artlist.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Artlist']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionPartnerSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_011.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_partner.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Partner']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionFrilinkSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_006.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_frilink.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Frilink']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAlbumSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_012.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_album.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Album']; ?></a>
            </div>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_082.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_cart.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Cart']; ?></a>
            </div>
			<?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionFaqSelect == '1') { ?>
            <div class="v_md"><img src="images/mt_024.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_faq.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs"><?php echo $ModuleName['Faq']; ?></a>
            </div>
			<?php } ?>
            <div class="v_md"><img src="images/mt_071.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_mobile.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs">行動裝置</a>
            </div>
            <div class="v_md"><img src="images/mt_052.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_footer.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs">頁尾設定</a>
            </div>
            <div class="v_md"><img src="images/mt_107.png" width="64" height="64" /><br />
          		<a href="tmp_config_md_toolbar.php?id_edit=<?php echo $row_RecordTmp['id']; ?>" class="btn btn-success btn-xs">元件設定</a>
            </div>
            <div style="clear:both;"></div>
      </div>
       </div>
       <div id="v_out_wrp_c" style=" margin-top:10px; padding:10px;">
       <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>外框架中有三層背景可供設置，由上而下依次為上層、中層、底層背景，最上層的層級會覆蓋底下的層級。例如：您可將底層背景指定為藍色，中層背景放置一張風景的圖片，抑或是運用透明圖層堆疊的方式配合使用。</b></div>
       
       <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>在欄位區塊中，有許多的小區塊稱為側邊裝飾外框，您可以在 <span style="color:#F60;">版型修改-&gt;自訂欄位</span> 中指定您要放置的項目。</b></div>
       
       <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>在標題區塊的小圖示您可在背景的選擇畫面中，搜尋類別中的小圖示來做選擇。</b></div>
       
       <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>側邊裝飾外框中有選單樣式可做設定，此功能僅針對特定功能模組做顯示。</b></div>
        
      </div>
      </td>
      </tr>
    <tr>
      <td></td>
      </tr>
   
    
  </table>
  <input type="hidden" name="MM_update" value="form_Tmp" />
	</form>
  </div>
  
</div>
</div>
<?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_View',
                intro: '預覽目前的版型。'
              },
              {
                element: '#Step_Change',
                intro: '切換至另一設計模式，採邊預覽邊設計方式。'
              },
              {
                element: '#v_wrp_md',
                intro: '設定各模組的細部外觀。',
                position: 'bottom'
              },
              {
                element: '#Step_Tip',
                intro: '以下簡單的介紹如何替換網站的外觀。',
                position: 'bottom'
              },
              {
                element: '#Step_Wrp',
                intro: '此處可調整您網站整體文字的大小、超連結顏色等。',
                position: 'bottom'
              },
              {
                element: '#v_wrp_header_logo',
                intro: '設定您的Logo及調整Logo的位置，建議您設定位置時可以切換至所見即得設計模式來調整。',
                position: 'bottom'
              },
              {
                element: '#Step_MainMenu',
                intro: '設定您的主選單。',
                position: 'bottom'
              },
              {
                element: '#Step_MainMenuOther',
                intro: '調整主選單的位置，建議您設定位置時可以切換至所見即得設計模式來調整。',
                position: 'bottom'
              },
              {
                element: '#Step_Banner',
                intro: '設定您的橫幅，一般選擇【使用公版橫幅】即可。',
                position: 'bottom'
              },
              {
                element: '#Step_Style',
                intro: '<img src="images/tip/tip116.jpg" width="225" height="153" /><br /><br />選擇側邊選單的樣式。',
                position: 'bottom'
              },
              {
                element: '#Step_Board',
                intro: '<img src="images/tip/tip117.jpg" width="230" height="341" /><br /><br />選擇側邊各區塊的外框樣式。',
                position: 'bottom'
              },
              {
                element: '#Step_Icon',
                intro: '<img src="images/tip/tip118.jpg" width="269" height="119" /><br /><br />選擇小圖示。',
                position: 'bottom'
              },
              {
                element: '#Step_ViewLine',
                intro: '<img src="images/tip/tip119.jpg" width="404" height="88" /><br /><br />選擇導覽外框樣式。',
                position: 'bottom'
              },
              {
                element: '#Step_Title',
                intro: '設定標題部分的外框，建議樣式和內容部分外框一致。',
                position: 'bottom'
              },
              {
                element: '#Step_Content',
                intro: '設定內容部分的外框外框，建議樣式和標題部分外框一致。',
                position: 'bottom'
              },
              {
                element: '#Step_ContentOther',
                intro: '<img src="images/tip/tip001.jpg" width="500" height="533" /><br /><br />此處可設定標題部分和內容部份的外框是分開或合併。',
                position: 'bottom'
              },
              {
                element: '#Step_WrpBoard',
                intro: '設定網站主區塊外框。',
                position: 'bottom'
              },
              {
                element: '#Step_WrpBg',
                intro: '<img src="images/tip/tip120.jpg" width="429" height="393" /><br /><br />設定網站背景。',
                position: 'bottom'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>
      
      
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

<?php if(isset($_GET['GP_upload']) && $_GET['GP_upload'] == true) { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
</body>
</html>
<?php
mysqli_free_result($RecordTmp);
?>