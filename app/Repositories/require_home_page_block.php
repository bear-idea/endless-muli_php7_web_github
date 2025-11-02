<?php

namespace App\Repositories;

use App\Eloquent\Activities;
use App\Eloquent\Actnews;
use App\Eloquent\Letters;
use App\Eloquent\News;
use App\Eloquent\Partner;
use App\Eloquent\Product;
use App\Eloquent\Project;
use App\Eloquent\Publish;
use App\Eloquent\Sponsor;
use App\Eloquent\Tmphomeblockcolumn;
use App\Eloquent\Video;

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

$rows_module[$Tp_Page] = Tmphomeblockcolumn::select($columns)
    ->where('lang', '=', $collang[$Tp_Page])
    ->where('userid', '=', $coluserid[$Tp_Page])
    ->orderBy('sortid', 'ASC')
    //->paginate($perPage, $columns, $pageName, $currentPage)
    //->skip($startRow_RecordAbout)
    //->take($maxRows_RecordAbout)
    ->get()
    ->toArray();

$rows_moduleCount[$Tp_Page] = count($rows_module[$Tp_Page]); // 目前筆數

$RecordMiddleColumn = $rows_module[$Tp_Page];

foreach($RecordMiddleColumn as $row_RecordMiddleColumn){

    if($row_RecordMiddleColumn['type'] == 'News') {
        $RecordNews = News::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
        $ViewBloglist = '';
        $ViewBloglist = $RecordNews;
    }

    if($row_RecordMiddleColumn['type'] == 'Product') {
        $RecordProduct = Product::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
    }

    if($row_RecordMiddleColumn['type'] == 'Project') {
        $RecordProject = Project::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
    }

    if($row_RecordMiddleColumn['type'] == 'Actnews') {
        $RecordActnews = Actnews::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
    }

    if($row_RecordMiddleColumn['type'] == 'Publish') {
        $RecordPublish = Publish::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
        $ViewBloglist = '';
        $ViewBloglist = $RecordPublish;
    }

    if($row_RecordMiddleColumn['type'] == 'Partner') {
        $RecordPartner = Partner::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
    }

    if($row_RecordMiddleColumn['type'] == 'Letters') {
        $RecordLetters = Letters::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
    }

    if($row_RecordMiddleColumn['type'] == 'Video') {
        $RecordVideo = Video::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
    }

    if($row_RecordMiddleColumn['type'] == 'Activities') {
        $RecordActivities = Activities::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
    }

    if($row_RecordMiddleColumn['type'] == 'Sponsor') {
        $RecordSponsor = Sponsor::select($columns)
            ->where('lang', '=', $collang[$Tp_Page])
            ->where('indicate', '=', '1')
            ->where('userid', '=', $coluserid[$Tp_Page])
            ->orderBy('postdate', 'desc')
            ->take(6)
            ->get()
            ->toArray();
    }
}

//dd($RecordPublish);
?>