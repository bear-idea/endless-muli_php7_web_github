<?php
use App\Eloquent\Admin\Actnews;

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Actnews")) {

    $uploadDir = SITEPATH . DIRECTORY_SEPARATOR . $request->input('wshop') . DIRECTORY_SEPARATOR . "image". DIRECTORY_SEPARATOR . "actnews";
    $uploadedFiles = ImageUpload($request, 'pic', $uploadDir);

    // 根據需要處理返回的文件名列表
    foreach ($uploadedFiles as $file) {
        (new Actnews)->editWithImages($request, $file, 'actnews');
    }

    $_SESSION['DB_Edit'] = "Success";

    //$insertGoTo = "actnews?Opt=viewpage&lang=" . $_POST['lang'];
    /*if (isset($_SERVER['QUERY_STRING'])) {
      $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
      $insertGoTo .= $_SERVER['QUERY_STRING'];
    }*/
    //header(sprintf("Location: %s", $insertGoTo));
}

$row_RecordActnews = (new Actnews)->getByID($request);

?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
    <div class="card-body">
        <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Actnews']; ?> <small>修改</small> <?php require($page_view_path_vendor . "require_lang_show.php"); ?></h4>
    </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
        <?php require($page_view_path_vendor . "require_panel_heading_btn.php"); ?>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body p-0">

        <form action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">

            <?php
            // 定義表單字段
            $formFields = [
                'pic' => ['label' => '圖片', 'type' => 'file', 'required' => true],
            ];

            // 渲染表單字段
            function renderFormField($name, $field)
            {
                $label = $field['label'];
                $type = $field['type'];
                $maxLength = $field['maxlength'] ?? '';
                $isRequired = $field['required'];
                $options = $field['options'] ?? [];
                $default = $field['default'] ?? '';
                $tooltip = $field['tooltip'] ?? '';

                $requiredAttr = $isRequired ? 'required' : '';
                $parsleyTrigger = $isRequired ? 'data-parsley-trigger="blur"' : '';
                $inputClass = 'form-control';

                $tooltipHtml = $tooltip ? '<i class="fa fa-info-circle text-orange" data-bs-original-title="' . $tooltip . '" data-bs-toggle="tooltip" data-bs-placement="top"></i>' : '';

                $html = '<div class="form-group row">';
                $html .= "<label class=\"col-md-2 col-form-label\">$label" . ($isRequired ? '<span class="text-red">*</span>' : '') . " $tooltipHtml</label>";
                $html .= '<div class="col-md-10">';

                switch ($type) {
                    case 'text':
                        $html .= "<input name=\"$name\" type=\"text\" id=\"$name\" maxlength=\"$maxLength\" class=\"$inputClass\" $parsleyTrigger $requiredAttr />";
                        break;
                    case 'radio':
                        foreach ($options as $value => $optionLabel) {
                            $checked = $value == $default ? 'checked' : '';
                            $html .= "<div class=\"form-check form-check-inline\">";
                            $html .= "<input class=\"form-check-input\" type=\"radio\" name=\"$name\" id=\"$name" . "_$value\" value=\"$value\" $checked />";
                            $html .= "<label class=\"form-check-label\" for=\"$name" . "_$value\">$optionLabel</label>";
                            $html .= "</div>";
                        }
                        break;
                    case 'select':
                        $html .= "<select name=\"$name\" id=\"$name\" class=\"$inputClass\" $parsleyTrigger $requiredAttr>";
                        $html .= '<option value="">-- 選擇 --</option>';
                        foreach ($options as $option) {
                            $optionValue = is_array($option) ? $option['itemname'] : $option;
                            $itemname = $option['itemname'];
                            $selected = $default == $itemname ? 'selected' : '';
                            $html .= "<option value=\"$itemname\" $selected>$itemname</option>";
                        }
                        $html .= "</select>";
                        break;
                    case 'textarea':
                        $html .= "<textarea name=\"$name\" id=\"$name\" cols=\"100%\" rows=\"35\" class=\"$inputClass\"></textarea>";
                        break;
                    case 'date':
                        $currentDate = (new DateTime())->format('Y-m-d');
                        $html .= "<input name=\"$name\" type=\"text\" class=\"$inputClass date-picker\" id=\"$name\" value=\"$currentDate\" maxlength=\"10\" data-provide=\"datepicker\" data-date-format=\"yyyy-mm-dd\" data-parsley-trigger=\"blur\" data-date-language=\"zh-TW\" $requiredAttr autocomplete=\"off\"/>";
                        break;
                    case 'file': // 新增的檔案上傳欄位
                        $html .= "<input id=\"$name\" name=\"$name\" type=\"file\" size=\"50\" maxlength=\"50\" class=\"$inputClass\" $parsleyTrigger $requiredAttr />";
                        break;
                }

                $html .= '</div></div>';
                return $html;
            }

            // 渲染表單
            function renderForm($fields)
            {
                $formHtml = '';
                foreach ($fields as $name => $field) {
                    $formHtml .= renderFormField($name, $field);
                }
                return $formHtml;
            }

            echo renderForm($formFields);
            ?>

            <div class="form-group row">
                <label class="col-md-2 col-form-label"></label>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary w-100 btn-block">送出</button>
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordActnews['id']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordActnews['lang']; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="oldpic" type="hidden" id="oldpic" value="<?php echo $row_RecordActnews['pic']; ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_update" value="form_Actnews" />
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
    <!-- end panel-body -->
</div>
<!-- end panel -->

<script type="text/javascript">
    <?php
    /*
    文檔
    https://github.com/kartik-v/bootstrap-fileinput/wiki/12.-%E4%B8%80%E4%BA%9B%E6%A0%B7%E4%BE%8B%E4%BB%A3%E7%A0%81
    */
    ?>
    $(document).ready(function() {
        $("#pic").fileinput({
            showUpload:false,
            uploadAsync: false, //设置上传同步异步(true) 此为同步(false)
            //uploadUrl: "index.php", //上传的地址
            allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文檔後綴
            //resizeImage: true,
            maxImageWidth: 1500,
            maxImageHeight: 1500,
            //resizePreference: 'width',
            //maxFileCount:10,
            maxFileSize: 3000,
            overwriteInitial: true, // 上傳圖片時是否會覆蓋預覽圖
            showRemove :false, //显示移除按钮
            <?php if($row_RecordActnews['pic'] != "") { ?>
            initialPreview: [<?php echo "'" . BASEURL . "/site/" . $wshop ."/image/actnews/" . $row_RecordActnews['pic'] .  "'"; ?>],
            <?php } ?>
            initialPreviewAsData: true // 确定你是否仅发送预览数据，而不是原始标记
        }).on('filepredelete', function(event, id) {
            var aborted = !window.confirm("確定删除? 此動作將無法恢復。");
            if (aborted) {
                return aborted;
            }
            //});
        }).on('filedeleted', function() {
            //setTimeout(function() {
            swal({
                title: '已刪除',
                text: '資料刪除成功！',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: '確定',
                confirmButtonClass: "btn btn-primary m-5px"
            })
            //}, 900);
        });
    });
</script>

<?php if(isset($_SESSION['DB_Edit']) && $_SESSION['DB_Edit'] === "Success") { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5px"});
        });
    </script>
    <?php unset($_SESSION["DB_Edit"]); ?>
<?php } ?>
