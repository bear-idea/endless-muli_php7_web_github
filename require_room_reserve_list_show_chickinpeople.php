<?php require_once('Connections/DB_Conn.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);

$colroomdate_RecordRoomCheckPeople = "-1";
if (isset($N_Date)) {
  $colroomdate_RecordRoomCheckPeople = $N_Date;
}
$coluserid_RecordRoomCheckPeople = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomCheckPeople = $_SESSION['userid'];
}
$colroomid_RecordRoomCheckPeople = "-1";
if (isset($row_RecordRoomCalendar['roomid'])) {
  $colroomid_RecordRoomCheckPeople = $row_RecordRoomCalendar['roomid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomCheckPeople = sprintf("SELECT * FROM demo_roomdetail WHERE dcroomdate = %s && userid = %s && roomid = %s", GetSQLValueString($colroomdate_RecordRoomCheckPeople, "date"),GetSQLValueString($coluserid_RecordRoomCheckPeople, "int"),GetSQLValueString($colroomid_RecordRoomCheckPeople, "int"));
$RecordRoomCheckPeople = mysqli_query($DB_Conn, $query_RecordRoomCheckPeople) or die(mysqli_error($DB_Conn));
$row_RecordRoomCheckPeople = mysqli_fetch_assoc($RecordRoomCheckPeople);
$totalRows_RecordRoomCheckPeople = mysqli_num_rows($RecordRoomCheckPeople);
}			
?>
<?php $Count_Room = 0; ?>
<?php do { ?>
<?php $Count_Room += $row_RecordRoomCheckPeople['dcquantiry']; ?>
<?php } while ($row_RecordRoomCheckPeople = mysqli_fetch_assoc($RecordRoomCheckPeople)); ?>
<?php //echo $row_RecordRoomCheckPeople['chickinpeople']; ?>
<?php
mysqli_free_result($RecordRoomCheckPeople);
?>