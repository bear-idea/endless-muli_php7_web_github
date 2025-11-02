<?php if ($totalRows_RecordMultiLeftMenu_l1 > 0) { // Show if recordset not empty ?>
<ul class="list-group list-group-noicon uppercase <?php if($row_RecordTmpConfig['tmpcolumnmenumode'] == "1") { echo "menu-vertical";} ?>">
        <?php do { ?>
          <li class="<?php echo $row_RecordMultiLeftMenu_l1['endnode']; ?> list-group-item <?php if($row_RecordTmpConfig['tmpcolumnmenumode'] == "1") { echo "dropdown";} ?>" >
          <?php if ($row_RecordMultiLeftMenu_l1['endnode'] != 'child') { ?>
          <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordMultiLeftMenu_l1['item_id']),'',$UrlWriteEnable);?>" class="dropdown-toggle"><?php echo $row_RecordMultiLeftMenu_l1['itemname']; ?></a>
          <?php } else { ?>
          <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordMultiLeftMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordMultiLeftMenu_l1['itemname']; ?></a>
          <?php }  ?>
          <?php if ($row_RecordMultiLeftMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
          <ul class="<?php if($row_RecordTmpConfig['tmpcolumnmenumode'] == "1") { echo "dropdown-menu";} ?>">
            <?php
					 $collang_RecordMultiLeftMenu_l2 = "zh-tw";
					if (isset($_GET['lang'])) {
					  $collang_RecordMultiLeftMenu_l2 = $_SESSION['lang'];
					}
					$colsubitem_id_RecordMultiLeftMenu_l2 = "-1";
					if (isset($row_RecordMultiLeftMenu_l1['item_id'])) {
					  $colsubitem_id_RecordMultiLeftMenu_l2 = $row_RecordMultiLeftMenu_l1['item_id'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordMultiLeftMenu_l2 = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l2, "int"));
					$RecordMultiLeftMenu_l2 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l2) or die(mysqli_error($DB_Conn));
					$row_RecordMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordMultiLeftMenu_l2);
					$totalRows_RecordMultiLeftMenu_l2 = mysqli_num_rows($RecordMultiLeftMenu_l2);
					?>
            <?php do { ?>
              <li class="<?php echo $row_RecordMultiLeftMenu_l2['endnode']; ?> list-group-item <?php if($row_RecordTmpConfig['tmpcolumnmenumode'] == "1") { echo "dropdown";} ?>">
                <?php if ($row_RecordMultiLeftMenu_l2['endnode'] != 'child') { ?>
                <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordMultiLeftMenu_l1['item_id'],'type2'=>$row_RecordMultiLeftMenu_l2['item_id']),'',$UrlWriteEnable);?>" class="dropdown-toggle"><strong><?php echo $row_RecordMultiLeftMenu_l2['itemname']; ?></strong></a>
                <?php } else { ?>
                <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordMultiLeftMenu_l1['item_id'],'type2'=>$row_RecordMultiLeftMenu_l2['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordMultiLeftMenu_l2['itemname']; ?></a>
                <?php } ?>
                <?php if ($row_RecordMultiLeftMenu_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                <ul class="<?php if($row_RecordTmpConfig['tmpcolumnmenumode'] == "1") { echo "dropdown-menu";} ?>">
                  <?php
                         $collang_RecordMultiLeftMenu_l3 = "zh-tw";
                        if (isset($_GET['lang'])) {
                          $collang_RecordMultiLeftMenu_l3 = $_SESSION['lang'];
                        }
                        $colsubitem_id_RecordMultiLeftMenu_l3 = "-1";
                        if (isset($row_RecordMultiLeftMenu_l2['item_id'])) {
                          $colsubitem_id_RecordMultiLeftMenu_l3 = $row_RecordMultiLeftMenu_l2['item_id'];
                        }
                        //mysqli_select_db($database_DB_Conn, $DB_Conn);
                        $query_RecordMultiLeftMenu_l3 = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l3, "int"));
                        $RecordMultiLeftMenu_l3 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l3) or die(mysqli_error($DB_Conn));
                        $row_RecordMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordMultiLeftMenu_l3);
                        $totalRows_RecordMultiLeftMenu_l3 = mysqli_num_rows($RecordMultiLeftMenu_l3);
                        ?>
                  <?php do { ?>
                    <li class="<?php echo $row_RecordMultiLeftMenu_l3['endnode']; ?> list-group-item <?php if($row_RecordTmpConfig['tmpcolumnmenumode'] == "1") { echo "dropdown";} ?>" >
                      <?php if ($row_RecordMultiLeftMenu_l3['endnode'] != 'child') { ?>
                      <a href="#" class="dropdown-toggle"><?php echo $row_RecordMultiLeftMenu_l3['itemname']; ?>></a>
                      <?php } else { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordMultiLeftMenu_l1['item_id'],'type2'=>$row_RecordMultiLeftMenu_l2['item_id'],'type3'=>$row_RecordMultiLeftMenu_l3['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordMultiLeftMenu_l3['itemname']; ?></a>
                      <?php } ?>
                    </li>
                    <?php } while ($row_RecordMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordMultiLeftMenu_l3)); ?>
                  <?php mysqli_free_result($RecordMultiLeftMenu_l3);?>
                </ul>
                <?php } // Show if recordset not empty ?>
              </li>
              <?php } while ($row_RecordMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordMultiLeftMenu_l2)); ?>
            <?php mysqli_free_result($RecordMultiLeftMenu_l2);?>
          </ul>
          <?php } // Show if recordset not empty ?>
          </li>
          <?php } while ($row_RecordMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordMultiLeftMenu_l1)); ?>
</ul>
<?php } // Show if recordset not empty ?>