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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if($_POST["ocname"] != "" && $_POST['ocmail'] != "" && $_SESSION['userid'] != "" && isset($_SESSION['UserAccess'])) { // 擋非法送出
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  // 取得會員ID
  require_once('require_member_get.php');		
  // 地址合成	
  $_POST['ocaddr'] = $_POST['oczip'] . $_POST['occounty'] . $_POST['ocdistrict'] . $_POST['ocaddr'];
	
  $insertSQL = sprintf("INSERT INTO demo_cartorders (oserial, ocname, ocaddr, ocphone, ocmail, ocgender, ocbuyname, ocbuyphone, ocbuytel, ocbuymail, ocbuygender, ocpdprice, octel, ocrfreight, ocfreightstateonly, ocfreightprice, ocinvoiceformat, ocinvoiceetselect, ocinvoicesupportno, ocinvoiceloveno, ocinvoicecompanyno, ocinvoicetitle, ocinvoiceusername, ocinvoiceaddr, ocinvoiceprice, ocfreepriceok, ocfreepricedesc, ocexpriceselect, ocexpricename, ocexprice, ocDiscountShowAlldiscount_type_0, ocDiscountShowAlldiscount_type_1, ocDiscountShowAlldiscount_type_2, ocDiscountShowAlldiscount_type_3, ocDiscountShowAlldiscount_type_4, ocDiscountShowAlldiscount_type_5, ocDiscountShowAlldiscount_type_6, ocpaymentselect, ocfreightselect, ocreceipt, ocfreightdesc, ocotherprice, oczip, occounty, ocdistrict, octotal, ocCVSStoreID, ocCVSStoreName, postdate, ocnotes1, memberid, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
					   GetSQLValueString($_POST['ocfreightstateonly'], "int"),
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
					   GetSQLValueString($_POST['ocDiscountShowAlldiscount_type_0'], "int"),
					   GetSQLValueString($_POST['ocDiscountShowAlldiscount_type_1'], "int"),
					   GetSQLValueString($_POST['ocDiscountShowAlldiscount_type_2'], "int"),
					   GetSQLValueString($_POST['ocDiscountShowAlldiscount_type_3'], "int"),
					   GetSQLValueString($_POST['ocDiscountShowAlldiscount_type_4'], "int"),
					   GetSQLValueString($_POST['ocDiscountShowAlldiscount_type_5'], "int"),
					   GetSQLValueString($_POST['ocDiscountShowAlldiscount_type_6'], "int"),
					   GetSQLValueString($_POST['ocpaymentselect'], "text"),
					   GetSQLValueString($_POST['ocfreightselect'], "text"),
					   GetSQLValueString($_POST['ocreceipt'], "text"),
					   GetSQLValueString($_POST['ocfreightdesc'], "text"),
					   GetSQLValueString($_POST['ocotherprice'], "int"),
                       GetSQLValueString($_POST['oczip'], "text"),
					   GetSQLValueString($_POST['occounty'], "text"),
					   GetSQLValueString($_POST['ocdistrict'], "text"),
                       GetSQLValueString($_POST['octotal'], "int"),
					   GetSQLValueString($_POST['ocCVSStoreID'], "text"),
					   GetSQLValueString($_POST['ocCVSStoreName'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['ocnotes1'], "text"),
					   GetSQLValueString($row_RecordMember['id'], "int"),
                       GetSQLValueString($_SESSION['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	foreach($_POST['dcproductname'] as $i => $val){	
  $insertSQL = sprintf("INSERT INTO demo_cartdetail (pid, dcserial, pdseries, dcproductname, dcprice, dcquantiry, dcitemtotal, dcformat, dcspformat, dcnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['pid'][$i], "int"),
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['pdseries'][$i], "text"),
                       GetSQLValueString($_POST['dcproductname'][$i], "text"),
                       GetSQLValueString($_POST['dcprice'][$i], "text"),
                       GetSQLValueString($_POST['dcquantiry'][$i], "text"),
                       GetSQLValueString($_POST['dcitemtotal'][$i], "text"),
					   GetSQLValueString($_POST['dcformat'][$i], "text"),
					   GetSQLValueString($_POST['dcspformat'][$i], "text"),
					   GetSQLValueString($_POST['dcnotes1'][$i], "text"),
                       GetSQLValueString($_SESSION['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	}
	
	//foreach($_POST['dcproductname'] as $i => $val){
	  foreach($_POST['dcproductplusname'] as $k => $val2) {
		  $insertSQL = sprintf("INSERT INTO demo_cartdetail (dcserial, dcstate, dcproductname, dcprice, dcquantiry, dcitemtotal, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
					   GetSQLValueString(1, "int"),
                       GetSQLValueString($_POST['dcproductplusname'][$k], "text"),
                       GetSQLValueString($_POST['dcproductplusprice'][$k], "text"),
                       GetSQLValueString($_POST['dcproductplusquantity'][$k], "text"),
					   GetSQLValueString($_POST['dcplusitemtotal'][$k], "text"),
                       GetSQLValueString($_SESSION['userid'], "int"));
					   //mysqli_select_db($database_DB_Conn, $DB_Conn);
  					   $Result2 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  }
  //}

		$insertGoTo = "cart.php?wshop=" . $_POST['wshop'] . "&Opt=sendpage&lang=" . $_SESSION['lang'] . "&ID=" . $_POST['D_OrderID'] . "&PR=" . $_POST['octotal'];

      // 商品庫存修改 ------------------------------------------------------------------------
	  foreach($_POST['dcproductname'] as $i => $val){
		
		// 取得商品資料
		
		//echo "-- 取得商品資料 --<br>";
		//echo "商品名:" . $val . "<br>";
		
		$colname_RecordProductGet = "-1";
		if (isset($_POST['pid'][$i])) {
		  $colname_RecordProductGet = $_POST['pid'][$i];
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordProductGet = sprintf("SELECT * FROM demo_product WHERE id = %s", GetSQLValueString($colname_RecordProductGet, "int"));
		$RecordProductGet = mysqli_query($DB_Conn, $query_RecordProductGet) or die(mysqli_error($DB_Conn));
		$row_RecordProductGet = mysqli_fetch_assoc($RecordProductGet);
		$totalRows_RecordProductGet = mysqli_num_rows($RecordProductGet);
		
		// 當有開啟自動停賣功能
		if($row_RecordProductGet['inventorynotsale'] == '1' && $row_RecordProductGet['inventory'] != '')
		{
			// 更新庫存量
			$inventory = $row_RecordProductGet['inventory'] - $_POST['dcquantiry'][$i];
			$updateSQL = sprintf("UPDATE demo_product SET inventory=%s WHERE id=%s",
                       GetSQLValueString($inventory, "text"),
                       GetSQLValueString($_POST['pid'][$i], "int"));
	
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		}
		
	  }
	  // 商品庫存修改 ------------------------------------------------------------------------
	  
	  
  /* 清空購物車 */
	unset ($_SESSION['PlusTotal']);
	unset ($_SESSION['Total']);
	unset ($_SESSION['itemTotal']);
	unset ($_SESSION['OrderID']); // 清除訂單編號

if($totalRows_RecordMember > 0) 
{
	/* 取得購物車清單 有會員 */
	$coluserid_RecordCartlist = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlist = $_SESSION['userid'];
	}
	$colmemberid_RecordCartlist = "-1";
	if (isset($row_RecordMember['id'])) {
	  $colmemberid_RecordCartlist = $row_RecordMember['id'];
	}
	$collang_RecordCartlist = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlist = $_SESSION['lang'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE userid=%s && memberid=%s && lang=%s ORDER BY id DESC",GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colmemberid_RecordCartlist, "int"),GetSQLValueString($collang_RecordCartlist, "text"));
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
	
	do
	{
		$deleteSQL = sprintf("DELETE FROM demo_cart WHERE id=%s",
                       GetSQLValueString($row_RecordCartlist['id'], "int"));

		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
	}while ($row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist));
	
	
}else{
	/* 取得購物車清單 無會員 */
	$coluserid_RecordCartlist = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlist = $_SESSION['userid'];
	}
	$colUserAccessuniqid_RecordCartlist = "-1";
	if (isset($_SESSION['UserAccess'])) {
	  $colUserAccessuniqid_RecordCartlist = $_SESSION['UserAccess'];
	}
	$collang_RecordCartlist = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlist = $_SESSION['lang'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE userid=%s && UserAccessuniqid=%s && lang=%s ORDER BY id DESC",GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colUserAccessuniqid_RecordCartlist, "text"),GetSQLValueString($collang_RecordCartlist, "text"));
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
	
	do
	{
		$deleteSQL = sprintf("DELETE FROM demo_cart WHERE id=%s",
                       GetSQLValueString($row_RecordCartlist['id'], "int"));

		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
	}while ($row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist));
	
}
	
	  // <!-- ╭─────────────────────────────────────╮ -->
	  $servicemail=$SiteMail;//指定網站管理員服務信箱，請修改為自己的有效mail
	  // 發送訂購通知(購買人)
	  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
	  $Url = "http://" . $DefaultSiteUrl . "/cart_orders_see.php?wshop=" . $_POST['wshop']. "&Serial=" . $_POST['D_OrderID'];
	  $Body = "親愛的 " . $_POST['ocname'] . " 您好！\n" 
			. "歡迎您在『" . $SiteName . "』購物。\n"
			. "您的訂單編號：" . $_POST['D_OrderID'] . " \n"
			. "訂購日期：" . $_POST['postdate'] . "\n"
			. "以下為您所訂購知詳細資料！\n\n"
			. "以下為所訂購詳細資訊\n\n"
			. "連結為" . $Url . " \n\n"
			. "本信件為系統自動發送(請勿回信！！！)";
	
	  //$From= "From: " . "=?UTF-8?B?" . base64_encode($SiteName) . "?=" . " <" . $_POST['ocmail'] . "> \n\r";
	  //$Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
	  //$Header = $From . $Type;
	  //$Subject = "=?UTF-8?B?" . base64_encode($SiteName . " 訂購成功確認通知") . "?=";
	  $subject=$SiteName . " 訂購成功確認通知";//信件標題
	  $subject=mb_encode_mimeheader($subject, 'UTF-8');//指定標題將雙位元文字編碼為單位元字串，避免亂碼
	  
	  $headers = "MIME-Version: 1.0\r\n";//指定MIME(多用途網際網路郵件延伸標準)版本
	  $headers .= "Content-type: text/html; charset=utf-8\r\n";//指定郵件類型為HTML格式
	  $headers .= "From:".mb_encode_mimeheader($SiteName, 'UTF-8')."<".$servicemail."> \r\n";//指定寄件者資訊
	  $headers .= "Reply-To:".mb_encode_mimeheader($SiteName, 'UTF-8')."<".$servicemail.">\r\n";//指定信件回覆位置
	  $headers .= "Return-Path:".mb_encode_mimeheader($SiteName, 'UTF-8')."<".$servicemail.">\r\n";//被退信時送回位置
		
	  mail($_POST['ocmail'], $subject, $Body, $headers);
	  
	  // 發送訂購通知(商家)
	  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
	  $Url = "http://" . $DefaultSiteUrl . "/cart_orders_see.php?wshop=" . $_POST['wshop']. "&Serial=" . $_POST['D_OrderID'];
	  $Body = "您的客戶 " . $_POST['ocname'] . "！於您的網站購物\n" 
			. "訂單編號：" . $_POST['D_OrderID'] . "\n"
			. "訂購日期：" . $_POST['postdate'] . "\n"
			. "以下為所訂購詳細資訊\n\n"
			. "連結為" . $Url
			. "";
	
	  //$From= "From: " . "=?UTF-8?B?" . base64_encode($SiteName) . "?=" . " <" . $SiteMail . "> \n\r";
	  //$Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
	  //$Header = $From . $Type;
	  //$Subject = "=?UTF-8?B?" . base64_encode($SiteName . " 訂購通知") . "?=";
	  $subject=$SiteName . " 訂購通知";//信件標題
	  $subject=mb_encode_mimeheader($subject, 'UTF-8');//指定標題將雙位元文字編碼為單位元字串，避免亂碼
	  
	  $headers = "MIME-Version: 1.0\r\n";//指定MIME(多用途網際網路郵件延伸標準)版本
	  $headers .= "Content-type: text/html; charset=utf-8\r\n";//指定郵件類型為HTML格式
	  $headers .= "From:".mb_encode_mimeheader($SiteName, 'UTF-8')."<".$servicemail."> \r\n";//指定寄件者資訊
	  $headers .= "Reply-To:".mb_encode_mimeheader($SiteName, 'UTF-8')."<".$servicemail.">\r\n";//指定信件回覆位置
	  $headers .= "Return-Path:".mb_encode_mimeheader($SiteName, 'UTF-8')."<".$servicemail.">\r\n";//被退信時送回位置
		
	  mail($SiteMail, $subject, $Body, $headers); 
	  //
	  header(sprintf("Location: %s", $insertGoTo));
	  
  //ob_end_flush(); // 輸出緩衝區結束
}
} // \擋非法送出

$colname_RecordCartListFreight = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListFreight = $_GET['lang'];
}
$coluserid_RecordCartListFreight = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCartListFreight = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListFreight = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListFreight, "text"),GetSQLValueString($coluserid_RecordCartListFreight, "int"));
$RecordCartListFreight = mysqli_query($DB_Conn, $query_RecordCartListFreight) or die(mysqli_error($DB_Conn));
$row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
$totalRows_RecordCartListFreight = mysqli_num_rows($RecordCartListFreight);

if($totalRows_RecordMember > 0) 
{
	/* 取得購物車清單 有會員 */
	$coluserid_RecordCartlist = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlist = $_SESSION['userid'];
	}
	$colmemberid_RecordCartlist = "-1";
	if (isset($row_RecordMember['id'])) {
	  $colmemberid_RecordCartlist = $row_RecordMember['id'];
	}
	$collang_RecordCartlist = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlist = $_SESSION['lang'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE userid=%s && memberid=%s && lang=%s ORDER BY id DESC",GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colmemberid_RecordCartlist, "int"),GetSQLValueString($collang_RecordCartlist, "text"));
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
}else{
	/* 取得購物車清單 無會員 */
	$coluserid_RecordCartlist = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlist = $_SESSION['userid'];
	}
	$colUserAccessuniqid_RecordCartlist = "-1";
	if (isset($_SESSION['UserAccess'])) {
	  $colUserAccessuniqid_RecordCartlist = $_SESSION['UserAccess'];
	}
	$collang_RecordCartlist = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlist = $_SESSION['lang'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE userid=%s && UserAccessuniqid=%s && lang=%s ORDER BY id DESC",GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colUserAccessuniqid_RecordCartlist, "text"),GetSQLValueString($collang_RecordCartlist, "text"));
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
}
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
    <?php include($TplPath . "/cart_purchase_check.php"); ?>
<?php } ?>
<?php  
mysqli_free_result($RecordCartListFreight);

mysqli_free_result($RecordCartlist);
?>
