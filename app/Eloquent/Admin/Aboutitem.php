<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Aboutitem extends BaseEloquent
{

    protected $table = 'demo_aboutitem';

    public $timestamps = false;

    protected $guarded = ['item_id'];

    /**
     * 取得項目資料
     *
     * @param Request $request
     * @return mixed
     */
    public function getItemByList(Request $request){
        return $this->select('*')
            ->where('list_id', '=', $request->input('list_id'))
            ->where('lang', '=',  $_SESSION['lang'])
            ->where('level', '=', $request->input('level') ?? 0)
            ->where('userid', '=', $_SESSION['w_userid'])
            ->with('sub')
            ->withCount('sub')
            ->get();
    }

    /**
     * 取得分類資料
     *
     * @param Request $request
     * @return mixed
     */
    public function getItemType(Request $request){
        return $this->select('*')
            ->where('list_id', '=', '1')
            ->where('lang', '=', $_SESSION['lang'])
            ->where('level', '=', $request->input('level') ?? 0)
            ->where('userid', '=', $_SESSION['w_userid'])
            ->get();
    }

    /**
     * 獲取所有項目類型及其子項目
     *
     * 這個函數根據特定的過濾條件來獲取所有項目類型及其子項目。
     * 過濾條件包括：列表ID、語言、等級和用戶ID。
     *
     * @param Request $request 包含過濾條件的請求物件
     * @return \Illuminate\Database\Eloquent\Collection 包含項目類型及其子項目的集合
     */
    public function getItemTypesWithSubItems(Request $request){
        return $this->select('*')
            ->where('list_id', '=', '1')
            ->where('lang', '=', $_SESSION['lang'])
            ->where('level', '=', $request->input('level') ?? 0)
            ->where('userid', '=', $_SESSION['w_userid'])
            ->with(array('sub' => function($query) {
                $query->with('sub');
            }))
            ->withCount('sub')
            ->get();
    }

    /**
     * 關聯 Aboutitem
     *
     * @return void
     */
    public function sub(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Aboutitem::class, 'subitem_id', 'item_id');
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

        // 更新父節點 目前新增為子節點
        $this->where('item_id', '=', $request->input('item_id'))
            ->update([
                'endnode' => 'parent'
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
        //$data = $request->all();
        foreach($request->input('item_id') as $key => $val) {
            $this->where('item_id', '=', $request->input('item_id')[$key])
                ->update([
                    'list_id' => $request->input('list_id')[$key],
                    'sortid' => $request->input('sortid')[$key],
                    'indicate' => $request->input('indicate')[$key],
                    'itemname' => $request->input('itemname')[$key],
                    'lang' => $request->input('lang')[$key]
                ]);
        }
    }

    /**
     * 刪除多筆資料
     *
     * @param array $ids 要刪除的項目 ID 列表
     * @return void
     */
    public function removeByIds(array $ids)
    {
        // 取得要刪除的所有節點，包括其子節點
        $delData = $this->getAllDescendants($ids);

        // 刪除所有項目
        $this->whereIn('item_id', array_column($delData, 'item_id'))->delete();

        // 更新相關的文章分類
        foreach ($delData as $data) {
            About::where('type' . ($data['level'] + 1), '=', $data['item_id'])
                ->update(['type1' => '-1', 'type2' => '-1', 'type3' => '-1']);
        }
    }

    /**
     * 取得所有需要刪除的節點及其子節點
     *
     * @param array $ids 要刪除的項目 ID 列表
     * @return array 包含所有要刪除的節點資料
     */
    private function getAllDescendants(array $ids)
    {
        $delData = [];
        $queue = $ids;

        while (!empty($queue)) {
            $currentId = array_shift($queue);

            // 取得當前節點資料
            $nodeData = $this->select('*')
                ->where('item_id', $currentId)
                ->withCount('sub')
                ->first();

            if ($nodeData) {
                $itemId = $nodeData['item_id'];
                $delData[$itemId] = [
                    'item_id' => $itemId,
                    'endnode' => $nodeData['endnode'],
                    'sub_count' => $nodeData['sub_count'],
                    'level' => $nodeData['level']
                ];

                // 如果有子節點，將子節點加入隊列
                if ($nodeData['sub_count'] > 0) {
                    $subNodes = $this->select('*')
                        ->where('subitem_id', $currentId)
                        ->withCount('sub')
                        ->get();

                    foreach ($subNodes as $subNode) {
                        $queue[] = $subNode['item_id']; // 將子節點 ID 加入隊列
                    }
                }
            }
        }

        return $delData;
    }

}
