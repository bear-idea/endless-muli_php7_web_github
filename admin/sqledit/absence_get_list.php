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

$collang_RecordAbsenceListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAbsenceListItem = $_SESSION['lang'];
}
$coluserid_RecordAbsenceListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAbsenceListItem = $w_userid;
}
$collistid_RecordAbsenceListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordAbsenceListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAbsenceListItem = sprintf("SELECT salary_absenceitem.item_id, salary_absencelist.list_id, salary_absencelist.listname, salary_absenceitem.itemname, salary_absenceitem.lang FROM salary_absencelist LEFT OUTER JOIN salary_absenceitem ON salary_absencelist.list_id = salary_absenceitem.list_id WHERE salary_absencelist.list_id = %s && salary_absenceitem.lang=%s && salary_absenceitem.userid = %s", GetSQLValueString($collistid_RecordAbsenceListItem, "int"),GetSQLValueString($collang_RecordAbsenceListItem, "text"),GetSQLValueString($coluserid_RecordAbsenceListItem, "int"));
$RecordAbsenceListItem = mysqli_query($DB_Conn, $query_RecordAbsenceListItem) or die(mysqli_error($DB_Conn));
$row_RecordAbsenceListItem = mysqli_fetch_assoc($RecordAbsenceListItem);
$totalRows_RecordAbsenceListItem = mysqli_num_rows($RecordAbsenceListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordAbsenceListItem['itemname']] = $row_RecordAbsenceListItem['itemname']; ?>
<?php } while ($row_RecordAbsenceListItem = mysqli_fetch_assoc($RecordAbsenceListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordAbsenceListItem);
?>
