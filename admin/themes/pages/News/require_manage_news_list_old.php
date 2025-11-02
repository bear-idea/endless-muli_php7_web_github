<?php $parameters = ['lang' => $_SESSION['lang'] ?? 'zh_TW']; ?>

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
                <?php foreach ($RecordNewsList as $row_RecordNewsList) { ?>
                    <tr>
                        <td width="100" valign="middle">清單名稱</td>
                        <td class="with-btn">
                            <a class="text-nowrap btn btn-default btn-sm" href="<?php echo ADMINURL . generateUrl('/news/listitem/' . $row_RecordNewsList['list_id'], $parameters); ?>"><?php echo $row_RecordNewsList['listname']; ?>
                                <i class="fa fa-chevron-circle-right"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

