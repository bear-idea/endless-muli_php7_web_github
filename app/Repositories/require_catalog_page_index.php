<?php
namespace App\Repositories;

use App\Eloquent\Catalog;
use Carbon\Carbon;
use Tlr\Tables\Elements\Table;

$maxRows[$Tp_Page] = $perPage = 24; // 每頁幾筆
$columns = '*'; // 返回的欄位陣列
$pageName = 'page'; // 分頁欄位名
$pageNums[$Tp_Page] = $currentPage = 1; // 第幾頁
if (isset($_GET[$pageName])) {
    $pageNums[$Tp_Page] = $currentPage = $_GET[$pageName];
}
$startRows[$Tp_Page] = ($pageNums[$Tp_Page] * $maxRows[$Tp_Page]) - $maxRows[$Tp_Page]; // 起始筆數

$colsearchkey[$Tp_Page] = "%";
if (isset($_GET['searchkey'])) {
  $colsearchkey[$Tp_Page] = $_GET['searchkey'];
}

$collang[$Tp_Page] = "zh-tw";
if (isset($_GET['lang'])) {
  $collang[$Tp_Page] = $_GET['lang'];
}

$coluserid[$Tp_Page] = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid[$Tp_Page] = $_SESSION['userid'];
}
//paginate($perPage, $columns, $pageName, $currentPage);

$rows_module[$Tp_Page] = Catalog::select($columns)
  ->where('lang', '=', $collang[$Tp_Page])
  ->where('indicate', '=', '1')
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->where('type', 'LIKE', $colsearchkey[$Tp_Page])
  ->orderBy('postdate', 'desc')
  ->paginate($perPage, $columns, $pageName, $currentPage)
	//->skip($startRow_RecordAbout)
  //->take($maxRows_RecordAbout)
	//->get();
  ->toArray();
  //dd($rows_module[$Tp_Page]);

$rows_moduleCount[$Tp_Page] = $rows_module[$Tp_Page]['total']; // 目前筆數


$table = new Table;
$table->class('table table-hover');

$icon = "<i class='fa fa-cloud-download' aria-hidden='true'></i>";

foreach ($rows_module[$Tp_Page]['data'] as $catalog) {
	
	$row = $table->body()->row();
	
	$label = '<span class="label label-info">'.$catalog['type'].'</span>';
	
  	$row->cell()->content($icon)->class('width-20')->raw();
	//$row->cell()->content($label)->class('width-60')->raw();
	$row->cell()->content($label . ' ' . $catalog['title'])->raw();
	
	if ($catalog['auth'] == '0' || $_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Wshop_Dealer' || (isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) {
		if ($catalog['pic'] != "") {
			switch(GetFileExtend($catalog['pic']))
			  {
				  case ".pdf":
					  $link = "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $catalog['pic']. "" . "\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\"></i>Download</a>\n";
					  break;
				  case ".xlsx":
				  case ".xls":
					  $link = "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $catalog['pic']. "" . "\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-excel-o\" aria-hidden=\"true\"></i>Download</a>\n";			
					  break;
				  case ".doc":
				  case ".docx":
					  $link = "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $catalog['pic']. "" . "\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-word-o\" aria-hidden=\"true\"></i>Download</a>\n";			
					  break;
				  case ".rar":
				  case ".zip":
					  $link = "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $catalog['pic']. "" . "\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-archive-o\" aria-hidden=\"true\"></i>Download</a>\n";	
					  break;
				  case ".avi":
					  $link = "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $catalog['pic']. "" . "\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-video-o\" aria-hidden=\"true\"></i>Download</a>\n";	
					  break;
				  case ".ppt":
				  case ".pptx":
					  $link = "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $catalog['pic']. "" . "\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-powerpoint-o\" aria-hidden=\"true\"></i>Download</a>\n";			
					  break;
				  case ".jpg":
				  case ".gif":
				  case ".png":
				  case ".bmp":
				  case ".jpeg":
					  $link = "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $catalog['pic']. "" . "\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-image-o\" aria-hidden=\"true\"></i>Download</a>\n";				
					  break;	
				  default:
					  $link = "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $catalog['pic']. "" . "\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-o\" aria-hidden=\"true\"></i>Download\n";
					  break;
			  }
			$row->cell()->content($link)->class('width-20')->raw();
		} else {
			if ($catalog['link'] != "") {
				$link = "<a href=\"#\" class='btn btn-xs btn-3d btn-white'><i class=\"fa fa-file-text-o\" aria-hidden=\"true\"></i>Download</a>\n";	
				$row->cell()->content($link)->class('width-20')->raw();
			 } else {
				$link = "<a href=\"#\" class='btn btn-xs btn-3d btn-white' disabled='disabled'><i class=\"fa fa-file-text-o\" aria-hidden=\"true\"></i>Download</a>\n";	
				$row->cell()->content($link)->class('width-20')->raw();
			 }
		}
		
	} else {
		$link = "<a href=\"#\" class='btn btn-xs btn-3d btn-white' disabled='disabled'><i class=\"fa fa-file-text-o\" aria-hidden=\"true\"></i>Download</a>\n";	
		$row->cell()->content($link)->class('width-20')->raw();
	}
	
	$row->cell(Carbon::parse($catalog['postdate'])->toDateString())->class('width-100 hidden-xs');
	$row_data['id'] = $catalog['id'];
}



?>