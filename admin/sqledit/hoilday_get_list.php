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

$collang_RecordHoildayListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordHoildayListItem = $_SESSION['lang'];
}
$coluserid_RecordHoildayListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordHoildayListItem = $w_userid;
}
$collistid_RecordHoildayListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordHoildayListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordHoildayListItem = sprintf("SELECT salary_hoildayitem.item_id, salary_hoildaylist.list_id, salary_hoildaylist.listname, salary_hoildayitem.itemname, salary_hoildayitem.lang FROM salary_hoildaylist LEFT OUTER JOIN salary_hoildayitem ON salary_hoildaylist.list_id = salary_hoildayitem.list_id WHERE salary_hoildaylist.list_id = %s && salary_hoildayitem.lang=%s && salary_hoildayitem.userid = %s", GetSQLValueString($collistid_RecordHoildayListItem, "int"),GetSQLValueString($collang_RecordHoildayListItem, "text"),GetSQLValueString($coluserid_RecordHoildayListItem, "int"));
$RecordHoildayListItem = mysqli_query($DB_Conn, $query_RecordHoildayListItem) or die(mysqli_error($DB_Conn));
$row_RecordHoildayListItem = mysqli_fetch_assoc($RecordHoildayListItem);
$totalRows_RecordHoildayListItem = mysqli_num_rows($RecordHoildayListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordHoildayListItem['itemname']] = $row_RecordHoildayListItem['itemname']; ?>
<?php } while ($row_RecordHoildayListItem = mysqli_fetch_assoc($RecordHoildayListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordHoildayListItem);
?>
