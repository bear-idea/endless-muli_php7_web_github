<?php
use Illuminate\Container\Container;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Intervention\Image\ImageManager;

/**
 * 渲染小工具。
 *
 * @param string $url 超連結 URL
 * @param string $iconClass 圖標類別
 * @param string $label 標籤文字
 * @param string $colorClass 背景顏色類別，預設為 'bg-purple-300'
 * @return void
 */
function renderWidget($url, $iconClass, $label, $colorClass = '')
{
    // 如果 $colorClass 為空，設置默認值
    if (empty($colorClass)) {
        $colorClass = 'cl_gray2'; // 或者你希望的任何默認值
    }

    // 開始生成 HTML
    echo '<div>';
    echo '<a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '">';
    echo '<div class="widget widget-stats Menu_ListView_Icon_Board ' . htmlspecialchars($colorClass, ENT_QUOTES, 'UTF-8') . '">';

    // 顯示圖標
    echo '<div class="stats-icon stats-icon-lg">';
    echo renderIcon($iconClass, 'fs-100px');
    echo '</div>';

    // 顯示內容
    echo '<div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center">';
    echo '<div>' . renderIcon($iconClass, 'fs-50px') . '</div>';
    echo '<div class="fw-bolder">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</div>';
    echo '</div>';

    echo '</div>';
    echo '</a>';
    echo '</div>';
}

/**
 * 渲染圖標。
 *
 * @param string $iconClass 圖標類別
 * @param string $sizeClass 大小類別
 * @return string 渲染後的 HTML 代碼
 */
function renderIcon($iconClass, $sizeClass)
{
    // 判斷是否為 Font Awesome 圖標類型
    if (preg_match('/^fa[srldb]? fa-/', $iconClass) || preg_match('/^fa-/', $iconClass)) {
        return '<i class="' . htmlspecialchars($iconClass, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($sizeClass, ENT_QUOTES, 'UTF-8') . '"></i>';
    } else {
        return '<span class="iconify ' . htmlspecialchars($sizeClass, ENT_QUOTES, 'UTF-8') . '" data-icon="' . htmlspecialchars($iconClass, ENT_QUOTES, 'UTF-8') . '"></span>';
    }
}

/**
 * 渲染表單字段
 *
 * 此函數根據提供的字段屬性渲染不同類型的表單元素，如文本框、選擇框、文件上傳等。
 *
 * @param string $name 表單字段的名稱，用於 `name` 和 `id` 屬性
 * @param array $field 包含表單字段屬性的信息，包括以下鍵值：
 *                     - 'label': string 顯示的標籤名稱
 *                     - 'type': string 字段的類型 (如 'text', 'select', 'checkbox', 'radio' 等)
 *                     - 'maxlength': int 最大長度（僅對輸入框有效）
 *                     - 'required': bool 是否必填
 *                     - 'columns': array 多文本字段的列數（僅對 multi_text 類型有效）
 *                     - 'options': array 可供選擇的選項（僅對 select, radio 等類型有效）
 *                     - 'default': string 默認值
 *                     - 'tooltip': string 工具提示信息
 *                     - 'link': string 與字段相關的鏈接
 *                     - 'errorContainer': string 錯誤信息顯示容器的 ID
 *                     - 'value': string 字段的當前值
 *                     - 'selected': string 已選中的選項值
 *                     - 'checked': bool 是否勾選（適用於 checkbox 和 radio）
 *                     - 'disabled': bool 是否禁用字段
 *                     - 'parsley': array 用於 Parsley.js 驗證的屬性
 *                     - 'initialPreview': array 初始預覽圖片列表（僅對 file 類型有效）
 *                     - 'initialPreviewConfig': array 初始預覽配置（僅對 multi_image 類型有效）
 * @param array $scripts 用於存儲需要動態添加的 JavaScript 腳本的數組
 * @return string 返回渲染後的 HTML 字符串
 */
function renderFormField($name, $field, &$scripts): string
{
    // 提取字段屬性
    $label = $field['label'];
    $type = $field['type'];
    $maxLength = $field['maxlength'] ?? '';
    $isRequired = $field['required'] ?? false; // 是否必填，默認為 false
    $columns = $field['columns'] ?? []; // 多文本字段的列數，默認為空數組
    $options = $field['options'] ?? []; // 選項列表，默認為空數組
    $default = $field['default'] ?? ''; // 默認值
    $tooltip = $field['tooltip'] ?? ''; // 工具提示信息
    $link = $field['link'] ?? ''; // 與字段相關的鏈接
    $errorContainer = $field['errorContainer'] ?? ''; // 錯誤信息顯示容器的 ID
    $value = $field['value'] ?? $default; // 字段的當前值，默認為 `default`
    $selected = $field['selected'] ?? $default; // 已選中的選項值
    $checked = $field['checked'] ?? $default; // 是否勾選，默認為 `default`
    $isDisabled = $field['disabled'] ?? false; // 是否禁用字段，默認為 false
    $readonly = $isDisabled ? 'readonly' : '';
    $disabled = $isDisabled ? 'disabled' : '';

    // 判斷是否必填並設置 Parsley.js 屬性
    $requiredAttr = $isRequired ? 'required' : '';
    $parsleyTrigger = 'data-parsley-trigger="blur"';
    $parsleyAttrs = '';

    if (isset($field['parsley'])) {
        foreach ($field['parsley'] as $key => $val) {
            $parsleyAttrs .= " data-parsley-{$key}=\"{$val}\"";
        }
    }

    $inputClass = 'form-control';

    $tooltipHtml = $tooltip ? '<i class="fa-solid fa-circle-question ms-5px" data-bs-original-title="' . $tooltip . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="text-start"></i>' : '';

    $html = '<div class="form-group row">';
    $html .= "<label class=\"col-md-2 col-form-label\">$label" . ($isRequired ? '<span class="text-red ms-5px"><sup><i class="fa-solid fa-star"></i></sup></span>' : '') . " $tooltipHtml</label>";
    $html .= '<div class="col-md-10">';

    switch ($type) {
        case 'separator':
            $html = "<div class=\"form-group row\"><div class=\"col-md-12\"><span class=\"badge bg-primary rounded-pill\"><i class=\"fa fa-paper-plane\"></i> $label</span>";
            break;
        case 'text':
            $html .= "<input name=\"$name\" type=\"text\" id=\"$name\" value=\"$value\" maxlength=\"$maxLength\" class=\"$inputClass\" $parsleyTrigger $parsleyAttrs $requiredAttr $readonly $disabled />";
            break;
        case 'color':
            $html .= "<input name=\"$name\" type=\"text\" id=\"$name\" value=\"$value\" class=\"$inputClass colorpicker\" $parsleyTrigger $parsleyAttrs $requiredAttr $readonly $disabled />";
            push_script($scripts, "<script type='text/javascript'> $('#$name').colorpicker(); </script>");
            break;
        case 'phone':
            $html .= "<input name=\"$name\" type=\"tel\" id=\"$name\" value=\"$value\" class=\"$inputClass\" $parsleyTrigger $parsleyAttrs $requiredAttr $readonly $disabled />";
            break;
        case 'email':
            $html .= "<input name=\"$name\" type=\"email\" id=\"$name\" value=\"$value\" class=\"$inputClass\" $parsleyTrigger $parsleyAttrs $requiredAttr $readonly $disabled />";
            break;
        case 'password':
            $html .= "<input name=\"$name\" type=\"password\" id=\"$name\" value=\"$value\" maxlength=\"$maxLength\" class=\"$inputClass\" $parsleyAttrs $requiredAttr $readonly $disabled />";
            $html .= "<div id=\"$errorContainer\"></div>";
            break;
        case 'url':
            $html .= "<input name=\"$name\" type=\"url\" id=\"$name\" value=\"$value\" maxlength=\"$maxLength\" class=\"$inputClass\" $parsleyTrigger $parsleyAttrs $requiredAttr $readonly $disabled />";
            break;
        case 'ip':
            $html .= "<input name=\"$name\" type=\"text\" id=\"$name\" value=\"$value\" class=\"$inputClass\" $parsleyTrigger $parsleyAttrs $requiredAttr $readonly $disabled pattern=\"^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$\" />";
            break;
        case 'latitude_longitude':
            $html .= "<input name=\"$name\" type=\"text\" id=\"$name\" value=\"$value\" class=\"$inputClass latlng-picker\" $parsleyTrigger $parsleyAttrs $requiredAttr $readonly $disabled />";
            push_script($scripts, "<script type='text/javascript'> $('#$name').latlngPicker(); </script>");
            break;
        case 'radio':
            foreach ($options as $optionValue => $optionLabel) {
                $isChecked = ($checked == $optionValue) ? 'checked' : '';
                $html .= "<div class=\"form-check form-check-inline\">";
                $html .= "<input class=\"form-check-input\" type=\"radio\" name=\"$name\" id=\"$name" . "_$optionValue\" value=\"$optionValue\" $isChecked $disabled />";
                $html .= "<label for=\"$name" . "_$optionValue\">$optionLabel</label>";
                $html .= "</div>";
            }
            break;
        case 'radioWithImage':
            foreach ($options as $optionValue => $option) {
                $optionLabel = $option['label'];
                $optionImage = $option['image'];
                $isChecked = ($checked == $optionValue) ? 'checked' : '';
                $html .= "<div class=\"form-check form-check-inline\">";
                $html .= "<input class=\"form-check-input\" type=\"radio\" name=\"$name\" id=\"$name" . "_$optionValue\" value=\"$optionValue\" $isChecked $disabled />";
                $html .= "<label for=\"$name" . "_$optionValue\">";
                $html .= "<img src=\"$optionImage\" alt=\"$optionLabel\" style=\"width: 20px; height: 20px; margin-right: 5px;\">";
                $html .= "$optionLabel</label>";
                $html .= "</div>";
            }
            break;
        case 'radioWithFontIcon':
            foreach ($options as $option) {
                $optionLabel = $option['label'];
                $optionIcon = $option['icon']; // 使用 FontAwesome 图标类名
                $optionValue = $option['value'];
                $isChecked = ($checked == $optionValue) ? 'checked' : '';
                $html .= "<div class=\"form-check form-check-inline\">";
                $html .= "<input class=\"form-check-input\" type=\"radio\" name=\"$name\" id=\"$name" . "_$optionValue\" value=\"$optionValue\" $isChecked $disabled />";
                $html .= "<label for=\"$name" . "_$optionValue\">";
                $html .= renderIcon($optionIcon, 'fa-lg'); // 使用 FontAwesome 图标
                $html .= "$optionLabel</label>";
                $html .= "</div>";
            }
            break;
        case 'radioWithCardFontIcon':
            $html .= "<div class=\"d-flex d-flex-wrap align-items-start\">";
            foreach ($options as $option) {
                $optionLabel = $option['label'];
                $optionIcon = $option['icon']; // 使用 FontAwesome 图标类名
                $optionValue = $option['value'];
                $isChecked = ($checked == $optionValue) ? 'checked' : '';
                $html .= "<div class=\"custom-option custom-option-icon p-3 align-items-start text-center w-150px\">";
                $html .= "<label for=\"$name" . "_$optionValue\">";
                $html .= "<div class=\"custom-option-content\">";
                $html .= renderIcon($optionIcon, 'fs-50px').'<br>'; // 使用 FontAwesome 图标
                $html .= "<div class=\"custom-option-title mb-2\">";
                $html .= "$optionLabel";
                $html .= "</div>";
                $html .= "<input class=\"form-check-input\" type=\"radio\" name=\"$name\" id=\"$name" . "_$optionValue\" value=\"$optionValue\" $isChecked $disabled />";
                $html .= "</div>";
                $html .= "</label>";
                $html .= "</div>";
            }
            $html .= "</div>";
            break;
        case 'select':
            $html .= "<select name=\"$name\" id=\"$name\" class=\"$inputClass form-select\" $parsleyTrigger $parsleyAttrs $requiredAttr $disabled>";
            $html .= '<option value="">-- 選擇 --</option>';
            foreach ($options as $option) {
                $optionValue = is_array($option) ? $option['itemname'] : $option;
                $isSelected = ($selected == $optionValue->itemname) ? 'selected' : '';
                $html .= "<option value=\"$optionValue->itemname\" $isSelected>$optionValue->itemname</option>";
            }
            $html .= "</select>";
            break;
        case 'customizeSelect':
            $valueField = $field['valueField'] ?? 'value'; // 默認值為 'value'
            $nameField = $field['nameField'] ?? 'name';   // 默認值為 'name'

            $html .= "<select name=\"$name\" id=\"$name\" class=\"$inputClass form-select\" $parsleyTrigger $parsleyAttrs $requiredAttr $disabled>";
            $html .= '<option value="">-- 選擇 --</option>';

            foreach ($options as $option) {
                if (is_array($option)) {
                    $itemValue = $option[$valueField] ?? '';
                    $itemName = $option[$nameField] ?? '';
                } elseif (is_object($option)) {
                    $itemValue = $option->$valueField ?? '';
                    $itemName = $option->$nameField ?? '';
                } else {
                    $itemValue = '';
                    $itemName = '';
                }

                $isSelected = ($selected == $itemValue) ? 'selected' : '';
                $html .= "<option value=\"$itemValue\" $isSelected>$itemName</option>";
            }

            $html .= "</select>";
            break;
        case 'multilevel_select':
            $html .= renderMultilevelSelect($name, $field, $scripts);
            break;
        case 'checkbox':
            $isChecked = ($value) ? 'checked' : '';
            $html .= "<div class=\"form-group\">";
            $html .= "<label for=\"$name\">$label</label>";
            $html .= "<input type=\"checkbox\" name=\"$name\" id=\"$name\" class=\"$inputClass\" value=\"1\" $isChecked $requiredAttr $parsleyTrigger $parsleyAttrs $disabled>";
            $html .= "</div>";
            break;

        case 'checkboxGroup':
            foreach ($field['options'] as $option) {
                $optionName = $option['name'];
                $optionLabel = $option['label'];
                $optionValue = $option['value'];
                $isChecked = ($option['checked']) ? 'checked' : '';
                $html .= "<div class=\"form-check form-check-inline\">";
                $html .= "<input class=\"form-check-input\" type=\"checkbox\" name=\"$optionName\" id=\"$optionName\" value=\"$optionValue\" $isChecked />";
                $html .= "<label class=\"form-check-label\" for=\"$optionName\">$optionLabel</label>";
                $html .= "</div>";
            }
            break;
        case 'textarea':
            $html .= "<textarea name=\"$name\" id=\"$name\" cols=\"100%\" rows=\"35\" class=\"$inputClass\" $readonly $disabled>$value</textarea>";
            break;
        case 'date':
            $html .= "<input name=\"$name\" type=\"text\" class=\"$inputClass date-picker\" id=\"$name\" value=\"$value\" maxlength=\"20\" data-provide=\"datepicker\" data-date-format=\"yyyy-mm-dd\" data-parsley-trigger=\"blur\" data-date-language=\"zh-TW\" $requiredAttr autocomplete=\"off\" $readonly $disabled />";
            break;
        case 'datetime':
            $html .= "<input name=\"$name\" type=\"text\" class=\"$inputClass datetime-picker\" id=\"$name\" value=\"$value\" maxlength=\"$maxLength\" data-provide=\"datetimepicker\" data-date-format=\"yyyy-mm-dd hh:ii:ss\" data-parsley-trigger=\"blur\" data-date-language=\"zh-TW\" $requiredAttr autocomplete=\"off\" $readonly $disabled />";
            break;
        case 'tagsinput':
            $html .= "<input name=\"$name\" type=\"text\" id=\"$name\" class=\"$inputClass\" value=\"$value\" data-role=\"tagsinput\" $parsleyTrigger $parsleyAttrs $requiredAttr $readonly $disabled />";
            push_script($scripts, "<script type='text/javascript'> $('#$name').tagsinput(); </script>");
            break;
        case 'file':
            $html .= "<input id=\"$name\" name=\"$name\" type=\"file\" maxlength=\"$maxLength\" class=\"$inputClass\" $parsleyTrigger $parsleyAttrs data-parsley-errors-container=\"#$errorContainer\" $disabled />";
            $html .= "<div id=\"$errorContainer\"></div>";
            $initialPreview = $field['initialPreview'] ?? [];
            $initialPreviewJson = json_encode($initialPreview);
            //$initialPreview = !empty($value) ? "initialPreview: ['" . BASEURL . "/site/" . $_SESSION['wshop'] . "/image/seo/" . $value . "']," : "";
            push_script($scripts, "<script type='text/javascript'> $('#$name').fileinput({ theme: 'fa', language: 'zh-TW', showUpload: false, uploadAsync: false, allowedFileExtensions: ['jpg', 'gif', 'png', 'webp', 'svg'], maxImageWidth: 1500, maxImageHeight: 1500, maxFileSize: 3000, overwriteInitial: true, showRemove: true, initialPreviewAsData: true, initialPreview: $initialPreviewJson }); </script>");
            break;
        case 'multi_image':
            $html .= "<input id=\"$name\" name=\"{$name}[]\" type=\"file\" maxlength=\"$maxLength\" class=\"$inputClass\" $parsleyTrigger $parsleyAttrs data-parsley-errors-container=\"#$errorContainer\" multiple=\"multiple\" $disabled />";
            $html .= "<div id=\"$errorContainer\"></div>";
            $initialPreview = $field['initialPreview'] ?? [];
            $initialPreviewConfig = $field['initialPreviewConfig'] ?? [];
            $initialPreviewJson = json_encode($initialPreview);
            $initialPreviewConfigJson = json_encode($initialPreviewConfig);
            push_script($scripts, "<script type='text/javascript'> $('#$name').fileinput({ theme: 'fa', language: 'zh-TW', showUpload: false, uploadAsync: false, allowedFileExtensions: ['jpg', 'gif', 'png', 'webp', 'svg'], maxImageWidth: 1500, maxImageHeight: 1500, maxFileSize: 3000, overwriteInitial: true, showRemove: true, initialPreviewAsData: true, initialPreview: $initialPreviewJson, initialPreviewConfig: $initialPreviewConfigJson }).on('filedeleted', function() { swal({ title: '已刪除', text: '圖片刪除成功！', icon: 'success', confirmButtonText: '確定', confirmButtonClass: 'btn btn-primary m-5px', buttonsStyling: false }) }); </script>");
            break;
        case 'upload_link_button':
            $html .= "<a href=\"$link\" class='btn btn-warning colorbox_iframe_cd' $disabled><i class='fa fa-image'></i> 圖片修改</a>";
            break;
        case 'textarea_link':
            $html .= "<textarea name=\"$name\" id=\"$name\" class=\"$inputClass\" $readonly $disabled>$value</textarea>";
            if ($link) {
                $html .= "<a href=\"$link\" target=\"_blank\">$link</a>";
            }
            break;
        case 'multiselect':
            $html .= "<select name=\"{$name}[]\" id=\"$name\" class=\"selectpicker form-control\" multiple $disabled>";
            foreach ($options as $option) {
                $optionValue = is_array($option) ? $option['itemname'] : $option;
                $itemname = $option['itemname'];
                $itemvalue = $option['itemvalue'];
                $isSelected = in_array($itemvalue, (array)$selected) ? 'selected' : '';
                $html .= "<option value=\"$itemvalue\" $isSelected>$itemname</option>";
            }
            $html .= "</select>";
            push_script($scripts, "<script type='text/javascript'> $('#$name').picker(); </script>");
            break;
        case 'switch':
            $checked = $value ? 'checked' : '';
            $html .= "<div class=\"form-check form-switch\">";
            $html .= "<input class=\"form-check-input\" type=\"checkbox\" id=\"$name\" name=\"$name\" value=\"1\" $checked $disabled />";
            $html .= "</div>";
            break;
        case 'multi_text':
            $html .= renderMultiTextFields($name, $columns, $value, $maxLength, $inputClass, $parsleyTrigger, $requiredAttr, $readonly, $disabled, $scripts);
            break;
        default:
            break;
    }

    $html .= '</div></div>';

    return $html;
}

/**
 * 渲染整個表單
 *
 * @param array $fields 包含表單字段的數組
 * @param array $scripts 用於存儲需要動態添加的 JavaScript 腳本
 * @return string 返回渲染後的完整表單 HTML 字符串
 */
function renderForm($fields, &$scripts): string
{
    $formHtml = '';
    foreach ($fields as $name => $field) {
        $formHtml .= renderFormField($name, $field, $scripts);
    }
    return $formHtml;
}

/**
 * 渲染多行文本字段
 *
 * @param string $name 表單字段的名稱
 * @param array $columns 欄位屬性
 * @param array $values 預設值
 * @param int $maxLength 最大長度
 * @param string $inputClass 輸入框類名
 * @param string $parsleyTrigger Parsley 觸發屬性
 * @param string $requiredAttr 是否必填屬性
 * @param string $readonly 是否為唯讀屬性
 * @param string $disabled 是否禁用屬性
 * @param array $scripts 用於存儲需要動態添加的 JavaScript 腳本
 * @param bool $isRequired 是否需要顯示新增行按鈕
 * @return string 返回渲染後的 HTML 字符串
 *
 */

/*'
設定值參考
multi_level_select' => [
        'label' => '多層級聯選單',
        'type' => 'multilevel_select',
        'value_field' => 'id', // 動態值欄位
        'name_field' => 'itemname', // 動態名稱欄位
        'required' => true,
        'options' => generateDynamicOptions($RecordMultiListItemMenu, ['id', 'itemname']),
        'selected' => ['level1' => '1', 'level2' => '1-1'], // 設定初始值
        'url' => ADMINURL . generateUrl( "list-item-menu/News/Type/getJsonChildren") // Laravel 路由，用於動態加載數據
    ],
*/
function renderMultiTextFields($name, $columns, $values, $maxLength, $inputClass, $parsleyTrigger, $requiredAttr, $readonly, $disabled, &$scripts, $isRequired = true): string
{
    $numFields = count($columns);
    $fieldColSize = 12 - 2; // 12 - col-2
    $colSize = floor($fieldColSize / $numFields); // 每個欄位的寬度

    $html = '<div id="multi_text_wrapper_' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '">';

    // 顯示至少一行
    if (is_array($values) && count($values) > 0) {
        foreach ($values as $index => $v) {
            $html .= '<div class="multi_text_row row">';
            foreach ($columns as $column => $attributes) {
                $columnLabel = htmlspecialchars($attributes['label'], ENT_QUOTES, 'UTF-8');
                $fieldValue = htmlspecialchars($v[$column] ?? '', ENT_QUOTES, 'UTF-8');
                $fieldType = $attributes['type'] ?? 'text'; // Default to text if not set

                $html .= '<div class="col-' . $colSize . '">';
                $html .= '<div class="input-group p-0 mb-2">';
                $html .= '<span class="input-group-text">' . $columnLabel . '</span>';

                if ($fieldType === 'select') {
                    $options = $attributes['options'] ?? [];
                    $html .= '<select name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '[' . htmlspecialchars($column, ENT_QUOTES, 'UTF-8') . '][]" class="' . $inputClass . '" ' . $parsleyTrigger . ' ' . $requiredAttr . ' ' . $readonly . ' ' . $disabled . '>';
                    foreach ($options as $value => $label) {
                        $selected = $value == $fieldValue ? ' selected' : '';
                        $html .= '<option value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"' . $selected . '>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</option>';
                    }
                    $html .= '</select>';
                } elseif ($fieldType === 'number') {
                    $min = $attributes['min'] ?? '';
                    $max = $attributes['max'] ?? '';
                    $step = $attributes['step'] ?? '';
                    $html .= '<input name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '[' . htmlspecialchars($column, ENT_QUOTES, 'UTF-8') . '][]" type="number" value="' . htmlspecialchars($fieldValue, ENT_QUOTES, 'UTF-8') . '" maxlength="' . $maxLength . '" class="' . $inputClass . '" ' . $parsleyTrigger . ' ' . $requiredAttr . ' ' . $readonly . ' ' . $disabled . ' min="' . htmlspecialchars($min, ENT_QUOTES, 'UTF-8') . '" max="' . htmlspecialchars($max, ENT_QUOTES, 'UTF-8') . '" step="' . htmlspecialchars($step, ENT_QUOTES, 'UTF-8') . '"/>';
                } else {
                    $html .= '<input name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '[' . htmlspecialchars($column, ENT_QUOTES, 'UTF-8') . '][]" type="text" value="' . $fieldValue . '" maxlength="' . $maxLength . '" class="' . $inputClass . '" ' . $parsleyTrigger . ' ' . $requiredAttr . ' ' . $readonly . ' ' . $disabled . ' />';
                }

                $html .= '</div>';
                $html .= '</div>';
            }

            // 按鈕欄位寬度
            $html .= '<div class="col-2 text-start mb-2">';
            $html .= '<button type="button" class="btn btn-danger btn-remove-multi-text"' . ($index == 0 ? ' style="display:none;"' : '') . '>移除</button>';
            $html .= '<button type="button" class="btn btn-primary btn-add-multi-text"' . ($index != 0 ? ' style="display:none;"' : '') . '>新增</button>';
            $html .= '</div>';
            $html .= '</div>';
        }
    } else {
        // 顯示一行空白
        $html .= '<div class="multi_text_row row">';
        foreach ($columns as $column => $attributes) {
            $columnLabel = htmlspecialchars($attributes['label'], ENT_QUOTES, 'UTF-8');
            $fieldType = $attributes['type'] ?? 'text'; // Default to text if not set

            $html .= '<div class="col-' . $colSize . '">';
            $html .= '<div class="input-group p-0 mb-2">';
            $html .= '<span class="input-group-text">' . $columnLabel . '</span>';

            if ($fieldType === 'select') {
                $options = $attributes['options'] ?? [];
                $html .= '<select name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '[' . htmlspecialchars($column, ENT_QUOTES, 'UTF-8') . '][]" class="' . $inputClass . '" ' . $parsleyTrigger . ' ' . $requiredAttr . ' ' . $readonly . ' ' . $disabled . '>';
                foreach ($options as $value => $label) {
                    $html .= '<option value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</option>';
                }
                $html .= '</select>';
            } elseif ($fieldType === 'number') {
                $min = $attributes['min'] ?? '';
                $max = $attributes['max'] ?? '';
                $step = $attributes['step'] ?? '';
                $html .= '<input name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '[' . htmlspecialchars($column, ENT_QUOTES, 'UTF-8') . '][]" type="number" maxlength="' . $maxLength . '" class="' . $inputClass . '" ' . $parsleyTrigger . ' ' . $requiredAttr . ' ' . $readonly . ' ' . $disabled . ' min="' . htmlspecialchars($min, ENT_QUOTES, 'UTF-8') . '" max="' . htmlspecialchars($max, ENT_QUOTES, 'UTF-8') . '" step="' . htmlspecialchars($step, ENT_QUOTES, 'UTF-8') . '"/>';
            } else {
                $html .= '<input name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '[' . htmlspecialchars($column, ENT_QUOTES, 'UTF-8') . '][]" type="text" maxlength="' . $maxLength . '" class="' . $inputClass . '" ' . $parsleyTrigger . ' ' . $requiredAttr . ' ' . $readonly . ' ' . $disabled . ' />';
            }

            $html .= '</div>';
            $html .= '</div>';
        }

        // 按鈕欄位寬度
        $html .= '<div class="col-2 text-start mb-2">';
        $html .= '<button type="button" class="btn btn-danger btn-remove-multi-text" style="display:none;">移除</button>'; // 初始行不可移除
        $html .= '<button type="button" class="btn btn-primary btn-add-multi-text"' . ($isRequired ? '' : ' disabled') . '>新增</button>';
        $html .= '</div>';
        $html .= '</div>';
    }

    $html .= '</div>';

    // 添加 JavaScript 代碼以支持動態添加/刪除行
    push_script($scripts, "<script type='text/javascript'>
        $(document).ready(function() {
            var wrapper = $('#multi_text_wrapper_" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "');
            var rowTemplate = wrapper.find('.multi_text_row:first').clone();

            // 重置範本行中的輸入值
            rowTemplate.find('input, select').val('');
            rowTemplate.find('.btn-remove-multi-text').show();
            rowTemplate.find('.btn-add-multi-text').hide();

            wrapper.on('click', '.btn-add-multi-text', function() {
                var newRow = rowTemplate.clone();
                newRow.find('.btn-remove-multi-text').show();
                newRow.find('.btn-add-multi-text').hide();
                wrapper.append(newRow);
            });

            wrapper.on('click', '.btn-remove-multi-text', function() {
                $(this).closest('.multi_text_row').remove();
            });
        });
    </script>");

    return $html;
}

/**
 * 渲染多圖像上傳字段
 *
 * @param string $name 表單字段的名稱
 * @param int $maxLength 最大長度
 * @param string $inputClass 輸入字段的 CSS 類
 * @param string $parsleyTrigger Parsley 觸發器屬性
 * @param string $requiredAttr 是否必填屬性
 * @param string $readonly 是否為只讀屬性
 * @param string $disabled 是否禁用屬性
 * @param array $field 輸入字段的屬性，包括初始預覽數據
 * @param array $scripts 用於存儲需要動態添加的 JavaScript 腳本
 * @return string 返回渲染後的 HTML 字符串
 */
function renderMultiImageField($name, $maxLength, $inputClass, $parsleyTrigger, $requiredAttr, $readonly, $disabled, $field, &$scripts): string
{
    $html = "<input id=\"$name\" name=\"{$name}[]\" type=\"file\" maxlength=\"$maxLength\" class=\"$inputClass\" $parsleyTrigger data-parsley-errors-container=\"#$errorContainer\" multiple=\"multiple\" $disabled />";
    $html .= "<div id=\"$errorContainer\"></div>";

    $initialPreview = $field['initialPreview'] ?? [];
    $initialPreviewConfig = $field['initialPreviewConfig'] ?? [];
    $initialPreviewJson = json_encode($initialPreview);
    $initialPreviewConfigJson = json_encode($initialPreviewConfig);

    push_script($scripts, "<script type='text/javascript'> $('#$name').fileinput({ theme: 'fa', language: 'zh-TW', showUpload: false, uploadAsync: false, allowedFileExtensions: ['jpg', 'gif', 'png', 'webp', 'svg'], maxImageWidth: 1500, maxImageHeight: 1500, maxFileSize: 3000, overwriteInitial: true, showRemove: true, initialPreviewAsData: true, initialPreview: $initialPreviewJson, initialPreviewConfig: $initialPreviewConfigJson }).on('filedeleted', function() { swal({ title: '已刪除', text: '圖片刪除成功！', icon: 'success', confirmButtonText: '確定', confirmButtonClass: 'btn btn-primary m-5px', buttonsStyling: false }) }); </script>");

    return $html;
}

/*
$formFields = [
    // 其他字段...
    'multi_level_select' => [
        'label' => '多層級聯選單',
        'type' => 'multilevel_select',
        'required' => true,
        'options' => [
            // 初始選項，根據實際需求設置
            ['value' => '1', 'label' => '選項 1', 'children' => [
                ['value' => '1-1', 'label' => '選項 1-1'],
                ['value' => '1-2', 'label' => '選項 1-2'],
            ]],
            ['value' => '2', 'label' => '選項 2', 'children' => [
                ['value' => '2-1', 'label' => '選項 2-1'],
                ['value' => '2-2', 'label' => '選項 2-2'],
            ]],
        ],
        'selected' => ['level1' => '1', 'level2' => '1-1'], // 設定初始值
        'url' => route('your_route_to_fetch_data'), // Laravel 路由，用於動態加載數據
    ],
];
 * */


/**
 * 渲染多層級聯選單
 *
 * @param string $name 表單字段的名稱
 * @param array $field 表單字段的屬性，包括標籤、選項、初始值等
 * @param array &$scripts 用於存儲需要動態添加的 JavaScript 腳本
 * @return string 返回渲染後的 HTML 字符串
 */
function renderMultilevelSelect($name, $field, array &$scripts): string
{
    $options = $field['options'] ?? [];
    $selected = $field['selected'] ?? [];
    $requiredAttr = $field['required'] ? 'required' : '';
    $parsleyTrigger = $field['parsleyTrigger'] ?? 'data-parsley-trigger="blur"';
    $disabled = $field['disabled'] ?? false ? 'disabled' : '';
    $selectClass = 'form-control form-select';
    $url = $field['url'] ?? '';

    // 動態值和名稱
    $valueField = $field['value_field'] ?? 'id';
    $nameField = $field['name_field'] ?? 'itemname';

    // 渲染初始選單層級
    $html = "<div id=\"{$name}_container\" class=\"row\">";
    $html .= renderMultilevelSelectChildren($name, $options, $selected, 1, $selectClass, $requiredAttr, $parsleyTrigger, $disabled, $valueField, $nameField);
    $html .= "</div>";

    // 添加 JavaScript 來處理連動邏輯
    $script = "
        <script type='text/javascript'>
            $(document).ready(function() {
                function updateColumnWidths() {
                    var numSelects = $('select[id^={$name}_level]').length;
                    var colClass = 'col-' + (12 / numSelects);
                    $('select[id^={$name}_level]').each(function() {
                        $(this).parent().removeClass('col-12 col-6 col-4 col-3').addClass(colClass);
                    });
                }

                $('select[id^={$name}_level]').change(function() {
                    var selectedValue = $(this).val();
                    var level = parseInt($(this).attr('id').match(/level(\\d+)/)[1]);
                    var nextLevel = level + 1;

                    $.ajax({
                        url: '$url',
                        method: 'GET',
                        data: {
                            parent_id: selectedValue,
                            depth: nextLevel,
                        },
                        success: function(data) {
                            //console.log('AJAX request succeeded');
                            //console.log('Response data:', data); // 查看返回的数据

                            // 移除所有後續層級選單和容器
                            for (var i = nextLevel; i <= $('select[id^={$name}_level]').length; i++) {
                                $('#{$name}_level' + i).parent().remove();
                                $('#{$name}_level' + i + '_children').remove();
                            }

                            if (data.length > 0) {
                                var nextSelectHtml = '<div class=\"col-12\">';
                                nextSelectHtml += '<select name=\"{$name}[level' + nextLevel + ']\" id=\"{$name}_level' + nextLevel + '\" class=\"$selectClass\" ' + (nextLevel === 1 ? '$parsleyTrigger $requiredAttr' : '') + ' $disabled>';
                                $.each(data, function(index, item) {
                                    nextSelectHtml += '<option value=\"' + item.{$valueField} + '\">' + item.{$nameField} + '</option>';
                                });
                                nextSelectHtml += '</select>';
                                nextSelectHtml += '</div>';

                                var nextChildrenHtml = '<div id=\"{$name}_level' + nextLevel + '_children\"></div>';

                                $('#{$name}_container').append(nextSelectHtml);
                                $('#{$name}_container').append(nextChildrenHtml);

                                // 調整所有選單的寬度
                                updateColumnWidths();

                                // 重新初始化 Parsley.js
                                $('#{$name}_container').parsley().destroy();
                                $('#{$name}_container').parsley();
                            } else {
                                // 如果沒有更多層級選單，重新調整寬度
                                updateColumnWidths();
                            }
                        }
                    });
                });

                // 初始化寬度
                updateColumnWidths();
            });
        </script>
    ";

    // 使用 push_script 函數來添加腳本
    push_script($scripts, $script);

    return $html;
}

/**
 * 遞歸渲染多層選單的子選項
 *
 * @param string $name 表單字段的名稱
 * @param array $children 子選項數組
 * @param array $selected 初始選中的選項數組
 * @param int $depth 當前層級
 * @param string $selectClass 選單的 class 屬性
 * @param string $requiredAttr 必填屬性
 * @param string $parsleyTrigger Parsley.js 的觸發屬性
 * @param string $disabled 禁用屬性
 * @param string $valueField 選項值欄位
 * @param string $nameField 選項名稱欄位
 * @return string 返回渲染後的 HTML 字符串
 */
function renderMultilevelSelectChildren($name, $children, $selected, $depth, $selectClass, $requiredAttr, $parsleyTrigger, $disabled, $valueField, $nameField): string
{
    $html = '';

    // 計算列寬
    $colClass = 'col-' . (12 / $depth); // 根據層級計算列寬

    $html .= "<div class=\"$colClass\"><select name=\"{$name}[level{$depth}]\" id=\"{$name}_level{$depth}\" class=\"$selectClass\" " . ($depth === 1 ? "$requiredAttr $parsleyTrigger" : '') . " $disabled>";
    if ($depth === 1) {
        $html .= '<option value="">-- 選擇 --</option>';
    }
    foreach ($children as $child) {
        $isSelected = ($selected["level{$depth}"] ?? '') == $child[$valueField] ? 'selected' : '';
        $html .= "<option value=\"{$child[$valueField]}\" $isSelected>{$child[$nameField]}</option>";
    }
    $html .= "</select></div>";

    foreach ($children as $child) {
        if (!empty($child['children'])) {
            $isVisible = ($selected["level{$depth}"] ?? '') == $child[$valueField] ? '' : 'style="display:none;"';
            $html .= "<div id=\"{$name}_level{$depth}_children\" $isVisible>";
            $html .= renderMultilevelSelectChildren($name, $child['children'], $selected, $depth + 1, $selectClass, $requiredAttr, $parsleyTrigger, $disabled, $valueField, $nameField);
            $html .= "</div>";
        }
    }

    return $html;
}

/**
 * 渲染通知标题模板
 *
 * @param string $iconClass 通知图标的 CSS 类
 * @param string $bgClass 背景颜色的 CSS 类
 * @param string $title 通知标题文本
 * @return string 渲染后的通知标题 HTML
 */
function renderNotificationTitle($iconClass, $bgClass, $title) {
    return sprintf(
        '<span class="d-flex align-items-center">
            <span class="%s rounded w-25px h-25px d-flex align-items-center justify-content-center text-white me-2">
                <i class="%s"></i>
            </span>
            %s
        </span>',
        $bgClass,
        $iconClass,
        $title
    );
}


