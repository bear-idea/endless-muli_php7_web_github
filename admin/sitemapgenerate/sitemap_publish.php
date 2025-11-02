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

$coluserid_RecordPublish = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPublish = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublish = sprintf("SELECT * FROM demo_publish WHERE userid=%s && indicate=1 ORDER BY id DESC", GetSQLValueString($coluserid_RecordPublish, "int"));
$RecordPublish = mysqli_query($DB_Conn, $query_RecordPublish) or die(mysqli_error($DB_Conn));
$row_RecordPublish = mysqli_fetch_assoc($RecordPublish);
$totalRows_RecordPublish = mysqli_num_rows($RecordPublish);
?>
<?php if ($totalRows_RecordPublish > 0) { // Show if recordset not empty ?>
<?php $publish_i=0; ?>
<?php do { ?>
<?php 
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("publish",array('wshop'=>$wshop,'lang'=>$row_RecordPublish['lang'],'Opt'=>'detailed','id'=>$row_RecordPublish['id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>       
<?php $publish_i++; ?>
<?php } while ($row_RecordPublish = mysqli_fetch_assoc($RecordPublish)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordPublish);
?>