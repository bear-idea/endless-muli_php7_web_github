<a href="<?php echo BASEURL; ?>/index.php?wshop=<?php echo $wshop; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>">
    <div class="widget widget-stats Menu_ListView_Icon_Board cl_red_n">
        <div class="stats-icon stats-icon-lg"><span class="iconify fs-100px" data-icon="solar:home-2-bold-duotone"></span></div>
        <div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center">
            <i class="iconify fs-50px" data-icon="solar:home-2-bold-duotone"></i>
            <div class="fw-bolder">前台瀏覽</div>
        </div>
    </div>
</a>

<a href="#" onclick="openKCFinder(this)">
    <div class="widget widget-stats Menu_ListView_Icon_Board cl_red_n">
        <div class="stats-icon stats-icon-lg"><i class="iconify fs-100px" data-icon="solar:bedside-table-3-bold-duotone"></i></div>
        <div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center">
            <span class="iconify fs-50px" data-icon="solar:bedside-table-3-bold-duotone"></span>
            <div class="fw-bolder">檔案管理</div>
        </div>
    </div>
</a>

<?php
// 動態生成 URL 和渲染小工具
foreach ($RecordMenuModule as $row_RecordMenuModule) {
    // 根據需要添加其他動態參數
    $dynamicParameters = [];

    // 初始化參數，默認包含語言參數
    $parameters = ['lang' => $_SESSION['lang'] ?? 'zh_TW'];

    // 確保 $row_RecordMenuModule["routes"]['prefix'] 和 $row_RecordMenuModule["routes"]['uri'] 都不是 null
    $prefix = isset($row_RecordMenuModule["routes"]['prefix']) ? rtrim($row_RecordMenuModule["routes"]['prefix'], '/') : '';
    $uri = isset($row_RecordMenuModule["routes"]['uri']) ? $row_RecordMenuModule["routes"]['uri'] : '';

    // 構建路徑的邏輯，處理是否為根路徑的情況
    if ($uri === '/') {
        $route = $prefix;
    } else {
        $route = $prefix . '/' . ltrim($uri, '/');
    }

    // 生成 URL
    $url = BASEURL . '/' . generateUrl($route, $parameters);

    // 渲染小工具
    renderWidget($url, $row_RecordMenuModule['icon'], $row_RecordMenuModule['title'], $row_RecordMenuModule['colorclass']);
}
?>

<a href="#">
    <div class="widget widget-stats Menu_ListView_Icon_Board cl_gray2">
        <div class="stats-icon stats-icon-lg"></div>
        <div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center"></div>
    </div>
</a>

<div class="widget widget-stats Menu_ListView_Icon_Board cl_gray2">
    <div class="stats-icon stats-icon-lg"></div>
    <div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center"></div>
</div>
</a>

<div class="widget widget-stats Menu_ListView_Icon_Board cl_gray2">
    <div class="stats-icon stats-icon-lg"></div>
    <div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center"></div>
</div>
</a>

<div class="widget widget-stats Menu_ListView_Icon_Board cl_gray2">
    <div class="stats-icon stats-icon-lg"></div>
    <div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center"></div>
</div>
</a>


<div class="widget widget-stats Menu_ListView_Icon_Board cl_gray2">
    <div class="stats-icon stats-icon-lg"></div>
    <div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center"></div>
</div>
</a>


<div class="widget widget-stats Menu_ListView_Icon_Board cl_gray2">
    <div class="stats-icon stats-icon-lg"></div>
    <div class="stats-content text-center text-purple-900 d-flex flex-column justify-content-center align-items-center"></div>
</div>
</a>
