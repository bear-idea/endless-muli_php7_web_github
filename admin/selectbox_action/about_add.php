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

$colitem_id_RecordAboutListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordAboutListItem = $_GET['id'];
}
$collevel_RecordAboutListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordAboutListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutListItem = sprintf("SELECT item_id, itemname FROM demo_aboutitem WHERE subitem_id = %s && level = %s", GetSQLValueString($colitem_id_RecordAboutListItem, "int"),GetSQLValueString($collevel_RecordAboutListItem, "int"));
$RecordAboutListItem = mysqli_query($DB_Conn, $query_RecordAboutListItem) or die(mysqli_error($DB_Conn));
$row_RecordAboutListItem = mysqli_fetch_assoc($RecordAboutListItem);
$totalRows_RecordAboutListItem = mysqli_num_rows($RecordAboutListItem);
?>

<?php if($row_RecordAboutListItem['itemname'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordAboutListItem['item_id']] = $row_RecordAboutListItem['itemname']; ?>
<?php } while ($row_RecordAboutListItem = mysqli_fetch_assoc($RecordAboutListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordAboutListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordAboutListItem);
?>
