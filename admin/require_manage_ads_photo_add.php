<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

$colname_RecordAd = "-1";
if (isset($_GET['act_id'])) {
  $colname_RecordAd = $_GET['act_id'];
}
$coluserid_RecordAd = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAd = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAd = sprintf("SELECT * FROM demo_adtype WHERE act_id = %s && userid=%s", GetSQLValueString($colname_RecordAd, "int"),GetSQLValueString($coluserid_RecordAd, "int"));
$RecordAd = mysqli_query($DB_Conn, $query_RecordAd) or die(mysqli_error($DB_Conn));
$row_RecordAd = mysqli_fetch_assoc($RecordAd);
$totalRows_RecordAd = mysqli_num_rows($RecordAd);
?>


<?php
if($totalRows_RecordAd > 0) {
			switch($row_RecordAd['modstyle'])
			{
				case "0":
					include_once("require_manage_ads_photo_add_mod1.php");			
					break;
				case "1":
					include_once("require_manage_ads_photo_add_mod2.php");			
					break;
				default:
					include_once("require_manage_ads_photo_add_mod1.php");
					break;
			}
}
?>


<?php
mysqli_free_result($RecordAd);
?>
