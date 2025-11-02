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

$collang_RecordPayrollListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordPayrollListItem = $_SESSION['lang'];
}
$coluserid_RecordPayrollListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPayrollListItem = $w_userid;
}
$collistid_RecordPayrollListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordPayrollListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPayrollListItem = sprintf("SELECT salary_payrollitem.item_id, salary_payrolllist.list_id, salary_payrolllist.listname, salary_payrollitem.itemname, salary_payrollitem.lang FROM salary_payrolllist LEFT OUTER JOIN salary_payrollitem ON salary_payrolllist.list_id = salary_payrollitem.list_id WHERE salary_payrolllist.list_id = %s && salary_payrollitem.lang=%s && salary_payrollitem.userid = %s", GetSQLValueString($collistid_RecordPayrollListItem, "int"),GetSQLValueString($collang_RecordPayrollListItem, "text"),GetSQLValueString($coluserid_RecordPayrollListItem, "int"));
$RecordPayrollListItem = mysqli_query($DB_Conn, $query_RecordPayrollListItem) or die(mysqli_error($DB_Conn));
$row_RecordPayrollListItem = mysqli_fetch_assoc($RecordPayrollListItem);
$totalRows_RecordPayrollListItem = mysqli_num_rows($RecordPayrollListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordPayrollListItem['itemname']] = $row_RecordPayrollListItem['itemname']; ?>
<?php } while ($row_RecordPayrollListItem = mysqli_fetch_assoc($RecordPayrollListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordPayrollListItem);
?>
