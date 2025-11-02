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

if($row_RecordScaleListType['item_id'] != "")
{
	$row_RecordScaleListItem['item_id'] = $row_RecordScaleListType['item_id'];
}

$colname_RecordScaleListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordScaleListTypeCount = $_GET['lang'];
}
$colitem_id_RecordScaleListTypeCount = "-1";
if (isset($row_RecordScaleListItem['item_id'])) {
  $colitem_id_RecordScaleListTypeCount = $row_RecordScaleListItem['item_id'];
}
$coluserid_RecordScaleListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleListTypeCount = sprintf("SELECT * FROM erp_scaleitem WHERE list_id = 1 && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordScaleListTypeCount, "text"),GetSQLValueString($colitem_id_RecordScaleListTypeCount, "int"),GetSQLValueString($coluserid_RecordScaleListTypeCount, "int"));
$RecordScaleListTypeCount = mysqli_query($DB_Conn, $query_RecordScaleListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordScaleListTypeCount = mysqli_fetch_assoc($RecordScaleListTypeCount);
$totalRows_RecordScaleListTypeCount = mysqli_num_rows($RecordScaleListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordScaleListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordScaleListTypeCount);
?>
