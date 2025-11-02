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

$coluserid_RecordNews = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNews = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNews = sprintf("SELECT * FROM demo_news WHERE userid=%s && indicate=1 ORDER BY id DESC", GetSQLValueString($coluserid_RecordNews, "int"));
$RecordNews = mysqli_query($DB_Conn, $query_RecordNews) or die(mysqli_error($DB_Conn));
$row_RecordNews = mysqli_fetch_assoc($RecordNews);
$totalRows_RecordNews = mysqli_num_rows($RecordNews);
?>
<?php if ($totalRows_RecordNews > 0) { // Show if recordset not empty ?>
<?php $news_i=0; ?>
<?php do { ?>
<?php 
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("news",array('wshop'=>$wshop,'lang'=>$row_RecordNews['lang'],'Opt'=>'detailed','id'=>$row_RecordNews['id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>       
<?php $news_i++; ?>
<?php } while ($row_RecordNews = mysqli_fetch_assoc($RecordNews)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordNews);
?>