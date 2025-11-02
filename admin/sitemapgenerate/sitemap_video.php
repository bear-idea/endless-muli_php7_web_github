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

$coluserid_RecordVideo = "-1";
if (isset($w_userid)) {
  $coluserid_RecordVideo = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordVideo = sprintf("SELECT * FROM demo_video WHERE userid=%s && indicate=1 ORDER BY id DESC", GetSQLValueString($coluserid_RecordVideo, "int"));
$RecordVideo = mysqli_query($DB_Conn, $query_RecordVideo) or die(mysqli_error($DB_Conn));
$row_RecordVideo = mysqli_fetch_assoc($RecordVideo);
$totalRows_RecordVideo = mysqli_num_rows($RecordVideo);
?>
<?php if ($totalRows_RecordVideo > 0) { // Show if recordset not empty ?>
<?php $video_i=0; ?>
<?php do { ?>
<?php 
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite('video',array('wshop'=>$wshop,'lang'=>$row_RecordVideo['lang'],'Opt'=>'detailed','id'=>$row_RecordVideo['id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>       
<?php $video_i++; ?>
<?php } while ($row_RecordVideo = mysqli_fetch_assoc($RecordVideo)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordVideo);
?>