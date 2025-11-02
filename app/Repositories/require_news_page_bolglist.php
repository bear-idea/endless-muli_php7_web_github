<?php
//namespace App\Repositories;
//use Illuminate\Container\Container;
use App\Eloquent\News;
use Carbon\Carbon;

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

$rows_module[$Tp_Page] = News::select($columns)
    ->where('lang', '=', $collang[$Tp_Page])
    ->where('indicate', '=', '1')
    ->where('userid', '=', $coluserid[$Tp_Page])
    ->where('type', 'LIKE', $colsearchkey[$Tp_Page])
    ->orderBy('postdate', 'desc')
    ->paginate($perPage, $columns, $pageName, $currentPage)
    ->setPath($SiteBaseUrl . url_rewrite("news", array('wshop' => $_GET['wshop'], 'lang' => $_SESSION['lang'], 'Opt' => 'viewpage'), '', $UrlWriteEnable))
    //->skip($startRow_RecordAbout)
    //->take($maxRows_RecordAbout)
    //->get();
    ->toArray();
    //->getTable();
//dd($rows_module[$Tp_Page]);

$rows_moduleCount[$Tp_Page] = $rows_module[$Tp_Page]['total']; // 目前筆數

$row_data = array();

foreach ($rows_module[$Tp_Page]['data'] as $key => $news) {

    $row_data[$key]['id'] = $news['id'];
    $row_data[$key]['type'] = $news['type'];
    $row_data[$key]['title'] = $news['title'];
    $row_data[$key]['link_url'] = $SiteBaseUrl . url_rewrite($Tp_MdName, array('wshop' => $_GET['wshop'], 'lang' => $_SESSION['lang'], 'Opt' => 'detailed', 'id' => $news['id']), '', $UrlWriteEnable);
    $row_data[$key]['postdate'] = Carbon::parse($news['postdate'])->toDateString();
    $row_data[$key]['month'] = Carbon::parse($news['postdate'])->format('M');
    $row_data[$key]['day'] = Carbon::parse($news['postdate'])->format('d');
    $row_data[$key]['sdescription'] = str_limit(strip_tags($news['content'], 200));
}

//dd($rows_data);

?>