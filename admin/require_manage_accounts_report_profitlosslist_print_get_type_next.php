<?php
$colname_RecordAccounts_summonsListTypeGetItemID = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_summonsListTypeGetItemID = $_GET['lang'];
}
$colitemvalue_RecordAccounts_summonsListTypeGetItemID = "-1";
if (isset($itemvalue)) {
  $colitemvalue_RecordAccounts_summonsListTypeGetItemID = $itemvalue;
}
$coluserid_RecordAccounts_summonsListTypeGetItemID = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListTypeGetItemID = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListTypeGetItemID = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && itemvalue=%s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAccounts_summonsListTypeGetItemID, "text"), GetSQLValueString($colitemvalue_RecordAccounts_summonsListTypeGetItemID, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListTypeGetItemID, "int"));
$RecordAccounts_summonsListTypeGetItemID = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListTypeGetItemID) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListTypeGetItemID = mysqli_fetch_assoc($RecordAccounts_summonsListTypeGetItemID);
$totalRows_RecordAccounts_summonsListTypeGetItemID = mysqli_num_rows($RecordAccounts_summonsListTypeGetItemID);

$colname_RecordAccounts_summonsListTypeNext = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_summonsListTypeNext = $_GET['lang'];
}
$colsubitem_id_RecordAccounts_summonsListTypeNext = "-1";
if (isset($row_RecordAccounts_summonsListTypeGetItemID['item_id'])) {
  $colsubitem_id_RecordAccounts_summonsListTypeNext = $row_RecordAccounts_summonsListTypeGetItemID['item_id'];
}
$coluserid_RecordAccounts_summonsListTypeNext = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListTypeNext = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListTypeNext = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && subitem_id=%s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAccounts_summonsListTypeNext, "text"), GetSQLValueString($colsubitem_id_RecordAccounts_summonsListTypeNext, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsListTypeNext, "int"));
$RecordAccounts_summonsListTypeNext = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListTypeNext) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListTypeNext = mysqli_fetch_assoc($RecordAccounts_summonsListTypeNext);
$totalRows_RecordAccounts_summonsListTypeNext = mysqli_num_rows($RecordAccounts_summonsListTypeNext);
				
 ?>