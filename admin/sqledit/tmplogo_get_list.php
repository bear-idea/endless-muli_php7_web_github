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

$collang_RecordTmpLogoListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpLogoListItem = $_SESSION['lang'];
}
$collistid_RecordTmpLogoListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordTmpLogoListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogoListItem = sprintf("SELECT demo_tmpitem.item_id, demo_tmplist.list_id, demo_tmplist.listname, demo_tmpitem.itemname, demo_tmpitem.lang FROM demo_tmplist LEFT OUTER JOIN demo_tmpitem ON demo_tmplist.list_id = demo_tmpitem.list_id WHERE demo_tmplist.list_id = %s && demo_tmpitem.lang=%s", GetSQLValueString($collistid_RecordTmpLogoListItem, "int"),GetSQLValueString($collang_RecordTmpLogoListItem, "text"));
$RecordTmpLogoListItem = mysqli_query($DB_Conn, $query_RecordTmpLogoListItem) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoListItem = mysqli_fetch_assoc($RecordTmpLogoListItem);
$totalRows_RecordTmpLogoListItem = mysqli_num_rows($RecordTmpLogoListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordTmpLogoListItem['itemname']] = $row_RecordTmpLogoListItem['itemname']; ?>
<?php } while ($row_RecordTmpLogoListItem = mysqli_fetch_assoc($RecordTmpLogoListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordTmpLogoListItem);
?>
