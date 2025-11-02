<?php
if (($_SERVER['HTTP_HOST'] == "www.shop3500.com" || $_SERVER['HTTP_HOST'] == "localhost") && $_SESSION['MM_UserGroup'] == 'superadmin') { // 當網址為shop3500 

    $wshop_bk = $wshop;
    $wshop=$row_RecordSite['webname'];
	$w_userid_bk = $w_userid;
	$w_userid = $row_RecordSite['userid'];
	$UrlWriteEnable_bk = $UrlWriteEnable;
	$UrlWriteEnable = $row_RecordSite['urlwriteenable'];
	
	if($UrlWriteEnable == '1') {
		$tag_params = "?tag=";
		$key_params = "?searchkey=";
		$id_params = "?id=";
		$operate_params = "?Operate=";
		$file_params = "?f=";
		$type_params = "?type=";
		$RegMsg_params = "?RegMsg=";
		$errMsg_params = "?errMsg=";
		$id_del_params = "?id_del=";
		$plusid_del_params = "?plusid_del=";
		$page_params = "?page=";
	}else{
		$tag_params = "&tag=";
		$key_params = "&searchkey=";
		$id_params = "&id=";
		$operate_params = "&Operate=";
		$file_params = "&f=";
		$type_params = "&type=";
		$RegMsg_params = "&RegMsg=";
		$errMsg_params = "&errMsg=";
		$id_del_params = "&id_del=";
		$plusid_del_params = "&plusid_del=";
		$page_params = "&page=";
	}
	
    $seo_url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
	$seo_url=dirname(dirname($seo_url));
	
if(is_dir("../site/" . $row_RecordSite['webname'])){
}else{
mkdir("../site/" . $row_RecordSite['webname']); //建立目錄
}	
// 當網址為shop3500 
// 產生Sitemap For Shop3500
$content='<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';
unset($data_array); // 清空 Array
// 主頁面
$data_array=array(
    array(
		'loc'=>$seo_url . "/" . $row_RecordSite['webname'],
		'priority'=>'1.0',
		'lastmod'=>date("Y-m-d",time()),
		'changefreq'=>'always'
    )
);
require("sitemapgenerate/sitemap_dftype.php"); // 主選單
require("sitemapgenerate/sitemap_modlink.php"); 
require("sitemapgenerate/sitemap_about.php");
require("sitemapgenerate/sitemap_activities.php"); 
require("sitemapgenerate/sitemap_actnews.php"); 
require("sitemapgenerate/sitemap_album.php"); 
require("sitemapgenerate/sitemap_article.php"); 
require("sitemapgenerate/sitemap_artlist.php"); 
require("sitemapgenerate/sitemap_careers.php"); 
require("sitemapgenerate/sitemap_letters.php"); 
require("sitemapgenerate/sitemap_news.php"); 
require("sitemapgenerate/sitemap_product.php"); 
require("sitemapgenerate/sitemap_project.php"); 
require("sitemapgenerate/sitemap_publish.php"); 
require("sitemapgenerate/sitemap_room.php"); 
require("sitemapgenerate/sitemap_video.php"); 
require("sitemapgenerate/sitemap_knowledge.php"); 

foreach($data_array as $data){
	$content.=create_item($data);
}
$content.='</urlset>';

$fp=fopen($SiteImgFilePathAdmin . $row_RecordSite['webname'] . '/sitemap.xml','w+');

fwrite($fp,$content);
fclose($fp);
}
$wshop = $wshop_bk;
$w_userid = $w_userid_bk;
$UrlWriteEnable = $UrlWriteEnable_bk;
if($UrlWriteEnable == '1') {
		$tag_params = "?tag=";
		$key_params = "?searchkey=";
		$id_params = "?id=";
		$operate_params = "?Operate=";
		$file_params = "?f=";
		$type_params = "?type=";
		$RegMsg_params = "?RegMsg=";
		$errMsg_params = "?errMsg=";
		$id_del_params = "?id_del=";
		$plusid_del_params = "?plusid_del=";
		$page_params = "?page=";
	}else{
		$tag_params = "&tag=";
		$key_params = "&searchkey=";
		$id_params = "&id=";
		$operate_params = "&Operate=";
		$file_params = "&f=";
		$type_params = "&type=";
		$RegMsg_params = "&RegMsg=";
		$errMsg_params = "&errMsg=";
		$id_del_params = "&id_del=";
		$plusid_del_params = "&plusid_del=";
		$page_params = "&page=";
	}
?>