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

$collang_RecordWorksheet = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordWorksheet = $_SESSION['lang'];
}
$coluserid_RecordWorksheet = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWorksheet = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE lang = %s && userid=%s", GetSQLValueString($collang_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);
?>

<?php do { ?>
  <?php $data[$row_RecordWorksheet['id']] = $row_RecordWorksheet['title']; ?>
<?php } while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordWorksheet);
?>
