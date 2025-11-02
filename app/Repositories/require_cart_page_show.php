<?php
namespace App\Repositories;

use App\Eloquent\Cart;
use App\Eloquent\Productdiscount;
use Carbon\Carbon;

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

// 24小時刪除資料 - 未註冊購物車
mysqli_query($DB_Conn, "DELETE FROM demo_cart WHERE memberid IS NULL && postdate<SUBTIME(NOW(),'0 24:0:0')"); // 24小時刪除資料

// 刪除資料
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
    Cart::destroy($_GET['id_del']);
}

// 修改商品的數量

//$input = Request::only('username', 'password');

if ($request->has('MM_update') && ($request->MM_update == "form_Discount")) {

    //dd($request->id);

    //$update = Cart::find($id);

    foreach($request->id as $key => $value){
        $update = Cart::find($request->id[$key]);
        $update->update([
            'quantity' => $request->Modify[$key],
            'notes1' => $request->notes1[$key]
        ]);
        $update->save();
    }

}

if ($totalRows_RecordMember > 0) {
    /* 取得購物車清單 有會員 */
    $rows_module[$Tp_Page] = Cart::select($columns)
        ->where('lang', '=', $collang[$Tp_Page])
        ->where('userid', '=', $coluserid[$Tp_Page])
        ->where('memberid', '=', $colmemberid[$Tp_Page])
        ->get()
        ->toArray();

    $totalRows_RecordCartlist = $rows_moduleCount[$Tp_Page] = count($rows_module[$Tp_Page]); // 目前筆數
    $RecordCartlist = $rows_module[$Tp_Page];

    $RecordCartlistShowDiscountid = Cart::groupBy('discountid')
        ->selectRaw("SUM(price) * SUM(quantity) as DiscountProductPrice")
        ->selectRaw("SUM(quantity) as totalDiscountCountQuantity")
        ->where('lang', '=', $collang[$Tp_Page])
        ->where('userid', '=', $coluserid[$Tp_Page])
        ->where('memberid', '=', $colmemberid[$Tp_Page])
        ->whereNotNull('discountid')
        ->get()
        ->toArray();

} else {
    /* 取得購物車清單 無會員 */
    $rows_module[$Tp_Page] = Cart::select($columns)
        ->where('lang', '=', $collang[$Tp_Page])
        ->where('userid', '=', $coluserid[$Tp_Page])
        ->where('UserAccessuniqid', '=', $colUserAccessuniqid[$Tp_Page])
        ->get()
        ->toArray();

    $totalRows_RecordCartlist = $rows_moduleCount[$Tp_Page] = count($rows_module[$Tp_Page]); // 目前筆數
    $RecordCartlist = $rows_module[$Tp_Page];


    $RecordCartlistShowDiscountid = Cart::groupBy('discountid')
        ->selectRaw("SUM(price) * SUM(quantity) as DiscountProductPrice")
        ->selectRaw("SUM(quantity) as totalDiscountCountQuantity")
        ->where('lang', '=', $collang[$Tp_Page])
        ->where('userid', '=', $coluserid[$Tp_Page])
        ->where('UserAccessuniqid', '=', $colUserAccessuniqid[$Tp_Page])
        ->whereNotNull('discountid')
        ->get()
        ->toArray();

}

//dd($RecordCartlistShowDiscountid);

$getDiscountid = array_filter(array_unique(array_column($rows_module[$Tp_Page], 'discountid')));

$RecordDiscountShowTest = Productdiscount::select($columns)
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

//dd($RecordDiscountShowTest);

foreach ($rows_module[$Tp_Page] as $key => $presenter) {
    // 取得折扣資料
    $presenter['discount_count'] = 0; // 折扣歸0
    $rows_module[$Tp_Page][$key]['discount_count'] = 0;

    foreach ($RecordDiscountShowTest as $key2 => $row_RecordDiscountShowTest) {
        //if ($row_RecordDiscountShowTest['type'] != '' && $row_RecordCartlist['price'] != '' && $row_RecordCartlist['discount_count'] > 0) { /* 判斷是否有折扣活動 */
        if ($presenter['discountid'] == $row_RecordDiscountShowTest['id']) {
            $presenter['discount_count']++;
            $rows_module[$Tp_Page][$key]['discount_count'] = $presenter['discount_count'];
            $rows_module[$Tp_Page][$key]['discount'][$key2]['name'] = $row_RecordDiscountShowTest['name']; // 折扣名稱
            $rows_module[$Tp_Page][$key]['discount'][$key2]['id'] = $row_RecordDiscountShowTest['id']; // 折扣主鍵
            $rows_module[$Tp_Page][$key]['discount'][$key2]['type'] = $row_RecordDiscountShowTest['type']; // 折扣分類
            $rows_module[$Tp_Page][$key]['discount'][$key2]['discountPieces'] = $row_RecordDiscountShowTest['discountPieces'];
            $rows_module[$Tp_Page][$key]['discount'][$key2]['discountFoldnumber'] = $row_RecordDiscountShowTest['discountFoldnumber'];
            $rows_module[$Tp_Page][$key]['discount'][$key2]['discountFullamount'] = $row_RecordDiscountShowTest['discountFullamount'];
            $rows_module[$Tp_Page][$key]['discount'][$key2]['discountNowfold'] = $row_RecordDiscountShowTest['discountNowfold'];
            $rows_module[$Tp_Page][$key]['discount'][$key2]['discountGiftID'] = $row_RecordDiscountShowTest['discountGiftID'];
            $rows_module[$Tp_Page][$key]['discount'][$key2]['startdate'] = $row_RecordDiscountShowTest['startdate'];
            $rows_module[$Tp_Page][$key]['discount'][$key2]['enddate'] = $row_RecordDiscountShowTest['enddate'];

        }
    }
}

$RecordCartlist = $rows_module[$Tp_Page];

//dd($RecordCartlist);


//paginate($perPage, $columns, $pageName, $currentPage);

// 重新修改值
// foreach ($row_data[$Tp_Page] as $cart) {

// }
?>