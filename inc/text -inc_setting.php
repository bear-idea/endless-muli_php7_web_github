<?php 
/* ----------通用功能設定---------- */
date_default_timezone_set('Asia/Taipei'); // 設定時區時間 echo date("Y-m-d H-i-s"); Asia/Taipei  Etc/GMT-8

$defaultlang = "zh-tw"; // 預設語系
$HighlightSelect = "1"; // 搜索文字提示是否開啟

// 以下在會員認證信發送會使用到
$DefaultSiteName = "Fullvision"; //　網站名稱
$DefaultSiteUrl = "localhost/sample/"; // 網站網址
$DefaultSiteMail = "admin@mail.com"; // 會員註冊信發送電子郵件
$DefaultSiteMailAuthor = "富視網管理團隊"; //會員註冊信發送作者
$DefaultSiteMailSubject = "網站註冊通知"; //會員註冊信主旨

/* ----------前台功能設定---------- */
/* 最新訊息功能設定 */
$NewsSearchSelect = "1"; // 搜索功能是否開啟

/* 公佈資訊功能設定 */
$PublishSearchSelect = "1"; // 搜索功能是否開啟
$Publish_Behavior = "SCROLL"; // 設定跑馬燈滑動方式　不斷的由右循環至左／SCROLL、不斷的在左、右之間來回／ALTERNATE 以及 共有：由右滑動至左（一次）／SLIDE 這三種方式
$Publish_Direction = "LEFT"; // 設定往上／UP、往下／DOWN、往左／LEFT 以及 往右／RIGHT 這四個方向
$Publish_Scrollamount = "3"; // 設定跑馬燈移動距離（移動速度）

/* 留言管理功能設定 */
$GuestbookCaptchaSelect = "1"; // 是否啟用認證碼

/* 會員資訊功能設定 */
$MemberSearchSelect = "1"; // 搜索功能是否開啟
$MemberSeeAuthSelect = "1"; // 會員一覽是否開放非認證會員可以觀看
$MemberMailAuthSead = "0"; // 是否在註冊完後會發送認證信（若上一項設為未開放的話請將此項設為1，或者管理員自行在後台手動開放要開放會員）
$MemberRegSelect = "1"; // 註冊功能是否開啟

/* ----------後台管理功能設定---------- */
/* 最新訊息功能設定 */
$ManageNewsSearchSelect = "1"; // 搜索功能是否開啟
$ManageNewsBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageNewsEditorSelect = "1"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 產品功能設定 */
$ManageProductSearchSelect = "1"; // 搜索功能是否開啟
$ManageProductBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageProductEditorSelect = "1"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 會議紀錄功能設定 */
$ManageMeetingSearchSelect = "1"; // 搜索功能是否開啟
$ManageMeetingBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageMeetingEditorSelect = "1"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器

/* 贊助企業功能設定 */
$ManageSponsorSearchSelect = "1"; // 搜索功能是否開啟
$ManageSponsorBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageSponsorEditorSelect = "1"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器  
  

/* 求職徵才功能設定 */
$ManageCareersSearchSelect = "1"; // 搜索功能是否開啟
$ManageCareersBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageCareersEditorSelect = "2"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯器 

/* 公佈資訊功能設定 */
$ManagePublishSearchSelect = "1"; // 搜索功能是否開啟
$ManagePublishBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManagePublishEditorSelect = "2"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯

/* 留言管理功能設定 */
$ManageGuestbookSearchSelect = "1"; // 搜索功能是否開啟
$ManageGuestbookMessageBatchDeleteSelect = "1"; // 是否開啟多筆刪除留言及回應功能
$ManageGuestbookEditorSelect = "2"; // 0:無編輯器 1:進階編輯器(包含圖片上傳) 2:基本編輯

/* 會員資料功能設定 */
$ManageMemberSearchSelect = "1"; // 搜索功能是否開啟
$ManageMemberBatchDeleteSelect = "1"; // 是否開啟多筆刪除功能
$ManageMemberAvatarSelect = "1"; // 選擇是否包含頭像上傳功能 1:開啟 0:關閉

/* ----------編輯器功能設定------------ */ 
$editorpath = "/sample/fckeditor/"; // 設定各頁面編輯器路徑
?>