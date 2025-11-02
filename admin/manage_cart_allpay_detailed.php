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
<?php include("../AllPay.Payment.Integration.php"); ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 即時付款狀態 <small>查看</small> 
      <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 狀態查看</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-10">
  	
<span style="padding:10px;	border: 0px solid #CCC; margin:5px; width:980px; margin-left:auto; margin-right:auto;">
<?php 
/*
* 查詢訂單的範例程式碼。
*/
try
{
$oPayment = new AllInOne();
/* 服務參數 */
/*$oPayment->ServiceURL = "http://payment-stage.allpay.com.tw/Cashier/QueryTradeInfo";
$oPayment->HashKey = "5294y06JbISpM5x9";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";
$oPayment->MerchantID ="2000132";*/

/* 正式 */
$oPayment->ServiceURL = "https://payment.ecpay.com.tw/Cashier/QueryTradeInfo";
$oPayment->HashKey = $row_RecordSystemConfigOtr['allpaypaymentHashKey'];
$oPayment->HashIV = $row_RecordSystemConfigOtr['allpaypaymentHashIV'];
$oPayment->MerchantID = $row_RecordSystemConfigOtr['allpaypaymentnumber'];
/* 基本參數 */
$oPayment->Query['MerchantTradeNo'] = $_GET['Serial'];//"<<您要查詢的訂單交易編號>>";
/* 查詢訂單 */
$arQueryFeedback = $oPayment ->QueryTradeInfo();
// 取回所有資料
//echo sizeof($arQueryFeedback);
if (sizeof($arQueryFeedback) > 0) { 
foreach ($arQueryFeedback as $key => $value) {
	//echo $key . "=" . $value . "###";
switch ($key)
{
/* 使用 Credit 定期定額交易時回傳的參數 */
case "MerchantID": $szMerchantID = $value; break;
case "MerchantTradeNo": $szMerchantTradeNo = $value; break;
case "TradeNo": $szTradeNo = $value; break;
case "TradeAmt": $szTradeAmt = $value; break;
case "PaymentDate": $szPaymentDate = $value; break;
case "HandlingCharge": $szHandlingCharge = $value; break;
case "PaymentType": $szPaymentType = $value; break;
case "PaymentTypeChargeFee": $szPaymentTypeChargeFee = $value; break;
case "TradeDate": $szTradeDate = $value; break;
case "TradeStatus": $szTradeStatus = $value; break;
case "ItemName": $szItemName = $value; break;
/* 使用 WebATM 交易時回傳的參數 */
case "WebATMAccBank": $szWebATMAccBank = $value; break;
case "WebATMAccNo": $szWebATMAccNo = $value; break;
/* 使用 ATM 交易時回傳的參數 */
case "ATMAccBank": $szATMAccBank = $value; break;
case "ATMAccNo": $szATMAccNo = $value; break;
/* 使用 CVS 或 BARCODE 交易時回傳的參數 */
case "PaymentNo": $szPaymentNo = $value; break;
case "PayFrom": $szPayFrom = $value; break;
/* 使用 Alipay 交易時回傳的參數 */
case "AlipayID": $szAlipayID = $value; break;
case "AlipayTradeNo": $szAlipayTradeNo = $value; break;
/* 使用 Tenpay 交易時回傳的參數 */
case "TenpayTradeNo": $szTenpayTradeNo = $value; break;
/* 使用 Credit 交易時回傳的參數 */
case "gwsr": $szGwsr = $value; break;
case "process_date": $szProcessDate = $value; break;
case "auth_code": $szAuthCode = $value; break;
case "amount": $szAmount = $value; break;
case "stage": $szStage = $value; break;
case "stast": $szStast = $value; break;
case "staed": $szStaed = $value; break;
case "eci": $szECI = $value; break;
case "card4no": $szCard4No = $value; break;
case "card6no": $szCard6No = $value; break;
case "red_dan": $szRedDan = $value; break;
case "red_de_amt": $szRedDeAmt = $value; break;
case "red_ok_amt": $szRedOkAmt = $value; break;
case "red_yet": $szRedYet = $value; break;
case "PeriodType": $szPeriodType = $value; break;
case "Frequency": $szFreqquency = $value; break;
case "ExecTimes": $szExecTimes = $value; break;
case "PeriodAmount": $szPeriodAmount = $value; break;
case "TotalSuccessTimes": $szTotalSuccessTimes = $value; break;
case "TotalSuccessAmount": $szTotalSuccessAmount = $value; break;
default: break;
}
}
// 其他資料處理。
//………
//echo "其他資料處理";
?>
</span> 　　　　　　　　　　　　　　　　　　
<table width="100%" class="table table-striped m-b-0">
                      <thead>
                        <tr>
                          <th colspan="2" align="center" class="btit"><strong>綠界線上付款狀態</strong></tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td width="150" class="tit"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本資訊</span></td>
                        <td class=""></td>
                        </tr>
                      <tr>
                        <td width="150" class="tit">交易編號</td>
                        <td class=""><?php echo $szMerchantTradeNo ?></td>
                        </tr>
                      <tr>
                        <td class="tit">交易金額</td>
                        <td class=""><?php echo $szTradeAmt ?></td>
                        </tr>
                      <tr>
                        <td class="tit">付款時間</td>
                        <td class=""><?php echo $szPaymentDate ?></td>
                        </tr>
                      <tr>
                        <td class="tit">付款方式</td>
                        <td class=""><?php
		switch ($szPaymentType)
		{
		case "None": echo "不指定"; break;
		case "WebATM_TAISHIN": echo "台新銀行(網路ATM)"; break;
		case "WebATM_ESUN": echo "玉山銀行(網路ATM)"; break;
		case "WebATM_HUANAN": echo "華南銀行(網路ATM)"; break;
		case "WebATM_BOT": echo "台灣銀行(網路ATM)"; break;
		case "WebATM_FUBON": echo "台北富邦(網路ATM)"; break;
		case "WebATM_CHINATRUST": echo "中國信託(網路ATM)"; break;
		case "WebATM_FIRST": echo "第一銀行(網路ATM)"; break;
		case "WebATM_CATHAY": echo "國泰世華(網路ATM)"; break;
		case "WebATM_MEGA": echo "兆豐銀行(網路ATM)"; break;
		case "WebATM_YUANTA": echo "元大銀行(網路ATM)"; break;
		case "WebATM_LAND": echo "土地銀行(網路ATM)"; break;
		case "ATM_TAISHIN": echo "台新銀行(自動櫃員機)"; break;
		case "ATM_ESUN": echo "玉山銀行(自動櫃員機)"; break;
		case "HUANAN": echo "華南銀行(自動櫃員機)"; break;
		case "ATM_BOT": echo "台灣銀行(自動櫃員機)"; break;
		case "ATM_FUBON": echo "台北富邦(自動櫃員機)"; break;
		case "ATM_CHINATRUST": echo "中國信託(自動櫃員機)"; break;
		case "ATM_FIRST": echo "第一銀行(自動櫃員機)"; break;
		case "CVS": echo "超商代碼繳款"; break;
		case "CVS_CVS": echo "超商代碼繳款"; break;
		case "CVS_OK": echo "OK超商代碼繳款"; break;
		case "CVS_FAMILY": echo "全家超商代碼繳款"; break;
		case "CVS_HILIFE": echo "萊爾富超商代碼繳款"; break;
		case "CVS_IBON": echo "7-11 ibon代碼繳款"; break;
		case "Alipay": echo "支付寶"; break;
		case "Tenpay": echo "財付通"; break;
		case "TopUpUsed_AllPay": echo "儲值/餘額消費(綠界)"; break;
		case "TopUpUsed_ESUN": echo "儲值/餘額消費(玉山)"; break;
		case "BARCODE": echo "超商條碼繳款"; break;
		case "BARCODE_BARCODE": echo "超商條碼繳款"; break;
		case "Credit": echo "信用卡(MasterCard/JCB/VISA)"; break;
		case "Credit_CreditCard": echo "信用卡(MasterCard/JCB/VISA)"; break;
		case "COD": echo "貨到付款"; break;
		default:  echo $szPaymentType; break;
		}
	?></td>
                        </tr>
                      <tr>
                        <td class="tit">手續費合計</td>
                        <td class=""><?php echo $szHandlingCharge ?></td>
                        </tr>
                      <tr>
                        <td class="tit">訂單成立時間</td>
                        <td class=""><?php echo $szTradeDate ?></td>
                        </tr>
                      <tr>
                        <td class="tit">交易狀態</td>
                        <td class="" style="color:#F00;"><?php
		switch ($szTradeStatus)
		{
		case "0": echo "訂單成立，等待付款"; break;
		case "1": echo "履約交易完成"; break;
		case "100": echo "已付款"; break;
		case "110": echo "等待退款給買家"; break;
		case "111": echo "等待匯款給賣家"; break;
		case "112": echo "出貨取消，等待退款"; break;
		case "113": echo "訂單取消退款"; break;
		case "114": echo "重新出貨準備中"; break;
		case "127": echo "等待買家同意退款"; break;
		case "2": echo "退款完成"; break;
		case "3": echo "部份退款完成"; break;
		case "300": echo "已出貨"; break;
		case "302": echo "商品異常等待處理"; break;
		case "340": echo "已付款交易取消中"; break;
		case "370": echo "通知賣家取消訂單"; break;
		case "700": echo "客服處理中"; break;
		default: break;
		}
	?></td>
                        </tr>
                      <tr>
                        <td class="tit">商品名稱</td>
                        <td class=""><?php echo $szItemName ?></td>
                        </tr>
                        <?php
		switch ($szPaymentType)
		{
		case "None": 
		case "WebATM_TAISHIN": 
		case "WebATM_ESUN": 
		case "WebATM_HUANAN": 
		case "WebATM_BOT": 
		case "WebATM_FUBON": 
		case "WebATM_CHINATRUST": 
		case "WebATM_FIRST": 
		case "WebATM_CATHAY": 
		case "WebATM_MEGA": 
		case "WebATM_YUANTA": 
		case "WebATM_LAND": 
	?>
                        <tr>
                        <td width="150" class="tit"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 付款資訊</span></td>
                        <td class=""></td>
                        </tr>
                        <tr>
                        <td width="100" class="tit">付款人銀行代碼</td>
                        <td class=""><?php echo $szWebATMAccBank ?></td>
                      </tr>
                      <tr>
                        <td class="tit">付款人銀行帳號後五碼</td>
                        <td class=""><?php echo $szWebATMAccNo ?></td>
                      </tr>
                      <tr>
                        <td width="100" class="tit">銀行名稱</td>
                        <td class=""><?php echo $szWebATMBankName ?></td>
                      </tr>
                      <?php
  		break;
		case "ATM_TAISHIN": 
		case "ATM_ESUN": 
		case "HUANAN": 
		case "ATM_BOT":
		case "ATM_FUBON": 
		case "ATM_CHINATRUST": 
		case "ATM_FIRST": 
	?>
                      <tr>
                        <td width="100" class="tit">付款人銀行代碼</td>
                        <td class=""><?php echo $szATMAccBank ?></td>
                      </tr>
                      <tr>
                        <td class="tit">付款人銀行帳號後五碼</td>
                        <td class=""><?php echo $szATMAccNo ?></td>
                      </tr>
                      <?php
  		break;
		case "CVS": 
		case "CVS_CVS": 
		case "CVS_OK": 
		case "CVS_FAMILY": 
		case "CVS_HILIFE": 
		case "CVS_IBON":
		case "BARCODE":
		case "BARCODE_BARCODE":
	?>
                      <tr>
                        <td width="100" class="tit">繳費代碼</td>
                        <td class=""><?php echo $szATMAccBank ?></td>
                      </tr>
                      <tr>
                        <td class="tit">繳費超商</td>
                        <td class=""><?php echo $szPayFrom ?></td>
                      </tr>
                      <?php
  		break;
		case "Alipay":
	?>
                      <tr>
                        <td width="100" class="tit">付款人在支付寶的系統編號</td>
                        <td class=""><?php echo $szAlipayID ?></td>
                      </tr>
                      <tr>
                        <td width="100" class="tit">支付寶交易編號</td>
                        <td class=""><?php echo $szAlipayTradeNo ?></td>
                      </tr>
                      <?php
  		break;
		case "Tenpay":
	?>
                      <tr>
                        <td width="100" class="tit">財付通交易編號</td>
                        <td class=""><?php echo $szTenpayTradeNo ?></td>
                      </tr>
                      <?php
  		break;
		case "Credit":
		case "Credit_CreditCard":	
	?>
                      <tr>
                        <td width="100" class="tit">授權交易單號</td>
                        <td class=""><?php echo $szgwsr ?></td>
                      </tr>
                      <tr>
                        <td class="tit">授權碼</td>
                        <td class=""><?php echo $szauth_code ?></td>
                      </tr>
                      <tr>
                        <td class="tit">卡片的末4碼</td>
                        <td class=""><?php echo $szcard4no ?></td>
                      </tr>
                      <tr>
                        <td class="tit">訂單處理動作</td>
                        <td class=""><?php echo $szPeriodType ?>C關帳。R退刷。E取消。N放棄。</td>
                      </tr>
                      <?php
  		break;
		default: break;
		}
	?>
                      </tbody>
                      
                    </table>
<span style="padding:10px;	border: 0px solid #CCC; margin:5px; width:980px; margin-left:auto; margin-right:auto;">
<?php 
} else {
// 其他資料處理。
//………
echo "無此訂單";
}
}
catch (Exception $e)
{
// 例外錯誤處理。
echo "例外錯誤處理";
}
?>
</span> 
  
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
		$("#__paymentButton").addClass("btn btn-primary btn-block");
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