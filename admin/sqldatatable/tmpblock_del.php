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
  
  /* 先取得資料庫是否有圖 */
  $colname_RecordTmpblockGet = "-1";
  if (isset($_GET['id_del'])) {
	$colname_RecordTmpblockGet = $_GET['id_del'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordTmpblockGet = sprintf("SELECT * FROM demo_tmpblock WHERE id = %s", GetSQLValueString($colname_RecordTmpblockGet, "int"));
  $RecordTmpblockGet = mysqli_query($DB_Conn, $query_RecordTmpblockGet) or die(mysqli_error($DB_Conn));
  $row_RecordTmpblockGet = mysqli_fetch_assoc($RecordTmpblockGet);
  $totalRows_RecordTmpblockGet = mysqli_num_rows($RecordTmpblockGet);
  
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpblock/' . $row_RecordTmpblockGet['tmp_title_pic']);
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpblock/' . $row_RecordTmpblockGet['tmp_middle_pic']);
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpblock/' . $row_RecordTmpblockGet['tmp_bottom_pic']);
  
  $deleteSQL = sprintf("DELETE FROM demo_tmpblock WHERE userid=%s && id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
}

?>