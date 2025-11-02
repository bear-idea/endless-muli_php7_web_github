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

$collang_RecordCareersMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCareersMultiTopMenu_l1 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersMultiTopMenu_l1 = sprintf("SELECT * FROM demo_careersitem WHERE list_id = 1 && lang = %s ORDER BY item_id DESC", GetSQLValueString($collang_RecordCareersMultiTopMenu_l1, "text"));
$RecordCareersMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordCareersMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordCareersMultiTopMenu_l1 = mysqli_fetch_assoc($RecordCareersMultiTopMenu_l1);
$totalRows_RecordCareersMultiTopMenu_l1 = mysqli_num_rows($RecordCareersMultiTopMenu_l1);
?>