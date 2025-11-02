<?php require_once('../Connections/DB_Conn.php'); ?>
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

if($row_RecordAccounts_summonsListType['item_id'] != "")
{
	$row_RecordAccounts_summonsListItem['item_id'] = $row_RecordAccounts_summonsListType['item_id'];
}

$colname_RecordAccounts_summonsListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_summonsListTypeCount = $_GET['lang'];
}
$colitem_id_RecordAccounts_summonsListTypeCount = "-1";
if (isset($row_RecordAccounts_summonsListItem['item_id'])) {
  $colitem_id_RecordAccounts_summonsListTypeCount = $row_RecordAccounts_summonsListItem['item_id'];
}
$coluserid_RecordAccounts_summonsListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListTypeCount = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAccounts_summonsListTypeCount, "text"),GetSQLValueString($colitem_id_RecordAccounts_summonsListTypeCount, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsListTypeCount, "int"));
$RecordAccounts_summonsListTypeCount = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListTypeCount = mysqli_fetch_assoc($RecordAccounts_summonsListTypeCount);
$totalRows_RecordAccounts_summonsListTypeCount = mysqli_num_rows($RecordAccounts_summonsListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordAccounts_summonsListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordAccounts_summonsListTypeCount);
?>
