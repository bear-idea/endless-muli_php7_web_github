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
	  $colname_RecordTmpMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordTmpMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordTmpMuliGet = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmpMuliGet, "int"));
	  $RecordTmpMuliGet = mysqli_query($DB_Conn, $query_RecordTmpMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordTmpMuliGet = mysqli_fetch_assoc($RecordTmpMuliGet);
	  $totalRows_RecordTmpMuliGet = mysqli_num_rows($RecordTmpMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordTmpGet = "-1";
		  if (isset($row_RecordTmpMuliGet['pic'])) {
			$colname_RecordTmpGet = $row_RecordTmpMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordTmpGet = sprintf("SELECT id FROM demo_tmp WHERE pic = %s", GetSQLValueString($colname_RecordTmpGet, "text"));
		  $RecordTmpGet = mysqli_query($DB_Conn, $query_RecordTmpGet) or die(mysqli_error($DB_Conn));
		  $row_RecordTmpGet = mysqli_fetch_assoc($RecordTmpGet);
		  $totalRows_RecordTmpGet = mysqli_num_rows($RecordTmpGet);
		  
		  if($totalRows_RecordTmpGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmp/' . $row_RecordTmpMuliGet['pic']);
			  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmp/thumb/small_' . GetFileThumbExtend($row_RecordTmpMuliGet['pic']));
		  }
			  
	  } while ($row_RecordTmpMuliGet = mysqli_fetch_assoc($RecordTmpMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_tmp WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>