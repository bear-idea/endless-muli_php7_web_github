<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php //include('mysqli_to_json.class.php'); ?>
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

$collang_RecordTmpListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpListItem = $_SESSION['lang'];
}
$collistid_RecordTmpListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordTmpListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpListItem = sprintf("SELECT demo_tmpitem.item_id, demo_tmplist.list_id, demo_tmplist.listname, demo_tmpitem.itemname, demo_tmpitem.lang FROM demo_tmplist LEFT OUTER JOIN demo_tmpitem ON demo_tmplist.list_id = demo_tmpitem.list_id WHERE demo_tmplist.list_id = %s && demo_tmpitem.lang=%s", GetSQLValueString($collistid_RecordTmpListItem, "int"),GetSQLValueString($collang_RecordTmpListItem, "text"));
$RecordTmpListItem = mysqli_query($DB_Conn, $query_RecordTmpListItem) or die(mysqli_error($DB_Conn));
$row_RecordTmpListItem = mysqli_fetch_assoc($RecordTmpListItem);
$totalRows_RecordTmpListItem = mysqli_num_rows($RecordTmpListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordTmpListItem['itemname']] = $row_RecordTmpListItem['itemname']; ?>
<?php } while ($row_RecordTmpListItem = mysqli_fetch_assoc($RecordTmpListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordTmpListItem);
?>
