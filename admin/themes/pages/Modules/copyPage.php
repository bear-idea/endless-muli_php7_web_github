<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");

// 定義表單字段
$formFields = [
    'name' => ['label' => '名稱', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $row_RecordModules['name']],
    'icon' => ['label' => '圖示', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $row_RecordModules['icon']],
    'class' => ['label' => '預設使用類別', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $row_RecordModules['class']],
    //'value' => ['label' => '模組分類值', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'uri' => ['label' => '識別名', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => $row_RecordModules['uri'], 'tooltip' => '建議以大駝峰式（PascalCase）命名規則命名，例如 News, AlbumPhotos。此項目會跟路由(Routes)關聯。'],
    'description' => ['label' => '描述', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'value' => $row_RecordModules['description']],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'checked' => $row_RecordModules['indicate']]
];

?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-copy"></i> 複增資料</h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body p-0">

        <form action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post">

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
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordModules['id']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordModules['lang']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_Modules" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<?php //require_once("require_template_panel.php"); ?>
