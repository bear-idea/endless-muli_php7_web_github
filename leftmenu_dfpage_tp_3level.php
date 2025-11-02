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

$collang_RecordDfPageMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDfPageMultiLeftMenu_l1 = $_GET['lang'];
}
$colaid_RecordDfPageMultiLeftMenu_l1 = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordDfPageMultiLeftMenu_l1 = $_GET['aid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang = %s && level = '0' && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colaid_RecordDfPageMultiLeftMenu_l1, "int"),GetSQLValueString($collang_RecordDfPageMultiLeftMenu_l1, "text"));
$RecordDfPageMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordDfPageMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfPageMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordDfPageMultiLeftMenu_l1);
$totalRows_RecordDfPageMultiLeftMenu_l1 = mysqli_num_rows($RecordDfPageMultiLeftMenu_l1);
?>
<?php if ($totalRows_RecordDfPageMultiLeftMenu_l1 > 0) { // Show if recordset not empty ?>    	
<!--	<ul>-->
        <?php do { ?>
            
            <li class="<?php echo $row_RecordDfPageMultiLeftMenu_l1['endnode']; ?>">
            <?php if ($row_RecordDfPageMultiLeftMenu_l1['endnode'] != 'child') { ?>
            <a href="<?php echo strtolower($row_RecordDfPageMultiLeftMenu_l1['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiLeftMenu_l1['typemenu']; ?>&level=<?php echo $row_RecordDfPageMultiLeftMenu_l1['level']; ?>&type1=<?php echo $row_RecordDfPageMultiLeftMenu_l1['item_id']; ?>&subitem_id=<?php echo $row_RecordDfPageMultiLeftMenu_l1['subitem_id']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiLeftMenu_l1['aid']; ?>"><?php echo $row_RecordDfPageMultiLeftMenu_l1['itemname']; ?></a>
            <?php } else { ?>
            <a href="<?php echo strtolower($row_RecordDfPageMultiLeftMenu_l1['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiLeftMenu_l1['typemenu']; ?>&level=<?php echo $row_RecordDfPageMultiLeftMenu_l1['level']; ?>&type1=<?php echo $row_RecordDfPageMultiLeftMenu_l1['item_id']; ?>&subitem_id=<?php echo $row_RecordDfPageMultiLeftMenu_l1['subitem_id']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiLeftMenu_l1['aid']; ?>"><?php echo $row_RecordDfPageMultiLeftMenu_l1['itemname']; ?></a>
            <?php }  ?>
            <?php if ($row_RecordDfPageMultiLeftMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
            <ul>
              <?php
					 $collang_RecordDfPageMultiLeftMenu_l2 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDfPageMultiLeftMenu_l2 = $_GET['lang'];
}
$colsubitem_id_RecordDfPageMultiLeftMenu_l2 = "-1";
if (isset($row_RecordDfPageMultiLeftMenu_l1['item_id'])) {
  $colsubitem_id_RecordDfPageMultiLeftMenu_l2 = $row_RecordDfPageMultiLeftMenu_l1['item_id'];
}
$colaid_RecordDfPageMultiLeftMenu_l2 = "-1";
if (isset($colaid_RecordDfPageMultiLeftMenu_l1)) {
  $colaid_RecordDfPageMultiLeftMenu_l2 = $colaid_RecordDfPageMultiLeftMenu_l1;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageMultiLeftMenu_l2 = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colaid_RecordDfPageMultiLeftMenu_l2, "int"),GetSQLValueString($collang_RecordDfPageMultiLeftMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordDfPageMultiLeftMenu_l2, "int"));
$RecordDfPageMultiLeftMenu_l2 = mysqli_query($DB_Conn, $query_RecordDfPageMultiLeftMenu_l2) or die(mysqli_error($DB_Conn));
$row_RecordDfPageMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordDfPageMultiLeftMenu_l2);
$totalRows_RecordDfPageMultiLeftMenu_l2 = mysqli_num_rows($RecordDfPageMultiLeftMenu_l2);
?>
              <?php do { ?>
                <li class="<?php echo $row_RecordDfPageMultiLeftMenu_l2['endnode']; ?>">
                  <?php if ($row_RecordDfPageMultiLeftMenu_l2['endnode'] != 'child') { ?>
                  <a href="<?php echo strtolower($row_RecordDfPageMultiLeftMenu_l2['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiLeftMenu_l2['typemenu']; ?>&level=<?php echo $row_RecordDfPageMultiLeftMenu_l2['level']; ?>&type1=<?php echo $row_RecordDfPageMultiLeftMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordDfPageMultiLeftMenu_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordDfPageMultiLeftMenu_l2['subitem_id']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiLeftMenu_l2['aid']; ?>"><strong><?php echo $row_RecordDfPageMultiLeftMenu_l2['itemname']; ?></strong></a>
                  <?php } else { ?>
                  <a href="<?php echo strtolower($row_RecordDfPageMultiLeftMenu_l2['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiLeftMenu_l2['typemenu']; ?>&level=<?php echo $row_RecordDfPageMultiLeftMenu_l2['level']; ?>&type1=<?php echo $row_RecordDfPageMultiLeftMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordDfPageMultiLeftMenu_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordDfPageMultiLeftMenu_l2['subitem_id']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiLeftMenu_l2['aid']; ?>"><?php echo $row_RecordDfPageMultiLeftMenu_l2['itemname']; ?></a>
                  <?php } ?>
                  
                              <?php if ($row_RecordDfPageMultiLeftMenu_l2['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
            <ul>
              <?php
					 $collang_RecordDfPageMultiLeftMenu_l3 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDfPageMultiLeftMenu_l3 = $_GET['lang'];
}
$colsubitem_id_RecordDfPageMultiLeftMenu_l3 = "-1";
if (isset($row_RecordDfPageMultiLeftMenu_l2['item_id'])) {
  $colsubitem_id_RecordDfPageMultiLeftMenu_l3 = $row_RecordDfPageMultiLeftMenu_l2['item_id'];
}
$colaid_RecordDfPageMultiLeftMenu_l3 = "-1";
if (isset($colaid_RecordDfPageMultiLeftMenu_l1)) {
  $colaid_RecordDfPageMultiLeftMenu_l3 = $colaid_RecordDfPageMultiLeftMenu_l1;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageMultiLeftMenu_l3 = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colaid_RecordDfPageMultiLeftMenu_l3, "int"),GetSQLValueString($collang_RecordDfPageMultiLeftMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordDfPageMultiLeftMenu_l3, "int"));
$RecordDfPageMultiLeftMenu_l3 = mysqli_query($DB_Conn, $query_RecordDfPageMultiLeftMenu_l3) or die(mysqli_error($DB_Conn));
$row_RecordDfPageMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordDfPageMultiLeftMenu_l3);
$totalRows_RecordDfPageMultiLeftMenu_l3 = mysqli_num_rows($RecordDfPageMultiLeftMenu_l3);
?>
              <?php do { ?>
                <li class="<?php echo $row_RecordDfPageMultiLeftMenu_l3['endnode']; ?>">
                  <?php if ($row_RecordDfPageMultiLeftMenu_l3['endnode'] != 'child') { ?>
                  <a href="<?php echo strtolower($row_RecordDfPageMultiLeftMenu_l3['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiLeftMenu_l3['typemenu']; ?>&level=<?php echo $row_RecordDfPageMultiLeftMenu_l3['level']; ?>&type1=<?php echo $row_RecordDfPageMultiLeftMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordDfPageMultiLeftMenu_l3['item_id']; ?>&subitem_id=<?php echo $row_RecordDfPageMultiLeftMenu_l3['subitem_id']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiLeftMenu_l3['aid']; ?>"><strong><?php echo $row_RecordDfPageMultiLeftMenu_l3['itemname']; ?></strong></a>
                  <?php } else { ?>
                  <a href="<?php echo strtolower($row_RecordDfPageMultiLeftMenu_l3['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=<?php echo $row_RecordDfPageMultiLeftMenu_l3['typemenu']; ?>&level=<?php echo $row_RecordDfPageMultiLeftMenu_l3['level']; ?>&type1=<?php echo $row_RecordDfPageMultiLeftMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordDfPageMultiLeftMenu_l3['item_id']; ?>&subitem_id=<?php echo $row_RecordDfPageMultiLeftMenu_l3['subitem_id']; ?>&amp;aid=<?php echo $row_RecordDfPageMultiLeftMenu_l3['aid']; ?>"><?php echo $row_RecordDfPageMultiLeftMenu_l3['itemname']; ?></a>
                  <?php } ?>
         
                </li>
                <?php } while ($row_RecordDfPageMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordDfPageMultiLeftMenu_l3)); ?>
              <?php mysqli_free_result($RecordDfPageMultiLeftMenu_l3); ?>
            </ul>
<?php } // Show if recordset not empty ?>
         
                </li>
                <?php } while ($row_RecordDfPageMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordDfPageMultiLeftMenu_l2)); ?>
              <?php mysqli_free_result($RecordDfPageMultiLeftMenu_l2); ?>
            </ul>
<?php } // Show if recordset not empty ?>
          </li>
          
          <?php } while ($row_RecordDfPageMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordDfPageMultiLeftMenu_l1)); ?>
<!--        </ul>-->
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordDfPageMultiLeftMenu_l1);
?>