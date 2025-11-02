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

if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
  // 取得商品資料
  foreach($_POST['id'] as $i => $val){
	  $colname_RecordAlbumMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordAlbumMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordAlbumMuliGet = sprintf("SELECT * FROM demo_album WHERE act_id = %s", GetSQLValueString($colname_RecordAlbumMuliGet, "int"));
	  $RecordAlbumMuliGet = mysqli_query($DB_Conn, $query_RecordAlbumMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordAlbumMuliGet = mysqli_fetch_assoc($RecordAlbumMuliGet);
	  $totalRows_RecordAlbumMuliGet = mysqli_num_rows($RecordAlbumMuliGet);
	  do 
	  {
		  // 取得商品多圖資料
		  $colname_RecordAlbumPhotoMuliGet = "-1";
		  if (isset($val)) {
			$colname_RecordAlbumPhotoMuliGet = $val;
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordAlbumPhotoMuliGet = sprintf("SELECT * FROM demo_albumphoto WHERE act_id = %s", GetSQLValueString($colname_RecordAlbumPhotoMuliGet, "int"));
		  $RecordAlbumPhotoMuliGet = mysqli_query($DB_Conn, $query_RecordAlbumPhotoMuliGet) or die(mysqli_error($DB_Conn));
		  $row_RecordAlbumPhotoMuliGet = mysqli_fetch_assoc($RecordAlbumPhotoMuliGet);
		  $totalRows_RecordAlbumPhotoMuliGet = mysqli_num_rows($RecordAlbumPhotoMuliGet);
		  
		  do { 
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/album/' . $row_RecordAlbumPhotoMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/album/thumb/small_' . GetFileThumbExtend($row_RecordAlbumPhotoMuliGet['pic']));
		  } while ($row_RecordAlbumPhotoMuliGet = mysqli_fetch_assoc($RecordAlbumPhotoMuliGet));
		  
		  $deleteSQL = sprintf("DELETE FROM demo_albumphoto WHERE userid=%s && act_id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($val, "int"));
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
			  
	  } while ($row_RecordAlbumMuliGet = mysqli_fetch_assoc($RecordAlbumMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_album WHERE act_id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>