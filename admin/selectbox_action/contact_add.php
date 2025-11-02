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

$colitem_id_RecordContactListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordContactListItem = $_GET['id'];
}
$collevel_RecordContactListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordContactListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactListItem = sprintf("SELECT item_id, itemname FROM demo_contactitem WHERE subitem_id = %s && level = %s", GetSQLValueString($colitem_id_RecordContactListItem, "int"),GetSQLValueString($collevel_RecordContactListItem, "int"));
$RecordContactListItem = mysqli_query($DB_Conn, $query_RecordContactListItem) or die(mysqli_error($DB_Conn));
$row_RecordContactListItem = mysqli_fetch_assoc($RecordContactListItem);
$totalRows_RecordContactListItem = mysqli_num_rows($RecordContactListItem);
?>

<?php if($row_RecordContactListItem['itemname'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordContactListItem['item_id']] = $row_RecordContactListItem['itemname']; ?>
<?php } while ($row_RecordContactListItem = mysqli_fetch_assoc($RecordContactListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordContactListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordContactListItem);
?>
