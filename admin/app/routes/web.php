<?php

use App\Eloquent\Admin\Routes;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


require(dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'Connections'. DIRECTORY_SEPARATOR . 'DB_Conn.php');
//require_once(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'init' . DIRECTORY_SEPARATOR . 'bootstrap_define.php');

Route::group(['prefix' => '', 'namespace' => 'App\Controller\Admin', 'middleware' => ['App\Middleware\Admin\AuthMiddleware', 'App\Middleware\Admin\SetLocaleMiddleware']], function () {

    // 定義動態生成路由的函式
    function registerDynamicRoutes(): void
    {
        $request = new Request;
        $routesConfig = (new Routes)->getAll($request);
        $groupedRoutes = $routesConfig->groupBy('prefix');

        foreach ($groupedRoutes as $prefix => $routes) {
            Route::prefix($prefix)->group(function () use ($routes) {
                foreach ($routes as $route) {
                    $methods = explode(',', $route->methods);
                    Route::match($methods, $route->uri, "{$route->controller_name}@{$route->controller_action}")
                        ->name("{$route->prefix}.{$route->name}");
                }
            });
        }
    }

    // 呼叫動態生成路由的函式
    registerDynamicRoutes();

    Route::redirect('', 'home');
    Route::redirect('index', 'home');
    Route::redirect('index.php', 'home');
    Route::get('home', 'HomeController@index')->name('home.index');
    Route::get('logout', 'AuthController@logout')->name('auth.logout');

});

// 登入和登出路由
Route::group(['prefix' => 'admin', 'namespace' => 'App\Controller\Admin', 'middleware' => ['App\Middleware\Admin\SetLocaleMiddleware']], function () {
    Route::match(['get', 'post'], 'login', 'AuthController@login')->name('auth.login');
    Route::get('logout', 'AuthController@logout')->name('auth.logout');
});

# 不同網域代表應用程式的不同區域
# 像是 slcak 每間公司會有自己的子網域
Route::domain('{account}.myapp.com')->group(function(){
    Route::get('/', function($account){
        // ...
    });
});

// 捕捉所有未匹配的路由並顯示自定義404頁面
Route::fallback(function () {
    // 如果你使用 Blade 模板引擎
    //return response()->view('errors.404', [], 404);

    // 如果你想要使用自定義的 PHP 文件
    require(dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'Connections'. DIRECTORY_SEPARATOR . 'DB_Conn.php');
    $page_title = '404';
    $page_view_path = ADMINPATH . '/themes/pages/error/';
    $page_view_path_component = $page_view_path . 'component/';
    $page_view_path_vendor = ADMINPATH . '/themes/pages/vendor/';
    $page_view = $page_view_path . 'require_404.php';
    require_once('themes/layouts/error.php');

})->name('fallback');

