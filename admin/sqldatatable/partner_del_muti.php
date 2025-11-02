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
	  $colname_RecordPartnerMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordPartnerMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordPartnerMuliGet = sprintf("SELECT * FROM demo_partner WHERE id = %s", GetSQLValueString($colname_RecordPartnerMuliGet, "int"));
	  $RecordPartnerMuliGet = mysqli_query($DB_Conn, $query_RecordPartnerMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordPartnerMuliGet = mysqli_fetch_assoc($RecordPartnerMuliGet);
	  $totalRows_RecordPartnerMuliGet = mysqli_num_rows($RecordPartnerMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordPartnerGet = "-1";
		  if (isset($row_RecordPartnerMuliGet['pic'])) {
			$colname_RecordPartnerGet = $row_RecordPartnerMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordPartnerGet = sprintf("SELECT id FROM demo_partner WHERE pic = %s", GetSQLValueString($colname_RecordPartnerGet, "text"));
		  $RecordPartnerGet = mysqli_query($DB_Conn, $query_RecordPartnerGet) or die(mysqli_error($DB_Conn));
		  $row_RecordPartnerGet = mysqli_fetch_assoc($RecordPartnerGet);
		  $totalRows_RecordPartnerGet = mysqli_num_rows($RecordPartnerGet);
		  
		  if($totalRows_RecordPartnerGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/partner/' . $row_RecordPartnerMuliGet['pic']);
			  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/partner/thumb/small_' . GetFileThumbExtend($row_RecordPartnerMuliGet['pic']));
		  }
			  
	  } while ($row_RecordPartnerMuliGet = mysqli_fetch_assoc($RecordPartnerMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_partner WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>