<?php require_once('Connections/DB_Conn.php'); ?>
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


/*
if($_POST['scale'] != "") {
$_POST['scale'] = array_unique($_POST['scale']);
$_POST['scale_bk'] = $_POST['scale'];
$_POST['scale']=implode("|",$_POST['scale']);
$scalelink = "REGEXP";
}else{
	$scalelink = "LIKE";
}

$query_RecordScale = sprintf("SELECT * FROM erp_scaleOrderInDetail WHERE (code $scalelink %s) && (indicate=1) && (lang = %s) && (num LIKE %s) && userid=%s && bound=%s && postdate BETWEEN %s AND %s ORDER BY postdate DESC, sortid ASC, id DESC", GetSQLValueString( $colname_RecordScale, "text"),GetSQLValueString($collang_RecordScale, "text"), GetSQLValueString($colsk_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"),GetSQLValueString($colbound_RecordScale, "text"),GetSQLValueString($colstartdate_RecordScaleorder, "date"),GetSQLValueString($colenddate_RecordScaleorder, "date"));
$query_limit_RecordScale = sprintf("%s LIMIT %d, %d", $query_RecordScale, $startRow_RecordScale, $maxRows_RecordScale);
	*/
	
$colname_RecordEmployees = "-1";
if (isset($_GET['id'])) {
  $colname_RecordEmployees = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployees = sprintf("SELECT * FROM demo_employees WHERE id = %s ORDER BY sortid ASC, id DESC", GetSQLValueString($colname_RecordEmployees, "text"));
$RecordEmployees = mysqli_query($DB_Conn, $query_RecordEmployees) or die(mysqli_error($DB_Conn));
$row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees);
$totalRows_RecordEmployees = mysqli_num_rows($RecordEmployees);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/employees_detailed_format.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordEmployees);
?>
<?php //mysqli_free_result($RecordProductAjaxFormat); // 移至 詳細內容頁 ?>

