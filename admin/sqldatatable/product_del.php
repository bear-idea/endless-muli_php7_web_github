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
  $colname_RecordProductGet = "-1";
  if (isset($_GET['pic'])) {
	$colname_RecordProductGet = $_GET['pic'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordProductGet = sprintf("SELECT id FROM demo_product WHERE pic = %s", GetSQLValueString($colname_RecordProductGet, "text"));
  $RecordProductGet = mysqli_query($DB_Conn, $query_RecordProductGet) or die(mysqli_error($DB_Conn));
  $row_RecordProductGet = mysqli_fetch_assoc($RecordProductGet);
  $totalRows_RecordProductGet = mysqli_num_rows($RecordProductGet);
  
  if($totalRows_RecordProductGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/product/' . $_GET['pic']);
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/product/thumb/small_' . GetFileThumbExtend($_GET['pic']));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_product WHERE userid=%s && id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  // 取得商品多圖資料
  $colname_RecordProductPhotoGet = "-1";
  if (isset($_GET['id_del'])) {
	$colname_RecordProductPhotoGet = $_GET['id_del'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordProductPhotoGet = sprintf("SELECT * FROM demo_productphoto WHERE aid = %s", GetSQLValueString($colname_RecordProductPhotoGet, "int"));
  $RecordProductPhotoGet = mysqli_query($DB_Conn, $query_RecordProductPhotoGet) or die(mysqli_error($DB_Conn));
  $row_RecordProductPhotoGet = mysqli_fetch_assoc($RecordProductPhotoGet);
  $totalRows_RecordProductPhotoGet = mysqli_num_rows($RecordProductPhotoGet);
  do { 
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/product/' . $row_RecordProductPhotoGet['pic']);
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/product/thumb/small_' . GetFileThumbExtend($row_RecordProductPhotoGet['pic']));
  } while ($row_RecordProductPhotoGet = mysqli_fetch_assoc($RecordProductPhotoGet));
  
  $deleteSQL = sprintf("DELETE FROM demo_productphoto WHERE userid=%s && aid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productpost WHERE userid=%s && pid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productreply WHERE userid=%s && pdid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productformat WHERE userid=%s && aid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productspformat WHERE userid=%s && aid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>