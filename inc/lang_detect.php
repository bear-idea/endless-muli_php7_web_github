<?php
error_reporting(E_ALL ^ E_NOTICE);

preg_match('/^([a-z\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
$lang = $matches[1];

switch ($lang) {
        case 'en' :
                header('Location: en/');
                break;
        case 'zh-tw' :
                header('Location: tw/');
                break;
        case 'es' :
                header('Location: sp/');
                break;
        default:
                header('Location: en/');
                break;
}
?>