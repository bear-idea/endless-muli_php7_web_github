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
	  $colname_RecordCatalogMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordCatalogMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordCatalogMuliGet = sprintf("SELECT * FROM demo_catalog WHERE id = %s", GetSQLValueString($colname_RecordCatalogMuliGet, "int"));
	  $RecordCatalogMuliGet = mysqli_query($DB_Conn, $query_RecordCatalogMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordCatalogMuliGet = mysqli_fetch_assoc($RecordCatalogMuliGet);
	  $totalRows_RecordCatalogMuliGet = mysqli_num_rows($RecordCatalogMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordCatalogGet = "-1";
		  if (isset($row_RecordCatalogMuliGet['pic'])) {
			$colname_RecordCatalogGet = $row_RecordCatalogMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordCatalogGet = sprintf("SELECT id FROM demo_catalog WHERE pic = %s", GetSQLValueString($colname_RecordCatalogGet, "text"));
		  $RecordCatalogGet = mysqli_query($DB_Conn, $query_RecordCatalogGet) or die(mysqli_error($DB_Conn));
		  $row_RecordCatalogGet = mysqli_fetch_assoc($RecordCatalogGet);
		  $totalRows_RecordCatalogGet = mysqli_num_rows($RecordCatalogGet);
		  
		  if($totalRows_RecordCatalogGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/catalog/' . $row_RecordCatalogMuliGet['pic']);
			  //@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/catalog/thumb/small_' . GetFileThumbExtend($row_RecordCatalogMuliGet['pic']));
		  }
			  
	  } while ($row_RecordCatalogMuliGet = mysqli_fetch_assoc($RecordCatalogMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_catalog WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>