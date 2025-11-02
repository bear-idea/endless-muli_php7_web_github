<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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

if($_GET['item_id'] != ''){
	
	$colitem_id_RecordAccounts_summonsListType = "-1";
	if (isset($_GET['item_id'])) {
	  $colitem_id_RecordAccounts_summonsListType = $_GET['item_id'];
	}
	$coluserid_RecordAccounts_summonsListType = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordAccounts_summonsListType = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordAccounts_summonsListType = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && userid=%s && item_id=%s ORDER BY sortid ASC, item_id DESC",GetSQLValueString($coluserid_RecordAccounts_summonsListType, "int"),GetSQLValueString($colitem_id_RecordAccounts_summonsListType, "int"));
	$RecordAccounts_summonsListType = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListType) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
	$totalRows_RecordAccounts_summonsListType = mysqli_num_rows($RecordAccounts_summonsListType);	
	
	$accountingsubjects['itemvalue'] = $row_RecordAccounts_summonsListType['itemvalue'];
	$accountingsubjects['itemname'] = trim(str_replace($row_RecordAccounts_summonsListType['itemvalue'],'',$row_RecordAccounts_summonsListType['itemname']));
	//$accountingsubjects['itemname'] = $row_RecordAccounts_summonsListType['itemname'];
	echo json_encode($accountingsubjects);
}

if($_GET['itemvalue'] != ''){
	
	$colitemvalue_RecordAccounts_summonsListType = "-1";
	if (isset($_GET['itemvalue'])) {
	  $colitemvalue_RecordAccounts_summonsListType = $_GET['itemvalue'];
	}
	$coluserid_RecordAccounts_summonsListType = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordAccounts_summonsListType = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordAccounts_summonsListType = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && userid=%s && itemvalue=%s ORDER BY sortid ASC, item_id DESC",GetSQLValueString($coluserid_RecordAccounts_summonsListType, "int"),GetSQLValueString($colitemvalue_RecordAccounts_summonsListType, "int"));
	$RecordAccounts_summonsListType = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListType) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
	$totalRows_RecordAccounts_summonsListType = mysqli_num_rows($RecordAccounts_summonsListType);	
	
	$accountingsubjects[$row_RecordAccounts_summonsListType['level']] = $row_RecordAccounts_summonsListType['item_id'];
	//echo $_GET['itemvalue'];
	
	for($i=$row_RecordAccounts_summonsListType['level']-1; $i>=0; $i--){
		$colitem_id_RecordAccounts_summonsListType = "-1";
		if (isset($row_RecordAccounts_summonsListType['subitem_id'])) {
		  $colitem_id_RecordAccounts_summonsListType = $row_RecordAccounts_summonsListType['subitem_id'];
		}
		$coluserid_RecordAccounts_summonsListType = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordAccounts_summonsListType = $w_userid;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordAccounts_summonsListType = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && userid=%s && item_id=%s ORDER BY sortid ASC, item_id DESC",GetSQLValueString($coluserid_RecordAccounts_summonsListType, "int"),GetSQLValueString($colitem_id_RecordAccounts_summonsListType, "int"));
		$RecordAccounts_summonsListType = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListType) or die(mysqli_error($DB_Conn));
		$row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
		$totalRows_RecordAccounts_summonsListType = mysqli_num_rows($RecordAccounts_summonsListType);
		
		$accountingsubjects[$row_RecordAccounts_summonsListType['level']] = $row_RecordAccounts_summonsListType['item_id'];
	}
	
	//echo $_GET['itemvalue'];
	echo json_encode($accountingsubjects);
}




mysqli_free_result($RecordAccounts_summonsListType);

?>
