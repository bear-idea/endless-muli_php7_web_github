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
	  $colname_RecordProductMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordProductMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordProductMuliGet = sprintf("SELECT * FROM demo_product WHERE id = %s", GetSQLValueString($colname_RecordProductMuliGet, "int"));
	  $RecordProductMuliGet = mysqli_query($DB_Conn, $query_RecordProductMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordProductMuliGet = mysqli_fetch_assoc($RecordProductMuliGet);
	  $totalRows_RecordProductMuliGet = mysqli_num_rows($RecordProductMuliGet);
	  do 
	  {
		  /* 先取得資料庫是否有圖 */
		  $colname_RecordProductGet = "-1";
		  if (isset($row_RecordProductMuliGet['pic'])) {
			$colname_RecordProductGet = $row_RecordProductMuliGet['pic'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordProductGet = sprintf("SELECT id FROM demo_product WHERE pic = %s", GetSQLValueString($colname_RecordProductGet, "text"));
		  $RecordProductGet = mysqli_query($DB_Conn, $query_RecordProductGet) or die(mysqli_error($DB_Conn));
		  $row_RecordProductGet = mysqli_fetch_assoc($RecordProductGet);
		  $totalRows_RecordProductGet = mysqli_num_rows($RecordProductGet);
		  
		  if($totalRows_RecordProductGet == 1 ){ /* 如果資料庫只有一筆 就刪除 若此圖有多張 */
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/product/' . $row_RecordProductMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/product/thumb/small_' . GetFileThumbExtend($row_RecordProductMuliGet['pic']));
		  }
		  
		  // 取得商品多圖資料
		  $colname_RecordProductPhotoMuliGet = "-1";
		  if (isset($val)) {
			$colname_RecordProductPhotoMuliGet = $val;
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordProductPhotoMuliGet = sprintf("SELECT * FROM demo_productphoto WHERE aid = %s", GetSQLValueString($colname_RecordProductPhotoMuliGet, "int"));
		  $RecordProductPhotoMuliGet = mysqli_query($DB_Conn, $query_RecordProductPhotoMuliGet) or die(mysqli_error($DB_Conn));
		  $row_RecordProductPhotoMuliGet = mysqli_fetch_assoc($RecordProductPhotoMuliGet);
		  $totalRows_RecordProductPhotoMuliGet = mysqli_num_rows($RecordProductPhotoMuliGet);
		  
		  do { 
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/product/' . $row_RecordProductPhotoMuliGet['pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/product/thumb/small_' . GetFileThumbExtend($row_RecordProductPhotoMuliGet['pic']));
		  } while ($row_RecordProductPhotoMuliGet = mysqli_fetch_assoc($RecordProductPhotoMuliGet));
		  
		  $deleteSQL = sprintf("DELETE FROM demo_productphoto WHERE userid=%s && aid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($val, "int"));
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
          
		  $deleteSQL = sprintf("DELETE FROM demo_productpost WHERE userid=%s && pid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($val, "int"));
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
		  
		  $deleteSQL = sprintf("DELETE FROM demo_productreply WHERE userid=%s && pdid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($val, "int"));
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
		  
		  $deleteSQL = sprintf("DELETE FROM demo_productformat WHERE userid=%s && aid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($val, "int"));
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
		  
		  $deleteSQL = sprintf("DELETE FROM demo_productspformat WHERE userid=%s && aid=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($val, "int"));
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
			  
	  } while ($row_RecordProductMuliGet = mysqli_fetch_assoc($RecordProductMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_product WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>