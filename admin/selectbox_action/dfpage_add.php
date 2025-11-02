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

$colitem_id_RecordDfPageListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordDfPageListItem = $_GET['id'];
}
$collevel_RecordDfPageListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordDfPageListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageListItem = sprintf("SELECT item_id, itemname FROM demo_dfpageitem WHERE subitem_id = %s && level = %s", GetSQLValueString($colitem_id_RecordDfPageListItem, "int"),GetSQLValueString($collevel_RecordDfPageListItem, "int"));
$RecordDfPageListItem = mysqli_query($DB_Conn, $query_RecordDfPageListItem) or die(mysqli_error($DB_Conn));
$row_RecordDfPageListItem = mysqli_fetch_assoc($RecordDfPageListItem);
$totalRows_RecordDfPageListItem = mysqli_num_rows($RecordDfPageListItem);
?>

<?php if($row_RecordDfPageListItem['itemname'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordDfPageListItem['item_id']] = $row_RecordDfPageListItem['itemname']; ?>
<?php } while ($row_RecordDfPageListItem = mysqli_fetch_assoc($RecordDfPageListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordDfPageListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordDfPageListItem);
?>
