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

$collang_RecordAttendanceListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAttendanceListItem = $_SESSION['lang'];
}
$coluserid_RecordAttendanceListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAttendanceListItem = $w_userid;
}
$collistid_RecordAttendanceListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordAttendanceListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttendanceListItem = sprintf("SELECT salary_attendanceitem.item_id, salary_attendancelist.list_id, salary_attendancelist.listname, salary_attendanceitem.itemname, salary_attendanceitem.lang FROM salary_attendancelist LEFT OUTER JOIN salary_attendanceitem ON salary_attendancelist.list_id = salary_attendanceitem.list_id WHERE salary_attendancelist.list_id = %s && salary_attendanceitem.lang=%s && salary_attendanceitem.userid = %s", GetSQLValueString($collistid_RecordAttendanceListItem, "int"),GetSQLValueString($collang_RecordAttendanceListItem, "text"),GetSQLValueString($coluserid_RecordAttendanceListItem, "int"));
$RecordAttendanceListItem = mysqli_query($DB_Conn, $query_RecordAttendanceListItem) or die(mysqli_error($DB_Conn));
$row_RecordAttendanceListItem = mysqli_fetch_assoc($RecordAttendanceListItem);
$totalRows_RecordAttendanceListItem = mysqli_num_rows($RecordAttendanceListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordAttendanceListItem['itemname']] = $row_RecordAttendanceListItem['itemname']; ?>
<?php } while ($row_RecordAttendanceListItem = mysqli_fetch_assoc($RecordAttendanceListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordAttendanceListItem);
?>
