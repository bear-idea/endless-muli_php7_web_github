<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Admin\ListItemMenu;
use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ListMenu extends BaseEloquent
{

    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_list';

    public $timestamps = false;

    protected $guarded = ['id'];

    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = ListMenu::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            //->where('userid', '=', $_SESSION['w_userid'])
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
        $id = $request->input('id');

        $result = ListMenu::select('*')
            ->where('id', '=', $id)
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            //->where('userid', '=', $_SESSION['w_userid'])
            ->with('listItemMenu')
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
    function getBylistID(Request $request){

        $useModuleUri = $request->input('useModuleUri');
        $id = $request->input('list_id');

        $result = ListMenu::select('*')
            ->where('id', '=', $id)
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            //->where('userid', '=', $_SESSION['w_userid'])
            ->with('listItemMenu')
            ->first();
        //->toArray();

        return $result;
    }

    /**
     * 取得目前頁面該模組清單列表
     *
     * @param Request $request
     * @return mixed
     */
    function getByMoudleUri(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = ListMenu::select('*')
            ->where('module_uri', '=', $useModuleUri)
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            //->where('userid', '=', $_SESSION['w_userid'])
            ->withCount('listItemMenu')
            ->orderBy('sortid', 'asc')
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
    function add(Request $request): void
    {
        // 獲取所有請求數據
        $data = $request->all();
        $useModuleUri = $request->input('useModuleUri');

        // 創建主表記錄
        $insert = ListMenu::create($data);

        // 確保 'listitem' 是有效的數組
        $items = $data['listitem'] ?? [];

        // 檢查是否有需要插入的數據
        if (!empty($items['itemname'])) {
            // 提取各個字段數據
            $itemNames = $items['itemname'];
            $sortIds = $items['sortid'] ?? [];
            $langs = $items['lang'] ?? [];
            $userIds = $items['userid'] ?? [];
            $indicates = $items['indicate'] ?? [];

            // 確保所有字段的數量一致
            $itemCount = count($itemNames);

            // 準備要插入的數據
            $listItemData = [];
            for ($i = 0; $i < $itemCount; $i++) {
                $listItemData[] = [
                    'list_id' => $insert->id,
                    'list_alias' => $request->input('alias'),
                    'module_uri' => $request->input('module_uri'),
                    'itemname' => $itemNames[$i] ?? null,
                    'sortid' => $sortIds[$i] ?? null,
                    'lang' => $langs[$i] ?? 'zh_TW',
                    'userid' => $userIds[$i] ?? 1,
                    'indicate' => $indicates[$i] ?? null,
                ];
            }

            // 批量插入資料
            ListItemMenu::insert($listItemData);
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
        $useModuleUri = $request->input('useModuleUri');

        // 更新記錄
        ListMenu::where('id', $request->input('id'))
            ->update([
                'listname' => $request->input('listname'),
                'pattern' => $request->input('pattern'),
                'description' => $request->input('description'),
                'module_uri' => $request->input('module_uri'),
                'indicate' => $request->input('indicate')
            ]);

        // 確保 'listitem' 是有效的數組
        $items = $request->input('listitem', []);
        $itemNames = $items['itemname'] ?? [];

        if (is_array($itemNames) && !empty($itemNames) && count($itemNames) === count(array_filter($itemNames))) {

            $itemNames = $items['itemname'];
            $sortIds = $items['sortid'] ?? [];
            $langs = $items['lang'] ?? [];
            $userIds = $items['userid'] ?? [];
            $indicates = $items['indicate'] ?? [];
            $itemIds = $items['id'] ?? []; // 假設有 'id' 字段用於識別每個項目

            // 確保所有字段的數量一致
            $itemCount = count($itemNames);

            // 清除現有的子項目資料（根據主表 id）
            ListItemMenu::where('list_id', $request->input('id'))->delete();

            // 準備要插入的數據
            $listItemData = [];
            for ($i = 0; $i < $itemCount; $i++) {
                $listItemData[] = [
                    'list_id' => $request->input('id'),
                    'list_alias' => $request->input('alias'),
                    'module_uri' => $request->input('module_uri'),
                    'itemname' => $itemNames[$i] ?? null,
                    'sortid' => $sortIds[$i] ?? null,
                    'lang' => $langs[$i] ?? 'zh_TW',
                    'userid' => $userIds[$i] ?? 1,
                    'indicate' => $indicates[$i] ?? null,
                ];
            }

            // 批量插入資料
            ListItemMenu::insert($listItemData);
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
     * 關聯 Modules
     *
     */
    public function modules(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Modules::class, 'uri', 'module_uri');
    }

    /**
     * 關聯 ListItemMenu
     *
     */
    public function listItemMenu(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ListItemMenu::class, 'list_id', 'id');
    }

    /**
     * 關聯 ListItemMenu
     *
     */
    public function listItemMenuAlias(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ListItemMenu::class, 'list_alias', 'alias');
    }

}
