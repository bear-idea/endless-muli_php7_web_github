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

$coluserid_RecordActnews = "-1";
if (isset($w_userid)) {
  $coluserid_RecordActnews = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActnews = sprintf("SELECT * FROM demo_actnews WHERE userid=%s && indicate=1 ORDER BY id DESC", GetSQLValueString($coluserid_RecordActnews, "int"));
$RecordActnews = mysqli_query($DB_Conn, $query_RecordActnews) or die(mysqli_error($DB_Conn));
$row_RecordActnews = mysqli_fetch_assoc($RecordActnews);
$totalRows_RecordActnews = mysqli_num_rows($RecordActnews);
?>
<?php if ($totalRows_RecordActnews > 0) { // Show if recordset not empty ?>
<?php $actnews_i=0; ?>
<?php do { ?>
<?php 
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("actnews",array('wshop'=>$wshop,'lang'=>$row_RecordActnews['lang'],'Opt'=>'detailed','id'=>$row_RecordActnews['id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>       
<?php $actnews_i++; ?>
<?php } while ($row_RecordActnews = mysqli_fetch_assoc($RecordActnews)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordActnews);
?>