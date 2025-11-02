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

$colitem_id_RecordSettingListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordSettingListItem = $_GET['id'];
}
$collevel_RecordSettingListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordSettingListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingListItem = sprintf("SELECT item_id, itemname FROM demo_settingitem WHERE subitem_id = %s && level = %s", GetSQLValueString($colitem_id_RecordSettingListItem, "int"),GetSQLValueString($collevel_RecordSettingListItem, "int"));
$RecordSettingListItem = mysqli_query($DB_Conn, $query_RecordSettingListItem) or die(mysqli_error($DB_Conn));
$row_RecordSettingListItem = mysqli_fetch_assoc($RecordSettingListItem);
$totalRows_RecordSettingListItem = mysqli_num_rows($RecordSettingListItem);
?>

<?php if($row_RecordSettingListItem['itemname'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordSettingListItem['item_id']] = $row_RecordSettingListItem['itemname']; ?>
<?php } while ($row_RecordSettingListItem = mysqli_fetch_assoc($RecordSettingListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordSettingListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordSettingListItem);
?>
