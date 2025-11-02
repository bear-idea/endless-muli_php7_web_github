<?php
// /app/controllers/NewsController.php

// 【重要】引入 Eloquent 啟動檔和 Model
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../Eloquent/News.php';

// 【重要】您的系統使用 $view_page 變數來載入內容，我們直接對它賦值
global $view_page;

try {
    $opt = $_GET['Opt'] ?? ($_GET['Opt_News'] ?? 'viewpage');
    $lang = $_SESSION['lang'] ?? 'zh-tw';
    $userId = $_SESSION['userid'] ?? -1;

    // 全域 Title 變數，您的 header/meta 檔案可能會用到
    global $Title_Word;

    switch ($opt) {
        case 'detailed':
            $newsId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $newsItem = News::where('userid', $userId)->find($newsId);
            $prevNews = null;
            $nextNews = null;

            if ($newsItem) {
                $prevNews = News::where('id', '<', $newsId)->where('lang', $lang)->where('userid', $userId)->orderBy('id', 'desc')->first();
                $nextNews = News::where('id', '>', $newsId)->where('lang', $lang)->where('userid', 'userId')->orderBy('id', 'asc')->first();

                // 設定頁面標題
                $Title_Word = $newsItem->title . " - " . $row_RecordAccount['company'];
            }

            // 【關鍵修改】設定主內容區要載入的視圖檔案給 $view_page 變數
            $view_page = $TplPath . "/news_detailed.php";
            break;

        case 'viewpage':
        default:
            $searchKey = $_GET['searchkey'] ?? '';
            $perPage = 24;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            $newsData = News::where('lang', $lang)
                ->where('userid', $userId)
                ->where('indicate', 1)
                ->where(function ($query) use ($searchKey) {
                    if (!empty($searchKey)) {
                        $searchTerm = '%' . $searchKey . '%';
                        $query->where('title', 'like', $searchTerm)->orWhere('type', 'like', $searchTerm);
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);

            // 設定頁面標題
            $Title_Word = "最新消息 - " . $row_RecordAccount['company'];

            // 【關鍵修改】設定主內容區要載入的視圖檔案給 $view_page 變數
            $view_page = $TplPath . "/news_view.php";
            break;
    }

} catch (\Exception $e) {
    error_log($e->getMessage());
    $Title_Word = "系統錯誤";
    // 如果發生錯誤，也可以指向一個錯誤頁面模板
    $view_page = $TplPath . "/error_page.php";
    $error_message = "系統發生錯誤，請稍後再試。";
}