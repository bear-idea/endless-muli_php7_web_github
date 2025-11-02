<?php
require($page_view_path_vendor."pushjs_form.php");

$useModuleUri = $request->input('useModuleUri');

// 定義表單字段
$formFields = [
    'name' => ['label' => '網站名稱', 'type' => 'text', 'maxlength' => 200, 'required' => true, 'value' => $row_RecordAdmin['name']],
    'webname' => ['label' => '網站域名', 'type' => 'text', 'required' => true, 'maxlength' => 20, 'parsley' => ['trigger' => 'blur', 'pattern' => '/^[a-zA-Z0-9]+$/', 'length' => '[4, 20]'], 'value' => $row_RecordAdmin['webname'], 'disabled' => true],
    'account' => ['label' => '帳號', 'type' => 'text', 'required' => true, 'maxlength' => 30, 'parsley' => ['trigger' => 'blur', 'length' => '[4, 30]'], 'value' => $row_RecordAdmin['account'], 'disabled' => true],
    'psw' => ['label' => '密碼', 'type' => 'password', 'required' => true, 'maxlength' => 30, 'parsley' => ['trigger' => 'blur', 'length' => '[4, 30]']],
    'pswchk' => ['label' => '確認密碼', 'type' => 'password', 'required' => true, 'maxlength' => 100, 'parsley' => ['trigger' => 'blur', 'equalto' => '#psw', 'errors-container' => '#error_pswchk']],
    'notes1' => ['label' => '備註', 'type' => 'text', 'maxlength' => 50, 'required' => false, 'value' => $row_RecordAdmin['name']]
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
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordAdmin['id']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordAdmin['lang']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_update" value="form_Admin" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>
