<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;

class Actnews extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_actnews';

    public $timestamps = false;

    protected $guarded = ['id'];


    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = Actnews::select('*')
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
        $result = Actnews::select('*')
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
    function insert(Request $request, $filename)
    {
        $data = $request->all();

        $actnews = Actnews::create($data);

        $newId = $actnews->id;

        Actnews::where('id', '=', $newId)
            ->update([
                'pic' => $filename
            ]);

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
        Actnews::where('id', '=', $request->input('id'))
            ->update([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'type' => $request->input('type'),
                'content' => $request->input('content'),
                'postdate' => $request->input('postdate'),
                'indicate' => $request->input('indicate'),
                'sdescription' => $request->input('sdescription'),
                'skeyword' => $request->input('skeyword'),
                'skeywordindicate' => $request->input('skeywordindicate'),
                'pushtop' => $request->input('pushtop'),
                'notes1' => $request->input('notes1')
            ]);
    }

    /**
     * 編輯資料
     *
     * @param Request $request
     * @return void
     */
    function editWithImages(Request $request, $file, $uploadDirName)
    {
        // 找到對應 ID 的所有記錄
        $record = Actnews::select('*')
            ->where('id', '=', $request->input('id'))
            ->first();

        $wshop = $request->input('wshop');

        $filePath = SITEPATH . DIRECTORY_SEPARATOR . $wshop . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . $uploadDirName . DIRECTORY_SEPARATOR . $record->pic;
        $thumbPath = SITEPATH . DIRECTORY_SEPARATOR . $wshop . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . $uploadDirName . DIRECTORY_SEPARATOR . "thumb" . DIRECTORY_SEPARATOR . "small_" . $record->pic;

        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        if (file_exists($thumbPath)) {
            @unlink($thumbPath);
        }

        $data = $request->all();
        Actnews::where('id', '=', $request->input('id'))
            ->update([
                'pic' => $file
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
        // 刪除數據庫中的記錄
        $this->destroy($ids);
    }

    /**
     * 删除给定的 ID 或 ID 数组对应的记录及圖片
     *
     * @param mixed $ids 单个 ID 或包含多个 ID 的数组
     * @param $wshop 域名
     * @param $uploadDirName 儲存資料夾名稱
     * @return void
     */
    public function removeWithImagesByIds($ids, $wshop, $uploadDirName): void
    {
        // 找到對應 ID 的所有記錄
        $records = $this->whereIn('id', (array)$ids)->get();

        // 刪除文件
        foreach ($records as $record) {
            $filePath = SITEPATH . DIRECTORY_SEPARATOR . $wshop . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . $uploadDirName . DIRECTORY_SEPARATOR . $record->pic;
            $thumbPath = SITEPATH . DIRECTORY_SEPARATOR . $wshop . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . $uploadDirName . DIRECTORY_SEPARATOR . "thumb" . DIRECTORY_SEPARATOR . "small_" . $record->pic;

            if (file_exists($filePath)) {
                @unlink($filePath);
            }

            if (file_exists($thumbPath)) {
                @unlink($thumbPath);
            }
        }

        // 刪除數據庫中的記錄
        $this->destroy($ids);
    }


}
