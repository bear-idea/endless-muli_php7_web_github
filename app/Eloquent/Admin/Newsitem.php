<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Newsitem extends BaseEloquent
{
    protected $table = 'demo_newsitem';

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
            ->where('userid', '=', $_SESSION['w_userid'])
            ->get();
    }

    /**
     * 取得分類資料清單
     *
     * @param Request $request
     * @return mixed
     *
     */
    public function getItemType(Request $request){
        $result = $this->select('*')
            ->where('list_id', '=', '1')
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->orderBy('sortid', 'ASC')
            ->get();
            //->toArray();

        return $result;
    }

    /**
     * 取得作者資料清單
     *
     * @param Request $request
     * @return mixed
     */
    public function getItemAuthor(Request $request){
        $result = $this->select('*')
            ->where('list_id', '=', '2')
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
    public function add(Request $request)
    {
        $data = $request->all();
        $this->create($data);
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
        //dd($request);
        foreach($request->input('item_id') as $key => $val) {
            $this->where('item_id', '=', $request->input('item_id')[$key])
                ->update([
                    'list_id' => $request->input('list_id'),
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
        $this->whereIn('item_id', $ids)->delete();
    }
}
