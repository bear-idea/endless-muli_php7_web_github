<?php
// /app/eloquent_bootstrap.php

// 引入 Composer 的 autoload
require_once __DIR__ . '/../vendor/autoload.php';
// 引入舊的設定檔以獲取資料庫變數
require_once __DIR__ . '/../Connections/DB_Conn.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// 建立 Eloquent 的管理器
$capsule = new Capsule;

// 新增資料庫連線設定
// 這裡我們直接讀取 DB_Conn.php 中的全域變數
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $hostname_DB_Conn,
    'database'  => $database_DB_Conn,
    'username'  => $username_DB_Conn,
    'password'  => $password_DB_Conn,
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

// 設定為全域可用，讓我們可以在任何地方像 Laravel 一樣使用靜態方法
$capsule->setAsGlobal();

// 啟動 Eloquent
$capsule->bootEloquent();