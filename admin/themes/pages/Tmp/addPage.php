<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");

$useModuleUri = $request->input('useModuleUri');

// 定義表單字段
$formFields = [
    'title' => ['label' => '標題', 'type' => 'text', 'maxlength' => 200, 'required' => true],
    //'type' => ['label' => '分類', 'type' => 'select', 'required' => true, 'options' => $RecordListItemMenuType],
    //'author' => ['label' => '發佈者', 'type' => 'select', 'required' => true, 'options' => $RecordListItemMenuAuthor],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'default' => '1'],
    //'pushtop' => ['label' => '置頂', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'default' => '0', 'tooltip' => '您可設定此項目來將文章放置於頁面的最頂端。'],
    //'content' => ['label' => '詳細內容', 'type' => 'textarea', 'required' => false, 'tooltip' => '註:Shift+Enter為不空行分段/Enter為空行分段。'],
    //'postdate' => ['label' => '上傳時間', 'type' => 'datetime', 'maxlength' => 20, 'required' => true, 'default' => $currentDate = (new DateTime())->format('Y-m-d H:i:s')],
    //'notes1' => ['label' => '備註', 'type' => 'text', 'maxlength' => 50, 'required' => false]
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

                    <?php $ThemeMappings = require_once $page_view_path_vendor . 'return_theme_mappings.php'; /* 載入主題設定 */ ?>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">主題選擇<span class="text-red ms-5px"><sup><i class="fa-solid fa-star"></i></sup></span> </label>
                        <div class="col-md-10">
                            <div class="d-flex flex-wrap align-items-start">
                                <?php foreach ($ThemeMappings as $themeKey => $themeData) { ?>
                                    <div class="custom-option custom-option-icon p-3 d-flex flex-column align-items-start text-center">
                                        <label for="theme_<?php echo $themeKey; ?>">
                                        <i class="iconify fs-50px m-auto" data-icon="<?php echo $themeData['icon']; ?>"></i><br>
                                        <div class="custom-option-content w-150px">
                                            <div class="custom-option-title mb-2"><?php echo $themeData['name']; ?></div>
                                            <input class="form-check-input" type="radio" name="theme" id="theme_<?php echo $themeKey; ?>" value="<?php echo $themeKey; ?>" <?php echo $themeKey === 'Porto' ? 'checked="checked"' : ''; ?>>
                                        </div>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">版面主佈局<span class="text-red ms-5px"><sup><i class="fa-solid fa-star"></i></sup></span> </label>
                        <div class="col-md-10">
                            <div id="mainLayout-options">

                                <?php foreach ($ThemeMappings as $themeKey => $themeData) { ?>
                                    <div class="mainLayout-<?php echo $themeKey; ?> d-flex flex-row align-items-start flex-wrap" style="<?php echo $themeKey !== 'Porto' ? 'display:none;' : ''; ?>">
                                        <?php foreach ($themeData['mainLayout'] as $layoutKey => $layoutData) { ?>
                                            <div class="custom-option custom-option-icon p-3 d-flex flex-column align-items-start text-center">
                                                <label for="mainLayout_<?php echo strtolower($layoutKey); ?>">
                                                <img src="<?php echo ADMINURL . '/' . $layoutData['image']; ?>" alt="" class="rounded h-100px">
                                                <div class="custom-option-content w-150px">
                                                    <div class="custom-option-title mb-2"><?php echo $layoutData['label']; ?></div>
                                                    <input class="form-check-input" type="radio" name="mainLayout" id="mainLayout_<?php echo strtolower($layoutKey); ?>" value="<?php echo $layoutKey; ?>" <?php echo $layoutKey === 'classic' ? 'checked="checked"' : ''; ?>>

                                                </div>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>


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
                    <input name="webname" type="hidden" id="webname" value="<?php echo $wshop; ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_Tmp" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<script>
    /*$(document).ready(function(){
        // 使用 jQuery 为所有匹配的元素添加 'd-none' class
        $('#layout-options > div').addClass('d-none');

        $('input[name="theme"]').change(function(){
            var selectedTheme = $(this).val();

            // 先隐藏所有布局选项
            $('#layout-options > div').addClass('d-none');

            // 根据选择的主题显示对应的布局选项，移除 'd-none' class
            if(selectedTheme === 'Porto') {
                $('.layout-porto').removeClass('d-none');
            } else if(selectedTheme === 'Webster') {
                $('.layout-webster').removeClass('d-none');
            }
        });

        // 初始化时根据选中的主题显示对应的布局选项
        $('input[name="theme"]:checked').trigger('change');
    });*/

    $(document).ready(function(){
        // 初始化：先隐藏所有布局选项
        $('#mainLayout-options > div').addClass('d-none');

        // 当主题选项改变时
        $('input[name="theme"]').change(function(){
            var selectedTheme = $(this).val();
            console.log('Selected theme:', selectedTheme); // 调试

            // 隐藏所有布局选项
            $('#mainLayout-options > div').addClass('d-none');

            // 显示与选中主题对应的布局选项
            var targetClass = '.mainLayout-' + selectedTheme;
            console.log('Target class:', targetClass); // 调试

            $(targetClass).removeClass('d-none');
        });

        // 页面加载时，根据初始选中的主题显示相应的布局选项
        $('input[name="theme"]:checked').trigger('change');
    });
</script>
