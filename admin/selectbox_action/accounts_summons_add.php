<?php require_once('../../Connections/DB_Conn.php'); ?>
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

$colitem_id_RecordAccounts_summonsListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordAccounts_summonsListItem = $_GET['id'];
}
$collevel_RecordAccounts_summonsListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordAccounts_summonsListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListItem = sprintf("SELECT item_id, itemname FROM invoicing_accounts_summonsitem WHERE subitem_id = %s && level = %s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colitem_id_RecordAccounts_summonsListItem, "int"),GetSQLValueString($collevel_RecordAccounts_summonsListItem, "int"));
$RecordAccounts_summonsListItem = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListItem) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListItem = mysqli_fetch_assoc($RecordAccounts_summonsListItem);
$totalRows_RecordAccounts_summonsListItem = mysqli_num_rows($RecordAccounts_summonsListItem);
?>

<?php if($row_RecordAccounts_summonsListItem['itemname'] != ''){ ?>

<?php do { ?>
    <?php $data[$row_RecordAccounts_summonsListItem['item_id']] = $row_RecordAccounts_summonsListItem['itemname']; ?>
<?php } while ($row_RecordAccounts_summonsListItem = mysqli_fetch_assoc($RecordAccounts_summonsListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordAccounts_summonsListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordAccounts_summonsListItem);
?>
