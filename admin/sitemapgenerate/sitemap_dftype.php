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

$coluserid_RecordDfTypeMultiSiteMap_l1 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfTypeMultiSiteMap_l1 = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfTypeMultiSiteMap_l1 = sprintf("SELECT * FROM demo_dftype WHERE indicate=1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordDfTypeMultiSiteMap_l1, "int"));
$RecordDfTypeMultiSiteMap_l1 = mysqli_query($DB_Conn, $query_RecordDfTypeMultiSiteMap_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfTypeMultiSiteMap_l1 = mysqli_fetch_assoc($RecordDfTypeMultiSiteMap_l1);
$totalRows_RecordDfTypeMultiSiteMap_l1 = mysqli_num_rows($RecordDfTypeMultiSiteMap_l1);
?>
<?php $dftype_i=0;?>
<?php do { ?>
<?php 
if ($row_RecordDfTypeMultiSiteMap_l1['typemenu'] == 'Link' || $row_RecordDfTypeMultiSiteMap_l1['typemenu'] == 'LinkPage') {
	//$seo_loc = htmlentities($row_RecordDfTypeMultiSiteMap_l1['link']);
} else if ($row_RecordDfTypeMultiSiteMap_l1['typemenu'] == 'Cart'){
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite(strtolower($row_RecordDfTypeMultiSiteMap_l1['typemenu']),array('wshop'=>$wshop,'lang'=>$row_RecordDfTypeMultiSiteMap_l1['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable));
} else if ($row_RecordDfTypeMultiSiteMap_l1['typemenu'] == 'Home'){
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite('index',array('wshop'=>$wshop,'lang'=>$row_RecordDfTypeMultiSiteMap_l1['lang']),'',$UrlWriteEnable));
} else if ($row_RecordDfTypeMultiSiteMap_l1['typemenu'] == 'DfPage' || $row_RecordDfTypeMultiSiteMap_l1['typemenu'] == 'DfType'){
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite(strtolower($row_RecordDfTypeMultiSiteMap_l1['typemenu']),array('wshop'=>$wshop,'lang'=>$row_RecordDfTypeMultiSiteMap_l1['lang'],'Opt'=>'viewpage','aid'=>$row_RecordDfTypeMultiSiteMap_l1['id']),'',$UrlWriteEnable));
}else{
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite(strtolower($row_RecordDfTypeMultiSiteMap_l1['typemenu']),array('wshop'=>$wshop,'lang'=>$row_RecordDfTypeMultiSiteMap_l1['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable));
}

//动态添加数组的例子
if ($row_RecordDfTypeMultiSiteMap_l1['typemenu'] != 'Link' && $row_RecordDfTypeMultiSiteMap_l1['typemenu'] != 'LinkPage') {
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.9',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'always'
)); 
}
?>
<?php $dftype_i++; ?>
<?php } while ($row_RecordDfTypeMultiSiteMap_l1 = mysqli_fetch_assoc($RecordDfTypeMultiSiteMap_l1)); ?>
<?php
mysqli_free_result($RecordDfTypeMultiSiteMap_l1);
?>
