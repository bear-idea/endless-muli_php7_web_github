<style type="text/css">
.room_outer_board tr td{margin:0;padding:0}
div .room_inner_board{background-color:#FFF;margin:1px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:80px;width:120px}
.room_inner_board_relative{position:relative}
.room_inner_board_relative_buttom{position:relative}
.div_table-cell{background-color:#FFF;text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
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
    <td width="180" bgcolor="#e7e6d9">&nbsp;</td>
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
                  <div class="div_table-cell">
                  <?php // 判斷商品所在之層級
                                if($row_RecordRoomCalendar['type1'] != '-1' && $row_RecordRoomCalendar['type2'] != '-1' && $row_RecordRoomCalendar['type3'] != '-1') { $level='2'; }
                                else if($row_RecordRoomCalendar['type1'] != '-1' && $row_RecordRoomCalendar['type2'] != '-1' && $row_RecordRoomCalendar['type3'] == '-1') { $level='1'; }
                                else if($row_RecordRoomCalendar['type1'] != '-1' && $row_RecordRoomCalendar['type2'] == '-1' && $row_RecordRoomCalendar['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                  <?php if ($row_RecordRoomCalendar['pic'] != "") { ?>	 
                        <a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Room&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordRoomCalendar['type1']; ?>&amp;type2=<?php echo $row_RecordRoomCalendar['type2']; ?>&amp;type3=<?php echo $row_RecordRoomCalendar['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordRoomCalendar['roomid']; ?>" title="<?php echo $row_RecordRoomCalendar['name']; ?>" target="_blank" ><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoomCalendar['pic']); ?>" alt="<?php echo $row_RecordRoomCalendar['sdescription']; ?>" alumb="false" _w="120" _h="80"/></a><span></span><?php } else { ?><a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a><span></span><?php } ?>
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
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>