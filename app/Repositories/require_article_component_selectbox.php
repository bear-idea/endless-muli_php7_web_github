<?php
namespace App\Repositories;

use App\Eloquent\Article;
use Naucon\Breadcrumbs\Breadcrumbs;

$columns = ['id', 'title']; // 返回的欄位陣列

$coluserid[$Tp_Page] = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid[$Tp_Page] = $_SESSION['userid'];
}
$coltype1[$Tp_Page] = "-1";
if (isset($_GET['type1'])) {
  $coltype1[$Tp_Page] = $_GET['type1'];
}
$coltype2[$Tp_Page] = "-1";
if (isset($_GET['type2'])) {
  $coltype2[$Tp_Page] = $_GET['type2'];
}
$coltype3[$Tp_Page] = "-1";
if (isset($_GET['type3'])) {
  $coltype3[$Tp_Page] = $_GET['type3'];
}

$resultSelectbox[$Tp_Page] = Article::select($columns)
  ->where('lang', '=', $collang[$Tp_Page])
  ->where('indicate', '=', '1')
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->where('type1', '=', $coltype1[$Tp_Page])
  ->where('type2', '=', $coltype2[$Tp_Page])
  ->where('type3', '=', $coltype3[$Tp_Page])
  ->get()
  ->toArray();


$resultSelectbox[$Tp_Page]['total'] = count($resultSelectbox[$Tp_Page]);

$data_Selectbox = new Breadcrumbs();

foreach ($resultSelectbox[$Tp_Page] as $key => $atricle_Selectbox) {
    $row_data_Selectbox['id'] = $atricle_Selectbox['id'];
	$row_data_Selectbox['title'] = $atricle_Selectbox['title'];
	$row_data_Selectbox['type1'] = $coltype1[$Tp_Page];
	$row_data_Selectbox['type2'] = $coltype2[$Tp_Page];
	$row_data_Selectbox['type3'] = $coltype3[$Tp_Page];
	
	if($row_data_Selectbox['type3'] != "-1") {
		$data_Selectbox_Url = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_data_Selectbox['type1'],'type2'=>$row_data_Selectbox['type2'],'type3'=>$row_data_Selectbox['type3'],'id'=>$row_data_Selectbox['id']),'',$UrlWriteEnable);
	}else if($row_data_Selectbox['type2'] != "-1") {
		$data_Selectbox_Url = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_data_Selectbox['type1'],'type2'=>$row_data_Selectbox['type2'],'id'=>$row_data_Selectbox['id']),'',$UrlWriteEnable);
	}else if($row_data_Selectbox['type1'] != "-1") {
		$data_Selectbox_Url = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_data_Selectbox['type1'],'id'=>$row_data_Selectbox['id']),'',$UrlWriteEnable);
	}else{
		$data_Selectbox_Url = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_data_Selectbox['id']),'',$UrlWriteEnable);
	}
	
	$data_Selectbox->add($row_data_Selectbox['title'], $data_Selectbox_Url);
}
?>

