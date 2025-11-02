<?php
require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");

// 定義表單字段
$formFields = [
    'title' => ['label' => '標題', 'type' => 'text', 'maxlength' => 200, 'required' => true],
    'type' => ['label' => '分類', 'type' => 'select', 'required' => false, 'options' => $RecordAboutListType],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'default' => '1'],
    'content' => ['label' => '詳細內容', 'type' => 'textarea', 'required' => false, 'tooltip' => '註:Shift+Enter為不空行分段/Enter為空行分段。'],
    'postdate' => ['label' => '上傳時間', 'type' => 'datetime', 'maxlength' => 20, 'required' => true, 'default' => $currentDate = (new DateTime())->format('Y-m-d H:i:s')],
    'notes1' => ['label' => '備註', 'type' => 'text', 'maxlength' => 50, 'required' => false]
];

$formFields_SEO = [
    'separator1' => ['label' => '基本 SEO', 'type' => 'separator', 'required' => false],
    'slug' => ['label' => '別名(URL Slug)', 'type' => 'text', 'maxlength' => 200, 'required' => false],
    'skeyword' => ['label' => '頁面關鍵字(Meta)', 'type' => 'tagsinput', 'maxlength' => 300, 'required' => false, 'tooltip' => '設定目前頁面的SEO關鍵字，會嵌入至原始碼中。'],
    'skeywordindicate' => ['label' => '關鍵字顯示', 'type' => 'radio', 'required' => false, 'options' => ['1' => '顯示', '0' => '隱藏'], 'default' => '0', 'tooltip' => '是否顯示關鍵字於頁面上。'],
    'sdescription' => ['label' => '頁面描述(Meta)', 'type' => 'text', 'maxlength' => 150, 'required' => false, 'tooltip' => '設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。'],
    'separator2' => ['label' => '社群 SEO (Open Graph Tags)', 'type' => 'separator', 'required' => false],
    'ogtitle' => ['label' => '標題(og:title)', 'type' => 'text', 'maxlength' => 200, 'required' => false, 'tooltip' => 'og:title 網頁標題或是顯示內容的標題'],
    'ogtype' => ['label' => '類型(og:type)', 'type' => 'text', 'maxlength' => 200, 'required' => false, 'tooltip' => 'og:type 網頁內容的類型 (有 article, book, profile, website, music, video 等類型'],
    'ogurl' => ['label' => '唯一網址(og:url)', 'type' => 'url', 'maxlength' => 200, 'required' => false, 'tooltip' => '網頁的唯一網址 canonical URL。如果您有手機版和電腦版二個網頁、將二個網頁的og:url設成電腦版的網址，兩個網頁的facebook按讚次數就可以加總統計在一起'],
    'ogimage' => ['label' => '預覽圖(og:image)', 'type' => 'file', 'maxlength' => 200, 'required' => false, 'tooltip' => 'og:image 用戶將內容分享至社群時顯示的圖像網址。 (網頁的預覽圖)', 'errorContainer' => 'error_ogImage'],
    'ogdescription' => ['label' => '描述(og:description)', 'type' => 'text', 'maxlength' => 150, 'required' => false, 'tooltip' => 'og:description 網頁內容的簡單說明、建議以二至四句話來說明。']
];

?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['About']; ?> <small>修改</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
      <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body p-0">

  <form action="<?php echo $request->getRequestUri(); ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">

                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordAbout['title']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>


          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類</label>
          <div class="col-md-10">

              <div id="cxselect_type" class="row p-2">
                  <select name="type1" id="type1" class="type1 form-control form-select col" data-value="<?php echo $row_RecordAbout['type1']?>" ></select>
                  <select name="type2" id="type2" class="type2 form-control form-select col" data-required="true" data-value="<?php echo $row_RecordAbout['type2']?>"></select>
                  <select name="type3" id="type3" class="type3 form-control form-select col" data-required="true" data-value="<?php echo $row_RecordAbout['type3']?>"></select>
              </div>

</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>
          <div class="col-md-10">

            <div class="form-check form-check-inline">
                <input <?php if (!(strcmp($row_RecordAbout['indicate'],"1"))) {echo "checked=\"checked\"";} ?> class="form-check-input"  type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php if (!(strcmp($row_RecordAbout['indicate'],"0"))) {echo "checked=\"checked\"";} ?> class="form-check-input"  type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>

          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-bs-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordAbout['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">關鍵字顯示 <i class="fa fa-info-circle text-orange" data-bs-original-title="是否顯示關鍵字於頁面上。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
            <div class="form-check form-check-inline">
                <input <?php if (!(strcmp($row_RecordAbout['skeywordindicate'],"1"))) {echo "checked=\"checked\"";} ?> class="form-check-input"  type="radio" name="skeywordindicate" id="skeywordindicate_1" value="1" />
                <label for="skeywordindicate_1">顯示</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php if (!(strcmp($row_RecordAbout['skeywordindicate'],"0"))) {echo "checked=\"checked\"";} ?> class="form-check-input"  type="radio" name="skeywordindicate" id="skeywordindicate_2" value="0" />
                <label for="skeywordindicate_2">隱藏</label>
            </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-bs-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordAbout['sdescription']; ?>" size="100" maxlength="150"/>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-bs-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control ckeditor"><?php echo $row_RecordAbout['content']; ?></textarea>
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordAbout['notes1']; ?>" size="50" maxlength="50"/>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordAbout['id']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input id="fullIdPath" type="hidden" value="<?php echo $row_RecordAbout['type1']; ?>,<?php echo $row_RecordAbout['type2']; ?>,<?php echo $row_RecordAbout['type3']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_About" />
  </form>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->

<?php require_once("require_template_panel.php"); ?>

<script>
    $(document).ready(function() {
        $('#cxselect_type').cxSelect({
            url: 'selectbox_action/about_add.php',
            selects: ['type1', 'type2', 'type3'], //class
            jsonSub:'sub',
            emptyStyle: 'none',
            jsonName: 'itemname',
            jsonValue: 'item_id',
            firstTitle: '-- 選擇項目 --',
            nodata: 'none'
        });
    });
</script>
