<?php
use App\Eloquent\Admin\Modules;

$parameters = ['lang' => $_SESSION['lang'] ?? 'zh_TW'];

$RecordSubMenu = (new Modules)->getSubMenu($request, $UseMod)->toArray();

return $RecordSubMenu;

/*return [
    'News' => [
        ['icon' => 'fa fa-eye', 'title' => '最新訊息', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/news', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-plus', 'title' => '新增資料', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/news/add', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-list-ul', 'title' => '次分類設定', 'tooltip' => '您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。', 'url' => ADMINURL . generateUrl('/news/list', $parameters), 'caret' => false, 'permission' => []]
    ],
    'Routes' => [
        ['icon' => 'fa fa-eye', 'title' => '路由管理', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/routes', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-plus', 'title' => '新增資料', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/routes/add', $parameters), 'caret' => false, 'permission' => []]
    ],
    'About' => [
        ['icon' => 'fa fa-eye', 'title' => '關於我們', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/about', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-plus', 'title' => '新增資料', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/about/add', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-list-ul', 'title' => '次分類設定', 'tooltip' => '您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。', 'url' => ADMINURL . generateUrl('/about/list', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-star', 'title' => '起始頁設定', 'tooltip' => '替目前選單設定起始頁，您必須選定一個頁面內容，否則該選單是不會抓取到頁面。', 'url' => ADMINURL . generateUrl('/about/start', $parameters), 'caret' => false, 'permission' => []]
    ],
    'Actnews' => [
        ['icon' => 'fa fa-eye', 'title' => '活動快訊', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/actnews', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-plus', 'title' => '新增資料', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/actnews/add', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-list-ul', 'title' => '次分類設定', 'tooltip' => '您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。', 'url' => ADMINURL . generateUrl('/actnews/list', $parameters), 'caret' => false, 'permission' => []]
    ],
    'Modules' => [
        ['icon' => 'fa fa-eye', 'title' => '模組管理', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/modules', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-plus', 'title' => '新增資料', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/modules/add', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-list-ul', 'title' => '次分類設定', 'tooltip' => '您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。', 'url' => ADMINURL . generateUrl('/modules/list', $parameters), 'caret' => false, 'permission' => []]
    ],
    'MenuBackend' => [
        ['icon' => 'fa fa-eye', 'title' => '後台選單', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/menu-backend', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-plus', 'title' => '新增資料', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/menu-backend/add', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-plus', 'title' => '選單排序', 'tooltip' => '', 'url' => ADMINURL . generateUrl('/menu-backend/sort', $parameters), 'caret' => false, 'permission' => []],
        ['icon' => 'fa fa-list-ul', 'title' => '次分類設定', 'tooltip' => '您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。', 'url' => BASEURL . '/' . generateUrl('admin/menu-backend/list', $parameters), 'caret' => false, 'permission' => []]
    ]
];*/
