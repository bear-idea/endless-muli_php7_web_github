<?php
namespace App\Repositories;

use App\Eloquent\Publish;

$maxRows[$Tp_Page] = $perPage = 1; // 每頁幾筆
$columns = '*'; // 返回的欄位陣列
$pageName = 'page'; // 分頁欄位名
$pageNums[$Tp_Page] = $currentPage = 1; // 第幾頁
if (isset($_GET[$pageName])) {
    $pageNums[$Tp_Page] = $currentPage = $_GET[$pageName];
}
$startRows[$Tp_Page] = ($pageNums[$Tp_Page] * $maxRows[$Tp_Page]) - $maxRows[$Tp_Page]; // 起始筆數

$colid[$Tp_Page] = "-1";
if (isset($_GET['id'])) {
  $colid[$Tp_Page] = $_GET['id'];
}

$collang[$Tp_Page] = "zh-tw";
if (isset($_GET['lang'])) {
  $collang[$Tp_Page] = $_GET['lang'];
}

$coluserid[$Tp_Page] = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid[$Tp_Page] = $_SESSION['userid'];
}

$rows_module[$Tp_Page] = Publish::select($columns)
  ->where('lang', '=', $collang[$Tp_Page])
  ->where('id', '=', $colid[$Tp_Page])
  ->where('indicate', '=', '1')
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->paginate($perPage, $columns, $pageName, $currentPage)
  //->get()
  ->toArray();

$rows_moduleCount[$Tp_Page] = $rows_module[$Tp_Page]['total']; // 目前筆數


foreach ($rows_module[$Tp_Page]['data'] as $publish) {
	$row_data['id'] = $publish['id'];
    $row_data['title'] = $publish['title'];
	$row_data['content'] = $publish['content'];
}
?>