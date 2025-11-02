<?php
namespace App\Repositories;

use App\Eloquent\Publish;
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

$rows_module[$Tp_Page] = Publish::select($columns)
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

$icon = "<i class='fa fa-circle-o' aria-hidden='true'></i>";

foreach ($rows_module[$Tp_Page]['data'] as $publish) {
	$row = $table->body()->row();
  	$row->cell()->content($icon)->class('width-20')->raw();
	$row->linkCell($SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$publish['id']),'',$UrlWriteEnable))->content($publish['title']);
	$row->cell(Carbon::parse($publish['postdate'])->toDateString())->class('width-100 hidden-xs');
	
	$row_data['id'] = $publish['id'];
	//$row_data['postdate'] = $dt->format('Y-m-d');
}

//$dt = new DateTime($publish['postdate']);

//$dt = new DateTime($row_data['postdate']); 
//echo $dt->format('Y-m-d');


?>