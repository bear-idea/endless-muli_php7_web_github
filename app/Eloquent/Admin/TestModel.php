<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestModel extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_testmodel';

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

        $result = TestModel::select('*')
            ->where('module_uri', $useModuleUri)
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

        $result = TestModel::select('*')
            ->where('module_uri', $useModuleUri)
            ->where('id', '=', $request->input('id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->with(['metas' => function ($query) use ($useModuleUri) {
                $query->forModuleUri($useModuleUri);
            }])
            ->with(['photos' => function ($query) use ($useModuleUri) {
                $query->forModuleUri($useModuleUri);
            }])
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

        $useModuleUri = $request->input('useModuleUri');

        $result = TestModel::select('*')
            ->where('module_uri', $useModuleUri)
            ->where('slug', '=', $request->input('slug')) // 使用 slug 来查询
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->with(['metas' => function ($query) use ($useModuleUri) {
                $query->forModuleUri($useModuleUri);
            }])
            ->first();

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
        $useModuleUri = $request->input('useModuleUri');

        //$request->merge(['multi_type' => json_encode($request->input('multi_type'))]);

        /*$data['type'] = array_merge($data['type'] ?? [], [
            'multi_type' => json_encode($request->input('multi_type')),
        ]);*/

        $data['multi_type'] = json_encode($request->input('multi_type'));

        // 新增 TestModel 資料
        $insert = TestModel::create($data);

        // 新增 Meta 資料
        $metaData = [
            'module_id' => $insert->id,
            'module_uri' => $useModuleUri,
            'ogtitle' => $data['ogtitle'] ?? null,
            'ogtype' => $data['ogtype'] ?? null,
            'ogurl' => $data['ogurl'] ?? null,
            'ogsite_name' => $data['ogsite_name'] ?? null,
            'ogdescription' => $data['ogdescription'] ?? null,
            'sdescription' => $data['sdescription'] ?? null,
            'skeyword' => $data['skeyword'] ?? null,
            'skeywordindicate' => $data['skeywordindicate'] ?? 1,
            'lang' => $data['lang'] ?? 'zh_TW',
            'userid' => $data['userid'] ?? 1,
        ];
        Meta::create($metaData);

        // 處理 ogimage 上傳
        if ($request->hasFile('ogimage')) {
            $this->handleMetaFileUpload($request, 'ogimage', $insert->id, $request->input('module_uri'));
        }

        // 處理 pic 上傳
        if ($request->hasFile('pic')) {
            $this->handlePhotoFileUpload($request, 'pic', $insert->id, $request->input('module_uri'));
        }
    }


    /**
     * 編輯資料
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
        $data = $request->all();
        $useModuleUri = $request->input('useModuleUri');

        // 更新 TestModel 資料
        TestModel::where('id', $request->input('id'))
            ->update([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'type' => $request->input('type'),
                'content' => $request->input('content'),
                'postdate' => $request->input('postdate'),
                'indicate' => $request->input('indicate'),
                'pushtop' => $request->input('pushtop'),
                'notes1' => $request->input('notes1'),
            ]);

        // 更新 Meta 資料
        Meta::where('module_id', $request->input('id'))
            ->where('module_uri', $useModuleUri)
            ->update([
                'ogtitle' => $request->input('ogtitle'),
                'ogtype' => $request->input('ogtype'),
                'ogurl' => $request->input('ogurl'),
                'ogsite_name' => $request->input('ogsite_name'),
                'ogdescription' => $request->input('ogdescription'),
                'sdescription' => $request->input('sdescription'),
                'skeyword' => $request->input('skeyword'),
                'skeywordindicate' => $request->input('skeywordindicate'),
            ]);

        // 處理 ogimage 上傳
        if ($request->hasFile('ogimage') && $request->file('ogimage')->isValid()) {
            $this->handleMetaFileUpload($request, 'ogimage', $request->input('id'), $useModuleUri);
        }

        // 處理 pic 上傳
        if ($request->hasFile('pic') && $request->file('pic')->isValid()) {
            $this->handlePhotoFileUpload($request, 'pic', $request->input('id'), $useModuleUri);
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
     * 關聯 Meta
     * 需搭配 scopeforModuleUri($query, $moduleUri)
     *
     */
    public function metas(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Meta::class, 'module_id', 'id');
    }

    /**
     * 關聯 Photos
     * 需搭配 scopeforModuleUri($query, $moduleUri)
     *
     */
    public function photos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Photo::class, 'module_id', 'id');
    }

}
