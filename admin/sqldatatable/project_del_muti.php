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
	  $colname_RecordProjectMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordProjectMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordProjectMuliGet = sprintf("SELECT * FROM demo_projectalbum WHERE act_id = %s", GetSQLValueString($colname_RecordProjectMuliGet, "int"));
	  $RecordProjectMuliGet = mysqli_query($DB_Conn, $query_RecordProjectMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordProjectMuliGet = mysqli_fetch_assoc($RecordProjectMuliGet);
	  $totalRows_RecordProjectMuliGet = mysqli_num_rows($RecordProjectMuliGet);
	  do 
	  {
		  // 取得商品多圖資料
		  $colname_RecordProjectPhotoMuliGet = "-1";
		  if (isset($val)) {
			$colname_RecordProjectPhotoMuliGet = $val;
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordProjectPhotoMuliGet = sprintf("SELECT * FROM demo_projectalbumphoto WHERE act_id = %s", GetSQLValueString($colname_RecordProjectPhotoMuliGet, "int"));
		  $RecordProjectPhotoMuliGet = mysqli_query($DB_Conn, $query_RecordProjectPhotoMuliGet) or die(mysqli_error($DB_Conn));
		  $row_RecordProjectPhotoMuliGet = mysqli_fetch_assoc($RecordProjectPhotoMuliGet);
		  $totalRows_RecordProjectPhotoMuliGet = mysqli_num_rows($RecordProjectPhotoMuliGet);
		  
		  do { 
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/project/' . $row_RecordProjectPhotoMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/project/thumb/small_' . GetFileThumbExtend($row_RecordProjectPhotoMuliGet['pic']));
		  } while ($row_RecordProjectPhotoMuliGet = mysqli_fetch_assoc($RecordProjectPhotoMuliGet));
		  
		  $deleteSQL = sprintf("DELETE FROM demo_projectalbumphoto WHERE userid=%s && act_id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($val, "int"));
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
			  
	  } while ($row_RecordProjectMuliGet = mysqli_fetch_assoc($RecordProjectMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_projectalbum WHERE act_id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>