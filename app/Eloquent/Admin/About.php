<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class About
 * @package App\Eloquent\Admin
 */
class About extends BaseEloquent
{

    use LikeScope;
    use DatatablesTraits;
    /**
     * @var string
     */
    protected $table = 'demo_about';

    public $timestamps = false;

    protected $guarded = ['id'];

    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    public function getAll(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = $this->select('*')
            ->where('module_uri', $useModuleUri)
            ->where('lang', '=', $_SESSION['lang'])
            ->where('userid', '=', $_SESSION['w_userid'])
            ->get();

        return $result;
    }

    /**
     * 取得編輯資料
     *
     * @param Request $request
     * @return mixed
     */
    public function getByID(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = $this->select('*')
            ->where('module_uri', $useModuleUri)
            ->where('id', '=', $request->input('id'))
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
    public function add(Request $request): void
    {
        $data = $request->all();

        $useModuleUri = $request->input('useModuleUri');

        $insert = About::create([
            'title' => $request->input('title'),
            'type1' => $request->input('type1', -1),
            'type2' => $request->input('type2', -1),
            'type3' => $request->input('type3', -1),
            'content' => $request->input('content'),
            'postdate' => $request->input('postdate'),
            'indicate' => $request->input('indicate'),
            'sdescription' => $request->input('sdescription') ?: Str::limit(strip_tags($request->input('content', '')), 150, '...'),
            'skeyword' => $request->input('skeyword'),
            'notes1' => $request->input('notes1'),
            'lang' => $_SESSION['lang']
        ]);

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
            'lang' => $data['lang'] ?? 1,
            'userid' => $data['userid'] ?? 1,
        ];

        Meta::create($metaData);

        // 處理 ogimage 上傳
        if ($request->hasFile('ogimage')) {
            $this->handleMetaFileUpload($request, 'ogimage', $insert->id, $request->input('module_uri'));
        }
    }

    /**
     * 編輯資料
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request): void
    {
        $useModuleUri = $request->input('useModuleUri');

        $this->where('id', '=', $request->input('id'))
            ->update([
                'title' => $request->input('title'),
                'type1' => $request->input('type1', -1),
                'type2' => $request->input('type2', -1),
                'type3' => $request->input('type3', -1),
                'content' => $request->input('content'),
                'postdate' => $request->input('postdate'),
                'indicate' => $request->input('indicate'),
                'sdescription' => $request->input('sdescription') ?: (str_limit(strip_tags($request->input('content')),150, '...')),
                'skeyword' => $request->input('skeyword'),
                'notes1' => $request->input('notes1')
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
            $this->handleMetaFileUpload($request, 'ogimage', $request->input('id'), $request->input('module_uri'));
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
     * 更新起始頁
     *
     * @param Request $request
     * @param Number $select_id 選取的編號
     * @return void
     */
    public function resetStartPage(Request $request, $select_id)
    {
        $this->whereIn('id', $request->input('id'))
            ->update([
                'home' => 0,
            ]);

        $this->where('id', $select_id)
            ->update([
                'home' => 1,
            ]);
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

}
