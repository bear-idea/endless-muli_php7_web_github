<?php
use App\Eloquent\Admin\Aboutitem;

/* 新增類別項目 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_AboutItemAdd")) {
    (new Aboutitem)->add($request);
    $_SESSION['DB_Add'] = "Success";
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_AboutItemEdit")) {
    (new Aboutitem)->edits($request);
    $_SESSION['DB_Edit'] = "Success";
}

if ((isset($_POST['delid'])) && ($_POST['delid'] != "")) {
    (new Aboutitem)->removeByIds($_POST['delid']);
}

$RecordAboutListItem = (new Aboutitem)->getItemByList($request);
$totalRows_RecordAboutListItem = count($RecordAboutListItem);

?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['About']; ?> <small>設定</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?>
    </h4>
  </div>
</div>


<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改次分類</h4>
      <?php require($page_view_path_vendor."require_panel_heading_back.php"); ?>
      <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if ($totalRows_RecordAboutListItem > 0) { // Show if recordset not empty ?>
    <form id="form_AboutItemEdit" name="form_AboutItemEdit" method="POST" action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <div id="card_sortable">
    <?php foreach($RecordAboutListItem as $row_RecordAboutListItem) { ?>
    <div class="widget-card bg-cyan-transparent-1">
          <div class="card-body">
              <div class="row align-items-center">
              <div class="col-md-3 py-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <span class="input-group-text">名稱</span>
                            <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordAboutListItem['itemname']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>

                      </div>

                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2 py-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <span class="input-group-text">排序</span>
                            <input name="sortid[]" type="number" id="sortid[]" value="<?php echo $row_RecordAboutListItem['sortid']; ?>" class=" form-control" maxlength="10" data-parsley-trigger="blur" required=""/>

                      </div>

                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2 py-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <span class="input-group-text">狀態</span>
                            <select class="form-control form-select" name="indicate[]" id="indicate[]">
                  <option <?php if (!(strcmp(1, $row_RecordAboutListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="1" >顯示</option>
                  <option <?php if (!(strcmp(0, $row_RecordAboutListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="0" >隱藏</option>
                </select>

                      </div>

                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2 py-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                      <a class="btn btn-info w-100 btn-block" href="about?wshop=<?php echo $wshop;?>&amp;Opt=mulilistitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordAboutListItem['item_id']; ?>&amp;subitem_id=<?php echo $row_RecordAboutListItem['subitem_id']; ?>&amp;level=<?php echo (@$_GET['level']+1) ?? 1; ?>&amp;list_id=<?php echo $_GET['list_id']; ?>" data-bs-original-title="點選查看下層的分類項目" data-bs-toggle="tooltip" data-bs-placement="top">子分類 <i class="fa fa-chevron-circle-right"></i> <span class="badge bg-primary float-end"><?php echo $row_RecordAboutListItem['sub_count']; ?></span></a>
                      </div>

                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-1 py-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <div class="checkbox checkbox-css">
                              <input name="delid[]" class="form-check-input" type="checkbox" id="delid<?php echo $row_RecordAboutListItem['item_id']; ?>" value="<?php echo $row_RecordAboutListItem['item_id']; ?>" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="delid<?php echo $row_RecordAboutListItem['item_id']; ?>">是否刪除</label>
                            </div>
                      </div>

                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2 py-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
                            <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordAboutListItem['item_id']; ?>" />
                            <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordAboutListItem['list_id']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordAboutListItem['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
                            <input name="prePage" type="hidden" id="prePage" value="<?php echo $prePage; ?>" />
                      </div>

                  <!--</div>-->
              </div>
              </div>


              </div>



          </div>
      </div>
    <?php }  ?>
    </div>
        <input type="hidden" name="MM_update" value="form_AboutItemEdit" />
      </form>
      <?php } // Show if recordset not empty ?>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->


<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增次分類</h4>
      <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body">
      <form id="form_AboutItemAdd" name="form_AboutItemAdd" method="POST" action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      <div class="widget-card bg-cyan-transparent-1">
          <div class="card-body">
              <div class="row">

              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <span class="input-group-text">名稱</span>
                            <input name="itemname" type="text" id="itemname" class="form-control" data-parsley-trigger="blur" required=""/>

                      </div>

                  <!--</div>-->
              </div>
              </div>



              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
                            <input name="list_id" type="hidden" id="list_id" value="<?php echo $_GET['list_id']; ?>" />
                              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                              <input name="Operate" type="hidden" id="Operate" value="addSuccess" />
                              <input name="subitem_id" type="hidden" id="subitem_id" value="<?php echo $_GET['item_id'] ?? 0; ?>" />
                              <input name="level" type="hidden" id="level" value="<?php echo $_GET['level'] ?? 0; ?>" />
                              <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
                              <input name="prePage" type="hidden" id="prePage" value="<?php echo $prePage; ?>" />

                      </div>

                  <!--</div>-->
              </div>
              </div>

              </div>
      </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_AboutItemAdd" />
    </form>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->
