<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //require_once("inc_mdname.php"); // 取得模組名稱?>
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

function create_item($data){
    $item="<url>\n";
    $item.="<loc>".$data['loc']."</loc>\n";
    $item.="<priority>".$data['priority']."</priority>\n";
    $item.="<lastmod>".$data['lastmod']."</lastmod>\n";
	$item.="<changefreq>".$data['changefreq']."</changefreq>\n";
    $item.="</url>\n";
    return $item;
}

function create_item_index($data_index){
    $item_index="<sitemap>\n";
    $item_index.="<loc>".$data_index['loc']."</loc>\n";
    $item_index.="<lastmod>".$data_index['lastmod']."</lastmod>\n";
    $item_index.="</sitemap>\n";
    return $item_index;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_fr SET SitemapRenewDate=%s WHERE id=%s",
                       GetSQLValueString($_POST['SitemapRenewDate'], "date"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

// 產生Sitemap 索引檔
if ($_SERVER['HTTP_HOST'] == "www.shop3500.com" || $_SERVER['HTTP_HOST'] == "localhost") { // Shop3500才需產生索引檔
$content_index='
<sitemapindex
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';
// 網站路徑
$seo_url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
$seo_url=dirname(dirname($seo_url));

// 主頁面
/*$data_array_index=array(
    array(
		'loc'=>$seo_url,
		'lastmod'=>date("Y-m-d",time()),
    )
);*/
require("sitemapgenerate/sitemap_site.php"); 

foreach($data_array_index as $data_index){
	$content_index.=create_item_index($data_index);
}

$content_index.='</sitemapindex>';
$fp=fopen('../sitemap.xml','w+');
fwrite($fp,$content_index);
fclose($fp);
}

// 網站路徑
	$seo_url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
	$seo_url=dirname(dirname($seo_url));


if ($_SERVER['HTTP_HOST'] == "www.shop3500.com") { // 當網址為shop3500 
// 產生Sitemap For Shop3500
  $content='
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';

// 主頁面
$data_array=array(
    array(
		'loc'=>$seo_url . "/" . $wshop,
		'priority'=>'1.0',
		'lastmod'=>date("Y-m-d",time()),
		'changefreq'=>'always'
    )
);
require("sitemapgenerate/sitemap_dftype.php"); // 主選單
$dftype_tip = "主選單【" . $dftype_i . "】筆連結已更新。";
require("sitemapgenerate/sitemap_modlink.php"); 
$modlink_tip = $ModuleName['Modlink'] . "【" . $modlink_i . "】筆連結已更新。";

if ($OptionAboutSelect == '1') { // 關於我們
require("sitemapgenerate/sitemap_about.php");
$about_tip = $ModuleName['About'] . "【" . $about_i . "】筆連結已更新。";
}
if ($OptionActivitiesSelect == '1') { // 活動花絮
require("sitemapgenerate/sitemap_activities.php"); 
$activities_tip = $ModuleName['Activities'] . "【" . $activities_i . "】筆連結已更新。";
}
if ($OptionActnewsSelect == '1') { // 活動快訊
require("sitemapgenerate/sitemap_actnews.php"); 
$actnews_tip = $ModuleName['Actnews'] . "【" . $actnews_i . "】筆連結已更新。";
}
if ($OptionAlbumSelect == '1') { // 相簿展示
require("sitemapgenerate/sitemap_album.php"); 
$album_tip = $ModuleName['Album'] . "【" . $album_i . "】筆連結已更新。";
}
if ($OptionArticleSelect == '1') { // 文章管理
require("sitemapgenerate/sitemap_article.php"); 
$article_tip = $ModuleName['Article'] . "【" . $article_i . "】筆連結已更新。";
}
if ($OptionArtlistSelect == '1') { // 藝文專欄
require("sitemapgenerate/sitemap_artlist.php"); 
$artlist_tip = $ModuleName['Artlist'] . "【" . $artlist_i . "】筆連結已更新。";
}
if ($OptionCareersSelect == '1') { // 求職徵才
require("sitemapgenerate/sitemap_careers.php"); 
$careers_tip = $ModuleName['Careers'] . "【" . $careers_i . "】筆連結已更新。";
}
if ($OptionLettersSelect == '1') { // 新聞快訊
require("sitemapgenerate/sitemap_letters.php"); 
$letters_tip = $ModuleName['Letters'] . "【" . $letters_i . "】筆連結已更新。";
}
if ($OptionNewsSelect == '1') { // 最新訊息
require("sitemapgenerate/sitemap_news.php"); 
$news_tip = $ModuleName['News'] . "【" . $news_i . "】筆連結已更新。";
}
if ($OptionProductSelect == '1') { // 商品櫥窗
require("sitemapgenerate/sitemap_product.php"); 
$product_tip = $ModuleName['Product'] . "【" . $product_i . "】筆連結已更新。";
}
if ($OptionProjectSelect == '1') { // 工程實績
require("sitemapgenerate/sitemap_project.php"); 
$project_tip = $ModuleName['Project'] . "【" . $project_i . "】筆連結已更新。";
}
if ($OptionPublishSelect == '1') { // 發布資訊
require("sitemapgenerate/sitemap_publish.php"); 
$publish_tip = $ModuleName['Publish'] . "【" . $publish_i . "】筆連結已更新。";
}
if ($OptionRoomSelect == '1') { // 房型展示
require("sitemapgenerate/sitemap_room.php"); 
$room_tip = $ModuleName['Room'] . "【" . $room_i . "】筆連結已更新。";
}
if ($OptionVideoSelect == '1') { // 影音共享
require("sitemapgenerate/sitemap_video.php"); 
$video_tip = $ModuleName['Video'] . "【" . $video_i . "】筆連結已更新。";
}
if ($OptionKnowledgeSelect == '1') { // 知識學習
require("sitemapgenerate/sitemap_knowledge.php"); 
$knowledge_tip = $ModuleName['Knowledge'] . "【" . $knowledge_i . "】筆連結已更新。";
}

foreach($data_array as $data){
	$content.=create_item($data);
}
$content.='</urlset>';

$fp=fopen($SiteImgFilePathAdmin . $_POST['wshop'] . '/sitemap.xml','w+');

fwrite($fp,$content);
fclose($fp);

if($urlonly == '1' && $urllink != "") {
	
  $seo_url = $urllink;
// 產生Sitemap For 獨立網址
  $content='
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';

// 主頁面
unset($data_array); // 清空 Array

$data_array=array(
    array(
		'loc'=>$seo_url . "/" . $wshop,
		'priority'=>'1.0',
		'lastmod'=>date("Y-m-d",time()),
		'changefreq'=>'always'
    )
);

require("sitemapgenerate/sitemap_dftype.php"); // 主選單
$dftype_tip = "主選單【" . $dftype_i . "】筆連結已更新。";
require("sitemapgenerate/sitemap_modlink.php"); 
$modlink_tip = $ModuleName['Modlink'] . "【" . $modlink_i . "】筆連結已更新。";

if ($OptionAboutSelect == '1') { // 關於我們
require("sitemapgenerate/sitemap_about.php");
$about_tip = $ModuleName['About'] . "【" . $about_i . "】筆連結已更新。";
}
if ($OptionActivitiesSelect == '1') { // 活動花絮
require("sitemapgenerate/sitemap_activities.php"); 
$activities_tip = $ModuleName['Activities'] . "【" . $activities_i . "】筆連結已更新。";
}
if ($OptionActnewsSelect == '1') { // 活動快訊
require("sitemapgenerate/sitemap_actnews.php"); 
$actnews_tip = $ModuleName['Actnews'] . "【" . $actnews_i . "】筆連結已更新。";
}
if ($OptionAlbumSelect == '1') { // 相簿展示
require("sitemapgenerate/sitemap_album.php"); 
$album_tip = $ModuleName['Album'] . "【" . $album_i . "】筆連結已更新。";
}
if ($OptionArticleSelect == '1') { // 文章管理
require("sitemapgenerate/sitemap_article.php"); 
$article_tip = $ModuleName['Article'] . "【" . $article_i . "】筆連結已更新。";
}
if ($OptionArtlistSelect == '1') { // 藝文專欄
require("sitemapgenerate/sitemap_artlist.php"); 
$artlist_tip = $ModuleName['Artlist'] . "【" . $artlist_i . "】筆連結已更新。";
}
if ($OptionCareersSelect == '1') { // 求職徵才
require("sitemapgenerate/sitemap_careers.php"); 
$careers_tip = $ModuleName['Careers'] . "【" . $careers_i . "】筆連結已更新。";
}
if ($OptionLettersSelect == '1') { // 新聞快訊
require("sitemapgenerate/sitemap_letters.php"); 
$letters_tip = $ModuleName['Letters'] . "【" . $letters_i . "】筆連結已更新。";
}
if ($OptionNewsSelect == '1') { // 最新訊息
require("sitemapgenerate/sitemap_news.php"); 
$news_tip = $ModuleName['News'] . "【" . $news_i . "】筆連結已更新。";
}
if ($OptionProductSelect == '1') { // 商品櫥窗
require("sitemapgenerate/sitemap_product.php"); 
$product_tip = $ModuleName['Product'] . "【" . $product_i . "】筆連結已更新。";
}
if ($OptionProjectSelect == '1') { // 工程實績
require("sitemapgenerate/sitemap_project.php"); 
$project_tip = $ModuleName['Project'] . "【" . $project_i . "】筆連結已更新。";
}
if ($OptionPublishSelect == '1') { // 發布資訊
require("sitemapgenerate/sitemap_publish.php"); 
$publish_tip = $ModuleName['Publish'] . "【" . $publish_i . "】筆連結已更新。";
}
if ($OptionRoomSelect == '1') { // 房型展示
require("sitemapgenerate/sitemap_room.php"); 
$room_tip = $ModuleName['Room'] . "【" . $room_i . "】筆連結已更新。";
}
if ($OptionVideoSelect == '1') { // 影音共享
require("sitemapgenerate/sitemap_video.php"); 
$video_tip = $ModuleName['Video'] . "【" . $video_i . "】筆連結已更新。";
}
if ($OptionKnowledgeSelect == '1') { // 知識學習
require("sitemapgenerate/sitemap_knowledge.php"); 
$knowledge_tip = $ModuleName['Knowledge'] . "【" . $knowledge_i . "】筆連結已更新。";
}

foreach($data_array as $data){
	$content.=create_item($data);
}
$content.='</urlset>';

$fp=fopen($SiteImgFilePathAdmin . $_POST['wshop'] . '/sitemaps.xml','w+');

fwrite($fp,$content);
fclose($fp);	
	
	
}

}else{ // 當網址為不為shop3500 
// 產生Sitemap For 獨立網址
  $content='
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';

// 主頁面
$data_array=array(
    array(
		'loc'=>$seo_url . "/" . $wshop,
		'priority'=>'1.0',
		'lastmod'=>date("Y-m-d",time()),
		'changefreq'=>'always'
    )
);

require("sitemapgenerate/sitemap_dftype.php"); // 主選單
$dftype_tip = "主選單【" . $dftype_i . "】筆連結已更新。";
require("sitemapgenerate/sitemap_modlink.php"); 
$modlink_tip = $ModuleName['Modlink'] . "【" . $modlink_i . "】筆連結已更新。";

if ($OptionAboutSelect == '1') { // 關於我們
require("sitemapgenerate/sitemap_about.php");
$about_tip = $ModuleName['About'] . "【" . $about_i . "】筆連結已更新。";
}
if ($OptionActivitiesSelect == '1') { // 活動花絮
require("sitemapgenerate/sitemap_activities.php"); 
$activities_tip = $ModuleName['Activities'] . "【" . $activities_i . "】筆連結已更新。";
}
if ($OptionActnewsSelect == '1') { // 活動快訊
require("sitemapgenerate/sitemap_actnews.php"); 
$actnews_tip = $ModuleName['Actnews'] . "【" . $actnews_i . "】筆連結已更新。";
}
if ($OptionAlbumSelect == '1') { // 相簿展示
require("sitemapgenerate/sitemap_album.php"); 
$album_tip = $ModuleName['Album'] . "【" . $album_i . "】筆連結已更新。";
}
if ($OptionArticleSelect == '1') { // 文章管理
require("sitemapgenerate/sitemap_article.php"); 
$article_tip = $ModuleName['Article'] . "【" . $article_i . "】筆連結已更新。";
}
if ($OptionArtlistSelect == '1') { // 藝文專欄
require("sitemapgenerate/sitemap_artlist.php"); 
$artlist_tip = $ModuleName['Artlist'] . "【" . $artlist_i . "】筆連結已更新。";
}
if ($OptionCareersSelect == '1') { // 求職徵才
require("sitemapgenerate/sitemap_careers.php"); 
$careers_tip = $ModuleName['Careers'] . "【" . $careers_i . "】筆連結已更新。";
}
if ($OptionLettersSelect == '1') { // 新聞快訊
require("sitemapgenerate/sitemap_letters.php"); 
$letters_tip = $ModuleName['Letters'] . "【" . $letters_i . "】筆連結已更新。";
}
if ($OptionNewsSelect == '1') { // 最新訊息
require("sitemapgenerate/sitemap_news.php"); 
$news_tip = $ModuleName['News'] . "【" . $news_i . "】筆連結已更新。";
}
if ($OptionProductSelect == '1') { // 商品櫥窗
require("sitemapgenerate/sitemap_product.php"); 
$product_tip = $ModuleName['Product'] . "【" . $product_i . "】筆連結已更新。";
}
if ($OptionProjectSelect == '1') { // 工程實績
require("sitemapgenerate/sitemap_project.php"); 
$project_tip = $ModuleName['Project'] . "【" . $project_i . "】筆連結已更新。";
}
if ($OptionPublishSelect == '1') { // 發布資訊
require("sitemapgenerate/sitemap_publish.php"); 
$publish_tip = $ModuleName['Publish'] . "【" . $publish_i . "】筆連結已更新。";
}
if ($OptionRoomSelect == '1') { // 房型展示
require("sitemapgenerate/sitemap_room.php"); 
$room_tip = $ModuleName['Room'] . "【" . $room_i . "】筆連結已更新。";
}
if ($OptionVideoSelect == '1') { // 影音共享
require("sitemapgenerate/sitemap_video.php"); 
$video_tip = $ModuleName['Video'] . "【" . $video_i . "】筆連結已更新。";
}
if ($OptionKnowledgeSelect == '1') { // 知識學習
require("sitemapgenerate/sitemap_knowledge.php"); 
$knowledge_tip = $ModuleName['Knowledge'] . "【" . $knowledge_i . "】筆連結已更新。";
}

foreach($data_array as $data){
	$content.=create_item($data);
}
$content.='</urlset>';

$fp=fopen($SiteImgFilePathAdmin . $_POST['wshop'] . '/sitemaps.xml','w+');

fwrite($fp,$content);
fclose($fp);


    function create_item_ma($data){
        $item="<product>\n";
        $item.="<SKU>".$data['SKU']."</SKU>\n";
        $item.="<Name>".$data['Name']."</Name>\n";
        $item.="<Description>".$data['Description']."</Description>\n";
        $item.="<URL>".$data['URL']."</URL>\n";
        $item.="<Price>".$data['Price']."</Price>\n";
        $item.="<LargeImage>".$data['LargeImage']."</LargeImage>\n";
        $item.="<SalePrice>".$data['SalePrice']."</SalePrice>\n";
        $item.="<UPC>".$data['UPC']."</UPC>\n";
        $item.="<ISBN>".$data['ISBN']."</ISBN>\n";
        $item.="<MPN>".$data['MPN']."</MPN>\n";
        $item.="<Manufacturer>".$data['Manufacturer']."</Manufacturer>\n";
        $item.="<Brand>".$data['Brand']."</Brand>\n";
        $item.="<Category>".$data['Category']."</Category>\n";
        $item.="<EAN>".$data['EAN']."</EAN>\n";
        $item.="<Condition>".$data['Condition']."</Condition>\n";
        $item.="</product>\n";
        return $item;
    }

    $data_array_ma=array(
        array(
        )
    );


$content2='';
$content2.='<Products>';
//


    if ($OptionProductSelect == '1') { // 商品櫥窗

       require("sitemapgenerate/sitemap_product_ma.php");
       $product_tip = $ModuleName['Product'] . "【" . $product_i . "】筆連結已更新。";
   }
//
//    foreach($data_array as $data){
//        $content2.=create_item($data);
//    }
//

    foreach($data_array_ma as $data){

        if($data['Name'] != "") {
            $content2 .= create_item_ma($data);
        }
    }

$content2.='</Products>';


//
$fp2=fopen($SiteImgFilePathAdmin . $_POST['wshop'] . '/MA_products.xml','w+');
//
fwrite($fp2,$content2);
fclose($fp2);




}

echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $dftype_tip . "'" . ",'information');});</script>\n";
if($modlink_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $modlink_tip . "'" . ",'information');});</script>\n";
}
if($about_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $about_tip . "'" . ",'information');});</script>\n";
}
if($activities_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $activities_tip . "'" . ",'information');});</script>\n";
}
if($actnews_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $actnews_tip . "'" . ",'information');});</script>\n";
}
if($album_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $album_tip . "'" . ",'information');});</script>\n";
}
if($article_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $article_tip . "'" . ",'information');});</script>\n";
}
if($artlist_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $artlist_tip . "'" . ",'information');});</script>\n";
}
if($careers_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $careers_tip . "'" . ",'information');});</script>\n";
}
if($letters_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $letters_tip . "'" . ",'information');});</script>\n";
}
if($news_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $news_tip . "'" . ",'information');});</script>\n";
}
if($product_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $product_tip . "'" . ",'information');});</script>\n";
}
if($project_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $project_tip . "'" . ",'information');});</script>\n";
}
if($publish_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $publish_tip . "'" . ",'information');});</script>\n";
}
if($room_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $room_tip . "'" . ",'information');});</script>\n";
}
if($video_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $video_tip . "'" . ",'information');});</script>\n";
}
if($knowledge_i != "") {
echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(" . "'" . $knowledge_tip . "'" . ",'information');});</script>\n";
}

/*
* Sitemap Submitter
* Use this script to submit your site maps automatically to Google, Bing.MSN and Ask
* Trigger this script on a schedule of your choosing or after your site map gets updated.
*/

//Set this to be your site map URL
/*$sitemapUrl = $seo_url . "/sitemap/sitemap.xml";

// cUrl handler to ping the Sitemap submission URLs for Search Engines…
function myCurl($url){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  return $httpCode;
}

//Google
$url = "http://www.google.com/webmasters/sitemaps/ping?sitemap=".$sitemapUrl;
$returnCode = myCurl($url);
echo "<p>Google Sitemaps has been pinged (return code: $returnCode).</p>";

//Bing / MSN
$url = "http://www.bing.com/webmaster/ping.aspx?siteMap=".$sitemapUrl;
$returnCode = myCurl($url);
echo "<p>Bing / MSN Sitemaps has been pinged (return code: $returnCode).</p>";

//ASK
$url = "http://submissions.ask.com/ping?sitemap=".$sitemapUrl;
$returnCode = myCurl($url);
echo "<p>ASK.com Sitemaps has been pinged (return code: $returnCode).</p>";*/
// 產生Sitemap
};

$coluserid_RecordSettingFr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingFr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingFr = sprintf("SELECT id, SitemapRenewDate FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingFr, "int"));
$RecordSettingFr = mysqli_query($DB_Conn, $query_RecordSettingFr) or die(mysqli_error($DB_Conn));
$row_RecordSettingFr = mysqli_fetch_assoc($RecordSettingFr);
$totalRows_RecordSettingFr = mysqli_num_rows($RecordSettingFr);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> Sitemap <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 資料建立</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>此頁面為自動產生Google或Yahoo流量分析工具所需的Sitemap檔案。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>Sitemap是一種檔案，您可以在其中列出網站上的網頁，讓 Google 和其他搜尋引擎瞭解您的網站內容架構。搜尋引擎網路檢索器 (例如 Googlebot) 會讀取這個檔案，以更靈活的方式檢索您的網站。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>Sitemap 可以針對 Sitemap 中列出的網頁，提供與這些網頁相關聯的寶貴「中繼資料」：中繼資料指的是網頁相關資訊，例如網頁上次更新的日期、網頁更新頻率，以及相對於網站中其他網址，該網頁的重要性。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>Sitemap 產生之後請務必至Google或Bing(Yahoo)去做提交。</b></div>
  
  <form class="form-horizontal form-bordered" data-parsley-validate="" method="post" action="<?php echo $editFormAction; ?>" id="form1" name="form1" > 
       <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> Sitemap提交位置</span></div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Google 網站管理工具</label>
          <div class="col-md-10">
              
                  <a href="https://www.google.com/webmasters/tools/home?hl=zh-TW" class="btn btn-link" target="_blank">https://www.google.com/webmasters/tools/home?hl=zh-TW</a>
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Yahoo 網站管理工具</label>
          <div class="col-md-10">
              
                  <a href="http://www.bing.com/toolbox/webmaster/" class="btn btn-link" target="_blank">http://www.bing.com/toolbox/webmaster/</a>
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 資訊及更新</span></div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Sitemap 更新時間</label>
          <div class="col-md-10"><?php if($row_RecordSettingFr['SitemapRenewDate'] == ""){echo "尚未產生";}else{ $dt = new DateTime($row_RecordSettingFr['SitemapRenewDate']); echo $dt->format('Y-m-d h:i A');} ?></div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Sitemap 路徑</label>
          <div class="col-md-10">
              
                  <?php 
		    // 網站路徑
			$seo_url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
			$seo_url=dirname(dirname($seo_url));
			if ($_SERVER['SERVER_NAME'] == "www.shop3500.com") { // Shop3500才需產生索引檔
			    echo "<i class=\"fa fa-tag\"></i> ";
			    echo "適用網址：http://" . $_SERVER['SERVER_NAME'];
				echo "<br />";
		  		echo $seo_url . "/site/" . $wshop . '/sitemap.xml'; 
				// 如果有獨立網址的話一並列出
				//echo $urlonly;
				if($urlonly == '1' && $urllink != "") {
					echo "<br />";
					echo "<br />";
					echo "<i class=\"fa fa-tag\"></i> ";
					echo "適用網址：" . $urllink;
					echo "<br />";
					echo $urllink . "/site/" . $wshop . '/sitemap' . '<span style="color:#F00">s</span>' . '.xml';
				}
			}else{
				echo $seo_url . "/site/" . $wshop . '/sitemaps.xml'; 
			}
		  ?>
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Sitemap 檢視</label>
          <div class="col-md-10">
              
                  <?php if ($_SERVER['HTTP_HOST'] == "www.shop3500.com") { ?>
            <a href="<?php echo $seo_url . "/site/" . $wshop . '/sitemap.xml'; ?>" target="_blank">sitemap.xml</a>
            <?php if($urlonly == '1' && $urllink != "") { ?>
            <br />
            <a href="<?php echo $urllink . "/site/" . $wshop . '/sitemaps.xml'; ?>" target="_blank">sitemaps.xml</a>
            <?php } ?>
            
          <?php } else { ?>
          	<a href="<?php echo $seo_url . "/site/" . $wshop . '/sitemaps.xml'; ?>" target="_blank">sitemaps.xml</a>
          <?php } ?>
                                      
          
                      
                      
                 
          </div>
      </div>

      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">產品銷售資料表XML檔案</label>
          <div class="col-md-10">

              <?php
              // 網站路徑
              $seo_url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
              $seo_url=dirname(dirname($seo_url));

              echo $seo_url . "/site/" . $wshop . '/MA_products.xml';

              ?>




          </div>
      </div>

      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">產品銷售資料表XML檢視</label>
          <div class="col-md-10">

                  <a href="<?php echo $seo_url . "/site/" . $wshop . '/MA_products.xml'; ?>" target="_blank">MA_products.xml</a>

          </div>
      </div>
 
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10" id="Step_Re">
          <?php $dt = new DateTime(); $dt->format('Y-m-d'); ?>
          <?php if (margin($row_RecordSettingFr['SitemapRenewDate'], $dt->format('Y-m-d H:i:s')) > 1 || $_SESSION['MM_UserGroup'] == 'superadmin') { ?>
          <button type="submit" class="btn btn btn-primary btn-block" id="Step_Send">更新</button>
		  <?php } else { ?>
          <button type="submit" class="btn btn btn-primary btn-block" id="Step_Send" disabled="disabled">為避免搜尋引擎黑名單 需等待上次更新時間一天後方可更新</button>
		  <?php } ?>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSettingFr['id']; ?>" />
            <input name="SitemapRenewDate" type="hidden" id="SitemapRenewDate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      
      
  <input type="hidden" name="MM_update" value="form1" />
  </form>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip1',
                intro: 'Sitemap 可以讓你的網站快速的收錄在收尋引擎中，提升你網站的排名同時也是SEO優化。'
              },
			  {
                element: '#Step_Re',
                intro: '產生目前網站的 Sitemap。'
              },
			  {
                element: '#Step_Verification',
                intro: '若您尚未註冊網站管理工具以及驗證網站所有權，請先前往該頁面進行操作。'
              },
			  {
                element: '#Step_Link',
                intro: '此為產生Sitemap路徑，稍後我們要將它填入網站管理工具中。'
              },
			  {
                element: '#Step_Go',
                intro: 'Sitemap檔案必須跟Google網站管理工具或Yahoo網站管理工具做搭配，因此您必須登入後作提交。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="https://www.google.com/webmasters/tools/home?hl=zh-TW" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往 Google 網站管理工具</a></span><span class = "InnerPage" style="float:none"><a href="http://www.bing.com/toolbox/webmaster/" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往 Yahoo 網站管理工具</a></span></div>'
              },
			  {
                element: '#Step_Tip1',
                intro: '<img src="images/tip/tip048.jpg" width="500" height="450" /><br /><br />依照以下的步驟操作，進入Sitemap的上傳頁面。'
              },
			  {
                element: '#Step_Tip2',
                intro: '<img src="images/tip/tip049.jpg" width="500" height="403" /><br /><br />填入您的Sitemap網址。'
              },
              {
                element: '#Step_View',
                intro: '設置完後您必須等待系統分析以及收錄您的網站。',
                position: 'bottom'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "addSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php
mysqli_free_result($RecordSettingFr);
?>
