<?php
namespace App\Repositories;
use App\Eloquent\Contactitem;
use App\Eloquent\Setting_fr;

$maxRows[$Tp_Page] = $perPage = 1; // 每頁幾筆
$columns = ['id','userid','SiteMail','SiteMail_cn','SiteMail_en','SiteMail_jp','SiteMail_kr','SiteMail_sp','SiteAuthor','SiteAuthor_cn','SiteAuthor_en','SiteAuthor_jp','SiteAuthor_kr','SiteAuthor_sp','SiteSName','SiteSName_cn','SiteSName_en','SiteSName_jp','SiteSName_kr','SiteSName_sp','SitePhone','SitePhone_cn','SitePhone_en','SitePhone_jp','SitePhone_kr','SitePhone_sp','SiteCell','SiteCell_cn','SiteCell_en','SiteCell_jp','SiteCell_kr','SiteCell_sp','SiteFax','SiteFax_cn','SiteFax_en','SiteFax_jp','SiteFax_kr','SiteFax_sp','SiteAddr','SiteAddr_cn','SiteAddr_en','SiteAddr_jp','SiteAddr_kr','SiteAddr_sp','SiteAddrX','SiteAddrX_cn','SiteAddrX_en','SiteAddrX_jp','SiteAddrX_kr','SiteAddrX_sp','SiteAddrY','SiteAddrY_cn','SiteAddrY_en','SiteAddrY_sp','SiteAddrY_kr','SiteAddrY_sp','contacttitle','contacttitle_cn','contacttitle_en','contacttitle_jp','contacttitle_kr','contacttitle_sp','contacttitleindicate','googlemapindicate','formindicate','contactdesc','contactcontent','contactcontent_cn','contactcontent_en','contactcontent_jp','contactcontent_kr','contactcontent_sp']; // 返回的欄位陣列
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

$rows_module[$Tp_Page] = Setting_fr::select($columns)
  ->where('userid', '=', $coluserid[$Tp_Page])
  ->first()
  ->toArray();

$rows_moduleCount[$Tp_Page] = 1; // 目前筆數

$row_RecordContactMail = $RecordContactMail = $rows_module[$Tp_Page];

$RecordContactListType = Contactitem::select(['*'])
    ->where('lang', '=', $collang[$Tp_Page])
    ->where('list_id', '=', '1')
    ->where('indicate', '=', '1')
    ->where('userid', '=', $coluserid[$Tp_Page])
    ->get()
    ->toArray();

//dd($RecordContactListType);

switch($_SESSION['lang'])
{
    case "zh-tw":
        if($row_RecordContactMail['SiteAddr'] == "") // 當地址欄留空 強制隱藏地圖功能
        {
            $row_RecordContactMail['googlemapindicate'] = '0';
        }
        break;
    case "zh-cn":
        if($row_RecordContactMail['SiteAddr_cn'] == "") // 當地址欄留空 強制隱藏地圖功能
        {
            $row_RecordContactMail['googlemapindicate'] = '0';
        }
        $row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_cn'];
        $row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_cn'];
        $row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_cn'];
        $row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_cn'];
        $row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_cn'];
        $row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_cn'];
        $row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_cn'];
        break;
    case "en":
        if($row_RecordContactMail['SiteAddr_en'] == "") // 當地址欄留空 強制隱藏地圖功能
        {
            $row_RecordContactMail['googlemapindicate'] = '0';
        }
        $row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_en'];
        $row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_en'];
        $row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_en'];
        $row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_en'];
        $row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_en'];
        $row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_en'];
        $row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_en'];
        break;
    case "jp":
        if($row_RecordContactMail['SiteAddr_jp'] == "") // 當地址欄留空 強制隱藏地圖功能
        {
            $row_RecordContactMail['googlemapindicate'] = '0';
        }
        $row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_jp'];
        $row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_jp'];
        $row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_jp'];
        $row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_jp'];
        $row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_jp'];
        $row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_jp'];
        $row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_jp'];
        break;
    case "kr":
        if($row_RecordContactMail['SiteAddr_kr'] == "") // 當地址欄留空 強制隱藏地圖功能
        {
            $row_RecordContactMail['googlemapindicate'] = '0';
        }
        $row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_kr'];
        $row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_kr'];
        $row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_kr'];
        $row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_kr'];
        $row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_kr'];
        $row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_kr'];
        $row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_kr'];
        break;
    case "sp":
        if($row_RecordContactMail['SiteAddr_sp'] == "") // 當地址欄留空 強制隱藏地圖功能
        {
            $row_RecordContactMail['googlemapindicate'] = '0';
        }
        $row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_sp'];
        $row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_sp'];
        $row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_sp'];
        $row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_sp'];
        $row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_sp'];
        $row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_sp'];
        $row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_sp'];
        break;
    default:
        break;
}

//dd($RecordContactMail);
?>