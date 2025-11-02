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
	  $colname_RecordFrilinkMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordFrilinkMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordFrilinkMuliGet = sprintf("SELECT * FROM demo_frilink WHERE id = %s", GetSQLValueString($colname_RecordFrilinkMuliGet, "int"));
	  $RecordFrilinkMuliGet = mysqli_query($DB_Conn, $query_RecordFrilinkMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordFrilinkMuliGet = mysqli_fetch_assoc($RecordFrilinkMuliGet);
	  $totalRows_RecordFrilinkMuliGet = mysqli_num_rows($RecordFrilinkMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordFrilinkGet = "-1";
		  if (isset($row_RecordFrilinkMuliGet['pic'])) {
			$colname_RecordFrilinkGet = $row_RecordFrilinkMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordFrilinkGet = sprintf("SELECT id FROM demo_frilink WHERE pic = %s", GetSQLValueString($colname_RecordFrilinkGet, "text"));
		  $RecordFrilinkGet = mysqli_query($DB_Conn, $query_RecordFrilinkGet) or die(mysqli_error($DB_Conn));
		  $row_RecordFrilinkGet = mysqli_fetch_assoc($RecordFrilinkGet);
		  $totalRows_RecordFrilinkGet = mysqli_num_rows($RecordFrilinkGet);
		  
		  if($totalRows_RecordFrilinkGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/frilink/' . $row_RecordFrilinkMuliGet['pic']);
			  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/frilink/thumb/small_' . GetFileThumbExtend($row_RecordFrilinkMuliGet['pic']));
		  }
			  
	  } while ($row_RecordFrilinkMuliGet = mysqli_fetch_assoc($RecordFrilinkMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_frilink WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>