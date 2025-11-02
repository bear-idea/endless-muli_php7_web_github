<?php
namespace App\Repositories;

use App\Eloquent\About;
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

$collang[$Tp_Page] = "zh-tw";
if (isset($_GET['lang'])) {
  $collang[$Tp_Page] = $_GET['lang'];
}

$coluserid[$Tp_Page] = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid[$Tp_Page] = $_SESSION['userid'];
}
//paginate($perPage, $columns, $pageName, $currentPage);

$rows_module[$Tp_Page] = About::select($columns)
  ->where('lang', '=', $collang[$Tp_Page])
  ->where('indicate', '=', '1')
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->orderBy('postdate', 'desc')
  ->paginate($perPage, $columns, $pageName, $currentPage)
  ->setPath($SiteBaseUrl . url_rewrite($Tp_MdName, array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>$_GET['Opt']), '', $UrlWriteEnable))
  //->appends(['wshop' => $_GET['wshop']])
  //->appends(['lang' => $_SESSION['lang']])
  //->appends(['page' => $_GET['page']])
	//->skip($startRow_RecordAbout)
  //->take($maxRows_RecordAbout)
	//->get();
  ->toArray();
  //dd($rows_module);

$rows_moduleCount[$Tp_Page] = $rows_module[$Tp_Page]['total']; // 目前筆數

$row_data[$Tp_Page] = $rows_module[$Tp_Page]['data'];

// 重新修改值
foreach ($row_data[$Tp_Page] as $key => $about) {
	
	$row_data[$Tp_Page][$key]['id'] = $about['id'];
	$row_data[$Tp_Page][$key]['title'] = $about['title'];
	$row_data[$Tp_Page][$key]['link_url'] = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$about['id']),'',$UrlWriteEnable);
	$row_data[$Tp_Page][$key]['postdate'] = Carbon::parse($about['postdate'])->toDateString();
}

$table = new Table;
$table->class('table table-hover');

$icon = "<i class='fa fa-circle-o' aria-hidden='true'></i>";

foreach ($row_data[$Tp_Page] as $row_data[$Tp_Page]) {
	$row = $table->body()->row();
  	$row->cell()->content($icon)->class('width-20')->raw();
	$row->linkCell($row_data[$Tp_Page]['link_url'])->content($row_data[$Tp_Page]['title']);
	$row->cell(Carbon::parse($row_data[$Tp_Page]['postdate'])->toDateString())->class('width-100 hidden-xs');
	//$row_data['postdate'] = $dt->format('Y-m-d');
}
?>