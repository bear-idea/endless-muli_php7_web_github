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

/*$coluserid_RecordTodayViewCount = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTodayViewCount = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTodayViewCount = sprintf("SELECT * FROM demo_viewcount WHERE view_time LIKE '%%$viewcount_today%%' && userid=%s", GetSQLValueString($coluserid_RecordTodayViewCount, "int"));
$RecordTodayViewCount = mysqli_query($DB_Conn, $query_RecordTodayViewCount) or die(mysqli_error($DB_Conn));
$row_RecordTodayViewCount = mysqli_fetch_assoc($RecordTodayViewCount);
$totalRows_RecordTodayViewCount = mysqli_num_rows($RecordTodayViewCount);*/

$colname_RecordTotleViewCount = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordTotleViewCount = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTotleViewCount = sprintf("SELECT hot, yhot, nhot FROM demo_admin WHERE id = %s", GetSQLValueString($colname_RecordTotleViewCount, "int"));
$RecordTotleViewCount = mysqli_query($DB_Conn, $query_RecordTotleViewCount) or die(mysqli_error($DB_Conn));
$row_RecordTotleViewCount = mysqli_fetch_assoc($RecordTotleViewCount);
$totalRows_RecordTotleViewCount = mysqli_num_rows($RecordTotleViewCount);

?>
<?php echo $Lang_Today_Visitors . ":" . $row_RecordTotleViewCount['nhot']; ?>
<br />
<?php echo $Lang_Total_Visitors . ":" . ($SiteStartCounter + $row_RecordTotleViewCount['hot']); ?>
<?php
//mysqli_free_result($RecordTodayViewCount);
?>
