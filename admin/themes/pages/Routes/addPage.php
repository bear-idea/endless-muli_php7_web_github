<?php
require($page_view_path_vendor."pushjs_form.php");
require($page_view_path_vendor."pushjs_swal.php");

// 定義表單字段
$formFields = [
    'name' => ['label' => '路由名稱(RouterName)', 'type' => 'tagsinput', 'maxlength' => 100, 'required' => true, 'value' => 'index,add,edit,copy,list,listitem,upload,delete', 'tooltip' => '此項目會根據 路由前綴、模組識別名、路由名稱(RouterName) 做組合自動產生'],
    'prefix' => ['label' => '路由前綴(Prefix)', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'uri' => ['label' => '路由 URI', 'type' => 'tagsinput', 'maxlength' => 100, 'required' => false, 'value' => '/,add,edit/{id},copy/{id},list,listitem/{list_id},upload/{id},delete', 'tooltip' => '此項目會根據 模組識別名、路由 URI 做調整自動產生'],
    'controller_name' => ['label' => '控制器名稱(Controller)', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'controller_action' => ['label' => '控制器方法(Action)', 'type' => 'tagsinput', 'maxlength' => 100, 'required' => true, 'value' => 'index,add,edit,copy,list,listitem,upload,delete'],
    'methods' => ['label' => '請求方法(Methods)', 'type' => 'multiselect', 'maxlength' => 255, 'required' => true, 'options' => [['itemname' => 'GET(取得資源)', 'itemvalue' => 'get'], ['itemname' => 'POST(傳送資源，通常用於創建新資源)', 'itemvalue' => 'post'], ['itemname' => 'PUT(更新資源，通常用於完全替換資源或者創建新資源（如果不存在）)', 'itemvalue' => 'put'], ['itemname' => 'DELETE(刪除資源)', 'itemvalue' => 'delete'], ['itemname' => 'PATCH(部分更新資源)', 'itemvalue' => 'patch'], ['itemname' => 'OPTIONS(查詢支持的請求方法)', 'itemvalue' => 'options'], ['itemname' => 'HEAD(類似於 GET 請求，但僅返回標頭，用於獲取資源的元資訊)', 'itemvalue' => 'head']], 'selected' => ['get', 'post']],
    'module_uri' => ['label' => '模組識別名(ModuleUri)', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'tooltip' => '建議以大駝峰式（PascalCase）命名規則命名，例如 News, AlbumPhotos'],
    'user_group' => ['label' => '權限', 'type' => 'multiselect', 'maxlength' => 100, 'required' => false, 'options' => [['itemname' => 'SuperAdmin(最高管理員)', 'itemvalue' => 'superadmin'], ['itemname' => 'Admin(一般會員)', 'itemvalue' => 'admin']]],
    'module_class' => ['label' => '預設使用模組類別(Class)', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'default' => '1'],
    'postdate' => ['label' => '上傳時間', 'type' => 'datetime', 'maxlength' => 20, 'required' => true, 'default' => $currentDate = (new DateTime())->format('Y-m-d H:i:s')],
    'notes1' => ['label' => '備註', 'type' => 'text', 'maxlength' => 50, 'required' => false]
];
?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
        <?php require($page_view_path_vendor . "require_panel_heading_btn.php"); ?>
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
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_SESSION['lang']; ?>" />

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
