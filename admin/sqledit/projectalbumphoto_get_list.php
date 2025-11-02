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

$collang_RecordProjectListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordProjectListItem = $_SESSION['lang'];
}
$collistid_RecordProjectListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordProjectListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectListItem = sprintf("SELECT demo_projectitem.item_id, demo_projectlist.list_id, demo_projectlist.listname, demo_projectitem.itemname, demo_projectitem.lang FROM demo_projectlist LEFT OUTER JOIN demo_projectitem ON demo_projectlist.list_id = demo_projectitem.list_id WHERE demo_projectlist.list_id = %s && demo_projectitem.lang=%s", GetSQLValueString($collistid_RecordProjectListItem, "int"),GetSQLValueString($collang_RecordProjectListItem, "text"));
$RecordProjectListItem = mysqli_query($DB_Conn, $query_RecordProjectListItem) or die(mysqli_error($DB_Conn));
$row_RecordProjectListItem = mysqli_fetch_assoc($RecordProjectListItem);
$totalRows_RecordProjectListItem = mysqli_num_rows($RecordProjectListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordProjectListItem['itemname']] = $row_RecordProjectListItem['itemname']; ?>
<?php } while ($row_RecordProjectListItem = mysqli_fetch_assoc($RecordProjectListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordProjectListItem);
?>
