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
	  $colname_RecordTmplogoMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordTmplogoMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordTmplogoMuliGet = sprintf("SELECT * FROM demo_tmplogo WHERE id = %s", GetSQLValueString($colname_RecordTmplogoMuliGet, "int"));
	  $RecordTmplogoMuliGet = mysqli_query($DB_Conn, $query_RecordTmplogoMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordTmplogoMuliGet = mysqli_fetch_assoc($RecordTmplogoMuliGet);
	  $totalRows_RecordTmplogoMuliGet = mysqli_num_rows($RecordTmplogoMuliGet);
	  do 
	  {
			@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/logo/' . $row_RecordTmplogoMuliGet['logoimage']);
			@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/logo/' . $row_RecordTmplogoMuliGet['logoimage_en']);
			@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/logo/' . $row_RecordTmplogoMuliGet['logoimage_cn']);
			@unlink('../' . $SiteImgFilePathAdmin . $wshop . '/logo/' . $row_RecordTmplogoMuliGet['logoimage_jp']);
			  
	  } while ($row_RecordTmplogoMuliGet = mysqli_fetch_assoc($RecordTmplogoMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_tmplogo WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>