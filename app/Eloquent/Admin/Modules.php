<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Modules extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_modules';

    public $timestamps = false;

    protected $guarded = ['id'];


    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = Modules::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->with('routes')
            //->with('routes')
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getEnabledModules(Request $request){

        // 獲取當前用戶ID
        $userId = $_SESSION['w_userid'];

        // 查詢是否已存在該用戶的設置記錄
        $siteSetting = SiteSetting::where('userid', $userId)->first();
        $enabledModules = $siteSetting ? json_decode($siteSetting->ModuleEnableSettings, true) : [];

        $allModules = Modules::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('type', '=', 'Frontend')
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->with(['routes' => function($query) {
                $query->whereNotNull('name')
                    ->where('controller_action', '=', 'index')
                    ->whereRaw("(prefix IS NULL OR prefix = '')");
            }])
            ->get();
        //->toArray();

        // 根据已启用的模块过滤所有模块
        $enabledModulesList = $allModules->filter(function($module) use ($enabledModules) {
            return isset($enabledModules[$module->class]) && $enabledModules[$module->class] == 1;
        });

        //dd($enabledModulesList);

        return $enabledModulesList;
    }

    /**
     * 取得編輯資料
     *
     * @param Request $request
     * @return mixed
     */
    function getByID(Request $request){
        $result = Modules::select('*')
            ->where('id', '=', $request->input('id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->first();
        //->toArray();

        return $result;
    }

    /**
     * 取得子菜單資料，包括 MenuBackend 和 Routes 的資料。
     *
     * @param Request $request 請求對象。
     * @param string $UseMod 模組的 uri。
     * @return \Illuminate\Support\Collection 格式化後的子菜單資料。
     */
    public function getSubMenu(Request $request, $UseMod)
    {
        $modules = Modules::select('*')
            ->where('uri', '=', $UseMod)
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->with(['menuBackend' => function ($query) {
                $query->where('is_submenu', 1);
            }])
            ->with('routes')
            ->get();

        // 測試 Modules 和 Routes 關聯是否正確
        //dd($modules);

        $parameters = ['lang' => $_SESSION['lang'] ?? 'zh_TW'];

        // 使用集合操作來格式化資料
        return $modules->mapWithKeys(function ($module) use ($parameters) {
            // 獲取所有與此 module 相關聯的 routes
            $routes = $module->routes->keyBy('name');

            // 測試 Routes 是否正確
            //dd($routes);

            return [
                $module->uri => $module->menuBackend->map(function ($menuBackend) use ($routes, $parameters) {
                    // 根據 menuBackend 的 route_name 獲取對應的 route
                    $route = $routes->get($menuBackend->route_name);

                    // 測試每個 menuBackend 是否正確獲取 route
                    //dd($menuBackend, $route);

                    // 確保 permission 欄位是陣列，空值轉換為空陣列
                    $permissions = is_array($menuBackend->permission)
                        ? $menuBackend->permission
                        : ($menuBackend->permission ? json_decode($menuBackend->permission, true) : []);

                    return [
                        'title' => $menuBackend->subtitle,
                        //'subtitle' => $menuBackend->subtitle,
                        'icon' => $menuBackend->icon,
                        'tooltip' => $menuBackend->tooltip,
                        'url' => $route ? ADMINURL . generateUrl('/' . $route->uri, $parameters) : null,
                        'route-name' => $route->full_route_name, // 取得完整 route_name
                        'caret' => $menuBackend->caret,
                        'label' => $menuBackend->label,
                        'badge' => $menuBackend->badge,
                        'img' => $menuBackend->img,
                        'permission' => $permissions,
                    ];
                })->values(),
            ];
        });
    }

    /**
     * 新增資料
     *
     * @param Request $request
     * @return void
     */
    public function add(Request $request)
    {
        $data = $request->all();
        $this->create($data);
    }

    /**
     * 編輯資料
     *
     * @param Request $request
     * @return void
     */
    function edit(Request $request)
    {
        $data = $request->all();
        Modules::where('id', '=', $request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'class' => $request->input('class'),
                'uri' => $request->input('uri'),
                'description' => $request->input('description'),
                'indicate' => $request->input('indicate'),
                'notes1' => $request->input('notes1')
            ]);
    }

    /**
     * 删除给定的 ID 或 ID 数组对应的记录
     *
     * @param mixed $ids 单个 ID 或包含多个 ID 的数组
     * @return void
     */
    public function removeByIds($ids): void
    {
        $this->destroy($ids);
    }

    /**
     * 關聯 Routes
     *
     */
    public function routes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Routes::class, 'module_uri', 'uri');
    }

    /**
     * 定義 Modules 與 MenuBackend 之間的關聯（通過 Routes）
     * 遠端模型 , 中介模型 , 中介模型外來鍵 ,遠端模型外來鍵 ,主要模型主鍵 ,中介模型主鍵
     */
    public function menuBackend(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        //return $this->hasOneThrough(Modules::class, Routes::class, 'module_class', 'module_class', 'route_name', 'module_class');
        return $this->hasManyThrough(MenuBackend::class, Routes::class, 'module_uri', 'route_name', 'uri', 'name');
    }

    /**
     * 定義 Modules 與 MenuFrontend 之間的關聯（通過 Routes）
     * 遠端模型 , 中介模型 , 中介模型外來鍵 ,遠端模型外來鍵 ,主要模型主鍵 ,中介模型主鍵
     */
    public function menuFrontend(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        //return $this->hasOneThrough(Modules::class, Routes::class, 'module_class', 'module_class', 'route_name', 'module_class');
        return $this->hasManyThrough(MenuFrontend::class, Routes::class, 'module_uri', 'route_name', 'uri', 'name');
    }

}
