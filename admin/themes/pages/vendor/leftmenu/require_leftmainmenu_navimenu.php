
<ul class="nav flex-column">
        	<li class="active">選單維護</li> 
            <li class="menu-item"><a class="menu-link" href="manage_navimenu.php?wshop=<?php echo $wshop;?>&amp;Opt_Navimenu=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">導覽列管理</a></li> 
            <li class="menu-item"><a class="menu-link" href="manage_navimenu.php?wshop=<?php echo $wshop;?>&amp;Opt_Navimenu=addpage_L1&amp;lang=<?php echo $_SESSION['lang']; ?>">新增選單[L1]</a></li>
            <li class="menu-item"><a class="menu-link" href="manage_navimenu.php?wshop=<?php echo $wshop;?>&amp;Opt_Navimenu=addpage_L2&amp;lang=<?php echo $_SESSION['lang']; ?>">新增選單[L2]</a></li>
            <li class="menu-item"><a class="menu-link" href="manage_navimenu.php?wshop=<?php echo $wshop;?>&amp;Opt_Navimenu=addpage_L3&amp;lang=<?php echo $_SESSION['lang']; ?>">新增選單[L3]</a></li>
            <?php if ($ManageNavimenuListSelect == '1') { ?>
            <li class="menu-item"><a class="menu-link" href="manage_navimenu.php?wshop=<?php echo $wshop;?>&amp;Opt_Navimenu=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right">次分類設定</a></li>
            <?php } ?>
		</ul>
    </div>
<?php //echo $_SESSION['lang']; ?>
