<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../../inc/inc_function.php"); ?>
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

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
	
    $colname_RecordScaleorder = "-1";
	if (isset($_GET['id_del'])) {
	  $colname_RecordScaleorder = $_GET['id_del'];
	}
	$coluserid_RecordScaleorder = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordScaleorder = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordScaleorder = sprintf("SELECT * FROM erp_scaleorderout WHERE oid = %s && userid=%s", GetSQLValueString($colname_RecordScaleorder, "int"),GetSQLValueString($coluserid_RecordScaleorder, "int"));
	$RecordScaleorder = mysqli_query($DB_Conn, $query_RecordScaleorder) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder);
	$totalRows_RecordScaleorder = mysqli_num_rows($RecordScaleorder);

  $updateSQL = sprintf("UPDATE erp_scaleorderout SET pic4=%s WHERE oid=%s",
                       GetSQLValueString("", "text"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scaleorder/' . $row_RecordScaleorder['pic4']);
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scaleorder/thumb/small_' . GetFileThumbExtend($row_RecordScaleorder['pic4']));
}

echo json_encode("success");
?>