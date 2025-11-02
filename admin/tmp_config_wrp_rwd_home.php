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
 $updateSQL = sprintf("UPDATE demo_tmp SET tmphomeboxview=%s, boxedhome=%s WHERE id=%s",
                       GetSQLValueString($_POST['tmphomeboxview'], "int"),
                       GetSQLValueString($_POST['boxedhome'], "int"),
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
    <div class="btn-group pull-right"><a href="tmp_config_<?php echo $_GET['board']; ?>.php?lang=<?php echo $_GET['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
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
          <label class="col-md-2 col-form-label">首頁版面設定<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmphomeboxview'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeboxview" id="tmphomeboxview_0" value="0" />
                <label for="tmphomeboxview_0">沿用內頁版面</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmp['tmphomeboxview'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeboxview" id="tmphomeboxview_1" value="1" />
                <label for="tmphomeboxview_1">使用首頁整體版面</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">首頁整體版面<span class="text-red">*</span></label>
          
          <div class="col-md-10">
               <div class="card pull-left m-5">
                    <img src="images/boxed01.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                              <input <?php if (!(strcmp($row_RecordTmp['boxedhome'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxedhome" id="boxedhome_1" value="1" />
                              <label for="boxedhome_1">固定</label>
                      </div>
                    </div>
                </div> 
          
           
               <div class="card pull-left m-5">
                    <img src="images/boxed02.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                              <input <?php if (!(strcmp($row_RecordTmp['boxedhome'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxedhome" id="boxedhome_2" value="0" />
                <label for="boxedhome_2">滿版</label>
                        </div>
                    </div>
                </div> 
                
                <div class="card pull-left m-5">
                    <img src="images/boxed03.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                              <input <?php if (!(strcmp($row_RecordTmp['boxedhome'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxedhome" id="boxedhome_3" value="2" />
                <label for="boxedhome_3">僅橫幅滿版</label>
                        </div>
                    </div>
                </div> 
                
                <div class="card pull-left m-5">
                    <img src="images/boxed04.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordTmp['boxedhome'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxedhome" id="boxedhome_4" value="3" />
                <label for="boxedhome_4">僅內文固定</label>
                        </div>
                    </div>
                </div> 
                
                <div class="card pull-left m-5">
                    <img src="images/boxed05.jpg" alt="" />
                    <div class="card-block">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordTmp['boxedhome'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="boxedhome" id="boxedhome_5" value="4" />
                <label for="boxedhome_5">僅頁首固定</label>
                        </div>
                    </div>
                </div> 
                
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