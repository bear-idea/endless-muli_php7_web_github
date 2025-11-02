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

$coluserid_RecordRoomGetRoomNum = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomGetRoomNum = $_SESSION['userid'];
}
$colroomid_RecordRoomGetRoomNum = "-1";
if (isset($row_RecordRoomCalendar['roomid'])) {
  $colroomid_RecordRoomGetRoomNum = $row_RecordRoomCalendar['roomid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomGetRoomNum = sprintf("SELECT roomnum FROM demo_room WHERE userid = %s && id = %s", GetSQLValueString($coluserid_RecordRoomGetRoomNum, "int"),GetSQLValueString($colroomid_RecordRoomGetRoomNum, "int"));
$RecordRoomGetRoomNum = mysqli_query($DB_Conn, $query_RecordRoomGetRoomNum) or die(mysqli_error($DB_Conn));
$row_RecordRoomGetRoomNum = mysqli_fetch_assoc($RecordRoomGetRoomNum);
$totalRows_RecordRoomGetRoomNum = mysqli_num_rows($RecordRoomGetRoomNum);
}			
?>
<?php //echo $row_RecordRoomGetRoomNum['roomnum']; ?>
<?php
mysqli_free_result($RecordRoomGetRoomNum);
?>