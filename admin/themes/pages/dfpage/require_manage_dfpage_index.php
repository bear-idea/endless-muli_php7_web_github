<script src="<?php echo $SiteAdminPath; ?>sqldatatable/js/dfpage_datatable.js?<?php echo time(); ?>"></script>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['DfPage']; ?> <small>細項</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-database"></i> 頁面一覽 <span class="badge bg-default text-gray-900"><?php echo $request->tpt ?? ''; ?></span></h4>
        <div class="btn-group float-end mr-10px"><a href="<?php echo url_rewrite("manage_dfpage", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'typepage'), '', $UrlWriteEnable);?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="top" class="text-nowrap btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 返回自訂頁面</a></div>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
  <div class="panel-body">
    <div class="row justify-content-end">
      <div class="col-md-2 m-b-10">
        <div class="input-group" data-column="3"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span></span>
            <select name="indicate" class="form-control form-select search_filter" id="col3_filter">
              <option value="">全部</option>
              <option value="公佈">公佈</option>
              <option value="隱藏">隱藏</option>
            </select>
        </div>
      </div>
      <div class="col-md-5 m-b-10">
        <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 標題</span></span>
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
    
    <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th width="16"><input class="form-check-input" type="checkbox" name="select_all" value="1" id="data-table-default-select-all"></th>
          <th width="-1" data-priority="1"><strong>標題</strong></th>
          <th width="100"><strong>選單類別</strong></th>
          <th width="70"><strong>排序</strong></th>
          <th width="70"><strong>狀態</strong></th>
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
          <td><button type="button" id="reset_table" class="text-nowrap btn btn-default btn-sm float-end"><i class="fa fa-sync"></i> 清除狀態</button></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->