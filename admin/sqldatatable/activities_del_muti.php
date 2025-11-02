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
	  $colname_RecordActivitiesMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordActivitiesMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordActivitiesMuliGet = sprintf("SELECT * FROM demo_actalbum WHERE act_id = %s", GetSQLValueString($colname_RecordActivitiesMuliGet, "int"));
	  $RecordActivitiesMuliGet = mysqli_query($DB_Conn, $query_RecordActivitiesMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordActivitiesMuliGet = mysqli_fetch_assoc($RecordActivitiesMuliGet);
	  $totalRows_RecordActivitiesMuliGet = mysqli_num_rows($RecordActivitiesMuliGet);
	  do 
	  {
		  // 取得商品多圖資料
		  $colname_RecordActivitiesPhotoMuliGet = "-1";
		  if (isset($val)) {
			$colname_RecordActivitiesPhotoMuliGet = $val;
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordActivitiesPhotoMuliGet = sprintf("SELECT * FROM demo_actalbumphoto WHERE act_id = %s", GetSQLValueString($colname_RecordActivitiesPhotoMuliGet, "int"));
		  $RecordActivitiesPhotoMuliGet = mysqli_query($DB_Conn, $query_RecordActivitiesPhotoMuliGet) or die(mysqli_error($DB_Conn));
		  $row_RecordActivitiesPhotoMuliGet = mysqli_fetch_assoc($RecordActivitiesPhotoMuliGet);
		  $totalRows_RecordActivitiesPhotoMuliGet = mysqli_num_rows($RecordActivitiesPhotoMuliGet);
		  
		  do { 
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/activities/' . $row_RecordActivitiesPhotoMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/activities/thumb/small_' . GetFileThumbExtend($row_RecordActivitiesPhotoMuliGet['pic']));
		  } while ($row_RecordActivitiesPhotoMuliGet = mysqli_fetch_assoc($RecordActivitiesPhotoMuliGet));
		  
		  $deleteSQL = sprintf("DELETE FROM demo_actalbumphoto WHERE userid=%s && act_id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($val, "int"));
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
			  
	  } while ($row_RecordActivitiesMuliGet = mysqli_fetch_assoc($RecordActivitiesMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_actalbum WHERE act_id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>