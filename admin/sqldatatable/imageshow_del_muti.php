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
	  $colname_RecordImageshowMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordImageshowMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordImageshowMuliGet = sprintf("SELECT * FROM demo_imageshow WHERE id = %s", GetSQLValueString($colname_RecordImageshowMuliGet, "int"));
	  $RecordImageshowMuliGet = mysqli_query($DB_Conn, $query_RecordImageshowMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordImageshowMuliGet = mysqli_fetch_assoc($RecordImageshowMuliGet);
	  $totalRows_RecordImageshowMuliGet = mysqli_num_rows($RecordImageshowMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordImageshowGet = "-1";
		  if (isset($row_RecordImageshowMuliGet['pic'])) {
			$colname_RecordImageshowGet = $row_RecordImageshowMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordImageshowGet = sprintf("SELECT id FROM demo_imageshow WHERE pic = %s", GetSQLValueString($colname_RecordImageshowGet, "text"));
		  $RecordImageshowGet = mysqli_query($DB_Conn, $query_RecordImageshowGet) or die(mysqli_error($DB_Conn));
		  $row_RecordImageshowGet = mysqli_fetch_assoc($RecordImageshowGet);
		  $totalRows_RecordImageshowGet = mysqli_num_rows($RecordImageshowGet);
		  
		  if($totalRows_RecordImageshowGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/imageshow/' . $row_RecordImageshowMuliGet['pic']);
			  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/imageshow/thumb/small_' . GetFileThumbExtend($row_RecordImageshowMuliGet['pic']));
		  }
			  
	  } while ($row_RecordImageshowMuliGet = mysqli_fetch_assoc($RecordImageshowMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_imageshow WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>