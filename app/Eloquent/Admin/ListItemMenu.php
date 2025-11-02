<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ListItemMenu extends BaseEloquent
{

    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_listitem';

    public $timestamps = false;

    protected $guarded = ['id'];

    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = ListItemMenu::select('*')
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
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

        $useModuleUri = $request->input('useModuleUri');

        $result = ListItemMenu::select('*')
            ->where('id', '=', $request->input('id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->first();
        //->toArray();

        return $result;
    }

    /**
     * 取得編輯資料
     *
     * @param Request $request
     * @return mixed
     */
    function getByListID(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = ListItemMenu::select('*')
            ->where('module_uri', '=', $useModuleUri)
            ->where('list_id', '=', $request->input('list_id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 根據 parent_id 和指定的層數獲取分類項目 [多層清單編輯使用]
     *
     * @param Request $request 請求對象，包含查詢參數
     * @param int $parentId 父項目 ID
     * @param int $depth 層數
     * @param string $identifierType 使用的識別類型 ('list_id' 或 'list_alias') 值要由
     * $request->input('list_id') / $request->input('list_alias') 讀入
     *
     */
    public function getDepthListMenuByParentId(Request $request, $parentId, $depth, $identifierType)
    {
        $useModuleUri = $request->input('useModuleUri');
        $lang = $request->input('lang') ?? 'zh_TW';
        $userId = $_SESSION['w_userid'];

        // 根據識別類型獲取相應的識別值
        $identifierValue = $identifierType === 'list_id'
            ? $request->input('list_id')
            : $request->input('list_alias');

        // 獲取指定層數的分類項目
        $result =  $this->getMenusByDepth($useModuleUri, $identifierType, $identifierValue, $lang, $userId, $parentId, $depth);

        //dd($result);

        //$this->buildTree($result); dd($result);

        return $result;


    }

    /**
     * 遞迴獲取指定層數的分類項目
     *
     * @param string $moduleUri 模組 URI
     * @param string $identifierType 使用的識別類型 ('list_id' 或 'list_alias')
     * @param string $identifierValue 使用的識別值
     * @param string $lang 語言
     * @param int $userId 用戶 ID
     * @param int $parentId 父項目 ID
     * @param int $depth 深度
     *
     * @return array 返回包含指定層數的分類項目數組
     */
    private function getMenusByDepth($moduleUri, $identifierType, $identifierValue, $lang, $userId, $parentId, $depth): array
    {
        $query = ListItemMenu::where('module_uri', $moduleUri)
            ->where('lang', $lang)
            ->where('userid', $userId)
            ->where('parent_id', $parentId);

        if ($identifierType === 'list_id') {
            $query->where('list_id', $identifierValue);
        } elseif ($identifierType === 'list_alias') {
            $query->where('list_alias', $identifierValue);
        }

        $menus = $query->get()->toArray();

        // 取得父分類項目信息
        $parentMenu = ListItemMenu::where('id', $parentId)->first();

        foreach ($menus as &$menu) {
            // 添加父分類項目信息
            $menu['parent_menu'] = $parentMenu ? $parentMenu->toArray() : null;

            // 計算子分類項目的數量
            $menu['children_count'] = ListItemMenu::where('parent_id', $menu['id'])->count();

            // 如果深度大於1，遞迴獲取子分類項目
            if ($depth > 1) {
                $menu['children'] = $this->getMenusByDepth($moduleUri, $identifierType, $identifierValue, $lang, $userId, $menu['id'], $depth - 1);
            }
        }

        return $menus;
    }

    /**
     * 根據 module_uri、list_alias 和 parent_id 獲取子選項數據
     *
     * @param \Illuminate\Http\Request $request
     * @param string $module_uri 模塊 URI
     * @param string $list_alias 列表別名
     * @param int $parent_id 父項目 ID
     * @return \Illuminate\Http\JsonResponse 返回包含子選項數據的 JSON 響應
     */
    public function getSubMenu(Request $request, string $module_uri, string $list_alias, int $parent_id)
    {
        // 獲取請求中的深度參數和 useModuleUri
        $depth = $request->input('depth');
        $useModuleUri = $request->input('useModuleUri');

        // 查詢符合條件的子選項數據
        $query = ListItemMenu::where('module_uri', $module_uri)
            ->where('lang', $request->input('lang') ?? 'zh_TW')
            ->where('userid', $_SESSION['w_userid'])
            ->where('parent_id', $parent_id)
            ->where('list_alias', $list_alias);

        $children = $query->get(['id', 'itemname']);

        // 返回 JSON 響應
        return response()->json($children);
    }



    /**
     * 根據列表 ID 獲取樹形菜單
     *
     * @param Request $request 請求對象，包含查詢參數
     *
     * @return array 返回構建好的樹形菜單數組
     */
    public function getTreeMeunByListID(Request $request)
    {
        $useModuleUri = $request->input('useModuleUri');

        $result = ListItemMenu::where('module_uri', $useModuleUri)
            ->where('list_id', '=', $request->input('list_id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            /*->with(['listMenu' => function($query) {
                $query->select('id', 'listname', 'alias');
            }])*/
            ->get()
            ->toArray();

        $menu = $this->buildTree($result);

        return $menu;
    }

    /**
     * 根據 $list_alias 取得資料清單
     *
     * @param Request $request
     * @param $list_alias
     * @return mixed
     */
    public function getListItemMenuTypeByAlias(Request $request, $list_alias){

        $useModuleUri = $request->input('useModuleUri');

        $result = $this->select('*')
            ->where('list_alias', '=', $list_alias)
            ->where('module_uri', '=', $useModuleUri)
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->orderBy('sortid', 'ASC')
            ->get();
        //->toArray();

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
        $data = $request->all();

        ListItemMenu::create($data);

        addNotification(renderNotificationTitle('fa fa-bell', 'bg-success', '資料已新增 : '), '', false, 5000, 'gritter-success');

    }

    /**
     * 編輯資料
     *
     * @param Request $request
     * @return void
     */
    function edit(Request $request)
    {
        // 更新記錄
        ListItemMenu::where('id', $request->input('id'))
            ->update([
                'list_id' => $request->input('list_id'),
                'itemname' => $request->input('itemname'),
                'sortid' => $request->input('sortid'),
                'list_alias' => $request->input('list_alias'),
                'indicate' => $request->input('indicate')
            ]);
    }

    /**
     * 更新多筆資料
     *
     * @param Request $request
     * @return void
     */
    public function edits(Request $request)
    {
        foreach($request->input('id') as $key => $val) {
            $this->where('id', '=', $request->input('id')[$key])
                ->update([
                    'list_id' => $request->input('list_id'),
                    'itemname' => $request->input('itemname')[$key],
                    'sortid' => $request->input('sortid')[$key],
                    'list_alias' => $request->input('list_alias')[$key],
                    'indicate' => $request->input('indicate')[$key],
                    'lang' => $request->input('lang')[$key]
                ]);

            addNotification(renderNotificationTitle('fa fa-bell', 'bg-success', '資料更新 : '.$request->input('itemname')[$key]), '', false, 5000, 'gritter-success');
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

        addNotification(renderNotificationTitle('fa fa-bell', 'bg-success', '資料已刪除 : '), '', false, 5000, 'gritter-success');

    }

    /**
     * 關聯 ListMenu
     *
     */
    public function listMenu(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ListMenu::class, 'list_id', 'id');
    }

    /**
     * 關聯 listMenuAlias
     *
     */
    public function listMenuAlias(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ListMenu::class, 'list_alias', 'alias');
    }

    /**
     * 關聯 ListItemMenu
     *
     * @return void
     */
    public function sub(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ListItemMenu::class, 'parent_id', 'id');
    }


}
