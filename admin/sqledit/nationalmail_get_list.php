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

$collang_RecordNationalmailListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordNationalmailListItem = $_SESSION['lang'];
}
$coluserid_RecordNationalmailListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNationalmailListItem = $w_userid;
}
$collistid_RecordNationalmailListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordNationalmailListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNationalmailListItem = sprintf("SELECT mail_nationalmailitem.item_id, mail_nationalmaillist.list_id, mail_nationalmaillist.listname, mail_nationalmailitem.itemname, mail_nationalmailitem.lang FROM mail_nationalmaillist LEFT OUTER JOIN mail_nationalmailitem ON mail_nationalmaillist.list_id = mail_nationalmailitem.list_id WHERE mail_nationalmaillist.list_id = %s && mail_nationalmailitem.lang=%s && mail_nationalmailitem.userid = %s", GetSQLValueString($collistid_RecordNationalmailListItem, "int"),GetSQLValueString($collang_RecordNationalmailListItem, "text"),GetSQLValueString($coluserid_RecordNationalmailListItem, "int"));
$RecordNationalmailListItem = mysqli_query($DB_Conn, $query_RecordNationalmailListItem) or die(mysqli_error($DB_Conn));
$row_RecordNationalmailListItem = mysqli_fetch_assoc($RecordNationalmailListItem);
$totalRows_RecordNationalmailListItem = mysqli_num_rows($RecordNationalmailListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordNationalmailListItem['itemname']] = $row_RecordNationalmailListItem['itemname']; ?>
<?php } while ($row_RecordNationalmailListItem = mysqli_fetch_assoc($RecordNationalmailListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordNationalmailListItem);
?>
