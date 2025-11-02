<script>
    // 獲取 CSRF 令牌
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // 設置全局 AJAX 設置
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

</script>

