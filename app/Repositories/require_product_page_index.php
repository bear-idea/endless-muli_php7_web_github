<?php

namespace App\Repositories;

use App\Eloquent\Product;
use App\Eloquent\Productdiscount;
use Carbon\Carbon;

//
//$userManager ->index();

$maxRows[$Tp_Page] = $perPage = 24; // 每頁幾筆
$columns = '*'; // 返回的欄位陣列
$pageName = 'page'; // 分頁欄位名
$pageNums[$Tp_Page] = $currentPage = 1; // 第幾頁
if (isset($_GET[$pageName])) {
    $pageNums[$Tp_Page] = $currentPage = $_GET[$pageName];
}
$startRows[$Tp_Page] = ($pageNums[$Tp_Page] * $maxRows[$Tp_Page]) - $maxRows[$Tp_Page]; // 起始筆數

$colsearchkey = "%";
if (isset($_GET['searchkey'])) {
    $colsearchkey = $_GET['searchkey'];
}

$coltype1[$Tp_Page] = "%";
if (isset($_GET['type1'])) {
    $coltype1[$Tp_Page] = $_GET['type1'];
}

$coltype2[$Tp_Page] = "%";
if (isset($_GET['type2'])) {
    $coltype2[$Tp_Page] = $_GET['type2'];
}

$coltype3[$Tp_Page] = "%";
if (isset($_GET['type3'])) {
    $coltype3[$Tp_Page] = $_GET['type3'];
}

$colplot[$Tp_Page] = "%";
if (isset($_GET['plot'])) {
    $colplot[$Tp_Page] = $_GET['plot'];
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

$rows_module[$Tp_Page] = Product::select($columns)
//$query = Product::select($columns)
    ->where('type1', 'LIKE', $coltype1[$Tp_Page])
    ->where('type2', 'LIKE', $coltype2[$Tp_Page])
    ->where('type3', 'LIKE', $coltype3[$Tp_Page])
    ->where('plot', 'LIKE', $colplot[$Tp_Page])
    ->where('lang', '=', $collang[$Tp_Page])
    ->where('indicate', '=', '1')
    ->where('userid', '=', $coluserid[$Tp_Page])
    ->where(function ($query) use ($colsearchkey) {
        $query->where('name', 'LIKE', '%' . $colsearchkey . '%')
            ->orWhere('pdseries', 'LIKE', '%' . $colsearchkey . '%');
    })
    ->with('productformat')
    ->withCount('productformat')
    ->with('productphoto')
    ->withCount('productphoto')
    ->with('productdiscount')
    //->withCount('productdiscount')
    ->orderBy('sortid', 'asc')
    ->orderBy('id', 'desc')
    ->paginate($perPage, $columns, $pageName, $currentPage)
    ->setPath($SiteBaseUrl . url_rewrite("product", array('wshop' => $_GET['wshop'], 'lang' => $_SESSION['lang'], 'Opt' => 'viewpage'), '', $UrlWriteEnable))
    //->skip($startRow_RecordAbout)
    //->take($maxRows_RecordAbout)
    //->get();
    ->toArray();
//->tosql();
 //dd($rows_module[$Tp_Page]);

$getDiscountid = array_filter(array_unique(array_column($rows_module[$Tp_Page]['data'], 'discountid')));

$rows_moduleCount[$Tp_Page] = $rows_module[$Tp_Page]['total']; // 目前筆數

//userid=%s && (DATEDIFF(enddate,NOW()) >= 0 || limitdate = 0) && indicate=1

$RecordDiscountShow = Productdiscount::select($columns)
    ->whereIn('id', $getDiscountid)
    ->where('lang', '=', $collang[$Tp_Page])
    ->where('indicate', '=', '1')
    ->where('userid', '=', $coluserid[$Tp_Page])
    ->where(function ($query) {
        $query->whereRaw("DATEDIFF(enddate, '" . Carbon::now() . "')  >= 0")
            ->orWhere('limitdate', '=', '0');
    })
    ->get()
    ->toArray();

//dd($RecordProductdiscount);


$row_data = array();

foreach ($rows_module[$Tp_Page]['data'] as $key => $presenter) {

    $rows_module[$Tp_Page]['data'][$key]['id'] = $presenter['id'];
    $rows_module[$Tp_Page]['data'][$key]['name'] = $presenter['name'];
    $rows_module[$Tp_Page]['data'][$key]['price'] = $presenter['price'];
    $rows_module[$Tp_Page]['data'][$key]['spprice'] = $presenter['spprice'];
    $rows_module[$Tp_Page]['data'][$key]['inventorynotsale'] = $presenter['inventorynotsale'];
    $rows_module[$Tp_Page]['data'][$key]['inventory'] = $presenter['inventory'];
    $rows_module[$Tp_Page]['data'][$key]['pricecheck'] = $presenter['pricecheck'];
    $rows_module[$Tp_Page]['data'][$key]['discountid'] = $presenter['discountid'];
    $rows_module[$Tp_Page]['data'][$key]['discounttype'] = $presenter['discounttype'];
    $rows_module[$Tp_Page]['data'][$key]['type1'] = $presenter['type1'];
    $rows_module[$Tp_Page]['data'][$key]['type2'] = $presenter['type2'];
    $rows_module[$Tp_Page]['data'][$key]['type3'] = $presenter['type3'];
    $rows_module[$Tp_Page]['data'][$key]['pdseries'] = $presenter['pdseries'];
    $rows_module[$Tp_Page]['data'][$key]['pic'] = $presenter['pic'];
    $rows_module[$Tp_Page]['data'][$key]['plot'] = $presenter['plot'];


    // 取得折扣資料
    $presenter['discount_count'] = 0; // 折扣歸0
    $rows_module[$Tp_Page]['data'][$key]['discount_count'] = 0;

    /*foreach ($RecordDiscountShow as $key2 => $row_RecordDiscountShow) {
        if ($presenter['discountid'] == $row_RecordDiscountShow['id']) {
            $rows_module[$Tp_Page]['data'][$key]['discount_count'] = $presenter['discount_count']++;
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['name'] = $row_RecordDiscountShow['name'];
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['id'] = $row_RecordDiscountShow['id'];
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['discountPieces'] = $row_RecordDiscountShow['discountPieces'];
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['discountFoldnumber'] = $row_RecordDiscountShow['discountFoldnumber'];
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['tdiscountFullamountype'] = $row_RecordDiscountShow['discountFullamount'];
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['discountNowfold'] = $row_RecordDiscountShow['discountNowfold'];
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['discountGiftID'] = $row_RecordDiscountShow['discountGiftID'];
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['startdate'] = $row_RecordDiscountShow['startdate'];
            $rows_module[$Tp_Page]['data'][$key]['discount'][$key2]['enddate'] = $row_RecordDiscountShow['enddate'];
        }
    }*/

    switch ($presenter['plot']) {
        case "1":
            $rows_module[$Tp_Page]['data'][$key]['plot'] = "Hot";
            break;
        case "2":
            $rows_module[$Tp_Page]['data'][$key]['plot'] = "Act";
            break;
        case "3":
            $rows_module[$Tp_Page]['data'][$key]['plot'] = "Sale";
            break;
        case "4":
            $rows_module[$Tp_Page]['data'][$key]['plot'] = "New";
            break;
        default:
            $rows_module[$Tp_Page]['data'][$key]['plot'] = "";
            break;
    }

    //$rows_module[$Tp_Page]['data'][$key]['link_url'] = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$presenter['id']),'',$UrlWriteEnable);
    $rows_module[$Tp_Page]['data'][$key]['postdate'] = Carbon::parse($presenter['postdate'])->toDateString();

    if ($presenter['price'] != "" || $presenter['spprice'] != "") {
        if (($presenter['inventorynotsale'] == "1" && $presenter['inventory'] <= 0) || $presenter['pricecheck'] == '0') {
        } else {

        }
    } else {


    }

    // 判斷商品所在之層級
    if ($presenter['type1'] != '-1' && $presenter['type2'] != '-1' && $presenter['type3'] != '-1') {
        $level = '2';
    } elseif ($presenter['type1'] != '-1' && $presenter['type2'] != '-1' && $presenter['type3'] == '-1') {
        $level = '1';
    } elseif ($presenter['type1'] != '-1' && $presenter['type2'] == '-1' && $presenter['type3'] == '-1') {
        $level = '0';
    } else {
        $level = '';
    }

    if ($level == '2') {
        if ($presenter['pic'] != "") {
            $rows_module[$Tp_Page]['data'][$key]['link_url'] = $SiteBaseUrl . url_rewrite("product", array('wshop' => $_GET['wshop'], 'lang' => $_SESSION['lang'], 'Opt' => 'detailed', 'type1' => $presenter['type1'], 'type2' => $presenter['type2'], 'type3' => $presenter['type3']), '', $UrlWriteEnable) . $id_params . $presenter['id'];
        } else {
            $rows_module[$Tp_Page]['data'][$key]['link_url'] = '#';
        }
    } elseif ($level == '1') {
        if ($presenter['pic'] != "") {
            $rows_module[$Tp_Page]['data'][$key]['link_url'] = $SiteBaseUrl . url_rewrite("product", array('wshop' => $_GET['wshop'], 'lang' => $_SESSION['lang'], 'Opt' => 'detailed', 'type1' => $presenter['type1'], 'type2' => $presenter['type2']), '', $UrlWriteEnable) . $id_params . $presenter['id'];
        } else {
            $rows_module[$Tp_Page]['data'][$key]['link_url'] = '#';
        }
    } elseif ($level == '0') {
        if ($presenter['pic'] != "") {
            $rows_module[$Tp_Page]['data'][$key]['link_url'] = $SiteBaseUrl . url_rewrite("product", array('wshop' => $_GET['wshop'], 'lang' => $_SESSION['lang'], 'Opt' => 'detailed', 'type1' => $presenter['type1']), '', $UrlWriteEnable) . $id_params . $presenter['id'];
        } else {
            $rows_module[$Tp_Page]['data'][$key]['link_url'] = '#';
        }
    } else {
        if ($presenter['pic'] != "") {
            $rows_module[$Tp_Page]['data'][$key]['link_url'] = $SiteBaseUrl . url_rewrite("product", array('wshop' => $_GET['wshop'], 'lang' => $_SESSION['lang'], 'Opt' => 'detailed'), '', $UrlWriteEnable) . $id_params . $presenter['id'];
        } else {
            $rows_module[$Tp_Page]['data'][$key]['link_url'] = '#';
        }
    }
}

$RecordProduct = $rows_module[$Tp_Page]['data'];

//dd($RecordProduct[0]['productphoto']);
//dd($rows_module[$Tp_Page]);
