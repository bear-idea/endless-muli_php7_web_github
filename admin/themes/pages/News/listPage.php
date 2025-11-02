<?php
$parameters = ['lang' => $_SESSION['lang'] ?? 'zh_TW'];
$useModuleUri = $request->input('useModuleUri');
?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">

    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-list-ul"></i> 清單一覽</h4>
        <?php require($page_view_path_vendor . "require_panel_heading_btn.php"); ?>
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-dark">
                <tbody>
                <?php foreach ($RecordListMenu as $row_RecordListMenu) { ?>
                    <tr>
                        <td width="100" valign="middle">清單名稱</td>
                        <td class="with-btn">
                            <?php if ($row_RecordListMenu['pattern'] == 'SingleListItem') { ?>
                                <a class="text-nowrap btn btn-default btn-sm" href="<?php echo ADMINURL . generateUrl('/'.toSpinalCase($useModuleUri).'/listitem/' . $row_RecordListMenu['id'], $parameters); ?>"><?php echo $row_RecordListMenu['listname']; ?><?php echo '(' . $row_RecordListMenu['list_item_menu_count'] . '筆資料)'; ?>
                                    <i class="fa fa-chevron-circle-right"></i></a>
                            <?php } ?>
                            <?php if ($row_RecordListMenu['pattern'] == 'MultiListItem') { ?>
                                <a class="text-nowrap btn btn-default btn-sm" href="<?php echo ADMINURL . generateUrl('/'.toSpinalCase($useModuleUri).'/multi-listitem/' . $row_RecordListMenu['id'] . '/0', $parameters); ?>"><?php echo $row_RecordListMenu['listname']; ?><?php echo '(' . $row_RecordListMenu['list_item_menu_count'] . '筆資料)'; ?>
                                    <i class="fa fa-chevron-circle-right"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

