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

$collang_RecordCarnumber = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCarnumber = $_SESSION['lang'];
}

$coluserid_RecordCarnumber = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCarnumber = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCarnumber = sprintf("SELECT * FROM erp_carnumber WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordCarnumber, "text"),GetSQLValueString($coluserid_RecordCarnumber, "int"));
$RecordCarnumber = mysqli_query($DB_Conn, $query_RecordCarnumber) or die(mysqli_error($DB_Conn));
$row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
$totalRows_RecordCarnumber = mysqli_num_rows($RecordCarnumber);

?>

<?php do { ?>
  <?php $data[$row_RecordCarnumber['name']] = $row_RecordCarnumber['name']; ?>
<?php } while ($row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result(RecordCarnumber);
?>
