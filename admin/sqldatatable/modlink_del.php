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
  $colname_RecordModlinkGet = "-1";
  if (isset($_GET['pic'])) {
	$colname_RecordModlinkGet = $_GET['pic'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordModlinkGet = sprintf("SELECT id FROM demo_modlink WHERE pic = %s", GetSQLValueString($colname_RecordModlinkGet, "text"));
  $RecordModlinkGet = mysqli_query($DB_Conn, $query_RecordModlinkGet) or die(mysqli_error($DB_Conn));
  $row_RecordModlinkGet = mysqli_fetch_assoc($RecordModlinkGet);
  $totalRows_RecordModlinkGet = mysqli_num_rows($RecordModlinkGet);
  
  if($totalRows_RecordModlinkGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/modlink/' . $_GET['pic']);
	  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/modlink/thumb/small_' . GetFileThumbExtend($_GET['pic']));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_modlink WHERE userid=%s && id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
}

?>