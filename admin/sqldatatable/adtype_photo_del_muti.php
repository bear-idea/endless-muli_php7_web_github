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
	  $colname_RecordAdsMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordAdsMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordAdsMuliGet = sprintf("SELECT * FROM demo_adtype_sub WHERE actphoto_id = %s", GetSQLValueString($colname_RecordAdsMuliGet, "int"));
	  $RecordAdsMuliGet = mysqli_query($DB_Conn, $query_RecordAdsMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordAdsMuliGet = mysqli_fetch_assoc($RecordAdsMuliGet);
	  $totalRows_RecordAdsMuliGet = mysqli_num_rows($RecordAdsMuliGet);
	  do 
	  {
		  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/banner/' . $row_RecordAdsMuliGet['pic']);
  		  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/banner/thumb/small_' . GetFileThumbExtend($row_RecordAdsMuliGet['pic']));
		  
	  } while ($row_RecordAdsMuliGet = mysqli_fetch_assoc($RecordAdsMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_adtype_sub WHERE actphoto_id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>