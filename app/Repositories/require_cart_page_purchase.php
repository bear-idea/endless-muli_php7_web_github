<?php
namespace App\Repositories;

use App\Eloquent\Cart;
use App\Eloquent\Cartitem;
use App\Eloquent\Cartorder;

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

$colUserAccessuniqid[$Tp_Page] = "-1";
if (isset($_SESSION['UserAccess'])) {
  $colUserAccessuniqid[$Tp_Page] = $_SESSION['UserAccess'];
}

$colmemberid[$Tp_Page] = "-1";
if (isset($row_RecordMember['id'])) {
  $colmemberid[$Tp_Page] = $row_RecordMember['id'];
}

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

if($totalRows_RecordMember > 0) 
{
	/* 取得購物車清單 有會員 */
  $rows_module[$Tp_Page] = Cart::select($columns)
  ->where('lang', '=', $collang[$Tp_Page])
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->where('memberid', '=', $colmemberid[$Tp_Page])
  ->get()
  ->toArray();

  $totalRows_RecordCartlist = $rows_moduleCount[$Tp_Page] = count($rows_module[$Tp_Page]); // 目前筆數
  $RecordCartlist = $rows_module[$Tp_Page];

}else{
	/* 取得購物車清單 無會員 */
	$rows_module[$Tp_Page] = Cart::select($columns)
  ->where('lang', '=', $collang[$Tp_Page])
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->where('UserAccessuniqid', '=', $colUserAccessuniqid[$Tp_Page])
  ->get()
  ->toArray();

  $totalRows_RecordCartlist = $rows_moduleCount[$Tp_Page] = count($rows_module[$Tp_Page]); // 目前筆數
  $RecordCartlist = $rows_module[$Tp_Page];

}

if(!isset($_SESSION['OrderID'])){
    $_SESSION['OrderID'] = date("Ymd") . rand(100000,999999);
}

do
{
	if(isset($ordercount) && $ordercount == 1)
	{
		$_SESSION['OrderID'] = date("Ymd") . rand(100000,999999);  
	}
	$coloserial = "-1";
	if (isset($_SESSION['OrderID'])) {
	$coloserial = $_SESSION['OrderID'];
	}

    $totalRows_RecordCartOrder = Cartorder::select($columns)
        ->where('oserial', '=', $coloserial)
        ->count();

	$ordercount = 1;

}while($totalRows_RecordCartOrder > 0)
?>