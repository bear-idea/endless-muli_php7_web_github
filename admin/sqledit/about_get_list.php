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

$collang_RecordAboutListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAboutListItem = $_SESSION['lang'];
}
$coluserid_RecordAboutListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAboutListItem = $w_userid;
}
$collistid_RecordAboutListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordAboutListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutListItem = sprintf("SELECT demo_aboutitem.item_id, demo_aboutlist.list_id, demo_aboutlist.listname, demo_aboutitem.itemname, demo_aboutitem.lang FROM demo_aboutlist LEFT OUTER JOIN demo_aboutitem ON demo_aboutlist.list_id = demo_aboutitem.list_id WHERE demo_aboutlist.list_id = %s && demo_aboutitem.lang=%s && demo_aboutitem.userid=%s", GetSQLValueString($collistid_RecordAboutListItem, "int"),GetSQLValueString($collang_RecordAboutListItem, "text"),GetSQLValueString($coluserid_RecordAboutListItem, "int"));
$RecordAboutListItem = mysqli_query($DB_Conn, $query_RecordAboutListItem) or die(mysqli_error($DB_Conn));
$row_RecordAboutListItem = mysqli_fetch_assoc($RecordAboutListItem);
$totalRows_RecordAboutListItem = mysqli_num_rows($RecordAboutListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordAboutListItem['item_id']] = $row_RecordAboutListItem['itemname']; ?>
<?php } while ($row_RecordAboutListItem = mysqli_fetch_assoc($RecordAboutListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordAboutListItem);
?>
