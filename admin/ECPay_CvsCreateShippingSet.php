<?php 
//$UseMod = "Tmp"; // 目前使用模組
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

$coluserid_RecordSystemConfigOtr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSystemConfigOtr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfigOtr = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfigOtr, "int"));
$RecordSystemConfigOtr = mysqli_query($DB_Conn, $query_RecordSystemConfigOtr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigOtr = mysqli_fetch_assoc($RecordSystemConfigOtr);
$totalRows_RecordSystemConfigOtr = mysqli_num_rows($RecordSystemConfigOtr);
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 綠界物流訂單 <small>建立</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 訂單建立</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action="ECPay_CvsCreateShippingOrder.php?Serial=<?php echo $row_RecordCart['oserial']; ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" id="form_Tmp" name="form_Tmp">
  　　<div class="form-group row">
          <label class="col-md-2 col-form-label">廠商編號<span class="text-red">*</span></label>
          <div class="col-md-10">			
                   <?php echo $row_RecordSystemConfigOtr['allpaypaymentnumber']; ?>   
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">買家取貨方式<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="LogisticsType" id="LogisticsType" class="form-control">
             	 <option value="CSV">超商取貨</option>
              </select>     
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">賣家寄貨方式<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="LogisticsSubType" id="LogisticsSubType" class="form-control">
             	 <?php if ($row_RecordCart['ocfreightselect'] == "familyshop" || $row_RecordCart['ocfreightselect'] == "familyshopnopay") { ?>  
					  <?php if($row_RecordSystemConfigOtr['allshopuseC2C'] == "1") { ?>
                      <option value="FAMIC2C">全家超商門市寄件 - 至鄰近超商門市繳費寄件</option>
                      <?php } else { ?>
                      <option value="FAMI">全家大宗寄倉 - 自行將包裹寄送至物流中心待配送</option>
                      <?php } ?>
                  <?php } ?>
                  <?php if ($row_RecordCart['ocfreightselect'] == "sevenshop" || $row_RecordCart['ocfreightselect'] == "sevenshopnopay") { ?>
                      <?php if($row_RecordSystemConfigOtr['allshopuseC2C'] == "1") { ?>
                      <option value="UNIMARTC2C">7-11超商門市寄件 - 至鄰近超商門市繳費寄件</option>
                      <?php } else { ?>
                      <option value="UNIMART">7-11大宗寄倉 - 自行將包裹寄送至物流中心待配送</option>
                      <?php } ?>
                  <?php } ?>
              </select>     
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">商品總金額</label>
          <div class="col-md-10">
		  <?php         $pricedesc = "商品價格".$row_RecordCart['ocpdprice'];
						if ($row_RecordCart['ocfreightprice'] != "") {
							$pricedesc .= "+運費".$row_RecordCart['ocfreightprice'];
						}
						if ($row_RecordCart['ocotherprice'] != "") { 
						$pricedesc .= "+金物流加收".$row_RecordCart['ocotherprice'];
						}
						if ($row_RecordCart['ocexprice'] != "" && $row_RecordCart['ocexprice'] != "0") { 
						$pricedesc .= "+自訂額外費用".$row_RecordCart['ocexprice']; 
						}
						if ($row_RecordCart['ocinvoiceprice'] != "" && $row_RecordCart['ocinvoiceprice'] != 0) { 
						$pricedesc .= "+5%發票稅".$row_RecordCart['ocinvoiceprice'];
						} 
						if ($row_RecordCart['ocDiscountShowAlldiscount_type_5'] != "" && $row_RecordCart['ocDiscountShowAlldiscount_type_5'] != 0) {
						$pricedesc .= "-全單滿額折扣".$row_RecordCart['ocDiscountShowAlldiscount_type_5'];
						}
						if ($row_RecordCart['ocDiscountShowAlldiscount_type_6'] != "" && $row_RecordCart['ocDiscountShowAlldiscount_type_6'] != 0) { 
						$pricedesc .= "-全單滿額減價".$row_RecordCart['ocDiscountShowAlldiscount_type_6']; 
						}
						$GoodsAmount = (int)$row_RecordCart['ocpdprice']+(int)$row_RecordCart['ocfreightprice']+(int)$row_RecordCart['ocotherprice']+(int)$row_RecordCart['ocexprice']+(int)$row_RecordCart['ocinvoiceprice']-(int)$row_RecordCart['ocDiscountShowAlldiscount_type_5']-(int)$row_RecordCart['ocDiscountShowAlldiscount_type_6'];
		  ?>
		  <?php echo $GoodsAmount; ?> <i class="fa fa-info-circle text-orange" data-original-title="<?php echo $pricedesc;?>" data-toggle="tooltip" data-placement="top"></i>
          <small>7-11商品金額範圍限制為 1~19,999 元，其餘商店為 1~20,000 元</small>
          <input name="GoodsAmount" type="hidden" id="GoodsAmount" value="<?php echo $GoodsAmount; ?>" />
                            
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">是否代收款<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="IsCollection" id="IsCollection" class="form-control">
             	  <?php if ($row_RecordCart['ocpaymentselect'] == "payondelivery") { ?>
                  <option value="Y">是 - 買家取貨付款</option>
                  <?php } else { ?>
                  <option value="N">否 - 純配送</option>
                  <?php } ?>
              </select>     
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">商品名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="GoodsName" type="text" class="form-control" id="GoodsName" value="網路商品" maxlength="50" data-parsley-trigger="blur" required />
                      <small>請自行修改名稱，限制5０個字元</small>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">寄件者姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="SenderName" type="text" class="form-control" id="SenderName" value="<?php echo $row_RecordSystemConfigOtr['allshopsender']; ?>" data-parsley-pattern="/^[\u4e00-\u9fa5]{1,5}$|^[\A-Za-z]{1,10}$/" data-parsley-pattern-message="限制5個中文字/10個英文字" maxlength="10" data-parsley-trigger="blur" required />
                      <small>限制5個中文字/10個英文字</small>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">寄件人手機號碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="SenderCellPhone" type="text" class="form-control" id="SenderCellPhone" value="<?php echo $row_RecordSystemConfigOtr['allshopsendercell']; ?>" maxlength="20" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" data-parsley-trigger="blur" required />
                      <small>只允許數字、10 碼、09 開頭</small>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">收件者姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="ReceiverName" type="text" class="form-control" id="ReceiverName" value="<?php echo $row_RecordCart['ocname']; ?>" data-parsley-pattern="/^[\u4e00-\u9fa5]{1,5}$|^[\A-Za-z]{1,10}$/" data-parsley-pattern-message="限制5個中文字/10個英文字" maxlength="10" data-parsley-trigger="blur" required />
                      <small>限制5個中文字/10個英文字</small>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">收件人手機號碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="ReceiverCellPhone" type="text" class="form-control" id="ReceiverCellPhone" value="<?php echo $row_RecordCart['ocphone']; ?>" maxlength="20" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" data-parsley-trigger="blur" required />
                      <small>只允許數字、10 碼、09 開頭</small>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">下一步 - 檢視填寫資訊及送出</button>
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
mysqli_free_result($RecordCart);

mysqli_free_result($RecordCartDetailed);

mysqli_free_result($RecordCartListFreight);

mysqli_free_result($RecordSystemConfigOtr);
?>