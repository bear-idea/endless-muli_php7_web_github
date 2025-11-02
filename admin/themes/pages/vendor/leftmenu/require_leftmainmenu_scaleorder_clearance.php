
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_scaleorder_clearance.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span id="Step_View">清運明細</span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_scaleorder_clearance.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span id="Step_Add">新增清運明細</span></a></li>
            <li class="has-sub expand"><a class="menu-link" href=javascript:;" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="right"><b class="caret"></b><i class="fa fa-calendar-alt"></i><span>清運明細報表</span></a>
                <ul class="sub-menu" style="display: block;">
                    <li class="menu-item"><a class="menu-link" href="manage_scaleorder_clearance.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage_day&amp;lang=<?php echo $_SESSION['lang']; ?>"><span id="Step_Add">日價格報表</span></a></li>
                    <li class="menu-item"><a class="menu-link" href="manage_scaleorder_clearance.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage_month&amp;lang=<?php echo $_SESSION['lang']; ?>"><span id="Step_Add">月統計報表</span></a></li>
                </ul>
            </li>
            <li class="has-sub expand"><a class="menu-link" href=javascript:;" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="right"><b class="caret"></b><i class="fa fa-calendar-alt"></i><span>清運明細統計圖表</span></a>
                <ul class="sub-menu" style="display: block;">
                    <li class="menu-item"><a class="menu-link" href="manage_scaleorder_clearance.php?wshop=<?php echo $wshop;?>&amp;Opt=chart_month&amp;lang=<?php echo $_SESSION['lang']; ?>"><span id="Step_Add">月統計圖</span></a></li>
                </ul>
            </li>
            <li class="menu-item"><a class="menu-link" href="manage_scaleorder_clearance.php?wshop=<?php echo $wshop;?>&amp;Opt=maintain&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-band-aid"></i><span id="Step_Add">清運明細維護</span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_scaleorder_clearance.php?wshop=<?php echo $wshop;?>&amp;Opt=setpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-cog"></i><span id="Step_Add">參數設定</span></a></li>


		</ul> 

  
	<?php //require_once("require_leftmainmenu_product_list.php"); ?>
<?php //echo $_SESSION['lang']; ?>
