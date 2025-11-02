<?php
/** @var TYPE_NAME $scripts */
foreach ($scripts as $script) {
    echo $script;
} ?>
<script>
    //$.fn.editable.defaults.mode = 'inline';

    $(document).ready(function() {
        if(jQuery('.select2').length > 0) $(".select2").select2();
        $(".colorbox_iframe").colorbox({iframe:!0,width:"90%",height:"90%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_small").colorbox({iframe:!0,width:"1000px",height:"80%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_cd").colorbox({iframe:!0,width:"99%",height:"99%",fixed:!0,rel:"nofollow"});$(".youtube").colorbox({iframe:true, innerWidth:900, innerHeight:506});
    });
</script>

<script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['notifications'])): ?>
        <?php
        $notifications = $_SESSION['notifications'];
        unset($_SESSION['notifications']); // 清除 session 中的通知
        ?>
        var notifications = <?php echo json_encode($notifications); ?>;
        var delay = 0;

        $.each(notifications, function(index, notification) {
            setTimeout(function() {
                $.gritter.add({
                    title: notification.title,
                    text: notification.text,
                    sticky: notification.sticky,
                    time: notification.time,
                    class_name: notification.class_name,
                    before_open: function() { console.log('Before open'); },
                    after_open: function(e) { console.log('After open'); },
                    before_close: function(manual_close) { console.log('Before close'); },
                    after_close: function(manual_close) { console.log('After close'); }
                });
            }, delay);

            delay += 3000; // 延迟时间：通知显示时间加上额外的间隔（例如 3000ms）
        });
        <?php endif; ?>

        // 移除所有通知（可选）
        setTimeout(function() {
            $.gritter.removeAll({
                before_close: function() { console.log('Before remove all'); },
                after_close: function() { console.log('After remove all'); }
            });
        }, 15000); // 15秒后移除所有通知
    });
</script>

<?php
function showSwal($title, $type = "success") {
    echo "<script type=\"text/javascript\"> document.addEventListener('DOMContentLoaded', function() { swal({ title: \"$title\", text: \"\", type: \"$type\", buttonsStyling: false, confirmButtonText: \"確認\", confirmButtonClass: \"btn btn-primary m-5px\" }); }); </script>";
}

if (isset($_SESSION['DB_Add']) && $_SESSION['DB_Add'] === "Success") {
    showSwal("資料新增成功!");
    unset($_SESSION["DB_Add"]);
}

if (isset($_SESSION['DB_Edit']) && $_SESSION['DB_Edit'] === "Success") {
    showSwal("資料修改成功!");
    unset($_SESSION["DB_Edit"]);
}

if (isset($_SESSION['DB_Set']) && $_SESSION['DB_Set'] === "Success") {
    showSwal("資料設定成功!");
    unset($_SESSION["DB_Set"]);
}

if (isset($_SESSION['errorMessages'])) {
    showSwal("錯誤!");
    unset($_SESSION["errorMessages"]);
}

if (isset($_GET['Operate']) && $_GET['Operate'] === "delErrorT") {
    showSwal("刪除失敗！！該項目下方尚有分類！！!", "warning");
}

if (isset($_GET['Operate']) && $_GET['Operate'] === "delErrorP") {
    showSwal("刪除失敗！！此分類尚有資料！！", "warning");
}

?>

