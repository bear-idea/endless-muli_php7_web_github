<?php require_once('../Connections/DB_Conn.php'); ?>
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

$coltype_RecordNationmailCount = "-1";
if (isset($row_RecordNationalmailListItem['itemvalue'])) {
  $coltype_RecordNationmailCount = $row_RecordNationalmailListItem['itemvalue'];
}
$colname_RecordNationmailCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordNationmailCount = $_GET['lang'];
}
$coluserid_RecordNationmailCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNationmailCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNationmailCount = sprintf("SELECT * FROM mail_nationalmail WHERE type = %s && lang=%s && userid=%s ORDER BY sortid ASC", GetSQLValueString($coltype_RecordNationmailCount, "text"), GetSQLValueString($colname_RecordNationmailCount, "text"),GetSQLValueString($coluserid_RecordNationmailCount, "int"));
$RecordNationmailCount = mysqli_query($DB_Conn, $query_RecordNationmailCount) or die(mysqli_error($DB_Conn));
$row_RecordNationmailCount = mysqli_fetch_assoc($RecordNationmailCount);
$totalRows_RecordNationmailCount = mysqli_num_rows($RecordNationmailCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordNationmailCount . "</span>"; ?>
<?php
mysqli_free_result($RecordNationmailCount);
?>
