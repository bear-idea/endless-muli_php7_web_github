<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");


$formFields = [
    'title' => ['label' => '選單標題', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'allowDuplicates' => true, 'value' => $RecordMenuBackend->flatMap(function($record) {return $record->menuBackend ? [$record->menuBackend->title] : [];})->implode(',')],
    'subtitle' => ['label' => '子選單標題', 'type' => 'tagsinput', 'maxlength' => 100, 'required' => true, 'value' => $RecordMenuBackend->flatMap(function($record) {return $record->menuBackend ? [$record->menuBackend->subtitle] : [];})->implode(',')],
    'route_name' => ['label' => '路由名稱', 'type' => 'tagsinput', 'maxlength' => 255, 'required' => true, 'value' => $RecordMenuBackend->flatMap(function($record) {return $record->menuBackend ? [$record->menuBackend->route_name] : [];})->implode(',')],
    'icon' => ['label' => '選單圖標', 'type' => 'tagsinput', 'maxlength' => 100, 'required' => true, 'value' => $RecordMenuBackend->flatMap(function($record) {return $record->menuBackend ? [$record->menuBackend->icon] : [];})->implode(',')],
    'is_home' => ['label' => '首頁顯示', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'checked' => '0'],
    'is_submenu' => ['label' => '側欄顯示', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'checked' => '0'],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'checked' => $RecordMenuBackend->flatMap(function($record) {return $record->menuBackend ? [$record->menuBackend->indicate] : [];})->first()]
];

?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-edit"></i> 多筆複增資料</h4>
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

                    <input name="lang" type="hidden" id="lang" value="<?php echo $_SESSION['lang']; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />

                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />

                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_MenuBackend" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<?php //require_once("require_template_panel.php"); ?>
