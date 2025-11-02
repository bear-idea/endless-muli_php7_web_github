<?php

push_script($scripts, '<script src="' . $SiteAdminPath . 'sqldatatable/js/routes_datatable.js?rand=' . time() . '"></script>');
require($page_view_path_vendor."pushjs_datatables.php");
require($page_view_path_vendor."pushcss_datatables.php");
?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Router']; ?> <small>總覽</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
<div class="btn-group float-end mr-10px"><a href="javascript:void(0);" onclick="startIntro();" data-bs-original-title="教學導引 Step By Step" data-bs-toggle="tooltip" data-bs-placement="top" id="startButton" class="text-nowrap btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
<?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="row justify-content-end">
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="2"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 類別</span>
            <select name="type" class="form-control form-select search_filter" id="col2_filter">
            <option value="%" selected="selected">全部</option>
                <?php foreach($RecordRouterListType as $row_RecordRouterListType) { ?>
                  <option value="<?php echo $row_RecordRouterListType['itemname']?>"><?php echo $row_RecordRouterListType['itemname']?></option>
                <?php }  ?>
          </select>
        </div>
      </div>
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="4"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span>
            <select name="indicate" class="form-control form-select search_filter" id="col4_filter">
              <option value="%">全部</option>
              <option value="1">公佈</option>
              <option value="0">隱藏</option>
            </select>
        </div>
      </div>
      <div class="col-md-5 m-b-10">
        <div class="input-group"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 標題</span>
          <input type="text" class="form-control global_filter" placeholder="" id="global_filter">
          <div class="input-group-append" style="display:none">
            <button type="button" class="text-nowrap btn btn-default" data-toggle="collapse" data-target="#collapseOne"> <span class="caret"></span> </button>
          </div>
        </div>
      </div>
    </div>
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body bg-cyan-transparent-1 m-t-10">
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>
      </div>
    </div>

    <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed align-middle">
      <thead>
      <tr>
          <th width="16"><input class="form-check-input" type="checkbox" name="select_all" value="1" id="data-table-default-select-all"></th>
          <th width="100" data-priority="1"><strong>路由方法</strong></th>
          <th width="100" data-priority="1"><strong>路由前綴</strong></th>
          <th width="200" data-priority="1"><strong>路由名稱</strong></th>
          <th width="-1" data-priority="1"><strong>Uri</strong></th>
          <th width="100" data-priority="1"><strong>模組類別</strong></th>
          <th width="120" data-priority="1"><strong>控制器</strong></th>
          <th width="150" data-priority="1"><strong>動作</strong></th>
          <th width="100" data-priority="1"><strong>模組類型</strong></th>
          <th width="300" data-priority="1"><strong>權限</strong></th>
          <th width="70"><strong>排序</strong></th>
          <th width="70"><strong>狀態</strong></th>
          <th width="100"><strong>發布日期</strong></th>
          <th width="1%" class="desktop"><strong>操作</strong></th>
      </tr>
      </thead>
      <tfoot>
        <tr>
          <td>└</td>
          <td><button type="button" class="text-nowrap btn btn-default btn-sm" onclick="delete_muti_datatables(event);"><i class="far fa-trash-alt"></i> 刪除選取項目</button></td>
          <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          <td>&nbsp;</td>
            <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>

          <td><button type="button" id="reset_table" class="text-nowrap btn btn-default btn-sm float-end"><i class="fa fa-sync"></i> 清除狀態</button></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->