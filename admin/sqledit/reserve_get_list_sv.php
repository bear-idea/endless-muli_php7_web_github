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

$colroomdate_RecordRoomCheckPeople = "-1";
if (isset($_GET['roomdate'])) {
  $colroomdate_RecordRoomCheckPeople = $_GET['roomdate'];
}
$coluserid_RecordRoomCheckPeople = "-1";
if (isset($w_userid)) {
  $coluserid_RecordRoomCheckPeople = $w_userid;
}
$colroomid_RecordRoomCheckPeople = "-1";
if (isset($_GET['roomid'])) {
  $colroomid_RecordRoomCheckPeople = $_GET['roomid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomCheckPeople = sprintf("SELECT SUM(dcquantiry) AS chickinpeople FROM demo_roomdetail WHERE dcroomdate = %s && userid = %s && roomid = %s", GetSQLValueString($colroomdate_RecordRoomCheckPeople, "date"),GetSQLValueString($coluserid_RecordRoomCheckPeople, "int"),GetSQLValueString($colroomid_RecordRoomCheckPeople, "int"));
$RecordRoomCheckPeople = mysqli_query($DB_Conn, $query_RecordRoomCheckPeople) or die(mysqli_error($DB_Conn));
$row_RecordRoomCheckPeople = mysqli_fetch_assoc($RecordRoomCheckPeople);
$totalRows_RecordRoomCheckPeople = mysqli_num_rows($RecordRoomCheckPeople);
?>


<?php for($i=1; $i<=($_GET['roomnum']/*-$row_RecordRoomCheckPeople['chickinpeople']*/); $i++) { ?>
<?php $data[$i] = $i; ?>
<?php } ?>
<?php //echo $_GET['roomdate'];// = $row_RecordRoomCheckPeople['chickinpeople'] ?>
<?php //$data[$rr] = $rr; ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordRoomCheckPeople);
?>
