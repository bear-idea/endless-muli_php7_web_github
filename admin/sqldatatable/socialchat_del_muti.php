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
	  $colname_RecordSocialchatMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordSocialchatMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordSocialchatMuliGet = sprintf("SELECT * FROM demo_socialchat WHERE id = %s", GetSQLValueString($colname_RecordSocialchatMuliGet, "int"));
	  $RecordSocialchatMuliGet = mysqli_query($DB_Conn, $query_RecordSocialchatMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordSocialchatMuliGet = mysqli_fetch_assoc($RecordSocialchatMuliGet);
	  $totalRows_RecordSocialchatMuliGet = mysqli_num_rows($RecordSocialchatMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordSocialchatGet = "-1";
		  if (isset($row_RecordSocialchatMuliGet['pic'])) {
			$colname_RecordSocialchatGet = $row_RecordSocialchatMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordSocialchatGet = sprintf("SELECT id FROM demo_socialchat WHERE pic = %s", GetSQLValueString($colname_RecordSocialchatGet, "text"));
		  $RecordSocialchatGet = mysqli_query($DB_Conn, $query_RecordSocialchatGet) or die(mysqli_error($DB_Conn));
		  $row_RecordSocialchatGet = mysqli_fetch_assoc($RecordSocialchatGet);
		  $totalRows_RecordSocialchatGet = mysqli_num_rows($RecordSocialchatGet);
		  
		  if($totalRows_RecordSocialchatGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/socialchat/' . $row_RecordSocialchatMuliGet['pic']);
			  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/socialchat/thumb/small_' . GetFileThumbExtend($row_RecordSocialchatMuliGet['pic']));
		  }
			  
	  } while ($row_RecordSocialchatMuliGet = mysqli_fetch_assoc($RecordSocialchatMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_socialchat WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>