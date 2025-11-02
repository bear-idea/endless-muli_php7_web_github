<?php
//initialize the session
if (!isset($_SESSION)) {
    session_start();
}

// 定義語言代碼與名稱的映射
$langMap = [
    "zh_TW" => "繁體",
    "zh-cn" => "簡體",
    "en" => "英文",
    "jp" => "日文",
    "kr" => "韓語",
    "sp" => "西班牙語"
];

// 設定預設語言
$defaultlang = "zh_TW"; // 假設預設語言為繁體中文

// 檢查是否設置了語言
if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $langMap)) {
    $_SESSION['lang'] = $_GET['lang'];
    $langname = $langMap[$_GET['lang']];
} else {
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = $defaultlang;
    }
    $langname = $langMap[$_SESSION['lang']] ?? $langMap[$defaultlang];
}
