<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");

// 定義表單字段
$formFields = [
    'separator1' => ['label' => '網站基本資訊', 'type' => 'separator', 'required' => false],
    'Defaultlang' => ['label' => '預設語系', 'type' => 'radio', 'required' => true, 'options' => ['zh_TW' => '<div class="fi fi-tw rounded mb-0"></div> 繁體', 'zh_CN' => '<div class="fi fi-cn rounded mb-0"></div> 簡體', 'en' => '<div class="fi fi-us rounded mb-0"></div> 英文', 'ja' => '<div class="fi fi-jp rounded mb-0"></div> 日文', 'ko' => '<div class="fi fi-kr rounded mb-0"></div> 韓文'], 'checked' => $row_RecordSiteSetting['Defaultlang'], 'tooltip' => '頁面使用預設的語系。'],
    'LangChoose' => ['label' => '使用語系', 'type' => 'checkboxGroup', 'required' => true, 'options' => [
        ['name' => 'LangChoose[zh_TW]', 'label' => '<div class="fi fi-tw rounded mb-0"></div> 繁體', 'value' => 'zh_TW', 'checked' => in_array('zh_TW', json_decode($row_RecordSiteSetting->LangChoose, true))],
        ['name' => 'LangChoose[zh_CN]', 'label' => '<div class="fi fi-cn rounded mb-0"></div> 簡體', 'value' => 'zh_CN', 'checked' => in_array('zh_CN', json_decode($row_RecordSiteSetting->LangChoose, true))],
        ['name' => 'LangChoose[en]', 'label' => '<div class="fi fi-us rounded mb-0"></div> 英文', 'value' => 'en', 'checked' => in_array('en', json_decode($row_RecordSiteSetting->LangChoose, true))],
        ['name' => 'LangChoose[ja]', 'label' => '<div class="fi fi-jp rounded mb-0"></div> 日文', 'value' => 'ja', 'checked' => in_array('ja', json_decode($row_RecordSiteSetting->LangChoose, true))],
        ['name' => 'LangChoose[ko]', 'label' => '<div class="fi fi-kr rounded mb-0"></div> 韓文', 'value' => 'ko', 'checked' => in_array('ko', json_decode($row_RecordSiteSetting->LangChoose, true))],
    ]],

    'separator2' => ['label' => '網頁功能啟用', 'type' => 'separator', 'required' => false],
];

// 動態添加模塊選項
foreach ($RecordModules as $row_RecordModules) {
    $formFields['module_' . $row_RecordModules['class']] = [
        'label' => renderIcon($row_RecordModules['icon'], 'fs-lg') . $row_RecordModules['name'],
        'type' => 'radio',
        'required' => true,
        'options' => ['1' => '啟用', '0' => '關閉'],
        'default' => '1',
        'checked' => json_decode($row_RecordSiteSetting->ModuleEnableSettings, true)[$row_RecordModules['class']],
        'tooltip' => $row_RecordModules['description']
    ];
}

//dd($formFields);
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
            </ul>

            <div class="tab-content panel rounded-0 p-0 m-0">
                <div class="tab-pane fade active show" id="tab-base" role="tabpanel">
                    <?php echo renderForm($formFields, $scripts); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label"></label>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary w-100 btn-block">送出</button>
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSiteSetting['id']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_update" value="form_SiteSetting" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<?php //require_once("require_template_panel.php"); ?>
