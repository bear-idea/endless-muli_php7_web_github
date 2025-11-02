<?php
/*********************************************************************
 # 主頁面留言訊息 - 回應區塊
 *********************************************************************/
?>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordGuestbookReply > 0) { // Show if recordset not empty 
?>     
      <?php
      #
      # ============== [do] ============== #
	  #
      # 重複印出所有資料
      do { 
      ?>
        <div style="background-color:#ebeff8; padding:5px;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
            <tr>
              <td valign="top"><?php echo $Lang_Reply; ?>：</td>
            </tr>
            <tr>
              <td valign="top"><?php echo $row_RecordGuestbookReply['content']; ?></td>
            </tr>
            <tr>
              <td align="right"><font color="#666666"> <?php echo $Lang_ReplyPostDate; ?>： <?php echo date('Y-m-d',strtotime($row_RecordGuestbookReply['replydate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordGuestbookReply['replydate'])); ?>&nbsp;&nbsp; </font></td>
            </tr>
          </table>
          
        </div>
        <div class="DivHight5px"></div>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordGuestbookReply = mysqli_fetch_assoc($RecordGuestbookReply));
      ?>
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
if ($totalRows_RecordGuestbookReply == 0) { // Show if recordset empty 
?>
  <div style="background-color:#ebeff8; padding:5px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
      <tr>
        <td align="center" valign="top"><font color="#ff0000"><?php echo $Lang_No_Reply; ?></font></td>
      </tr>
    </table>
    
  </div>
  <div class="DivHight5px"></div>
<?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>

