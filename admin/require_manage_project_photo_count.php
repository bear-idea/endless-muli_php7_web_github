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

if($row_RecordProjectListType['item_id'] != "")
{
	$row_RecordProjectListItem['item_id'] = $row_RecordProjectListType['item_id'];
}

$colname_RecordProjectListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordProjectListTypeCount = $_GET['lang'];
}
$collist_id_RecordProjectListTypeCount = "-1";
if (isset($_GET['list_id'])) {
  $collist_id_RecordProjectListTypeCount = $_GET['list_id'];
}
$colitem_id_RecordProjectListTypeCount = "-1";
if (isset($row_RecordProjectListItem['item_id'])) {
  $colitem_id_RecordProjectListTypeCount = $row_RecordProjectListItem['item_id'];
}
$coluserid_RecordProjectListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProjectListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectListTypeCount = sprintf("SELECT * FROM demo_projectitem WHERE list_id = %s && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($collist_id_RecordProjectListTypeCount, "int"), GetSQLValueString($colname_RecordProjectListTypeCount, "text"),GetSQLValueString($colitem_id_RecordProjectListTypeCount, "int"),GetSQLValueString($coluserid_RecordProjectListTypeCount, "int"));
$RecordProjectListTypeCount = mysqli_query($DB_Conn, $query_RecordProjectListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordProjectListTypeCount = mysqli_fetch_assoc($RecordProjectListTypeCount);
$totalRows_RecordProjectListTypeCount = mysqli_num_rows($RecordProjectListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordProjectListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordProjectListTypeCount);
?>
