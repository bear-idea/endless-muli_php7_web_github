

<ul class="accordion"  id="accordion-3">
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
    <li class="parent"><a>快速上手</a>
    	<ul>
            <li class="parent"><a>新手指南</a>
            	<ul>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=faq&amp;lang=<?php echo $_SESSION['lang']; ?>">Logo如何更換?</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=faq01&amp;lang=<?php echo $_SESSION['lang']; ?>">版型如何更換?</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=faq02&amp;lang=<?php echo $_SESSION['lang']; ?>">橫幅如何更換?</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <?php } ?>  
	<li class="parent"><a>操作介面</a>
    	<ul>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu01&amp;lang=<?php echo $_SESSION['lang']; ?>">介面說明</a></li>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu02&amp;lang=<?php echo $_SESSION['lang']; ?>">基本操作</a></li>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu03&amp;lang=<?php echo $_SESSION['lang']; ?>">HTML編輯器</a></li>
        </ul>
    </li>
    <li class="parent"><a>基本設定</a>
    	<ul>
        	<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu04&amp;lang=<?php echo $_SESSION['lang']; ?>">帳密修改</a></li>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu05&amp;lang=<?php echo $_SESSION['lang']; ?>">網站基本資料</a></li>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu06&amp;lang=<?php echo $_SESSION['lang']; ?>">個人基本資料</a></li>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu07&amp;lang=<?php echo $_SESSION['lang']; ?>">關鍵字設定</a></li>
        </ul>
    </li>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
    <li class="parent"><a>版型修改</a>
    	<ul>
        	<li class="parent"><a class="menu-link" href=#">樣板部分</a>
            	<ul>
                	<!--<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu08&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>-->
                	<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu08&amp;lang=<?php echo $_SESSION['lang']; ?>">如何更換版型</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu26&amp;lang=<?php echo $_SESSION['lang']; ?>">建立空白版型</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu25&amp;lang=<?php echo $_SESSION['lang']; ?>">複製已有版型</a></li>
                </ul>
            </li>
            <li class="child"><a class="menu-link" href=#">Logo部分</a>
                <ul>
<!--                	<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu09&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>
-->                	<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu16&amp;lang=<?php echo $_SESSION['lang']; ?>">如何更換Logo</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu17&amp;lang=<?php echo $_SESSION['lang']; ?>">如何建立Logo</a></li>
                </ul>
            </li>
            <li class="child"><a class="menu-link" href=#">區塊背景部分</a>
            	<ul>
                	<!--<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu10&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>-->
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu18&amp;lang=<?php echo $_SESSION['lang']; ?>">區塊位置說明</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu19&amp;lang=<?php echo $_SESSION['lang']; ?>">如何建立背景</a></li>
                </ul>
            </li> 	
            <li class="child"><a class="menu-link" href=#">區塊外框部分</a>
            	<ul>
                	<!--<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu11&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>-->
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu20&amp;lang=<?php echo $_SESSION['lang']; ?>">外框位置說明</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu21&amp;lang=<?php echo $_SESSION['lang']; ?>">如何建立外框</a></li>
                </ul>
            </li> 	 	
            <li class="child"><a class="menu-link" href=#">主選單部分</a>
            	<ul>
                	<!--<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu12&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>-->
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu36&amp;lang=<?php echo $_SESSION['lang']; ?>">主選單位置說明</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu22&amp;lang=<?php echo $_SESSION['lang']; ?>">如何建立主選單</a></li>
                </ul>
            </li> 	 	
            <li class="child"><a class="menu-link" href=#">側邊裝飾外框部分</a>
            	<ul>
                	<!--<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu13&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>   -->
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu38&amp;lang=<?php echo $_SESSION['lang']; ?>">側邊裝飾外框位置說明</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu23&amp;lang=<?php echo $_SESSION['lang']; ?>">建立側邊裝飾外框</a></li>
                </ul>
            </li> 	 	
            <li class="child"><a class="menu-link" href=#">側邊選單部分</a>
            	<ul>
                	<!--<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu14&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>   -->
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu37&amp;lang=<?php echo $_SESSION['lang']; ?>">側邊選單位置說明</a></li>
                    <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu24&amp;lang=<?php echo $_SESSION['lang']; ?>">建立側邊選單</a></li>
                </ul>
            </li> 	 		 	
        </ul>
    </li>
    <?php } ?>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDfPageSelect == '1') { ?>
    <li class="parent"><a>自訂頁面</a>
    	<ul>
        	<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu27&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu28&amp;lang=<?php echo $_SESSION['lang']; ?>">如何新增選單</a></li>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu29&amp;lang=<?php echo $_SESSION['lang']; ?>">新增頁面資料</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
    <li class="parent"><a>自訂欄位</a>
    	<ul>
        	<li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu30&amp;lang=<?php echo $_SESSION['lang']; ?>">主要操作畫面</a></li>
            <li class="child"><a class="menu-link" href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu31&amp;lang=<?php echo $_SESSION['lang']; ?>">如何新增區塊</a></li>
        </ul>
    </li>
    <?php } ?>
</ul>
