<?php
namespace App\Repositories;
use App\Eloquent\About;

$maxRows[$Tp_Page] = $perPage = 1; // 每頁幾筆
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
  ->where('home', '=', '1')
  ->where('indicate', '=', '1')
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->paginate($perPage, $columns, $pageName, $currentPage)
	//->skip($startRow_RecordAbout)
  //->take($maxRows_RecordAbout)
  //->get()
  ->toArray();

$rows_moduleCount[$Tp_Page] = $rows_module[$Tp_Page]['total']; // 目前筆數

$row_data[$Tp_Page] = $rows_module[$Tp_Page]['data'];

// 重新修改值
foreach ($row_data[$Tp_Page] as $about) {
	$row_data[$Tp_Page]['id'] = $about['id'];
    $row_data[$Tp_Page]['title'] = $about['title'];
	$row_data[$Tp_Page]['content'] = $about['content'];
}
?>