<ul class="nav menu flex-column">
    <li class="menu-item">
        <a class="menu-link" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="可在此說明產品特色，競爭優勢，闡述經營理念，公司沿革等等資訊，讓來到您網站的客戶或使用者對您有夠進一步的瞭解。" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="fa fa-eye menu-icon-img"></i><span class="menu-text"><?php echo $ModuleName['About']; ?></span>
        </a>
    </li>
    <li class="menu-item">
        <a class="menu-link" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
            <i class="fa fa-plus menu-icon-img"></i><span class="menu-text">新增資料</span>
        </a>
    </li>
    <li class="menu-item">
        <a class="menu-link" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=startpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="替目前選單設定起始頁，您必須選定一個頁面內容，否則該選單是不會抓取到頁面。" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="fa fa-star menu-icon-img"></i><span class="menu-text" id="Step_Home">起始頁設定</span>
        </a>
    </li>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
    <li class="menu-item">
        <a class="menu-link" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="fa fa-list-ul menu-icon-img"></i><span class="menu-text">次分類設定</span>
        </a>
    </li>
    <?php } ?>
</ul>

<?php
$UrlWriteEnable = false;

$slide = [
    [
        'icon' => 'fa fa-sitemap',
        'title' => 'Navigation',
        'tooltip' => '可在此說明產品特色，競爭優勢，闡述經營理念，公司沿革等等資訊，讓來到您網站的客戶或使用者對您有夠進一步的瞭解。',
        'url' => 'javascript:;',
        'caret' => true,
        'sub_menu' => [
            [
                'url' => url_rewrite("manage_about", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'viewpage'), '', $UrlWriteEnable),
                'title' => $ModuleName['About'],
                'tooltip' => '可在此說明產品特色，競爭優勢，闡述經營理念，公司沿革等等資訊，讓來到您網站的客戶或使用者對您有夠進一步的瞭解。',
                'route-name' => $ModuleName['About'].'.view'
            ], [
                'url' => url_rewrite("manage_about", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'addpage'), '', $UrlWriteEnable),
                'title' => '新增資料',
                'tooltip' => '',
                'route-name' => $ModuleName['About'].'.add'
            ], [
                'url' => url_rewrite("manage_about", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'startpage'), '', $UrlWriteEnable),
                'title' => '起始頁設定',
                'tooltip' => '替目前選單設定起始頁，您必須選定一個頁面內容，否則該選單是不會抓取到頁面。',
                'route-name' => $ModuleName['About'].'.start'
            ], [
                'url' => url_rewrite("manage_about", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'listpage'), '', $UrlWriteEnable),
                'title' => '次分類設定',
                'tooltip' => '您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。',
                'route-name' => $ModuleName['About'].'.list'
            ]
        ]
    ],[
        'icon' => 'fa fa-sitemap',
        'title' => 'Navigation',
        'url' => 'javascript:;',
        'caret' => true,
        'sub_menu' => [
            [
                'url' => url_rewrite("manage_about", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'viewpage'), '', $UrlWriteEnable),
                'title' => $ModuleName['About'],
                'tooltip' => '可在此說明產品特色，競爭優勢，闡述經營理念，公司沿革等等資訊，讓來到您網站的客戶或使用者對您有夠進一步的瞭解。',
                'route-name' => $ModuleName['About'].'.view'
            ], [
                'url' => url_rewrite("manage_about", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'addpage'), '', $UrlWriteEnable),
                'title' => '新增資料',
                'tooltip' => '',
                'route-name' => $ModuleName['About'].'.add'
            ], [
                'url' => url_rewrite("manage_about", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'startpage'), '', $UrlWriteEnable),
                'title' => '起始頁設定',
                'tooltip' => '替目前選單設定起始頁，您必須選定一個頁面內容，否則該選單是不會抓取到頁面。',
                'route-name' => $ModuleName['About'].'.start'
            ], [
                'url' => url_rewrite("manage_about", array('wshop' => $wshop, 'lang' => $_SESSION['lang'], 'Opt' => 'listpage'), '', $UrlWriteEnable),
                'title' => '次分類設定',
                'tooltip' => '您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。',
                'route-name' => $ModuleName['About'].'.list'
            ]
        ]
    ]
];

$GLOBALS['sub_level'] = 0;
$GLOBALS['active'] = '';

function renderSubMenu($value, $currentUrl) {
    $subMenu = '';
    ++$GLOBALS['sub_level'];
    @$GLOBALS['active'][$GLOBALS['sub_level']] = '';
    $currentLevel = $GLOBALS['sub_level'];
    foreach ($value as $key => $menu) {
        $GLOBALS['subparent_level'] = '';

        $subSubMenu = '';
        $hasSub = (!empty($menu['sub_menu'])) ? 'has-sub' : '';
        $hasCaret = (!empty($menu['sub_menu'])) ? '<div class="menu-caret"></div>' : '';
        $hasHighlight = (!empty($menu['highlight'])) ? '<i class="fa fa-paper-plane text-theme ms-1"></i>' : '';
        $hasTitle = (!empty($menu['title'])) ? '<div class="menu-text">'. $menu['title'] . $hasHighlight .'</div>' : '';

        if (!empty($menu['sub_menu'])) {
            $subSubMenu .= '<div class="menu-submenu">';
            $subSubMenu .= renderSubMenu($menu['sub_menu'], $currentUrl);
            $subSubMenu .= '</div>';
        }

        $active = (!empty($menu['route-name'])) ? 'active' : '';

        if ($active) {
            $GLOBALS['parent_active'] = true;
            $GLOBALS['active'][$GLOBALS['sub_level'] - 1] = true;
        }
        if (!empty($GLOBALS['active'][$currentLevel])) {
            $active = 'active';
        }

        $active = '';

        $subMenu .= '
							<div class="menu-item '. $hasSub .' '. $active .'">
								<a href="'. $menu['url'] .'" class="menu-link" data-bs-original-title="'. $menu['tooltip'] .'" data-bs-toggle="tooltip" data-bs-placement="right">' . $hasTitle . $hasCaret .'</a>
								'. $subSubMenu .'
							</div>
						';
    }
    return $subMenu;
}

foreach($slide as $key => $menu) {

    $hasSub = (!empty($menu['sub_menu'])) ? 'has-sub' : '';
    $hasCaret = (!empty($menu['caret'])) ? '<div class="menu-caret"></div>' : '';
    $hasIcon = (!empty($menu['icon'])) ? '<div class="menu-icon"><i class="'. $menu['icon'] .'"></i></div>' : '';
    $hasImg = (!empty($menu['img'])) ? '<div class="menu-icon-img"><img src="'. $menu['img'] .'" /></div>' : '';
    $hasLabel = (!empty($menu['label'])) ? '<span class="menu-label">'. $menu['label'] .'</span>' : '';
    $hasTitle = (!empty($menu['title'])) ? '<div class="menu-text">'. $menu['title'] . $hasLabel .'</div>' : '';
    $hasBadge = (!empty($menu['badge'])) ? '<div class="menu-badge">'. $menu['badge'] .'</div>' : '';

    $subMenu = '';

    if (!empty($menu['sub_menu'])) {
        $GLOBALS['sub_level'] = 0;
        $subMenu .= '<div class="menu-submenu">';
        $subMenu .= renderSubMenu($menu['sub_menu'], ADMINPATH);
        $subMenu .= '</div>';
    }

    $active = (!empty($menu['route-name'])) ? 'active' : '';
    $active = (empty($active) && !empty($GLOBALS['parent_active'])) ? 'active' : $active;

    //$active = '';

    $link = html()->a()->href($menu['url'])->class('menu-link')->attribute('data-bs-original-title', $menu['tooltip'])->attribute('data-bs-placement', 'right')->attribute('data-bs-toggle', 'tooltip')->prependChild($hasCaret)->prependChild($hasBadge)->prependChild($hasTitle)->prependChild($hasIcon)->prependChild($hasImg)->toHtml();
    echo html()->div()->class('menu-item')->class($hasSub)->class($active)->children($link)->children($subMenu)->toHtml();

}

?>

