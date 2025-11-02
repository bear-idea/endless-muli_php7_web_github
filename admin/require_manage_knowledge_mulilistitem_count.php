<?php require_once('../Connections/DB_Conn.php'); ?>
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

if($row_RecordKnowledgeListType['item_id'] != "")
{
	$row_RecordKnowledgeListItem['item_id'] = $row_RecordKnowledgeListType['item_id'];
}

$colname_RecordKnowledgeListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordKnowledgeListTypeCount = $_GET['lang'];
}
$colitem_id_RecordKnowledgeListTypeCount = "-1";
if (isset($row_RecordKnowledgeListItem['item_id'])) {
  $colitem_id_RecordKnowledgeListTypeCount = $row_RecordKnowledgeListItem['item_id'];
}
$coluserid_RecordKnowledgeListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordKnowledgeListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnowledgeListTypeCount = sprintf("SELECT * FROM demo_knowledgeitem WHERE list_id = 1 && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordKnowledgeListTypeCount, "text"),GetSQLValueString($colitem_id_RecordKnowledgeListTypeCount, "int"),GetSQLValueString($coluserid_RecordKnowledgeListTypeCount, "int"));
$RecordKnowledgeListTypeCount = mysqli_query($DB_Conn, $query_RecordKnowledgeListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordKnowledgeListTypeCount = mysqli_fetch_assoc($RecordKnowledgeListTypeCount);
$totalRows_RecordKnowledgeListTypeCount = mysqli_num_rows($RecordKnowledgeListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordKnowledgeListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordKnowledgeListTypeCount);
?>
