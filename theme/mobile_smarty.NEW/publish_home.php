

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordPublish > 0 ) { // Show if recordset not empty 
?>
<div class="latest-posts">
    <h4 class="classic-title"><span><?php echo $ModuleName['Publish']; // 標題文字 ?></span></h4>
    <div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="2">
      <?php do { ?>
      <div class="post-row item">
        <div class="left-meta-post">
          <div class="date"><p><?php echo date('d',strtotime($row_RecordPublish['postdate'])); ?><span><?php echo date('M',strtotime($row_RecordPublish['postdate'])); ?></span></p></div>
        </div>
        <h3 class="post-title"><?php if($row_RecordPublish['type'] != "") { ?><span class="TipTypeStyle">[<?php echo $row_RecordPublish['type']; ?>]</span><?php } ?></h3>
        <div class="post-content">
          <p><a href="<?php echo $SiteBaseUrl . url_rewrite("publish",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordPublish['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordPublish['title']; ?></a></p>
        </div>
      </div>
 <?php } while ($row_RecordPublish = mysqli_fetch_assoc($RecordPublish)); ?>
      
    </div>
  </div>
  
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
  
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordPublish == 0) { // Show if recordset empty 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Publish']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
  </tr>
</table>
<br />
<br />
  <?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
