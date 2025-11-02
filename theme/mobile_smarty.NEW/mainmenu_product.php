<?php if ($totalRows_RecordProductMultiTopMenu_l1 > 0) { ?>
<ul class="dropdown-menu <?php if (((int)$totalRows_RecordDfTypeMultiTopMenu_l1 - (int)$Count_TypeMultiTopMenu) < 2) { ?>pull-right<?php } ?>">
<!--<li> <?php //echo "mega-menu"; ?>
  <div class="row">--> <?php //echo "mega-menu"; ?>
        <?php do { ?>
        <!--<div class="col-md-6"> <?php //echo "mega-menu"; ?>
          <ul class="list-unstyled">--> <?php //echo "mega-menu"; ?>
            <li class="<?php if(isset($row_RecordProductMultiTopMenu_l1['endnode'])) { echo $row_RecordProductMultiTopMenu_l1['endnode']; } ?>">
            <?php if ($row_RecordProductMultiTopMenu_l1['endnode'] != 'child') { ?>
            	<a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordProductMultiTopMenu_l1['item_id']),'',$UrlWriteEnable);?>" class="dropdown-toggle"><?php echo $row_RecordProductMultiTopMenu_l1['itemname']; ?></a>
			<?php } else { ?>
                 <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordProductMultiTopMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordProductMultiTopMenu_l1['itemname']; ?></a>
            <?php }  ?>
            	<?php if ($row_RecordProductMultiTopMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
                <ul class="dropdown-menu"> <?php //echo "mega-menu"; 隱藏 ?>

                	<?php
					 $collang_RecordProductMultiTopMenu_l2 = "zh-tw";
					if (isset($_GET['lang'])) {
					  $collang_RecordProductMultiTopMenu_l2 = $_GET['lang'];
					}
					$colsubitem_id_RecordProductMultiTopMenu_l2 = "-1";
					if (isset($row_RecordProductMultiTopMenu_l1['item_id'])) {
					  $colsubitem_id_RecordProductMultiTopMenu_l2 = $row_RecordProductMultiTopMenu_l1['item_id'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordProductMultiTopMenu_l2 = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordProductMultiTopMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordProductMultiTopMenu_l2, "int"));
					$RecordProductMultiTopMenu_l2 = mysqli_query($DB_Conn, $query_RecordProductMultiTopMenu_l2) or die(mysqli_error($DB_Conn));
					$row_RecordProductMultiTopMenu_l2 = mysqli_fetch_assoc($RecordProductMultiTopMenu_l2);
					$totalRows_RecordProductMultiTopMenu_l2 = mysqli_num_rows($RecordProductMultiTopMenu_l2);
					?>
					<?php do { ?>
                    <li class="<?php if(isset($row_RecordProductMultiTopMenu_l2['endnode'])) { echo $row_RecordProductMultiTopMenu_l2['endnode']; } ?>">
                    <?php if ($row_RecordProductMultiTopMenu_l2['endnode'] != 'child') { ?>
                    	<a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordProductMultiTopMenu_l1['item_id'],'type2'=>$row_RecordProductMultiTopMenu_l2['item_id']),'',$UrlWriteEnable);?>" class="dropdown-toggle"><strong><?php echo $row_RecordProductMultiTopMenu_l2['itemname']; ?></strong></a>
                    <?php } else { ?>
                    <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordProductMultiTopMenu_l1['item_id'],'type2'=>$row_RecordProductMultiTopMenu_l2['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordProductMultiTopMenu_l2['itemname']; ?></a>
                    <?php } ?>
                    <?php if ($row_RecordProductMultiTopMenu_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                      <ul class="dropdown-menu"> <?php //echo "mega-menu"; 隱藏 ?>
                        <?php
                         $collang_RecordProductMultiTopMenu_l3 = "zh-tw";
                        if (isset($_GET['lang'])) {
                          $collang_RecordProductMultiTopMenu_l3 = $_GET['lang'];
                        }
                        $colsubitem_id_RecordProductMultiTopMenu_l3 = "-1";
                        if (isset($row_RecordProductMultiTopMenu_l2['item_id'])) {
                          $colsubitem_id_RecordProductMultiTopMenu_l3 = $row_RecordProductMultiTopMenu_l2['item_id'];
                        }
                        //mysqli_select_db($database_DB_Conn, $DB_Conn);
                        $query_RecordProductMultiTopMenu_l3 = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordProductMultiTopMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordProductMultiTopMenu_l3, "int"));
                        $RecordProductMultiTopMenu_l3 = mysqli_query($DB_Conn, $query_RecordProductMultiTopMenu_l3) or die(mysqli_error($DB_Conn));
                        $row_RecordProductMultiTopMenu_l3 = mysqli_fetch_assoc($RecordProductMultiTopMenu_l3);
                        $totalRows_RecordProductMultiTopMenu_l3 = mysqli_num_rows($RecordProductMultiTopMenu_l3);
?>
						<?php do { ?>
                          <li class="<?php if(isset($row_RecordProductMultiTopMenu_l3['endnode'])) { echo $row_RecordProductMultiTopMenu_l3['endnode']; } ?>">
                          <?php if ($row_RecordProductMultiTopMenu_l3['endnode'] != 'child') { ?>
                    		<a href="#" class="dropdown-toggle"><?php echo $row_RecordProductMultiTopMenu_l3['itemname']; ?>></a>
                    	  <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordProductMultiTopMenu_l1['item_id'],'type2'=>$row_RecordProductMultiTopMenu_l2['item_id'],'type3'=>$row_RecordProductMultiTopMenu_l3['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordProductMultiTopMenu_l3['itemname']; ?></a>
                            <?php } ?>
                          </li>
                          <?php } while ($row_RecordProductMultiTopMenu_l3 = mysqli_fetch_assoc($RecordProductMultiTopMenu_l3)); ?>
                        <?php mysqli_free_result($RecordProductMultiTopMenu_l3);?>
                      </ul> <?php //echo "mega-menu"; ?> <?php //echo "mega-menu"; 隱藏 ?>
                      <?php } // Show if recordset not empty ?>
                    </li>
                    <?php } while ($row_RecordProductMultiTopMenu_l2 = mysqli_fetch_assoc($RecordProductMultiTopMenu_l2)); ?>
                    <?php mysqli_free_result($RecordProductMultiTopMenu_l2);?>
                </ul> <?php //echo "mega-menu"; ?> <?php //echo "mega-menu"; 隱藏 ?>
                <?php } // Show if recordset not empty ?>
            </li>
           <!-- </ul> <?php //echo "mega-menu"; ?>
            </div>--> <?php //echo "mega-menu"; ?>
        <?php } while ($row_RecordProductMultiTopMenu_l1 = mysqli_fetch_assoc($RecordProductMultiTopMenu_l1)); ?>
<!--</div> <?php //echo "mega-menu"; ?>
</li> --> <?php //echo "mega-menu"; ?>
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordProductMultiTopMenu_l1);
?>