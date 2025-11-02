<?php
// 顯示錯誤，方便除錯
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 定義專案根目錄路徑
define('BASE_PATH', __DIR__ . '/..');

// 載入 Composer 的自動載入器
require_once BASE_PATH . '/vendor/autoload.php';

// 建立路由器實例
$router = new App\Core\Router();

// 載入路由定義檔案
require_once BASE_PATH . '/routes/web.php';

try {
    // 取得當前請求的 URI
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    // 啟動路由分派
    $router->dispatch($uri);
} catch (Exception $e) {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    error_log('Error: ' . $e->getMessage());
}