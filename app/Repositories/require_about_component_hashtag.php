<?php
namespace App\Repositories;

use App\Eloquent\About;
use Naucon\Breadcrumbs\Breadcrumbs;

$columns = ['skeyword', 'skeywordindicate']; // 返回的欄位陣列

$resultHashtag[$Tp_Page] = About::select($columns)
  ->where('id', '=', $about['id'])
  ->get()
  ->toArray();

foreach ($resultHashtag[$Tp_Page] as $about_Hashtag) {
    $row_data_Hashtag['skeyword'] = $about_Hashtag['skeyword'];
	$row_data_Hashtag['skeywordindicate'] = $about_Hashtag['skeywordindicate'];
}

$data_Hashtag = new Breadcrumbs();

if(isset($row_data_Hashtag['skeyword']) && $row_data_Hashtag['skeyword'] != ''){
	$arr_Hashtag = explode(',', $row_data_Hashtag['skeyword']);
	
	$data_Hashtag_Url = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'search'),'',$UrlWriteEnable);

	$data_Hashtag->add("<i class='fa fa-tag'></i>", '');
	for($i = 0; $i < count($arr_Hashtag); $i++){
		$data_Hashtag->add($arr_Hashtag[$i], $data_Hashtag_Url);
	}
}
?>