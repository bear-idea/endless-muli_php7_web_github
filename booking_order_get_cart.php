<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once('allpay_get_admin.php'); ?>
<?php include("ECPay.Payment.Integration.php"); ?>
<?php 
/*
* 接收訂單資料產生完成的範例程式碼。
*/
try
{
$oPayment = new ECPay_AllInOne();
/* 服務參數 */
/*$oPayment->HashKey = "5294y06JbISpM5x9";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";
$oPayment->MerchantID ="2000132";*/
/* 正式 */
$oPayment->HashKey = $HashKey;
$oPayment->HashIV = $HashIV;
$oPayment->MerchantID = $MerchantID;
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
 ?>
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

$colname_RecordCartOrder = "-1";
if (isset($szMerchantTradeNo)) {
  $colname_RecordCartOrder = $szMerchantTradeNo;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartOrder = sprintf("SELECT * FROM demo_cartorders WHERE oserial = %s", GetSQLValueString($colname_RecordCartOrder, "text"));
$RecordCartOrder = mysqli_query($DB_Conn, $query_RecordCartOrder) or die(mysqli_error($DB_Conn));
$row_RecordCartOrder = mysqli_fetch_assoc($RecordCartOrder);
$totalRows_RecordCartOrder = mysqli_num_rows($RecordCartOrder);

$w_userid = $row_RecordCartOrder['userid'];
?>
<?php 

/*更改成此份訂單已修改*/

      if($szRtnCode == "1") {$returnstate = "付款成功";$ocfreightstate=2;}else{$returnstate = "付款失敗";$ocfreightstate=1;}

	  $updateSQLCheck = sprintf("UPDATE demo_cartorders SET returnstate=%s ocfreightstate=%s WHERE oid=%s",
						 GetSQLValueString($returnstate, "text"),
						 GetSQLValueString($ocfreightstate, "int"),
						 GetSQLValueString($row_RecordCartOrder['oid'], "int"));	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result2 = mysqli_query($DB_Conn, $updateSQLCheck) or die(mysqli_error($DB_Conn));

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

mysqli_free_result($RecordCartOrder);
?>
