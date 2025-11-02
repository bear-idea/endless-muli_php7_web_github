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

$collang_RecordOtrlinkListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordOtrlinkListItem = $_SESSION['lang'];
}
$coluserid_RecordOtrlinkListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordOtrlinkListItem = $w_userid;
}
$collistid_RecordOtrlinkListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordOtrlinkListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOtrlinkListItem = sprintf("SELECT demo_otrlinkitem.item_id, demo_otrlinklist.list_id, demo_otrlinklist.listname, demo_otrlinkitem.itemname, demo_otrlinkitem.lang FROM demo_otrlinklist LEFT OUTER JOIN demo_otrlinkitem ON demo_otrlinklist.list_id = demo_otrlinkitem.list_id WHERE demo_otrlinklist.list_id = %s && demo_otrlinkitem.lang=%s && demo_otrlinkitem.userid=%s", GetSQLValueString($collistid_RecordOtrlinkListItem, "int"),GetSQLValueString($collang_RecordOtrlinkListItem, "text"),GetSQLValueString($coluserid_RecordOtrlinkListItem, "int"));
$RecordOtrlinkListItem = mysqli_query($DB_Conn, $query_RecordOtrlinkListItem) or die(mysqli_error($DB_Conn));
$row_RecordOtrlinkListItem = mysqli_fetch_assoc($RecordOtrlinkListItem);
$totalRows_RecordOtrlinkListItem = mysqli_num_rows($RecordOtrlinkListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordOtrlinkListItem['itemname']] = $row_RecordOtrlinkListItem['itemname']; ?>
<?php } while ($row_RecordOtrlinkListItem = mysqli_fetch_assoc($RecordOtrlinkListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordOtrlinkListItem);
?>
