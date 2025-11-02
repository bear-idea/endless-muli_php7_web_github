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
	  $colname_RecordSponsorMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordSponsorMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordSponsorMuliGet = sprintf("SELECT * FROM demo_sponsor WHERE id = %s", GetSQLValueString($colname_RecordSponsorMuliGet, "int"));
	  $RecordSponsorMuliGet = mysqli_query($DB_Conn, $query_RecordSponsorMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordSponsorMuliGet = mysqli_fetch_assoc($RecordSponsorMuliGet);
	  $totalRows_RecordSponsorMuliGet = mysqli_num_rows($RecordSponsorMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordSponsorGet = "-1";
		  if (isset($row_RecordSponsorMuliGet['pic'])) {
			$colname_RecordSponsorGet = $row_RecordSponsorMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordSponsorGet = sprintf("SELECT id FROM demo_sponsor WHERE pic = %s", GetSQLValueString($colname_RecordSponsorGet, "text"));
		  $RecordSponsorGet = mysqli_query($DB_Conn, $query_RecordSponsorGet) or die(mysqli_error($DB_Conn));
		  $row_RecordSponsorGet = mysqli_fetch_assoc($RecordSponsorGet);
		  $totalRows_RecordSponsorGet = mysqli_num_rows($RecordSponsorGet);
		  
		  if($totalRows_RecordSponsorGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/sponsor/' . $row_RecordSponsorMuliGet['pic']);
			  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/sponsor/thumb/small_' . GetFileThumbExtend($row_RecordSponsorMuliGet['pic']));
		  }
			  
	  } while ($row_RecordSponsorMuliGet = mysqli_fetch_assoc($RecordSponsorMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_sponsor WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>