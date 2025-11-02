<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");

// 定義表單字段
$formFields = [
    'name' => ['label' => '路由名稱(RouterName)', 'type' => 'tagsinput', 'maxlength' => 100, 'required' => true, 'value' => collect(extractAction($RecordRoutes->pluck('name')->toArray(), toSpinalCase($RecordRoutes->pluck('module_uri')->toArray()[0]), $RecordRoutes->pluck('prefix')->toArray()[0]))->implode(','), 'tooltip' => '此項目會根據 路由前綴、模組識別名、路由名稱(RouterName) 做組合自動產生'],
    'prefix' => ['label' => '路由前綴(Prefix)', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $RecordRoutes->pluck('prefix')->toArray()[0]],
    'uri' => ['label' => '路由 URI', 'type' => 'tagsinput', 'maxlength' => 100, 'required' => false, 'value' => collect(extractAction($RecordRoutes->pluck('uri')->toArray(), toSpinalCase($RecordRoutes->pluck('module_uri')->toArray()[0]), $RecordRoutes->pluck('prefix')->toArray()[0]))->implode(','), 'tooltip' => '此項目會根據 模組識別名、路由 URI 做調整自動產生'],
    'controller_name' => ['label' => '控制器名稱(Controller)', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $RecordRoutes->pluck('controller_name')->toArray()[0]],
    'controller_action' => ['label' => '控制器方法(Action)', 'type' => 'tagsinput', 'maxlength' => 100, 'required' => true, 'value' => $RecordRoutes->pluck('controller_action')->implode(',')],
    'methods' => ['label' => '請求方法(Methods)', 'type' => 'multiselect', 'maxlength' => 255, 'required' => true, 'options' => [['itemname' => 'GET(取得資源)', 'itemvalue' => 'get'], ['itemname' => 'POST(傳送資源，通常用於創建新資源)', 'itemvalue' => 'post'], ['itemname' => 'PUT(更新資源，通常用於完全替換資源或者創建新資源（如果不存在）)', 'itemvalue' => 'put'], ['itemname' => 'DELETE(刪除資源)', 'itemvalue' => 'delete'], ['itemname' => 'PATCH(部分更新資源)', 'itemvalue' => 'patch'], ['itemname' => 'OPTIONS(查詢支持的請求方法)', 'itemvalue' => 'options'], ['itemname' => 'HEAD(類似於 GET 請求，但僅返回標頭，用於獲取資源的元資訊)', 'itemvalue' => 'head']], 'selected' => ['get', 'post'], 'value' => $row_RecordRoutes['methods']],
    'module_uri' => ['label' => '模組識別名(ModuleUri)', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $RecordRoutes->pluck('module_uri')->toArray()[0], 'tooltip' => '建議以大駝峰式（PascalCase）命名規則命名，例如 News, AlbumPhotos'],
    'user_group' => ['label' => '權限', 'type' => 'multiselect', 'maxlength' => 100, 'required' => false, 'options' => [['itemname' => 'SuperAdmin(最高管理員)', 'itemvalue' => 'superadmin'], ['itemname' => 'Admin(一般會員)', 'itemvalue' => 'admin']], 'value' => $RecordRoutes->pluck('user_group')->toArray()[0]],
    'module_class' => ['label' => '預設使用模組類別(Class)', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $RecordRoutes->pluck('module_class')->toArray()[0]],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'checked' => $RecordRoutes->pluck('indicate')->toArray()[0]],
    'postdate' => ['label' => '上傳時間', 'type' => 'datetime', 'maxlength' => 20, 'required' => true, 'value' => $RecordRoutes->pluck('postdate')->toArray()[0]],
    'notes1' => ['label' => '備註', 'type' => 'text', 'maxlength' => 50, 'required' => false, 'value' => $RecordRoutes->pluck('notes1')->toArray()[0]]
];

?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-edit"></i> 複增資料</h4>
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
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordRoutes['id']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_SESSION['lang']; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />

                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />

                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_Routes" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<?php //require_once("require_template_panel.php"); ?>
