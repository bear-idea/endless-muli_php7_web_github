<?php
namespace App\Eloquent;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Routes extends BaseEloquent
{
    use LikeScope;

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
                $query->where('userid', '=', $_SESSION['userid'])
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
                $query->where('userid', '=', $_SESSION['userid'])
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
                $query->where('userid', '=', $_SESSION['userid'])
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
            ->where('userid', '=', $_SESSION['userid'])
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
            ->where('userid', '=', $_SESSION['userid'])
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
            ->where('userid', '=', $_SESSION['userid'])
            ->get();

        return $result;
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
     * 定義 Routes 與 Modules 之間的關聯
     *
     */
    public function modules()
    {
        return $this->hasOne(Modules::class, 'uri', 'module_uri');
    }



}
