<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Meta extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_meta';

    public $timestamps = false;

    protected $guarded = ['id'];


    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = Meta::select('*')
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
        $result = Meta::select('*')
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

        Meta::create($data);
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
        Meta::where('id', '=', $request->input('id'))
            ->update([
                'ogtitle' => $request->input('ogtitle'),
                'ogtype' => $request->input('ogtype'),
                'ogurl' => $request->input('ogurl'),
                'ogimage' => $request->input('ogimage'),
                'ogsite_name' => $request->input('ogsite_name'),
                'ogdescription' => $request->input('ogdescription'),
                'sdescription' => $request->input('sdescription'),
                'skeyword' => $request->input('skeyword'),
                'skeywordindicate' => $request->input('skeywordindicate')
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
        $this->deleteFiles($records, $uploadDir, 'ogimage'); // 'pic' 是文件字段名

        // 刪除數據庫中的記錄
        $this->destroy($recordIds);

    }

}
