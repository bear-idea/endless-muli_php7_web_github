<?php header("Content-Type:text/html;charset=utf-8"); /* 指定頁面編碼方式 IE BUG*/  ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 
require('vendor/autoload.php');
require_once('app/init/bootstrap.php');
?>
<?php 
//重定向瀏覽器
if ($row_RecordAccount != NULL) { // 判斷資料庫是否有此帳號域名 
require_once($Lang_GeneralPath);
require_once($Lang_CartPath);
	if ($MSTMP == 'userdefault') // 版面使用指定樣板
	{
		//if ($MSHome == '1'){ // 使用首頁	/ 有首頁功能
		if($_SERVER['HTTP_HOST'] == 'www.shop3500.com'){ // 判斷是否為Shop3500
			if($HomeSelect == '1' && $OptionTmpHomeSelect == '1'){ // 如果樣板選擇有首頁則跳轉
				header("Location:" . $SiteBaseUrl . url_rewrite("home",array('wshop'=>$_GET['wshop'],'lang'=>$_GET['lang']),'',$UrlWriteEnable));
			}else{
				if($HomeType == '') { // 如果未設定首頁 預設跳到About
					$tppage = 'about';
					//header("Location: 404.php");
					header("Location: " . $SiteBaseUrl . url_rewrite($tppage, array('wshop'=>$_GET['wshop'],'lang'=>$_GET['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable));
				}else if(strtolower($HomeType) == "cart_note"){
					$tppage = 'cart';
					header("Location: " . $SiteBaseUrl . url_rewrite($tppage, array('wshop'=>$_GET['wshop'],'lang'=>$_GET['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable));
				}else if(strtolower($HomeType) == "cart_pay"){
					$tppage = 'cart';
					header("Location: " . $SiteBaseUrl . url_rewrite($tppage, array('wshop'=>$_GET['wshop'],'lang'=>$_GET['lang'],'Opt'=>'payok'),'',$UrlWriteEnable));
				}else{
					$tppage = strtolower($HomeType);
					header("Location: " . $SiteBaseUrl . url_rewrite($tppage, array('wshop'=>$_GET['wshop'],'lang'=>$_GET['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable));
				}
			}
		} else { //if(){ // 判斷是否為Shop3500 此內容為獨立網址客戶
		    //$_GET['wshop'] = 'playweb';
			//echo "----------------";
			/* ip限制判斷 */
			if($row_RecordSystemConfig['iplimitmod'] == '0') {
			/*全部ip可允許*/
			if(is_safe_ip("",$row_RecordSystemConfig['ipblack']) == true) { $iplimitdoor = "close";} else { $iplimitdoor = "open";};
			} else { 
			/* 全部ip不可允許*/
			if(is_safe_ip("",$row_RecordSystemConfig['ipwhite']) == true) { $iplimitdoor = "open";} else { $iplimitdoor = "close";};
			}
			if($iplimitdoor == "open") {
				
				require("app/Controller/require_controller_home.php");

			}else{
				echo "禁止瀏覽";
			}
		} //if(){ // 判斷是否為Shop3500
	} else {
	}
	//}
	//確保重定向後，後續代碼不會被執行
	//}
	//if ($MSHome == '0'){ // 不使用首頁 / 使用指定頁 / 無首頁功能
		//if($_GET['wshop'] != '' && $_SESSION['userid'] != ''){ // 取得商店名稱並且資料庫也要抓到資料
		//header("Location: dfpage.php?wshop=" . $_GET['wshop'] . "&Opt=viewpage&tp=" . $HomeType . "&lang=" . $defaultlang); 
		//}else{
		//	header("Location: 404.html"); 
		//}
	//}
	//exit;
//}
}else{ // 判斷資料庫是否有此帳號域名 
    if($_SERVER['HTTP_HOST'] == 'www.shop3500.com' || $_SERVER['HTTP_HOST'] == 'localhost'){
		// 手機版 當功能開啟 及 使用者設定行動裝置外觀模式
		if(isset($_GET['htp']) && $_GET['htp'] != ""){
			switch($_GET['htp'])
				  {
					  // 測試修改中....
					  case "search":
						  //require_once("home_main_mobile_site_search.php");
						  require_once("home_main_search.php");
						  break;
					  case "log":
						  require_once("home_main_login.php");
						  break;
					  default:
						  //require("home_main_mobile.php");
						  require("home_main2016.php");
						  break;
				  }
				//require("home_main_mobile.php");
				//require("home_main2016.php");
			}else{
				require("home_main2016.php");
			}
		//}else{
			//echo "Welcome To HelloWorld on localhost";
		//}
		
		// 首頁關鍵字
		//require("inc_title/bnb.php"); // 關鍵字
		//require("home_bnb.php");
    }else{
		//if($_SERVER['HTTP_HOST'] == 'www.shop3500.com')
		echo "Welcome To HelloWorld";
		//header("Location: index.php"); 
	}
}
?>
<?php //require("inc/mobile_detect.php"); ?>
<?php //require("inc/inc_lang_change.php"); ?>
