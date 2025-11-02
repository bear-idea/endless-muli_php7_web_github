<?php include_once("AllPay.Payment.Integration.php"); ?>
<?php
/*
* 產生訂單的範例程式碼。
*/
try
{
$oPayment = new AllInOne();
/* 服務參數 */      
//$oPayment->ServiceMethod = HttpMethod::HttpPOST;      
$oPayment->ServiceURL = "http://payment-stage.ecpay.com.tw/Cashier/AioCheckOut";//"<<您要呼叫的服務位址>>";
$oPayment->HashKey = "5294y06JbISpM5x9";//"<<AllPay提供給您的Hash Key>>";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";//"<<AllPay提供給您的Hash IV>>";
$oPayment->MerchantID = "2000132";//"<<AllPay提供給您的特店編號>>";
/* 基本參數 */
$oPayment->Send['ReturnURL'] = "http://www.shop3500.com/AllPayResultOrder.php";
$oPayment->Send['ClientBackURL'] = "";
$oPayment->Send['OrderResultURL'] = "";
$oPayment->Send['MerchantTradeNo'] = "VTest" . time();//"<<您此筆訂單交易編號>>";
$oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
$oPayment->Send['TotalAmount'] = (int) "100";//"<<您此筆訂單的交易總金額>>";
$oPayment->Send['TradeDesc'] = "交易測試";
$oPayment->Send['ChoosePayment'] = "ALL";
$oPayment->Send['Remark'] = "交易測試";
$oPayment->Send['ChooseSubPayment'] = "None";
$oPayment->Send['NeedExtraPaidInfo'] = "No";
$oPayment->Send['DeviceSource'] = "PC";
$oPayment->Send['IgnorePayment'] = "";//"<<您不要顯示的付款方式>>"; // 例(排除支付寶與財富通): Alipay#Tenpay
// 加入選購商品資料。
array_push($oPayment->Send['Items'], array('Name' => "產品", 'Price' => (int) "500"/*"<<單價>>"*/,
'Currency' => "NTD", 'Quantity' => (int) "10"/*"<<數量>>"*/, 'URL' => "http://www.google.com.tw"));
//array_push($oPayment->Send['Items'], array('Name' => "產品A", 'Price' => (int)"11"/*"<<單價>>"*/,
//'Currency' => "NTD", 'Quantity' => (int) "1"/*"<<數量>>"*/, 'URL' => "產品說明位址"));
/* 產生訂單 */
$oPayment->CheckOut();
/* 產生產生訂單 Html Code 的方法 */
$szHtml = $oPayment->CheckOutString();
}
catch (Exception $e)
{
// 例外錯誤處理。
throw $e;
}
?>