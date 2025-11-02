<?php
use App\Eloquent\Admin\Newsitem;

//$RecordNewsListType = (new Newsitem)->getItemType( $request);
//$RecordNewsListAuthor = (new Newsitem)->getItemAuthor($request);
//dd(route('admin.admin.tmp.index'));
$useModuleUri = $request->input('useModuleUri');

// 定義 tableConfig 的 PHP 版本
$tableConfig = [
    'tableId' => 'data-table-default',
    'ajaxUrl' => ADMINURL . '/sqldatatable/tmpget_view.php',
    'editUrl' => ADMINURL . '/sqledit/tmp_jedit.php',
    'editListUrl' => ADMINURL . '/sqledit/tmp_get_list.php?list_id=1',
    //'deleteUrl' => ADMINURL . '/sqldatatable/tmp_del.php',
    'deleteUrl' => ADMINURL . generateUrl( '/'.toSpinalCase($useModuleUri).'/delete'),
    //'deleteMutiUrl' => ADMINURL . '/sqldatatable/about_del_muti.php',
    'deleteMutiUrl' => ADMINURL . generateUrl( '/'.toSpinalCase($useModuleUri).'/delete'),
    'columns' => [
        ['title' => '#', 'data' => 'id', 'orderable' => false, 'width' => '16px'],
        ['title' => '主題', 'data' => 'theme', 'orderable' => true, 'className' => 'ed_theme', 'width' => '50px'],
        //['title' => '標題名稱', 'data' => 'title', 'orderable' => true, 'className' => 'ed_title', 'width' => '-1'],
        //['title' => '主佈局', 'data' => 'layout', 'orderable' => true, 'className' => 'ed_layout', 'width' => '100px'],
        //['title' => '類別', 'data' => 'type', 'orderable' => true, 'className' => 'ed_type', 'inputclass' => 'form-select', 'sourceUrl' => ADMINURL . '/sqledit/tmp_get_list.php?list_id=1', 'width' => '100px'],
        //['title' => '排序', 'data' => 'sortid', 'orderable' => true, 'className' => 'ed_sortid', 'width' => '70px'],
        //['title' => '作者', 'data' => 'webname', 'orderable' => true, 'className' => 'ed_webname', 'width' => '100px'],
        //['title' => '狀態', 'data' => 'indicate', 'orderable' => true, 'className' => 'ed_indicate', 'width' => '70px'],
        //['title' => '發布日期', 'data' => 'postdate', 'orderable' => true, 'className' => 'ed_postdate', 'width' => '100px'],
        //['title' => '操作', 'data' => 'action', 'orderable' => false, 'searchable' => false, 'width' => '1%']
    ],
    'defaultOrder' => [[1, 'desc']],
    'defaultLengthMenu' => [[10, 25, 50, -1], [10, 25, 50, "All"]],
    'searchColumns' => ['type', 'indicate'],
    'extraData' => ['useModuleUri' => $useModuleUri],
    'enableCheckboxes' => false,
];

// 將 tableConfig 轉換為 JavaScript 變量
$jsTableConfig = json_encode($tableConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

// 將 JavaScript 變量推送到腳本陣列中
push_script($scripts, "<script>\nvar tableConfig = $jsTableConfig;\n</script>");
push_script($scripts, '<script src="' . $SiteAdminPath . 'sqldatatable/js/module_card_datatable.js?rand=' . time() . '"></script>');

require($page_view_path_vendor."pushjs_datatables.php");
require($page_view_path_vendor."pushcss_datatables.php");
?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-database"></i> 選擇主題</h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body">

        <form action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">

            <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed align-middle">
                <thead>
                <tr id="table-header">
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <button type="submit" class="btn btn btn-primary w-100 btn-block mt-2">套用所選取的版型</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="module_uri" type="hidden" id="module_uri" value="<?php echo $useModuleUri; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input type="hidden" name="MM_update" value="form_Tmp" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>

    </div>
</div>
