<?php
if (isset($_SESSION['errorMessages'])) {
    $errorMessages = json_decode($_SESSION['errorMessages']);
    push_script($scripts, "<script> swal({ title: '錯誤', text: '{$errorMessages->title}', type: '{$errorMessages->type}', buttonsStyling: false, confirmButtonText: '確認', confirmButtonClass: 'btn btn-primary m-5px' }); </script>");
    unset($_SESSION['errorMessages']); // 清除错误消息，确保只显示一次
}


