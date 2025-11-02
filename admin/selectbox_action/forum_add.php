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

$colitem_id_RecordForumListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordForumListItem = $_GET['id'];
}
$collevel_RecordForumListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordForumListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumListItem = sprintf("SELECT item_id, itemname FROM demo_forumitem WHERE subitem_id = %s && level = %s", GetSQLValueString($colitem_id_RecordForumListItem, "int"),GetSQLValueString($collevel_RecordForumListItem, "int"));
$RecordForumListItem = mysqli_query($DB_Conn, $query_RecordForumListItem) or die(mysqli_error($DB_Conn));
$row_RecordForumListItem = mysqli_fetch_assoc($RecordForumListItem);
$totalRows_RecordForumListItem = mysqli_num_rows($RecordForumListItem);
?>

<?php if($row_RecordForumListItem['itemname'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordForumListItem['item_id']] = $row_RecordForumListItem['itemname']; ?>
<?php } while ($row_RecordForumListItem = mysqli_fetch_assoc($RecordForumListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordForumListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordForumListItem);
?>
