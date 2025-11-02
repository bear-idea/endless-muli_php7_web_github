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
?>
<?php if ($totalRows_RecordAboutCMenu > 0 || $totalRows_RecordAboutCMenuListType_1 > 0) { // Show if recordset not empty ?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<form name="form_Jmp_List" id="form_Jmp_List" style="width:500px; text-align:right">
<?php if ($totalRows_RecordAboutCMenu > 1) { ?>
  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value="#"><?php echo $Lang_Listitem_Select //-- 選擇項目 -- ?></option>
    <?php do { ?>
    <option value="<?php echo $SiteBaseUrl . url_rewrite("about",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordAboutCMenu['id']),'',$UrlWriteEnable);?>" <?php if ($row_RecordAboutCMenu['id'] == $_GET['id']){echo "selected=\"selected\"";} ?>><?php echo $row_RecordAboutCMenu['title']; ?></option>
    <?php } while ($row_RecordAboutCMenu = mysqli_fetch_assoc($RecordAboutCMenu)); ?> 
    
    <?php if ($totalRows_RecordAboutCMenuListType_1 > 0) { ?>
    <?php do { ?>
    <option value="#" style="color:#999;">---[ <?php echo $row_RecordAboutCMenuListType_1['itemname']; ?> ]---</option>
    <?php } while ($row_RecordAboutCMenuListType_1 = mysqli_fetch_assoc($RecordAboutCMenuListType_1)); ?>
	<?php } ?>
  </select>
<?php } ?>
</form>
<?php } // Show if recordset not empty ?>
