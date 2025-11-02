<?php
namespace App\Repositories;

use App\Eloquent\Cartitem;
use App\Eloquent\Product;
use App\Eloquent\Productdiscount;
use Carbon\Carbon;

$columns = '*'; // 返回的欄位陣列

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

$rows_module[$Tp_Page] = Product::select($columns)
  ->where('lang', '=', $collang[$Tp_Page])
  ->where('id', '=', $colid[$Tp_Page])
  ->where('indicate', '=', '1')
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->with('productformat')
  ->withCount('productformat')
  ->with('productphoto')
  ->withCount('productphoto')
  ->with(['productpost' => function($query) {
          $query->with('productreply');
        }])
  ->withCount('productpost')
  //->with('productreply')
  ->first()
  ->toArray();

$RecordProduct = $rows_module[$Tp_Page];

foreach ($RecordProduct['productpost'] as $key => $productpost) {
    $RecordProduct['productpost'][$key]['postdate'] = Carbon::parse($productpost['postdate'])->format('Y-m-d g:i A');
    foreach ($productpost['productreply'] as $key2 => $productreply) {
      $RecordProduct['productpost'][$key]['productreply'][$key2]['postdate'] = Carbon::parse($productreply['postdate'])->format('Y-m-d g:i A');
    }
}

$row_RecordProduct = $RecordProduct;



switch ($row_RecordProduct['discounttype']) {
  case "0":
    $row_RecordProduct['discounttype'] = "滿件折扣";
      break;
  case "1":
    $row_RecordProduct['discounttype'] = "滿件減價";
      break;
  case "2":
    $row_RecordProduct['discounttype'] = "滿額折扣";
      break;
  case "3":
    $row_RecordProduct['discounttype'] = "滿額減價";
      break;
  case "4":
    $row_RecordProduct['discounttype'] = "任選優惠";
      break;
  default:
      break;
}

if ($OptionCartSelect == '1' && $row_RecordProduct['pricecheck'] == '1') { // 購物功能
  
  $RecordCartListFreight = Cartitem::select($columns)
      ->where('lang', '=', $collang[$Tp_Page])
      ->where('list_id', '=', '1')
      ->where('indicate', '=', '1')
      ->where('userid', '=', $coluserid[$Tp_Page])
      ->get()
      ->toArray();

      $totalRows_RecordCartListFreight = count($RecordCartListFreight);
	
    
    $RecordCartListPayment = Cartitem::select($columns)
      ->where('lang', '=', $collang[$Tp_Page])
      ->where('list_id', '=', '3')
      ->where('indicate', '=', '1')
      ->where('userid', '=', $coluserid[$Tp_Page])
      ->get()
      ->toArray();

      $totalRows_RecordCartListPayment = count($RecordCartListPayment);


    $RecordDiscountShow = Productdiscount::select($columns)
      ->where('lang', '=', $collang[$Tp_Page])
      ->where('id', '=', $row_RecordProduct['discountid'])
      ->where('indicate', '=', '1')
      ->where('userid', '=', $coluserid[$Tp_Page])
      ->where(function ($query) {
          $query->whereRaw("DATEDIFF(enddate, '" . Carbon::now() . "')  >= 0")
                ->orWhere('limitdate', '=', '0');
      })
      ->get()
      ->toArray();

      $row_RecordDiscountShow = $RecordDiscountShow;

      $totalRows_RecordDiscountShow = count($RecordDiscountShow);


      $RecordDiscountGetType5 = Productdiscount::select($columns)
      ->where('lang', '=', $collang[$Tp_Page])
      ->where('type', '=', '5')
      ->where('indicate', '=', '1')
      ->where('userid', '=', $coluserid[$Tp_Page])
      ->where(function ($query) {
          $query->whereRaw("DATEDIFF(enddate, '" . Carbon::now() . "')  >= 0")
                ->orWhere('limitdate', '=', '0');
      })
      ->get()
      ->toArray();
      
	$totalRows_RecordDiscountGetType5 = count($RecordDiscountGetType5);

  $RecordDiscountGetType6 = Productdiscount::select($columns)
      ->where('lang', '=', $collang[$Tp_Page])
      ->where('type', '=', '6')
      ->where('indicate', '=', '1')
      ->where('userid', '=', $coluserid[$Tp_Page])
      ->where(function ($query) {
          $query->whereRaw("DATEDIFF(enddate, '" . Carbon::now() . "')  >= 0")
                ->orWhere('limitdate', '=', '0');
      })
      ->get()
      ->toArray();
      
	$totalRows_RecordDiscountGetType6 = count($RecordDiscountGetType6);
	
	$RecordDiscountGetType7 = Productdiscount::select($columns)
      ->where('lang', '=', $collang[$Tp_Page])
      ->where('type', '=', '7')
      ->where('indicate', '=', '1')
      ->where('userid', '=', $coluserid[$Tp_Page])
      ->where(function ($query) {
          $query->whereRaw("DATEDIFF(enddate, '" . Carbon::now() . "')  >= 0")
                ->orWhere('limitdate', '=', '0');
      })
      ->get()
      ->toArray();
      
	$totalRows_RecordDiscountGetType7 = count($RecordDiscountGetType7);


    Product::where('id', '=', $colid[$Tp_Page])
      ->increment('visit', 1);

    $rows_moduleCount[$Tp_Page] = 1;


    //dd($row_RecordProduct);
}