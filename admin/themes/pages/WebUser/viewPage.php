<?php
use App\Eloquent\Admin\Newsitem;

//$RecordNewsListType = (new Newsitem)->getItemType( $request);
//$RecordNewsListAuthor = (new Newsitem)->getItemAuthor($request);

$useModuleUri = $request->input('useModuleUri');


// 定義 tableConfig 的 PHP 版本
$tableConfig = [
    'tableId' => 'data-table-default',
    'ajaxUrl' => ADMINURL . '/sqldatatable/webuser_view.php',
    'editUrl' => ADMINURL . '/sqledit/webuser_jedit.php',
    'editListUrl' => ADMINURL . '/sqledit/webuser_get_list.php?list_id=1',
    //'deleteUrl' => ADMINURL . '/sqldatatable/news_del.php',
    'deleteUrl' => ADMINURL . generateUrl( '/'.toSpinalCase($useModuleUri).'/delete'),
    //'deleteMutiUrl' => ADMINURL . '/sqldatatable/about_del_muti.php',
    'deleteMutiUrl' => ADMINURL . generateUrl( '/'.toSpinalCase($useModuleUri).'/delete'),
    'columns' => [
        ['title' => '<input class="form-check-input" type="checkbox" name="select_all" value="1" id="data-table-default-select-all">', 'data' => 'id', 'orderable' => false, 'width' => '16px'],
        ['title' => '網站名稱', 'data' => 'name', 'orderable' => true, 'className' => 'ed_name', 'width' => '-1'],
        ['title' => '網站域名', 'data' => 'webname', 'orderable' => true, 'className' => 'ed_webname', 'width' => '150px'],
        ['title' => '帳號', 'data' => 'account', 'orderable' => true, 'className' => 'ed_account', 'width' => '150px'],
        ['title' => '到期日', 'data' => 'usetime', 'orderable' => true, 'className' => 'ed_usetime', 'width' => '150px'],
        ['title' => '操作', 'data' => 'action', 'orderable' => false, 'searchable' => false, 'width' => '1%']
    ],
    'defaultOrder' => [[2, 'desc']],
    'defaultLengthMenu' => [[10, 25, 50, -1], [10, 25, 50, "All"]],
    'searchColumns' => ['usetime'],
    'extraData' => ['useModuleUri' => $useModuleUri],
    'enableCheckboxes' => false,
];

// 將 tableConfig 轉換為 JavaScript 變量
$jsTableConfig = json_encode($tableConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

// 將 JavaScript 變量推送到腳本陣列中
push_script($scripts, "<script>\nvar tableConfig = $jsTableConfig;\n</script>");
push_script($scripts, '<script src="' . $SiteAdminPath . 'sqldatatable/js/module_datatable.js?rand=' . time() . '"></script>');

require($page_view_path_vendor."pushjs_datatables.php");
require($page_view_path_vendor."pushcss_datatables.php");
?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body">
        <div class="row justify-content-end">
            <div class="col-md-2 col-sm-12 m-b-10">
                <div class="input-group" data-column="2"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span>
                    <select name="usetime" class="form-control form-select search_filter" id="filter-usetime">
                        <option value="">全部</option>
                        <option value="used">使用中帳戶</option>
                        <option value="noused">逾期帳戶</option>
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

        <div class="h-15px"></div>

        <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed align-middle">
            <thead>
            <tr id="table-header">
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>
