<?php

use App\Eloquent\Admin\About;

$row_RecordAbout = (new About)->getByID($request);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_About")) {

    (new About)->edit($request);

    $_SESSION['DB_Edit'] = "Success";
   
    $updateGoTo = "manage_about.php?Opt=viewpage&lang=" . $_POST['lang'];

    header(sprintf("Location: %s", $updateGoTo));

}
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