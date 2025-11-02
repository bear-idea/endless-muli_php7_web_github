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
	  $colname_RecordModlinkMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordModlinkMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordModlinkMuliGet = sprintf("SELECT * FROM demo_modlink WHERE id = %s", GetSQLValueString($colname_RecordModlinkMuliGet, "int"));
	  $RecordModlinkMuliGet = mysqli_query($DB_Conn, $query_RecordModlinkMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordModlinkMuliGet = mysqli_fetch_assoc($RecordModlinkMuliGet);
	  $totalRows_RecordModlinkMuliGet = mysqli_num_rows($RecordModlinkMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordModlinkGet = "-1";
		  if (isset($row_RecordModlinkMuliGet['pic'])) {
			$colname_RecordModlinkGet = $row_RecordModlinkMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordModlinkGet = sprintf("SELECT id FROM demo_modlink WHERE pic = %s", GetSQLValueString($colname_RecordModlinkGet, "text"));
		  $RecordModlinkGet = mysqli_query($DB_Conn, $query_RecordModlinkGet) or die(mysqli_error($DB_Conn));
		  $row_RecordModlinkGet = mysqli_fetch_assoc($RecordModlinkGet);
		  $totalRows_RecordModlinkGet = mysqli_num_rows($RecordModlinkGet);
		  
		  if($totalRows_RecordModlinkGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/modlink/' . $row_RecordModlinkMuliGet['pic']);
			  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/modlink/thumb/small_' . GetFileThumbExtend($row_RecordModlinkMuliGet['pic']));
		  }
			  
	  } while ($row_RecordModlinkMuliGet = mysqli_fetch_assoc($RecordModlinkMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_modlink WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>