<?php require_once('../Connections/DB_Conn.php'); ?>
<?php //require_once('allpay_get_admin.php'); ?>
<?php include("ECPay.Logistics.Integration.php"); ?>
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

$colwebname_RecordAllpayData = "-1";
if (isset($_GET['wshop'])) {
  $colwebname_RecordAllpayData = $_GET['wshop'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAllpayData = sprintf("SELECT allpayfreightHashKey, allpayfreightHashIV, allpaypaymentnumber FROM demo_setting_otr WHERE userid = (SELECT id FROM demo_admin WHERE webname=%s)", GetSQLValueString($colwebname_RecordAllpayData, "text"));
$RecordAllpayData = mysqli_query($DB_Conn, $query_RecordAllpayData) or die(mysqli_error($DB_Conn));
$row_RecordAllpayData = mysqli_fetch_assoc($RecordAllpayData);
$totalRows_RecordAllpayData = mysqli_num_rows($RecordAllpayData);

$HashKey = $row_RecordAllpayData['allpayfreightHashKey']; 
$HashIV = $row_RecordAllpayData['allpayfreightHashIV']; 
$MerchantID = $row_RecordAllpayData['allpaypaymentnumber'];

?>
<?php 

try{
$oLogistics = new ECPayLogistics();
/* 服務參數 */
$oLogistics->HashKey = $HashKey;
$oLogistics->HashIV = $HashIV;
$oLogistics->MerchantID = $MerchantID;
/* 取得回傳參數 */
$arFeedback = $oLogistics->CheckOutFeedback();
/* 檢核與變更訂單狀態 */
if (sizeof($arFeedback) > 0) {
foreach ($arFeedback as $key => $value) {
switch ($key)
{
/* 支付後的回傳的基本參數 */
case "MerchantID": $szMerchantID = $value; break;
case "MerchantTradeNo": $szMerchantTradeNo = $value; break;
case "RtnCode": $szRtnCode = $value; break;
case "RtnMsg": $szRtnMsg = $value; break;
case "AllPayLogisticsID": $szAllPayLogisticsID = $value; break;
case "LogisticsType": $szLogisticsType = $value; break;
case "LogisticsSubType": $szLogisticsSubType = $value; break;
case "SimulatePaid": $szSimulatePaid = $value; break;
case "GoodsAmount": $szGoodsAmount = $value; break;
case "TradeDate": $szTradeDate = $value; break;
case "UpdateStatusDate": $szUpdateStatusDate = $value; break;
case "ReceiverName": $szReceiverName = $value; break;
case "ReceiverPhone": $szReceiverPhone = $value; break;
case "ReceiverCellPhone": $szReceiverCellPhone = $value; break;
case "ReceiverEmail": $szReceiverEmail = $value; break;
case "ReceiverAddress": $szReceiverAddress = $value; break;
case "CVSPaymentNo": $szCVSPaymentNo = $value; break;
case "CVSValidationNo": $szCVSValidationNo = $value; break;
case "BookingNote": $szBookingNote = $value; break;
default: break;
}
}
// 其他資料處理。
// AllPayLogisticsID
	  $updateSQL = sprintf("UPDATE demo_cartorders SET ocAllPayLogisticsID=%s WHERE oserial=%s",
                       GetSQLValueString($szAllPayLogisticsID, "text"),
                       GetSQLValueString($_GET['oserial'], "text"));

      $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	  /*$updateSQLCheck = sprintf("UPDATE demo_exmodcartdetail SET beused=%s WHERE did=%s",
						 GetSQLValueString("1", "int"),
						 GetSQLValueString($row_RecordCartOrder['did'], "int"));	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result2 = mysqli_query($DB_Conn, $updateSQLCheck) or die(mysqli_error($DB_Conn));*/
print '1|OK';
} else {print '0|Fail';}
}
catch (Exception $e){
// 例外錯誤處理。
print '0|' . $e->getMessage();
}

//echo "123";

//mysqli_free_result($RecordCartOrder);
?>
