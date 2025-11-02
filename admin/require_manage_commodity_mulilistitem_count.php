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

if($row_RecordCommodityListType['item_id'] != "")
{
	$row_RecordCommodityListItem['item_id'] = $row_RecordCommodityListType['item_id'];
}

$colname_RecordCommodityListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCommodityListTypeCount = $_GET['lang'];
}
$colitem_id_RecordCommodityListTypeCount = "-1";
if (isset($row_RecordCommodityListItem['item_id'])) {
  $colitem_id_RecordCommodityListTypeCount = $row_RecordCommodityListItem['item_id'];
}
$coluserid_RecordCommodityListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListTypeCount = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 1 && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordCommodityListTypeCount, "text"),GetSQLValueString($colitem_id_RecordCommodityListTypeCount, "int"),GetSQLValueString($coluserid_RecordCommodityListTypeCount, "int"));
$RecordCommodityListTypeCount = mysqli_query($DB_Conn, $query_RecordCommodityListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListTypeCount = mysqli_fetch_assoc($RecordCommodityListTypeCount);
$totalRows_RecordCommodityListTypeCount = mysqli_num_rows($RecordCommodityListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordCommodityListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordCommodityListTypeCount);
?>
