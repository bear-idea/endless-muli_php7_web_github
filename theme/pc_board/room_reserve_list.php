<style type="text/css">
.room_outer_board tr td{margin:0;padding:0}
div .room_inner_board{background-color:#FFF;margin:1px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:80px;width:120px}
.room_inner_board_relative{position:relative}
.room_inner_board_relative_buttom{position:relative}
.nailthumb-container{overflow:hidden;height:<?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px;width:<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px; border:1px solid #EEE; margin:auto;}
div .room_inner_board_context{width:100%;margin-top:5px;text-align:left;overflow:hidden}
div .room_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
a:hover.switch_4block,a:hover.switch_3block,a:hover.switch_2block,a:hover.switch_list{filter:alpha(opacity=75);opacity:.5;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=75)}
.Room_Sl_List{ border-bottom-color:#000; border-bottom-style:dotted; border-bottom-width:1px;}
</style>
<script type="text/javascript">
</script>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordRoomCalendar > 0) { // Show if recordset not empty 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4); ?>" bgcolor="#e7e6d9">&nbsp;</td>
    <td align="left" bgcolor="#e7e6d9" style="padding:5px;">房型</td>
    <td width="70" align="left" bgcolor="#e7e6d9">住房人數</td>
    <td width="70" align="left" bgcolor="#e7e6d9">尚餘房數</td>
    <td width="100" align="left" bgcolor="#e7e6d9">房價</td>
    <td width="70" align="left" bgcolor="#e7e6d9">選擇間數</td>
  </tr>
  <?php do { ?>
  <?php require("require_room_reserve_list_show_chickinpeople.php"); ?>
  <?php 
	if($totalRows_RecordRoomCheckPeople > 0) { // 若訂單有資料則相減
		$row_RecordRoomCalendar['roomnum'] = $row_RecordRoomCalendar['roomnum']-$Count_Room;
	}
  ?>    
  <?php 
  	if($row_RecordRoomCalendar['roomnum'] > 0 && $row_RecordRoomCalendar['indicate'] == 1) {
  ?>
  <tr>
    <td bgcolor="#FDF2DB">
    <div class="photoFrame_base">
          <div class="room_inner_board_relative">
                <div class='<?php echo $TmpRoomBoardIcon; ?>'></div>
                  <div class="nailthumb-container">
                  <?php // 判斷商品所在之層級
                                if($row_RecordRoomCalendar['type1'] != '-1' && $row_RecordRoomCalendar['type2'] != '-1' && $row_RecordRoomCalendar['type3'] != '-1') { $level='2'; }
                                else if($row_RecordRoomCalendar['type1'] != '-1' && $row_RecordRoomCalendar['type2'] != '-1' && $row_RecordRoomCalendar['type3'] == '-1') { $level='1'; }
                                else if($row_RecordRoomCalendar['type1'] != '-1' && $row_RecordRoomCalendar['type2'] == '-1' && $row_RecordRoomCalendar['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                  <?php if ($level == '2') { ?>          
					  <?php if ($row_RecordRoomCalendar['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoomCalendar['type1'],'type2'=>$row_RecordRoomCalendar['type2'],'type3'=>$row_RecordRoomCalendar['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoomCalendar['roomid']; ?>" title="<?php echo $row_RecordRoomCalendar['name']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoomCalendar['pic']); ?>" alt="<?php echo $row_RecordRoomCalendar['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a target="_blank"><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else if ($level == '1') { ?>
                      <?php if ($row_RecordRoomCalendar['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoomCalendar['type1'],'type2'=>$row_RecordRoomCalendar['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoomCalendar['roomid']; ?>" title="<?php echo $row_RecordRoomCalendar['name']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoomCalendar['pic']); ?>" alt="<?php echo $row_RecordRoomCalendar['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a target="_blank"><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else if ($level == '0') { ?>
                      <?php if ($row_RecordRoomCalendar['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoomCalendar['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoomCalendar['roomid']; ?>" title="<?php echo $row_RecordRoomCalendar['name']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoomCalendar['pic']); ?>" alt="<?php echo $row_RecordRoomCalendar['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a target="_blank"><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else { ?>
                      <?php if ($row_RecordRoomCalendar['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['roomid']; ?>" title="<?php echo $row_RecordRoom['name']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoomCalendar['pic']); ?>" alt="<?php echo $row_RecordRoomCalendar['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a target="_blank"><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } ?>
            </div> 
          </div>  
        </div>
    </td>
    <td align="left" bgcolor="#FDF2DB"><?php echo $row_RecordRoomCalendar['name']; ?>
      <input name="name[]" type="hidden" id="name[]" value="<?php echo $row_RecordRoomCalendar['name']; ?>"></td>
    <td align="left" bgcolor="#FDF2DB"><?php echo $row_RecordRoomCalendar['peoplenum']; ?>人
      <input name="peoplenum[]" type="hidden" id="peoplenum[]" value="<?php echo $row_RecordRoomCalendar['peoplenum']; ?>"></td>
    <td align="left" bgcolor="#FDF2DB"><?php echo $row_RecordRoomCalendar['roomnum']; ?>間
      <input name="roomnum[]" type="hidden" id="roomnum[]" value="<?php echo $row_RecordRoomCalendar['roomnum']; ?>"></td>
    <td align="left" bgcolor="#FDF2DB"><?php echo $row_RecordRoomCalendar['roomprice']; ?>元
      <input name="roomprice[]" type="hidden" id="roomprice[]" value="<?php echo $row_RecordRoomCalendar['roomprice']; ?>"></td>
    <td align="left" bgcolor="#FDF2DB">
    
    <label for="quantity"><?php echo $row_RecordsetCat['chickinpeople'] ?></label>
      <select name="quantity[]" id="quantity[]" style="background-color:#FFFFFF">
      <?php for($j=0; $j<=($row_RecordRoomCalendar['roomnum']); $j++) { ?>
        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
      <?php } ?>
      </select>
      <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_RecordRoomCalendar['id']; ?>">
      <input name="roomdate[]" type="hidden" id="roomdate[]" value="<?php echo $row_RecordRoomCalendar['roomdate']; ?>">
      <input name="roomid[]" type="hidden" id="roomid[]" value="<?php echo $row_RecordRoomCalendar['roomid']; ?>">
    </td>
  </tr>  
  <?php 
	}
  ?>
  <?php } while ($row_RecordRoomCalendar = mysqli_fetch_assoc($RecordRoomCalendar)); ?>
</table>
<?php $Room_List_Count += $totalRows_RecordRoomCalendar; ?>
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
if ($totalRows_RecordRoomCalendar == 0) { // Show if recordset empty 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Room']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
  </tr>
</table>
<?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>