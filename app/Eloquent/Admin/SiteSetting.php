<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSetting extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_site_setting';

    public $timestamps = false;

    protected $guarded = ['id'];

    // 如果需要自動將 JSON 欄位轉換為陣列，可以使用 $casts
    protected $casts = [
        'SiteInformation' => 'array',
        'SocialInformation' => 'array',
        'LangChoose' => 'array',
        'IconChoose' => 'array',
        'ManageSettings' => 'array',
        'OptionSettings' => 'array',
        'ModuleEnableSettings' => 'array',
    ];


    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = SiteSetting::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->with('routes')
            //->with('routes')
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 取得使用者選擇的網站模板。
     *
     * 此函數根據使用者 ID 從 `SiteSetting` 表中選擇 `SiteTemplateSelect` 字段。
     *
     * @param \Illuminate\Http\Request $request HTTP 請求對象，包含查詢參數。
     * @return \Illuminate\Database\Eloquent\Collection 符合條件的網站模板選擇結果。
     */
    function getUseTemplate(Request $request){
        $result = SiteSetting::select('SiteTemplateSelect')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            //->with('routes')
            ->get();
        //->toArray();

        if ($result->isNotEmpty()) {
            // 獲取第一個結果中的 SiteTemplateSelect
            $siteTemplateSelect = $result->first()->SiteTemplateSelect;
            //echo "SiteTemplateSelect: " . $siteTemplateSelect;
        }

        return $siteTemplateSelect;
    }

    /**
     * 取得編輯資料
     *
     * @param Request $request
     * @return mixed
     */
    function getByID(Request $request){
        $result = SiteSetting::select('*')
            ->where('id', '=', $request->input('id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->first();
        //->toArray();

        return $result;
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

        // 驗證表單數據
        $validatedData = $request->validate([
            'site_title' => 'required|max:100',
            'site_description' => 'required|max:100',
            'site_indicate' => 'required|boolean',
            'site_indicate_desc' => 'required|max:100',
            'site_copy_lock' => 'required|boolean',
            'site_url' => 'nullable|url|max:100',
            'site_footer_title' => 'required|max:100',
            'site_footer_phone' => 'nullable|max:100',
            'site_footer_cell' => 'nullable|max:100',
            'site_footer_fax' => 'nullable|max:100',
            'site_footer_line' => 'nullable|max:100',
            'site_footer_mail' => 'nullable|email|max:100',
            'site_footer_mail_name' => 'nullable|max:100',
            'site_og_image' => 'nullable|file|max:200',
            'site_favicon_image' => 'nullable|file|max:200',
            'site_Facebook' => 'nullable|url|max:200',
            'site_Instagram' => 'nullable|url|max:100',
            'site_Line' => 'nullable|url|max:100',
            'site_Youtube' => 'nullable|url|max:100',
            'site_twitter' => 'nullable|url|max:100',
            'site_LinkedIn' => 'nullable|url|max:100',
        ]);

        // 獲取當前用戶ID和語系
        $userId = $_SESSION['w_userid'];
        $lang = $_SESSION['lang'];

        // 查詢是否已存在該用戶的設置記錄
        $siteSetting = SiteSetting::firstOrNew(['userid' => $userId]);

        // 獲取現有的 SiteInformation 和 SocialInformation 資料
        $siteInformation = $siteSetting->SiteInformation ? json_decode($siteSetting->SiteInformation, true) : [];
        $socialInformation = $siteSetting->SocialInformation ? json_decode($siteSetting->SocialInformation, true) : [];

        // 更新特定語系的資料
        $siteInformation[$lang] = array_merge($siteInformation[$lang] ?? [], [
            'site_title' => $validatedData['site_title'],
            'site_description' => $validatedData['site_description'],
            'site_indicate' => $validatedData['site_indicate'],
            'site_indicate_desc' => $validatedData['site_indicate_desc'],
            'site_copy_lock' => $validatedData['site_copy_lock'],
            'site_url' => $validatedData['site_url'],
            'site_footer_title' => $validatedData['site_footer_title'],
            'site_footer_phone' => $validatedData['site_footer_phone'],
            'site_footer_cell' => $validatedData['site_footer_cell'],
            'site_footer_fax' => $validatedData['site_footer_fax'],
            'site_footer_line' => $validatedData['site_footer_line'],
            'site_footer_mail' => $validatedData['site_footer_mail'],
            'site_footer_mail_name' => $validatedData['site_footer_mail_name'],
            'site_og_image' => $validatedData['site_og_image'],
            'site_favicon_image' => $validatedData['site_favicon_image'],
        ]);

        // 更新社群資料
        $socialInformation = array_merge($socialInformation, [
            'site_Facebook' => $validatedData['site_Facebook'],
            'site_Instagram' => $validatedData['site_Instagram'],
            'site_Line' => $validatedData['site_Line'],
            'site_Youtube' => $validatedData['site_Youtube'],
            'site_twitter' => $validatedData['site_twitter'],
            'site_LinkedIn' => $validatedData['site_LinkedIn'],
        ]);

        // 處理 site_favicon_image 上傳
        if ($request->hasFile('site_favicon_image')) {
            // 刪除舊圖片
            if ($siteSetting->site_favicon_image) {
                $oldImagePath = SITEPATH . DIRECTORY_SEPARATOR . $request->input('wshop') . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . "seo" . DIRECTORY_SEPARATOR . $siteSetting->site_favicon_image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // 上傳新圖片
            $uploadDir = SITEPATH . DIRECTORY_SEPARATOR . $request->input('wshop') . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . "seo";
            $uploadedFiles = ImageUpload($request, 'site_favicon_image', $uploadDir);
            if (!empty($uploadedFiles)) {
                $siteSetting->site_favicon_image = $uploadedFiles[0];
            }
        }

        // 處理 site_og_image 上傳
        if ($request->hasFile('site_og_image')) {
            // 刪除舊圖片
            if (isset($siteInformation[$lang]['site_og_image'])) {
                $oldImagePath = SITEPATH . DIRECTORY_SEPARATOR . $request->input('wshop') . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . "seo" . DIRECTORY_SEPARATOR . $siteInformation[$lang]['site_og_image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // 上傳新圖片
            $uploadDir = SITEPATH . DIRECTORY_SEPARATOR . $request->input('wshop') . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR . "seo";
            $uploadedFiles = ImageUpload($request, 'site_og_image', $uploadDir);
            if (!empty($uploadedFiles)) {
                $siteInformation[$lang]['site_og_image'] = $uploadedFiles[0];
            }
        }


        // 將更新後的資料轉換回 JSON 格式
        $siteSetting->SiteInformation = json_encode($siteInformation);
        $siteSetting->SocialInformation = json_encode($socialInformation);
        $siteSetting->save();

        // 處理 site_og_image 上傳
        if ($request->hasFile('site_favicon_image') && $request->file('site_favicon_image')->isValid()) {
            //$this->handleFaviconFileUpload($request, 'site_favicon_image', $request->input('id'), $useModuleUri);
        }

    }

    /**
     * 編輯資料
     *
     * @param Request $request
     * @return void
     */
    function editMod(Request $request)
    {
        $data = $request->all();

        // 獲取當前用戶ID和語系
        $userId = $_SESSION['w_userid'];
        $lang = $_SESSION['lang'];

        // 查詢是否已存在該用戶的設置記錄
        $siteSetting = SiteSetting::firstOrNew(['userid' => $userId]);

        // 獲取現有的 SiteInformation 和 SocialInformation 資料
        //$siteInformation = $siteSetting->SiteInformation ? json_decode($siteSetting->SiteInformation, true) : [];
        //$socialInformation = $siteSetting->SocialInformation ? json_decode($siteSetting->SocialInformation, true) : [];
        // 獲取模組啟用設定
        $moduleEnableSettings = $siteSetting->ModuleEnableSettings ? json_decode($siteSetting->ModuleEnableSettings, true) : [];

        $RecordModules = (new Modules)->getAll($request);
        // 更新模組啟用設定
        foreach ($RecordModules as $row_RecordModules) {
            $moduleClass = 'module_' . $row_RecordModules['class'];
            if (isset($data[$moduleClass])) {
                $moduleEnableSettings[$row_RecordModules['class']] = $data[$moduleClass] == '1' ? 1 : 0;
            }
        }

        // 更新語言選擇設定
        $langChoose = isset($data['LangChoose']) ? $data['LangChoose'] : [];

        // 更新 Defaultlang
        if (isset($data['Defaultlang'])) {
            $siteSetting->Defaultlang = $data['Defaultlang'];
        }

        // 將更新後的資料轉換回 JSON 格式
        //$siteSetting->SiteInformation = json_encode($siteInformation);
        //$siteSetting->SocialInformation = json_encode($socialInformation);
        $siteSetting->LangChoose = json_encode($langChoose);
        $siteSetting->ModuleEnableSettings = json_encode($moduleEnableSettings);
        $siteSetting->save();

    }

    /**
     * 更新主題
     *
     */
    public function setTemplate(Request $request)
    {

        $this->where('userid', $_SESSION['w_userid'])
            ->update([
                'SiteTemplateSelect' => $request->input('SiteTemplateSelect'),
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

}
