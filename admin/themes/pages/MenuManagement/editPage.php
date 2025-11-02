<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");

// 处理数据，将所需的字段提取出来
/*$routeNameOptions = $RecordModules->map(function ($RecordModules) {
    return [
        'label' => $RecordModules->name,
        'icon' => $RecordModules->icon,
        'value' => $RecordModules->routes->first()->name ?? ''
    ];
})->toArray();*/
$routeNameOptions = $RecordModules->map(function ($RecordModules) {
    // 從當前模組的路由中獲取第一個路由名稱，若無則設為 null
    $routeName = $RecordModules->routes->first()->name ?? null;

    // 如果 routeName 為空，則不返回任何值
    if (empty($routeName)) {
        return null; // 返回 null 來表示不包含這個選項
    }

    // 否則，返回包含 'label', 'icon' 和 'value' 的選項陣列
    return [
        'label' => $RecordModules->name,  // 設置選項的標籤名稱
        'icon' => $RecordModules->icon,    // 設置選項的圖標
        'value' => $routeName              // 設置選項的值
    ];
})->filter()->toArray(); // 使用 filter 過濾掉為 null 的選項

// 定義表單字段
$formFields = [
    'title' => ['label' => '選單標題', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $row_RecordMenuManagement['title']],
    'subtitle' => ['label' => '次標題', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'value' => $row_RecordMenuManagement['subtitle']],
    'type' => ['label' => '選單分類', 'type' => 'customizeSelect', 'required' => true, 'options' => [['value' => 'MainMenu', 'name' => '主選單'], ['value' => 'SubMenu', 'name' => '子選單'], ['value' => 'FooterMenu', 'name' => '頁尾選單']], 'selected' => $row_RecordMenuManagement['type'], 'tooltip' => '選擇目前選單的分類。'],
    'route_name' => ['label' => '功能模組', 'type' => 'radioWithCardFontIcon', 'maxlength' => 100, 'required' => true, 'options' => $routeNameOptions, 'checked' => $row_RecordMenuManagement['route_name']],
    //'module_uri' => ['label' => '模組分類', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $row_RecordMenuManagement['module_uri']],
    //'icon' => ['label' => '選單圖標', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $row_RecordMenuManagement['icon']],
    //'colorclass' => ['label' => '背景顏色類別', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'value' => $row_RecordMenuManagement['colorclass']],
    //'tooltip' => ['label' => '選單提示', 'type' => 'text', 'maxlength' => 255, 'required' => false, 'value' => $row_RecordMenuManagement['tooltip']],
    //'is_home' => ['label' => '首頁顯示', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'checked' => $row_RecordMenuManagement['is_home']],
    //'is_submenu' => ['label' => '側欄顯示', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'checked' => $row_RecordMenuManagement['is_submenu']],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'checked' => $row_RecordMenuManagement['indicate']]
];

?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
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
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordMenuManagement['id']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordMenuManagement['lang']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_update" value="form_MenuManagement" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
    <!-- end panel-body -->
</div>

<?php //require_once("require_template_panel.php"); ?>
