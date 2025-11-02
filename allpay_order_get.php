<?php require_once('Connections/DB_Conn.php'); ?>
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

  
?>
<?php include("AllPay.Payment.Integration.php"); ?>
<?php 
/*
* 接收訂單資料產生完成的範例程式碼。
*/
try
{
$oPayment = new AllInOne();
/* 服務參數 */
$oPayment->HashKey = "5294y06JbISpM5x9";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";
$oPayment->MerchantID ="2000132";
/* 正式 */
/*$oPayment->HashKey = "5AoputFBfqhcCRD9";
$oPayment->HashIV = "XsPpSIZm3XMjodnr";
$oPayment->MerchantID ="1050060";*/
/* 取得回傳參數 */
$arFeedback = $oPayment->CheckOutFeedback();
/* 檢核與變更訂單狀態 */

//echo sizeof($arFeedback);
if (sizeof($arFeedback) > 0) {
foreach ($arFeedback as $key => $value) {
switch ($key)
{
/* 支付後的回傳的基本參數 */
case "MerchantID": $szMerchantID = $value; break;
case "MerchantTradeNo": $szMerchantTradeNo = $value; break;
case "PaymentDate": $szPaymentDate = $value; break;
case "PaymentType": $szPaymentType = $value; break;
case "PaymentTypeChargeFee": $szPaymentTypeChargeFee = $value; break;
case "RtnCode": $szRtnCode = $value; break;
case "RtnMsg": $szRtnMsg = $value; break;
case "SimulatePaid": $szSimulatePaid = $value; break;
case "TradeAmt": $szTradeAmt = $value; break;
case "TradeDate": $szTradeDate = $value; break;
case "TradeNo": $szTradeNo = $value; break;
default: break;
}
}
// 其他資料處理。
//………
  $updateSQL = sprintf("UPDATE test SET visit=visit+1 WHERE id=%s",
                       GetSQLValueString("1", "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  ob_get_clean();
  print '1|OK';

} else {
print '0|Fail';
//echo $arFeedback;
}
}
catch (Exception $e)
{
// 例外錯誤處理。
print '0|' . $e->getMessage();
}
?>