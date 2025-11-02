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

$colname_RecordAdsView = "-1";
if (isset($_GET['act_id'])) {
  $colname_RecordAdsView = $_GET['act_id'];
}
$coluserid_RecordAdsView = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAdsView = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAdsView = sprintf("SELECT * FROM demo_adtype WHERE act_id = %s && userid=%s", GetSQLValueString($colname_RecordAdsView, "int"),GetSQLValueString($coluserid_RecordAdsView, "int"));
$RecordAdsView = mysqli_query($DB_Conn, $query_RecordAdsView) or die(mysqli_error($DB_Conn));
$row_RecordAdsView = mysqli_fetch_assoc($RecordAdsView);
$totalRows_RecordAdsView = mysqli_num_rows($RecordAdsView);
?>


<?php
if($totalRows_RecordAdsView > 0) {
			switch($row_RecordAdsView['modstyle'])
			{
				case "0":
					include_once("require_manage_ads_photo_edit_mod1.php");			
					break;
				case "1":
					include_once("require_manage_ads_photo_edit_mod2.php");			
					break;
				default:
					include_once("require_manage_ads_photo_edit_mod1.php");
					break;
			}
}
?>


<?php
mysqli_free_result($RecordAdsView);
?>
