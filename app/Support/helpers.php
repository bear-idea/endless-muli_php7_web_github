<?php

/**
 * 全域輔助函式庫 (最終完整版)
 *
 * 優化重點：
 * 1. 啟用嚴格型別模式 (strict_types=1)，提升程式碼穩定性。
 * 2. 為所有函式的參數和回傳值添加型別宣告。
 * 3. 移除不安全的 GetSQLValueString 函式，杜絕 SQL Injection 風險。
 * 4. 重構 ImageUpload 函式，使用更安全的方式生成檔名並修正權限問題。
 * 5. 精簡部分函式邏輯，提升可讀性。
 * 6. 已補全所有先前遺漏的函式。
 */

declare(strict_types=1);

use Illuminate\Container\Container;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Validation\Factory as ValidatorFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;
use Laravel\Lumen\Http\Redirector;
use Laravel\Lumen\Http\ResponseFactory;
use Laravel\Lumen\Routing\UrlGenerator;

// --- Laravel/Lumen 框架核心輔助函式 (已優化 & 補全) ---

if (! function_exists('abort')) {
    function abort(int $code, string $message = '', array $headers = []): void
    {
        app()->abort($code, $message, $headers);
    }
}

if (! function_exists('app')) {
    function app(string $make = null, array $parameters = []): mixed
    {
        if (is_null($make)) {
            return Container::getInstance();
        }
        return Container::getInstance()->make($make, $parameters);
    }
}

if (! function_exists('auth')) {
    function auth(string $guard = null): mixed
    {
        return is_null($guard) ? app(AuthFactory::class) : app(AuthFactory::class)->guard($guard);
    }
}

if (! function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        return app()->basePath() . ($path ? '/' . ltrim($path, '/') : '');
    }
}

if (! function_exists('broadcast')) {
    function broadcast(mixed $event = null): \Illuminate\Broadcasting\PendingBroadcast
    {
        return app(BroadcastFactory::class)->event($event);
    }
}

if (! function_exists('decrypt')) {
    /** @deprecated Laravel 11 移除了 Encrypter Facade，建議使用 Crypt Facade。此處保留是為了相容。 */
    function decrypt(string $value): mixed
    {
        return app('encrypter')->decrypt($value);
    }
}

if (! function_exists('dispatch')) {
    function dispatch(mixed $job): \Illuminate\Foundation\Bus\PendingDispatch
    {
        return new \Illuminate\Foundation\Bus\PendingDispatch($job);
    }
}

if (! function_exists('dispatch_now')) {
    function dispatch_now(mixed $job, mixed $handler = null): mixed
    {
        return app(Dispatcher::class)->dispatchNow($job, $handler);
    }
}

if (! function_exists('config')) {
    function config(array|string|null $key = null, mixed $default = null): mixed
    {
        if (is_null($key)) {
            return app('config');
        }
        if (is_array($key)) {
            return app('config')->set($key);
        }
        return app('config')->get($key, $default);
    }
}

if (! function_exists('database_path')) {
    function database_path(string $path = ''): string
    {
        return app()->databasePath($path);
    }
}

if (! function_exists('encrypt')) {
    /** @deprecated Laravel 11 移除了 Encrypter Facade，建議使用 Crypt Facade。此處保留是為了相容。 */
    function encrypt(mixed $value): string
    {
        return app('encrypter')->encrypt($value);
    }
}

if (! function_exists('event')) {
    function event(object|string $event, mixed $payload = [], bool $halt = false): ?array
    {
        return app('events')->dispatch($event, $payload, $halt);
    }
}

if (! function_exists('info')) {
    function info(string $message, array $context = []): void
    {
        app('Psr\Log\LoggerInterface')->info($message, $context);
    }
}

if (! function_exists('redirect')) {
    function redirect(string $to = null, int $status = 302, array $headers = [], bool $secure = null): Redirector|\Illuminate\Http\RedirectResponse
    {
        $redirector = new Redirector(app());
        return is_null($to) ? $redirector : $redirector->to($to, $status, $headers, $secure);
    }
}

if (! function_exists('report')) {
    function report(Throwable $exception): void
    {
        app(ExceptionHandler::class)->report($exception);
    }
}

if (! function_exists('request')) {
    function request(array|string|null $key = null, mixed $default = null): Request|string|array|null
    {
        if (is_null($key)) {
            return app('request');
        }
        if (is_array($key)) {
            return app('request')->only($key);
        }
        return app('request')->input($key, $default);
    }
}

if (! function_exists('resource_path')) {
    function resource_path(string $path = ''): string
    {
        return app()->resourcePath($path);
    }
}

if (! function_exists('response')) {
    function response(string $content = '', int $status = 200, array $headers = []): ResponseFactory|\Illuminate\Http\Response
    {
        $factory = new ResponseFactory;
        return func_num_args() === 0 ? $factory : $factory->make($content, $status, $headers);
    }
}

if (! function_exists('route')) {
    function route(string $name, array $parameters = [], bool $secure = null): string
    {
        return app('url')->route($name, $parameters, $secure);
    }
}

if (! function_exists('storage_path')) {
    function storage_path(string $path = ''): string
    {
        return app()->storagePath($path);
    }
}

if (! function_exists('trans')) {
    function trans(string $id = null, array $replace = [], string $locale = null): \Illuminate\Contracts\Translation\Translator|string|array|null
    {
        if (is_null($id)) {
            return app('translator');
        }
        return app('translator')->get($id, $replace, $locale);
    }
}

if (! function_exists('__')) {
    function __(string $key, array $replace = [], string $locale = null): string|array|null
    {
        return app('translator')->get($key, $replace, $locale);
    }
}

if (! function_exists('trans_choice')) {
    function trans_choice(string $id, int|array|\Countable $number, array $replace = [], string $locale = null): string
    {
        return app('translator')->choice($id, $number, $replace, $locale);
    }
}

if (! function_exists('url')) {
    function url(string $path = null, array $parameters = [], bool $secure = null): string
    {
        return app('url')->to($path, $parameters, $secure);
    }
}

if (! function_exists('validator')) {
    function validator(array $data = [], array $rules = [], array $messages = [], array $customAttributes = []): ValidatorFactory|\Illuminate\Contracts\Validation\Validator
    {
        $factory = app('validator');
        return func_num_args() === 0 ? $factory : $factory->make($data, $rules, $messages, $customAttributes);
    }
}

if (! function_exists('view')) {
    function view(string $view = null, array $data = [], array $mergeData = []): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $factory = app('view');
        return func_num_args() === 0 ? $factory : $factory->make($view, $data, $mergeData);
    }
}

if (!function_exists('urlGenerator')) {
    function urlGenerator(): UrlGenerator
    {
        return new UrlGenerator(app());
    }
}

if (!function_exists('asset')) {
    function asset(string $path, bool $secured = false): string
    {
        $assetUrl = config('app.asset_url');
        return urlGenerator()->asset($assetUrl ? rtrim($assetUrl, '/') . '/' . ltrim($path, '/') : $path, $secured);
    }
}

if (!function_exists('asset_admin')) {
    function asset_admin(string $path, bool $secured = false): string
    {
        $finalPath = config('app.admin_path', 'admin') . '/' . ltrim($path, '/');
        $assetUrl = config('app.asset_url'); // 建議統一使用小寫 'app.asset_url'
        if ($assetUrl) {
            $finalPath = rtrim($assetUrl, '/') . '/' . $finalPath;
        }
        return urlGenerator()->asset($finalPath, $secured);
    }
}


// --- 自定義業務邏輯輔助函式 (已優化 & 補全) ---

/**
 * @deprecated 函式 GetSQLValueString 已被移除。
 *
 * 原因：此函式使用手動字串轉義來防止 SQL Injection，這是一種過時且不安全的方法。
 * 現代 PHP 應用程式應完全依賴 PDO 參數綁定或 Eloquent ORM 來與資料庫互動，
 * 這可以從根本上杜絕 SQL Injection 攻擊。
 *
 * 替代方案：請使用 Eloquent 模型進行所有資料庫操作。
 * 例如：User::create(['name' => $name]); 或 DB::table('users')->where('id', $id)->first();
 */

if (!function_exists("ImageUpload")) {
    function ImageUpload(Request $request, string $inputName, string $uploadDir): array
    {
        if (!$request->hasFile($inputName)) {
            return [];
        }

        $files = is_array($request->file($inputName)) ? $request->file($inputName) : [$request->file($inputName)];
        $uploadedFiles = [];
        $allowedImageTypes = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg', 'webp'];
        $thumbPath = $uploadDir . '/thumb';

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        if (!is_dir($thumbPath)) mkdir($thumbPath, 0755, true);

        foreach ($files as $file) {
            if (!$file || !$file->isValid()) continue;

            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, $allowedImageTypes)) continue;

            try {
                $filename = bin2hex(random_bytes(16)) . '.' . $extension;
                $filePath = $uploadDir . '/' . $filename;
                $file->move($uploadDir, $filename);

                if ($extension === 'svg') {
                    copy($filePath, $thumbPath . '/' . $filename);
                } else {
                    $manager = new ImageManager(new GdDriver());
                    $image = $manager->read($filePath);
                    $image->scaleDown(width: 1500, height: 1500)->save();
                    $image->scaleDown(width: 380, height: 380)->save($thumbPath . '/' . $filename);
                }
                $uploadedFiles[] = $filename;
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage(), [
                    'input' => $inputName,
                    'original_name' => $file->getClientOriginalName()
                ]);
            }
        }
        return $uploadedFiles;
    }
}

if (!function_exists("generateUrl")) {
    function generateUrl(string $route, array $parameters = [], array $defaultParameters = []): string
    {
        $url = preg_replace_callback('/\{(\w+)\}/', function ($matches) use (&$parameters, $defaultParameters) {
            $key = $matches[1];
            if (isset($parameters[$key])) {
                $value = urlencode((string) $parameters[$key]);
                unset($parameters[$key]);
                return $value;
            }
            if (isset($defaultParameters[$key])) {
                return urlencode((string) $defaultParameters[$key]);
            }
            return '{' . $key . '}';
        }, $route);

        $queryParams = array_merge($defaultParameters, $parameters);
        return empty($queryParams) ? $url : $url . '?' . http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986);
    }
}

if (!function_exists("getRoutePrefixAndName")) {
    function getRoutePrefixAndName(Request $request): array
    {
        $route = $request->route();
        if (!$route) return ['prefix' => null, 'name' => null];
        $action = $route->getAction();
        $routeName = $route->getName();
        $routePrefix = isset($action['prefix']) ? trim($action['prefix'], '/') : null;
        if ($routeName && $routePrefix && str_starts_with($routeName, $routePrefix . '.')) {
            $routeName = substr($routeName, strlen($routePrefix) + 1);
        }
        return ['prefix' => $routePrefix, 'name' => $routeName];
    }
}

if (!function_exists("toSnakeCase")) {
    function toSnakeCase(string $input): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $input));
    }
}

if (!function_exists("toSpinalCase")) {
    function toSpinalCase(string $input): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $input));
    }
}

if (!function_exists("toPascalCase")) {
    function toPascalCase(string $input): string
    {
        return str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $input)));
    }
}

if (!function_exists("toCamelCase")) {
    function toCamelCase(string $input): string
    {
        return lcfirst(toPascalCase($input));
    }
}

if (!function_exists('generateNestableList')) {
    function generateNestableList(Collection $items): string
    {
        $html = '<ol class="dd-list">';
        foreach ($items as $item) {
            $html .= '<li class="dd-item" data-id="' . $item->id . '">';
            $html .= '<div class="dd-handle">' . htmlspecialchars($item->title) . '</div>';
            if ($item->children && $item->children->isNotEmpty()) {
                $html .= generateNestableList($item->children);
            }
            $html .= '</li>';
        }
        $html .= '</ol>';
        return $html;
    }
}

if (!function_exists('extractAction')) {
    function extractAction(array|string $routes, string $module_uri, ?string $prefix = null): array|string
    {
        $routes = is_array($routes) ? $routes : [$routes];
        $actions = [];

        foreach ($routes as $route) {
            $processedRoute = $route;
            if ($prefix !== null) {
                $processedRoute = str_replace($prefix . '.', '', $processedRoute);
            }

            $moduleUriPosition = strpos($processedRoute, $module_uri);
            if ($moduleUriPosition !== false) {
                $action = substr($processedRoute, $moduleUriPosition + strlen($module_uri));
                $action = ltrim($action, './');
                $actions[] = empty($action) ? '/' : $action;
            }
        }

        return count($actions) === 1 ? $actions[0] : $actions;
    }
}

if (!function_exists('addNotification')) {
    function addNotification(
        string $title,
        string $text,
        bool $sticky = false,
        int $time = 5000,
        string $class_name = 'gritter-light'
    ): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['notifications'])) {
            $_SESSION['notifications'] = [];
        }
        $formattedText = $text ? '<hr class="my-2"><span class="fw-bolder">' . htmlspecialchars($text) . '</span>' : '';
        $_SESSION['notifications'][] = [
            'title' => $title,
            'text' => $formattedText,
            'sticky' => $sticky,
            'time' => $time,
            'class_name' => $class_name,
        ];
    }
}

if (!function_exists('generateDynamicOptions')) {
    function generateDynamicOptions(array $data, array $columns = ['value', 'name']): array
    {
        $options = [];
        foreach ($data as $item) {
            if (!is_array($item)) continue;
            $option = [];
            foreach ($columns as $column) {
                if (isset($item[$column])) {
                    $option[$column] = $item[$column];
                }
            }
            if (!empty($option)) {
                $options[] = $option;
            }
            if (!empty($item['children']) && is_array($item['children'])) {
                $options = array_merge($options, generateDynamicOptions($item['children'], $columns));
            }
        }
        return $options;
    }
}