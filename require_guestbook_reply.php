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

$colname_RecordGuestbookReply = "-1";
if (isset($_GET['lang'])) {
  $colname_RecordGuestbookReply = $_GET['lang'];
}
$coluserid_RecordGuestbookReply = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordGuestbookReply = $_SESSION['userid'];
}
$colreplymessageid_RecordGuestbookReply = "-1";
if (isset($row_RecordGuestbookMessage['message_id'])) {
  $colreplymessageid_RecordGuestbookReply = $row_RecordGuestbookMessage['message_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordGuestbookReply = sprintf("SELECT * FROM demo_guestbookreply WHERE lang = %s && message_id = %s && userid=%s ORDER BY reply_id DESC", GetSQLValueString($colname_RecordGuestbookReply, "text"),GetSQLValueString($colreplymessageid_RecordGuestbookReply, "int"),GetSQLValueString($coluserid_RecordGuestbookReply, "int"));
$RecordGuestbookReply = mysqli_query($DB_Conn, $query_RecordGuestbookReply) or die(mysqli_error($DB_Conn));
$row_RecordGuestbookReply = mysqli_fetch_assoc($RecordGuestbookReply);
$totalRows_RecordGuestbookReply = mysqli_num_rows($RecordGuestbookReply);
?>
<?php require_once("inc/inc_function.php"); ?>
<?php include($TplPath . "/guestbook_reply.php"); ?>
<?php
mysqli_free_result($RecordGuestbookReply);
?>
