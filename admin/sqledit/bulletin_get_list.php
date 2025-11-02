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

$collang_RecordBulletinListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordBulletinListItem = $_SESSION['lang'];
}
$coluserid_RecordBulletinListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBulletinListItem = $w_userid;
}
$collistid_RecordBulletinListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordBulletinListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBulletinListItem = sprintf("SELECT demo_bulletinitem.item_id, demo_bulletinlist.list_id, demo_bulletinlist.listname, demo_bulletinitem.itemname, demo_bulletinitem.lang FROM demo_bulletinlist LEFT OUTER JOIN demo_bulletinitem ON demo_bulletinlist.list_id = demo_bulletinitem.list_id WHERE demo_bulletinlist.list_id = %s && demo_bulletinitem.lang=%s && demo_bulletinitem.userid = %s", GetSQLValueString($collistid_RecordBulletinListItem, "int"),GetSQLValueString($collang_RecordBulletinListItem, "text"),GetSQLValueString($coluserid_RecordBulletinListItem, "int"));
$RecordBulletinListItem = mysqli_query($DB_Conn, $query_RecordBulletinListItem) or die(mysqli_error($DB_Conn));
$row_RecordBulletinListItem = mysqli_fetch_assoc($RecordBulletinListItem);
$totalRows_RecordBulletinListItem = mysqli_num_rows($RecordBulletinListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordBulletinListItem['itemname']] = $row_RecordBulletinListItem['itemname']; ?>
<?php } while ($row_RecordBulletinListItem = mysqli_fetch_assoc($RecordBulletinListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordBulletinListItem);
?>
