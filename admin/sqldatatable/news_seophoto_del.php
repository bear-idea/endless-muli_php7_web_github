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

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
	
    $colname_RecordNews = "-1";
	if (isset($_GET['id_del'])) {
	  $colname_RecordNews = $_GET['id_del'];
	}
	$coluserid_RecordNews = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordNews = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordNews = sprintf("SELECT * FROM demo_news WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordNews, "int"),GetSQLValueString($coluserid_RecordNews, "int"));
	$RecordNews = mysqli_query($DB_Conn, $query_RecordNews) or die(mysqli_error($DB_Conn));
	$row_RecordNews = mysqli_fetch_assoc($RecordNews);
	$totalRows_RecordNews = mysqli_num_rows($RecordNews);

  $updateSQL = sprintf("UPDATE demo_news SET ogimage=%s WHERE id=%s",
                       GetSQLValueString("", "text"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/seo/' . $row_RecordNews['ogimage']);
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/seo/thumb/small_' . GetFileThumbExtend($row_RecordNews['ogimage']));
}

echo json_encode("success");
?>