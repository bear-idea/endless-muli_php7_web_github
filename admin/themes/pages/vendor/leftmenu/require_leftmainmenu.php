<?php

use Illuminate\Support\Facades\Route;

/**
 * 渲染子菜單
 *
 * @param array $subMenuItems 子菜單項目
 * @param string $currentUrl 當前網址
 * @param int $currentLevel 當前菜單層級
 * @return string 返回HTML字符串表示的子菜單
 */
function renderSubMenu($subMenuItems, $currentUrl, $currentLevel = 1) {
    $subMenu = '';
    foreach ($subMenuItems as $menu) {
        $hasSub = !empty($menu['sub_menu']);
        $hasCaret = !empty($menu['caret']) ? '<div class="menu-caret"></div>' : '';
        $hasHighlight = !empty($menu['highlight']) ? '<i class="fa fa-paper-plane text-theme ms-1"></i>' : '';
        $hasTitle = !empty($menu['title']) ? '<div class="menu-text">' . htmlspecialchars($menu['title'], ENT_QUOTES, 'UTF-8') . $hasHighlight . '</div>' : '';
        $active = !empty($menu['route-name']) ? ' active' : '';

        $subSubMenu = '';
        if ($hasSub) {
            $subSubMenu .= '<div class="menu-submenu">';
            $subSubMenu .= renderSubMenu($menu['sub_menu'], $currentUrl, $currentLevel + 1);
            $subSubMenu .= '</div>';
        }

        $link = '<a href="' . htmlspecialchars($menu['url'], ENT_QUOTES, 'UTF-8') . '" class="menu-link" data-bs-original-title="' . htmlspecialchars($menu['tooltip'], ENT_QUOTES, 'UTF-8') . '" data-bs-toggle="tooltip" data-bs-placement="right">' . $hasTitle . $hasCaret . '</a>';
        $subMenu .= '<div class="menu-item' . ($hasSub ? ' has-sub' : '') . $active . '">' . $link . $subSubMenu . '</div>';
    }
    return $subMenu;
}

/**
 * 渲染主菜單項目
 *
 * @param array $menu 菜單項目
 * @param string $currentUrl 當前網址
 * @return string 返回HTML字符串表示的菜單項目
 */
function renderMenuItem($menu, $currentUrl) {
    $hasSub = !empty($menu['sub_menu']);
    $hasCaret = !empty($menu['caret']) ? '<div class="menu-caret"></div>' : '';
    $hasIcon = !empty($menu['icon']) ? '<div class="menu-icon">' . renderIcon($menu['icon'], 'menu-icon-size') . '</div>' : '';
    $hasImg = !empty($menu['img']) ? '<div class="menu-icon-img"><img src="' . htmlspecialchars($menu['img'], ENT_QUOTES, 'UTF-8') . '" /></div>' : '';
    $hasLabel = !empty($menu['label']) ? '<span class="menu-label">' . htmlspecialchars($menu['label'], ENT_QUOTES, 'UTF-8') . '</span>' : '';
    $hasTitle = !empty($menu['title']) ? '<div class="menu-text">' . htmlspecialchars($menu['title'], ENT_QUOTES, 'UTF-8') . $hasLabel . '</div>' : '';
    $hasBadge = !empty($menu['badge']) ? '<div class="menu-badge">' . htmlspecialchars($menu['badge'], ENT_QUOTES, 'UTF-8') . '</div>' : '';

    $subMenu = '';
    if ($hasSub) {
        $subMenu .= '<div class="menu-submenu">';
        $subMenu .= renderSubMenu($menu['sub_menu'], $currentUrl);
        $subMenu .= '</div>';
    }

    $active = (!empty($menu['route-name']) && (Route::currentRouteName() == $menu['route-name'])) ? 'active' : '';
    $url = htmlspecialchars($menu['url'] ?? '', ENT_QUOTES, 'UTF-8');
    $tooltip = htmlspecialchars($menu['tooltip'] ?? '', ENT_QUOTES, 'UTF-8');
    $link = '<a href="' . $url . '" class="menu-link" data-bs-original-title="' . $tooltip . '" data-bs-toggle="tooltip" data-bs-placement="right">' . $hasIcon . $hasImg . $hasTitle . $hasBadge . $hasCaret . '</a>';
    return '<div class="menu-item ' . ($hasSub ? ' has-sub' : '') . $active . '">' . $link . $subMenu . '</div>';
}

// 確保使用者權限存在並且為陣列
$userGroup = $_SESSION['MM_UserGroup'] ?? null;

foreach ($slide as $key => $menu) {
    // 檢查使用者權限
    $hasPermission = is_array($menu['permission']) && (count($menu['permission']) > 0 && in_array($userGroup, $menu['permission'])) || count($menu['permission']) == 0;
    if ($hasPermission) {
        echo renderMenuItem($menu, ADMINPATH);
    }
}
