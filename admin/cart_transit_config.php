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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE demo_cartitem SET itemname=%s, `mode`=%s, modeselect=%s, countryprice=%s, northprice=%s, centralprice=%s, southprice=%s, eastprice=%s, outerprice=%s, addrindicate=%s, productcome=%s, productcomeprice=%s, productcomeselect=%s, fixedprice=%s, dynamicprice1=%s, dynamicprice2=%s, dynamicprice3=%s, dynamicprice4=%s, dynamicprice5=%s, dynamicprice6=%s, dynamicpricepay1=%s, dynamicpricepay2=%s, dynamicpricepay3=%s, dynamicpricepay4=%s, dynamicpricepay5=%s, dynamicpricepay6=%s, dynamicpriceunit1=%s, dynamicpriceunit2=%s, dynamicpriceunit3=%s, dynamicpriceunit4=%s, dynamicpriceunit5=%s, dynamicpriceunit6=%s, content=%s, userid=%s WHERE item_id=%s",
                       GetSQLValueString($_POST['itemname'], "text"),
                       GetSQLValueString($_POST['mode'], "int"),
                       GetSQLValueString($_POST['modeselect'], "int"),
                       GetSQLValueString($_POST['countryprice'], "int"),
                       GetSQLValueString($_POST['northprice'], "int"),
                       GetSQLValueString($_POST['centralprice'], "int"),
                       GetSQLValueString($_POST['southprice'], "int"),
                       GetSQLValueString($_POST['eastprice'], "int"),
                       GetSQLValueString($_POST['outerprice'], "int"),
                       GetSQLValueString($_POST['addrindicate'], "int"),
                       GetSQLValueString($_POST['productcome'], "int"),
                       GetSQLValueString($_POST['productcomeprice'], "int"),
                       GetSQLValueString($_POST['productcomeselect'], "int"),
                       GetSQLValueString($_POST['fixedprice'], "int"),
                       GetSQLValueString($_POST['dynamicprice1'], "int"),
                       GetSQLValueString($_POST['dynamicprice2'], "int"),
                       GetSQLValueString($_POST['dynamicprice3'], "int"),
                       GetSQLValueString($_POST['dynamicprice4'], "int"),
                       GetSQLValueString($_POST['dynamicprice5'], "int"),
                       GetSQLValueString($_POST['dynamicprice6'], "int"),
                       GetSQLValueString($_POST['dynamicpricepay1'], "int"),
                       GetSQLValueString($_POST['dynamicpricepay2'], "int"),
                       GetSQLValueString($_POST['dynamicpricepay3'], "int"),
                       GetSQLValueString($_POST['dynamicpricepay4'], "int"),
                       GetSQLValueString($_POST['dynamicpricepay5'], "int"),
                       GetSQLValueString($_POST['dynamicpricepay6'], "int"),
                       GetSQLValueString($_POST['dynamicpriceunit1'], "int"),
                       GetSQLValueString($_POST['dynamicpriceunit2'], "int"),
                       GetSQLValueString($_POST['dynamicpriceunit3'], "int"),
                       GetSQLValueString($_POST['dynamicpriceunit4'], "int"),
                       GetSQLValueString($_POST['dynamicpriceunit5'], "int"),
                       GetSQLValueString($_POST['dynamicpriceunit6'], "int"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['item_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}


$colitemid_RecordCartListItem = "-1";
if (isset($_GET['item_id'])) {
  $colitemid_RecordCartListItem = $_GET['item_id'];
}
$coluserid_RecordCartListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartListItem = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListItem = sprintf("SELECT * FROM demo_cartitem WHERE item_id = %s && userid=%s", GetSQLValueString($colitemid_RecordCartListItem, "int"),GetSQLValueString($coluserid_RecordCartListItem, "int"));
$RecordCartListItem = mysqli_query($DB_Conn, $query_RecordCartListItem) or die(mysqli_error($DB_Conn));
$row_RecordCartListItem = mysqli_fetch_assoc($RecordCartListItem);
$totalRows_RecordCartListItem = mysqli_num_rows($RecordCartListItem);
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

<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', height : '150px', toolbar : 'Basic'} );
};
</script>

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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 自訂貨運 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" id="form" name="form">
       <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="itemname" type="text" required class="form-control" id="itemname" value="<?php echo $row_RecordCartListItem['itemname']; ?>" data-parsley-trigger="blur"/>
                      <small class="f-s-12 text-grey-darker">例如郵局送貨、快遞送貨、黑貓宅急便、低溫宅配、到店取貨、由本店決定、貨到付款、面交。</small>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">是否需運費<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input name="mode" type="radio" id="mode_1" value="0" <?php if (!(strcmp($row_RecordCartListItem['mode'],"0"))) {echo "checked=\"checked\"";} ?> />
              <label for="mode_1">運費0元</label>
            </div>
            <div class="radio radio-css ">
              <input type="radio" name="mode" id="mode_2" value="1" <?php if (!(strcmp($row_RecordCartListItem['mode'],"1"))) {echo "checked=\"checked\"";} ?> />
              <label for="mode_2">需運費</label>
            </div>
            
            
            <div class="alert alert-secondary fade show m-t-10 m-l-25">
            
            <div class="col-md-10 p-0">         
                            
            <div class="input-group m-b-10">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-light">
                    <div class="radio radio-css radio-inline">
                      <input name="modeselect" type="radio" id="modeselect_1" value="0" <?php if (!(strcmp($row_RecordCartListItem['modeselect'],"0"))) {echo "checked=\"checked\"";} ?> />
                      <label for="modeselect_1" >固定運費 </label>
                    </div>
                    </span>
                </div>
                
                
                <input name="countryprice" type="number" class="form-control col-md-1" id="countryprice" step="1" value="<?php echo $row_RecordCartListItem['countryprice']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                <div class="input-group-append"><span class="input-group-text">元</span></div>   
                
                
            </div>
            <div class="table-responsive">
            <div class="input-group m-b-10">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-light">
                    <div class="radio radio-css radio-inline">
                      <input type="radio" name="modeselect" id="modeselect_2" value="1" <?php if (!(strcmp($row_RecordCartListItem['modeselect'],"1"))) {echo "checked=\"checked\"";} ?> />
              <label for="modeselect_2">台灣分區運費</label>
                    </div>
                    </span>
                </div>
                <div class="input-group-prepend">
                    <span class="input-group-text">北部</span>
                </div>
                <input name="northprice" type="number" class="form-control col-md-1" id="northprice" step="1" value="<?php echo $row_RecordCartListItem['northprice']; ?>" maxlength="4" data-parsley-min="0" data-parsley-max="9999" data-parsley-type="number" data-parsley-trigger="blur"/>
                <div class="input-group-prepend">
                    <span class="input-group-text">中部</span>
                </div>
                <input name="centralprice" type="number" class="form-control col-md-1" id="centralprice" step="1" value="<?php echo $row_RecordCartListItem['centralprice']; ?>" maxlength="4" data-parsley-min="0" data-parsley-max="9999" data-parsley-type="number" data-parsley-trigger="blur"/>
                
                <div class="input-group-prepend">
                    <span class="input-group-text">南部</span>
                </div>
                <input name="southprice" type="number" class="form-control col-md-1" id="southprice" step="1" value="<?php echo $row_RecordCartListItem['southprice']; ?>" maxlength="4" data-parsley-min="0" data-parsley-max="9999" data-parsley-type="number" data-parsley-trigger="blur"/>
                
                <div class="input-group-prepend">
                    <span class="input-group-text">東部</span>
                </div>
                <input name="eastprice" type="number" class="form-control col-md-1" id="eastprice" step="1" value="<?php echo $row_RecordCartListItem['eastprice']; ?>" maxlength="4" data-parsley-min="0" data-parsley-max="9999" data-parsley-type="number" data-parsley-trigger="blur"/>
                
                <div class="input-group-prepend">
                    <span class="input-group-text">外島</span>
                </div>
                <input name="outerprice" type="number" class="form-control col-md-1" id="outerprice" step="1" value="<?php echo $row_RecordCartListItem['outerprice']; ?>" maxlength="4" data-parsley-min="0" data-parsley-max="9999" data-parsley-type="number" data-parsley-trigger="blur"/>
                
                <div class="input-group-append">
                	<span class="input-group-text">元</span>
                </div>  
                
            </div>
            </div>
            <ul>
              <li> 北部：台北市 基隆市 新北市 桃園縣 桃園市 新竹市 新竹縣</li>
              <li> 中部：苗栗縣 台中市 南投縣 彰化縣</li>
              <li> 南部：雲林縣 嘉義市 嘉義縣 台南市 高雄市 屏東縣</li>
              <li> 東部：宜蘭縣 花蓮縣 台東縣 。外島：澎湖縣 金門縣 連江縣</li>
            </ul>
            </div>
 
              
            </div>
            
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
            
            <div class="radio radio-css ">
              <input type="radio" name="mode" id="mode_3" value="2" <?php if (!(strcmp($row_RecordCartListItem['mode'],"2"))) {echo "checked=\"checked\"";} ?> />
              <label for="mode_3">運費另外報價 <i class="fa fa-info-circle text-orange" data-original-title="由於買家購買時運費無法確定，因此不支援金流付款。" data-toggle="tooltip" data-placement="top"></i></label>
            </div>
            
            <small class="f-s-12 text-grey-darker m-l-25">訂購完成後由商家再填入運費，並自行通知消費者運費報價</small>
            
            <div class="radio radio-css ">
              <input type="radio" name="mode" id="mode_4" value="3" <?php if (!(strcmp($row_RecordCartListItem['mode'],"3"))) {echo "checked=\"checked\"";} ?> />
              <label for="mode_4">消費者自填運費 <i class="fa fa-info-circle text-orange" data-original-title="由於買家購買時運費可能輸入錯誤，因此不支援金流付款。" data-toggle="tooltip" data-placement="top"></i></label>
            </div>
            
            <small class="f-s-12 text-grey-darker m-l-25">開放讓消費者自填運費，請於下方貨運說明詳述運費計算方式</small>
            
            <?php } ?>
      </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">送貨地址填寫<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="例如：面交、到店取貨消費者可不填寫送貨地址。" data-toggle="tooltip" data-placement="top"></i></label>                       	
        <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input type="radio" name="addrindicate" id="addrindicate_1" value="0" <?php if (!(strcmp($row_RecordCartListItem['addrindicate'],"0"))) {echo "checked=\"checked\"";} ?> />
              <label for="addrindicate_1">選填</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input name="addrindicate" type="radio" id="addrindicate_2" value="1" <?php if (!(strcmp($row_RecordCartListItem['addrindicate'],"1"))) {echo "checked=\"checked\"";} ?> />
              <label for="addrindicate_2">必填 </label>
          </div>
            
      </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">貨運說明 <i class="fa fa-info-circle text-orange" data-original-title="提醒費者的話。 例如：購買到生鮮食品時請選擇此低溫宅配的貨運方式。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="45" rows="30"><?php echo $row_RecordCartListItem['content']; ?>
                </textarea>  
          </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">貨到付款<span class="text-red">*</span></label>
          <div class="col-md-10">
          
            <div class="alert alert-secondary fade show m-t-10">
          
              <strong><i class="fa fa-exclamation-circle"></i> 是否有提供貨到付款?</strong>
                
                <div class="col-md-10 p-0 m-t-10">         
                                
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcome" type="radio" id="productcome_1" value="0" <?php if (!(strcmp($row_RecordCartListItem['productcome'],"0"))) {echo "checked=\"checked\"";} ?> />
                              <label for="productcome_1" >無提供 </label>
                            </div>
                            </span>
                        </div>
                        
                        
                       
                        
                        
                    </div>
                    
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcome" type="radio" id="productcome_2" value="1" <?php if (!(strcmp($row_RecordCartListItem['productcome'],"1"))) {echo "checked=\"checked\"";} ?> />
                              <label for="productcome_2" >有提供，且消費者可選擇是否要貨到付款 ，限購物低於 </label>
                            </div>
                            </span>
                        </div>
                        
                        
                        <input name="productcomeprice" type="number" class="form-control col-md-1" id="productcomeprice" step="1" value="<?php echo $row_RecordCartListItem['productcomeprice']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                        <div class="input-group-append"><span class="input-group-text">元以下方可選擇使用貨到付款(不填為不限制)</span></div>   
                        
                        
                    </div>
                    
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcome" type="radio" id="productcome_3" value="2" <?php if (!(strcmp($row_RecordCartListItem['productcome'],"2"))) {echo "checked=\"checked\"";} ?> />
                              <label for="productcome_3" >有提供，且必定是貨到付款 (例如：快遞代收貨款、到店取貨) </label>
                            </div>
                            </span>
                        </div>
                        
                        
                    </div>
                
                </div>
 
              
            </div>
            
            <div class="alert alert-secondary fade show m-t-10">
          
              <strong><i class="fa fa-exclamation-circle"></i> 貨到付款時，是否要向消費者加收手續費?</strong>
                
                <div class="col-md-10 p-0 m-t-10">         
                                
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcomeselect" type="radio" id="productcomeselect_1" value="0" <?php if (!(strcmp($row_RecordCartListItem['productcomeselect'],"0"))) {echo "checked=\"checked\"";} ?> />
                              <label for="productcomeselect_1" >不需要 </label>
                            </div>
                            </span>
                        </div>
                        
                        
                       
                        
                        
                    </div>
                    
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcomeselect" type="radio" id="productcomeselect_2" value="1" <?php if (!(strcmp($row_RecordCartListItem['productcomeselect'],"1"))) {echo "checked=\"checked\"";} ?> />
                              <label for="productcomeselect_2" >固定加收 </label>
                            </div>
                            </span>
                        </div>
                        
                        
                        <input name="fixedprice" type="number" class="form-control col-md-1" id="fixedprice" step="1" value="<?php echo $row_RecordCartListItem['fixedprice']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                        <div class="input-group-append"><span class="input-group-text">元</span></div>   
                        
                        
                    </div>
                    
                    
                    <div class="bg-white">
                    
                    <div class="input-group m-b-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcomeselect" type="radio" id="productcomeselect_3" value="2" <?php if (!(strcmp($row_RecordCartListItem['productcomeselect'],"2"))) {echo "checked=\"checked\"";} ?> />
                              <label for="productcomeselect_3" >依代收金額(由小到大填寫) </label>
                            </div>
                            </span>
                        </div>
                    </div>
                    
                    
                    <div class="alert alert-light fade show m-t-0 m-l-25">
                    <?php //for($j=1; $j<=6; $j++){ ?>
                        <div class="input-group m-b-0 m-t-10">
                            
                            <input name="dynamicprice1" type="number" class="form-control col-md-1" id="dynamicprice1" step="1" value="<?php echo $row_RecordCartListItem['dynamicprice1']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">元以內加收</span>
                            </div>
                            
                            
                            <input name="dynamicpricepay1" type="number" class="form-control col-md-1" id="dynamicpricepay1" step="1" value="<?php echo $row_RecordCartListItem['dynamicpricepay1']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            
                            <select name="dynamicpriceunit1" id="dynamicpriceunit1">
                              <option value="0" <?php if (!(strcmp(0, $row_RecordCartListItem['dynamicpriceunit1']))) {echo "selected=\"selected\"";} ?>>元</option>
                              <option value="1" <?php if (!(strcmp(1, $row_RecordCartListItem['dynamicpriceunit1']))) {echo "selected=\"selected\"";} ?>>%</option>
                            </select>
                            
                        
                        </div>
                        
                        <div class="input-group m-b-0 m-t-10">
                            
                            <input name="dynamicprice2" type="number" class="form-control col-md-1" id="dynamicprice2" step="1" value="<?php echo $row_RecordCartListItem['dynamicprice2']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">元以內加收</span>
                            </div>
                            
                            
                            <input name="dynamicpricepay2" type="number" class="form-control col-md-1" id="dynamicpricepay2" step="1" value="<?php echo $row_RecordCartListItem['dynamicpricepay2']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            
                            <select name="dynamicpriceunit2" id="dynamicpriceunit2">
                              <option value="0" <?php if (!(strcmp(0, $row_RecordCartListItem['dynamicpriceunit2']))) {echo "selected=\"selected\"";} ?>>元</option>
                              <option value="1" <?php if (!(strcmp(1, $row_RecordCartListItem['dynamicpriceunit2']))) {echo "selected=\"selected\"";} ?>>%</option>
                            </select>
                            
                        
                        </div>
                        
                        <div class="input-group m-b-0 m-t-10">
                            
                            <input name="dynamicprice3" type="number" class="form-control col-md-1" id="dynamicprice3" step="1" value="<?php echo $row_RecordCartListItem['dynamicprice3']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">元以內加收</span>
                            </div>
                            
                            
                            <input name="dynamicpricepay3" type="number" class="form-control col-md-1" id="dynamicpricepay3" step="1" value="<?php echo $row_RecordCartListItem['dynamicpricepay3']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            
                            <select name="dynamicpriceunit3" id="dynamicpriceunit3">
                              <option value="0" <?php if (!(strcmp(0, $row_RecordCartListItem['dynamicpriceunit3']))) {echo "selected=\"selected\"";} ?>>元</option>
                              <option value="1" <?php if (!(strcmp(1, $row_RecordCartListItem['dynamicpriceunit3']))) {echo "selected=\"selected\"";} ?>>%</option>
                            </select>
                            
                        
                        </div>
                        
                        <div class="input-group m-b-0 m-t-10">
                            
                            <input name="dynamicprice4" type="number" class="form-control col-md-1" id="dynamicprice4" step="1" value="<?php echo $row_RecordCartListItem['dynamicprice4']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">元以內加收</span>
                            </div>
                            
                            
                            <input name="dynamicpricepay4" type="number" class="form-control col-md-1" id="dynamicpricepay4" step="1" value="<?php echo $row_RecordCartListItem['dynamicpricepay4']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            
                            <select name="dynamicpriceunit4" id="dynamicpriceunit4">
                              <option value="0" <?php if (!(strcmp(0, $row_RecordCartListItem['dynamicpriceunit4']))) {echo "selected=\"selected\"";} ?>>元</option>
                              <option value="1" <?php if (!(strcmp(1, $row_RecordCartListItem['dynamicpriceunit4']))) {echo "selected=\"selected\"";} ?>>%</option>
                            </select>
                            
                        
                        </div>
                        
                        <div class="input-group m-b-0 m-t-10">
                            
                            <input name="dynamicprice5" type="number" class="form-control col-md-1" id="dynamicprice5" step="1" value="<?php echo $row_RecordCartListItem['dynamicprice5']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">元以內加收</span>
                            </div>
                            
                            
                            <input name="dynamicpricepay5" type="number" class="form-control col-md-1" id="dynamicpricepay5" step="1" value="<?php echo $row_RecordCartListItem['dynamicpricepay5']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            
                            <select name="dynamicpriceunit5" id="dynamicpriceunit5">
                              <option value="0" <?php if (!(strcmp(0, $row_RecordCartListItem['dynamicpriceunit5']))) {echo "selected=\"selected\"";} ?>>元</option>
                              <option value="1" <?php if (!(strcmp(1, $row_RecordCartListItem['dynamicpriceunit5']))) {echo "selected=\"selected\"";} ?>>%</option>
                            </select>
                            
                        
                        </div>
                        
                        <div class="input-group m-b-0 m-t-10">
                            
                            <input name="dynamicprice6" type="number" class="form-control col-md-1" id="dynamicprice6" step="1" value="<?php echo $row_RecordCartListItem['dynamicprice6']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">元以內加收</span>
                            </div>
                            
                            
                            <input name="dynamicpricepay6" type="number" class="form-control col-md-1" id="dynamicpricepay6" step="1" value="<?php echo $row_RecordCartListItem['dynamicpricepay6']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                            
                            
                            <select name="dynamicpriceunit6" id="dynamicpriceunit6">
                              <option value="0" <?php if (!(strcmp(0, $row_RecordCartListItem['dynamicpriceunit6']))) {echo "selected=\"selected\"";} ?>>元</option>
                              <option value="1" <?php if (!(strcmp(1, $row_RecordCartListItem['dynamicpriceunit6']))) {echo "selected=\"selected\"";} ?>>%</option>
                            </select>
                            
                        
                        </div>
                    <?php //} ?>
                    </div>
                    
                    </div>
                    
                
                </div>
 
              
            </div>
          
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_SESSION['lang']; ?>" />
            <input name="Operate2" type="hidden" id="Operate2" value="addSuccess" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="item_id" type="hidden" id="item_id" value="<?php echo $_GET['item_id'] ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      
      
  <input type="hidden" name="MM_update" value="form" />
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

<script type="text/javascript">
<!--
function CheckFields()
{	
	if($('input[name=mode]:checked').val() == '1'){
		if($('input[name=modeselect]:checked').val() == '0' && $("#countryprice").val() == '') {
			alert("需填寫全國固定運費價格！！");
			return false;
		}
		if($('input[name=modeselect]:checked').val() == '1' && ( $("#northprice").val() == '' || $("#centralprice").val() == '' || $("#southprice").val() == '' || $("#eastprice").val() == '' || $("#outerprice").val() == '') ) {
			alert("需填齊分區運費價格！！");
			return false;
		}
		
	}
	if($('input[name=productcomeselect]:checked').val() == '1' && $("#fixedprice").val() == ''){
			alert("需填寫固定加收價格！！");
			return false;
	}
	if($('input[name=productcomeselect]:checked').val() == '2'){
			if($("#dynamicprice1").val() == '' && $("#dynamicpricepay1").val() == '')
			{
				alert("至少需填寫一項且需由最上方欄位依次填寫！！");
				return false;
			}
			<?php for ($j=1; $j<=6; $j++) { ?>
				if(($("#dynamicprice<?php echo $j; ?>").val() != "" && $("#dynamicpricepay<?php echo $j; ?>").val() == "") || ($("#dynamicprice<?php echo $j; ?>").val() == "" && $("#dynamicpricepay<?php echo $j; ?>").val() != ""))
				{
					alert("資料需填寫完整！！");
					return false;
				}
			<?php } ?>		
			<?php for ($j=1; $j<=5; $j++) { ?>
			    if($("#dynamicprice<?php echo $j+1; ?>").val() != "" && $("#dynamicprice<?php echo $j; ?>").val() != "")
				{
					if($("#dynamicprice<?php echo $j+1; ?>").val()-$("#dynamicprice<?php echo $j; ?>").val() <=0)
					{
						alert("價格須由小到大填寫！！");
						return false;
					}
				}
            <?php } ?>
	}
}
//-->
</script>  


<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
</body>
</html>
<?php
mysqli_free_result($RecordCartListItem);
?>