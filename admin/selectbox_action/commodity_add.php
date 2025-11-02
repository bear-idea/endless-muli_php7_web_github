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

$colitem_id_RecordScaleListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordScaleListItem = $_GET['id'];
}
$collevel_RecordScaleListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordScaleListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleListItem = sprintf("SELECT item_id, itemname FROM invoicing_commodityitem WHERE subitem_id = %s && level = %s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colitem_id_RecordScaleListItem, "int"),GetSQLValueString($collevel_RecordScaleListItem, "int"));
$RecordScaleListItem = mysqli_query($DB_Conn, $query_RecordScaleListItem) or die(mysqli_error($DB_Conn));
$row_RecordScaleListItem = mysqli_fetch_assoc($RecordScaleListItem);
$totalRows_RecordScaleListItem = mysqli_num_rows($RecordScaleListItem);
?>

<?php if($row_RecordScaleListItem['itemname'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordScaleListItem['item_id']] = $row_RecordScaleListItem['itemname']; ?>
<?php } while ($row_RecordScaleListItem = mysqli_fetch_assoc($RecordScaleListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordScaleListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordScaleListItem);
?>
