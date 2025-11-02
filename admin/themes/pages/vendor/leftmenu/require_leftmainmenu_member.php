
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_member.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-eye"></i><span id="Step_View"><?php echo $ModuleName['Member']; ?></span></a></li> 
           <!-- <li class="menu-item"><a class="menu-link" href="manage_member.php?wshop=<?php echo $wshop;?>&amp;Opt=addpagepic&amp;lang=<?php //echo $_SESSION['lang']; ?>">新增(含頭像)</a></li>-->
             <li class="menu-item"><a class="menu-link" href="manage_member.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span id="Step_Add">新增資料</span></a></li>
            <!--<li class="menu-item"><a class="menu-link" href="manage_member.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right">次分類設定</a></li>-->
            
            <li class="menu-item"><a class="menu-link" href="manage_member.php?wshop=<?php echo $wshop;?>&amp;Opt=setpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-cog"></i><span id="Step_log">功能設定</span></a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { ?>
            <li class="menu-item"><a class="menu-link" href="manage_member.php?wshop=<?php echo $wshop;?>&amp;Opt=rightpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-unlock-alt"></i><span id="Step_log">權限設定</span></a></li>
            <?php } ?>
            <li class="menu-item"><a class="menu-link" href="manage_member.php?wshop=<?php echo $wshop;?>&amp;Opt=thirdparty&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-users"></i><span>第三方帳戶</span></a></li> 
            
</ul>
<?php //echo $_SESSION['lang']; ?>
