<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once('paypal_order_get_key.php'); ?>
<?php 
if(file_exists( dirname(__FILE__). '/vendor/autoload.php')) {
	require 'vendor/autoload.php';
	} else {
	//require 'PPAutoloader.php';
		PPAutoloader::register();
	}
use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\AddressType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\EBLBaseComponents\PaymentDetailsItemType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
?>
<?php 
ob_start(); // 開啟輸出緩衝區
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php //require_once('admin/upload_get_admin.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO demo_cartorders (oserial, ocname, ocaddr, ocphone, ocmail, ocgender, ocbuyname, ocbuyphone, ocbuytel, ocbuymail, ocbuygender, ocpdprice, octel, ocrfreight, ocfreightprice, ocinvoiceformat, ocinvoiceetselect, ocinvoicesupportno, ocinvoiceloveno, ocinvoicecompanyno, ocinvoicetitle, ocinvoiceusername, ocinvoiceaddr, ocinvoiceprice, ocfreepriceok, ocfreepricedesc, ocexpriceselect, ocexpricename, ocexprice, ocpaymentselect, ocfreightselect, ocreceipt, ocfreightdesc, ocotherprice, oczip, occounty, ocdistrict, octotal, postdate, ocnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['ocname'], "text"),
                       GetSQLValueString($_POST['ocaddr'], "text"),
                       GetSQLValueString($_POST['ocphone'], "text"),
                       GetSQLValueString($_POST['ocmail'], "text"),
					   GetSQLValueString($_POST['ocgender'], "text"),				   
					   GetSQLValueString($_POST['ocbuyname'], "text"),
					   GetSQLValueString($_POST['ocbuyphone'], "text"),
					   GetSQLValueString($_POST['ocbuytel'], "text"),
					   GetSQLValueString($_POST['ocbuymail'], "text"),
					   GetSQLValueString($_POST['ocbuygender'], "text"),	   
                       GetSQLValueString($_POST['ocpdprice'], "text"),
                       GetSQLValueString($_POST['octel'], "text"),
					   GetSQLValueString($_POST['ocrfreight'], "text"),
                       GetSQLValueString($_POST['ocfreightprice'], "text"),
					   GetSQLValueString($_POST['ocinvoiceformat'], "text"),
					   GetSQLValueString($_POST['ocinvoiceetselect'], "int"),
					   GetSQLValueString($_POST['ocinvoicesupportno'], "text"),
					   GetSQLValueString($_POST['ocinvoiceloveno'], "text"),
					   GetSQLValueString($_POST['ocinvoicecompanyno'], "text"),
					   GetSQLValueString($_POST['ocinvoicetitle'], "text"),
					   GetSQLValueString($_POST['ocinvoiceusername'], "text"),
					   GetSQLValueString($_POST['ocinvoiceaddr'], "text"),
					   GetSQLValueString($_POST['ocinvoiceprice'], "text"),
					   GetSQLValueString($_POST['ocfreepriceok'], "int"),
					   GetSQLValueString($_POST['ocfreepricedesc'], "text"),
					   GetSQLValueString($_POST['ocexpriceselect'], "int"),
					   GetSQLValueString($_POST['ocexpricename'], "text"),
					   GetSQLValueString($_POST['ocexprice'], "text"),
					   GetSQLValueString($_POST['ocpaymentselect'], "text"),
					   GetSQLValueString($_POST['ocfreightselect'], "int"),
					   GetSQLValueString($_POST['ocreceipt'], "text"),
					   GetSQLValueString($_POST['ocfreightdesc'], "text"),
					   GetSQLValueString($_POST['ocotherprice'], "int"),
                       GetSQLValueString($_POST['oczip'], "text"),
					   GetSQLValueString($_POST['occounty'], "text"),
					   GetSQLValueString($_POST['ocdistrict'], "text"),
                       GetSQLValueString($_POST['octotal'], "int"),
                       GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['ocnotes1'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	foreach($_POST['dcproductname'] as $i => $val){	
  $insertSQL = sprintf("INSERT INTO demo_cartdetail (dcserial, pdseries, dcproductname, dcprice, dcquantiry, dcitemtotal, dcformat, dcnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['pdseries'][$i], "text"),
                       GetSQLValueString($_POST['dcproductname'][$i], "text"),
                       GetSQLValueString($_POST['dcprice'][$i], "text"),
                       GetSQLValueString($_POST['dcquantiry'][$i], "text"),
                       GetSQLValueString($_POST['dcitemtotal'][$i], "text"),
					   GetSQLValueString($_POST['dcformat'][$i], "text"),
					   GetSQLValueString($_POST['dcnotes1'][$i], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	}
	
	//foreach($_POST['dcproductname'] as $i => $val){
	if(is_array($_POST['dcproductplusname']) && !empty($_POST['dcproductplusname'])){
	  foreach($_POST['dcproductplusname'] as $k => $val2) {
		  $insertSQL = sprintf("INSERT INTO demo_cartdetail (dcserial, dcstate, dcproductname, dcprice, dcquantiry, dcitemtotal, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
					   GetSQLValueString(1, "int"),
                       GetSQLValueString($_POST['dcproductplusname'][$k], "text"),
                       GetSQLValueString($_POST['dcproductplusprice'][$k], "text"),
                       GetSQLValueString($_POST['dcproductplusquantity'][$k], "text"),
					   GetSQLValueString($_POST['dcplusitemtotal'][$k], "text"),
                       GetSQLValueString($_POST['userid'], "int"));
					   //mysqli_select_db($database_DB_Conn, $DB_Conn);
  					   $Result2 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  }
	}
  //}

		// $insertGoTo = "allpay_order_send_cart.php";

	  
  /* 清空購物車 */
  if(is_array($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['ID']) && !empty($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['ID'])){
  foreach($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val){
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Name'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Price'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Notes1'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Format'][$i]);
	}
  }
	unset ($_SESSION['OrderID']); // 清除訂單編號
	
	if(is_array($_SESSION['PlusId']) && !empty($_SESSION['PlusId'])){
	foreach($_SESSION['PlusId'] as $i => $val1){
		foreach($val1 as $j => $val2){
			unset ($_SESSION['PlusId'][$i][$j]);
			unset ($_SESSION['PlusName'][$i][$j]);
			unset ($_SESSION['PlusPrice'][$i][$j]);
			unset ($_SESSION['PlusQuantity'][$i][$j]);
			unset ($_SESSION['PlusitemTotal'][$i][$j]);
		}
	}
	}
	
	  // <!-- ╭─────────────────────────────────────╮ -->
	  // 發送訂購通知(購買人)
	  /*$DefaultSiteUrl = $_SERVER['HTTP_HOST'];
	  $Url = "http://" . $DefaultSiteUrl . "/cart_orders_see.php?wshop=" . $_POST['wshop']. "&Serial=" . $_POST['D_OrderID'];
	  $Body = "親愛的 " . $_POST['ocname'] . " 您好！\n" 
			. "歡迎您在『" . $SiteName . "』購物。\n"
			. "您的訂單編號：" . $_POST['D_OrderID'] . " \n"
			. "訂購日期：" . $_POST['postdate'] . "\n"
			. "以下為您所訂購知詳細資料！\n\n"
			. "以下為所訂購詳細資訊\n\n"
			. "連結為" . $Url . " \n\n"
			. "本信件為系統自動發送(請勿回信！！！)";
	
	  $From= "From: " . "=?UTF-8?B?" . base64_encode($SiteName) . "?=" . " <" . $_POST['ocmail'] . "> \n\r";
	  $Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
	  $Header = $From . $Type;
	  $Subject = "=?UTF-8?B?" . base64_encode($SiteName . " 訂購成功確認通知") . "?=";
		
	  mail($_POST['ocmail'], $Subject, $Body, $Header);
	  
	  // 發送訂購通知(商家)
	  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
	  $Url = "http://" . $DefaultSiteUrl . "/cart_orders_see.php?wshop=" . $_POST['wshop']. "&Serial=" . $_POST['D_OrderID'];
	  $Body = "您的客戶 " . $_POST['ocname'] . "！於您的網站購物\n" 
			. "訂單編號：" . $_POST['D_OrderID'] . "\n"
			. "訂購日期：" . $_POST['postdate'] . "\n"
			. "以下為所訂購詳細資訊\n\n"
			. "連結為" . $Url
			. "";
	
	  $From= "From: " . "=?UTF-8?B?" . base64_encode($SiteName) . "?=" . " <" . $SiteMail . "> \n\r";
	  $Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
	  $Header = $From . $Type;
	  $Subject = "=?UTF-8?B?" . base64_encode($SiteName . " 訂購通知") . "?=";
		
	  mail($SiteMail, $Subject, $Body, $Header); 
	  //
	  header(sprintf("Location: %s", $insertGoTo));*/
	  
  ob_end_flush(); // 輸出緩衝區結束
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>訂單送出</title>
</head>
<body>
<?php
/*
 * The SetExpressCheckout API operation initiates an Express Checkout transaction
 * This sample code uses Merchant PHP SDK to make API call
 */
$url = dirname('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']);
$returnUrl = "$url/GetExpressCheckout.php";
$cancelUrl = "$url/SetExpressCheckout.php" ;

$currencyCode = "TWD"; //$_POST['currencyCode'];
// total shipping amount
if($_POST['ocfreightprice'] != '') {
	if($_POST['ocfreepriceok'] == '1' && $_POST['ocfreightprice'] == '0')
	{
		$shippingTotal = new BasicAmountType($currencyCode, ""); // 運費(滿額免運)
	}else{
		$shippingTotal = new BasicAmountType($currencyCode, ""); // 運費
	}
}
//total handling amount if any
$handlingTotal = new BasicAmountType($currencyCode, "");
//total insurance amount if any
$insuranceTotal = new BasicAmountType($currencyCode, "");

// shipping address // 郵寄地址
$address = new AddressType();
//$address->CityName = $_POST['ocaddr'];
$address->Name = $_POST['ocname'];
//$address->Street1 = $_POST['street'];
//$address->StateOrProvince = $_POST['state'];
//$address->PostalCode = $_POST['postalCode'];
//$address->Country = $_POST['countryCode'];
$address->Phone = $_POST['octel'];

// details about payment
$paymentDetails = new PaymentDetailsType();
$itemTotalValue = 0;
$taxTotalValue = 0;
/*
 * iterate trhough each item and add to atem detaisl
 */
 
foreach($_POST['dcproductname'] as $i => $val){	
	$itemAmount = new BasicAmountType($currencyCode, $_POST['dcprice'][$i]);	
	$itemTotalValue += $_POST['dcprice'][$i] * $_POST['dcquantiry'][$i]; 
	//$taxTotalValue += $_POST['itemSalesTax'][$i] * $_POST['dcquantiry'][$i]; // 銷售稅
	$itemDetails = new PaymentDetailsItemType();
	$itemDetails->Name = $_POST['dcproductname'][$i];
	$itemDetails->Amount = $_POST['dcprice'][$i];
	$itemDetails->Quantity = $_POST['dcquantiry'][$i];
	/*
	 * Indicates whether an item is digital or physical. For digital goods, this field is required and must be set to Digital. It is one of the following values:

    Digital

    Physical

	 */
	$itemDetails->ItemCategory = ""; // 
	//$itemDetails->Tax = new BasicAmountType($currencyCode, $_POST['itemSalesTax'][$i]);	
	
	$paymentDetails->PaymentDetailsItem[$i] = $itemDetails;	
}

if($_POST['ocotherprice'] != '0' && $_POST['ocotherprice'] != '') {
array_push($paymentDetails->PaymentDetailsItem, array('Name' => "金物流加收", 'Amount' => (int) $_POST['ocotherprice'], 'Quantity' => (int) "1"));
}
if($_POST['ocexprice'] != '0' && $_POST['ocexprice'] != '') {
array_push($paymentDetails->PaymentDetailsItem, array('Name' => $_POST['ocexpricename'], 'Amount' => (int) $_POST['ocexprice'], 'Quantity' => (int) "1"));
}
if($_POST['ocinvoiceprice'] != '0' && $_POST['ocinvoiceprice'] != '') {
array_push($paymentDetails->PaymentDetailsItem, array('Name' => "營業稅", 'Amount' => (int) $_POST['ocinvoiceprice'], 'Quantity' => (int) "1"));
}

/*
 * The total cost of the transaction to the buyer. If shipping cost and tax charges are known, include them in this value. If not, this value should be the current subtotal of the order. If the transaction includes one or more one-time purchases, this field must be equal to the sum of the purchases. If the transaction does not include a one-time purchase such as when you set up a billing agreement for a recurring payment, set this field to 0.
 */
$orderTotalValue = $shippingTotal->value + $handlingTotal->value +
$insuranceTotal->value +
$itemTotalValue + $taxTotalValue;

//Payment details
$paymentDetails->ShipToAddress = $address;
$paymentDetails->ItemTotal = new BasicAmountType($currencyCode, $itemTotalValue);
$paymentDetails->TaxTotal = new BasicAmountType($currencyCode, $taxTotalValue);
$paymentDetails->OrderTotal = new BasicAmountType($currencyCode, $orderTotalValue);

/*
 * How you want to obtain payment. When implementing parallel payments, this field is required and must be set to Order. When implementing digital goods, this field is required and must be set to Sale. If the transaction does not include a one-time purchase, this field is ignored. It is one of the following values:

    Sale ?This is a final sale for which you are requesting payment (default).

    Authorization ?This payment is a basic authorization subject to settlement with PayPal Authorization and Capture.

    Order ?This payment is an order authorization subject to settlement with PayPal Authorization and Capture.

 */
$_POST['paymentType'] = "Sale";
$paymentDetails->PaymentAction = $_POST['paymentType'];

$paymentDetails->HandlingTotal = $handlingTotal;
$paymentDetails->InsuranceTotal = $insuranceTotal;
$paymentDetails->ShippingTotal = $shippingTotal; // 運費

/*
 *  Your URL for receiving Instant Payment Notification (IPN) about this transaction. If you do not specify this value in the request, the notification URL from your Merchant Profile is used, if one exists.
 */
if(isset($_POST['notifyURL']))
{
	$paymentDetails->NotifyURL = $_POST['notifyURL'];
}

$setECReqDetails = new SetExpressCheckoutRequestDetailsType();
$setECReqDetails->PaymentDetails[0] = $paymentDetails;
/*
 * (Required) URL to which the buyer is returned if the buyer does not approve the use of PayPal to pay you. For digital goods, you must add JavaScript to this page to close the in-context experience.
 */
$setECReqDetails->CancelURL = $cancelUrl;
/*
 * (Required) URL to which the buyer's browser is returned after choosing to pay with PayPal. For digital goods, you must add JavaScript to this page to close the in-context experience.
 */
$setECReqDetails->ReturnURL = $returnUrl;

/*
 * Determines where or not PayPal displays shipping address fields on the PayPal pages. For digital goods, this field is required, and you must set it to 1. It is one of the following values:

    0 ?PayPal displays the shipping address on the PayPal pages.

    1 ?PayPal does not display shipping address fields whatsoever.

    2 ?If you do not pass the shipping address, PayPal obtains it from the buyer's account profile.

 */
$setECReqDetails->NoShipping = $_POST['noShipping'];
/*
 *  (Optional) Determines whether or not the PayPal pages should display the shipping address set by you in this SetExpressCheckout request, not the shipping address on file with PayPal for this buyer. Displaying the PayPal street address on file does not allow the buyer to edit that address. It is one of the following values:

    0 ?The PayPal pages should not display the shipping address.

    1 ?The PayPal pages should display the shipping address.

 */
$setECReqDetails->AddressOverride = $_POST['addressOverride'];

/*
 * Indicates whether or not you require the buyer's shipping address on file with PayPal be a confirmed address. For digital goods, this field is required, and you must set it to 0. It is one of the following values:

    0 ?You do not require the buyer's shipping address be a confirmed address.

    1 ?You require the buyer's shipping address be a confirmed address.

 */
$setECReqDetails->ReqConfirmShipping = $_POST['reqConfirmShipping'];

// Billing agreement details
$billingAgreementDetails = new BillingAgreementDetailsType($_POST['billingType']);
$billingAgreementDetails->BillingAgreementDescription = $_POST['billingAgreementText'];
$setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);

// Display options
$setECReqDetails->cppheaderimage = "";
$setECReqDetails->cppheaderbordercolor = "";
$setECReqDetails->cppheaderbackcolor = "";
$setECReqDetails->cpppayflowcolor = "";
$setECReqDetails->cppcartbordercolor = "";
$setECReqDetails->cpplogoimage = "";
$setECReqDetails->PageStyle = "";
$setECReqDetails->BrandName = "";

// Advanced options
$setECReqDetails->AllowNote = "";

$setECReqType = new SetExpressCheckoutRequestType();
$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
$setECReq = new SetExpressCheckoutReq();
$setECReq->SetExpressCheckoutRequest = $setECReqType;

/*
 * 	 ## Creating service wrapper object
Creating service wrapper object to make API call and loading
Configuration::getAcctAndConfig() returns array that contains credential and config parameters
*/


$config = array( 
    "mode" => "live",
    "acct1.UserName" => $paypalpaymentApiname,
	"acct1.Password" => $paypalpaymentApipsw,
	"acct1.Signature" => $paypalpaymentSignature
); 


$paypalService = new PayPalAPIInterfaceServiceService($config);


try {
	/* wrap API method calls on the service object with a try catch */
	$setECResponse = $paypalService->SetExpressCheckout($setECReq);
} catch (Exception $ex) {
	//include_once("../Error.php");
	exit;
}
if(isset($setECResponse)) {
	//echo "<table>";
	//echo "<tr><td>Ack :</td><td><div id='Ack'>$setECResponse->Ack</div> </td></tr>";
	//echo "<tr><td>Token :</td><td><div id='Token'>$setECResponse->Token</div> </td></tr>";
	//echo "</table>";
	//echo '<pre>';
	//print_r($setECResponse);
	//echo '</pre>';
	if($setECResponse->Ack =='Success') {
		$token = $setECResponse->Token;
		// Redirect to paypal.com here
		//重定向瀏覽器 
		$payPalURL = 'https://www.paypal.com/webscr?cmd=_express-checkout&token=' . $token;
		echo "<script type='text/javascript'>";
		echo "window.location.href='$payPalURL'";
		echo "</script>"; 
		//確保重定向後，後續代碼不會被執行 
		exit;
		
		//echo" <a href=$payPalURL><b>* Redirect to PayPal to login </b></a><br>";
	}
}
?>
</body>
</html>