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

$coltype1_RecordAboutCMenu = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordAboutCMenu = $_GET['type1'];
}
$coluserid_RecordAboutCMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAboutCMenu = $_SESSION['userid'];
}
$coltype2_RecordAboutCMenu = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordAboutCMenu = $_GET['type2'];
}
$coltype3_RecordAboutCMenu = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordAboutCMenu = $_GET['type3'];
}
$colnamelang_RecordAboutCMenu = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordAboutCMenu = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutCMenu = sprintf("SELECT * FROM demo_about WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordAboutCMenu, "text"),GetSQLValueString($coltype1_RecordAboutCMenu, "int"),GetSQLValueString($coltype2_RecordAboutCMenu, "int"),GetSQLValueString($coltype3_RecordAboutCMenu, "int"),GetSQLValueString($coluserid_RecordAboutCMenu, "int"));
$RecordAboutCMenu = mysqli_query($DB_Conn, $query_RecordAboutCMenu) or die(mysqli_error($DB_Conn));
$row_RecordAboutCMenu = mysqli_fetch_assoc($RecordAboutCMenu);
$totalRows_RecordAboutCMenu = mysqli_num_rows($RecordAboutCMenu);

$colname_RecordAboutCMenuListType_1 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAboutCMenuListType_1 = $_GET['lang'];
}
$coluserid_RecordAboutCMenuListType_1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAboutCMenuListType_1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutCMenuListType_1 = sprintf("SELECT * FROM demo_aboutitem WHERE list_id = 1 && lang=%s  && level=0 && userid=%s", GetSQLValueString($colname_RecordAboutCMenuListType_1, "text"),GetSQLValueString($coluserid_RecordAboutCMenuListType_1, "int"));
$RecordAboutCMenuListType_1 = mysqli_query($DB_Conn, $query_RecordAboutCMenuListType_1) or die(mysqli_error($DB_Conn));
$row_RecordAboutCMenuListType_1 = mysqli_fetch_assoc($RecordAboutCMenuListType_1);
$totalRows_RecordAboutCMenuListType_1 = mysqli_num_rows($RecordAboutCMenuListType_1);
?>
<?php //if ($MSTMP == 'default') { ?>
<?php if ($totalRows_RecordAboutCMenu > 0 || $totalRows_RecordAboutCMenuListType_1 > 0) { // Show if recordset not empty ?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<form name="form_Jmp_List" id="form_Jmp_List">
<?php require("require_sharelink.php"); ?>
  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value="#">-- 選擇項目 --</option>
    <?php if ($totalRows_RecordAboutCMenu > 0) { ?>
    <?php do { ?>
    <option value="about.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=About&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordAboutCMenu['type1']; ?>&amp;type2=<?php echo $row_RecordAboutCMenu['type2']; ?>&amp;type3=<?php echo $row_RecordAboutCMenu['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordAboutCMenu['id']; ?>" <?php if ($row_RecordAboutCMenu['id'] == $_GET['id']){echo "selected=\"selected\"";} ?>><?php echo $row_RecordAboutCMenu['title']; ?></option>
    <?php } while ($row_RecordAboutCMenu = mysqli_fetch_assoc($RecordAboutCMenu)); ?> 
    <?php } ?>
    <?php if ($totalRows_RecordAboutCMenuListType_1 > 0) { ?>
    <?php do { ?>
    <option value="#" style="color:#999;"> ├ <?php echo $row_RecordAboutCMenuListType_1['itemname']; ?>  </option>
    	<?php /*++++++++++++++++++++++++++ */?>
        <?php
			  $collang_RecordAboutCMenuListType_2 = "zh-tw";
			  if (isset($_GET['lang'])) {
				$collang_RecordAboutCMenuListType_2 = $_GET['lang'];
			  }
			  $colsubitem_id_RecordAboutCMenuListType_2 = "-1";
			  if (isset($row_RecordAboutCMenuListType_1['item_id'])) {
				$colsubitem_id_RecordAboutCMenuListType_2 = $row_RecordAboutCMenuListType_1['item_id'];
			  }
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $query_RecordAboutCMenuListType_2 = sprintf("SELECT * FROM demo_aboutitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordAboutCMenuListType_2, "text"),GetSQLValueString($colsubitem_id_RecordAboutCMenuListType_2, "int"));
			  $RecordAboutCMenuListType_2 = mysqli_query($DB_Conn, $query_RecordAboutCMenuListType_2) or die(mysqli_error($DB_Conn));
			  $row_RecordAboutCMenuListType_2 = mysqli_fetch_assoc($RecordAboutCMenuListType_2);
			  $totalRows_RecordAboutCMenuListType_2 = mysqli_num_rows($RecordAboutCMenuListType_2);
			?>
            <?php do { ?>
            <?php if ($row_RecordAboutCMenuListType_1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
    		<option value="#" style="color:#999;">│ ├ <?php echo $row_RecordAboutCMenuListType_2['itemname']; ?> </option>
					<?php /*++++++++++++++++++++++++++ */?>
                    <?php
                        $coltype1_RecordAboutCMenu_2 = "-1";
if (isset($row_RecordAboutCMenuListType_2['subitem_id'])) {
  $coltype1_RecordAboutCMenu_2 = $row_RecordAboutCMenuListType_2['subitem_id'];
}
$coluserid_RecordAboutCMenu_2 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAboutCMenu_2 = $_SESSION['userid'];
}
$coltype2_RecordAboutCMenu_2 = "-1";
if (isset($row_RecordAboutCMenuListType_2['item_id'])) {
  $coltype2_RecordAboutCMenu_2 = $row_RecordAboutCMenuListType_2['item_id'];
}
$coltype3_RecordAboutCMenu_2 = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordAboutCMenu_2 = $_GET['type3'];
}
$colnamelang_RecordAboutCMenu_2 = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordAboutCMenu_2 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutCMenu_2 = sprintf("SELECT * FROM demo_about WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordAboutCMenu_2, "text"),GetSQLValueString($coltype1_RecordAboutCMenu_2, "int"),GetSQLValueString($coltype2_RecordAboutCMenu_2, "int"),GetSQLValueString($coltype3_RecordAboutCMenu_2, "int"),GetSQLValueString($coluserid_RecordAboutCMenu_2, "int"));
$RecordAboutCMenu_2 = mysqli_query($DB_Conn, $query_RecordAboutCMenu_2) or die(mysqli_error($DB_Conn));
$row_RecordAboutCMenu_2 = mysqli_fetch_assoc($RecordAboutCMenu_2);
$totalRows_RecordAboutCMenu_2 = mysqli_num_rows($RecordAboutCMenu_2);
                    ?>
                    <?php do { ?>
                    <?php if ($totalRows_RecordAboutCMenu_2 > 0) { ?>
      <option value="about.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=About&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordAboutCMenu_2['type1']; ?>&amp;type2=<?php echo $row_RecordAboutCMenu_2['type2']; ?>&amp;type3=<?php echo $row_RecordAboutCMenu_2['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordAboutCMenu_2['id']; ?>" <?php if ($row_RecordAboutCMenu_2['id'] == $_GET['id']){echo "selected=\"selected\"";} ?>>&nbsp;&nbsp;&nbsp; <?php echo $row_RecordAboutCMenu_2['title']; ?></option>
                    <?php } ?>
                    <?php } while ($row_RecordAboutCMenu_2 = mysqli_fetch_assoc($RecordAboutCMenu_2)); ?>
                    <?php mysqli_free_result($RecordAboutCMenu_2);?>
                    <?php /*++++++++++++++++++++++++++ */?>
            <?php } ?>
    		<?php } while ($row_RecordAboutCMenuListType_2 = mysqli_fetch_assoc($RecordAboutCMenuListType_2)); ?>
			<?php mysqli_free_result($RecordAboutCMenuListType_2);?>
        <?php /*++++++++++++++++++++++++++ */?>
    <?php } while ($row_RecordAboutCMenuListType_1 = mysqli_fetch_assoc($RecordAboutCMenuListType_1)); ?> 
    <?php } ?>
  </select>
</form>
<?php } // Show if recordset not empty ?>
<?php //} else { ?>
<?php //include($TplPath . "/about_cmenu_list.php"); ?>
<?php //} ?>
<?php
mysqli_free_result($RecordAboutCMenu);

mysqli_free_result($RecordAboutCMenuListType_1);
?>
