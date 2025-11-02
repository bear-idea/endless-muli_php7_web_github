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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpConfig = "SELECT * FROM demo_tmp WHERE name = (SELECT MSTmpSelect FROM demo_setting_fr WHERE id=1)";
$RecordTmpConfig = mysqli_query($DB_Conn, $query_RecordTmpConfig) or die(mysqli_error($DB_Conn));
$row_RecordTmpConfig = mysqli_fetch_assoc($RecordTmpConfig);
$totalRows_RecordTmpConfig = mysqli_num_rows($RecordTmpConfig);
?>
<?php
echo $TmpBanner =  $row_RecordTmpConfig['tmpbanner'];
?><br />
<?php
mysqli_free_result($RecordTmpConfig);
?>