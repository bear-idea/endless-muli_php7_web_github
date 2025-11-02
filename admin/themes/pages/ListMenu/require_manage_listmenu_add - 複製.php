<?php

require($page_view_path_vendor."pushjs_form.php");
require($page_view_path_vendor."pushjs_swal.php");

// 定義表單字段
$formFields = [
    'listname' => ['label' => '清單名稱', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'alias' => ['label' => '別名', 'type' => 'text', 'maxlength' => 100, 'required' => true],
    'pattern' => ['label' => '功能模式', 'type' => 'customizeSelect', 'maxlength' => 100, 'required' => true, 'options' => $RecordPatterns, 'valueField' => 'pattern', 'nameField' => 'name'],
    'description' => ['label' => '描述', 'type' => 'text', 'maxlength' => 100, 'required' => false],
    'module_uri' => ['label' => '使用模組', 'type' => 'customizeSelect', 'maxlength' => 100, 'required' => true, 'options' => $RecordModules, 'valueField' => 'uri', 'nameField' => 'name'],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'default' => '1']
];

/*$formFields_listitem = [
    'dynamic_fields' => [
        'label' => '動態欄位',
        'type' => 'multi_text',
        'maxlength' => 100,
        'required' => true,
        'columns' => ['itemname', 'sortid', 'indicate'], // 資料庫欄位名稱
        'value' => [
            //['itemname' => '項目 1', 'sortid' => 1, 'indicate' => '標示 1'],
            //['itemname' => '項目 2', 'sortid' => 2, 'indicate' => '標示 2']
        ]
    ]
];*/

$formFields_listitem = [
    'itemname' => [
        'label' => '項目名稱',
        'type' => 'multi_text',
        'maxlength' => 100,
        'required' => true,
        'columns' => [
            'itemname' => ['label' => '名稱'],
            'sortid' => ['label' => '排序'],
            'indicate' => ['label' => '指示']
        ]
    ]
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
                        <span class="d-sm-block"><i class="fas fa-receipt"></i> 清單列表</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tab-listitem" data-bs-toggle="tab" class="nav-link" aria-selected="true" role="tab">
                        <span class="d-sm-block"><i class="fas fa-receipt"></i> 清單項目</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content panel rounded-0 p-0 m-0">
                <div class="tab-pane fade active show" id="tab-base" role="tabpanel">
                    <?php echo renderForm($formFields, $scripts); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-listitem" role="tabpanel">
                <?php echo renderForm($formFields_listitem, $scripts); ?>
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
            <input type="hidden" name="MM_insert" value="form_ListMenu" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>
