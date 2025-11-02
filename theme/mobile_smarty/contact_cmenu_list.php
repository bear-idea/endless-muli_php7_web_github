<?php if ($totalRows_RecordContactCMenu > 0 ) { // Show if recordset not empty ?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<form name="form_Jmp_List" id="form_Jmp_List">
<?php require("require_sharelink.php"); ?>
  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value="#"><?php echo $Lang_Listitem_Select //-- 選擇項目 -- ?></option>
    <?php do { ?>
    <option value="contact.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Contact&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordContactCMenu['type1']; ?>&amp;type2=<?php echo $row_RecordContactCMenu['type2']; ?>&amp;type3=<?php echo $row_RecordContactCMenu['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordContactCMenu['id']; ?>" <?php if (isset($_GET['id']) && $row_RecordContactCMenu['id'] == $_GET['id']){echo "selected=\"selected\"";} ?>><?php echo $row_RecordContactCMenu['title']; ?></option>
    <?php } while ($row_RecordContactCMenu = mysqli_fetch_assoc($RecordContactCMenu)); ?> 
  </select>
</form>
<?php } // Show if recordset not empty ?>
