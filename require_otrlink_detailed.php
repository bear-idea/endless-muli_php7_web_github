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

$colname_RecordOtrlinkDetailed = "-1";
if (isset($row_RecordOtrlinkType['itemname'])) {
  $colname_RecordOtrlinkDetailed = $row_RecordOtrlinkType['itemname'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOtrlinkDetailed = sprintf("SELECT * FROM demo_otrlink WHERE type = %s", GetSQLValueString($colname_RecordOtrlinkDetailed, "text"));
$RecordOtrlinkDetailed = mysqli_query($DB_Conn, $query_RecordOtrlinkDetailed) or die(mysqli_error($DB_Conn));
$row_RecordOtrlinkDetailed = mysqli_fetch_assoc($RecordOtrlinkDetailed);
$totalRows_RecordOtrlinkDetailed = mysqli_num_rows($RecordOtrlinkDetailed);
?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
</style>
<?php do { ?>
<?php echo $row_RecordOtrlinkDetailed['name']; ?>
<?php } while ($row_RecordOtrlinkDetailed = mysqli_fetch_assoc($RecordOtrlinkDetailed)); ?>

<?php } else { ?>
<?php include($TplPath . "/otrlink_detailed.php"); ?>
<?php } ?>
<?php

mysqli_free_result($RecordOtrlinkDetailed);
?>
