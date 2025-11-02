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

$colitem_id_RecordBlogListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordBlogListItem = $_GET['id'];
}
$collevel_RecordBlogListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordBlogListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogListItem = sprintf("SELECT item_id, itemname FROM demo_blogitem WHERE subitem_id = %s && level = %s", GetSQLValueString($colitem_id_RecordBlogListItem, "int"),GetSQLValueString($collevel_RecordBlogListItem, "int"));
$RecordBlogListItem = mysqli_query($DB_Conn, $query_RecordBlogListItem) or die(mysqli_error($DB_Conn));
$row_RecordBlogListItem = mysqli_fetch_assoc($RecordBlogListItem);
$totalRows_RecordBlogListItem = mysqli_num_rows($RecordBlogListItem);
?>

<?php if($row_RecordBlogListItem['itemname'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordBlogListItem['item_id']] = $row_RecordBlogListItem['itemname']; ?>
<?php } while ($row_RecordBlogListItem = mysqli_fetch_assoc($RecordBlogListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordBlogListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordBlogListItem);
?>
