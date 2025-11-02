<?php
push_script($scripts, '<script src="' . $SiteAdminPath . 'assets/plugins/nestable2/jquery.nestable.min.js"></script>');

push_script($scripts, "<script type='text/javascript'>
    $(document).ready(function(){
        $('#nestable').nestable({
            maxDepth: 2, // 最大嵌套深度為 2 層
            group: 1, // 如果同一頁面有多個嵌套列表，使用不同的 group 可避免互相影響
            callback: function(l, e) {
                // 當排序發生變化時的回調函數，可用於保存排序後的結果
                var updatedMenuOrderData = JSON.stringify($('#nestable').nestable('serialize'));
                // 發送 AJAX 請求更新菜單項目排序
                $.ajax({
                    url: '" . ADMINURL . "/ajax/update_menu_order.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ menu_order: updatedMenuOrderData }),
                    success: function(response) {
                        console.log('排序已成功更新');
                    },
                    error: function(xhr, status, error) {
                        console.error('發生錯誤：' + error);
                    }
                });
            }
        });
    });
</script>");

?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-database"></i> 選單排序</h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body">

        <div class="dd" id="nestable">
            <?php echo generateNestableList($menuItems); ?>
        </div>

    </div>
</div>
