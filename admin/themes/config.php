<?php
    $bodyClass = (!empty($appBoxedLayout)) ? 'boxed-layout ' : '';
    $bodyClass .= (!empty($paceTop)) ? 'pace-top ' : $bodyClass;
    $bodyClass .= (!empty($bodyClass)) ? $bodyClass . ' ' : $bodyClass;
    $appSidebarHide = (!empty($appSidebarHide)) ? $appSidebarHide : '';
    $appHeaderHide = (!empty($appHeaderHide)) ? $appHeaderHide : '';
    $appSidebarTwo = (!empty($appSidebarTwo)) ? $appSidebarTwo : '';
    $appSidebarSearch = (!empty($appSidebarSearch)) ? $appSidebarSearch : '';
    $appTopMenu = (!empty($appTopMenu)) ? $appTopMenu : '';

    $appClass = (!empty($appTopMenu)) ? 'app-with-top-menu ' : '';
    $appClass .= (!empty($appHeaderHide)) ? 'app-without-header ' : ' app-header-fixed ';
    $appClass .= (!empty($appSidebarEnd)) ? 'app-with-end-sidebar ' : '';
    $appClass .= (!empty($appSidebarLight)) ? 'app-with-light-sidebar ' : '';
    $appClass .= (!empty($appSidebarWide)) ? 'app-with-wide-sidebar ' : '';
    $appClass .= (!empty($appSidebarHide)) ? 'app-without-sidebar ' : '';
    $appClass .= (!empty($appSidebarMinified)) ? 'app-sidebar-minified ' : '';
    $appClass .= (!empty($appSidebarTwo)) ? 'app-with-two-sidebar app-sidebar-end-toggled ' : '';
    $appClass .= (!empty($appContentFullHeight)) ? 'app-content-full-height ' : '';

    $appContentClass = (!empty($appContentClass)) ? $appContentClass : '';


    $styles = [];

    function push_style($style)
    {
        global $styles;
        $styles[] = $style;
    }

    // 推送和渲染 JS 文件
    $scripts = [];

    function push_script(array &$scripts, $script) {
        $scripts[] = $script;
    }