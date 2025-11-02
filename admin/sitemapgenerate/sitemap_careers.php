<?php require_once('../Connections/DB_Conn.php'); ?>
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

$coluserid_RecordCareers = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCareers = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareers = sprintf("SELECT * FROM demo_careers WHERE userid=%s && indicate=1 ORDER BY id DESC", GetSQLValueString($coluserid_RecordCareers, "int"));
$RecordCareers = mysqli_query($DB_Conn, $query_RecordCareers) or die(mysqli_error($DB_Conn));
$row_RecordCareers = mysqli_fetch_assoc($RecordCareers);
$totalRows_RecordCareers = mysqli_num_rows($RecordCareers);
?>
<?php if ($totalRows_RecordCareers > 0) { // Show if recordset not empty ?>
<?php $careers_i=0; ?>
<?php do { ?>
<?php 
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("careers",array('wshop'=>$wshop,'lang'=>$row_RecordCareers['lang'],'Opt'=>'detailed','id'=>$row_RecordCareers['id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>       
<?php $careers_i++; ?>
<?php } while ($row_RecordCareers = mysqli_fetch_assoc($RecordCareers)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordCareers);
?>