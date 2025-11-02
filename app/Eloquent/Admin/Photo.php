<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Photo extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_photo';

    public $timestamps = false;

    protected $guarded = ['id'];


    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = Photo::select('*')
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
        $result = Photo::select('*')
            ->where('id', '=', $request->input('id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->first();
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

        Photo::create($data);
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
        Photo::where('id', '=', $request->input('id'))
            ->update([
                'pic' => $request->input('ogtitle'),
                'photodescription' => $request->input('photodescription'),
                'postdate' => $request->input('postdate'),
                'indicate' => $request->input('indicate'),
                'notes1' => $request->input('notes1'),
                'notes2' => $request->input('notes2'),
                'sortid' => $request->input('sortid'),
                'lang' => $request->input('lang'),
                'userid' => $request->input('userid')
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
     * 删除给定的 ID 或 ID 数组对应的记录及图片
     *
     * @param mixed $ids 单个 ID 或包含多个 ID 的数组
     * @param string $wshop 域名
     * @param string $uploadDirName 存储文件夹名称
     * @param string $useModuleUri 目前頁面使用模組
     * @return void
     */
    public function removeWithImagesByIds($ids, $wshop, $uploadDirName, $useModuleUri): void
    {
        // 找到對應 ID 的所有記錄
        $records = $this->whereIn('module_id', (array)$ids)->where('module_uri', $useModuleUri)->get();

        // 使用 pluck 方法來獲取所有要刪除的記錄的 id
        $recordIds = $records->pluck('id')->toArray();

        // 確定上傳目錄
        $uploadDir = SITEPATH . DIRECTORY_SEPARATOR . $wshop . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . $uploadDirName;

        // 刪除舊的文件記錄
        $this->deleteFiles($records, $uploadDir, 'pic'); // 'pic' 是文件字段名

        // 刪除數據庫中的記錄
        $this->destroy($recordIds);

    }


}
