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

$collang_RecordBlacklistListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordBlacklistListItem = $_SESSION['lang'];
}
$coluserid_RecordBlacklistListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBlacklistListItem = $w_userid;
}
$collistid_RecordBlacklistListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordBlacklistListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlacklistListItem = sprintf("SELECT mail_blacklistitem.item_id, mail_blacklistlist.list_id, mail_blacklistlist.listname, mail_blacklistitem.itemname, mail_blacklistitem.lang FROM mail_blacklistlist LEFT OUTER JOIN mail_blacklistitem ON mail_blacklistlist.list_id = mail_blacklistitem.list_id WHERE mail_blacklistlist.list_id = %s && mail_blacklistitem.lang=%s && mail_blacklistitem.userid = %s", GetSQLValueString($collistid_RecordBlacklistListItem, "int"),GetSQLValueString($collang_RecordBlacklistListItem, "text"),GetSQLValueString($coluserid_RecordBlacklistListItem, "int"));
$RecordBlacklistListItem = mysqli_query($DB_Conn, $query_RecordBlacklistListItem) or die(mysqli_error($DB_Conn));
$row_RecordBlacklistListItem = mysqli_fetch_assoc($RecordBlacklistListItem);
$totalRows_RecordBlacklistListItem = mysqli_num_rows($RecordBlacklistListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordBlacklistListItem['itemname']] = $row_RecordBlacklistListItem['itemname']; ?>
<?php } while ($row_RecordBlacklistListItem = mysqli_fetch_assoc($RecordBlacklistListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordBlacklistListItem);
?>
