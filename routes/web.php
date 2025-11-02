<?php
// 定義根目錄 ('/') 的路由，由 PageController 的 home 方法處理
$router->get('', [App\Controllers\Frontend\PageController::class, 'home']);