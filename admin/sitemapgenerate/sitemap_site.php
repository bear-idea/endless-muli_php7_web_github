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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSite = "SELECT demo_admin.id, demo_admin.name, demo_admin.webname, demo_admin.hot, demo_admin.plushot, demo_admin.webrenewdate, demo_admin.usetime, demo_setting_fr.SiteDecsHome, demo_setting_fr.userid, demo_setting_fr.SiteFBShowImage, demo_setting_fr.SiteIndicate, demo_setting_fr.urlwriteenable FROM demo_admin LEFT OUTER JOIN demo_setting_fr ON demo_admin.id = demo_setting_fr.userid WHERE demo_setting_fr.SiteIndicate=1 && (DATEDIFF(demo_admin.webrenewdate,NOW())+365*demo_admin.usetime >= 0 || demo_admin.usetime = 0) ORDER BY demo_admin.hot+demo_admin.plushot DESC, demo_admin.id DESC";
$RecordSite = mysqli_query($DB_Conn, $query_RecordSite) or die(mysqli_error($DB_Conn));
$row_RecordSite = mysqli_fetch_assoc($RecordSite);
$totalRows_RecordSite = mysqli_num_rows($RecordSite);
?>
<?php if ($totalRows_RecordSite > 0) { ?>
<?php $site_i=0; ?>
<?php do { ?>
<?php 
$seo_loc = $seo_url . "/site/" . $row_RecordSite['webname'] . "/sitemap.xml";
if(file_exists("../site/" . $row_RecordSite['webname'] . "/sitemap.xml")){
if($site_i==0) {
$data_array_index=array(
    array(
		'loc'=>$seo_loc,
		'lastmod'=>date("Y-m-d",time()),
    )
);
}else{
//动态添加数组的例子
array_push($data_array_index, array(
        'loc'=>$seo_loc,
        'lastmod'=>date("Y-m-d",time()),
)); 
}
$site_i++; 
}
?>
<?php require("sitemapgenerate/sitemap_site_auto.php"); ?>
<?php } while ($row_RecordSite = mysqli_fetch_assoc($RecordSite)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordSite);
?>