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

$colitem_id_RecordAboutListShow = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordAboutListShow = $_GET['id'];
}
$coltype_RecordAboutListShow = "-1";
if (isset($_GET['lv'])) {
  $coltype_RecordAboutListShow = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutListShow = sprintf("SELECT id,  title FROM demo_about WHERE %s = %s", GetSQLValueString($coltype_RecordAboutListShow, "none"),GetSQLValueString($colitem_id_RecordAboutListShow, "int"));
$RecordAboutListShow = mysqli_query($DB_Conn, $query_RecordAboutListShow) or die(mysqli_error($DB_Conn));
$row_RecordAboutListShow = mysqli_fetch_assoc($RecordAboutListShow);
$totalRows_RecordAboutListShow = mysqli_num_rows($RecordAboutListShow);
?>

<?php if($row_RecordAboutListShow['title'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordAboutListShow['id']] = $row_RecordAboutListShow['title']; ?>
<?php } while ($row_RecordAboutListShow = mysqli_fetch_assoc($RecordAboutListShow)); ?>
<?php } else { ?>
	<?php //$data[$coltype_RecordAboutListShow] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordAboutListShow);
?>
