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

$collang_RecordLettersListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordLettersListItem = $_SESSION['lang'];
}
$coluserid_RecordLettersListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordLettersListItem = $w_userid;
}
$collistid_RecordLettersListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordLettersListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordLettersListItem = sprintf("SELECT demo_lettersitem.item_id, demo_letterslist.list_id, demo_letterslist.listname, demo_lettersitem.itemname, demo_lettersitem.lang FROM demo_letterslist LEFT OUTER JOIN demo_lettersitem ON demo_letterslist.list_id = demo_lettersitem.list_id WHERE demo_letterslist.list_id = %s && demo_lettersitem.lang=%s && demo_lettersitem.userid = %s", GetSQLValueString($collistid_RecordLettersListItem, "int"),GetSQLValueString($collang_RecordLettersListItem, "text"),GetSQLValueString($coluserid_RecordLettersListItem, "int"));
$RecordLettersListItem = mysqli_query($DB_Conn, $query_RecordLettersListItem) or die(mysqli_error($DB_Conn));
$row_RecordLettersListItem = mysqli_fetch_assoc($RecordLettersListItem);
$totalRows_RecordLettersListItem = mysqli_num_rows($RecordLettersListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordLettersListItem['itemname']] = $row_RecordLettersListItem['itemname']; ?>
<?php } while ($row_RecordLettersListItem = mysqli_fetch_assoc($RecordLettersListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordLettersListItem);
?>
