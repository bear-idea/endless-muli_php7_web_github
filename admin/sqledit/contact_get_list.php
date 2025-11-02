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

$collang_RecordContactListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordContactListItem = $_SESSION['lang'];
}
$coluserid_RecordContactListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordContactListItem = $w_userid;
}
$collistid_RecordContactListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordContactListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactListItem = sprintf("SELECT demo_contactitem.item_id, demo_contactlist.list_id, demo_contactlist.listname, demo_contactitem.itemname, demo_contactitem.lang FROM demo_contactlist LEFT OUTER JOIN demo_contactitem ON demo_contactlist.list_id = demo_contactitem.list_id WHERE demo_contactlist.list_id = %s && demo_contactitem.lang=%s && demo_contactitem.userid=%s", GetSQLValueString($collistid_RecordContactListItem, "int"),GetSQLValueString($collang_RecordContactListItem, "text"),GetSQLValueString($coluserid_RecordContactListItem, "int"));
$RecordContactListItem = mysqli_query($DB_Conn, $query_RecordContactListItem) or die(mysqli_error($DB_Conn));
$row_RecordContactListItem = mysqli_fetch_assoc($RecordContactListItem);
$totalRows_RecordContactListItem = mysqli_num_rows($RecordContactListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordContactListItem['item_id']] = $row_RecordContactListItem['itemname']; ?>
<?php } while ($row_RecordContactListItem = mysqli_fetch_assoc($RecordContactListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordContactListItem);
?>
