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
  // 取得商品多圖資料
  $colname_RecordSplitorderphotoGet = "-1";
  if (isset($_GET['id_del'])) {
	$colname_RecordSplitorderphotoGet = $_GET['id_del'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordSplitorderphotoGet = sprintf("SELECT * FROM erp_splitorderphoto WHERE aid = %s", GetSQLValueString($colname_RecordSplitorderphotoGet, "int"));
  $RecordSplitorderphotoGet = mysqli_query($DB_Conn, $query_RecordSplitorderphotoGet) or die(mysqli_error($DB_Conn));
  $row_RecordSplitorderphotoGet = mysqli_fetch_assoc($RecordSplitorderphotoGet);
  $totalRows_RecordSplitorderphotoGet = mysqli_num_rows($RecordSplitorderphotoGet);
  do { 
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scaleorder_split/' . $row_RecordSplitorderphotoGet['pic']);
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scaleorder_split/thumb/small_' . GetFileThumbExtend($row_RecordSplitorderphotoGet['pic']));
  } while ($row_RecordSplitorderphotoGet = mysqli_fetch_assoc($RecordSplitorderphotoGet));
  
  $deleteSQL = sprintf("DELETE FROM erp_splitorderphoto WHERE userid=%s && aid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM erp_splitorder WHERE oid=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM erp_splitorderdetial WHERE oid=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>
