<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfig = "SELECT * FROM demo_setting WHERE id = 1";
$RecordSystemConfig = mysqli_query($DB_Conn, $query_RecordSystemConfig) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfig = mysqli_fetch_assoc($RecordSystemConfig);
$totalRows_RecordSystemConfig = mysqli_num_rows($RecordSystemConfig);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfigFr = "SELECT * FROM demo_setting_fr WHERE id = 1";
$RecordSystemConfigFr = mysqli_query($DB_Conn, $query_RecordSystemConfigFr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigFr = mysqli_fetch_assoc($RecordSystemConfigFr);
$totalRows_RecordSystemConfigFr = mysqli_num_rows($RecordSystemConfigFr);
 
/* ----------通用功能設定---------- */
date_default_timezone_set('Asia/Taipei'); // 設定時區時間 echo date("Y-m-d H-i-s"); Asia/Taipei  Etc/GMT-8

$defaultlang = $row_RecordSystemConfig['Defaultlang']; // 預設語系
$HighlightSelect = $row_RecordSystemConfig['HighlightSelect']; // 搜索文字提示是否開啟

// 以下在會員認證信發送會使用到
$DefaultSiteName = "Fullvision"; //　網站名稱
$DefaultSiteUrl = "localhost/sample/"; // 網站網址
$DefaultSiteMail = "admin@mail.com"; // 會員註冊信發送電子郵件
$DefaultSiteMailAuthor = "富視網管理團隊"; //會員註冊信發送作者
$DefaultSiteMailSubject = "網站註冊通知"; //會員註冊信主旨

/* ----------前台功能設定---------- */
/* 最新訊息功能設定 */
$NewsSearchSelect = $row_RecordSystemConfigFr['NewsSearchSelect']; // 搜索功能是否開啟

/* 公佈資訊功能設定 */
$PublishSearchSelect = $row_RecordSystemConfigFr['PublishSearchSelect']; // 搜索功能是否開啟
$Publish_Behavior = $row_RecordSystemConfigFr['Publish_Behavior']; // 設定跑馬燈滑動方式　不斷的由右循環至左／SCROLL、不斷的在左、右之間來回／ALTERNATE 以及 共有：由右滑動至左（一次）／SLIDE 這三種方式
$Publish_Direction = $row_RecordSystemConfigFr['Publish_Direction']; // 設定往上／UP、往下／DOWN、往左／LEFT 以及 往右／RIGHT 這四個方向
$Publish_Scrollamount = $row_RecordSystemConfigFr['Publish_Scrollamount']; // 設定跑馬燈移動距離（移動速度）

/* 留言管理功能設定 */
$GuestbookCaptchaSelect = $row_RecordSystemConfigFr['GuestbookCaptchaSelect']; // 是否啟用認證碼

/* 會員資訊功能設定 */
$MemberSearchSelect = $row_RecordSystemConfigFr['MemberSearchSelect']; // 搜索功能是否開啟
$MemberSeeAuthSelect = $row_RecordSystemConfigFr['MemberSeeAuthSelect']; // 會員一覽是否開放非認證會員可以觀看
$MemberMailAuthSead = $row_RecordSystemConfigFr['MemberMailAuthSead']; // 是否在註冊完後會發送認證信（若上一項設為未開放的話請將此項設為1，或者管理員自行在後台手動開放要開放會員）
$MemberRegSelect = $row_RecordSystemConfigFr['MemberRegSelect']; // 註冊功能是否開啟

/* ----------後台管理功能設定---------- */
/* 最新訊息功能設定 */
$ManageNewsSearchSelect = $row_RecordSystemConfig['ManageNewsSearchSelect']; // 搜索功能是否開啟
$ManageNewsBatchDeleteSelect = $row_RecordSystemConfig['ManageNewsBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageNewsEditorSelect = $row_RecordSystemConfig['ManageNewsEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 產品型錄功能設定 */
$ManageCatalogSearchSelect = '1'; // 搜索功能是否開啟
$ManageCatalogBatchDeleteSelect = '1'; // 是否開啟多筆刪除功能
$ManageCatalogEditorSelect = '2'; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 產品功能設定 */
$ManageProductSearchSelect = $row_RecordSystemConfig['ManageProductSearchSelect']; // 搜索功能是否開啟
$ManageProductBatchDeleteSelect = $row_RecordSystemConfig['ManageProductBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageProductEditorSelect = $row_RecordSystemConfig['ManageProductEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 會議紀錄功能設定 */
$ManageMeetingSearchSelect = $row_RecordSystemConfig['ManageMeetingSearchSelect']; // 搜索功能是否開啟
$ManageMeetingBatchDeleteSelect = $row_RecordSystemConfig['ManageMeetingBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageMeetingEditorSelect = $row_RecordSystemConfig['ManageMeetingEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 贊助企業功能設定 */
$ManageSponsorSearchSelect = $row_RecordSystemConfig['ManageSponsorSearchSelect']; // 搜索功能是否開啟
$ManageSponsorBatchDeleteSelect = $row_RecordSystemConfig['ManageSponsorBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageSponsorEditorSelect = $row_RecordSystemConfig['ManageSponsorEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器  
  

/* 求職徵才功能設定 */
$ManageCareersSearchSelect = $row_RecordSystemConfig['ManageCareersSearchSelect']; // 搜索功能是否開啟
$ManageCareersBatchDeleteSelect = $row_RecordSystemConfig['ManageCareersBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageCareersEditorSelect = $row_RecordSystemConfig['ManageCareersEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器 

/* 公佈資訊功能設定 */
$ManagePublishSearchSelect = $row_RecordSystemConfig['ManagePublishSearchSelect']; // 搜索功能是否開啟
$ManagePublishBatchDeleteSelect = $row_RecordSystemConfig['ManagePublishBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManagePublishEditorSelect = $row_RecordSystemConfig['ManagePublishEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯

/* 留言管理功能設定 */
$ManageGuestbookSearchSelect = $row_RecordSystemConfig['ManageGuestbookSearchSelect']; // 搜索功能是否開啟
$ManageGuestbookMessageBatchDeleteSelect = $row_RecordSystemConfig['ManageGuestbookMessageBatchDeleteSelect'] ; // 是否開啟多筆刪除留言及回應功能
$ManageGuestbookEditorSelect = $row_RecordSystemConfig['ManageGuestbookEditorSelect']; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯

/* 會員資料功能設定 */
$ManageMemberSearchSelect = $row_RecordSystemConfig['ManageMemberSearchSelect']; // 搜索功能是否開啟
$ManageMemberBatchDeleteSelect = $row_RecordSystemConfig['ManageMemberBatchDeleteSelect']; // 是否開啟多筆刪除功能
$ManageMemberAvatarSelect = $row_RecordSystemConfig['ManageMemberAvatarSelect']; // 選擇是否包含頭像上傳功能 1:開啟 0:關閉

/* ----------編輯器功能設定------------ */ 
$editorpath = "/sample/fckeditor/"; // 設定各頁面編輯器路徑

mysqli_free_result($RecordSystemConfig);

mysqli_free_result($RecordSystemConfigFr);
?>
