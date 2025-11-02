<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Dfpageitem extends BaseEloquent
{

    protected $table = 'demo_dfpageitem';

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

    public function ajaxAllItemType(Request $request){
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
     * 關聯 Dfpageitem
     *
     * @return void
     */
    public function sub(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Dfpageitem::class, 'subitem_id', 'item_id');
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
     * @param $ids
     * @return void
     */
    public function removeByIds($ids)
    {
        $del_data = [];
        // 取得所有節點item_id
        foreach($ids as $key => $val) {
            // 第一層
            $data = $this->select('*')
                ->where('item_id', '=', $val)
                ->withCount('sub')
                ->first();
            // 刪除的父id
            $del_data[$val]['item_id'] = $data['item_id'];
            $del_data[$val]['endnode'] = $data['endnode'];
            $del_data[$val]['sub_count'] = $data['sub_count'];
            $del_data[$val]['level'] = $data['level'];

            // 更新父節點為根節點
            if($data['subitem_id'] != 0){
                $this->where('item_id', '=', $data['item_id'])
                    ->update([
                        'endnode' => 'child'
                    ]);
            }

            // 第二層
            if($data['sub_count'] > 0){
                $data = $this->select('*')
                    ->where('subitem_id', '=', $val)
                    ->withCount('sub')
                    ->get();

                foreach($data as $key => $val){
                    $del_data = $this->getDel_data($val, $del_data);

                    // 第三層
                    if($val['sub_count'] > 0){
                        $data = $this->select('*')
                            ->where('subitem_id', '=', $val['item_id'])
                            ->withCount('sub')
                            ->get();

                        foreach($data as $key => $val){
                            $del_data = $this->getDel_data($val, $del_data);
                        }
                    }

                }
            }

        }

        // 刪除所有item_id 及 重設文章分類
        foreach($del_data as $key => $val){
            $this->where('item_id', $val['item_id'])->delete();
            $del_article = About::where('type'.($val['level']+1), '=', $val['item_id'])->count();
            if($del_article > 0) {
                About::where('type'.($val['level']+1), '=', $val['item_id'])
                    ->update([
                        'type1' => '-1',
                        'type2' => '-1',
                        'type3' => '-1'
                    ]);
            }
        }
    }

    /**
     * @param $val
     * @param array $del_data
     * @return array
     */
    private function getDel_data($val, array $del_data): array
    {
        $del_data[$val['item_id']]['item_id'] = $val['item_id'];
        $del_data[$val['item_id']]['endnode'] = $val['endnode'];
        $del_data[$val['item_id']]['sub_count'] = $val['sub_count'];
        $del_data[$val['item_id']]['level'] = $val['level'];
        return $del_data;
    }

}

?>
