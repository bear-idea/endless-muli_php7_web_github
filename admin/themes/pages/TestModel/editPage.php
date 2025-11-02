<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");

$useModuleUri = $request->input('useModuleUri');

// 定義表單字段
$formFields = [
    'title' => ['label' => '標題', 'type' => 'text', 'maxlength' => 200, 'required' => true, 'value' => $row_RecordTestModel['title']],
    'type' => ['label' => '分類', 'type' => 'select', 'required' => true, 'options' => $RecordListItemMenuType, 'selected' => $row_RecordTestModel['type']],
    'multi_type' => [
        'label' => '多層級聯選單',
        'type' => 'multilevel_select',
        'value_field' => 'id', // 動態值欄位
        'name_field' => 'itemname', // 動態名稱欄位
        'required' => true,
        'options' => generateDynamicOptions($RecordMultiListItemMenu, ['id', 'itemname']),
        //'selected' => ['level1' => '15'], // 設定初始值
        'url' => ADMINURL . generateUrl( "/list-item-menu/TestModel/MultiType/getJsonChildren") // Laravel 路由，用於動態加載數據
    ],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'checked' => $row_RecordTestModel['indicate']],
    'pushtop' => ['label' => '置頂', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'checked' => $row_RecordTestModel['pushtop'], 'tooltip' => '您可設定此項目來將文章放置於頁面的最頂端。'],
    'content' => ['label' => '詳細內容', 'type' => 'textarea', 'required' => false, 'value' => $row_RecordTestModel['content'], 'tooltip' => '註:Shift+Enter為不空行分段/Enter為空行分段。'],
    'postdate' => ['label' => '上傳時間', 'type' => 'datetime', 'maxlength' => 20, 'required' => true, 'value' => $row_RecordTestModel['postdate']],
    'notes1' => ['label' => '備註', 'type' => 'text', 'maxlength' => 50, 'required' => false, 'value' => $row_RecordTestModel['notes1']]
];

$initialPreview = !empty($row_RecordTestModel['metas']['ogimage']) ? BASEURL . "/site/" . $_SESSION['wshop'] . "/image/seo/" . $row_RecordTestModel['metas']['ogimage'] : '';

$formFields_SEO = [
    'separator1' => ['label' => '基本 SEO', 'type' => 'separator', 'required' => false],
    'slug' => ['label' => '別名(URL Slug)', 'type' => 'text', 'maxlength' => 200, 'required' => false, 'value' => $row_RecordTestModel['slug']],
    'skeyword' => ['label' => '頁面關鍵字(Meta)', 'type' => 'tagsinput', 'maxlength' => 300, 'required' => false, 'value' => $row_RecordTestModel['metas']['skeyword'], 'tooltip' => '設定目前頁面的SEO關鍵字，會嵌入至原始碼中。'],
    'skeywordindicate' => ['label' => '關鍵字顯示', 'type' => 'radio', 'required' => false, 'options' => ['1' => '顯示', '0' => '隱藏'], 'checked' => $row_RecordTestModel['metas']['skeywordindicate'], 'tooltip' => '是否顯示關鍵字於頁面上。'],
    'sdescription' => ['label' => '頁面描述(Meta)', 'type' => 'text', 'maxlength' => 150, 'required' => false, 'value' => $row_RecordTestModel['metas']['sdescription'], 'tooltip' => '設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。'],
    'separator2' => ['label' => '社群 SEO (Open Graph Tags)', 'type' => 'separator', 'required' => false],
    'ogtitle' => ['label' => '標題(og:title)', 'type' => 'text', 'maxlength' => 200, 'required' => false, 'value' => $row_RecordTestModel['metas']['ogtitle'], 'tooltip' => 'og:title 網頁標題或是顯示內容的標題'],
    'ogtype' => ['label' => '類型(og:type)', 'type' => 'text', 'maxlength' => 200, 'required' => false, 'value' => $row_RecordTestModel['metas']['ogtype'], 'tooltip' => 'og:type 網頁內容的類型 (有 article, book, profile, website, music, video 等類型'],
    'ogurl' => ['label' => '唯一網址(og:url)', 'type' => 'url', 'maxlength' => 200, 'required' => false, 'value' => $row_RecordTestModel['metas']['ogurl'], 'tooltip' => '網頁的唯一網址 canonical URL。如果您有手機版和電腦版二個網頁、將二個網頁的og:url設成電腦版的網址，兩個網頁的facebook按讚次數就可以加總統計在一起'],
    'ogimage' => ['label' => '預覽圖(og:image)', 'type' => 'file', 'maxlength' => 200, 'required' => false, 'initialPreview' => $initialPreview, 'value' => $row_RecordTestModel['metas']['ogimage'], 'tooltip' => 'og:image 用戶將內容分享至社群時顯示的圖像網址。 (網頁的預覽圖)', 'errorContainer' => 'error_ogImage'],
    'ogdescription' => ['label' => '描述(og:description)', 'type' => 'text', 'maxlength' => 150, 'required' => false, 'value' => $row_RecordTestModel['metas']['ogdescription'], 'tooltip' => 'og:description 網頁內容的簡單說明、建議以二至四句話來說明。']
];

// 載入圖片資訊
if (!empty($row_RecordTestModel['photos'])) {
    $initialPreview = [];
    $initialPreviewConfig = [];
    foreach ($row_RecordTestModel['photos'] as $photo) {
        $initialPreview[] = BASEURL . "/site/" . $_SESSION['wshop'] . "/image/photo/" . $photo['pic'];
        $initialPreviewConfig[] = [
            'url' => ADMINURL . generateUrl( '/photo/delete'), // 圖片刪除端點 URL
            'key' => $photo['id'], // 圖片 ID
            'extra' => (['id' => $photo['id']])
        ];
    }
}

$formFields_Photo = [
    'pic' => ['label' => '圖片', 'type' => 'multi_image', 'maxlength' => 200, 'required' => false, 'initialPreview' => $initialPreview, 'initialPreviewConfig' => $initialPreviewConfig, 'tooltip' => '', 'errorContainer' => 'error_multi_image']
    //'photodescription' => ['label' => '描述', 'type' => 'text', 'maxlength' => 150, 'required' => false, 'value' => $row_RecordTestModel['photos']['photodescription'], 'tooltip' => '']
];

?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body p-0">

        <form action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">

            <ul class="nav nav-tabs nav-tabs-v2 px-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#tab-base" data-bs-toggle="tab" class="nav-link active" aria-selected="true" role="tab">
                        <span class="d-sm-block"><i class="fas fa-receipt"></i> 基本資訊</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tab-seo" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                        <span class="d-sm-block"><i class="fas fa-location-arrow"></i> SEO 優化</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tab-photo" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                        <span class="d-sm-block"><i class="fas fa-images"></i> 圖片資訊</span>
                    </a>
                </li>

            </ul>

            <div class="tab-content panel rounded-0 p-0 m-0">
                <div class="tab-pane fade active show" id="tab-base" role="tabpanel">
                    <?php echo renderForm($formFields, $scripts); ?>
                </div>
                <div class="tab-pane fade" id="tab-seo" role="tabpanel">
                    <?php echo renderForm($formFields_SEO, $scripts); ?>
                </div>
                <div class="tab-pane fade" id="tab-photo" role="tabpanel">
                    <?php echo renderForm($formFields_Photo, $scripts); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label"></label>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary w-100 btn-block">送出</button>
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTestModel['id']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordTestModel['lang']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_update" value="form_TestModel" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<?php //require_once("require_template_panel.php"); ?>
