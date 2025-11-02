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
	  $colname_RecordSplitorderMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordSplitorderMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordSplitorderMuliGet = sprintf("SELECT * FROM erp_splitorderphoto WHERE aid = %s", GetSQLValueString($colname_RecordSplitorderMuliGet, "int"));
	  $RecordSplitorderMuliGet = mysqli_query($DB_Conn, $query_RecordSplitorderMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordSplitorderMuliGet = mysqli_fetch_assoc($RecordSplitorderMuliGet);
	  $totalRows_RecordSplitorderMuliGet = mysqli_num_rows($RecordSplitorderMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordSplitorderGet = "-1";
		  if (isset($row_RecordSplitorderMuliGet['pic'])) {
			$colname_RecordSplitorderGet = $row_RecordSplitorderMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordSplitorderGet = sprintf("SELECT * FROM erp_splitorderphoto WHERE pic = %s", GetSQLValueString($colname_RecordSplitorderGet, "text"));
		  $RecordSplitorderGet = mysqli_query($DB_Conn, $query_RecordSplitorderGet) or die(mysqli_error($DB_Conn));
		  $row_RecordSplitorderGet = mysqli_fetch_assoc($RecordSplitorderGet);
		  $totalRows_RecordSplitorderGet = mysqli_num_rows($RecordSplitorderGet);
		  
		  if($totalRows_RecordSplitorderGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scaleorder_split/' . $row_RecordSplitorderMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/scaleorder_split/thumb/small_' . GetFileThumbExtend($row_RecordSplitorderMuliGet['pic']));
		  }
			  
	  } while ($row_RecordSplitorderMuliGet = mysqli_fetch_assoc($RecordSplitorderMuliGet));
	  
	  $deleteSQL = sprintf("DELETE FROM erp_splitorderphoto WHERE aid in (%s)", implode(",", $_POST['id']));
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  }
  
  $deleteSQL = sprintf("DELETE FROM erp_splitorder WHERE oid in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $deleteSQL = sprintf("DELETE FROM erp_splitorderdetial WHERE oid in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));

}
?>