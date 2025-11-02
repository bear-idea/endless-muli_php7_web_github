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

$collang_RecordSalaryformListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordSalaryformListItem = $_SESSION['lang'];
}
$coluserid_RecordSalaryformListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSalaryformListItem = $w_userid;
}
$collistid_RecordSalaryformListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordSalaryformListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSalaryformListItem = sprintf("SELECT salary_salaryformitem.item_id, salary_salaryformlist.list_id, salary_salaryformlist.listname, salary_salaryformitem.itemname, salary_salaryformitem.lang FROM salary_salaryformlist LEFT OUTER JOIN salary_salaryformitem ON salary_salaryformlist.list_id = salary_salaryformitem.list_id WHERE salary_salaryformlist.list_id = %s && salary_salaryformitem.lang=%s && salary_salaryformitem.userid = %s", GetSQLValueString($collistid_RecordSalaryformListItem, "int"),GetSQLValueString($collang_RecordSalaryformListItem, "text"),GetSQLValueString($coluserid_RecordSalaryformListItem, "int"));
$RecordSalaryformListItem = mysqli_query($DB_Conn, $query_RecordSalaryformListItem) or die(mysqli_error($DB_Conn));
$row_RecordSalaryformListItem = mysqli_fetch_assoc($RecordSalaryformListItem);
$totalRows_RecordSalaryformListItem = mysqli_num_rows($RecordSalaryformListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordSalaryformListItem['itemname']] = $row_RecordSalaryformListItem['itemname']; ?>
<?php } while ($row_RecordSalaryformListItem = mysqli_fetch_assoc($RecordSalaryformListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordSalaryformListItem);
?>
