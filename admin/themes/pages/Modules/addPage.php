<?php
require($page_view_path_vendor."pushjs_form.php");
require($page_view_path_vendor."pushjs_swal.php");

// 定義表單字段
$formFields = [
    'name' => ['label' => '名稱', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'icon' => ['label' => '圖示', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'class' => ['label' => '預設使用類別', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    //'module_value' => ['label' => '模組分類值', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'uri' => ['label' => '識別名', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'tooltip' => '建議以大駝峰式（PascalCase）命名規則命名，例如 News, AlbumPhotos。此項目會跟路由(Routes)關聯。'],
    'description' => ['label' => '描述', 'type' => 'text', 'maxlength' => 100, 'required' => false],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'default' => '1']
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
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="module_uri" type="hidden" id="module_uri" value="<?php echo $useModuleUri; ?>" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_Modules" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<?php //require_once("require_template_panel.php"); ?>
