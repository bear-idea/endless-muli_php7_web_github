<?php if ($totalRows_RecordKnownledgeMultiTopMenu_l1 > 0) { // Show if recordset not empty ?> 
<ul class="dropdown-menu <?php if (((int)$totalRows_RecordDfTypeMultiTopMenu_l1 - (int)$Count_TypeMultiTopMenu) < 2) { ?>pull-right<?php } ?>">   	
        <?php do { ?>
           
            <li class="<?php if(isset($row_RecordKnownledgeMultiTopMenu_l1['endnode'])) { echo $row_RecordKnownledgeMultiTopMenu_l1['endnode']; } ?>">
            <?php if ($row_RecordKnownledgeMultiTopMenu_l1['endnode'] != 'child') { ?>
            <a href="#" class="dropdown-toggle"><?php echo $row_RecordKnownledgeMultiTopMenu_l1['itemname']; ?></a>
            <?php } else { ?>
            <a href="<?php echo $SiteBaseUrl . url_rewrite('knowledge',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordKnownledgeMultiTopMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordKnownledgeMultiTopMenu_l1['itemname']; ?></a>
            <?php }  ?>
            <?php if ($row_RecordKnownledgeMultiTopMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
            <ul class="dropdown-menu"> 
              <?php
					 $collang_RecordKnownledgeMultiTopMenu_l2 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordKnownledgeMultiTopMenu_l2 = $_GET['lang'];
}
$coluserid_RecordKnownledgeMultiTopMenu_l2 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordKnownledgeMultiTopMenu_l2 = $_SESSION['userid'];
}
$colsubitem_id_RecordKnownledgeMultiTopMenu_l2 = "-1";
if (isset($row_RecordKnownledgeMultiTopMenu_l1['item_id'])) {
  $colsubitem_id_RecordKnownledgeMultiTopMenu_l2 = $row_RecordKnownledgeMultiTopMenu_l1['item_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnownledgeMultiTopMenu_l2 = sprintf("SELECT * FROM demo_knowledgeitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordKnownledgeMultiTopMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordKnownledgeMultiTopMenu_l2, "int"),GetSQLValueString($coluserid_RecordKnownledgeMultiTopMenu_l2, "int"));
$RecordKnownledgeMultiTopMenu_l2 = mysqli_query($DB_Conn, $query_RecordKnownledgeMultiTopMenu_l2) or die(mysqli_error($DB_Conn));
$row_RecordKnownledgeMultiTopMenu_l2 = mysqli_fetch_assoc($RecordKnownledgeMultiTopMenu_l2);
$totalRows_RecordKnownledgeMultiTopMenu_l2 = mysqli_num_rows($RecordKnownledgeMultiTopMenu_l2);
					?>
              <?php do { ?>
                <li class="<?php if(isset($row_RecordKnownledgeMultiTopMenu_l2['endnode'])) { echo $row_RecordKnownledgeMultiTopMenu_l2['endnode']; } ?>">
                  <?php if ($row_RecordKnownledgeMultiTopMenu_l2['endnode'] != 'child') { ?>
                  <a href="#" class="dropdown-toggle"><strong><?php echo $row_RecordKnownledgeMultiTopMenu_l2['itemname']; ?></strong></a>
                  <?php } else { ?>
                  <a href="<?php echo $SiteBaseUrl . url_rewrite('knowledge',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordKnownledgeMultiTopMenu_l1['item_id'],'type2'=>$row_RecordKnownledgeMultiTopMenu_l2['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordKnownledgeMultiTopMenu_l2['itemname']; ?></a>
                  <?php } ?>
                  <?php if ($row_RecordKnownledgeMultiTopMenu_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                  <ul class="dropdown-menu"> 
                    <?php
                         $collang_RecordKnownledgeMultiTopMenu_l3 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordKnownledgeMultiTopMenu_l3 = $_GET['lang'];
}
$coluserid_RecordKnownledgeMultiTopMenu_l3 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordKnownledgeMultiTopMenu_l3 = $_SESSION['userid'];
}
$colsubitem_id_RecordKnownledgeMultiTopMenu_l3 = "-1";
if (isset($row_RecordKnownledgeMultiTopMenu_l2['item_id'])) {
  $colsubitem_id_RecordKnownledgeMultiTopMenu_l3 = $row_RecordKnownledgeMultiTopMenu_l2['item_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnownledgeMultiTopMenu_l3 = sprintf("SELECT * FROM demo_knowledgeitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordKnownledgeMultiTopMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordKnownledgeMultiTopMenu_l3, "int"),GetSQLValueString($coluserid_RecordKnownledgeMultiTopMenu_l3, "int"));
$RecordKnownledgeMultiTopMenu_l3 = mysqli_query($DB_Conn, $query_RecordKnownledgeMultiTopMenu_l3) or die(mysqli_error($DB_Conn));
$row_RecordKnownledgeMultiTopMenu_l3 = mysqli_fetch_assoc($RecordKnownledgeMultiTopMenu_l3);
$totalRows_RecordKnownledgeMultiTopMenu_l3 = mysqli_num_rows($RecordKnownledgeMultiTopMenu_l3);
?>
                    <?php do { ?>
                      <li class="<?php if(isset($row_RecordKnownledgeMultiTopMenu_l3['endnode'])) { echo $row_RecordKnownledgeMultiTopMenu_l3['endnode']; } ?>">
                        <?php if ($row_RecordKnownledgeMultiTopMenu_l3['endnode'] != 'child') { ?>
                        <a href="#" class="dropdown-toggle"><?php echo $row_RecordKnownledgeMultiTopMenu_l3['itemname']; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo $SiteBaseUrl . url_rewrite('knowledge',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordKnownledgeMultiTopMenu_l1['item_id'],'type2'=>$row_RecordKnownledgeMultiTopMenu_l2['item_id'],'type3'=>$row_RecordKnownledgeMultiTopMenu_l3['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordKnownledgeMultiTopMenu_l3['itemname']; ?></a>
                        <?php } ?>
                      </li>
                      <?php } while ($row_RecordKnownledgeMultiTopMenu_l3 = mysqli_fetch_assoc($RecordKnownledgeMultiTopMenu_l3)); ?>
                    <?php mysqli_free_result($RecordKnownledgeMultiTopMenu_l3);?>
                  </ul>
                  <?php } // Show if recordset not empty ?>
                </li>
                <?php } while ($row_RecordKnownledgeMultiTopMenu_l2 = mysqli_fetch_assoc($RecordKnownledgeMultiTopMenu_l2)); ?>
              <?php mysqli_free_result($RecordKnownledgeMultiTopMenu_l2);?>
            </ul>
<?php } // Show if recordset not empty ?>
          </li>
          
          <?php } while ($row_RecordKnownledgeMultiTopMenu_l1 = mysqli_fetch_assoc($RecordKnownledgeMultiTopMenu_l1)); ?>
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordKnownledgeMultiTopMenu_l1);
?>