<?php
namespace App\Eloquent;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuManagement extends BaseEloquent
{
    use LikeScope;

    protected $table = 'demo_menu_management';

    public $timestamps = false;

    protected $guarded = ['id'];


    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = MenuManagement::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['userid'])
            //->with('routes')
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 取得多層主選單資料
     *
     * 此函式根據使用者 ID 從 `MenuManagement` 資料表中取得主選單及其子選單的所有項目，並組合成多層選單結構。
     *
     * @param Request $request 用於接收 HTTP 請求的物件
     * @return array  回傳包含多層選單結構的陣列
     */
    function getMainMenu(Request $request)
    {
        // 取得所有主選單資料
        $mainMenus = MenuManagement::select('*')
            ->where('type', '=', 'MainMenu')
            ->where('userid', '=', $_SESSION['userid'])
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->with('routes')
            ->get()
            ->toArray();

        foreach ($mainMenus as &$menu) {
            // 假設 'routes' 包含模組的 URI
            $moduleUri = $menu['routes']['module_uri'] ?? null;

            if ($moduleUri) {
                // 取得對應的子選單
                $menu['submenu'] = $this->getSubMenu($moduleUri);
            }
        }

        return $mainMenus;
    }

    /**
     * 取得子選單資料
     *
     * @param string $moduleUri 模組識別名
     * @return array  回傳包含子選單的陣列
     */
    function getSubMenu($moduleUri)
    {
        //$RecordSlideMenu = (new $classSlideMenu)->getListItemMenuTypeByAlias($request, 'Type', 'News');
        $classSlideMenu = 'App\\Eloquent\\ListItemMenu';
        $allItems = (new $classSlideMenu)
            ->where('module_uri', '=', $moduleUri)
            ->where('userid', '=', $_SESSION['userid'])
            ->where('lang', '=', $_SESSION['lang'])
            ->orderBy('sortid')
            ->get()
            ->toArray();

        return $this->buildTree($allItems);
    }

    /**
     * 將子選單資料轉換為樹狀結構
     *
     * @param array &$items 從資料庫取得的子選單項目（使用參考）
     * @param int $parentId 父項目 ID
     * @return array  回傳樹狀結構的選單
     */
    function buildTree(array &$items, $parentId = 0)
    {
        $branch = array();

        foreach ($items as &$item) {
            if ($item['parent_id'] == $parentId) {
                $children = $this->buildTree($items, $item['id']);
                if ($children) {
                    $item['submenu'] = $children;
                }
                $branch[] = $item;
            }
        }

        return $branch;
    }

    /**
     * 取得父菜單項目
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parent()
    {
        return $this->belongsTo(MenuManagement::class, 'parent_id');
    }

    /**
     * 取得子菜單項目
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(MenuManagement::class, 'parent_id');
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
     * 定義 MenuManagement 與 Modules 之間的關聯（通過 Routes）
     * 遠端模型 , 中介模型 , 中介模型外來鍵 ,遠端模型外來鍵 ,主要模型主鍵 ,中介模型主鍵
     */
    public function modules(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        //return $this->hasOneThrough(Modules::class, Routes::class, 'module_class', 'module_class', 'route_name', 'module_class');
        return $this->hasOneThrough(Modules::class, Routes::class, 'name', 'uri', 'route_name', 'module_uri');
    }

}
