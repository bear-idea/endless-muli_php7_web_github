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

$collang_RecordStaffListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordStaffListItem = $_SESSION['lang'];
}
$coluserid_RecordStaffListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStaffListItem = $w_userid;
}
$collistid_RecordStaffListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordStaffListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStaffListItem = sprintf("SELECT salary_staffitem.item_id, salary_stafflist.list_id, salary_stafflist.listname, salary_staffitem.itemname, salary_staffitem.lang FROM salary_stafflist LEFT OUTER JOIN salary_staffitem ON salary_stafflist.list_id = salary_staffitem.list_id WHERE salary_stafflist.list_id = %s && salary_staffitem.lang=%s && salary_staffitem.userid = %s", GetSQLValueString($collistid_RecordStaffListItem, "int"),GetSQLValueString($collang_RecordStaffListItem, "text"),GetSQLValueString($coluserid_RecordStaffListItem, "int"));
$RecordStaffListItem = mysqli_query($DB_Conn, $query_RecordStaffListItem) or die(mysqli_error($DB_Conn));
$row_RecordStaffListItem = mysqli_fetch_assoc($RecordStaffListItem);
$totalRows_RecordStaffListItem = mysqli_num_rows($RecordStaffListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordStaffListItem['itemname']] = $row_RecordStaffListItem['itemname']; ?>
<?php } while ($row_RecordStaffListItem = mysqli_fetch_assoc($RecordStaffListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordStaffListItem);
?>
