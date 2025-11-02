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

$colname_RecordCart = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCart = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCart = sprintf("SELECT * FROM erp_scaleorderout WHERE oserial = %s", GetSQLValueString($colname_RecordCart, "text"));
$RecordCart = mysqli_query($DB_Conn, $query_RecordCart) or die(mysqli_error($DB_Conn));
$row_RecordCart = mysqli_fetch_assoc($RecordCart);
$totalRows_RecordCart = mysqli_num_rows($RecordCart);

$colname_RecordCartDetailed = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCartDetailed = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed = sprintf("SELECT * FROM erp_scaleorderindetail WHERE oserial = %s", GetSQLValueString($colname_RecordCartDetailed, "text"));
$RecordCartDetailed = mysqli_query($DB_Conn, $query_RecordCartDetailed) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed);
$totalRows_RecordCartDetailed = mysqli_num_rows($RecordCartDetailed);

$colname_RecordCartDetailed_sell = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCartDetailed_sell = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed_sell = sprintf("SELECT * FROM erp_scaleorderindetail WHERE oserial = %s", GetSQLValueString($colname_RecordCartDetailed_sell, "text"));
$RecordCartDetailed_sell = mysqli_query($DB_Conn, $query_RecordCartDetailed_sell) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed_sell = mysqli_fetch_assoc($RecordCartDetailed_sell);
$totalRows_RecordCartDetailed_sell = mysqli_num_rows($RecordCartDetailed_sell);

$colname_RecordCartDetailed_buy = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCartDetailed_buy = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed_buy = sprintf("SELECT * FROM erp_scaleorderindetail WHERE oserial = %s", GetSQLValueString($colname_RecordCartDetailed_buy, "text"));
$RecordCartDetailed_buy = mysqli_query($DB_Conn, $query_RecordCartDetailed_buy) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed_buy = mysqli_fetch_assoc($RecordCartDetailed_buy);
$totalRows_RecordCartDetailed_buy = mysqli_num_rows($RecordCartDetailed_buy);

$colname_RecordCartDetailed_free = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCartDetailed_free = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed_free = sprintf("SELECT * FROM erp_scaleorderindetail WHERE oserial = %s", GetSQLValueString($colname_RecordCartDetailed_free, "text"));
$RecordCartDetailed_free = mysqli_query($DB_Conn, $query_RecordCartDetailed_free) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed_free = mysqli_fetch_assoc($RecordCartDetailed_free);
$totalRows_RecordCartDetailed_free = mysqli_num_rows($RecordCartDetailed_free);

$colname_RecordCartListFreight = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListFreight = $_GET['lang'];
}
$coluserid_RecordCartListFreight = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartListFreight = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListFreight = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListFreight, "text"),GetSQLValueString($coluserid_RecordCartListFreight, "int"));
$RecordCartListFreight = mysqli_query($DB_Conn, $query_RecordCartListFreight) or die(mysqli_error($DB_Conn));
$row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
$totalRows_RecordCartListFreight = mysqli_num_rows($RecordCartListFreight);

/* 刪除資料 */
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
	
	$query_RecordCartlist = sprintf("SELECT * FROM erp_scaleorderindetail WHERE id=%s ",GetSQLValueString($_GET['id_del'], "text"));
	  $RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	  $row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	  $totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
	
	$updateSQL = sprintf("UPDATE erp_scaleorderindetail SET oserial=%s, bound=%s, state=%s WHERE id =%s",
						   GetSQLValueString("", "text"),
						   GetSQLValueString('in', "text"),
						   GetSQLValueString(1, "int"),
						   GetSQLValueString($_GET['id_del'], "int"));
	
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		  
  /*$deleteSQL = sprintf("DELETE FROM erp_scaleOrderInDetail WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));*/
  
  $delGoTo = "manage_scale_index_detailed.php?Serial=" . $_GET['Serial'] . "&lang=" .$_GET['lang'];
  
  header(sprintf("Location: %s", $delGoTo));
}
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

  <!-- begin panel-body -->
  
  <a href="#" class="btn btn-primary btn-block" onClick="a()"><i class="fa fa-print" aria-hidden="true"></i> 列印本頁</a>
  <div class="panel-body p-0 bg-white" id="jq_print">
      <link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-print/css/bootstrap-print.min.css" rel="stylesheet" />
      
      <div style="max-width:1000px; margin-left:auto; margin-right:auto; padding:10px;">
      
              <h3 class="text-center"><?php echo $row_RecordCart['warehouse']; ?>出貨明細A</h3>
      
              <table class="table table-condensed">
                      <tbody>
                        <tr>
                          <td width="160" class="title_bg">出貨單號</td>
                          <td><?php echo $row_RecordCart['oserial']; ?></td>
                          <td width="160" class="title_bg">出貨日期</td>
                          <td><?php $dt = new DateTime($row_RecordCart['postdate']); echo $dt->format('Y-m-d g:i A'); ?></td>
                        </tr>
                        <td class="title_bg">司機</td>
                          <td width="380"><?php echo $row_RecordCart['driver']; ?></td>
                          <td width="160" class="title_bg">車號</td>
                          <td width="380"><?php echo $row_RecordCart['carnumber']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">送達地點</td>
                          <td><?php echo $row_RecordCart['manufacturer']; ?></td>
                          <td class="title_bg">送達日期</td>
                          <td><?php if($row_RecordCart['arrivals'] != "") { $dt = new DateTime($row_RecordCart['arrivals']); echo $dt->format('Y-m-d g:i A'); } ?></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                          <td></td> 
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tfoot>
                      </table>
                      
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>編號</th>
                      <th>代號</th>
                      <th>物料</th>
                      <th>總重</th>
                      <th>扣重</th>
                      <th>淨重</th>
                      <th>入庫時間</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1; ?>
                  <?php do { ?>
                  <tr>
                      <td><?php echo $i; ?> <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $_SESSION['MM_UserGroup'] == 'admin' || $_SESSION['MM_UserGroup'] == 'badmin' || $_SESSION['MM_UserGroup'] == 'subadmin' ) { ?><br /><a href="manage_scale_index_detailed.php?Serial=<?php echo $_GET['Serial']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordCartDetailed['id']; ?>" onclick="return window.confirm('你確定要刪除此物料?刪除後將會將目前物料移到入庫列表!!');" class="">刪</a><?php } ?></td>
                      <td><?php require("require_manage_scaleorder_get_code.php"); ?></td>
                      <td><?php echo $row_RecordCartDetailed['title']; ?><span style="font-size:8px">/<?php echo $row_RecordCartDetailed['num']; ?></span></td>
                      <td><?php echo $row_RecordCartDetailed['Totalweight']; ?></td>
                      <td><?php echo $row_RecordCartDetailed['Minweight']; ?></td>
                      <td><?php if($row_RecordCartDetailed['Oriweight'] == "" || ($row_RecordCartDetailed['Totalweight'] > 0 && $row_RecordCartDetailed['Oriweight'] == "0")) {echo $row_RecordCartDetailed['Totalweight']-$row_RecordCartDetailed['Minweight'];}else{echo $row_RecordCartDetailed['Oriweight'];} ?></td>
                      <td><?php $dt = new DateTime($row_RecordCartDetailed['postdate']); echo $dt->format('Y-m-d H:i A'); ?></td>
                  </tr>
                  <?php $i++; ?>
                          <?php 
			$NowTotalweight += $row_RecordCartDetailed['Totalweight'];
			$NowOriweight += ($row_RecordCartDetailed['Totalweight']-$row_RecordCartDetailed['Minweight']);
			
			$AllTotalweight += $row_RecordCartDetailed['Totalweight'];
			$AllOriweight += ($row_RecordCartDetailed['Totalweight']-$row_RecordCartDetailed['Minweight']);
			//echo $row_RecordCartDetailed['Totalweight']; 
			
			?>
                          <?php } while ($row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed)); ?>
              </tbody>
              <tfoot>
            <tr>
              <td colspan="7" align="right">總重 <?php echo $NowTotalweight ?> kg / 淨重 <?php echo $NowOriweight ?> kg</td> 
              </tr>
          </tfoot>
          </table>

          <div style="float:right"><?php $qr_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . "/scale_qr_arrivals.php?Serial=" . $row_RecordCart['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">送達地點登記網址</div></div>
  
  <div style="float:left"><?php $qr_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . "/scale_qr_car.php?Serial=" . $row_RecordCart['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">載運時間登記網址</div></div>
  
  <div style="clear:both;"></div>
  <hr>
                                
      </div>
      
      <p style="page-break-after:always"></p>
      
      <div style="max-width:1000px; margin-left:auto; margin-right:auto; padding:10px;">
      
              <h3 class="text-center"><?php echo $row_RecordCart['warehouse']; ?>出貨明細B</h3>
      
              <table class="table table-condensed">
                      <tbody>
                        <tr>
                          <td width="160" class="title_bg">出貨單號</td>
                          <td><?php echo $row_RecordCart['oserial']; ?></td>
                          <td width="160" class="title_bg">出貨日期</td>
                          <td><?php $dt = new DateTime($row_RecordCart['postdate']); echo $dt->format('Y-m-d g:i A'); ?></td>
                        </tr>
                        <td class="title_bg">司機</td>
                          <td width="380"><?php echo $row_RecordCart['driver']; ?></td>
                          <td width="160" class="title_bg">車號</td>
                          <td width="380"><?php echo $row_RecordCart['carnumber']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">送達地點</td>
                          <td><?php echo $row_RecordCart['manufacturer']; ?></td>
                          <td class="title_bg">送達日期</td>
                          <td><?php if($row_RecordCart['arrivals'] != "") { $dt = new DateTime($row_RecordCart['arrivals']); echo $dt->format('Y-m-d g:i A'); } ?></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                          <td></td> 
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tfoot>
                      </table>
                      
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>編號</th>
                      <th>代號</th>
                      <th>物料</th>
                      <th>總重</th>
                      <th>扣重</th>
                      <th>淨重</th>
                      <th>入庫時間</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1; ?>
                  <?php do { ?>
                  <?php require("require_manage_scaleorder_get_state_sell.php"); ?>
                  <?php if ($row_RecordScale['state'] == 'sell') { ?>
                  <tr>
                      <td><?php echo $i; ?> <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $_SESSION['MM_UserGroup'] == 'admin' || $_SESSION['MM_UserGroup'] == 'badmin' || $_SESSION['MM_UserGroup'] == 'subadmin' ) { ?><br /><a href="manage_scale_index_detailed.php?Serial=<?php echo $_GET['Serial']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordCartDetailed_sell['id']; ?>" onclick="return window.confirm('你確定要刪除此物料?刪除後將會將目前物料移到入庫列表!!');" class="">刪</a><?php } ?></td>
                      <td><?php require("require_manage_scaleorder_get_code_sell.php"); ?></td>
                      <td><?php echo $row_RecordCartDetailed_sell['title']; ?><span style="font-size:8px">/<?php echo $row_RecordCartDetailed_sell['num']; ?></span></td>
                      <td><?php echo $row_RecordCartDetailed_sell['Totalweight']; ?></td>
                      <td><?php echo $row_RecordCartDetailed_sell['Minweight']; ?></td>
                      <td><?php if($row_RecordCartDetailed_sell['Oriweight'] == "" || ($row_RecordCartDetailed_sell['Totalweight'] > 0 && $row_RecordCartDetailed_sell['Oriweight'] == "0")) {echo $row_RecordCartDetailed_sell['Totalweight']-$row_RecordCartDetailed_sell['Minweight'];}else{echo $row_RecordCartDetailed_sell['Oriweight'];} ?></td>
                      <td><?php $dt = new DateTime($row_RecordCartDetailed_sell['postdate']); echo $dt->format('Y-m-d H:i A'); ?></td>
                  </tr>
                  <?php $i++; ?>
                          <?php 
			$NowTotalweight += $row_RecordCartDetailed_sell['Totalweight'];
			$NowOriweight += ($row_RecordCartDetailed_sell['Totalweight']-$row_RecordCartDetailed_sell['Minweight']);
			
			$AllTotalweight += $row_RecordCartDetailed_sell['Totalweight'];
			$AllOriweight += ($row_RecordCartDetailed_sell['Totalweight']-$row_RecordCartDetailed_sell['Minweight']);
			//echo $row_RecordCartDetailed_sell['Totalweight']; 
			
			?>
            <?php } ?>
                          <?php } while ($row_RecordCartDetailed_sell = mysqli_fetch_assoc($RecordCartDetailed_sell)); ?>
              </tbody>
              <tfoot>
            <tr>
              <td colspan="7" align="right">總重 <?php echo $NowTotalweight ?> kg / 淨重 <?php echo $NowOriweight ?> kg</td> 
              </tr>
          </tfoot>
          </table>

          <div style="float:right"><?php $qr_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . "/scale_qr_arrivals.php?Serial=" . $row_RecordCart['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">送達地點登記網址</div></div>
  
  <div style="float:left"><?php $qr_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . "/scale_qr_car.php?Serial=" . $row_RecordCart['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">載運時間登記網址</div></div>
  
  <div style="clear:both;"></div>
  <hr>
                                
      </div>
      
      <p style="page-break-after:always"></p>
      
      <div style="max-width:1000px; margin-left:auto; margin-right:auto; padding:10px;">
      
              <h3 class="text-center"><?php echo $row_RecordCart['warehouse']; ?>出貨明細C</h3>
      
              <table class="table table-condensed">
                      <tbody>
                        <tr>
                          <td width="160" class="title_bg">出貨單號</td>
                          <td><?php echo $row_RecordCart['oserial']; ?></td>
                          <td width="160" class="title_bg">出貨日期</td>
                          <td><?php $dt = new DateTime($row_RecordCart['postdate']); echo $dt->format('Y-m-d g:i A'); ?></td>
                        </tr>
                        <td class="title_bg">司機</td>
                          <td width="380"><?php echo $row_RecordCart['driver']; ?></td>
                          <td width="160" class="title_bg">車號</td>
                          <td width="380"><?php echo $row_RecordCart['carnumber']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">送達地點</td>
                          <td><?php echo $row_RecordCart['manufacturer']; ?></td>
                          <td class="title_bg">送達日期</td>
                          <td><?php if($row_RecordCart['arrivals'] != "") { $dt = new DateTime($row_RecordCart['arrivals']); echo $dt->format('Y-m-d g:i A'); } ?></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                          <td></td> 
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tfoot>
                      </table>
                      
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>編號</th>
                      <th>代號</th>
                      <th>物料</th>
                      <th>總重</th>
                      <th>扣重</th>
                      <th>淨重</th>
                      <th>入庫時間</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1; ?>
                  <?php do { ?>
				  <?php require("require_manage_scaleorder_get_state_buy.php"); ?>
                  <?php if ($row_RecordScale['state'] == 'buy') { ?>
                  <tr>
                      <td><?php echo $i; ?> <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $_SESSION['MM_UserGroup'] == 'admin' || $_SESSION['MM_UserGroup'] == 'badmin' || $_SESSION['MM_UserGroup'] == 'subadmin' ) { ?><br /><a href="manage_scale_index_detailed.php?Serial=<?php echo $_GET['Serial']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordCartDetailed_buy['id']; ?>" onclick="return window.confirm('你確定要刪除此物料?刪除後將會將目前物料移到入庫列表!!');" class="">刪</a><?php } ?></td>
                      <td><?php require("require_manage_scaleorder_get_code_buy.php"); ?></td>
                      <td><?php echo $row_RecordCartDetailed_buy['title']; ?><span style="font-size:8px">/<?php echo $row_RecordCartDetailed_buy['num']; ?></span></td>
                      <td><?php echo $row_RecordCartDetailed_buy['Totalweight']; ?></td>
                      <td><?php echo $row_RecordCartDetailed_buy['Minweight']; ?></td>
                      <td><?php if($row_RecordCartDetailed_buy['Oriweight'] == "" || ($row_RecordCartDetailed_buy['Totalweight'] > 0 && $row_RecordCartDetailed_buy['Oriweight'] == "0")) {echo $row_RecordCartDetailed_buy['Totalweight']-$row_RecordCartDetailed_buy['Minweight'];}else{echo $row_RecordCartDetailed_buy['Oriweight'];} ?></td>
                      <td><?php $dt = new DateTime($row_RecordCartDetailed_buy['postdate']); echo $dt->format('Y-m-d H:i A'); ?></td>
                  </tr>
                  <?php $i++; ?>
                          <?php 
			$NowTotalweight += $row_RecordCartDetailed_buy['Totalweight'];
			$NowOriweight += ($row_RecordCartDetailed_buy['Totalweight']-$row_RecordCartDetailed_buy['Minweight']);
			
			$AllTotalweight += $row_RecordCartDetailed_buy['Totalweight'];
			$AllOriweight += ($row_RecordCartDetailed_buy['Totalweight']-$row_RecordCartDetailed_buy['Minweight']);
			//echo $row_RecordCartDetailed_buy['Totalweight']; 
			
			?>
            <?php } ?>
                          <?php } while ($row_RecordCartDetailed_buy = mysqli_fetch_assoc($RecordCartDetailed_buy)); ?>
              </tbody>
              <tfoot>
            <tr>
              <td colspan="7" align="right">總重 <?php echo $NowTotalweight ?> kg / 淨重 <?php echo $NowOriweight ?> kg</td> 
              </tr>
          </tfoot>
          </table>

          <div style="float:right"><?php $qr_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . "/scale_qr_arrivals.php?Serial=" . $row_RecordCart['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">送達地點登記網址</div></div>
  
  <div style="float:left"><?php $qr_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . "/scale_qr_car.php?Serial=" . $row_RecordCart['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">載運時間登記網址</div></div>
  
  <div style="clear:both;"></div>
  <hr>
                                
      </div>
      
      <p style="page-break-after:always"></p>
      
      <div style="max-width:1000px; margin-left:auto; margin-right:auto; padding:10px;">
      
              <h3 class="text-center"><?php echo $row_RecordCart['warehouse']; ?>出貨明細D</h3>
      
              <table class="table table-condensed">
                      <tbody>
                        <tr>
                          <td width="160" class="title_bg">出貨單號</td>
                          <td><?php echo $row_RecordCart['oserial']; ?></td>
                          <td width="160" class="title_bg">出貨日期</td>
                          <td><?php $dt = new DateTime($row_RecordCart['postdate']); echo $dt->format('Y-m-d g:i A'); ?></td>
                        </tr>
                        <td class="title_bg">司機</td>
                          <td width="380"><?php echo $row_RecordCart['driver']; ?></td>
                          <td width="160" class="title_bg">車號</td>
                          <td width="380"><?php echo $row_RecordCart['carnumber']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">送達地點</td>
                          <td><?php echo $row_RecordCart['manufacturer']; ?></td>
                          <td class="title_bg">送達日期</td>
                          <td><?php if($row_RecordCart['arrivals'] != "") { $dt = new DateTime($row_RecordCart['arrivals']); echo $dt->format('Y-m-d g:i A'); } ?></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                          <td></td> 
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tfoot>
                      </table>
                      
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>編號</th>
                      <th>代號</th>
                      <th>物料</th>
                      <th>總重</th>
                      <th>扣重</th>
                      <th>淨重</th>
                      <th>入庫時間</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1; ?>
                  <?php do { ?>
                  <?php require("require_manage_scaleorder_get_state_free.php"); ?>
                  <?php if ($row_RecordScale['state'] == 'free') { ?>
                  <tr>
                      <td><?php echo $i; ?> <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $_SESSION['MM_UserGroup'] == 'admin' || $_SESSION['MM_UserGroup'] == 'badmin' || $_SESSION['MM_UserGroup'] == 'subadmin' ) { ?><br /><a href="manage_scale_index_detailed.php?Serial=<?php echo $_GET['Serial']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordCartDetailed_free['id']; ?>" onclick="return window.confirm('你確定要刪除此物料?刪除後將會將目前物料移到入庫列表!!');" class="">刪</a><?php } ?></td>
                      <td><?php require("require_manage_scaleorder_get_code_free.php"); ?></td>
                      <td><?php echo $row_RecordCartDetailed_free['title']; ?><span style="font-size:8px">/<?php echo $row_RecordCartDetailed_free['num']; ?></span></td>
                      <td><?php echo $row_RecordCartDetailed_free['Totalweight']; ?></td>
                      <td><?php echo $row_RecordCartDetailed_free['Minweight']; ?></td>
                      <td><?php if($row_RecordCartDetailed_free['Oriweight'] == "" || ($row_RecordCartDetailed_free['Totalweight'] > 0 && $row_RecordCartDetailed_free['Oriweight'] == "0")) {echo $row_RecordCartDetailed_free['Totalweight']-$row_RecordCartDetailed_free['Minweight'];}else{echo $row_RecordCartDetailed_free['Oriweight'];} ?></td>
                      <td><?php $dt = new DateTime($row_RecordCartDetailed_free['postdate']); echo $dt->format('Y-m-d H:i A'); ?></td>
                  </tr>
                  <?php $i++; ?>
                          <?php 
			$NowTotalweight += $row_RecordCartDetailed_free['Totalweight'];
			$NowOriweight += ($row_RecordCartDetailed_free['Totalweight']-$row_RecordCartDetailed_free['Minweight']);
			
			$AllTotalweight += $row_RecordCartDetailed_free['Totalweight'];
			$AllOriweight += ($row_RecordCartDetailed_free['Totalweight']-$row_RecordCartDetailed_free['Minweight']);
			//echo $row_RecordCartDetailed_free['Totalweight']; 
			
			?>
            <?php } ?>
                          <?php } while ($row_RecordCartDetailed_free = mysqli_fetch_assoc($RecordCartDetailed_free)); ?>
              </tbody>
              <tfoot>
            <tr>
              <td colspan="7" align="right">總重 <?php echo $NowTotalweight ?> kg / 淨重 <?php echo $NowOriweight ?> kg</td> 
              </tr>
          </tfoot>
          </table>

          <div style="float:right"><?php $qr_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . "/scale_qr_arrivals.php?Serial=" . $row_RecordCart['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">送達地點登記網址</div></div>
  
  <div style="float:left"><?php $qr_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . "/scale_qr_car.php?Serial=" . $row_RecordCart['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">載運時間登記網址</div></div>
  
  <div style="clear:both;"></div>
  <hr>
                                
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

<script language="javascript">
	function  a(){$("#jq_print").jqprint();}
</script>

<?php if(isset($_GET['GP_upload']) && $_GET['GP_upload'] == true) { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
</body>
</html>
<?php
mysqli_free_result($RecordCart);

mysqli_free_result($RecordCartDetailed);

mysqli_free_result($RecordCartListFreight);
?>