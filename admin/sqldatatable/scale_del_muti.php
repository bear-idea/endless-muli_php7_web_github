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
	  $colname_RecordScaleMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordScaleMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordScaleMuliGet = sprintf("SELECT * FROM erp_scale WHERE id = %s", GetSQLValueString($colname_RecordScaleMuliGet, "int"));
	  $RecordScaleMuliGet = mysqli_query($DB_Conn, $query_RecordScaleMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordScaleMuliGet = mysqli_fetch_assoc($RecordScaleMuliGet);
	  $totalRows_RecordScaleMuliGet = mysqli_num_rows($RecordScaleMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordScaleGet = "-1";
		  if (isset($row_RecordScaleMuliGet['pic'])) {
			$colname_RecordScaleGet = $row_RecordScaleMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordScaleGet = sprintf("SELECT id FROM erp_scale WHERE pic = %s", GetSQLValueString($colname_RecordScaleGet, "text"));
		  $RecordScaleGet = mysqli_query($DB_Conn, $query_RecordScaleGet) or die(mysqli_error($DB_Conn));
		  $row_RecordScaleGet = mysqli_fetch_assoc($RecordScaleGet);
		  $totalRows_RecordScaleGet = mysqli_num_rows($RecordScaleGet);
		  
		  if($totalRows_RecordScaleGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scale/' . $row_RecordScaleMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scale/thumb/small_' . GetFileThumbExtend($row_RecordScaleMuliGet['pic']));
		  }
			  
	  } while ($row_RecordScaleMuliGet = mysqli_fetch_assoc($RecordScaleMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM erp_scale WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>