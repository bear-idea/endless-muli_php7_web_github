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

if(isset($row_RecordProductListType['item_id']))
{
	$row_RecordProductListItem['item_id'] = $row_RecordProductListType['item_id'];
}

$colname_RecordProductListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordProductListTypeCount = $_GET['lang'];
}
$colitem_id_RecordProductListTypeCount = "-1";
if (isset($row_RecordProductListItem['item_id'])) {
  $colitem_id_RecordProductListTypeCount = $row_RecordProductListItem['item_id'];
}
$coluserid_RecordProductListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListTypeCount = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordProductListTypeCount, "text"),GetSQLValueString($colitem_id_RecordProductListTypeCount, "int"),GetSQLValueString($coluserid_RecordProductListTypeCount, "int"));
$RecordProductListTypeCount = mysqli_query($DB_Conn, $query_RecordProductListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordProductListTypeCount = mysqli_fetch_assoc($RecordProductListTypeCount);
$totalRows_RecordProductListTypeCount = mysqli_num_rows($RecordProductListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordProductListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordProductListTypeCount);
?>
