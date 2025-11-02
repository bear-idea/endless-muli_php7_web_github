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
}

/* 取得產品資訊 */
$coluserid_RecordRoomCalendar = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomCalendar = $_SESSION['userid'];
}
$colnamelang_RecordRoomCalendar = "zh-tw";
if (isset($_SESSION['lang'])) {
  $colnamelang_RecordRoomCalendar = $_SESSION['lang'];
}
$colstartdate_RecordRoomCalendar = "-1";
if (isset($N_Date)) {
  $colstartdate_RecordRoomCalendar = $N_Date;
}
$colenddate_RecordRoomCalendar = "-1";
if (isset($N_Date)) {
  $colenddate_RecordRoomCalendar = $N_Date;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomCalendar = sprintf("SELECT demo_roomcalendar.roomid, demo_roomcalendar.id, demo_roomcalendar.name, demo_roomcalendar.peoplenum, demo_roomcalendar.lang, demo_roomcalendar.roomdate, demo_roomcalendar.peoplenum, demo_roomcalendar.roomnum, demo_roomcalendar.roomprice, demo_roomcalendar.userid, demo_roomcalendar.roomtype, demo_roomcalendar.indicate, demo_roomcalendar.doublecheck, demo_room.pic, demo_room.type1, demo_room.type2, demo_room.type3 FROM demo_roomcalendar LEFT OUTER JOIN demo_room ON demo_roomcalendar.roomid = demo_room.id HAVING demo_roomcalendar.lang = %s && demo_roomcalendar.roomnum != 0 && demo_roomcalendar.roomdate BETWEEN %s AND %s && demo_roomcalendar.userid=%s && demo_roomcalendar.doublecheck=1 ORDER BY demo_roomcalendar.name ASC, demo_roomcalendar.roomtype ASC", GetSQLValueString($colnamelang_RecordRoomCalendar, "text"),GetSQLValueString($colstartdate_RecordRoomCalendar, "date"),GetSQLValueString($colenddate_RecordRoomCalendar, "date"),GetSQLValueString($coluserid_RecordRoomCalendar, "int"));
$RecordRoomCalendar = mysqli_query($DB_Conn, $query_RecordRoomCalendar) or die(mysqli_error($DB_Conn));
$row_RecordRoomCalendar = mysqli_fetch_assoc($RecordRoomCalendar);
$totalRows_RecordRoomCalendar = mysqli_num_rows($RecordRoomCalendar);			
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/room_reserve_list.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordRoomCalendar);
?>