<?php

use App\Eloquent\Admin\About;

$RecordAbout = (new About)->getAll($request);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
	if ((isset($_POST['id_check'])) && ($_POST['id_check'] != "")) {

      (new About)->resetStartPage($request, $_POST['id_check']);

	  $_SESSION['DB_Set'] = "Success";

	  $insertGoTo = "manage_about.php?Opt=viewpage&lang=" . $_POST['lang'];

	  header(sprintf("Location: %s", $insertGoTo));
	}
}
?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['About']; ?> <small>設定</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-star"></i> 設定起始頁</h4>
      <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action="<?php echo $request->getRequestUri(); ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">

      <?php foreach($RecordAbout as $row_RecordAbout) { ?>
      <div class="form-group row">

        <div class="col-md-12">
                      <div class="checkbox checkbox-css">
                          <input class="form-check-input" name="id_check" <?php if (!(strcmp($row_RecordAbout['home'],1))) {echo "checked=\"checked\"";} ?> value="<?php echo $row_RecordAbout['id']; ?>" class="form-check-input"  type="radio" id="id_check_<?php echo $row_RecordAbout['id']; ?>" data-parsley-trigger="blur" required=""/>
                        <label for="id_check_<?php echo $row_RecordAbout['id']; ?>"><?php echo $row_RecordAbout['title']; ?></label>
                        <?php if($row_RecordAbout['home'] == 1){ ?>
                        <button type='button' class='btn btn-warning btn-xs float-end'><i class='fa fa-check-circle'></i> 起始頁</button>
                        <?php } else { ?>
                        <button type='button' class='btn btn-gray btn-xs float-end'><i class='fa fa-circle'></i> 起始頁</button>
                        <?php } ?>
                        <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_RecordAbout['id']; ?>" />
                      </div>
        </div>
      </div>
      <?php } ?>
      <div class="form-group row">

          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form" />
  </form>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->
