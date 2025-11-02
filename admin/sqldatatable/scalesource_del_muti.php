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
	  $colname_RecordScalesourceMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordScalesourceMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordScalesourceMuliGet = sprintf("SELECT * FROM erp_scalesource WHERE id = %s", GetSQLValueString($colname_RecordScalesourceMuliGet, "int"));
	  $RecordScalesourceMuliGet = mysqli_query($DB_Conn, $query_RecordScalesourceMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordScalesourceMuliGet = mysqli_fetch_assoc($RecordScalesourceMuliGet);
	  $totalRows_RecordScalesourceMuliGet = mysqli_num_rows($RecordScalesourceMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordScalesourceGet = "-1";
		  if (isset($row_RecordScalesourceMuliGet['pic'])) {
			$colname_RecordScalesourceGet = $row_RecordScalesourceMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordScalesourceGet = sprintf("SELECT id FROM erp_scalesource WHERE pic = %s", GetSQLValueString($colname_RecordScalesourceGet, "text"));
		  $RecordScalesourceGet = mysqli_query($DB_Conn, $query_RecordScalesourceGet) or die(mysqli_error($DB_Conn));
		  $row_RecordScalesourceGet = mysqli_fetch_assoc($RecordScalesourceGet);
		  $totalRows_RecordScalesourceGet = mysqli_num_rows($RecordScalesourceGet);
		  
		  if($totalRows_RecordScalesourceGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scalesource/' . $row_RecordScalesourceMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scalesource/thumb/small_' . GetFileThumbExtend($row_RecordScalesourceMuliGet['pic']));
		  }
			  
	  } while ($row_RecordScalesourceMuliGet = mysqli_fetch_assoc($RecordScalesourceMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM erp_scalesource WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>