<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php //include('mysqli_to_json.class.php'); ?>
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

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
	
	// 取得母項目編號
	$colname_RecordAccounts_summonsdetail = "-1";
	if (isset($_GET['id_del'])) {
	  $colname_RecordAccounts_summonsdetail = $_GET['id_del'];
	}
	$coluserid_RecordAccounts_summonsdetail = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordAccounts_summonsdetail = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordAccounts_summonsdetail = sprintf("SELECT * FROM invoicing_accounts_summonsdetail WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsdetail, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"));
	$RecordAccounts_summonsdetail = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail);
	$totalRows_RecordAccounts_summonsdetail = mysqli_num_rows($RecordAccounts_summonsdetail);
	
	$aid = $row_RecordAccounts_summonsdetail['aid'];
	
  $deleteSQL = sprintf("DELETE FROM invoicing_accounts_summonsdetail WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
	// 取得母項目
	$colname_RecordAccounts_summonsorder = "-1";
	if (isset($aid)) {
	  $colname_RecordAccounts_summonsorder = $aid;
	}
	$coluserid_RecordAccounts_summonsorder = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordAccounts_summonsorder = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordAccounts_summonsorder = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsorder, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsorder, "int"));
	$RecordAccounts_summonsorder = mysqli_query($DB_Conn, $query_RecordAccounts_summonsorder) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsorder = mysqli_fetch_assoc($RecordAccounts_summonsorder);
	$totalRows_RecordAccounts_summonsorder = mysqli_num_rows($RecordAccounts_summonsorder);
	
  
	// 取得細項
	$colname_RecordAccounts_summonsdetail = "-1";
	if (isset($aid)) {
	  $colname_RecordAccounts_summonsdetail = $aid;
	}
	$coluserid_RecordAccounts_summonsdetail = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordAccounts_summonsdetail = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordAccounts_summonsdetail = sprintf("SELECT SUM(debitamount) AS sum_debitamount, SUM(creditamount) AS sum_creditamount, userid FROM invoicing_accounts_summonsdetail WHERE aid = %s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsdetail, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"));
	$RecordAccounts_summonsdetail = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail);
	$totalRows_RecordAccounts_summonsdetail = mysqli_num_rows($RecordAccounts_summonsdetail);
	
	if ($row_RecordAccounts_summonsorder['type'] == '收入'){
		$sumamount = $row_RecordAccounts_summonsdetail['sum_creditamount'];
	}
	
	if ($row_RecordAccounts_summonsorder['type'] == '支出'){
		$sumamount = $row_RecordAccounts_summonsdetail['sum_debitamount'];
	}
	
	if ($row_RecordAccounts_summonsorder['type'] == '轉帳'){
		if($row_RecordAccounts_summonsdetail['sum_creditamount'] == $row_RecordAccounts_summonsdetail['sum_debitamount']){
			$sumamount = $row_RecordAccounts_summonsdetail['sum_creditamount'];
			$updateSQL = sprintf("UPDATE invoicing_accounts_summonsorder SET errorcheck=%s WHERE id=%s",
					       GetSQLValueString(0, "int"),
                           GetSQLValueString($aid, "int"));

				  //mysqli_select_db($database_DB_Conn, $DB_Conn);
				  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		}else{
				$sumamount = '';
				$errorcheck = 1;
				$updateSQL = sprintf("UPDATE invoicing_accounts_summonsorder SET errorcheck=%s WHERE id=%s",
					       GetSQLValueString($errorcheck, "int"),
                           GetSQLValueString($aid, "int"));

				  //mysqli_select_db($database_DB_Conn, $DB_Conn);
				  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
			}
	}
	
	// 更新
	$updateSQL = sprintf("UPDATE invoicing_accounts_summonsorder SET sumamount=%s WHERE id=%s",
					   GetSQLValueString($sumamount, "text"),
					   GetSQLValueString($aid, "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}
?>
