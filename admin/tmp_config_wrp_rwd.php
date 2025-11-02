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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Tmp")) {
 $updateSQL = sprintf("UPDATE demo_tmp SET tmpwordcolor=%s, tmpwordsize=%s, tmplink=%s, tmplinkvisit=%s, tmplinkhover=%s, tmpleftfontcolor=%s, tmpmiddlefontcolor=%s, tmpwrpboardindicate=%s, tmpviewlinelocate=%s, tmpcolumnmenumode=%s, tmptoplinebgcolor=%s, tmptoplinefontcolor=%s, tmptoplinetransparent=%s, tmptoplineindicate=%s, tmptoplinelangshow=%s, tmptoplinelangicon=%s, tmpbasiccolor=%s, boxed=%s, boxwidth=%s, tmplogolocation=%s, tmpmenulocation=%s, tmpmenueffect=%s, tmplogomargintop=%s WHERE id=%s",
                       GetSQLValueString($_POST['tmpwordcolor'], "text"),
                       GetSQLValueString($_POST['tmpwordsize'], "text"),
                       GetSQLValueString($_POST['tmplink'], "text"),
                       GetSQLValueString($_POST['tmplinkvisit'], "text"),
                       GetSQLValueString($_POST['tmplinkhover'], "text"),
                       GetSQLValueString($_POST['tmpleftfontcolor'], "text"),
                       GetSQLValueString($_POST['tmpmiddlefontcolor'], "text"),
                       GetSQLValueString($_POST['tmpwrpboardindicate'], "int"),
					   GetSQLValueString($_POST['tmpviewlinelocate'], "int"),
					   GetSQLValueString($_POST['tmpcolumnmenumode'], "int"),
					   GetSQLValueString($_POST['tmptoplinebgcolor'], "text"),
					   GetSQLValueString($_POST['tmptoplinefontcolor'], "text"),
					   GetSQLValueString($_POST['tmptoplinetransparent'], "text"),
					   GetSQLValueString($_POST['tmptoplineindicate'], "int"),
					   GetSQLValueString($_POST['tmptoplinelangshow'], "int"),
					   GetSQLValueString($_POST['tmptoplinelangicon'], "int"),
					   GetSQLValueString($_POST['tmpbasiccolor'], "text"),
					   GetSQLValueString($_POST['boxed'], "int"),
					   GetSQLValueString($_POST['boxwidth'], "int"),
					   GetSQLValueString($_POST['tmplogolocation'], "int"),
					   GetSQLValueString($_POST['tmpmenulocation'], "int"),
					   GetSQLValueString($_POST['tmpmenueffect'], "int"),
					   GetSQLValueString($_POST['tmplogomargintop'], "int"),
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 樣板 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="tmp_config_<?php echo $row_RecordTmp['name']; // 為版型風格?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" id="form_Tmp" name="form_Tmp">
       <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 主框架</span></div>
      </div>
       <div class="form-group row">
          <label class="col-md-2 col-form-label ">基礎色系<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="tmpbasiccolor" id="tmpbasiccolor" class="form-control">
          <option value="color" <?php if (!(strcmp("color", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?>>Default</option>
          <option value="blue" <?php if (!(strcmp("blue", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#3072e0;">Blue</option>
          <option value="brown" <?php if (!(strcmp("brown", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#AB8B64;">Brown</option>
          <option value="darkblue" <?php if (!(strcmp("darkblue", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#1980B6;">Brown</option>
          <option value="darkgreen" <?php if (!(strcmp("darkgreen", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#9DB667;">Darkblue</option>
          <option value="green" <?php if (!(strcmp("green", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#8ab933;">Green</option>
          <option value="lightgrey" <?php if (!(strcmp("lightgrey", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#9E9E9E;">Lightgrey</option>
          <option value="orange" <?php if (!(strcmp("orange", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#F07057;">Orange</option>
          <option value="pink" <?php if (!(strcmp("pink", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#F73F69;">Pink</option>
          <option value="red" <?php if (!(strcmp("red", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#A94545;">Red</option>
          <option value="yellow" <?php if (!(strcmp("yellow", $row_RecordTmp['tmpbasiccolor']))) {echo "selected=\"selected\"";} ?> style="background-color:#FAB702;">Yellow</option>
        </select>  
                 
          </div>
      </div>
  	  <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmpwordcolor" type="text" required class="form-control colorpicker-element" id="tmpwordcolor" value="<?php echo $row_RecordTmp['tmpwordcolor']; ?>" maxlength="20" data-parsley-errors-container="#error_tmpwordcolor" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmpwordcolor"></div>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字大小<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <select name="tmpwordsize" id="tmpwordsize" class="form-control">
          <option value="0.563em" <?php if (!(strcmp("0.563em", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>9px</option>
          <option value="0.625em" <?php if (!(strcmp("0.625em", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>10px</option>
          <option value="0.688em" <?php if (!(strcmp("0.688em", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>11px</option>
          <option value="0.75em" <?php if (!(strcmp("0.75em", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>12px</option>
          <option value="0.875em" <?php if (!(strcmp("0.875em", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>14px</option>
          <option value="1em" <?php if (!(strcmp("1em", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>16px</option>
          <option value="xx-small" <?php if (!(strcmp("xx-small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>xx-small</option>
          <option value="x-small" <?php if (!(strcmp("x-small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>x-small</option>
          <option value="small" <?php if (!(strcmp("small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>small</option>
          <option value="medium" <?php if (!(strcmp("medium", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>medium</option>
          <option value="large" <?php if (!(strcmp("large", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>large</option>
        </select>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連結<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmplink" type="text" required class="form-control colorpicker-element" id="tmplink" value="<?php echo $row_RecordTmp['tmplink']; ?>" maxlength="20" data-parsley-errors-container="#error_tmplink" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmplink"></div>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連結[已點選]<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmplinkvisit" type="text" required class="form-control colorpicker-element" id="tmplinkvisit" value="<?php echo $row_RecordTmp['tmplinkvisit']; ?>" maxlength="20" data-parsley-errors-container="#error_tmplinkvisit" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmplinkvisit"></div>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連結[滑鼠移入]<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmplinkhover" type="text" required class="form-control colorpicker-element" id="tmplinkhover" value="<?php echo $row_RecordTmp['tmplinkhover']; ?>" maxlength="20" data-parsley-errors-container="#error_tmplinkhover" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmplinkhover"></div>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上下外框隱藏<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="此選項可設定樣板的外框中的上下區塊是否顯示。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpwrpboardindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpwrpboardindicate" id="tmpwrpboardindicate_2" value="0" />
                <label for="tmpwrpboardindicate_2">維持原設定</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpwrpboardindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpwrpboardindicate" id="tmpwrpboardindicate_1" value="1" />
                <label for="tmpwrpboardindicate_1">強制隱藏上下外框</label>
            </div>
            
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">導覽列<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpviewlinelocate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpviewlinelocate" id="tmpviewlinelocate_0" value="0" />
                <label for="tmpviewlinelocate_0">隱藏</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpviewlinelocate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpviewlinelocate" id="tmpviewlinelocate_1" value="1" />
                <label for="tmpviewlinelocate_1">預設位置</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpviewlinelocate'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpviewlinelocate" id="tmpviewlinelocate_2" value="2" />
                <label for="tmpviewlinelocate_2">橫幅下方</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">整體版面<span class="text-red">*</span></label>
          
          <div class="col-md-10">
               <div class="card pull-left m-5">
                    <img src="images/boxed01.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                              <input <?php if (!(strcmp($row_RecordTmp['boxed'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxed" id="boxed_1" value="1" />
                              <label for="boxed_1">固定</label>
                      </div>
                    </div>
                </div> 
          
           
               <div class="card pull-left m-5">
                    <img src="images/boxed02.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                              <input <?php if (!(strcmp($row_RecordTmp['boxed'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxed" id="boxed_2" value="0" />
                <label for="boxed_2">滿版</label>
                        </div>
                    </div>
                </div> 
                
                <div class="card pull-left m-5">
                    <img src="images/boxed03.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                              <input <?php if (!(strcmp($row_RecordTmp['boxed'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxed" id="boxed_3" value="2" />
                <label for="boxed_3">僅橫幅滿版</label>
                        </div>
                    </div>
                </div> 
                
                <div class="card pull-left m-5">
                    <img src="images/boxed04.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordTmp['boxed'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxed" id="boxed_4" value="3" />
                <label for="boxed_4">僅內文固定</label>
                        </div>
                    </div>
                </div> 
          </div>
          
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">版面內容寬度<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['boxwidth'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxwidth" id="boxwidth_0" value="0" />
                <label for="boxwidth_0">1170px</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['boxwidth'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxwidth" id="boxwidth_1" value="1" />
                <label for="boxwidth_1">1380px</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['boxwidth'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxwidth" id="boxwidth_2" value="2" />
                <label for="boxwidth_2">1590px</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['boxwidth'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxwidth" id="boxwidth_3" value="3" />
                <label for="boxwidth_3">1800px</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">LOGO位置<span class="text-red">*</span></label>                       	
          <div class="col-md-4">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmplogolocation'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmplogolocation" id="tmplogolocation_0" value="0" />
                <label for="tmplogolocation_0">預設</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmplogolocation'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmplogolocation" id="tmplogolocation_1" value="1" />
                <label for="tmplogolocation_1">置中(Relative)</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmplogolocation'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmplogolocation" id="tmplogolocation_2" value="2" />
                <label for="tmplogolocation_2">置中(Absolute)</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmplogolocation'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmplogolocation" id="tmplogolocation_3" value="3" />
                <label for="tmplogolocation_3">隱藏</label>
            </div>
             
          </div>
          <div class="col-md-6">
          <div class="input-group p-0">
            
                      <div class="input-group-prepend"><span class="input-group-text">置中距離上方 <i class="fa fa-info-circle text-black" data-original-title="調整設定置中時的位置" data-toggle="tooltip" data-placement="top"></i></span></div>
                          <input name="tmplogomargintop" id="tmplogomargintop" value="<?php echo $row_RecordTmp['tmplogomargintop']; ?>" size="4" class="form-control" maxlength="4" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                              <div class="input-group-append"><span class="input-group-text">px</span></div>                
                    </div>
              </div>
           </div>
           
      <div class="form-group row">
          <label class="col-md-2 col-form-label">選單文字位置<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpmenulocation'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenulocation" id="tmpmenulocation_0" value="0" />
                <label for="tmpmenulocation_0">預設</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpmenulocation'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenulocation" id="tmpmenulocation_1" value="1" />
                <label for="tmpmenulocation_1">置中</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">選單效果<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpmenueffect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenueffect" id="tmpmenueffect_0" value="0" />
                <label for="tmpmenueffect_0">無</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpmenueffect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenueffect" id="tmpmenueffect_1" value="1" />
                <label for="tmpmenueffect_1">滑動置頂</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpmenueffect'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenueffect" id="tmpmenueffect_2" value="2" />
                <label for="tmpmenueffect_2">滑動置頂(初始置底)</label>
            </div>
			<div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpmenueffect'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenueffect" id="tmpmenueffect_3" value="3" />
                <label for="tmpmenueffect_3">無表頭</label>
            </div>
			<div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmpmenueffect'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenueffect" id="tmpmenueffect_4" value="4" />
                <label for="tmpmenueffect_4">半透明表頭</label>
            </div>
             
          </div>
      </div>

      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> Top Line</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">語系顯示風格<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmptoplinelangshow'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmptoplinelangshow" id="tmptoplinelangshow_1" value="1" />
                <label for="tmptoplinelangshow_1">不顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmptoplinelangshow'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmptoplinelangshow" id="tmptoplinelangshow_2" value="0" />
                <label for="tmptoplinelangshow_2">下拉顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmptoplinelangshow'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmptoplinelangshow" id="tmptoplinelangshow_3" value="2" />
                <label for="tmptoplinelangshow_3">橫向排列</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">語系國旗顯示<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmptoplinelangicon'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmptoplinelangicon" id="tmptoplinelangicon_1" value="1" />
                <label for="tmptoplinelangicon_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmptoplinelangicon'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmptoplinelangicon" id="tmptoplinelangicon_2" value="0" />
                <label for="tmptoplinelangicon_2">不顯示</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景顏色<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmptoplinebgcolor" type="text" required class="form-control colorpicker-element" id="tmptoplinebgcolor" value="<?php echo $row_RecordTmp['tmptoplinebgcolor']; ?>" maxlength="20" data-parsley-errors-container="#error_tmptoplinebgcolor" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmptoplinebgcolor"></div>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmptoplinefontcolor" type="text" required class="form-control colorpicker-element" id="tmptoplinefontcolor" value="<?php echo $row_RecordTmp['tmptoplinefontcolor']; ?>" maxlength="20" data-parsley-errors-container="#error_tmptoplinefontcolor" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmptoplinefontcolor"></div>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連結<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<select name="tmptoplinetransparent" id="tmptoplinetransparent" class="form-control">
          <option value="0" <?php if (!(strcmp("0", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>0% (完全透明)</option>
          <option value="0.1" <?php if (!(strcmp("0.1", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>10%</option>
          <option value="0.2" <?php if (!(strcmp("0.2", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>20%</option>
          <option value="0.3" <?php if (!(strcmp("0.3", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>30%</option>
          <option value="0.4" <?php if (!(strcmp("0.4", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>40%</option>
          <option value="0.5" <?php if (!(strcmp("0.5", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>50%</option>
          <option value="0.6" <?php if (!(strcmp("0.6", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>60%</option>
          <option value="0.7" <?php if (!(strcmp("0.7", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>70%</option>
          <option value="0.8" <?php if (!(strcmp("0.8", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>80%</option>
          <option value="0.9" <?php if (!(strcmp("0.9", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>90%</option>
          <option value="1" <?php if (!(strcmp("1", $row_RecordTmp['tmptoplinetransparent']))) {echo "selected=\"selected\"";} ?>>100% (不透明)</option>
        </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">顯示<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmptoplineindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmptoplineindicate" id="tmptoplineindicate_1" value="1" />
                <label for="tmptoplineindicate_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmptoplineindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmptoplineindicate" id="tmptoplineindicate_2" value="0" />
                <label for="tmptoplineindicate_2">不顯示</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 側邊選單</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">顯示<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
       
                    
                        
                             <div class="card pull-left m-5">
                                  <img src="images/columemenu-mod-1.jpg" alt="" />
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['tmpcolumnmenumode'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpcolumnmenumode" value="0" id="tmpcolumnmenumode_0"  />
                                            <label for="tmpcolumnmenumode_0">垂直開合</label>
                                      </div>
                                  </div>
                              </div> 
                        
                         
                             <div class="card pull-left m-5">
                                  <img src="images/columemenu-mod-2.jpg" alt="" />
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['tmpcolumnmenumode'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpcolumnmenumode" value="1" id="tmpcolumnmenumode_1"  />
                                            <label for="tmpcolumnmenumode_1">滑動顯示</label>
                                      </div>
                                  </div>
                              </div> 
                       
                     
             
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 欄位區塊</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-9">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmpleftfontcolor" type="text" required class="form-control colorpicker-element" id="tmpleftfontcolor" value="<?php echo $row_RecordTmp['tmpleftfontcolor']; ?>" maxlength="20" data-parsley-errors-container="#error_tmpleftfontcolor" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmpleftfontcolor"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom1" name="TransparentButtom1"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 中央區塊</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-9">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmpmiddlefontcolor" type="text" required class="form-control colorpicker-element" id="tmpmiddlefontcolor" value="<?php echo $row_RecordTmp['tmpmiddlefontcolor']; ?>" maxlength="20" data-parsley-errors-container="#error_tmpmiddlefontcolor" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmpmiddlefontcolor"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom2" name="TransparentButtom2"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTmp['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      
      
  <input type="hidden" name="MM_update" value="form_Tmp" />
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
?>