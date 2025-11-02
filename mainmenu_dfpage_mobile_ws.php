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

$collang_RecordDfPageMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDfPageMultiTopMenu_l1 = $_GET['lang'];
}
$colaid_RecordDfPageMultiTopMenu_l1 = "-1";
if (isset($row_RecordDfTypeMultiTopMenu_l1['id'])) {
  $colaid_RecordDfPageMultiTopMenu_l1 = $row_RecordDfTypeMultiTopMenu_l1['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageMultiTopMenu_l1 = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang = %s && level = '0' && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colaid_RecordDfPageMultiTopMenu_l1, "int"),GetSQLValueString($collang_RecordDfPageMultiTopMenu_l1, "text"));
$RecordDfPageMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordDfPageMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfPageMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfPageMultiTopMenu_l1);
$totalRows_RecordDfPageMultiTopMenu_l1 = mysqli_num_rows($RecordDfPageMultiTopMenu_l1);
?>
<?php if ($totalRows_RecordDfPageMultiTopMenu_l1 > 0) { // Show if recordset not empty ?>    	
	<ul class="wsmenu-submenu"><!--01-->
        <?php do { ?>
            <li class="<?php if(isset($row_RecordDfPageMultiTopMenu_l1['endnode'])) { echo $row_RecordDfPageMultiTopMenu_l1['endnode']; } ?>">
            <?php if ($row_RecordDfPageMultiTopMenu_l1['endnode'] != 'child') { // 目前無第三層 ?>
            <a href="#"><?php echo $row_RecordDfPageMultiTopMenu_l1['itemname']; ?></a><a href="#"><?php echo $row_RecordDfPageMultiTopMenu_l1['itemname']; ?></a>
            <?php } else { ?>
            <?php  /* 判斷模組是否為dfpage Start */ ?>
            <?php if ($row_RecordDfPageMultiTopMenu_l1['typemenu'] == 'DfPage' || $row_RecordDfPageMultiTopMenu_l1['typemenu'] == 'DfType') { ?>
            <a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfPageMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','aid'=>$row_RecordDfTypeMultiTopMenu_l1['id'],'type1'=>$row_RecordDfPageMultiTopMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordDfPageMultiTopMenu_l1['itemname']; ?></a>
            <?php } else { ?>
            <a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfPageMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $row_RecordDfPageMultiTopMenu_l1['itemname']; ?></a>
            <?php } ?>
            <?php  /* 判斷模組是否為dfpage End*/ ?>
            <?php }  ?>
            <?php if ($row_RecordDfPageMultiTopMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
            <ul><!--02-->
              <?php
					 $collang_RecordDfPageMultiTopMenu_l2 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDfPageMultiTopMenu_l2 = $_GET['lang'];
}
$colsubitem_id_RecordDfPageMultiTopMenu_l2 = "-1";
if (isset($row_RecordDfPageMultiTopMenu_l1['item_id'])) {
  $colsubitem_id_RecordDfPageMultiTopMenu_l2 = $row_RecordDfPageMultiTopMenu_l1['item_id'];
}
$colaid_RecordDfPageMultiTopMenu_l2 = "-1";
if (isset($row_RecordDfTypeMultiTopMenu_l1['id'])) {
  $colaid_RecordDfPageMultiTopMenu_l2 = $row_RecordDfTypeMultiTopMenu_l1['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageMultiTopMenu_l2 = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colaid_RecordDfPageMultiTopMenu_l2, "int"),GetSQLValueString($collang_RecordDfPageMultiTopMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordDfPageMultiTopMenu_l2, "int"));
$RecordDfPageMultiTopMenu_l2 = mysqli_query($DB_Conn, $query_RecordDfPageMultiTopMenu_l2) or die(mysqli_error($DB_Conn));
$row_RecordDfPageMultiTopMenu_l2 = mysqli_fetch_assoc($RecordDfPageMultiTopMenu_l2);
$totalRows_RecordDfPageMultiTopMenu_l2 = mysqli_num_rows($RecordDfPageMultiTopMenu_l2);
					?>
              <?php do { ?>
                <li class="<?php if(isset($row_RecordDfPageMultiTopMenu_l2['endnode'])) { echo $row_RecordDfPageMultiTopMenu_l2['endnode']; } ?>">
                  <?php if ($row_RecordDfPageMultiTopMenu_l2['endnode'] != 'child') { ?>
                  <a href="<?php echo strtolower($row_RecordDfPageMultiTopMenu_l2['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=mainsubpage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiTopMenu_l2['typemenu']; ?>&level=<?php echo $row_RecordDfPageMultiTopMenu_l2['level']; ?>&type1=<?php echo $row_RecordDfPageMultiTopMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordDfPageMultiTopMenu_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordDfPageMultiTopMenu_l2['subitem_id']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiTopMenu_l2['aid']; ?>"><strong><?php echo $row_RecordDfPageMultiTopMenu_l2['itemname']; ?></strong></a>
                  <?php } else { ?>
                  <?php  /* 判斷模組是否為dfpage Start */ ?>
				  <?php if ($row_RecordDfPageMultiTopMenu_l1['typemenu'] == 'dfpage' || $row_RecordDfPageMultiTopMenu_l1['typemenu'] == 'dftype') { ?>
                  <a href="<?php echo strtolower($row_RecordDfPageMultiTopMenu_l2['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=subpage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiTopMenu_l2['typemenu']; ?>&level=<?php echo $row_RecordDfPageMultiTopMenu_l2['level']; ?>&type1=<?php echo $row_RecordDfPageMultiTopMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordDfPageMultiTopMenu_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordDfPageMultiTopMenu_l2['subitem_id']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiTopMenu_l2['aid']; ?>"><?php echo $row_RecordDfPageMultiTopMenu_l2['itemname']; ?></a>
                  <?php } else { ?>
                  <a href="<?php echo strtolower($row_RecordDfPageMultiTopMenu_l2['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=subpage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiTopMenu_l2['typemenu']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiTopMenu_l2['aid']; ?>"><?php echo $row_RecordDfPageMultiTopMenu_l2['itemname']; ?></a>
                  <?php } ?>
                  <?php  /* 判斷模組是否為dfpage End*/ ?>
                  <?php } ?>
                 
                </li>
                <?php } while ($row_RecordDfPageMultiTopMenu_l2 = mysqli_fetch_assoc($RecordDfPageMultiTopMenu_l2)); ?>
              <?php mysqli_free_result($RecordDfPageMultiTopMenu_l2);?>
            </ul><!--02-->
<?php } // Show if recordset not empty ?>
          </li> 
          <?php } while ($row_RecordDfPageMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfPageMultiTopMenu_l1)); ?>
        </ul><!--01-->
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordDfPageMultiTopMenu_l1);
?>