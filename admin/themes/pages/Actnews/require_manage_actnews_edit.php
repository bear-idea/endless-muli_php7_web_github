<?php
use App\Eloquent\Admin\Actnews;
use App\Eloquent\Admin\Actnewsitem;

/* 更新資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Actnews") && $_POST['sdescription'] == "") {
    $_POST['sdescription'] = TrimSummary($_POST['content']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Actnews")) {

    (new Actnews)->edit($request);

    $updateGoTo = "actnews?Opt=viewpage&lang=" . $_POST['lang'];

    header(sprintf("Location: %s", $updateGoTo));
}

$RecordActnewsListType = (new Actnewsitem)->getItemType($request);

$RecordActnewsListAuthor = (new Actnewsitem)->getItemAuthor($request);

$row_RecordActnews = (new Actnews)->getByID($request);

if($row_RecordActnews == NULL) {
    header(sprintf("Location: %s", '404.php'));
}

?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageActnewsEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageActnewsEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageActnewsEditorSelect == '1' || $ManageActnewsEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>

<?php

// 定義表單字段
$formFields = [
    'title' => ['label' => '標題', 'type' => 'text', 'maxlength' => 200, 'required' => true, 'value' => $row_RecordActnews['title']],
    'type' => ['label' => '分類', 'type' => 'select', 'required' => true, 'options' => $RecordActnewsListType, 'selected' => $row_RecordActnews['type']],
    'author' => ['label' => '發佈者', 'type' => 'select', 'required' => true, 'options' => $RecordActnewsListAuthor, 'selected' => $row_RecordActnews['author']],
    'pic' => ['label' => '圖片', 'type' => 'upload_link', 'required' => true, 'link' => "actnews/upload?wshop={$wshop}&amp;Opt=uploadpage&amp;lang={$row_RecordActnews['lang']}&amp;id_edit={$row_RecordActnews['id']}"],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'checked' => $row_RecordActnews['indicate']],
    'skeyword' => ['label' => '頁面關鍵字', 'type' => 'text', 'maxlength' => 300, 'required' => false, 'value' => $row_RecordActnews['skeyword']],
    'skeywordindicate' => ['label' => '關鍵字顯示', 'type' => 'radio', 'required' => false, 'options' => ['1' => '顯示', '0' => '隱藏'], 'checked' => $row_RecordActnews['skeywordindicate']],
    'sdescription' => ['label' => '頁面描述', 'type' => 'text', 'maxlength' => 150, 'required' => false, 'value' => $row_RecordActnews['sdescription']],
    'pushtop' => ['label' => '置頂', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'checked' => $row_RecordActnews['pushtop']],
    'content' => ['label' => '詳細內容', 'type' => 'textarea', 'required' => false, 'value' => $row_RecordActnews['content']],
    'postdate' => ['label' => '上傳時間', 'type' => 'date', 'required' => true, 'value' => (new DateTime($row_RecordActnews['postdate']))->format('Y-m-d')],
    'notes1' => ['label' => '備註', 'type' => 'text', 'maxlength' => 50, 'required' => false, 'value' => $row_RecordActnews['notes1']]

];
?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Actnews']; ?> <small>修改</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $request->getRequestUri(); ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <?php echo renderForm($formFields); ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordActnews['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordActnews['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="oldpic" type="hidden" id="oldpic" value="<?php echo $row_RecordActnews['pic']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Actnews" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php require_once("require_template_panel.php"); ?>

<script type="text/javascript">
	$(document).ready(function() {
			$("#change_unit01").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:left;\" />");
			});
			
			$("#change_unit02").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:right;\" />");
			});
			
			$("#change_unit03").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:none;\" /><br />");
			});
			
			$("#change_unit04").click(function(){
					CKEDITOR.instances.content.insertHtml("<p style=\"text-align:center\"><img alt=\"\" height=\"180\" src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" style=\"display: block; margin: auto;\" width=\"240\" /></p>");
			});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>
