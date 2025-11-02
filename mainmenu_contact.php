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

$collang_RecordContactMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordContactMultiTopMenu_l1 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactMultiTopMenu_l1 = sprintf("SELECT * FROM demo_contactitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordContactMultiTopMenu_l1, "text"));
$RecordContactMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordContactMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordContactMultiTopMenu_l1 = mysqli_fetch_assoc($RecordContactMultiTopMenu_l1);
$totalRows_RecordContactMultiTopMenu_l1 = mysqli_num_rows($RecordContactMultiTopMenu_l1);
?>
<?php if ($totalRows_RecordContactMultiTopMenu_l1 > 0) { // Show if recordset not empty ?>
    	<ul>
        <?php do { ?>
            
            <li class="<?php if(isset($row_RecordContactMultiTopMenu_l1['endnode'])) { echo $row_RecordContactMultiTopMenu_l1['endnode']; } ?>">
            <?php if ($row_RecordContactMultiTopMenu_l1['endnode'] != 'child') { ?>
            <a href="contact.php?Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Contact&level=<?php echo $row_RecordContactMultiTopMenu_l1['level']; ?>&type1=<?php echo $row_RecordContactMultiTopMenu_l1['item_id']; ?>&subitem_id=<?php echo $row_RecordContactMultiTopMenu_l1['subitem_id']; ?>"><?php echo $row_RecordContactMultiTopMenu_l1['itemname']; ?></a>
            <?php } else { ?>
            <a href="contact.php?Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Contact&level=<?php echo $row_RecordContactMultiTopMenu_l1['level']; ?>&type1=<?php echo $row_RecordContactMultiTopMenu_l1['item_id']; ?>&subitem_id=<?php echo $row_RecordContactMultiTopMenu_l1['subitem_id']; ?>"><?php echo $row_RecordContactMultiTopMenu_l1['itemname']; ?></a>
            <?php }  ?>
            <?php if ($row_RecordContactMultiTopMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
            <ul>
              <?php
					 $collang_RecordContactMultiTopMenu_l2 = "zh-tw";
					if (isset($_GET['lang'])) {
					  $collang_RecordContactMultiTopMenu_l2 = $_GET['lang'];
					}
					$colsubitem_id_RecordContactMultiTopMenu_l2 = "-1";
					if (isset($row_RecordContactMultiTopMenu_l1['item_id'])) {
					  $colsubitem_id_RecordContactMultiTopMenu_l2 = $row_RecordContactMultiTopMenu_l1['item_id'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordContactMultiTopMenu_l2 = sprintf("SELECT * FROM demo_contactitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordContactMultiTopMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordContactMultiTopMenu_l2, "int"));
					$RecordContactMultiTopMenu_l2 = mysqli_query($DB_Conn, $query_RecordContactMultiTopMenu_l2) or die(mysqli_error($DB_Conn));
					$row_RecordContactMultiTopMenu_l2 = mysqli_fetch_assoc($RecordContactMultiTopMenu_l2);
					$totalRows_RecordContactMultiTopMenu_l2 = mysqli_num_rows($RecordContactMultiTopMenu_l2);
					?>
              <?php do { ?>
                <li class="<?php if(isset($row_RecordContactMultiTopMenu_l2['endnode'])) { echo $row_RecordContactMultiTopMenu_l2['endnode']; } ?>">
                  <?php if ($row_RecordContactMultiTopMenu_l2['endnode'] != 'child') { ?>
                  <a href="contact.php?Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Contact&level=<?php echo $row_RecordContactMultiTopMenu_l2['level']; ?>&type1=<?php echo $row_RecordContactMultiTopMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordContactMultiTopMenu_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordContactMultiTopMenu_l2['subitem_id']; ?>"><strong><?php echo $row_RecordContactMultiTopMenu_l2['itemname']; ?></strong></a>
                  <?php } else { ?>
                  <a href="contact.php?Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Contact&level=<?php echo $row_RecordContactMultiTopMenu_l2['level']; ?>&type1=<?php echo $row_RecordContactMultiTopMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordContactMultiTopMenu_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordContactMultiTopMenu_l2['subitem_id']; ?>"><?php echo $row_RecordContactMultiTopMenu_l2['itemname']; ?></a>
                  <?php } ?>
                  <?php if ($row_RecordContactMultiTopMenu_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                  <ul>
                    <?php
                         $collang_RecordContactMultiTopMenu_l3 = "zh-tw";
                        if (isset($_GET['lang'])) {
                          $collang_RecordContactMultiTopMenu_l3 = $_GET['lang'];
                        }
                        $colsubitem_id_RecordContactMultiTopMenu_l3 = "-1";
                        if (isset($row_RecordContactMultiTopMenu_l2['item_id'])) {
                          $colsubitem_id_RecordContactMultiTopMenu_l3 = $row_RecordContactMultiTopMenu_l2['item_id'];
                        }
                        //mysqli_select_db($database_DB_Conn, $DB_Conn);
                        $query_RecordContactMultiTopMenu_l3 = sprintf("SELECT * FROM demo_contactitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordContactMultiTopMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordContactMultiTopMenu_l3, "int"));
                        $RecordContactMultiTopMenu_l3 = mysqli_query($DB_Conn, $query_RecordContactMultiTopMenu_l3) or die(mysqli_error($DB_Conn));
                        $row_RecordContactMultiTopMenu_l3 = mysqli_fetch_assoc($RecordContactMultiTopMenu_l3);
                        $totalRows_RecordContactMultiTopMenu_l3 = mysqli_num_rows($RecordContactMultiTopMenu_l3);
?>
                    <?php do { ?>
                      <li class="<?php if(isset($row_RecordContactMultiTopMenu_l3['endnode'])) { echo $row_RecordContactMultiTopMenu_l3['endnode']; } ?>">
                        <?php if ($row_RecordContactMultiTopMenu_l3['endnode'] != 'child') { ?>
                        <a href="#"><?php echo $row_RecordContactMultiTopMenu_l3['itemname']; ?>></a>
                        <?php } else { ?>
                        <a href="contact.php?Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Contact&level=<?php echo $row_RecordContactMultiTopMenu_l3['level']; ?>&type1=<?php echo $row_RecordContactMultiTopMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordContactMultiTopMenu_l2['item_id']; ?>&type3=<?php echo $row_RecordContactMultiTopMenu_l3['item_id']; ?>&subitem_id=<?php echo $row_RecordContactMultiTopMenu_l3['subitem_id']; ?>"><?php echo $row_RecordContactMultiTopMenu_l3['itemname']; ?></a>
                        <?php } ?>
                      </li>
                      <?php } while ($row_RecordContactMultiTopMenu_l3 = mysqli_fetch_assoc($RecordContactMultiTopMenu_l3)); ?>
                    <?php mysqli_free_result($RecordContactMultiTopMenu_l3);?>
                  </ul>
                  <?php } // Show if recordset not empty ?>
                </li>
                <?php } while ($row_RecordContactMultiTopMenu_l2 = mysqli_fetch_assoc($RecordContactMultiTopMenu_l2)); ?>
              <?php mysqli_free_result($RecordContactMultiTopMenu_l2);?>
            </ul>
<?php } // Show if recordset not empty ?>
          </li>
         
          <?php } while ($row_RecordContactMultiTopMenu_l1 = mysqli_fetch_assoc($RecordContactMultiTopMenu_l1)); ?>
        </ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordContactMultiTopMenu_l1);
?>