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

$collang_RecordCartListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCartListItem = $_SESSION['lang'];
}
$coluserid_RecordCartListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartListItem = $w_userid;
}
$collistid_RecordCartListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCartListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListItem = sprintf("SELECT demo_cartitem.item_id, demo_cartlist.list_id, demo_cartlist.listname, demo_cartitem.itemname, demo_cartitem.lang FROM demo_cartlist LEFT OUTER JOIN demo_cartitem ON demo_cartlist.list_id = demo_cartitem.list_id WHERE demo_cartlist.list_id = %s && demo_cartitem.lang=%s && demo_cartitem.userid=%s", GetSQLValueString($collistid_RecordCartListItem, "int"),GetSQLValueString($collang_RecordCartListItem, "text"),GetSQLValueString($coluserid_RecordCartListItem, "int"));
$RecordCartListItem = mysqli_query($DB_Conn, $query_RecordCartListItem) or die(mysqli_error($DB_Conn));
$row_RecordCartListItem = mysqli_fetch_assoc($RecordCartListItem);
$totalRows_RecordCartListItem = mysqli_num_rows($RecordCartListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordCartListItem['itemname']] = $row_RecordCartListItem['itemname']; ?>
<?php } while ($row_RecordCartListItem = mysqli_fetch_assoc($RecordCartListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordCartListItem);
?>
