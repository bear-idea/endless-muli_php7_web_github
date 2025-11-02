<?php
$modules = [
    ['url' => "../index", 'icon' => 'fas fa-home-lg', 'text' => '前台瀏覽', 'params' => "wshop={$_SESSION['wshopforckeditor']}"],
    ['url' => "tutorials", 'icon' => 'fas fa-book', 'text' => '操作指南', 'params' => "wshop={$wshop}&Opt_Tutorials=viewpage&lang={$_SESSION['lang']}"],
    ['url' => "javascript:void(0);", 'icon' => 'fas fa-abacus', 'text' => '導覽步驟', 'params' => "", 'onclick' => "startIntro();", 'id' => 'startButton'],
    ['url' => "", 'icon' => '', 'text' => '基本<br/>模組', 'params' => "", 'style' => 'background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;', 'additionalClass' => 'cl_orange'],
    ['url' => "about", 'icon' => 'far fa-address-book', 'text' => $ModuleName['About'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAboutSelect == '1'],
    ['url' => "news", 'icon' => 'far fa-newspaper', 'text' => $ModuleName['News'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionNewsSelect == '1'],
    ['url' => "actnews", 'icon' => 'images/mt_021.png', 'text' => $ModuleName['Actnews'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'img' => true, 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionActnewsSelect == '1'],
    ['url' => "product", 'icon' => 'fas fa-box-open', 'text' => $ModuleName['Product'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionProductSelect == '1'],
    ['url' => "frilink", 'icon' => 'fab fa-ubuntu', 'text' => $ModuleName['Frilink'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionFrilinkSelect == '1'],
    ['url' => "contactmail", 'icon' => 'fas fa-phone-volume', 'text' => $ModuleName['Contact'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionContactSelect == '1'],
    ['url' => "", 'icon' => '', 'text' => '擴充<br/>模組', 'params' => "", 'style' => 'background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;', 'additionalClass' => 'cl_green'],
    ['url' => "bulletin", 'icon' => 'images/mt_087.png', 'text' => '公告資訊', 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'img' => true],
    ['url' => "cart", 'icon' => 'fas fa-store-alt', 'text' => $ModuleName['Cart'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1'],
    ['url' => "socialchat", 'icon' => 'images/mt_111.png', 'text' => '社群聊天', 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'img' => true, 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionSocialChatSelect == '1'],
    ['url' => "timeline", 'icon' => 'images/mt_057.png', 'text' => $ModuleName['Timeline'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'img' => true, 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTimelineSelect == '1'],
    ['url' => "imageshow", 'icon' => 'images/mt_058.png', 'text' => $ModuleName['Imageshow'], 'params' => "wshop={$wshop}&Opt=viewpage&lang={$_SESSION['lang']}", 'img' => true, 'condition' => $_SESSION['MM_UserGroup'] == 'superadmin' || $OptionImageshowSelect == '1'],
];

function renderModule($module) {
    $isImg = $module['img'] ?? false;
    $onclick = $module['onclick'] ?? null;
    $id = $module['id'] ?? null;
    $style = $module['style'] ?? '';
    $additionalClass = $module['additionalClass'] ?? 'cl_gray';

    if (!isset($module['condition']) || $module['condition']) {
        echo '<a href="' . $module['url'] . '?' . $module['params'] . '" ' . ($onclick ? 'onclick="' . $onclick . '"' : '') . ' ' . ($id ? 'id="' . $id . '"' : '') . '>';
        echo '<div class="Menu_ListView_Icon_Board ' . $additionalClass . '" style="' . $style . '">';
        echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
        echo '<tr>';
        echo '<td height="80" align="center">';
        if ($isImg) {
            echo '<img src="' . $module['icon'] . '" width="60" height="60">';
        } else {
            echo '<i class="' . $module['icon'] . ' fa-3x"></i>';
        }
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td height="20" align="center"><p>' . $module['text'] . '</p></td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</a>';
    }
}

foreach ($modules as $module) {
    //renderModule($module);
}
?>

<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

<style>
    .masonry {
        /* 清除浮動 */
        overflow: hidden;
        margin: 0 auto;
    }

    .masonry-item {
        /* 每個項目的固定寬度和高度 */
        width: 110px;
        height: 110px;
        margin-bottom: 10px; /* 項目之間的間距 */
    }
    </style>

<div class="masonry">
    <div class="masonry-item">Item 1</div>
    <div class="masonry-item">Item 2</div>
    <div class="masonry-item">Item 3</div>
    <div class="masonry-item">Item 1</div>
    <div class="masonry-item">Item 2</div>
    <div class="masonry-item">Item 3</div>
    <div class="masonry-item">Item 1</div>
    <div class="masonry-item">Item 2</div>
    <div class="masonry-item">Item 3</div>
    <div class="masonry-item">Item 1</div>
    <div class="masonry-item">Item 2</div>
    <div class="masonry-item">Item 3</div>

</div>

<script>
    var elem = document.querySelector('.masonry');
    var msnry = new Masonry(elem, {
        itemSelector: '.masonry-item',
        columnWidth: 110, // 每列的基本寬度
        gutter: 10, // 列之間的間距
        fitWidth: true // 自適應父容器寬度
    });
</script>


<a href="../index?wshop=<?php echo $_SESSION['wshopforckeditor']; ?>">
<div class="widget widget-stats bg-teal mb-7px Menu_ListView_Icon_Board">
    <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
    <div class="stats-content">
        <div class="stats-title">TODAY'S VISITS</div>
        <div class="stats-number">7,842,900</div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width: 70.1%;"></div>
        </div>
        <div class="stats-desc">Better than last week (70.1%)</div>
    </div>
</div>
</a>

<a href="../index?wshop=<?php echo $_SESSION['wshopforckeditor']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="fas fa-home-lg fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center">前台瀏覽</td>
    </tr>
  </table>
</div>
</a> 
<a href="tutorials?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="fas fa-book fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><p>操作指南</p></td>
    </tr>
  </table>
</div>
</a> 
<a href="javascript:void(0);" onclick="startIntro();" id="startButton">
<div class="Menu_ListView_Icon_Board cl_gray">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="fas fa-abacus fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><p>導覽步驟</p></td>
    </tr>
  </table>
</div>
</a>

<?php //require_once("require_home_mod_select_view_scale"); ?>

<div class="Menu_ListView_Icon_Board cl_orange" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">基本<br/>
        模組</td>
    </tr>
  </table>
</div>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAboutSelect == '1') { ?>
<a href="about?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionAboutSelect == '1') {  ?>cl_orange<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="far fa-address-book fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['About']; // 關於我們?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionNewsSelect == '1') { ?>
<a href="news?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionNewsSelect == '1') {  ?>cl_orange<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="far fa-newspaper fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['News']; // 最新訊息?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionActnewsSelect == '1') { ?>
<a href="actnews?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionActnewsSelect== '1') {  ?>cl_orange<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_021.png" alt="" width="60" height="60"></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Actnews']; // 活動快訊?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionProductSelect == '1') { ?>
<a href="product?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionProductSelect == '1') {  ?>cl_orange<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="fas fa-box-open fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Product']; // 產品維護?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionFrilinkSelect == '1') { ?>
<a href="frilink?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionFrilinkSelect == '1') {  ?>cl_orange<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="fab fa-ubuntu fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Frilink']; // 友站連結?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionContactSelect == '1') { ?>
<a href="contactmail?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionContactSelect == '1') {  ?>cl_orange<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="fas fa-phone-volume fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Contact']; // 聯絡我們?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<div class="Menu_ListView_Icon_Board cl_green" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">擴充<br/>
        模組</td>
    </tr>
  </table>
</div>
<a href="bulletin?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_green">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_087.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">公告資訊</td>
    </tr>
  </table>
</div>
</a>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { ?>
<a href="cart?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionCartSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="fas fa-store-alt fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Cart']; // 購物車管理?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionSocialChatSelect == '1') { ?>
<a href="socialchat?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionSocialChatSelect == '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_111.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">社群聊天</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTimelineSelect == '1') { ?>
<a href="timeline?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionTimelineSelect == '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_057.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Timeline']; // 歷史沿革?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionImageshowSelect == '1') { ?>
<a href="imageshow?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionImageshowSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_058.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Imageshow']; // 圖片展示?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAlbumSelect == '1') { ?>
<a href="album?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionAlbumSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_012.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Album']; // 相簿管理?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTicketsSelect == '1') { ?>
<!--<div class="Menu_ListView_Icon_Board cl_green">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="80" align="center"><a href="tickets?wshop=<?php echo $wshop;?>&amp;Opt_Tickets=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/mt_018.png" alt="" width="60" height="60" /></a></td>
                                  </tr>
                                  <tr>
                                    <td height="20" align="center"><?php echo $ModuleName_Tickets; // 訂票系統?></td>
                                  </tr>
                                </table>
                            </div>-->
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionOrgSelect == '1') { ?>
<a href="org?wshop=<?php echo $wshop;?>&amp;Opt_Org=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionOrgSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_017.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Org']; // 組織成員?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionVideoSelect == '1') { ?>
<a href="video?wshop=<?php echo $wshop;?>&amp;Opt_Video=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionVideoSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_010.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Video']; // 影片管理?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionSponsorSelect == '1') { ?>
<a href="sponsor?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionSponsorSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="fab fa-apple fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Sponsor']; // 贊助企業?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCareersSelect == '1') { ?>
<a href="careers?wshop=<?php echo $wshop;?>&amp;Opt_Careers=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionCareersSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_016.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Careers']; // 求職徵才?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionGuestbookSelect == '1') { ?>
<a href="guestbook?wshop=<?php echo $wshop;?>&amp;Opt_Guestbook=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionGuestbookSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_007.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Guestbook']; // 留言管理?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionActivitiesSelect == '1') { ?>
<a href="activities?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionActivitiesSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_014.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Activities']; // 活動花絮?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionPublishSelect == '1') { ?>
<a href="publish?wshop=<?php echo $wshop;?>&amp;Opt_Publish=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionPublishSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_003.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Publish']; // 公布資訊?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionOtrlinkSelect == '1') { ?>
<a href="otrlink?wshop=<?php echo $wshop;?>&amp;Opt_Otrlink=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionOtrlinkSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_051.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Otrlink']; // 相關連結?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionArticleSelect == '1') { ?>
<a href="article?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionArticleSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_008.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Article']; // 文章管理?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionLettersSelect == '1') { ?>
<a href="letters?wshop=<?php echo $wshop;?>&amp;Opt_Letters=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionLettersSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_020.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Letters']; // 新聞快報?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionFaqSelect == '1') { ?>
<a href="faq?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionFaqSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_024.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Faq']; // 常見問答?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionPartnerSelect == '1') { ?>
<a href="partner?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionPartnerSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_026.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Partner']; // 合作夥伴?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionArtlistSelect == '1') { ?>
<a href="artlist?wshop=<?php echo $wshop;?>&amp;Opt_Artlist=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionArtlistSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_027.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Artlist']; // 藝文專欄?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionForumSelect == '1') { ?>
<a href="forum?wshop=<?php echo $wshop;?>&amp;Opt_Forum=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionForumSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_029.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Forum']; // 討論專區?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionPicasaSelect == '1') { ?>
<a href="picasa?wshop=<?php echo $wshop;?>&amp;Opt_Picasa=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionPicasaSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_052.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Picasa']; // 雲端相簿?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionKnowledgeSelect == '1') { ?>
<a href="knowledge?wshop=<?php echo $wshop;?>&amp;Opt_Knowledge=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionKnowledgeSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_031.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Knowledge']; // 知識學習?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionProjectSelect == '1') { ?>
<a href="project?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionProjectSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_032.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Project']; // 工程實績?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCatalogSelect == '1') { ?>
<a href="catalog?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionCatalogSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_033.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Catalog']; // 產品型錄?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionMenuMaintainSelect == '1') { ?>
<!--<div class="Menu_ListView_Icon_Board cl_green">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="80" align="center"><a href="navimenu?wshop=<?php echo $wshop;?>&amp;Opt_Navimenu=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/mt_034.png" alt="" width="60" height="60" /></a></td>
                                </tr>
                                <tr>
                                  <td height="20" align="center">選單維護</td>
                                </tr>
                              </table>
                        </div>-->
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionStrongholdSelect == '1') { ?>
<a href="stronghold?wshop=<?php echo $wshop;?>&amp;Opt_Stronghold=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionStrongholdSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_059.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Stronghold']; // 經營據點?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDealerSelect == '1') { ?>
<a href="dealer?wshop=<?php echo $wshop;?>&amp;Opt_Dealer=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionDealerSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_077.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Dealer']; // 經銷專區?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionEPaperSelect == '1') { ?>
<a href="epaper?wshop=<?php echo $wshop;?>&amp;Opt_EPaper=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionEPaperSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_022.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['EPaper']; // 電子期刊?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionMeetingSelect == '1') { ?>
<a href="meeting?wshop=<?php echo $wshop;?>&amp;Opt_Meeting=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionMeetingSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_009.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Meeting']; // 會議紀錄?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionFileMangSelect == '1') { ?>
<a onclick="openKCFinder(this)" style="cursor: pointer;">
<div class="Menu_ListView_Icon_Board <?php if($OptionFileMangSelect== '1') {  ?>cl_green<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_004.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">檔案管理</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionBookingSelect == '1') { ?>
<div class="Menu_ListView_Icon_Board cl_yellow" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">預約<br/>
        系統</td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionBookingSelect == '1') { ?>
<a href="service?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionBookingSelect == '1') {  ?>cl_yellow<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_105.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">服務項目</td>
    </tr>
  </table>
</div>
</a>
<a href="employees?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionBookingSelect == '1') {  ?>cl_yellow<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_017.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">員工管理</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionRoomSelect == '1') { ?>
<div class="Menu_ListView_Icon_Board cl_yellow" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">風情<br/>
        民宿</td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionRoomSelect == '1') { ?>
<a href="room?wshop=<?php echo $wshop;?>&amp;Opt_Room=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionRoomSelect == '1') {  ?>cl_yellow<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_067.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Room']; // 房型展示?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionRoomSelect == '1') { ?>
<a href="reserve?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=state&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionRoomSelect == '1') {  ?>cl_yellow<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_075.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo "訂房系統"; // 房型展示?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAttractionsSelect == '1') { ?>
<a href="attractions?wshop=<?php echo $wshop;?>&amp;Opt_Attractions=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionAttractionsSelect == '1') {  ?>cl_yellow<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_068.png" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Attractions']; // 房型展示?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionBlogSelect == '1') { ?>
<div class="Menu_ListView_Icon_Board cl_yellow2" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">部落<br/>
        網誌</td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionBlogSelect == '1') { ?>
<a href="blog?wshop=<?php echo $wshop;?>&amp;Opt_Blog=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board <?php if($OptionBlogSelect == '1') {  ?>cl_yellow2<?php } else { ?>cl_gray2<?php } ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_047.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Blog']; // 部落格?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<div class="Menu_ListView_Icon_Board cl_blue" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">橫幅<br/>
        更換</td>
    </tr>
  </table>
</div>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAdsSelect == '1') { ?>
<a href="<?php if ($OptionTmpSelect == '1') { ?>ads?wshop=<?php echo $wshop;?>&amp;Opt=step_map&amp;lang=<?php echo $_SESSION['lang']; ?><?php } else { ?>ads?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?><?php } ?>">
<div class="Menu_ListView_Icon_Board cl_blue">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Banner">
    <tr>
      <td height="80" align="center"><img src="images/mt_037.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">輪播系統</td>
    </tr>
  </table>
</div>
</a> 
<a href="bannershow?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_blue">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_085.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">橫幅下載</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
<div class="Menu_ListView_Icon_Board cl_blue2" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">外觀<br/>
        自訂</td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
<a href="logo?wshop=<?php echo $wshop;?>&amp;Opt=step_map&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_blue2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Logo">
    <tr>
      <td height="80" align="center"><img src="images/mt_062.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><p>Logo</p></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
<a href="tmp?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_blue2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center">
        <img src="images/mt_045.png" alt="" width="60" height="60"/>
      </td>
    </tr>
    <tr>
      <td height="20" align="center">版型設計</td>
    </tr>
  </table>
</div>
</a>
<?php if ($OptionTmpHomeSelect == '1') {?>
<a href="tmp?wshop=<?php echo $wshop;?>&amp;Opt=selectpage_home&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_blue2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center">
        <img src="images/mt_061.png" alt="" width="60" height="60"/>
        </td>
    </tr>
    <tr>
      <td height="20" align="center">首頁維護</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionMobileSelect == '1') { ?>
<a href="mobile?wshop=<?php echo $wshop;?>&amp;Opt=tmp_mobile_config&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_blue2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_071.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">行動裝置</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<a href="magic?wshop=<?php echo $wshop;?>&amp;Opt_Magic=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_blue2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_064.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo "魔法特效"; // 部落格?></td>
    </tr>
  </table>
</div>
</a>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDfPageSelect == '1') { ?>
<div class="Menu_ListView_Icon_Board cl_purple" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">選單<br/>
        維護</td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDfPageSelect == '1') { ?>
<a href="dfpage?wshop=<?php echo $wshop;?>&amp;Opt=searchallpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_purple">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><i class="far fa-file fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center">頁面維護</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDfPageSelect == '1') { ?>
<a href="dfpage?wshop=<?php echo $wshop;?>&amp;Opt=typepage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_purple">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_MainMenu">
    <tr>
      <td height="80" align="center"><i class="fas fa-bars-staggered fa-3x"></i></td>
    </tr>
    <tr>
      <td height="20" align="center">選單配置</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1' && $Shop3500_Limit_Mod != "Shop3500_Blog") { ?>
<a href="leftcolumn?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_purple">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Column">
    <tr>
      <td height="80" align="center"><img src="images/mt_049.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">自訂欄位</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || ($OptionTmpSelect == '1' && $OptionBlogSelect == '1' )) { ?>
<a href="tmp?wshop=<?php echo $wshop;?>&amp;Opt=tmpblogcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_purple">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_050.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">自訂欄位(Blog)</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1' && $Shop3500_Limit_Mod != "Shop3500_Blog") { ?>
<a href="modlink?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_purple">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Column_Mod">
    <tr>
      <td height="80" align="center"><img src="images/mt_065.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Modlink'];; // 模組連結?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<a href="privacy?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_purple">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Column_Mod">
    <tr>
      <td height="80" align="center"><img src="images/mt_090.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo "隱私權政策"; // 模組連結?></td>
    </tr>
  </table>
</div>
</a>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionMemberSelect == '1') { ?>
<div class="Menu_ListView_Icon_Board cl_blue3" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">會員<br/>
        管理</td>
    </tr>
  </table>
</div>
<a href="member?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_blue3">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_013.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Member']; // 會員管理?></td>
    </tr>
  </table>
</div>
</a> 
<a href="member?wshop=<?php echo $wshop;?>&amp;Opt=thirdparty&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_blue3">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_092.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">登入串接</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<div class="Menu_ListView_Icon_Board cl_brown" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">帳戶<br/>
        管理</td>
    </tr>
  </table>
</div>
<a href="setting?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_ap&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_brown">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Psw">
    <tr>
      <td height="80" align="center"><img src="images/mt_023.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">帳密修改</td>
    </tr>
  </table>
</div>
</a>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<a href="webuser_sub?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_brown">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_023.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">子帳號管理</td>
    </tr>
  </table>
</div>
</a>
<a href="permission?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_brown">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_023.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">權限設定</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<a href="siteconfig?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_bs&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_brown">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Basic">
    <tr>
      <td height="80" align="center"><img src="images/mt_080.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">網站資訊</td>
    </tr>
  </table>
</div>
</a> 
<a href="state?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_brown">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_055.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><p>帳務資訊</p></td>
    </tr>
  </table>
</div>
</a>
<?php //if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<a href="exmod?wshop=<?php echo $wshop;?>&amp;Opt_Exmod=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_brown">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Update">
    <tr>
      <td height="80" align="center"><img src="images/mt_081.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><p>擴充升級</p></td>
    </tr>
  </table>
</div>
</a>
<?php //} ?>
<div class="Menu_ListView_Icon_Board cl_red" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">網站<br/>
        優化</td>
    </tr>
  </table>
</div>
<a href="keyword?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_ky&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_red">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Key">
    <tr>
      <td height="80" align="center"><img src="images/mt_035.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">關鍵字</td>
    </tr>
  </table>
</div>
</a> 
<a href="weburl?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_red">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_066.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">網站提交</td>
    </tr>
  </table>
</div>
</a> 
<a href="webanalytics?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_red">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="Step_Analytics">
    <tr>
      <td height="80" align="center"><img src="images/mt_038.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">分析工具</td>
    </tr>
  </table>
</div>
</a>
<div class="Menu_ListView_Icon_Board cl_pink2" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">加值<br/>
        工具</td>
    </tr>
  </table>
</div>
<a href="crop/index" class="colorbox_iframe">
<div class="Menu_ListView_Icon_Board cl_pink2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_073.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">裁圖工具</td>
    </tr>
  </table>
</div>
</a>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<a href="pixidou-master/index" class="colorbox_iframe">
<div class="Menu_ListView_Icon_Board cl_pink2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_074.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">圖形處理</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<div class="Menu_ListView_Icon_Board cl_gray2" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">開發者<br/>
        專用</td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<a href="webuser?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_046.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><p>網站使用者</p></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<a href="webuser?wshop=<?php echo $wshop;?>&amp;Opt=changeaccount&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_069.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">帳號更換</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAnalysisSelect == '1') { ?>
<a href="analysis?wshop=<?php echo $wshop;?>&amp;Opt_Analysis=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_038.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">統計資料</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionWebSiteSelect == '1') { ?>
<a href="website?wshop=<?php echo $wshop;?>&amp;Opt_WebSite=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_039.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">網站管理</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<div class="Menu_ListView_Icon_Board cl_gray2" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">台灣<br/>
        趴趴照 </td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<a href="travel?wshop=<?php echo $wshop;?>&amp;Opt_Travel=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_070.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">旅遊景點</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<div class="Menu_ListView_Icon_Board cl_gray2" style="background-image:url(images/mt_color_010.png); color:#4d5258; font-weight:bolder;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="100" align="center">未開放<br/>
        功能</td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCouponsSelect == '1') { ?>
<a href="coupons?wshop=<?php echo $wshop;?>&amp;Opt_Coupons=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_056.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Coupons']; // 優惠票眷?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
<a href="sitemail?wshop=<?php echo $wshop;?>&amp;Opt_Sitemail=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <?php //if($totalRows_RecordSitemail >0) { ?>
  <div style="position:absolute;"><a href="#" data-bs-original-title="您有新信件。" data-bs-toggle="tooltip" data-bs-placement="right"><img src="images/new.png" width="30" height="30" alt=""/></div>
  <?php //} ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_005.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">站內信件</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionADWallSelect == '1') { ?>
<a href="#">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_025.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['AD']; // 廣告發布?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDailySelect == '1') { ?>
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><a href="#"><img src="images/mt_028.png" alt="" width="60" height="60" /></a></td>
    </tr>
    <tr>
      <td height="20" align="center">主題日誌</td>
    </tr>
  </table>
</div>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDonationSelect == '1') { ?>
<a href="donation?wshop=<?php echo $wshop;?>&amp;Opt_Donation=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_015.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center"><?php echo $ModuleName['Donation']; // 捐款名錄?></td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCalendarSelect == '1') { ?>
<a href="#">
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center"><img src="images/mt_030.png" alt="" width="60" height="60" /></td>
    </tr>
    <tr>
      <td height="20" align="center">年度行事</td>
    </tr>
  </table>
</div>
</a>
<?php } ?>
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" align="center">&nbsp;</td>
    </tr>
  </table>
</div>
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" align="center">&nbsp;</td>
    </tr>
  </table>
</div>
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" align="center">&nbsp;</td>
    </tr>
  </table>
</div>
<div class="Menu_ListView_Icon_Board cl_gray2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="80" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" align="center">&nbsp;</td>
    </tr>
  </table>
</div>
