<?php
use Illuminate\Container\Container;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Intervention\Image\ImageManager;

if (! function_exists('abort')) {
    /**
     * Throw an HttpException with the given data.
     *
     * @param  int  $code
     * @param  string  $message
     * @param  array  $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function abort($code, $message = '', array $headers = [])
    {
        app()->abort($code, $message, $headers);
    }
}

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $make
     * @param array $parameters
     * @return Container|mixed|object
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function app($make = null, array $parameters = [])
    {
        if (is_null($make)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($make, $parameters);
    }
}

if (! function_exists('auth')) {
    /**
     * Get the available auth instance.
     *
     * @param  string|null  $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function auth($guard = null)
    {
        if (is_null($guard)) {
            return app(AuthFactory::class);
        }

        return app(AuthFactory::class)->guard($guard);
    }
}

if (! function_exists('base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string  $path
     * @return string
     */
    function base_path($path = '')
    {
        return app()->basePath().($path ? '/'.$path : $path);
    }
}

if (! function_exists('broadcast')) {
    /**
     * Begin broadcasting an event.
     *
     * @param  mixed|null  $event
     * @return \Illuminate\Broadcasting\PendingBroadcast
     */
    function broadcast($event = null)
    {
        return app(BroadcastFactory::class)->event($event);
    }
}

if (! function_exists('decrypt')) {
    /**
     * Decrypt the given value.
     *
     * @param  string  $value
     * @return string
     */
    function decrypt($value)
    {
        return app('encrypter')->decrypt($value);
    }
}

if (! function_exists('dispatch')) {
    /**
     * Dispatch a job to its appropriate handler.
     *
     * @param  mixed  $job
     * @return mixed
     */
    function dispatch($job)
    {
        return new PendingDispatch($job);
    }
}

if (! function_exists('dispatch_now')) {
    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @param  mixed  $job
     * @param  mixed  $handler
     * @return mixed
     */
    function dispatch_now($job, $handler = null)
    {
        return app(Dispatcher::class)->dispatchNow($job, $handler);
    }
}

if (! function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function config($key = null, $default = null)
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
    /**
     * Get the path to the database directory of the install.
     *
     * @param  string  $path
     * @return string
     */
    function database_path($path = '')
    {
        return app()->databasePath($path);
    }
}

if (! function_exists('encrypt')) {
    /**
     * Encrypt the given value.
     *
     * @param  string  $value
     * @return string
     */
    function encrypt($value)
    {
        return app('encrypter')->encrypt($value);
    }
}

if (! function_exists('event')) {
    /**
     * Dispatch an event and call the listeners.
     *
     * @param  object|string  $event
     * @param  mixed  $payload
     * @param  bool  $halt
     * @return array|null
     */
    function event($event, $payload = [], $halt = false)
    {
        return app('events')->dispatch($event, $payload, $halt);
    }
}

if (! function_exists('info')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function info($message, $context = [])
    {
        return app('Psr\Log\LoggerInterface')->info($message, $context);
    }
}

if (! function_exists('redirect')) {
    /**
     * Get an instance of the redirector.
     *
     * @param  string|null  $to
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return \Laravel\Lumen\Http\Redirector|\Illuminate\Http\RedirectResponse
     */
    function redirect($to = null, $status = 302, $headers = [], $secure = null)
    {
        $redirector = new Laravel\Lumen\Http\Redirector(app());

        if (is_null($to)) {
            return $redirector;
        }

        return $redirector->to($to, $status, $headers, $secure);
    }
}

if (! function_exists('report')) {
    /**
     * Report an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    function report(Throwable $exception)
    {
        app(ExceptionHandler::class)->report($exception);
    }
}

if (! function_exists('request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  array|string|null  $key
     * @param  mixed  $default
     * @return \Illuminate\Http\Request|string|array
     */
    function request($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('request');
        }

        if (is_array($key)) {
            return app('request')->only($key);
        }

        $value = app('request')->__get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (! function_exists('resource_path')) {
    /**
     * Get the path to the resources folder.
     *
     * @param  string  $path
     * @return string
     */
    function resource_path($path = '')
    {
        return app()->resourcePath($path);
    }
}

if (! function_exists('response')) {
    /**
     * Return a new response from the application.
     *
     * @param  string  $content
     * @param  int  $status
     * @param  array  $headers
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    function response($content = '', $status = 200, array $headers = [])
    {
        $factory = new Laravel\Lumen\Http\ResponseFactory;

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($content, $status, $headers);
    }
}



if (! function_exists('route')) {
    /**
     * Generate a URL to a named route.
     *
     * @param  string  $name
     * @param  array  $parameters
     * @param  bool|null  $secure
     * @return string
     */
    function route($name, $parameters = [], $secure = null)
    {
        return app('url')->route($name, $parameters, $secure);
    }
}

if (! function_exists('storage_path')) {
    /**
     * Get the path to the storage folder.
     *
     * @param  string  $path
     * @return string
     */
    function storage_path($path = '')
    {
        return app()->storagePath($path);
    }
}

if (! function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param string|null $id
     * @param array $replace
     * @param string|null $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function trans($id = null, $replace = [], $locale = null)
    {
        if (is_null($id)) {
            return app('translator');
        }

        return app('translator')->get($id, $replace, $locale);
    }
}

if (! function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return string|array|null
     */
    function __($key, $replace = [], $locale = null)
    {
        return app('translator')->get($key, $replace, $locale);
    }
}

if (! function_exists('trans_choice')) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string  $id
     * @param  int|array|\Countable  $number
     * @param  array  $replace
     * @param  string|null  $locale
     * @return string
     */
    function trans_choice($id, $number, array $replace = [], $locale = null)
    {
        return app('translator')->choice($id, $number, $replace, $locale);
    }
}

if (! function_exists('url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string  $path
     * @param  mixed  $parameters
     * @param  bool|null  $secure
     * @return string
     */
    function url($path = null, $parameters = [], $secure = null)
    {
        return app('url')->to($path, $parameters, $secure);
    }
}

if (! function_exists('validator')) {
    /**
     * Create a new Validator instance.
     *
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return \Illuminate\Contracts\Validation\Validator
     */
    function validator(array $data = [], array $rules = [], array $messages = [], array $customAttributes = [])
    {
        $factory = app('validator');

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($data, $rules, $messages, $customAttributes);
    }
}

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array  $data
     * @param  array  $mergeData
     * @return \Illuminate\View\View
     */
    function view($view = null, $data = [], $mergeData = [])
    {
        $factory = app('view');

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }
}

if (!function_exists('urlGenerator')) {
    /**
     * @return \Illuminate\Routing\UrlGenerator
     */
    function urlGenerator(): \Laravel\Lumen\Routing\UrlGenerator
    {
        return new \Laravel\Lumen\Routing\UrlGenerator(app());
    }
}

if (!function_exists('asset')) {
    /**
     * @param $path
     * @param bool $secured
     *
     * @return string
     */
    function asset($path, $secured = false): string
    {
        if(config('app.asset_url')){
            $path = config('app.asset_url') . $path;
        }

        return urlGenerator()->asset($path, $secured);
    }
}

if (!function_exists('asset_admin')) {
    /**
     * @param $path
     * @param bool $secured
     *
     * @return string
     */
    function asset_admin($path, $secured = false): string
    {
        $path = config('app.admin_path') . $path;

        if(config('APP.asset_url')){
            $path = config('app.asset_url') . '/' . $path;
        }

        return urlGenerator()->asset($path, $secured);
    }
}

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        global $DB_Conn;
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

        switch ($theType) {
            case "date":
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
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

if (!function_exists("ImageUpload")) {
    function ImageUpload($request, $inputName, $uploadDir): array
    {
        $uploadedFiles = [];

        if ($request->hasFile($inputName)) {
            $files = $request->file($inputName);
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                $uploadPath = $uploadDir;
                $thumbPath = $uploadPath . '/thumb';

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                if (!is_dir($thumbPath)) {
                    mkdir($thumbPath, 0777, true);
                }

                $extension = strtolower($file->getClientOriginalExtension());
                $filename = uniqid() . '_' . mt_rand(1000, 9999) . '.' . $extension;
                $filePath = $uploadPath . '/' . $filename;

                // 允许的图像文件类型
                $allowedImageTypes = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg', 'webp'];

                try {
                    // 移动上传的文件
                    if ($file->move($uploadPath, $filename)) {
                        // 如果是图像类型
                        if (in_array($extension, $allowedImageTypes)) {
                            // 处理图像文件
                            if ($extension === 'svg') {
                                // SVG 特殊处理：复制文件作为缩略图
                                copy($filePath, $thumbPath . '/' . $filename);
                            } else {
                                // 对非 SVG 图像文件生成缩略图
                                $manager = new ImageManager(
                                    new Intervention\Image\Drivers\Gd\Driver()
                                );
                                $image = $manager->read($filePath);

                                // 缩放原始图像
                                $image->scale(1500, 1500, function ($constraint) {
                                    $constraint->aspectRatio();
                                    $constraint->upsize();
                                });
                                $image->save();

                                // 生成缩略图
                                $image->scale(380, 380, function ($constraint) {
                                    $constraint->aspectRatio();
                                    $constraint->upsize();
                                });
                                $image->save($thumbPath . '/' . $filename);
                            }
                        }

                        // 添加文件名到已上传文件数组
                        $uploadedFiles[] = $filename;
                    }
                } catch (Exception $e) {
                    // 处理文件上传失败
                    //Log::error('File upload failed: ' . $e->getMessage());
                }
            }
        }

        return $uploadedFiles;
    }
}

/**
 * 生成 URL 的函數，根據給定的路由和參數生成對應的 URL。
 *
 * @param string $route 路由模板，其中參數用 {參數名} 表示。
 * @param array $parameters 參數數組，用於替換路由模板中的佔位符。
 * @param array $defaultParameters 默認參數數組，在參數數組中沒有對應參數時使用。
 * @return string 生成的 URL。
 */
function generateUrl($route, $parameters = [], $defaultParameters = []): string
{
    // 確保所有參數都被替換
    $url = preg_replace_callback('/\{(\w+)\}/', function ($matches) use (&$parameters, $defaultParameters) {
        $key = $matches[1];
        // 如果參數數組中有對應的鍵，則使用該值並從參數數組中移除該鍵
        if (isset($parameters[$key])) {
            $value = urlencode($parameters[$key]);
            unset($parameters[$key]); // 移除已替換的參數
            return $value;
        } elseif (isset($defaultParameters[$key])) {
            return urlencode($defaultParameters[$key]);
        } else {
            // 如果沒有對應的參數，則保留佔位符
            return '{' . $key . '}';
        }
    }, $route);

    // 確保 $defaultParameters 和 $parameters 都是數組
    $defaultParameters = $defaultParameters ?? [];
    $parameters = $parameters ?? [];

    // 合併剩餘的參數與默認參數，生成查詢字符串
    $queryParams = array_merge($defaultParameters, $parameters);
    $queryString = http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986);

    return $url . (!empty($queryString) ? '?' . $queryString : '');
}

/**
 * 獲取當前路由的前綴和名稱。
 *
 * @param Request $request 當前的 HTTP 請求實例。
 * @return array 包含路由的 'prefix' 和 'name' 的關聯數組。
 */
if (!function_exists("getRoutePrefixAndName")) {
    function getRoutePrefixAndName(Request $request)
    {
        $route = $request->route();
        if (!$route) {
            return ['prefix' => null, 'name' => null];
        }

        $routePrefix = '';
        $routeName = $route->getName();

        // 找到路由群組的前綴
        $action = $route->getAction();
        if (isset($action['prefix'])) {
            $routePrefix = trim($action['prefix'], '/');
        }

        // 移除前綴部分，得到純粹的路由名稱
        if ($routeName && strpos($routeName, $routePrefix . '.') === 0) {
            $routeName = substr($routeName, strlen($routePrefix) + 1);
        }

        return ['prefix' => $routePrefix, 'name' => $routeName];
    }
}

/**
 * 將駝峰式（CamelCase）或大駝峰式（PascalCase）字串轉換為蛇形命名（snake_case）。
 *
 * @param string $input 要轉換的字串
 * @return string 轉換後的蛇形命名字串
 */
if (!function_exists("toSnakeCase")) {
    function toSnakeCase($input): string
    {
        if (preg_match('/[A-Z]/', $input) === 0) {
            return strtolower($input);
        }

        $pattern = '/([a-z])([A-Z])/';
        $replacement = '$1_$2';

        return strtolower(preg_replace($pattern, $replacement, $input));
    }
}

/**
 * 將駝峰式（CamelCase）或大駝峰式（PascalCase）字串轉換為脊椎式命名（spinal-case）。
 *
 * @param string $input 要轉換的字串
 * @return string 轉換後的脊椎式命名字串
 */
if (!function_exists("toSpinalCase")) {
    function toSpinalCase($input): string
    {
        // 如果字串不包含大寫字母，直接轉換為小寫並返回
        if (preg_match('/[A-Z]/', $input) === 0) {
            return strtolower($input);
        }

        // 將駝峰式（CamelCase）或大駝峰式（PascalCase）轉換為脊椎式命名（spinal-case）
        $pattern = '/([a-z])([A-Z])/';
        $replacement = '$1-$2';

        return strtolower(preg_replace($pattern, $replacement, $input));
    }
}

/**
 * 將字串轉換為大駝峰式（PascalCase）。
 *
 * @param string $input 要轉換的字串
 * @return string 轉換後的大駝峰式字串
 */
if (!function_exists("toPascalCase")) {
    function toPascalCase($input): array|string
    {
        $words = str_replace('_', ' ', strtolower($input));
        $words = ucwords($words);
        return str_replace(' ', '', $words);
    }
}

/**
 * 將字串轉換為小駝峰式（camelCase）。
 *
 * @param string $input 要轉換的字串
 * @return string 轉換後的小駝峰式字串
 */
if (!function_exists("toCamelCase")) {
    function toCamelCase($input): string
    {
        $words = str_replace('_', ' ', strtolower($input));
        $words = ucwords($words);
        $camelCase = lcfirst(str_replace(' ', '', $words));
        return $camelCase;
    }
}

/**
 * 生成 NestableList 嵌套列表的 HTML
 *
 * @param \Illuminate\Support\Collection $items 菜單項目的集合
 * @return string 生成的 HTML 字串
 */
if (!function_exists('generateNestableList')) {
    function generateNestableList($items)
    {
        $html = '<ol class="dd-list">';
        foreach ($items as $item) {
            $html .= '<li class="dd-item" data-id="' . $item->id . '">';
            $html .= '<div class="dd-handle">' . $item->title . '</div>';
            if ($item->children->isNotEmpty()) {
                $html .= generateNestableList($item->children);
            }
            $html .= '</li>';
        }
        $html .= '</ol>';
        return $html;
    }
}

/**
 * 從路由名稱中提取動作部分，不包含最前面的斜杠。
 *
 * @param array|string $routes 路由名稱或路由名稱陣列
 * @param string $module_uri 模組 URI
 * @param string|null $prefix 前綴（如果有）
 * @return array|string 動作部分（不包含最前面的斜杠）
 */
function extractAction($routes, string $module_uri, ?string $prefix = null)
{
    // 確保 $routes 是一個陣列
    if (!is_array($routes)) {
        $routes = [$routes];
    }

    $actions = [];

    foreach ($routes as $route) {
        // 如果提供了前綴，則移除
        if ($prefix !== null) {
            $route = str_replace($prefix . '.', '', $route);
        }

        // 查找模組 URI 的位置
        $moduleUriPosition = strpos($route, $module_uri);

        if ($moduleUriPosition !== false) {
            // 去除模組 URI 部分
            $action = substr($route, $moduleUriPosition + strlen($module_uri));

            // 去掉最前面的斜杠和多餘的點
            $action = ltrim($action, '.'); // 去掉開頭的點
            $action = ltrim($action, '/'); // 去掉開頭的斜杠

            // 如果處理後的動作部分是空的，則補上 '/'
            if (empty($action)) {
                $action = '/';
            }

            // 儲存處理後的動作
            $actions[] = $action;
        }
    }

    // 如果只有一個動作，則返回字串而不是陣列
    if (count($actions) === 1) {
        return $actions[0];
    }

    return $actions;
}

/**
 * 添加通知到 session 中以便在页面加载时显示。
 *
 * 这个函数将通知的详细信息添加到 `$_SESSION['notifications']` 数组中，
 * 以便在页面加载时通过 JavaScript 动态显示这些通知。
 *
 * 使用方式 : addNotification(renderNotificationTitle('fa fa-bell', 'bg-success', '成功通知'), '新增成功', false, 5000, 'gritter-success');
 *
 * @param string $title 通知的标题。可以包含 HTML 标签以自定义样式。
 * @param string $text 通知的文本内容。可以包含 HTML 标签。
 * @param bool $sticky 是否将通知设置为“粘性”，即通知将保持显示直到用户手动关闭。
 *                       默认为 false，表示通知将在指定时间后自动隐藏。
 * @param int $time 通知显示的持续时间（以毫秒为单位）。默认值为 5000 毫秒（即 5 秒）。
 *                   如果 `$sticky` 设置为 true，此参数将被忽略。
 * @param string $class_name 通知的 CSS 类名，用于自定义通知的外观。默认值为 'gritter-light'。
 *
 * @return void
 */
function addNotification($title, $text, $sticky = false, $time = 5000, $class_name = 'gritter-light') {
    // 检查 `$_SESSION['notifications']` 是否存在，如果不存在则初始化为空数组
    if (!isset($_SESSION['notifications'])) {
        $_SESSION['notifications'] = [];
    }

    // 将新的通知添加到 `$_SESSION['notifications']` 数组中
    $_SESSION['notifications'][] = [
        'title' => $title,
        'text' => $text ? '<hr class="my-2">'. '<span class="fw-bolder">'.$text.'</span>' : '',
        'sticky' => $sticky,
        'time' => $time,
        'class_name' => $class_name,
    ];
}

/**
 * 根據提供的數據生成選項
 *
 * @param array $data 傳入的數據，通常是從控制器中獲取的數組
 * @param array $columns 要轉換為選項的欄位，例如 ['id', 'itemname']
 * @return array 返回選項數組
 */
function generateDynamicOptions(array $data, array $columns = ['value', 'name']): array
{
    $options = [];

    foreach ($data as $item) {
        if (!is_array($item)) {
            continue; // 跳過非數組項目
        }

        $option = [];
        foreach ($columns as $column) {
            if (isset($item[$column])) {
                $option[$column] = $item[$column];
            }
        }

        // 添加選項到結果中
        $options[] = $option;

        // 處理子項目（如果有的話）
        if (!empty($item['children']) && is_array($item['children'])) {
            $childrenOptions = generateDynamicOptions($item['children'], $columns);
            foreach ($childrenOptions as $childOption) {
                $childOption['parent_id'] = $item['id']; // 可以添加 parent_id 作為區分
                $options[] = $childOption;
            }
        }
    }

    return $options;
}
