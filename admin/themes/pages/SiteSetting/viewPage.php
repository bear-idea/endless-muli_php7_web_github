<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");


$initialPreview_site_og_image = !empty(json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_og_image']) ? BASEURL . "/site/" . $_SESSION['wshop'] . "/image/seo/" . json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_og_image'] : '';
$initialPreview_site_favicon_image = !empty($row_RecordSiteSetting['site_favicon_image']) ? BASEURL . "/site/" . $_SESSION['wshop'] . "/image/seo/" . $row_RecordSiteSetting['site_favicon_image'] : '';

// 定義表單字段
$formFields = [
    'separator1' => ['label' => '網站基本資訊', 'type' => 'separator', 'required' => false],
    'site_title' => ['label' => '網站標題名稱', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_title'], 'tooltip' => '網站標題的顯示名稱及FB顯示名稱，會影響搜尋引擎搜尋之標題。'],
    'site_description' => ['label' => '網站描述', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_description'], 'tooltip' => '網站基本描述，會影響搜尋引擎搜尋之摘要。'],
    'site_indicate' => ['label' => '網站狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '開啟', '0' => '關閉'], 'checked' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_indicate'], 'tooltip' => '會顯示提示訊息告知正在維修中。'],
    'site_indicate_desc' => ['label' => '網站關閉狀態提示文字', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_indicate_desc'], 'tooltip' => '網站暫時關閉的提醒訊息。'],
    'site_copy_lock' => ['label' => '網站複製與否', 'type' => 'radio', 'required' => true, 'options' => ['1' => '開啟', '0' => '關閉'], 'checked' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_copy_lock'], 'tooltip' => '網站鎖定鍵盤和滑鼠。'],
    'site_url' => ['label' => '網站網址', 'type' => 'url', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_url'], 'tooltip' => ''],

    'separator2' => ['label' => '網站頁尾資訊', 'type' => 'separator', 'required' => false],
    'site_footer_title' => ['label' => '網站頁尾名稱', 'type' => 'text', 'maxlength' => 100, 'required' => true, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_footer_title']],
    'site_footer_phone' => ['label' => '網站電話', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_footer_phone']],
    'site_footer_cell' => ['label' => '行動/手機', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_footer_cell']],
    'site_footer_fax' => ['label' => '傳真', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_footer_fax']],
    'site_footer_line' => ['label' => 'LINE ID', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_footer_line']],
    'site_footer_mail' => ['label' => '電子郵件', 'type' => 'email', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_footer_mail']],
    'site_footer_mail_name' => ['label' => '電子郵件寄件名稱', 'type' => 'text', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SiteInformation, true)[$_SESSION['lang']]['site_footer_mail_name']],

    'separator3' => ['label' => '其他', 'type' => 'separator', 'required' => false],
    'site_og_image' => ['label' => '社群發佈圖示(og:image)', 'type' => 'file', 'maxlength' => 200, 'required' => false, 'initialPreview' => $initialPreview_site_og_image, 'value' => $row_RecordSiteSetting['site_og_image'], 'tooltip' => 'og:image 用戶將內容分享至社群時顯示的圖像網址。 (網頁的預覽圖)', 'errorContainer' => 'error_site_og_image'],
    'site_favicon_image' => ['label' => '網站標題小圖示(Favicon)', 'type' => 'file', 'maxlength' => 200, 'required' => false, 'initialPreview' => $initialPreview_site_favicon_image, 'value' => $row_RecordSiteSetting['site_favicon_image'], 'tooltip' => '顯示於網站頁簽的小圖示 附檔名為.ico。', 'errorContainer' => 'error_site_icon_image'],

    'separator4' => ['label' => '社群網址', 'type' => 'separator', 'required' => false],
    'site_Facebook' => ['label' => '<i class="fa-brands fa-facebook"></i> Facebook', 'type' => 'url', 'maxlength' => 200, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SocialInformation, true)[$_SESSION['lang']]['site_Facebook']],
    'site_Instagram' => ['label' => '<i class="fa-brands fa-square-instagram"></i> Instagram', 'type' => 'url', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SocialInformation, true)[$_SESSION['lang']]['site_Instagram']],
    'site_Line' => ['label' => '<i class="fa-brands fa-line"></i> LINE', 'type' => 'url', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SocialInformation, true)[$_SESSION['lang']]['site_Line']],
    'site_Youtube' => ['label' => '<i class="fa-brands fa-youtube"></i> LINE', 'type' => 'url', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SocialInformation, true)[$_SESSION['lang']]['site_Youtube']],
    'site_twitter' => ['label' => '<i class="fa-brands fa-x-twitter"></i> Twitter/X', 'type' => 'url', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SocialInformation, true)[$_SESSION['lang']]['site_twitter']],
    'site_LinkedIn' => ['label' => '<i class="fa-brands fa-linkedin"></i> LinkedIn', 'type' => 'url', 'maxlength' => 100, 'required' => false, 'value' => json_decode($row_RecordSiteSetting->SocialInformation, true)[$_SESSION['lang']]['site_LinkedIn']],

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
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSiteSetting['id']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_update" value="form_SiteSetting" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<?php //require_once("require_template_panel.php"); ?>
