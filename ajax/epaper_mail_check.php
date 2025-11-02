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

$colname_EPaperMailCheck = "-1";
if (isset($_POST['mail'])) {
  $colname_EPaperMailCheck = $_POST['mail'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_EPaperMailCheck = sprintf("SELECT * FROM demo_epapermail WHERE mail = %s", GetSQLValueString($colname_EPaperMailCheck, "text"));
$EPaperMailCheck = mysqli_query($DB_Conn, $query_EPaperMailCheck) or die(mysqli_error($DB_Conn));
$row_EPaperMailCheck = mysqli_fetch_assoc($EPaperMailCheck);
$totalRows_EPaperMailCheck = mysqli_num_rows($EPaperMailCheck);

if($totalRows_EPaperMailCheck == '0') {
$insertSQL = sprintf("INSERT INTO demo_epapermail (mail) VALUES (%s)",
                       GetSQLValueString($_POST['mail'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

?>
<?php echo $totalRows_EPaperMailCheck ?>
<?php
mysqli_free_result($EPaperMailCheck);
?>
