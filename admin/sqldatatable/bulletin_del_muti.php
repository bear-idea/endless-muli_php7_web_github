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
	  $colname_RecordBulletinMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordBulletinMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordBulletinMuliGet = sprintf("SELECT * FROM demo_bulletin WHERE id = %s", GetSQLValueString($colname_RecordBulletinMuliGet, "int"));
	  $RecordBulletinMuliGet = mysqli_query($DB_Conn, $query_RecordBulletinMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordBulletinMuliGet = mysqli_fetch_assoc($RecordBulletinMuliGet);
	  $totalRows_RecordBulletinMuliGet = mysqli_num_rows($RecordBulletinMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordBulletinGet = "-1";
		  if (isset($row_RecordBulletinMuliGet['pic'])) {
			$colname_RecordBulletinGet = $row_RecordBulletinMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordBulletinGet = sprintf("SELECT id FROM demo_bulletin WHERE pic = %s", GetSQLValueString($colname_RecordBulletinGet, "text"));
		  $RecordBulletinGet = mysqli_query($DB_Conn, $query_RecordBulletinGet) or die(mysqli_error($DB_Conn));
		  $row_RecordBulletinGet = mysqli_fetch_assoc($RecordBulletinGet);
		  $totalRows_RecordBulletinGet = mysqli_num_rows($RecordBulletinGet);
		  
		  if($totalRows_RecordBulletinGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/bulletin/' . $row_RecordBulletinMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/bulletin/thumb/small_' . GetFileThumbExtend($row_RecordBulletinMuliGet['pic']));
		  }
			  
	  } while ($row_RecordBulletinMuliGet = mysqli_fetch_assoc($RecordBulletinMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_bulletin WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>