<?php
use App\Eloquent\Admin\Modules;

$RecordModules = (new Modules)->getAll($request);

$useModuleUri = $request->input('useModuleUri');

// 定義 tableConfig 的 PHP 版本
$tableConfig = [
    'tableId' => 'data-table-default',
    'ajaxUrl' => ADMINURL . '/sqldatatable/menubackend_view.php',
    'editUrl' => ADMINURL . '/sqledit/menubackend_jedit.php',
    'editListUrl' => ADMINURL . '/sqledit/menubackend_get_list.php?list_id=1',
    'deleteUrl' => ADMINURL . '/sqldatatable/menubackend_del.php',
    'deleteMutiUrl' => ADMINURL . '/sqldatatable/menubackend_del_muti.php',
    'columns' => [
        [ 'title' => '<input class="form-check-input" type="checkbox" name="select_all" value="1" id="data-table-default-select-all">', 'data' => 'id', 'orderable' => false, 'width' => '16px' ],
        [ 'title' => '讀取模組', 'data' => 'module_class', 'orderable' => true, 'className' => 'ed_module_class', 'width' => '100px' ],
        [ 'title' => '選單標題', 'data' => 'title', 'orderable' => true, 'className' => 'ed_title', 'width' => '100px' ],
        [ 'title' => '子選單標題', 'data' => 'subtitle', 'orderable' => true, 'className' => 'ed_subtitle', 'width' => '100px' ],
        [ 'title' => '路由/模組資訊', 'data' => 'url', 'orderable' => true, 'className' => 'ed_url', 'width' => '-1' ],
        [ 'title' => '選單圖標', 'data' => 'icon', 'orderable' => true, 'className' => 'ed_icon', 'width' => '100px' ],
        [ 'title' => '路由名稱', 'data' => 'route_name', 'orderable' => true, 'className' => 'ed_route_name', 'width' => '250px' ],
        //[ 'title' => '模組分類', 'data' => 'module_uri', 'orderable' => true, 'className' => 'ed_module_uri', 'sourceUrl' => ADMINURL . '/sqledit/modules_get_list.php', 'width' => '100px'],
        [ 'title' => '背景顏色類別', 'data' => 'colorclass', 'orderable' => true, 'className' => 'ed_colorclass', 'width' => '100px' ],
        [ 'title' => '首頁顯示', 'data' => 'is_home', 'orderable' => true, 'className' => 'ed_is_home', 'width' => '100px', 'inputclass' => 'form-select', 'sourceUrl' => "[{ value: 1, text: '是' }, { value: 0, text: '否' }]" ],
        [ 'title' => '側欄顯示', 'data' => 'is_submenu', 'orderable' => true, 'className' => 'ed_is_submenu', 'width' => '100px', 'inputclass' => 'form-select', 'sourceUrl' => "[{ value: 1, text: '是' }, { value: 0, text: '否' }]" ],
        [ 'title' => '排序', 'data' => 'sortid', 'orderable' => true, 'className' => 'ed_sortid', 'width' => '70px' ],
        [ 'title' => '狀態', 'data' => 'indicate', 'orderable' => true, 'className' => 'ed_indicate', 'width' => '70px' ],
        //[ 'title' => '發布日期', 'data' => 'postdate', 'orderable' => true, 'className' => 'ed_postdate', 'width' => '100px' ],
        [ 'title' => '操作', 'data' => 'action', 'orderable' => false, 'searchable' => false, 'width' => '1%' ],
    ],
    'defaultOrder' => [[2, 'asc'], [10, 'asc']],
    'defaultLengthMenu' => [[10, 25, 50, -1], [10, 25, 50, "All"]],
    'searchColumns' => ['module_class', 'indicate', 'is_home', 'is_submenu'],
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
                <div class="input-group" data-column="2"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 模組</span>
                    <select name="module_class" class="form-control form-select search_filter" id="filter-module_class">
                        <option value="" selected="selected">全部</option>
                        <?php foreach($RecordModules as $row_RecordModules) { ?>
                            <option value="<?php echo $row_RecordModules['class']?>"><?php echo $row_RecordModules['name']?> - <?php echo $row_RecordModules['class']?>::class</option>
                        <?php }  ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 m-b-10">
                <div class="input-group" data-column="4"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 首頁顯示</span>
                    <select name="is_home" class="form-control form-select search_filter" id="filter-is_home">
                        <option value="%">全部</option>
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 m-b-10">
                <div class="input-group" data-column="4"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 側欄顯示</span>
                    <select name="is_submenu" class="form-control form-select search_filter" id="filter-is_submenu">
                        <option value="%">全部</option>
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 m-b-10">
                <div class="input-group" data-column="4"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span>
                    <select name="indicate" class="form-control form-select search_filter" id="filter-indicate">
                        <option value="%">全部</option>
                        <option value="1">公佈</option>
                        <option value="0">隱藏</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 m-b-10">
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
