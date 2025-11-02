<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Routes extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_routes';

    public $timestamps = false;

    protected $guarded = ['id'];

    /**
     * 告訴 Eloquent 包含 full_route_name
     *
     * @var array
     */
    protected $appends = ['full_route_name'];

    /**
     * 定義一個 accessor 來生成完整的 route_name
     *
     * @return string
     */
    public function getFullRouteNameAttribute()
    {
        // 如果 prefix 不為空，則加上 prefix 和點號，否則只返回 name
        return $this->prefix ? $this->prefix . '.' . $this->name : $this->name;
    }


    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = Routes::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 根據前綴和當前用戶的 ID 從數據庫中檢索路由。
     *
     * @param \Illuminate\Http\Request $request HTTP 請求對象。
     * @param string $prefix 路由前綴。
     * @return \Illuminate\Database\Eloquent\Collection 返回包含符合條件的路由的集合。
     */
    function getByPrefix(Request $request, $prefix = ''){
        $result = Routes::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('prefix', '=', $prefix)
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->get();
        //->toArray();

        return $result;
    }

    function getByRouteName(Request $request){

        $routeInfo = getRoutePrefixAndName($request);
        $prefix = $routeInfo['prefix']; // 取得路由的前綴
        $name = $routeInfo['name']; // 取得路由的名稱

        $result = Routes::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('name', '=', $name)
            ->where(function ($query) {
                $query->where('userid', '=', $_SESSION['w_userid'])
                    ->orWhere('userid', '=', '1');
            })
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 取得編輯資料
     *
     * @param Request $request
     * @return mixed
     */
    function getByID(Request $request){
        $result = Routes::select('*')
            ->where('id', '=', $request->input('id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->first();
        //->toArray();

        return $result;
    }

    /**
     * 根据 slug 获取编辑数据
     *
     * @param Request $request
     * @param string $slug
     * @return mixed
     */
    function getBySlug(Request $request)
    {
        $result = Routes::select('*')
            ->where('slug', '=', $request->input('slug')) // 使用 slug 来查询
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->first();

        return $result;
    }

    /**
     * 根据 module_uri 获取编辑数据
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
            ->get();

        return $result;
    }

    /**
     * 新增資料
     *
     * @param Request $request
     * @return void
     */
    function add(Request $request)
    {
        // 獲取所有請求數據
        $data = $request->all();

        // 將標題、URI 和控制器動作字段用逗號分隔成多個值
        $names = array_map('trim', explode(',', $data['name']));
        $uris = array_map('trim', explode(',', $data['uri']));
        $controllerActions = array_map('trim', explode(',', $data['controller_action']));

        // 確保這三個字段的分隔數量相同
        if (count($names) !== count($uris) || count($names) !== count($controllerActions)) {
            $_SESSION['errorMessages'] = json_encode(['type' => 'error', 'title' => '標題、URI 和控制器動作的數量必須相同。']);
            //exit(); // 确保之后的代码不会继续执行
        }else{

            // 遍歷每個值並插入數據
            foreach ($names as $index => $name) {

                // 準備插入數據
                $insertData = [
                    'name' => ($request->input('prefix') ? $request->input('prefix') . '.' : '') . toSpinalCase($request->input('module_uri')) . '.' . $name,
                    'prefix' => $request->input('prefix'),
                    'uri' => (toSpinalCase($request->input('module_uri')) && $uris[$index] !== '/' ? toSpinalCase($request->input('module_uri')) . '/' : '') . ($uris[$index] !== '/' ? $uris[$index] : ''),
                    'controller_name' => $request->input('controller_name'),
                    'controller_action' => $controllerActions[$index],
                    'methods' => $request->input('methods'),
                    'module_class' => $request->input('module_class'),
                    'user_group' => $request->input('user_group'),
                    'module_uri' => $request->input('module_uri'),
                    'postdate' => $request->input('postdate'),
                    'indicate' => $request->input('indicate'),
                    'notes1' => $request->input('notes1')
                ];

                // 創建新的數據記錄
                Routes::create($insertData);
            }
        }
    }

    /**
     * 複增資料
     *
     * @param Request $request
     * @return void
     */
    function copy(Request $request)
    {
        $data = $request->all();

        // 將標題、URI 和控制器動作字段用逗號分隔成多個值
        $names = array_map('trim', explode(',', $data['name']));
        $uris = array_map('trim', explode(',', $data['uri']));
        $controllerActions = array_map('trim', explode(',', $data['controller_action']));

        // 確保這三個字段的分隔數量相同
        if (count($names) !== count($uris) || count($names) !== count($controllerActions)) {
            $_SESSION['errorMessages'] = json_encode(['type' => 'error', 'title' => '標題、URI 和控制器動作的數量必須相同。']);
            //exit(); // 确保之后的代码不会继续执行
        }else{

            // 遍歷每個值並插入數據
            foreach ($names as $index => $name) {

                // 準備插入數據
                $insertData = [
                    'name' => ($request->input('prefix') ? $request->input('prefix') . '.' : '') . toSpinalCase($request->input('module_uri')) . '.' . $name,
                    'prefix' => $request->input('prefix'),
                    'uri' => (toSpinalCase($request->input('module_uri')) && $uris[$index] !== '/' ? toSpinalCase($request->input('module_uri')) . '/' : '') . ($uris[$index] !== '/' ? $uris[$index] : ''),
                    'controller_name' => $request->input('controller_name'),
                    'controller_action' => $controllerActions[$index],
                    'methods' => $request->input('methods'),
                    'module_class' => $request->input('module_class'),
                    'user_group' => $request->input('user_group'),
                    'module_uri' => $request->input('module_uri'),
                    'postdate' => $request->input('postdate'),
                    'indicate' => $request->input('indicate'),
                    'notes1' => $request->input('notes1')
                ];

                // 創建新的數據記錄
                Routes::create($insertData);
            }
        }

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

        Routes::where('id', '=', $request->input('id'))
            ->update([
                'name' => ($request->input('prefix') ? $request->input('prefix') . '.' : '') . toSpinalCase($request->input('module_uri')) . '.' . $request->input('name_edit'),
                'prefix' => $request->input('prefix'),
                'uri' => ($uriEdit = $request->input('uri_edit')) == '/' || $uriEdit == '' ? toSpinalCase($request->input('module_uri')) : toSpinalCase($request->input('module_uri')) . ($uriEdit !== '/' ? '/' . $uriEdit : ''),
                'controller_name' => $request->input('controller_name'),
                'controller_action' => $request->input('controller_action'),
                'methods' => $request->input('methods'),
                'module_class' => $request->input('module_class'),
                'user_group' => $request->input('user_group'),
                'module_uri' => $request->input('module_uri'),
                'postdate' => $request->input('postdate'),
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
     * 定義 Routes 與 MenuBackend 之間的關聯
     *
     */
    public function menuBackend()
    {
        return $this->hasOne(MenuBackend::class, 'route_name', 'name');
    }

    /**
     * 定義 Routes 與 MenuFrontend 之間的關聯
     *
     */
    public function menuFrontend()
    {
        return $this->hasOne(MenuFrontend::class, 'route_name', 'name');
    }

    /**
     * 定義 Routes 與 Modules 之間的關聯
     *
     */
    public function modules()
    {
        return $this->hasOne(Modules::class, 'uri', 'module_uri');
    }



}
