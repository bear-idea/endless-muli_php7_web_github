<?php include_once("AllPay.Payment.Integration.php"); ?>
<?php
/*
* 接收訂單資料產生完成的範例程式碼。
*/
try
{
$oPayment = new AllInOne();
/* 服務參數 */
$oPayment->HashKey = "5294y06JbISpM5x9";//"<<AllPay提供給您的Hash Key>>";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";//"<<AllPay提供給您的Hash IV>>";
$oPayment->MerchantID = "2000132";//"<<AllPay提供給您的特店編號>>";
/* 取得回傳參數 */
$arFeedback = $oPayment->CheckOutFeedback();
/* 檢核與變更訂單狀態 */
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
print '1|OK';
} else {
print '0|Fail';
}
}
catch (Exception $e)
{
// 例外錯誤處理。
print '0|' . $e->getMessage();
}
?>