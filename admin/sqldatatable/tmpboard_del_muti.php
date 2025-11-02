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
	  $colname_RecordTmpboardMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordTmpboardMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordTmpboardMuliGet = sprintf("SELECT * FROM demo_tmpboard WHERE id = %s", GetSQLValueString($colname_RecordTmpboardMuliGet, "int"));
	  $RecordTmpboardMuliGet = mysqli_query($DB_Conn, $query_RecordTmpboardMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordTmpboardMuliGet = mysqli_fetch_assoc($RecordTmpboardMuliGet);
	  $totalRows_RecordTmpboardMuliGet = mysqli_num_rows($RecordTmpboardMuliGet);
	  do 
	  {
		      @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_w_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_l_t_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_m_t_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_r_t_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_l_m_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_m_m_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_r_m_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_l_b_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_m_b_background_img']);
			  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpboard/' . $row_RecordTmpboardMuliGet['tmp_r_b_background_img']);
			  
	  } while ($row_RecordTmpboardMuliGet = mysqli_fetch_assoc($RecordTmpboardMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM demo_tmpboard WHERE id in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>