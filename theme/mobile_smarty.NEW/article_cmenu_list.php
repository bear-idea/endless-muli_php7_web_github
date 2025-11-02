<?php if ($totalRows_RecordArticleCMenu > 1 ) { // Show if recordset not empty ?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<form name="form_Jmp_List" id="form_Jmp_List" style="width:500px; text-align:right">
<?php //require("require_sharelink.php"); ?>
  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value="#"><?php echo $Lang_Listitem_Select //-- 選擇項目 -- ?></option>
    <?php do { ?>
    <?php if($row_RecordArticleCMenu['type3'] != "-1") { ?>
    <option value="<?php echo $SiteBaseUrl . url_rewrite('article',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleCMenu['type1'],'type2'=>$row_RecordArticleCMenu['type2'],'type3'=>$row_RecordArticleCMenu['type3']),'',$UrlWriteEnable);?><?php echo $id_params . $row_RecordArticleCMenu['id']; ?>" <?php if (isset($_GET['id']) && $row_RecordArticleCMenu['id'] == $_GET['id']){echo "selected=\"selected\"";} ?>><?php echo $row_RecordArticleCMenu['title']; ?></option>
    <?php } else if ($row_RecordArticleCMenu['type2'] != "-1") { ?>
    <option value="<?php echo $SiteBaseUrl . url_rewrite('article',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleCMenu['type1'],'type2'=>$row_RecordArticleCMenu['type2']),'',$UrlWriteEnable);?><?php echo $id_params . $row_RecordArticleCMenu['id']; ?>" <?php if (isset($_GET['id']) && $row_RecordArticleCMenu['id'] == $_GET['id']){echo "selected=\"selected\"";} ?>><?php echo $row_RecordArticleCMenu['title']; ?></option>
    <?php } else { ?>
    <option value="<?php echo $SiteBaseUrl . url_rewrite('article',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleCMenu['type1']),'',$UrlWriteEnable);?><?php echo $id_params . $row_RecordArticleCMenu['id']; ?>" <?php if (isset($_GET['id']) && $row_RecordArticleCMenu['id'] == $_GET['id']){echo "selected=\"selected\"";} ?>><?php echo $row_RecordArticleCMenu['title']; ?></option>
    <?php } ?>
    <?php } while ($row_RecordArticleCMenu = mysqli_fetch_assoc($RecordArticleCMenu)); ?>
  </select>
</form>
<?php } // Show if recordset not empty ?>
