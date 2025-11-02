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

if($row_RecordSettingListType['item_id'] != "")
{
	$row_RecordSettingListItem['item_id'] = $row_RecordSettingListType['item_id'];
}

$colname_RecordSettingListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordSettingListTypeCount = $_GET['lang'];
}
$collist_id_RecordSettingListTypeCount = "-1";
if (isset($_GET['list_id'])) {
  $collist_id_RecordSettingListTypeCount = $_GET['list_id'];
}
$colitem_id_RecordSettingListTypeCount = "-1";
if (isset($row_RecordSettingListItem['item_id'])) {
  $colitem_id_RecordSettingListTypeCount = $row_RecordSettingListItem['item_id'];
}
$coluserid_RecordSettingListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingListTypeCount = sprintf("SELECT * FROM demo_settingitem WHERE list_id = %s && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($collist_id_RecordSettingListTypeCount, "int"), GetSQLValueString($colname_RecordSettingListTypeCount, "text"),GetSQLValueString($colitem_id_RecordSettingListTypeCount, "int"),GetSQLValueString($coluserid_RecordSettingListTypeCount, "int"));
$RecordSettingListTypeCount = mysqli_query($DB_Conn, $query_RecordSettingListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordSettingListTypeCount = mysqli_fetch_assoc($RecordSettingListTypeCount);
$totalRows_RecordSettingListTypeCount = mysqli_num_rows($RecordSettingListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordSettingListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordSettingListTypeCount);
?>
