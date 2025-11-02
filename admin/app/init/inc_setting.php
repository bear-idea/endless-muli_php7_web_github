<?php

use App\Eloquent\Admin\Admin;
use App\Eloquent\Admin\Setting;
use App\Eloquent\Admin\Setting_fr;
use App\Eloquent\Admin\Setting_otr;
use App\Eloquent\Admin\Tmp;
use App\Eloquent\Admin\Tmpboard;

?>
<?php
//initialize the session
if (!isset($_SESSION)) {
    session_start();
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        global $DB_Conn;
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

if ($request->input('prePage') != '') {
    $prePage = $request->input('prePage');
} else {
    $prePage = @$_SERVER["HTTP_REFERER"];
}

$columns = '*'; // 返回的欄位陣列

$colaccount = "-1";
if (isset($_SESSION['MM_Username'])) {
    $colaccount = $_SESSION['MM_Username'];
}

/**
 * 取得帳號記錄
 *
 * @param string $columns 返回的欄位（預設為所有欄位）
 * @return mixed|null 符合條件的帳號記錄，若無則返回 null
 */
function getAccountRecord($columns = '*')
{
    // 檢查是否設定了使用者會話的使用者名稱，若有則使用該使用者名稱，否則使用 "-1"
    $colaccount = isset($_SESSION['MM_Username']) ? $_SESSION['MM_Username'] : "-1";

    // 查詢資料庫，取得符合條件的帳號記錄
    return Admin::select($columns)
        ->where('account', '=', $colaccount)
        ->first();
}
// 使用函數取得帳號記錄
$row_RecordAccount = getAccountRecord();

$totalRows_RecordAccount = 1;

/**
 * 將主帳戶信息替換為子帳戶信息（如果適用）。
 *
 * @param array $row_RecordAccount 主帳戶信息
 * @return array 替換後的帳戶信息
 */
function replaceWithSubAccount($row_RecordAccount)
{
    // 如果是子帳戶
    if ($row_RecordAccount['grouptype'] == 'sub') {
        // 獲取子帳戶 ID
        $groupid = $row_RecordAccount['groupid'];

        // 查詢子帳戶信息
        $row_RecordSubAccount = Admin::find($groupid);

        // 如果查詢到子帳戶信息，則替換主帳戶信息
        if ($row_RecordSubAccount) {
            // 需要替換的字段
            $fields_to_replace = [
                'id', 'name', 'email', 'webname', 'urlbuilddate', 'webenabledate',
                'webrenewdate', 'usetime', 'urllocalate', 'urlonly', 'urllink',
                'urllink2', 'urlenable', 'hot', 'yhot', 'nhot', 'mhot', 'ymhot',
                'yhotdate', 'plushot'
            ];

            // 替換主帳戶信息中對應的字段值
            foreach ($fields_to_replace as $field) {
                $row_RecordAccount[$field] = $row_RecordSubAccount->$field;
            }
        }
    }

    return $row_RecordAccount;
}

// 使用函數將主帳戶信息替換為子帳戶信息
$row_RecordAccount = replaceWithSubAccount($row_RecordAccount);

/* ----------目前網站---------- */
$_SESSION['wshopforckeditor'] = $wshop = $row_RecordAccount['webname']; // 需先指定變數後面才會讀取到
$_SESSION['w_userid'] = $w_userid = $row_RecordAccount['id'];

/* ----------目前網站---------- */

/**
 * 根據用戶ID查詢 Setting 表的記錄。
 *
 * @param string $columns 查詢的欄位，默認為 '*'
 * @param mixed $userid 用戶ID
 * @return Setting|null 返回查詢到的記錄，或者 null
 */
function getSystemConfigRecord($userid, string $columns = '*')
{
    return Setting::select($columns)
        ->where('userid', '=', $userid)
        ->first();
}

$row_RecordSystemConfig = getSystemConfigRecord($w_userid, $columns);

/**
 * 根據用戶ID查詢 Setting_fr 表的記錄。
 *
 * @param string $columns 查詢的欄位，默認為 '*'
 * @param mixed $userid 用戶ID
 * @return Setting_fr 返回查詢到的記錄，或者 null
 */
function getSystemConfigRecordFr($userid, $columns = '*')
{
    return Setting_fr::select($columns)
        ->where('userid', '=', $userid)
        ->first();
}

$row_RecordSystemConfigFr = getSystemConfigRecordFr($w_userid, $columns);


/**
 * 根據用戶ID查詢 Setting_otr 表的記錄。
 *
 * @param string $columns 查詢的欄位，默認為 '*'
 * @param mixed $userid 用戶ID
 * @return Setting_otr 返回查詢到的記錄，或者 null
 */
function getSystemConfigRecordOtr($userid, string $columns = '*'): Setting_otr
{
    return Setting_otr::select($columns)
        ->where('userid', '=', $userid)
        ->first();
}

$row_RecordSystemConfigOtr = getSystemConfigRecordOtr($w_userid, $columns);


/* --  取得版型 -- */ /* --  判斷目前使用裝置來取得目前使用版型 -- */
if ($row_RecordSystemConfigFr['Mobile_Enable'] == '0') { // 皆使用PC版外觀
    $CKeditor_ini = "pc_board";
    $SQL_MSTmpSelect = "MSTmpSelect";
} else if ($row_RecordSystemConfigFr['Mobile_Enable'] == '2') { // 皆使用行動裝置外觀 (RWD)
    $CKeditor_ini = "mobile_smarty";
    $SQL_MSTmpSelect = "MSTmpSelectRWD";
} else if (isset($browser_t) && ($browser_t == 'smartphone' || $browser_t == 'mobile')) { // 依照瀏覽工具自動判別
    $CKeditor_ini = "mobile_smarty";
    $SQL_MSTmpSelect = "MSTmpSelectRWD";
} else {
    $CKeditor_ini = "pc_board";
    $SQL_MSTmpSelect = "MSTmpSelect";
}

$row_RecordTmpUsedid = Setting_fr::select([$SQL_MSTmpSelect])
    ->where('userid', '=', $w_userid)
    ->first();

$row_RecordTmpConfigGetWidth = Tmp::select(['id', 'name', 'boxwidth', 'tmpwebwidth'])
    ->where('id', '=', $row_RecordTmpUsedid[$SQL_MSTmpSelect])
    ->first();

$row_RecordTmpMiddleBoardGetWidth = Tmpboard::select(['id', 'tmp_l_m_width', 'tmp_r_m_width'])
    ->where('id', '=', $row_RecordTmpUsedid[$SQL_MSTmpSelect])
    ->first();

$totalRows_RecordTmpMiddleBoardGetWidth = 1;

if ($totalRows_RecordTmpMiddleBoardGetWidth == 0) {
    $row_RecordTmpMiddleBoardGetWidth['tmp_l_m_width'] = 0;
    $row_RecordTmpMiddleBoardGetWidth['tmp_r_m_width'] = 0;
}

/* --  取得版型 -- */ /* --  根據目前使用版型來取得取得目前版型寬度 For Ckeditor */
if ($CKeditor_ini == "mobile_smarty" && $row_RecordSystemConfigFr['Mobile_Enable'] == '1') { /* 偵測使用裝置是行動且功能使用自動判斷 (RWD) */
    /*$CKeditor_setwidth = 設定寬度-左側寬度-中間間隔-內容內距-內容外框 */
    if ($row_RecordTmpConfigGetWidth['boxwidth'] == '3') {
        $configboxwidth = 1780;
    } else if ($row_RecordTmpConfigGetWidth['boxwidth'] == '2') {
        $configboxwidth = 1570;
    } else if ($row_RecordTmpConfigGetWidth['boxwidth'] == '1') {
        $configboxwidth = 1360;
    } else {
        $configboxwidth = 1150;
    }

    if ($row_RecordTmpConfigGetWidth['name'] == 'board009') {
        $CKeditor_setwidth = $configboxwidth - 240 - 10 - 6 - $row_RecordTmpMiddleBoardGetWidth['tmp_l_m_width'] - $row_RecordTmpMiddleBoardGetWidth['tmp_r_m_width'];
    } else if ($row_RecordTmpConfigGetWidth['name'] == 'board010') {
        $CKeditor_setwidth = $configboxwidth - $row_RecordTmpMiddleBoardGetWidth['tmp_l_m_width'] - $row_RecordTmpMiddleBoardGetWidth['tmp_r_m_width'];
    }

} else if ($row_RecordSystemConfigFr['Mobile_Enable'] == '2' || $row_RecordTmpConfigGetWidth['name'] == 'board009' || $row_RecordTmpConfigGetWidth['name'] == 'board010') {
    if ($row_RecordTmpConfigGetWidth['boxwidth'] == '3') {
        $configboxwidth = 1780;
    } else if ($row_RecordTmpConfigGetWidth['boxwidth'] == '2') {
        $configboxwidth = 1570;
    } else if ($row_RecordTmpConfigGetWidth['boxwidth'] == '1') {
        $configboxwidth = 1360;
    } else {
        $configboxwidth = 1150;
    }

    if ($row_RecordTmpConfigGetWidth['name'] == 'board009') {
        $CKeditor_setwidth = $configboxwidth - 240 - 10 - 6 - $row_RecordTmpMiddleBoardGetWidth['tmp_l_m_width'] - $row_RecordTmpMiddleBoardGetWidth['tmp_r_m_width'];
    } else if ($row_RecordTmpConfigGetWidth['name'] == 'board010') {
        $CKeditor_setwidth = $configboxwidth - $row_RecordTmpMiddleBoardGetWidth['tmp_l_m_width'] - $row_RecordTmpMiddleBoardGetWidth['tmp_r_m_width'];
    }


} else {
    $coluserid_RecordTmpWrpBoardGetWidth = "-1";
    if (isset($w_userid)) {
        $coluserid_RecordTmpWrpBoardGetWidth = $w_userid;
    }

    $query_RecordTmpWrpBoardGetWidth = sprintf("SELECT name, tmp_l_m_width, tmp_r_m_width FROM demo_tmpboard WHERE id = (SELECT tmpwrpboard FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpWrpBoardGetWidth, "int"));
    $RecordTmpWrpBoardGetWidth = mysqli_query($DB_Conn, $query_RecordTmpWrpBoardGetWidth) or die(mysqli_error($DB_Conn));
    $row_RecordTmpWrpBoardGetWidth = mysqli_fetch_assoc($RecordTmpWrpBoardGetWidth);
    $totalRows_RecordTmpWrpBoardGetWidth = mysqli_num_rows($RecordTmpWrpBoardGetWidth);

    if ($row_RecordTmpConfigGetWidth['name'] == 'board009') {
        $CKeditor_setwidth = $row_RecordTmpConfigGetWidth['tmpwebwidth'] - 220 - $row_RecordTmpWrpBoardGetWidth['tmp_l_m_width'] - $row_RecordTmpWrpBoardGetWidth['tmp_r_m_width'];
    } else {
        $CKeditor_setwidth = $row_RecordTmpConfigGetWidth['tmpwebwidth'] - $row_RecordTmpWrpBoardGetWidth['tmp_l_m_width'] - $row_RecordTmpWrpBoardGetWidth['tmp_r_m_width'];
    }

    mysqli_free_result($RecordTmpWrpBoardGetWidth);
}


/* 平台分類 */
$Shop3500_Limit_Mod = "Shop3500"; // 代表模組限制

// 當無抓取到時則使用預設語系
if ($row_RecordSystemConfig['Defaultlang'] == 'auto') {
    preg_match('/^([a-z\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
    $NowBrowserLang = $matches[1];
    switch ($NowBrowserLang) {
        case 'zh_TW' :
        case 'zh-TW' :
            $defaultlang = "zh_TW";
            break;
        case 'zh-cn' :
        case 'zh-CN' :
            if ($row_RecordSystemConfig['LangChooseZHCN'] == '1') {
                $defaultlang = "zh-cn";
            } else {
                $defaultlang = "zh_TW";
            }
            break;
        case 'jp' :
        case 'JP' :
            if ($row_RecordSystemConfig['LangChooseJP'] == '1') {
                $defaultlang = "jp";
            } else {
                $defaultlang = "zh_TW";
            }
            break;
        case 'kr' :
        case 'KR' :
            if ($row_RecordSystemConfig['LangChooseKR'] == '1') {
                $defaultlang = "kr";
            } else {
                $defaultlang = "zh_TW";
            }
            break;
        case 'sp' :
        case 'SP' :
            if ($row_RecordSystemConfig['LangChooseSP'] == '1') {
                $defaultlang = "sp";
            } else {
                $defaultlang = "zh_TW";
            }
            break;
        default:
            if ($row_RecordSystemConfig['LangChooseEN'] == '1') {
                echo $defaultlang = "en";
            } else {
                $defaultlang = "zh_TW";
            }
            break;
    }
} else if ($row_RecordSystemConfig['Defaultlang'] != '') {
    $defaultlang = $row_RecordSystemConfig['Defaultlang']; // 預設語系
} else {
    $defaultlang = 'zh_TW';
}
if (isset($_GET['lang']) && $_GET['lang'] != '') {
} else {
    $_GET['lang'] = $defaultlang;
}

$UrlWriteEnable = $row_RecordSystemConfigFr['urlwriteenable']; // 網址SEO
if ($UrlWriteEnable == '1') {
    $tag_params = "?tag=";
    $key_params = "?searchkey=";
    $id_params = "?id=";
    $operate_params = "?Operate=";
    $file_params = "?f=";
    $type_params = "?type=";
    $RegMsg_params = "?RegMsg=";
    $errMsg_params = "?errMsg=";
    $id_del_params = "?id_del=";
    $plusid_del_params = "?plusid_del=";
    $page_params = "?page=";
} else {
    $tag_params = "&tag=";
    $key_params = "&searchkey=";
    $id_params = "&id=";
    $operate_params = "&Operate=";
    $file_params = "&f=";
    $type_params = "&type=";
    $RegMsg_params = "&RegMsg=";
    $errMsg_params = "&errMsg=";
    $id_del_params = "&id_del=";
    $plusid_del_params = "&plusid_del=";
    $page_params = "&page=";
}

/* ----------通用功能設定---------- */
date_default_timezone_set('Asia/Taipei'); // 設定時區時間 echo date("Y-m-d H-i-s"); Asia/Taipei  Etc/GMT-8
$SiteName = $row_RecordSystemConfigFr['SiteName']; // 網站名稱
$SiteUrl = $row_RecordSystemConfigFr['SiteUrl']; // 網址
$SiteMail = $row_RecordSystemConfigFr['SiteMail']; // 寄送郵件
$SiteAuthor = $row_RecordSystemConfigFr['SiteAuthor']; // 寄送郵件名稱
$SiteFBShowImage = $row_RecordSystemConfigFr['SiteFBShowImage'];
$SiteFileUrlName = pathinfo($_SERVER['PHP_SELF']); // 網站放置位置 echo $SiteFileUrlName['dirname']
$SiteFileUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . $SiteFileUrlName['dirname']; // 網站放置位置

$defaultlang = $row_RecordSystemConfig['Defaultlang']; // 預設語系
$HighlightSelect = $row_RecordSystemConfig['HighlightSelect']; // 搜索文字提示是否開啟

//$SiteImgUrlAdmin = "../site/"; // 圖片位置路徑 方便多網站多資料夾管理


/* ----------擁有語系選擇設定---------- */
$LangChooseZHTW = $row_RecordSystemConfig['LangChooseZHTW'];
$LangChooseZHCN = $row_RecordSystemConfig['LangChooseZHCN'];
$LangChooseEN = $row_RecordSystemConfig['LangChooseEN'];
$LangChooseJP = $row_RecordSystemConfig['LangChooseJP'];
$LangChooseKR = $row_RecordSystemConfig['LangChooseKR'];
$LangChooseSP = $row_RecordSystemConfig['LangChooseSP'];

/* ----------它網連結---------- */
$FBICONChoose = $row_RecordSystemConfig['FBICONChoose'];
$GOOGLEICONChoose = $row_RecordSystemConfig['GOOGLEICONChoose'];
$PLURKICONChoose = $row_RecordSystemConfig['PLURKICONChoose'];

/* ----------功能連結---------- */
$SITEMAPICONChoose = $row_RecordSystemConfig['SITEMAPICONChoose'];
$RSSICONChoose = $row_RecordSystemConfig['RSSICONChoose'];
$MSNICONChoose = $row_RecordSystemConfig['MSNICONChoose'];
$MAILICONChoose = $row_RecordSystemConfig['MAILICONChoose'];

/* ----------便條功能---------- */
$SiteNoteChoose = $row_RecordSystemConfig['SiteNoteChoose'];

/* ----------網站模式---------- */
$SiteModChoose = $row_RecordSystemConfig['SiteModChoose'];

/* ----------頁數限制---------- */
$Site_DfPage_Limit_Page_Num = $row_RecordSystemConfig['dfpage_limit_page_num']; // 自訂頁面新增頁面限制

/* ----------版面擴充---------- */
$Tmp_Column_Plus_Limit = $row_RecordSystemConfig['tmp_column_plus']; // 網站支援三欄設計

/* ----------模組名稱---------- */

// 以下在會員認證信發送會使用到
$DefaultSiteName = $row_RecordSystemConfigOtr['DefaultSiteName']; //　網站名稱
$DefaultSiteUrl = $row_RecordSystemConfigOtr['DefaultSiteUrl']; // 網站網址
$DefaultSiteMail = $row_RecordSystemConfigOtr['DefaultSiteMail']; // 會員註冊信發送電子郵件
$DefaultSiteMailAuthor = $row_RecordSystemConfigOtr['DefaultSiteMailAuthor']; //會員註冊信發送作者
$DefaultSiteMailSubject = $row_RecordSystemConfigOtr['DefaultSiteMailSubject']; //會員註冊信主旨

/* ----------後台管理功能設定---------- */
/* 最新訊息功能設定 */
$ManageNewsSearchSelect = $row_RecordSystemConfig['ManageNewsSearchSelect']; // 搜索功能是否開啟
$ManageNewsBatchDeleteSelect = $row_RecordSystemConfig['ManageNewsBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageNewsEditorSelect = $row_RecordSystemConfig['ManageNewsEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageNewsListSelect = $row_RecordSystemConfig['ManageNewsListSelect']; // 是否可編輯清單列表

/* 優惠票卷功能設定 */
$ManageCouponsSearchSelect = $row_RecordSystemConfig['ManageCouponsSearchSelect']; // 搜索功能是否開啟
$ManageCouponsBatchDeleteSelect = $row_RecordSystemConfig['ManageCouponsBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageCouponsEditorSelect = $row_RecordSystemConfig['ManageCouponsEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageCouponsListSelect = $row_RecordSystemConfig['ManageCouponsListSelect']; // 是否可編輯清單列表

/* 歷史沿革功能設定 */
$ManageTimelineSearchSelect = '1'; // 搜索功能是否開啟
$ManageTimelineBatchDeleteSelect = '0'; // 是否開啟多筆刪除功能
$ManageTimelineEditorSelect = '0'; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageTimelineListSelect = '1'; // 是否可編輯清單列表

/* 圖片展示功能設定 */
$ManageImageshowSearchSelect = '1'; // 搜索功能是否開啟
$ManageImageshowBatchDeleteSelect = '0'; // 是否開啟多筆刪除功能
$ManageImageshowEditorSelect = '0'; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageImageshowListSelect = '1'; // 是否可編輯清單列表

/* 鄰近景點功能設定 */
$ManageAttractionsSearchSelect = '1'; // 搜索功能是否開啟
$ManageAttractionsBatchDeleteSelect = '0'; // 是否開啟多筆刪除功能
$ManageAttractionsEditorSelect = '0'; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageAttractionsListSelect = '1'; // 是否可編輯清單列表

/* 房型展示功能設定 */
$ManageRoomSearchSelect = '1'; // 搜索功能是否開啟
$ManageRoomBatchDeleteSelect = '0'; // 是否開啟多筆刪除功能
$ManageRoomEditorSelect = '0'; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageRoomListSelect = '1'; // 是否可編輯清單列表

/* 電子期刊功能設定 */
$ManageEPaperSearchSelect = $row_RecordSystemConfig['ManageEPaperSearchSelect']; // 搜索功能是否開啟
$ManageEPaperBatchDeleteSelect = $row_RecordSystemConfig['ManageEPaperBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageEPaperEditorSelect = $row_RecordSystemConfig['ManageEPaperEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageEPaperListSelect = $row_RecordSystemConfig['ManageEPaperListSelect']; // 是否可編輯清單列表

/* 新聞快報功能設定 */
$ManageLettersSearchSelect = $row_RecordSystemConfig['ManageLettersSearchSelect']; // 搜索功能是否開啟
$ManageLettersBatchDeleteSelect = $row_RecordSystemConfig['ManageLettersBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageLettersEditorSelect = $row_RecordSystemConfig['ManageLettersEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageLettersListSelect = $row_RecordSystemConfig['ManageLettersListSelect']; // 是否可編輯清單列表

/* 活動快訊功能設定 */
$ManageActnewsSearchSelect = $row_RecordSystemConfig['ManageActnewsSearchSelect']; // 搜索功能是否開啟
$ManageActnewsBatchDeleteSelect = $row_RecordSystemConfig['ManageActnewsBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageActnewsEditorSelect = $row_RecordSystemConfig['ManageActnewsEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageActnewsListSelect = $row_RecordSystemConfig['ManageActnewsListSelect']; // 是否可編輯清單列表

/* 常見問答功能設定 */
$ManageFaqSearchSelect = $row_RecordSystemConfig['ManageFaqSearchSelect']; // 搜索功能是否開啟
$ManageFaqBatchDeleteSelect = $row_RecordSystemConfig['ManageFaqBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageFaqEditorSelect = $row_RecordSystemConfig['ManageFaqEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageFaqListSelect = $row_RecordSystemConfig['ManageFaqListSelect']; // 是否可編輯清單列表

/* 產品功能設定 */
$ManageProductSearchSelect = $row_RecordSystemConfig['ManageProductSearchSelect']; // 搜索功能是否開啟
$ManageProductBatchDeleteSelect = $row_RecordSystemConfig['ManageProductBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageProducPhotoBatchDeleteSelect = "0"; // 是否開啟多筆刪除功能
$ManageProductEditorSelect = $row_RecordSystemConfig['ManageProductEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageProductListSelect = $row_RecordSystemConfig['ManageProductListSelect']; // 是否可編輯清單列表
$ManageProductPostBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageProductPostEditorSelect = "0"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageProductReplyEditorSelect = "0"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 討論專區功能設定 */
$ManageForumSearchSelect = $row_RecordSystemConfig['ManageForumSearchSelect']; // 搜索功能是否開啟
$ManageForumBatchDeleteSelect = $row_RecordSystemConfig['ManageForumBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageForumEditorSelect = $row_RecordSystemConfig['ManageForumEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageForumListSelect = $row_RecordSystemConfig['ManageForumListSelect']; // 是否可編輯清單列表
$ManageForumPostBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageForumPostEditorSelect = "2"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageForumReplyEditorSelect = "2"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 會議紀錄功能設定 */
$ManageMeetingSearchSelect = $row_RecordSystemConfig['ManageMeetingSearchSelect']; // 搜索功能是否開啟
$ManageMeetingBatchDeleteSelect = $row_RecordSystemConfig['ManageMeetingBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageMeetingEditorSelect = $row_RecordSystemConfig['ManageMeetingEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageMeetingListSelect = $row_RecordSystemConfig['ManageMeetingEditorSelect']; // 是否可編輯清單列表

/* 贊助企業功能設定 */
$ManageSponsorSearchSelect = $row_RecordSystemConfig['ManageSponsorSearchSelect']; // 搜索功能是否開啟
$ManageSponsorBatchDeleteSelect = $row_RecordSystemConfig['ManageSponsorBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageSponsorEditorSelect = $row_RecordSystemConfig['ManageSponsorEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageSponsorListSelect = $row_RecordSystemConfig['ManageSponsorListSelect']; // 是否可編輯清單列表

/* 合作夥伴功能設定 */
$ManagePartnerSearchSelect = $row_RecordSystemConfig['ManagePartnerSearchSelect']; // 搜索功能是否開啟
$ManagePartnerBatchDeleteSelect = $row_RecordSystemConfig['ManagePartnerBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManagePartnerEditorSelect = $row_RecordSystemConfig['ManagePartnerEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManagePartnerListSelect = $row_RecordSystemConfig['ManagePartnerListSelect']; // 是否可編輯清單列表

/* 友站連結功能設定 */
$ManageFrilinkSearchSelect = $row_RecordSystemConfig['ManageFrilinkSearchSelect']; // 搜索功能是否開啟
$ManageFrilinkBatchDeleteSelect = $row_RecordSystemConfig['ManageFrilinkBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageFrilinkEditorSelect = $row_RecordSystemConfig['ManageFrilinkEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageFrilinkListSelect = $row_RecordSystemConfig['ManageFrilinkListSelect']; // 是否可編輯清單列表

/* 模組連結功能設定 */
$ManageModlinkSearchSelect = "1"; // 搜索功能是否開啟
$ManageModlinkBatchDeleteSelect = "0"; // 是否開啟多筆刪除功能
$ManageModlinkEditorSelect = "0"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageModlinkListSelect = "1"; // 是否可編輯清單列表

/* 相關連結功能設定 */
$ManageOtrlinkSearchSelect = $row_RecordSystemConfig['ManageOtrlinkSearchSelect']; // 搜索功能是否開啟
$ManageOtrlinkBatchDeleteSelect = $row_RecordSystemConfig['ManageOtrlinkBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageOtrlinkEditorSelect = $row_RecordSystemConfig['ManageOtrlinkEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageOtrlinkListSelect = $row_RecordSystemConfig['ManageOtrlinkListSelect']; // 是否可編輯清單列表

/* 求職徵才功能設定 */
$ManageCareersSearchSelect = $row_RecordSystemConfig['ManageCareersSearchSelect']; // 搜索功能是否開啟
$ManageCareersBatchDeleteSelect = $row_RecordSystemConfig['ManageCareersBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageCareersEditorSelect = $row_RecordSystemConfig['ManageCareersEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageCareersListSelect = $row_RecordSystemConfig['ManageCareersListSelect']; // 是否可編輯清單列表

/* 公佈資訊功能設定 */
$ManagePublishSearchSelect = $row_RecordSystemConfig['ManagePublishSearchSelect']; // 搜索功能是否開啟
$ManagePublishBatchDeleteSelect = $row_RecordSystemConfig['ManagePublishBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManagePublishEditorSelect = $row_RecordSystemConfig['ManagePublishEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManagePublishListSelect = $row_RecordSystemConfig['ManagePublishListSelect']; // 是否可編輯清單列表

/* 影音共享功能設定 */
$ManageVideoSearchSelect = '1'; // 搜索功能是否開啟
$ManageVideoBatchDeleteSelect = '0'; // 是否開啟多筆刪除功能
$ManageVideoEditorSelect = '0'; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageVideoListSelect = '1'; // 是否可編輯清單列表

/* 留言管理功能設定 */
$ManageGuestbookSearchSelect = $row_RecordSystemConfig['ManageGuestbookSearchSelect']; // 搜索功能是否開啟
$ManageGuestbookMessageBatchDeleteSelect = $row_RecordSystemConfig['ManageGuestbookMessageBatchDeleteSelect']; // 是否開啟多筆刪除留言及回應功能
$ManageGuestbookEditorSelect = $row_RecordSystemConfig['ManageGuestbookEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageGuestbookListSelect = $row_RecordSystemConfig['ManageGuestbookListSelect']; // 是否可編輯清單列表

/* 會員資料功能設定 */
$ManageMemberSearchSelect = $row_RecordSystemConfig['ManageMemberSearchSelect']; // 搜索功能是否開啟
$ManageMemberBatchDeleteSelect = $row_RecordSystemConfig['ManageMemberBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageMemberAvatarSelect = $row_RecordSystemConfig['ManageMemberAvatarSelect']; // 選擇是否包含頭像上傳功能 1:開啟 0:關閉
$ManageMemberMultiAddSelect = $row_RecordSystemConfig['ManageMemberMultiAddSelect'];  //選擇是否開啟csv多筆資料上傳

/* 活動花絮功能設定 */
$ManageActivitiesSearchSelect = $row_RecordSystemConfig['ManageActivitiesSearchSelect']; // 搜索功能是否開啟
$ManageActivitiesAlbumBatchDeleteSelect = $row_RecordSystemConfig['ManageActivitiesAlbumBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageActivitiesEditorSelect = $row_RecordSystemConfig['ManageActivitiesEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageActivitiesListSelect = $row_RecordSystemConfig['ManageActivitiesListSelect']; // 是否可編輯清單列表
$ManageActivitiesMultiPhotoAddSelect = $row_RecordSystemConfig['ManageActivitiesMultiPhotoAddSelect']; // 相片新增方式單筆/多筆 0:單筆 1:多筆

/* 工程實績功能設定 */
$ManageProjectSearchSelect = $row_RecordSystemConfig['ManageProjectSearchSelect']; // 搜索功能是否開啟
$ManageProjectAlbumBatchDeleteSelect = $row_RecordSystemConfig['ManageProjectAlbumBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageProjectEditorSelect = $row_RecordSystemConfig['ManageProjectEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageProjectListSelect = $row_RecordSystemConfig['ManageProjectListSelect']; // 是否可編輯清單列表
$ManageProjectMultiPhotoAddSelect = $row_RecordSystemConfig['ManageProjectMultiPhotoAddSelect']; // 相片新增方式單筆/多筆 0:單筆 1:多筆

/* 相簿展示功能設定 */
$ManageAlbumSearchSelect = $row_RecordSystemConfig['ManageAlbumSearchSelect']; // 搜索功能是否開啟
$ManageAlbumAlbumBatchDeleteSelect = $row_RecordSystemConfig['ManageAlbumAlbumBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageAlbumEditorSelect = $row_RecordSystemConfig['ManageAlbumEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageAlbumListSelect = $row_RecordSystemConfig['ManageAlbumListSelect']; // 是否可編輯清單列表
$ManageAlbumMultiPhotoAddSelect = $row_RecordSystemConfig['ManageAlbumMultiPhotoAddSelect']; // 相片新增方式單筆/多筆 0:單筆 1:多筆

/* 廣告輪播功能設定 */
$ManageAdsSearchSelect = "0"; // 搜索功能是否開啟
$ManageAdsAlbumBatchDeleteSelect = "0"; // 是否開啟多筆刪除功能
$ManageAdsEditorSelect = "0"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageAdsListSelect = "1"; // 是否可編輯清單列表
$ManageAdsMultiPhotoAddSelect = "0"; // 相片新增方式單筆/多筆 0:單筆 1:多筆

/* 捐款名錄功能設定 */
$ManageDonationSearchSelect = $row_RecordSystemConfig['ManageDonationSearchSelect']; // 搜索功能是否開啟
$ManageDonationBatchDeleteSelect = $row_RecordSystemConfig['ManageDonationBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageDonationEditorSelect = $row_RecordSystemConfig['ManageDonationEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageDonationListSelect = $row_RecordSystemConfig['ManageDonationListSelect']; // 是否可編輯清單列表

/* 經營據點功能設定 */
$ManageStrongholdSearchSelect = "1"; // 搜索功能是否開啟
$ManageStrongholdBatchDeleteSelect = "0"; // 是否開啟多筆刪除功能
$ManageStrongholdEditorSelect = "2"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageStrongholdListSelect = "1"; // 是否可編輯清單列表

/* 部落格管理功能設定 */
$ManageBlogSearchSelect = $row_RecordSystemConfig['ManageBlogSearchSelect']; // 搜索功能是否開啟
$ManageBlogBatchDeleteSelect = $row_RecordSystemConfig['ManageBlogBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageBlogEditorSelect = $row_RecordSystemConfig['ManageBlogEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageBlogListSelect = $row_RecordSystemConfig['ManageBlogListSelect']; // 是否可編輯清單列表

/* 文章管理功能設定 */
$ManageArticleSearchSelect = $row_RecordSystemConfig['ManageArticleSearchSelect']; // 搜索功能是否開啟
$ManageArticleBatchDeleteSelect = $row_RecordSystemConfig['ManageArticleBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageArticleEditorSelect = $row_RecordSystemConfig['ManageArticleEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageArticleListSelect = $row_RecordSystemConfig['ManageArticleListSelect']; // 是否可編輯清單列表

/* 自訂頁面功能設定 */
$ManageDfPageSearchSelect = $row_RecordSystemConfig['ManageDfPageSearchSelect']; // 搜索功能是否開啟
$ManageDfPageBatchDeleteSelect = $row_RecordSystemConfig['ManageDfPageBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageDfPageEditorSelect = $row_RecordSystemConfig['ManageDfPageEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageDfPageListSelect = $row_RecordSystemConfig['ManageDfPageListSelect']; // 是否可編輯清單列表

/* 關於我們功能設定 */
$ManageAboutSearchSelect = $row_RecordSystemConfig['ManageAboutSearchSelect']; // 搜索功能是否開啟
$ManageAboutBatchDeleteSelect = $row_RecordSystemConfig['ManageAboutBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageAboutEditorSelect = $row_RecordSystemConfig['ManageAboutEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageAboutListSelect = $row_RecordSystemConfig['ManageAboutListSelect']; // 是否可編輯清單列表

/* 聯絡我們功能設定 */
$ManageContactSearchSelect = $row_RecordSystemConfig['ManageContactSearchSelect']; // 搜索功能是否開啟
$ManageContactBatchDeleteSelect = $row_RecordSystemConfig['ManageContactBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageContactEditorSelect = $row_RecordSystemConfig['ManageContactEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageContactListSelect = $row_RecordSystemConfig['ManageContactListSelect']; // 是否可編輯清單列表

/* 藝文專欄功能設定 */
$ManageArtlistSearchSelect = "1"; // 搜索功能是否開啟
$ManageArtlistBatchDeleteSelect = "0"; // 是否開啟多筆刪除功能
$ManageArtlistEditorSelect = "1"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageArtlistListSelect = "1"; // 是否可編輯清單列表

/* 樣板管理功能設定 */
$ManageTemplateSearchSelect = '1'; // 搜索功能是否開啟
$ManageTemplateBatchDeleteSelect = '1'; // 是否開啟多筆刪除功能
$ManageTemplateEditorSelect = '1'; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯
$ManageTemplateListSelect = '1'; // 是否可編輯清單列表

/* 產品型錄功能設定 */
$ManageCatalogSearchSelect = $row_RecordSystemConfig['ManageCatalogSearchSelect']; // 搜索功能是否開啟
$ManageCatalogBatchDeleteSelect = $row_RecordSystemConfig['ManageCatalogBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageCatalogEditorSelect = $row_RecordSystemConfig['ManageCatalogEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageCatalogListSelect = $row_RecordSystemConfig['ManageCatalogListSelect']; // 是否可編輯清單列表

/* 購物車功能設定 */
$ManageCartSearchSelect = $row_RecordSystemConfig['ManageCartSearchSelect']; // 搜索功能是否開啟
$ManageCartBatchDeleteSelect = $row_RecordSystemConfig['ManageCartBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageCartEditorSelect = $row_RecordSystemConfig['ManageCartEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageCartListSelect = $row_RecordSystemConfig['ManageCartListSelect']; // 是否可編輯清單列表

/* 知識學習功能設定 */
$ManageKnowledgeSearchSelect = $row_RecordSystemConfig['ManageKnowledgeSearchSelect']; // 搜索功能是否開啟
$ManageKnowledgeBatchDeleteSelect = $row_RecordSystemConfig['ManageKnowledgeBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageProducPhotoBatchDeleteSelect = "0"; // 是否開啟多筆刪除功能
$ManageKnowledgeEditorSelect = $row_RecordSystemConfig['ManageKnowledgeEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageKnowledgeListSelect = $row_RecordSystemConfig['ManageKnowledgeListSelect']; // 是否可編輯清單列表
$ManageKnowledgePostBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageKnowledgePostEditorSelect = "0"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageKnowledgeReplyEditorSelect = "0"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 訂票系統功能設定 */
$ManageTicketsSearchSelect = "1"; // 搜索功能是否開啟
$ManageTicketsBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageTicketsListSelect = "1"; // 是否可編輯清單列表

/* 成員幹部功能設定 */
$ManageOrgSearchSelect = $row_RecordSystemConfig['ManageOrgSearchSelect']; // 搜索功能是否開啟
$ManageOrgBatchDeleteSelect = $row_RecordSystemConfig['ManageOrgBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageOrgEditorSelect = $row_RecordSystemConfig['ManageOrgEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageOrgListSelect = $row_RecordSystemConfig['ManageOrgListSelect']; // 是否可編輯清單列表

/* 樣板功能設定 */
$ManageTmpSearchSelect = $row_RecordSystemConfig['ManageTmpSearchSelect']; // 搜索功能是否開啟
$ManageTmpBatchDeleteSelect = $row_RecordSystemConfig['ManageTmpBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageTmpEditorSelect = $row_RecordSystemConfig['ManageTmpEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageTmpListSelect = $row_RecordSystemConfig['ManageTmpListSelect']; // 是否可編輯清單列表

/* 網站資訊功能設定 */
$ManageWebSiteSearchSelect = '1'; // 搜索功能是否開啟
$ManageWebSiteBatchDeleteSelect = '1'; // 是否開啟多筆刪除功能
$ManageWebSiteEditorSelect = '1'; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器
$ManageWebSiteListSelect = '1'; // 是否可編輯清單列

/* 選單維護功能設定 */
$ManageMenuSearchSelect = "1"; // 搜索功能是否開啟
$ManageMenuBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能

/* 管理清單設定 */
$ManageConfigListSelect = "1"; // 是否可編輯清單列表

/* ----------編輯器功能設定------------ */
$editorpath = $row_RecordSystemConfigOtr['Editorpath']; // 設定各頁面編輯器路徑

/* ----------功能啟用設定---------- */
$OptionDfPageSelect = $row_RecordSystemConfig['OptionDfPageSelect']; // 自訂頁面是否啟用
$OptionTmpSelect = $row_RecordSystemConfig['OptionTmpSelect']; // 版型修改是否啟用
$OptionNewsSelect = $row_RecordSystemConfig['OptionNewsSelect']; // 最新訊息是否啟用
$OptionLettersSelect = $row_RecordSystemConfig['OptionLettersSelect']; // 新聞快報是否啟用
$OptionActnewsSelect = $row_RecordSystemConfig['OptionActnewsSelect']; // 活動快訊是否啟用
$OptionFaqSelect = $row_RecordSystemConfig['OptionFaqSelect']; // 常見問答是否啟用
$OptionProductSelect = $row_RecordSystemConfig['OptionProductSelect']; // 產品功能是否啟用
$OptionMeetingSelect = $row_RecordSystemConfig['OptionMeetingSelect']; // 會議紀錄是否啟用
$OptionSponsorSelect = $row_RecordSystemConfig['OptionSponsorSelect']; // 贊助企業是否啟用
$OptionFrilinkSelect = $row_RecordSystemConfig['OptionFrilinkSelect']; // 友站連結是否啟用
$OptionOtrlinkSelect = $row_RecordSystemConfig['OptionOtrlinkSelect']; // 相關連結是否啟用
$OptionCareersSelect = $row_RecordSystemConfig['OptionCareersSelect']; // 求職徵才是否啟用
$OptionPublishSelect = $row_RecordSystemConfig['OptionPublishSelect']; // 公佈資訊是否啟用
$OptionGuestbookSelect = $row_RecordSystemConfig['OptionGuestbookSelect']; // 留言管理是否啟用
$OptionMemberSelect = $row_RecordSystemConfig['OptionMemberSelect']; // 會員資料是否啟用
$OptionActivitiesSelect = $row_RecordSystemConfig['OptionActivitiesSelect']; // 活動花絮是否啟用
$OptionProjectSelect = $row_RecordSystemConfig['OptionProjectSelect']; // 工程實績是否啟用
$OptionAdsSelect = $row_RecordSystemConfig['OptionAdsSelect']; // 廣告輪播是否啟用
$OptionDonationSelect = $row_RecordSystemConfig['OptionDonationSelect']; // 捐款名錄是否啟用
$OptionAboutSelect = $row_RecordSystemConfig['OptionAboutSelect']; // 關於我們是否啟用
$OptionArticleSelect = $row_RecordSystemConfig['OptionArticleSelect']; // 文章管理是否啟用
$OptionDfPageSelect = $row_RecordSystemConfig['OptionDfPageSelect']; // 自訂頁面是否啟用
$OptionAboutSelect = $row_RecordSystemConfig['OptionAboutSelect']; // 關於我們是否啟用
$OptionContactSelect = $row_RecordSystemConfig['OptionContactSelect']; // 聯絡我們是否啟用
$OptionCatalogSelect = $row_RecordSystemConfig['OptionCatalogSelect']; // 產品型錄是否啟用
$OptionKnowledgeSelect = $row_RecordSystemConfig['OptionKnowledgeSelect']; // 知識學習是否啟用
$OptionCartSelect = $row_RecordSystemConfig['OptionCartSelect']; // 購物車功能是否啟用
$OptionTicketsSelect = $row_RecordSystemConfig['OptionTicketsSelect']; // 訂票系統是否啟用
$OptionOrgSelect = $row_RecordSystemConfig['OptionOrgSelect']; // 成員幹部是否啟用
$OptionFileMangSelect = $row_RecordSystemConfig['OptionFileMangSelect']; // 檔案管理是否啟用
$OptionAnalysisSelect = $row_RecordSystemConfig['OptionAnalysisSelect']; // 統計資料是否啟用
$OptionWebSiteSelect = $row_RecordSystemConfig['OptionWebSiteSelect']; // 網站資訊是否啟用
$OptionEPaperSelect = $row_RecordSystemConfig['OptionEPaperSelect']; // 電子期刊是否啟用
$OptionBlogSelect = $row_RecordSystemConfig['OptionBlogSelect']; // 部落格是否啟用
$OptionPicasaSelect = $row_RecordSystemConfig['OptionPicasaSelect']; // 雲端相簿是否啟用
$OptionPartnerSelect = $row_RecordSystemConfig['OptionPartnerSelect']; // 合作夥伴是否啟用
$OptionForumSelect = $row_RecordSystemConfig['OptionForumSelect']; // 討論專區是否啟用
$OptionArtlistSelect = $row_RecordSystemConfig['OptionArtlistSelect']; // 藝文專欄是否啟用
$OptionVideoSelect = $row_RecordSystemConfig['OptionVideoSelect']; // 影片管理是否啟用
$OptionCouponsSelect = $row_RecordSystemConfig['OptionCouponsSelect']; // 優惠票卷是否啟用
$OptionTimelineSelect = $row_RecordSystemConfig['OptionTimelineSelect']; // 歷史沿革是否啟用
$OptionImageshowSelect = $row_RecordSystemConfig['OptionImageshowSelect']; // 圖片展示是否啟用
$OptionAlbumSelect = $row_RecordSystemConfig['OptionAlbumSelect']; // 相簿管理是否啟用
$OptionStrongholdSelect = $row_RecordSystemConfig['OptionStrongholdSelect']; // 經營據點是否啟用
$OptionTmpHomeSelect = $row_RecordSystemConfig['OptionTmpHomeSelect']; // 版型修改首頁是否啟用
$OptionRoomSelect = $row_RecordSystemConfig['OptionRoomSelect']; // 房型展示是否啟用
$OptionAttractionsSelect = $row_RecordSystemConfig['OptionAttractionsSelect']; // 鄰近景點是否啟用
$OptionMobileSelect = $row_RecordSystemConfig['OptionMobileSelect']; // 行動裝置是否啟用
$OptionDealerSelect = $row_RecordSystemConfig['OptionDealerSelect']; // 經銷商資料是否啟用
$OptionSocialChatSelect = $row_RecordSystemConfig['OptionSocialChatSelect']; // 社群聊天是否啟用
$OptionBookingSelect = $row_RecordSystemConfig['OptionBookingSelect']; // 預約系統是否啟用

/* ----------地磅系統啟用設定---------- */
$OptionScaleSourceSelect = $row_RecordSystemConfig['OptionScaleSourceSelect']; // 貨源管理是否啟用
$OptionSplitOrderSelect = $row_RecordSystemConfig['OptionSplitOrderSelect']; // 物料拆分是否啟用
$OptionScaleClearanceSelect = $row_RecordSystemConfig['OptionScaleClearanceSelect']; // 清運明細是否啟用

/* --以下未有功能--*/
$OptionMailSendSelect = $row_RecordSystemConfig['OptionMailSendSelect']; // 郵件發送是否啟用
$OptionADWallSelect = $row_RecordSystemConfig['OptionADWallSelect']; // 廣告發布是否啟用
$OptionDailySelect = $row_RecordSystemConfig['OptionDailySelect']; // 主題日誌是否啟用
$OptionCalendarSelect = $row_RecordSystemConfig['OptionCalendarSelect']; // 年度行事是否啟用
$OptionMenuMaintainSelect = $row_RecordSystemConfig['OptionMenuMaintainSelect']; // 選單維護是否啟用

/* ----------前台功能選擇---------- */
// 主版面
$MSHome = $row_RecordSystemConfigFr['MSHome']; // 初始頁
$MSTMP = $row_RecordSystemConfigFr['MSTMP']; // 版型
// 主選單
$MSMenu = $row_RecordSystemConfigFr['MSMenu'];
// 最新訊息
$MSNews = $row_RecordSystemConfigFr['MSNews']; // 版面
$MSNewsShare = $row_RecordSystemConfigFr['MSNewsShare']; // 分享連結
$MSNewsRadom = $row_RecordSystemConfigFr['MSNewsRadom']; // 隨機文章
$MSNewsPNPage = $row_RecordSystemConfigFr['MSNewsPNPage']; // 上下頁連結
$MSNewsGood = $row_RecordSystemConfigFr['MSNewsGood']; // FB案讚
$MSNewsQA = $row_RecordSystemConfigFr['MSNewsQA']; // 問答紀錄
$MSNewsNLink = $row_RecordSystemConfigFr['MSNewsNLink']; // 左選單連結
// 問答紀錄
$MSFaq = $row_RecordSystemConfigFr['MSFaq'];
// 產品資訊
$MSProduct = $row_RecordSystemConfigFr['MSProduct']; // 主版面
$MSProductContent = $row_RecordSystemConfigFr['MSProductContent']; // 內容版面
//$MSProductMutiContent = $row_RecordSystemConfigFr['MSProductMutiContent']; // 細部資料功能
$MSProductMutiContent = 1; // 細部資料功能
//$MSProductMutiPic = $row_RecordSystemConfigFr['MSProductMutiPic']; // 產品多圖
$MSProductMutiPic = 1; // 產品多圖
$MSProductQA = $row_RecordSystemConfigFr['MSProductQA']; // 問答紀錄
$MSProductPlus = $row_RecordSystemConfigFr['MSProductPlus']; // 加購
$MSProductShare = $row_RecordSystemConfigFr['MSProductShare']; // 分享連結
$MSProductStar = $row_RecordSystemConfigFr['MSProductStar']; // 星級評分
$MSProductCart = $row_RecordSystemConfigFr['MSProductCart']; // 購物功能
$MSProductHot = $row_RecordSystemConfigFr['MSProductHot']; // 人氣選單

$cartpricecheck = $row_RecordSystemConfigOtr['cartpricecheck']; // 價格審核

// Google Map API
$GoogleMapAPICode1 = $row_RecordSystemConfigFr['GoogleMapAPICode1']; // GoogleMap
$GoogleMapAPICode2 = $row_RecordSystemConfigFr['GoogleMapAPICode2']; // GoogleMap
$GoogleMapAPITime1 = $row_RecordSystemConfigFr['GoogleMapAPITime1']; // GoogleMap
$GoogleMapAPITime2 = $row_RecordSystemConfigFr['GoogleMapAPITime2']; // GoogleMap

$GoogleMapAPICode = $GoogleMapAPICode1;
if (date("H") > $GoogleMapAPITime1 && $GoogleMapAPICode2 != "" && $GoogleMapAPITime1 != "") {
    $GoogleMapAPICode = $GoogleMapAPICode2;
}

// 頁面js讀取預設值
$js_datatables = false; // 是否使用 Datatables js
$js_datatables_push_value = ''; // Datatables js 帶入預設值

$js_ckeditor = 'disabled'; // 是否使用 Ckeditor js

?>
