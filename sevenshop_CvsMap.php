<?php header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 
require('vendor/autoload.php');
require_once('app/init/bootstrap.php');
require_once($Lang_GeneralPath);
?>
<style>
/* BOOTSTRAP REWRITE */
#__paymentButton {
	height:40px;
}
#__paymentButton {
	height:auto;
}
#__paymentButton {
	line-height:26px;
}

#__paymentButton {
	line-height:25px;
	margin-bottom:3px;
}
#__paymentButton {
	border-bottom: 3px solid rgba(0,0,0,.15);
}
#__paymentButton:hover {
	  opacity: 0.9;
	  filter: alpha(opacity=90);
	}
#__paymentButton.btn-link {
		border-bottom:0;
	}
#__paymentButton { background-color: #C02942; color: #FFF !important; }
</style>
<div style="margin-left:auto; margin-right:auto;">
<?php
	// 電子地圖
	//echo $SiteFileUrl;
	//echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'purchasepage'),'',$UrlWriteEnable);
	//echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	define('HOME_URL', $SiteFileUrl);
	require('ECPay.Logistics.Integration.php');
	try {
		$AL = new ECPayLogistics();
		$AL->Send = array(
			'MerchantID' => $row_RecordSystemConfigOtr['allpaypaymentnumber'],
			'MerchantTradeNo' => $_SESSION['OrderID'], // 廠商交易編號均為唯一值，不可重複使用。
			'LogisticsSubType' => LogisticsSubType::UNIMART, // FAMI：全家 UNIMART：統一超商 HILIFE：萊爾富
			'IsCollection' => IsCollection::YES, // 是否代收貨款(貨到付款)
			'ServerReplyURL' => HOME_URL . '/' . 'sevenshop_ServerReplyURL.php',
			'ExtraData' => 'sevenshop',
			'Device' => Device::PC
		);
		// CvsMap(Button名稱, Form target)
		$html = $AL->CvsMap('取得取貨超商資訊');
		echo $html;
	} catch(Exception $e) {
		echo $e->getMessage();
	}	
?>
</div>
<?php //} else { ?>
<!--<body onload='window.location="404.php"'>-->
<?php //} ?>