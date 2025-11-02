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

if($row_RecordScalesourceListType['item_id'] != "")
{
	$row_RecordScalesourceListItem['item_id'] = $row_RecordScalesourceListType['item_id'];
}

$colname_RecordScalesourceListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordScalesourceListTypeCount = $_GET['lang'];
}
$colitem_id_RecordScalesourceListTypeCount = "-1";
if (isset($row_RecordScalesourceListItem['item_id'])) {
  $colitem_id_RecordScalesourceListTypeCount = $row_RecordScalesourceListItem['item_id'];
}
$coluserid_RecordScalesourceListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScalesourceListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScalesourceListTypeCount = sprintf("SELECT * FROM erp_scalesourceitem WHERE list_id = 1 && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordScalesourceListTypeCount, "text"),GetSQLValueString($colitem_id_RecordScalesourceListTypeCount, "int"),GetSQLValueString($coluserid_RecordScalesourceListTypeCount, "int"));
$RecordScalesourceListTypeCount = mysqli_query($DB_Conn, $query_RecordScalesourceListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordScalesourceListTypeCount = mysqli_fetch_assoc($RecordScalesourceListTypeCount);
$totalRows_RecordScalesourceListTypeCount = mysqli_num_rows($RecordScalesourceListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordScalesourceListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordScalesourceListTypeCount);
?>
