<?php
namespace App\Repositories;

use App\Eloquent\About;
use Naucon\Breadcrumbs\Breadcrumbs;

$columns = ['id', 'title']; // 返回的欄位陣列

$resultSelectbox[$Tp_Page] = About::select($columns)
  ->where('lang', '=', $collang[$Tp_Page])
  ->where('indicate', '=', '1')
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->get()
  ->toArray();


$resultSelectbox[$Tp_Page]['total'] = count($resultSelectbox[$Tp_Page]);

$data_Selectbox = new Breadcrumbs();

foreach ($resultSelectbox[$Tp_Page] as $about_Selectbox) {
    $row_data_Selectbox['id'] = $about_Selectbox['id'];
	$row_data_Selectbox['title'] = $about_Selectbox['title'];
	
	$data_Selectbox_Url = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_data_Selectbox['id']),'',$UrlWriteEnable);
	$data_Selectbox->add($row_data_Selectbox['title'], $data_Selectbox_Url);
}
?>
