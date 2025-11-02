<?php require_once('Connections/DB_Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$collang_RecordArticleMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordArticleMultiLeftMenu_l1 = $_GET['lang'];
}
$coluserid_RecordArticleMultiLeftMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticleMultiLeftMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordArticleMultiLeftMenu_l1, "text"),GetSQLValueString($coluserid_RecordArticleMultiLeftMenu_l1, "int"));
$RecordArticleMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordArticleMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordArticleMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordArticleMultiLeftMenu_l1);
$totalRows_RecordArticleMultiLeftMenu_l1 = mysqli_num_rows($RecordArticleMultiLeftMenu_l1);
?>
<?php if ($totalRows_RecordArticleMultiLeftMenu_l1 > 0) { // Show if recordset not empty ?>
<ul class="list-group">
<?php $pan_ct=0; ?>
        <?php do { ?>
          <?php if ($row_RecordArticleMultiLeftMenu_l1['endnode'] != 'child') { ?>
          <li class="list-group-item list-toggle" >
          <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-article-<?php echo $pan_ct; ?>" class="collapsed"><i class="ico-dd icon-angle-down"></i><?php echo $row_RecordArticleMultiLeftMenu_l1['itemname']; ?></a>
          <?php } else { ?>
          <li class="list-group-item">
          <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiLeftMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordArticleMultiLeftMenu_l1['itemname']; ?></a>
          <?php }  ?>
          <?php if ($row_RecordArticleMultiLeftMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
          <ul id="collapse-article-<?php echo $pan_ct; ?>" class="list-unstyled collapse" style="margin-left:10px;">
            <?php
					 $collang_RecordArticleMultiLeftMenu_l2 = "zh-tw";
					if (isset($_GET['lang'])) {
					  $collang_RecordArticleMultiLeftMenu_l2 = $_SESSION['lang'];
					}
					$colsubitem_id_RecordArticleMultiLeftMenu_l2 = "-1";
					if (isset($row_RecordArticleMultiLeftMenu_l1['item_id'])) {
					  $colsubitem_id_RecordArticleMultiLeftMenu_l2 = $row_RecordArticleMultiLeftMenu_l1['item_id'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordArticleMultiLeftMenu_l2 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordArticleMultiLeftMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordArticleMultiLeftMenu_l2, "int"));
					$RecordArticleMultiLeftMenu_l2 = mysqli_query($DB_Conn, $query_RecordArticleMultiLeftMenu_l2) or die(mysqli_error($DB_Conn));
					$row_RecordArticleMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordArticleMultiLeftMenu_l2);
					$totalRows_RecordArticleMultiLeftMenu_l2 = mysqli_num_rows($RecordArticleMultiLeftMenu_l2);
					?>
            <?php do { ?>
                <?php if ($row_RecordArticleMultiLeftMenu_l2['endnode'] != 'child') { ?>
                <li class="list-group-item list-toggle">
                <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiLeftMenu_l1['item_id'],'type2'=>$row_RecordArticleMultiLeftMenu_l2['item_id']),'',$UrlWriteEnable);?>" class="dropdown-toggle"><strong><i class="fa fa-angle-right"></i> <?php echo $row_RecordArticleMultiLeftMenu_l2['itemname']; ?></strong></a>
                <?php } else { ?>
                <li class="list-group-item">
                <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiLeftMenu_l1['item_id'],'type2'=>$row_RecordArticleMultiLeftMenu_l2['item_id']),'',$UrlWriteEnable);?>"><i class="fa fa-angle-right"></i> <?php echo $row_RecordArticleMultiLeftMenu_l2['itemname']; ?></a>
                <?php } ?>
                <?php if ($row_RecordArticleMultiLeftMenu_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                <ul class="list-unstyled" style="margin-left:10px;">
                  <?php
                         $collang_RecordArticleMultiLeftMenu_l3 = "zh-tw";
                        if (isset($_GET['lang'])) {
                          $collang_RecordArticleMultiLeftMenu_l3 = $_SESSION['lang'];
                        }
                        $colsubitem_id_RecordArticleMultiLeftMenu_l3 = "-1";
                        if (isset($row_RecordArticleMultiLeftMenu_l2['item_id'])) {
                          $colsubitem_id_RecordArticleMultiLeftMenu_l3 = $row_RecordArticleMultiLeftMenu_l2['item_id'];
                        }
                        //mysqli_select_db($database_DB_Conn, $DB_Conn);
                        $query_RecordArticleMultiLeftMenu_l3 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordArticleMultiLeftMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordArticleMultiLeftMenu_l3, "int"));
                        $RecordArticleMultiLeftMenu_l3 = mysqli_query($DB_Conn, $query_RecordArticleMultiLeftMenu_l3) or die(mysqli_error($DB_Conn));
                        $row_RecordArticleMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordArticleMultiLeftMenu_l3);
                        $totalRows_RecordArticleMultiLeftMenu_l3 = mysqli_num_rows($RecordArticleMultiLeftMenu_l3);
                        ?>
                  <?php do { ?>
                    <li class="<?php echo $row_RecordArticleMultiLeftMenu_l3['endnode']; ?> list-group-item" >
                      <?php if ($row_RecordArticleMultiLeftMenu_l3['endnode'] != 'child') { ?>
                      <a href="#" class="dropdown-toggle"><i class="fa fa-angle-right"></i> <?php echo $row_RecordArticleMultiLeftMenu_l3['itemname']; ?>></a>
                      <?php } else { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiLeftMenu_l1['item_id'],'type2'=>$row_RecordArticleMultiLeftMenu_l2['item_id'],'type3'=>$row_RecordArticleMultiLeftMenu_l3['item_id']),'',$UrlWriteEnable);?>"><i class="fa fa-angle-right"></i> <?php echo $row_RecordArticleMultiLeftMenu_l3['itemname']; ?></a>
                      <?php } ?>
                    </li>
                    <?php } while ($row_RecordArticleMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordArticleMultiLeftMenu_l3)); ?>
                  <?php mysqli_free_result($RecordArticleMultiLeftMenu_l3);?>
                </ul>
                <?php } // Show if recordset not empty ?>
              </li>
              <?php } while ($row_RecordArticleMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordArticleMultiLeftMenu_l2)); ?>
            <?php mysqli_free_result($RecordArticleMultiLeftMenu_l2);?>
          </ul>
          <?php } // Show if recordset not empty ?>
          </li>
          <?php $pan_ct++; ?>
          <?php } while ($row_RecordArticleMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordArticleMultiLeftMenu_l1)); ?>
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordArticleMultiLeftMenu_l1);
?>
