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

$collang_RecordKnowledgeListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordKnowledgeListItem = $_SESSION['lang'];
}
$coluserid_RecordKnowledgeListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordKnowledgeListItem = $w_userid;
}
$collistid_RecordKnowledgeListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordKnowledgeListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnowledgeListItem = sprintf("SELECT demo_knowledgeitem.item_id, demo_knowledgelist.list_id, demo_knowledgelist.listname, demo_knowledgeitem.itemname, demo_knowledgeitem.lang FROM demo_knowledgelist LEFT OUTER JOIN demo_knowledgeitem ON demo_knowledgelist.list_id = demo_knowledgeitem.list_id WHERE demo_knowledgelist.list_id = %s && demo_knowledgeitem.lang=%s && demo_knowledgeitem.userid=%s", GetSQLValueString($collistid_RecordKnowledgeListItem, "int"),GetSQLValueString($collang_RecordKnowledgeListItem, "text"),GetSQLValueString($coluserid_RecordKnowledgeListItem, "int"));
$RecordKnowledgeListItem = mysqli_query($DB_Conn, $query_RecordKnowledgeListItem) or die(mysqli_error($DB_Conn));
$row_RecordKnowledgeListItem = mysqli_fetch_assoc($RecordKnowledgeListItem);
$totalRows_RecordKnowledgeListItem = mysqli_num_rows($RecordKnowledgeListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordKnowledgeListItem['itemname']] = $row_RecordKnowledgeListItem['itemname']; ?>
<?php } while ($row_RecordKnowledgeListItem = mysqli_fetch_assoc($RecordKnowledgeListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordKnowledgeListItem);
?>
