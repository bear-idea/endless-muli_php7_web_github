<?php
	if (!isset($_SESSION)) {
  		session_start();
	}
	/* 取得會員資料 */
    require_once('require_member_get.php');	
	/*
			foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val){
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][$i];
	}*/
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

	
	$cartGoTo = $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);
	
	header(sprintf("Location: %s", $cartGoTo));
	ob_end_flush(); // 輸出緩衝區結束	
?>