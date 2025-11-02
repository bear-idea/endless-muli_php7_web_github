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

$coluserid_RecordAboutMultiLeftMenu = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAboutMultiLeftMenu = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutMultiLeftMenu = sprintf("SELECT * FROM demo_about WHERE indicate = '1' && userid=%s ORDER BY sortid ASC", GetSQLValueString($coluserid_RecordAboutMultiLeftMenu, "int"));
$RecordAboutMultiLeftMenu = mysqli_query($DB_Conn, $query_RecordAboutMultiLeftMenu) or die(mysqli_error($DB_Conn));
$row_RecordAboutMultiLeftMenu = mysqli_fetch_assoc($RecordAboutMultiLeftMenu);
$totalRows_RecordAboutMultiLeftMenu = mysqli_num_rows($RecordAboutMultiLeftMenu);
?>
<?php if ($totalRows_RecordAboutMultiLeftMenu > 0) { // Show if recordset not empty ?>
<?php $about_i=0; ?>
<?php do { ?>
<?php 
if ($row_RecordAboutMultiLeftMenu['endnode'] != 'child') {
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("about",array('wshop'=>$wshop,'lang'=>$row_RecordAboutMultiLeftMenu['lang'],'Opt'=>'detailed','id'=>$row_RecordAboutMultiLeftMenu['id']),'',$UrlWriteEnable));
	
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
}
?>           
<?php $about_i++; ?>
<?php } while ($row_RecordAboutMultiLeftMenu = mysqli_fetch_assoc($RecordAboutMultiLeftMenu)); ?>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordAboutMultiLeftMenu);
?>