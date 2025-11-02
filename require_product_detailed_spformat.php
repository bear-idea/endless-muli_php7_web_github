<?php require_once('Connections/DB_Conn.php'); ?>
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

$colname_RecordProducSptFormat = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProducSptFormat = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProducSptFormat = sprintf("SELECT * FROM demo_productspformat WHERE aid = %s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProducSptFormat, "text"));
$RecordProducSptFormat = mysqli_query($DB_Conn, $query_RecordProducSptFormat) or die(mysqli_error($DB_Conn));
$row_RecordProducSptFormat = mysqli_fetch_assoc($RecordProducSptFormat);
$totalRows_RecordProducSptFormat = mysqli_num_rows($RecordProducSptFormat);
?>


<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/product_detailed_spformat.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordProducSptFormat);
?>
<?php //mysqli_free_result($RecordProductAjaxSpFormat); // 移至 詳細內容頁 ?>

