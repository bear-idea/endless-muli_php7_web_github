<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuFrontend extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_menu_frontend';

    public $timestamps = false;

    protected $guarded = ['id'];


    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = MenuFrontend::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->with('routes')
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
    function getHomeIconMenu(Request $request){
        $result = MenuFrontend::select('*')
            ->where('is_home', '=', 1)
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->with('routes')
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 根据标题分组获取数据
     *
     * @param Request $request
     * @return mixed
     */
    function getMenuItemsGroupedByTitle(Request $request){
        $results = MenuFrontend::select('*')
            ->where('userid', '=', $_SESSION['w_userid'])
            //->with('routes')
            ->get();

        $groupedResults = $results->groupBy('title');

        return $groupedResults;
    }

    /**
     * 取得編輯資料
     *
     * @param Request $request
     * @return mixed
     */
    function getByID(Request $request): mixed
    {
        $result = MenuFrontend::select('*')
            ->where('id', '=', $request->input('id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->first();
        //->toArray();

        return $result;
    }

    /**
     * 根据 route_name 获取编辑数据
     *
     * @param Request $request
     * @param string $slug
     * @return mixed
     */
    function getByMoudleUri(Request $request, $module_uri)
    {
        $result = Routes::select('*')
            ->where('module_uri', '=', $module_uri) /* $module_uri 由網址帶入 */
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->with('menuBackend')
            ->get();

        return $result;
    }

    /**
     * 根据 routeName 获取 routeInfo
     *
     * @param Request $request
     * @param string $slug
     * @return mixed
     */
    function getCurrentRouteInfo(Request $request)
    {
        $routeInfo = getRoutePrefixAndName($request);
        $prefix = $routeInfo['prefix']; // 取得路由的前綴
        $name = $routeInfo['name']; // 取得路由的名稱

        //$request->merge(['route_name' => $name]);

        $result = MenuFrontend::select('*')
            ->where('route_name', '=', $name) // 使用 slug 来查询
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->with('routes')
            ->first();

        return $result;
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
        MenuFrontend::where('id', '=', $request->input('id'))
            ->update([
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'url' => $request->input('url'),
                'icon' => $request->input('icon'),
                'img' => $request->input('img'),
                'label' => $request->input('label'),
                'badge' => $request->input('badge'),
                'tooltip' => $request->input('tooltip'),
                'route_name' => $request->input('route_name'),
                'permission' => $request->input('permission'),
                'caret' => $request->input('caret'),
                'highlight' => $request->input('highlight'),
                'sub_menu' => $request->input('sub_menu'),
                'postdate' => $request->input('postdate'),
                'indicate' => $request->input('indicate')
            ]);
    }

    /**
     * 複增資料
     *
     * @param Request $request
     * @return void
     */
    function mutiCopy(Request $request)
    {
        $data = $request->all();

        // 將標題、URI 和控制器動作字段用逗號分隔成多個值
        $titles = array_map('trim', explode(',', $data['title']));
        $subtitles = array_map('trim', explode(',', $data['subtitle']));
        $route_names = array_map('trim', explode(',', $data['route_name']));
        $icons = array_map('trim', explode(',', $data['icon']));

        // 確保這三個字段的分隔數量相同
        if (count($titles) !== count($subtitles) || count($titles) !== count($route_names)) {
            $_SESSION['errorMessages'] = json_encode(['type' => 'error', 'title' => '選單標題、子選單標題、圖示和路由名稱的數量必須相同。']);
            //exit(); // 确保之后的代码不会继续执行
        }else{

            // 遍歷每個值並插入數據
            foreach ($titles as $index => $title) {

                // 準備插入數據
                $insertData = [
                    'title' => $title,
                    'subtitle' => $subtitles[$index],
                    'route_name' => $route_names[$index],
                    'icon' => $icons[$index],
                    'indicate' => $request->input('indicate')
                ];

                // 創建新的數據記錄
                MenuFrontend::create($insertData);
            }
        }

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
     * 遞迴更新菜單項目順序
     *
     * 此方法會遍歷給定的菜單項目陣列，並更新每個項目的 parent_id 和 position。
     * 如果該項目有子項目，會遞迴更新其子項目的順序和父子關係。
     *
     * @param array $items 菜單項目的陣列
     * @param int $parentId 父菜單項目的 ID，預設為 0
     * @return void
     */
    public static function updateMenuOrderRecursively($items, $parentId = 0)
    {
        foreach ($items as $position => $item) {
            $menuBackend = self::find($item['id']);
            if ($menuBackend) {
                $menuBackend->update([
                    'parent_id' => $parentId,
                    'sortid' => $position
                ]);

                if (isset($item['children'])) {
                    self::updateMenuOrderRecursively($item['children'], $menuBackend->id);
                }
            }
        }
    }

    /**
     * 遞迴取得所有菜單項目及其子菜單項目
     *
     * @param \Illuminate\Support\Collection $items 菜單項目的集合
     * @param callable $callback 用於更新菜單項目的回調函數
     * @return \Illuminate\Support\Collection 包含所有子菜單的菜單項目集合
     */
    public static function fetchMenuItems($items, callable $callback = null)
    {
        foreach ($items as $item) {
            if ($item->children()->exists()) {
                $item->children = self::fetchMenuItems($item->children()->orderBy('sortid', 'asc')->get(), $callback);
            }
            // 使用回調函數更新標題
            if ($callback) {
                $callback($item);
            }
        }

        return $items;
    }

    /**
     * 取得父菜單項目
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parent()
    {
        return $this->belongsTo(MenuFrontend::class, 'parent_id');
    }

    /**
     * 取得子菜單項目
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(MenuFrontend::class, 'parent_id');
    }

    /**
     * 關聯 Routes
     *
     */
    public function routes(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Routes::class, 'name', 'route_name');
    }

    /**
     * 定義 MenuFrontend 與 Modules 之間的關聯（通過 Routes）
     * 遠端模型 , 中介模型 , 中介模型外來鍵 ,遠端模型外來鍵 ,主要模型主鍵 ,中介模型主鍵
     */
    public function modules(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        //return $this->hasOneThrough(Modules::class, Routes::class, 'module_class', 'module_class', 'route_name', 'module_class');
        return $this->hasOneThrough(Modules::class, Routes::class, 'name', 'uri', 'route_name', 'module_uri');
    }

}
