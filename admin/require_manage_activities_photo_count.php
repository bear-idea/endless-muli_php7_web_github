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

if($row_RecordActivitiesListType['item_id'] != "")
{
	$row_RecordActivitiesListItem['item_id'] = $row_RecordActivitiesListType['item_id'];
}

$colname_RecordActivitiesListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordActivitiesListTypeCount = $_GET['lang'];
}
$collist_id_RecordActivitiesListTypeCount = "-1";
if (isset($_GET['list_id'])) {
  $collist_id_RecordActivitiesListTypeCount = $_GET['list_id'];
}
$colitem_id_RecordActivitiesListTypeCount = "-1";
if (isset($row_RecordActivitiesListItem['item_id'])) {
  $colitem_id_RecordActivitiesListTypeCount = $row_RecordActivitiesListItem['item_id'];
}
$coluserid_RecordActivitiesListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordActivitiesListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesListTypeCount = sprintf("SELECT * FROM demo_actitem WHERE list_id = %s && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($collist_id_RecordActivitiesListTypeCount, "int"), GetSQLValueString($colname_RecordActivitiesListTypeCount, "text"),GetSQLValueString($colitem_id_RecordActivitiesListTypeCount, "int"),GetSQLValueString($coluserid_RecordActivitiesListTypeCount, "int"));
$RecordActivitiesListTypeCount = mysqli_query($DB_Conn, $query_RecordActivitiesListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesListTypeCount = mysqli_fetch_assoc($RecordActivitiesListTypeCount);
$totalRows_RecordActivitiesListTypeCount = mysqli_num_rows($RecordActivitiesListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordActivitiesListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordActivitiesListTypeCount);
?>
