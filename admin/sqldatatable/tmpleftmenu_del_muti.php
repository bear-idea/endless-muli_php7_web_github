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
	  $colname_RecordTmpleftmenuMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordTmpleftmenuMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordTmpleftmenuMuliGet = sprintf("SELECT * FROM demo_tmpleftmenu WHERE id = %s", GetSQLValueString($colname_RecordTmpleftmenuMuliGet, "int"));
	  $RecordTmpleftmenuMuliGet = mysqli_query($DB_Conn, $query_RecordTmpleftmenuMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordTmpleftmenuMuliGet = mysqli_fetch_assoc($RecordTmpleftmenuMuliGet);
	  $totalRows_RecordTmpleftmenuMuliGet = mysqli_num_rows($RecordTmpleftmenuMuliGet);
	  do 
	  {
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpleftmenu/' . $row_RecordTmpleftmenuMuliGet['tmp_title_pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpleftmenu/' . $row_RecordTmpleftmenuMuliGet['tmp_middle_pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpleftmenu/' . $row_RecordTmpleftmenuMuliGet['tmp_middle_o_pic']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpleftmenu/' . $row_RecordTmpleftmenuMuliGet['tmp_bottom_pic']);
			  
	  } while ($row_RecordTmpleftmenuMuliGet = mysqli_fetch_assoc($RecordTmpleftmenuMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_tmpleftmenu WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>