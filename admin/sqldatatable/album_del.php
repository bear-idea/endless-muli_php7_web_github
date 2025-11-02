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
  
  $deleteSQL = sprintf("DELETE FROM demo_album WHERE userid=%s && act_id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  // 取得商品多圖資料
  $colname_RecordAlbumPhotoGet = "-1";
  if (isset($_GET['id_del'])) {
	$colname_RecordAlbumPhotoGet = $_GET['id_del'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordAlbumPhotoGet = sprintf("SELECT * FROM demo_albumphoto WHERE act_id = %s", GetSQLValueString($colname_RecordAlbumPhotoGet, "int"));
  $RecordAlbumPhotoGet = mysqli_query($DB_Conn, $query_RecordAlbumPhotoGet) or die(mysqli_error($DB_Conn));
  $row_RecordAlbumPhotoGet = mysqli_fetch_assoc($RecordAlbumPhotoGet);
  $totalRows_RecordAlbumPhotoGet = mysqli_num_rows($RecordAlbumPhotoGet);
  do { 
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/album/' . $row_RecordAlbumPhotoGet['pic']);
	  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/album/thumb/small_' . GetFileThumbExtend($row_RecordAlbumPhotoGet['pic']));
  } while ($row_RecordAlbumPhotoGet = mysqli_fetch_assoc($RecordAlbumPhotoGet));
  
  $deleteSQL = sprintf("DELETE FROM demo_albumphoto WHERE userid=%s && act_id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>