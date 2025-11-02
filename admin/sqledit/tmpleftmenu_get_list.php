<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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

$collang_RecordTmpLeftmenuListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpLeftmenuListItem = $_SESSION['lang'];
}
$collistid_RecordTmpLeftmenuListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordTmpLeftmenuListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLeftmenuListItem = sprintf("SELECT demo_tmpitem.item_id, demo_tmplist.list_id, demo_tmplist.listname, demo_tmpitem.itemname, demo_tmpitem.lang FROM demo_tmplist LEFT OUTER JOIN demo_tmpitem ON demo_tmplist.list_id = demo_tmpitem.list_id WHERE demo_tmplist.list_id = %s && demo_tmpitem.lang=%s", GetSQLValueString($collistid_RecordTmpLeftmenuListItem, "int"),GetSQLValueString($collang_RecordTmpLeftmenuListItem, "text"));
$RecordTmpLeftmenuListItem = mysqli_query($DB_Conn, $query_RecordTmpLeftmenuListItem) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftmenuListItem = mysqli_fetch_assoc($RecordTmpLeftmenuListItem);
$totalRows_RecordTmpLeftmenuListItem = mysqli_num_rows($RecordTmpLeftmenuListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordTmpLeftmenuListItem['itemname']] = $row_RecordTmpLeftmenuListItem['itemname']; ?>
<?php } while ($row_RecordTmpLeftmenuListItem = mysqli_fetch_assoc($RecordTmpLeftmenuListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordTmpLeftmenuListItem);
?>
