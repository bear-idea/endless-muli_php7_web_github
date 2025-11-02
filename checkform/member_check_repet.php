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

$colname_RecordMember = "-1";
if (isset($_GET['username'])) {
  $colname_RecordMember = $_GET['username'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMember = sprintf("SELECT account FROM demo_member WHERE account = %s", GetSQLValueString($colname_RecordMember, "text"));
$RecordMember = mysqli_query($DB_Conn, $query_RecordMember) or die(mysqli_error($DB_Conn));
$row_RecordMember = mysqli_fetch_assoc($RecordMember);
$totalRows_RecordMember = mysqli_num_rows($RecordMember);
?>
<?php
echo $totalRows_RecordMember; // 取得抓到的資料筆數
mysqli_free_result($RecordMember);
?>
