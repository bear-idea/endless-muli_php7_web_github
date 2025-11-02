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

$collang_RecordCompanyListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCompanyListItem = $_SESSION['lang'];
}
$coluserid_RecordCompanyListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCompanyListItem = $w_userid;
}
$collistid_RecordCompanyListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCompanyListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCompanyListItem = sprintf("SELECT invoicing_companyitem.item_id, invoicing_companylist.list_id, invoicing_companylist.listname, invoicing_companyitem.itemname, invoicing_companyitem.lang FROM invoicing_companylist LEFT OUTER JOIN invoicing_companyitem ON invoicing_companylist.list_id = invoicing_companyitem.list_id WHERE invoicing_companylist.list_id = %s && invoicing_companyitem.lang=%s && invoicing_companyitem.userid = %s", GetSQLValueString($collistid_RecordCompanyListItem, "int"),GetSQLValueString($collang_RecordCompanyListItem, "text"),GetSQLValueString($coluserid_RecordCompanyListItem, "int"));
$RecordCompanyListItem = mysqli_query($DB_Conn, $query_RecordCompanyListItem) or die(mysqli_error($DB_Conn));
$row_RecordCompanyListItem = mysqli_fetch_assoc($RecordCompanyListItem);
$totalRows_RecordCompanyListItem = mysqli_num_rows($RecordCompanyListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordCompanyListItem['itemname']] = $row_RecordCompanyListItem['itemname']; ?>
<?php } while ($row_RecordCompanyListItem = mysqli_fetch_assoc($RecordCompanyListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordCompanyListItem);
?>
