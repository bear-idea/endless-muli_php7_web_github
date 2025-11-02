@extends('backstage.layouts.default', [
    'appHeaderLanguageBar' => true,
    'appFooter' => true
])

@section('title', $title)

@section('content')
    <div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
        <div class="card-body">
            <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['About']; ?> <small>總覽</small> <?php //require($page_view_path_vendor."require_lang_show.php"); ?></h4>
        </div>
    </div>

    <div class="panel panel-inverse bg-white-transparent-9">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
            <?php //require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            <div class="row justify-content-end">
                <div class="col-md-2 m-b-10">
                    <div class="input-group" data-column="3"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span>
                        <select name="indicate" class="form-control form-select search_filter" id="col3_filter">
                            <option value="%">全部</option>
                            <option value="1">公佈</option>
                            <option value="0">隱藏</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5 m-b-10">
                    <div class="input-group"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 標題</span>
                        <input type="text" class="form-control global_filter" placeholder="" id="global_filter">
                        <div class="input-group-append" style="display:none">
                            <button type="button" class="text-nowrap btn btn-default" data-toggle="collapse" data-target="#collapseOne"> <span class="caret"></span> </button>
                        </div>
                    </div>
                </div>
            </div>

            <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th width="16"><input class="form-check-input" type="checkbox" name="select_all" value="1" id="data-table-default-select-all"></th>
                    <th width="auto" data-priority="1"><strong>標題</strong></th>
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
                    <td><button type="button" id="reset_table" class="text-nowrap btn btn-default btn-sm float-end"><i class="fa fa-sync"></i> 清除狀態</button></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
@endsection

@push('scripts')
    <script src="<?php echo $SiteAdminPath; ?>sqldatatable/js/about_datatable.js?<?php echo time(); ?>"></script>
@endpush
