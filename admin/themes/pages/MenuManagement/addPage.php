<?php
require($page_view_path_vendor."pushjs_form.php");
require($page_view_path_vendor."pushjs_swal.php");

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
    'title' => ['label' => '選單標題', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'tooltip' => '設定目前頁面的選單標題。'],
    'subtitle' => ['label' => '次標題', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'tooltip' => '設定目前頁面的次標題，若頁面有此功能則會顯示。'],
    'type' => ['label' => '選單分類', 'type' => 'customizeSelect', 'required' => true, 'options' => [['value' => 'MainMenu', 'name' => '主選單'], ['value' => 'SubMenu', 'name' => '子選單'], ['value' => 'FooterMenu', 'name' => '頁尾選單']], 'tooltip' => '選擇目前選單的分類。'],
    'route_name' => ['label' => '功能模組', 'type' => 'radioWithCardFontIcon', 'maxlength' => 100, 'required' => true, 'options' => $routeNameOptions],
    //'module_uri' => ['label' => '模組分類', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    //'icon' => ['label' => '選單圖標', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    //'colorclass' => ['label' => '背景顏色類別', 'type' => 'text', 'maxlength' => 100, 'required' => false],
    //'tooltip' => ['label' => '選單提示', 'type' => 'text', 'maxlength' => 255, 'required' => false],
    //'is_home' => ['label' => '首頁顯示', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'default' => '0'],
    //'is_submenu' => ['label' => '側欄顯示', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'default' => '0'],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'default' => '1']
];
?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
        <?php require($page_view_path_vendor . "require_panel_heading_btn.php"); ?>
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
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />

                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_MenuManagement" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
    <!-- end panel-body -->
</div>
<!-- end panel -->

<?php //require_once("require_template_panel.php"); ?>
