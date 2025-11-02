<?php

use App\Eloquent\Admin\About;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_About")) {

    (new About)->add($request);

    $_SESSION['DB_Add'] = "Success";

    $insertGoTo = "manage_about.php?Opt=viewpage&lang=" . $_POST['lang'];

    header(sprintf("Location: %s", $insertGoTo));
}
?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['About']; ?> <small>新增</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
      <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body p-0">

  <form action="<?php echo $request->getRequestUri(); ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">

                      <input name="title" type="text" id="title" maxlength="200" class="form-control" data-parsley-trigger="blur" required=""/>


          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類</label>
          <div class="col-md-10">


              <div id="cxselect_type" class="row p-2">
                    <select name="type1" id="type1" class="type1 form-control form-select col" data-required="false"></select>
                    <select name="type2" id="type2" class="type2 form-control form-select col" data-required="true"></select>
                    <select name="type3" id="type3" class="type3 form-control form-select col" data-required="true"></select>
              </div>
</div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>

          <div class="col-md-10">

            <div class="form-check form-check-inline">
                <input class="form-check-input"  type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label class="form-check-label" for="indicate_1">公佈</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input"  type="radio" name="indicate" id="indicate_2" value="0" />
                <label class="form-check-label" for="indicate_2">隱藏</label>
            </div>

          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-bs-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" id="skeyword" maxlength="300" class="form-control" data-role="tagsinput" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">關鍵字顯示 <i class="fa fa-info-circle text-orange" data-bs-original-title="是否顯示關鍵字於頁面上。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
              <div class="form-check form-check-inline">
                  <input class="form-check-input"  type="radio" name="skeywordindicate" id="skeywordindicate_1" value="1" checked />
                <label for="skeywordindicate_1">顯示</label>
            </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input"  type="radio" name="skeywordindicate" id="skeywordindicate_2" value="0" />
                <label for="skeywordindicate_2">隱藏</label>
            </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-bs-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" id="sdescription" size="100" maxlength="150" class="form-control"/>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-bs-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control ckeditor"></textarea>
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_About" />
  </form>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->


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

<?php //require_once("require_template_panel.php"); ?>

