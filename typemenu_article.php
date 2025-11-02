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

if (isset($_GET['lang'])) {
  $totalRows_RecordArticleMultiTypeMenu_l1 = $_GET['lang'];
}
$coluserid_RecordArticleMultiTypeMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticleMultiTypeMenu_l1 = $_SESSION['userid'];
}
$collang_RecordArticleMultiTypeMenu_l1 = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordArticleMultiTypeMenu_l1 = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleMultiTypeMenu_l1 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordArticleMultiTypeMenu_l1, "text"),GetSQLValueString($coluserid_RecordArticleMultiTypeMenu_l1, "int"));
$RecordArticleMultiTypeMenu_l1 = mysqli_query($DB_Conn, $query_RecordArticleMultiTypeMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordArticleMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordArticleMultiTypeMenu_l1);
$totalRows_RecordArticleMultiTypeMenu_l1 = mysqli_num_rows($RecordArticleMultiTypeMenu_l1);
?>
<?php if ($totalRows_RecordArticleMultiTypeMenu_l1 > 0) { // Show if recordset not empty ?>    	
        <?php do { ?>
           
            <span class="<?php echo $row_RecordArticleMultiTypeMenu_l1['endnode']; ?> typemenu_btn">
            <?php if ($row_RecordArticleMultiTypeMenu_l1['endnode'] != 'child') { ?>
            <a href="#" class="dropdown-toggle"><?php echo $row_RecordArticleMultiTypeMenu_l1['itemname']; ?></a>
            <?php } else { ?>
            <a href="<?php echo $SiteBaseUrl . url_rewrite('article',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiTypeMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordArticleMultiTypeMenu_l1['itemname']; ?></a>
            <?php }  ?>
            <?php if ($row_RecordArticleMultiTypeMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
            <ul>
              <?php
					 $collang_RecordArticleMultiTypeMenu_l2 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordArticleMultiTypeMenu_l2 = $_GET['lang'];
}
$coluserid_RecordArticleMultiTypeMenu_l2 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticleMultiTypeMenu_l2 = $_SESSION['userid'];
}
$colsubitem_id_RecordArticleMultiTypeMenu_l2 = "-1";
if (isset($row_RecordArticleMultiTypeMenu_l1['item_id'])) {
  $colsubitem_id_RecordArticleMultiTypeMenu_l2 = $row_RecordArticleMultiTypeMenu_l1['item_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleMultiTypeMenu_l2 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordArticleMultiTypeMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordArticleMultiTypeMenu_l2, "int"),GetSQLValueString($coluserid_RecordArticleMultiTypeMenu_l2, "int"));
$RecordArticleMultiTypeMenu_l2 = mysqli_query($DB_Conn, $query_RecordArticleMultiTypeMenu_l2) or die(mysqli_error($DB_Conn));
$row_RecordArticleMultiTypeMenu_l2 = mysqli_fetch_assoc($RecordArticleMultiTypeMenu_l2);
$totalRows_RecordArticleMultiTypeMenu_l2 = mysqli_num_rows($RecordArticleMultiTypeMenu_l2);
					?>
              <?php do { ?>
                <span class="<?php echo $row_RecordArticleMultiTypeMenu_l2['endnode']; ?> typemenu_btn">
                  <?php if ($row_RecordArticleMultiTypeMenu_l2['endnode'] != 'child') { ?>
                  <a href="#" class="dropdown-toggle"><strong><?php echo $row_RecordArticleMultiTypeMenu_l2['itemname']; ?></strong></a>
                  <?php } else { ?>
                  <a href="<?php echo $SiteBaseUrl . url_rewrite('article',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiTypeMenu_l1['item_id'],'type2'=>$row_RecordArticleMultiTypeMenu_l2['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordArticleMultiTypeMenu_l2['itemname']; ?></a>
                  <?php } ?>
                  <?php if ($row_RecordArticleMultiTypeMenu_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                  <ul>
                    <?php
                         $collang_RecordArticleMultiTypeMenu_l3 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordArticleMultiTypeMenu_l3 = $_GET['lang'];
}
$coluserid_RecordArticleMultiTypeMenu_l3 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticleMultiTypeMenu_l3 = $_SESSION['userid'];
}
$colsubitem_id_RecordArticleMultiTypeMenu_l3 = "-1";
if (isset($row_RecordArticleMultiTypeMenu_l2['item_id'])) {
  $colsubitem_id_RecordArticleMultiTypeMenu_l3 = $row_RecordArticleMultiTypeMenu_l2['item_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleMultiTypeMenu_l3 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordArticleMultiTypeMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordArticleMultiTypeMenu_l3, "int"),GetSQLValueString($coluserid_RecordArticleMultiTypeMenu_l3, "int"));
$RecordArticleMultiTypeMenu_l3 = mysqli_query($DB_Conn, $query_RecordArticleMultiTypeMenu_l3) or die(mysqli_error($DB_Conn));
$row_RecordArticleMultiTypeMenu_l3 = mysqli_fetch_assoc($RecordArticleMultiTypeMenu_l3);
$totalRows_RecordArticleMultiTypeMenu_l3 = mysqli_num_rows($RecordArticleMultiTypeMenu_l3);
?>
                    <?php do { ?>
                      <span class="<?php echo $row_RecordArticleMultiTypeMenu_l3['endnode']; ?> typemenu_btn">
                        <?php if ($row_RecordArticleMultiTypeMenu_l3['endnode'] != 'child') { ?>
                        <a href="#" class="dropdown-toggle"><?php echo $row_RecordArticleMultiTypeMenu_l3['itemname']; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo $SiteBaseUrl . url_rewrite('article',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiTypeMenu_l1['item_id'],'type2'=>$row_RecordArticleMultiTypeMenu_l2['item_id'],'type3'=>$row_RecordArticleMultiTypeMenu_l3['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordArticleMultiTypeMenu_l3['itemname']; ?></a>
                        <?php } ?>
                      </span>
                      <?php } while ($row_RecordArticleMultiTypeMenu_l3 = mysqli_fetch_assoc($RecordArticleMultiTypeMenu_l3)); ?>
                    <?php mysqli_free_result($RecordArticleMultiTypeMenu_l3);?>
                  </ul>
                  <?php } // Show if recordset not empty ?>
                </span>
                <?php } while ($row_RecordArticleMultiTypeMenu_l2 = mysqli_fetch_assoc($RecordArticleMultiTypeMenu_l2)); ?>
              <?php mysqli_free_result($RecordArticleMultiTypeMenu_l2);?>
            </ul>
<?php } // Show if recordset not empty ?>
          </span>
          
          <?php } while ($row_RecordArticleMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordArticleMultiTypeMenu_l1)); ?>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordArticleMultiTypeMenu_l1);
?>