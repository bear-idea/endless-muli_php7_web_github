<?php require_once('../Connections/DB_Conn.php'); ?>
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

$collang_RecordMultiLeftMenu_l1 = "zh_TW";
if (isset($_GET['lang'])) {
  $collang_RecordMultiLeftMenu_l1 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l1, "text"));
$RecordMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordMultiLeftMenu_l1);
$totalRows_RecordMultiLeftMenu_l1 = mysqli_num_rows($RecordMultiLeftMenu_l1);
?>




<ul class="accordion"  id="accordion-3">
        <?php do { ?>
            <li class="<?php echo $row_RecordMultiLeftMenu_l1['endnode']; ?>">
            <a class="menu-link" href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt_Forum=viewpage_sub&lang=<?php echo $_GET['lang']; ?>&level=<?php echo $row_RecordMultiLeftMenu_l1['level']; ?>&type1=<?php echo $row_RecordMultiLeftMenu_l1['item_id']; ?>&item_id=<?php echo $row_RecordMultiLeftMenu_l1['item_id']; ?>"><?php echo $row_RecordMultiLeftMenu_l1['itemname']; ?>
            </a>
				    <?php
					 #
					$collang_RecordMultiLeftMenu_l2 = "zh_TW";
					if (isset($_GET['lang'])) {
					  $collang_RecordMultiLeftMenu_l2 = $_GET['lang'];
					}
					$colsubitem_id_RecordMultiLeftMenu_l2 = "-1";
					if (isset($row_RecordMultiLeftMenu_l1['item_id'])) {
					  $colsubitem_id_RecordMultiLeftMenu_l2 = $row_RecordMultiLeftMenu_l1['item_id'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordMultiLeftMenu_l2 = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l2, "int"));
					$RecordMultiLeftMenu_l2 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l2) or die(mysqli_error($DB_Conn));
					$row_RecordMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordMultiLeftMenu_l2);
					$totalRows_RecordMultiLeftMenu_l2 = mysqli_num_rows($RecordMultiLeftMenu_l2);
					?>
					<?php if ($totalRows_RecordMultiLeftMenu_l2 > 0) { // Show if recordset not empty ?>
                	<ul>
					<?php do { ?>
                    <li class="<?php echo $row_RecordMultiLeftMenu_l2['endnode']; ?>">
                    <a class="menu-link" href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt_Forum=viewpage_sub&lang=<?php echo $_GET['lang']; ?>&level=<?php echo $row_RecordMultiLeftMenu_l2['level']; ?>&type1=<?php echo $row_RecordMultiLeftMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordMultiLeftMenu_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordMultiLeftMenu_l2['subitem_id']; ?>"><?php echo $row_RecordMultiLeftMenu_l2['itemname']; ?>
                    </a>
						<?php
                         #
                        $collang_RecordMultiLeftMenu_l3 = "zh_TW";
                        if (isset($_GET['lang'])) {
                          $collang_RecordMultiLeftMenu_l3 = $_GET['lang'];
                        }
                        $colsubitem_id_RecordMultiLeftMenu_l3 = "-1";
                        if (isset($row_RecordMultiLeftMenu_l2['item_id'])) {
                          $colsubitem_id_RecordMultiLeftMenu_l3 = $row_RecordMultiLeftMenu_l2['item_id'];
                        }
                        //mysqli_select_db($database_DB_Conn, $DB_Conn);
                        $query_RecordMultiLeftMenu_l3 = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l3, "int"));
                        $RecordMultiLeftMenu_l3 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l3) or die(mysqli_error($DB_Conn));
                        $row_RecordMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordMultiLeftMenu_l3);
                        $totalRows_RecordMultiLeftMenu_l3 = mysqli_num_rows($RecordMultiLeftMenu_l3);
                        ?>
						<?php if ($totalRows_RecordMultiLeftMenu_l3 > 0) { // Show if recordset not empty ?>
                      <ul>
						<?php do { ?>
                          <li class="<?php echo $row_RecordMultiLeftMenu_l3['endnode']; ?>">
                            <a class="menu-link" href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt_Forum=viewpage_sub&lang=<?php echo $_GET['lang']; ?>&level=<?php echo $row_RecordMultiLeftMenu_l3['level']; ?>&type1=<?php echo $row_RecordMultiLeftMenu_l1['item_id']; ?>&type2=<?php echo $row_RecordMultiLeftMenu_l2['item_id']; ?>&type3=<?php echo $row_RecordMultiLeftMenu_l3['item_id']; ?>&subitem_id=<?php echo $row_RecordMultiLeftMenu_l3['subitem_id']; ?>"><?php echo $row_RecordMultiLeftMenu_l3['itemname']; ?>
                              </a>
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
    </div>

<?php
mysqli_free_result($RecordMultiLeftMenu_l1);
?>
