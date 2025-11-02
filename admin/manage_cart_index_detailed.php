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
$query_RecordCart = sprintf("SELECT * FROM demo_cartorders WHERE oserial = %s", GetSQLValueString($colname_RecordCart, "text"));
$RecordCart = mysqli_query($DB_Conn, $query_RecordCart) or die(mysqli_error($DB_Conn));
$row_RecordCart = mysqli_fetch_assoc($RecordCart);
$totalRows_RecordCart = mysqli_num_rows($RecordCart);

$colname_RecordCartDetailed = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCartDetailed = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed = sprintf("SELECT * FROM demo_cartdetail WHERE dcserial = %s", GetSQLValueString($colname_RecordCartDetailed, "text"));
$RecordCartDetailed = mysqli_query($DB_Conn, $query_RecordCartDetailed) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed);
$totalRows_RecordCartDetailed = mysqli_num_rows($RecordCartDetailed);

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
      <div style="max-width:1000px; margin-left:auto; margin-right:auto; padding:10px;">
      
                      
      <table class="table table-bordered m-b-10">
          <thead>
              <tr>
                  <th><span class="pull-left">訂單編號：<?php echo $row_RecordCart['oserial']; ?></span> <span class="pull-right">訂購日期：<?php $dt = new DateTime($row_RecordCart['postdate']); echo $dt->format('Y-m-d g:i A'); ?></span></th>
              </tr>
          </thead>
      </table>
      
      
      <table class="table table-bordered m-b-10 table-striped">
          <thead>
              <tr>
                  <th width="1%">#</th>
                  <th>貨號</th>
                  <th>商品名稱</th>
                  <th>價格</th>
                  <th>數量</th>
                  <th>備註</th>
                  <th>小計</th>
              </tr>
          </thead>
          <tbody>
              <?php $i=1; ?>
              <?php do { ?>
              <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row_RecordCartDetailed['pdseries']; ?></td>
                  <td>
				  <?php echo $row_RecordCartDetailed['dcproductname']; ?>
                  <?php //$row_RecordCartDetailed['dcformat'] = "紅色;黃色;藍色"; ?>
                  <?php if($row_RecordCartDetailed['dcformat'] != "") { ?>
                  <div class="btn-group">
                    <?php $arr_tag = explode(';', $row_RecordCartDetailed['dcformat']); for($fi = 0; $fi < count($arr_tag); $fi++){ echo "<button class='btn btn-xs btn-primary'>".$arr_tag[$fi]."</button>";}?>
                  </div>
                  <?php } ?>
                  <?php //$row_RecordCartDetailed['dcspformat'] = "紅色;黃色;藍色"; ?>
                  <?php if($row_RecordCartDetailed['dcspformat'] != "") { ?>
                  <div class="btn-group"><?php echo "<button class='btn btn-xs btn-info'>".$row_RecordCartDetailed['dcspformat']."</button>";?></div>
				  <?php } ?>
                  <?php //$row_RecordCartDetailed['dcstate'] = "1"; ?>
                  <?php if ($row_RecordCartDetailed['dcstate'] == '1') {?>
                  <button type="button" class="btn btn-xs btn-danger">加購</button>
                  <?php } ?>
                  
                  </td>
                  <td><?php echo $row_RecordCartDetailed['dcprice']; ?></td>
                  <td><?php echo $row_RecordCartDetailed['dcquantiry']; ?></td>
                  <td><?php echo $row_RecordCartDetailed['dcnotes1']; ?></td>
                  <td><?php echo $row_RecordCartDetailed['dcitemtotal']; ?></td>
              </tr>
              
              <?php $i++; ?>
              <?php } while ($row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed)); ?>
              <tr>
                <td colspan="7" align="center">
                
                <span class="label label-success">商品總額</span><?php echo $row_RecordCart['ocpdprice'];?>
                            <?php if ($row_RecordCart['ocfreightprice'] != "") { ?>
                            +<span class="label label-success">運費</span><?php echo $row_RecordCart['ocfreightprice'];?>
                            <?php } ?>
                            <?php if ($row_RecordCart['ocotherprice'] != "") { ?>
                            +<span class="label label-success">金物流加收</span><?php echo $row_RecordCart['ocotherprice'];?>
                            <?php } ?>
                            <?php if ($row_RecordCart['ocexprice'] != "" && $row_RecordCart['ocexprice'] != "0") { ?>
                            +<span class="label label-success"><?php echo $row_RecordCart['ocexpricename'];?></span><?php echo $row_RecordCart['ocexprice'];?>
                            <?php } ?>
                            <?php if ($row_RecordCart['ocinvoiceprice'] != "" && $row_RecordCart['ocinvoiceprice'] != 0) { ?>
                            +<span class="label label-success">發票稅</span><?php echo $row_RecordCart['ocinvoiceprice'];?>
                            <?php } ?>
                            <?php if ($row_RecordCart['ocDiscountShowAlldiscount_type_5'] != "" && $row_RecordCart['ocDiscountShowAlldiscount_type_5'] != 0) { ?>
                            -<span class="label label-success">全單滿額折扣</span><?php echo $row_RecordCart['ocDiscountShowAlldiscount_type_5'];?>
                            <?php } ?>
                            <?php if ($row_RecordCart['ocDiscountShowAlldiscount_type_6'] != "" && $row_RecordCart['ocDiscountShowAlldiscount_type_6'] != 0) { ?>
                            -<span class="label label-success">全單滿額減價</span><?php echo $row_RecordCart['ocDiscountShowAlldiscount_type_6'];?>
                            <?php } ?>
                            = <span style="color:#900; font-weight:bolder; font-size:36px"><?php echo $row_RecordCart['ocpdprice']+$row_RecordCart['ocfreightprice']+$row_RecordCart['ocotherprice']+$row_RecordCart['ocexprice']+$row_RecordCart['ocinvoiceprice']-$row_RecordCart['ocDiscountShowAlldiscount_type_5']-$row_RecordCart['ocDiscountShowAlldiscount_type_6']; ?></span>
                            
                            <div style="font-size:14px">
                            <?php if ($row_RecordCart['ocfreepricedesc'] != "") { ?><br/><span style="color:#F00; font-weight:bolder"><i class="fa fa-exclamation-circle"></i> <?php echo $row_RecordCart['ocfreepricedesc'] ?></span><?php } ?><?php if ($row_RecordCart['ocfreightstateonly'] == "1") { ?><br/><span style="color:#F00; font-weight:bolder"><i class="fa fa-exclamation-circle"></i> 消費者自填運費</span><?php } ?><?php if ($row_RecordCart['ocfreightstateonly'] == "2") { ?><br/><span style="color:#F00; font-weight:bolder"><i class="fa fa-exclamation-circle"></i> 業者填寫運費</span><?php } ?><?php if ($row_RecordCart['ocfreightstateonly'] == "3") { ?><br/><span style="color:#F00; font-weight:bolder"><i class="fa fa-exclamation-circle"></i> 滿額免運費</span><?php } ?>
                            </div>
                             <div style="height:5px;"></div>
                
                </td>
              </tr>
          </tbody>
      </table>
      
      
      <table class="table table-bordered table-striped m-b-0">
      <tbody>
                        <tr>
                          <td colspan="4" class="title_bg"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 訂購人基本資料</td>
                        </tr>
                        <tr>
                          <td width="150" class="title_bg">姓名</td>
                          <td><?php echo $row_RecordCart['ocbuyname']; ?></td>
                          <td width="150" class="title_bg">性別</td>
                          <td><?php echo $row_RecordCart['ocbuygender']; ?>
                            <?php 
	  	if($row_RecordCart['ocbuygender'] == "男"){
			echo "<span style=\"color:#06F\">" . " <i class=\"fa fa-mars\" aria-hidden=\"true\"></i>" . "</span>"; 
	   	}else{
			echo "<span style=\"color:#C00\">" . " <i class=\"fa fa-venus\" aria-hidden=\"true\"></i>" . "</span>";
		} 
	  ?></td>
                        </tr>
                        <td class="title_bg">行動</td>
                          <td width="380"><?php echo $row_RecordCart['ocbuyphone']; ?></td>
                          <td width="150" class="title_bg">室話</td>
                          <td width="380"><?php echo $row_RecordCart['ocbuytel']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">電子郵件</td>
                          <td><?php echo $row_RecordCart['ocbuymail']; ?></td>
                          <td class="title_bg">&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="title_bg"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 收貨人基本資料</td>
                        </tr>
                        <tr>
                          <td width="150" class="title_bg">姓名</td>
                          <td><?php echo $row_RecordCart['ocname']; ?></td>
                          <td width="150" class="title_bg">性別</td>
                          <td><?php echo $row_RecordCart['ocgender']; ?>
                            <?php 
	  	if($row_RecordCart['ocgender'] == "男"){
			echo "<span style=\"color:#06F\">" . " <i class=\"fa fa-mars\" aria-hidden=\"true\"></i>" . "</span>"; 
	   	}else{
			echo "<span style=\"color:#C00\">" . " <i class=\"fa fa-venus\" aria-hidden=\"true\"></i>" . "</span>";
		} 
	  ?></td>
                        </tr>
                        <td class="title_bg">行動</td>
                          <td width="380"><?php echo $row_RecordCart['ocphone']; ?></td>
                          <td width="150" class="title_bg">室話</td>
                          <td width="380"><?php echo $row_RecordCart['octel']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">電子郵件</td>
                          <td><?php echo $row_RecordCart['ocmail']; ?></td>
                          <td class="title_bg">&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="title_bg"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 發票資料</td>
                        </tr>
                        <tr>
                          <td width="150" class="title_bg">發票類型</td>
                          <td><?php 
			   switch($row_RecordCart['ocinvoiceformat'])
			        {
						case "0":
						echo "不開發票";
						$ocinvoiceformat = "不開發票";
						break;
						case "1":
						echo "二聯式發票";
						$ocinvoiceformat = "二聯式發票";
						break;
						case "2":
						echo "三聯式發票";
						$ocinvoiceformat = "三聯式發票";
						break;
						case "3":
						echo "電子式發票";
						$ocinvoiceformat = "電子式發票";
						if ($row_RecordCart['ocinvoiceetselect'] == '0') {
							echo "<span class=\"TBSort_spboard\">需列印寄送</span>";
						}
						break;
						case "4":
						echo "收據";
						$ocinvoiceformat = "收據";
						break;
						case "5":
						echo "捐給慈善單位";
						$ocinvoiceformat = "捐給慈善單位";
						break;
					}
			  ?></td>
                          <td width="150" class="title_bg">收件人</td>
                          <td><?php echo $row_RecordCart['ocinvoiceusername']; ?></td>
                        </tr>
                        <?php if ($row_RecordCart['ocinvoiceformat'] == '3') { ?>
                        <?php if ($row_RecordCart['ocinvoiceetselect'] == '1') { ?>
                        <tr>
                          <td class="title_bg">載具條碼</td>
                          <td><?php echo $row_RecordCart['ocinvoicesupportno']; ?></td>
                          <td class="title_bg">&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <?php } ?>
                        <?php if ($row_RecordCart['ocinvoiceetselect'] == '2') { ?>
                        <tr>
                          <td class="title_bg">愛心碼</td>
                          <td><?php echo $row_RecordCart['ocinvoiceloveno']; ?></td>
                          <td class="title_bg">&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                        <tr>
                          <td class="title_bg">發票抬頭</td>
                          <td><?php echo $row_RecordCart['ocinvoicetitle']; ?></td>
                          <td class="title_bg">統一編號</td>
                          <td><?php echo $row_RecordCart['ocinvoicecompanyno']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">收件地址</td>
                          <td colspan="3"><?php echo $row_RecordCart['ocinvoiceaddr']; ?></td>
                        </tr>
                        <tr>
                          <td colspan="4" class="title_bg"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 付款、出貨資料</td>
                        </tr>
                        <tr>
                          <td width="150" class="title_bg">付款方式</td>
                          <td><?php 
			  	if ($row_RecordCart['ocpaymentselect'] == 'lingui') {
					$ocpaymentselect = "金融匯款";
				}else if ($row_RecordCart['ocpaymentselect'] == 'atm'){
					$ocpaymentselect = "ATM轉帳";
				}else if ($row_RecordCart['ocpaymentselect'] == 'postoffice'){
					$ocpaymentselect = "郵政劃撥";
				}else if ($row_RecordCart['ocpaymentselect'] == 'other'){
					$ocpaymentselect = "其他付款方式";
				}else if ($row_RecordCart['ocpaymentselect'] == 'payondelivery'){
					$ocpaymentselect = "貨到付款";
				}else if ($row_RecordCart['ocpaymentselect'] == 'allpay'){
					$ocpaymentselect = "綠界金流";
				}else if ($row_RecordCart['ocpaymentselect'] == 'allpay_Credit'){
					$ocpaymentselect = "綠界金流 - 信用卡一次付清";
				}else if ($row_RecordCart['ocpaymentselect'] == 'allpay_BARCODE'){
					$ocpaymentselect = "綠界金流 - 超商條碼";
				}else if ($row_RecordCart['ocpaymentselect'] == 'allpay_CVS'){
					$ocpaymentselect = "綠界金流 - 超商代碼";
				}else if ($row_RecordCart['ocpaymentselect'] == 'pchomepay'){
					$ocpaymentselect = "PCHOMEPAY";
				}else if ($row_RecordCart['ocpaymentselect'] == 'paypal'){
					$ocpaymentselect = "PAYPAL";
				}
					echo $ocpaymentselect;
			  ?></td>
                          <td width="150" class="title_bg">貨款狀態</td>
                          <td><?php 
		switch($row_RecordCart['ocfreightstate'])
		{
			case "0":
			break;
			case "1":
			echo "<div style=\"color:#C30; font-weight:bolder\"><i class=\"fa fa-info-circle\"></i> 等待貨款</div>";
			break;
			case "2":
			echo "<div style=\"color:#090; font-weight:bolder\"><i class=\"fa fa-info-circle\"></i> 已收到貨款</div>";
			break;
			default:
			break;
		}
		?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">匯款日期</td>
                          <td><?php echo $row_RecordCart['ocfreightdate']; ?></td>
                          <td class="title_bg">帳號後5碼</td>
                          <td><?php echo $row_RecordCart['ocfreightno']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">貨運方式</td>
                          <td><?php require("require_manage_cart_index_transit.php"); ?></td>
                          <td class="title_bg">出貨狀態</td>
                          <td><?php echo $row_RecordCart['state'] ?>&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="title_bg">收貨地址</td>
                          <td colspan="3"><?php echo $row_RecordCart['ocaddr']; ?><?php if($row_RecordCart['ocCVSStoreName'] != "") { ?>【<?php echo $row_RecordCart['ocCVSStoreName']; // 商店名稱?><?php if($row_RecordCart['ocCVSStoreID'] != "") { ?> - <?php echo $row_RecordCart['ocCVSStoreID']; // 商店名稱?><?php } ?>】<?php } ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">預計出貨</td>
                          <td><?php echo $row_RecordCart['ocpaymentpredate']; ?></td>
                          <td class="title_bg">出貨日期</td>
                          <td><?php echo $row_RecordCart['ocpaymentdate']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">出貨單號</td>
                          <td><?php echo $row_RecordCart['ocpaymentno']; ?></td>
                          <td class="title_bg">收貨時間</td>
                          <td><?php echo $row_RecordCart['ocreceipt'] ?>&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="title_bg"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 備註資料</td>
                        </tr>
                        <tr>
                          <td class="title_bg">客戶備註</td>
                          <td colspan="3"><?php echo $row_RecordCart['ocnotes1']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">業者備註</td>
                          <td colspan="3"><?php echo $row_RecordCart['ocnotes2']; ?></td>
                        </tr>
                        <tr>
                          <td class="title_bg">業者備註</td>
                          <td colspan="3"><?php echo $row_RecordCart['ocnotes3']; ?></td>
                        </tr>
                        </tbody>
                      </table>
                                
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