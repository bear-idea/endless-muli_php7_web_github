  <div class="columns on-1">
    <div class="container">
      <div class="column">  
        <div class="container ct_board ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['News']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordNews > 0 ) { // Show if recordset not empty 
?>
        <div class="columns on-1">
          <div class="container board">
            <div class="column">
              <div class="container ct_board Scroll_Bar" style="height:240px;">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                  <!--
      <tr>
        <td width="20" align="center" valign="top"></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_News; // 標題 ?> </td>
        <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_News; // 日期 ?></td>
      </tr>
      -->
      <?php if ($totalRows_RecordNews > 0) { // Show if recordset not empty ?>
      <?php
      #
      # ============== [do] ============== #
	  #
      # 重複印出所有資料
      do { 
      ?>
                    <?php
		  #
		  # ============== [tr color change] ============== #
		  #
		  # 表格隔行換色
		  $oddtr=TR_News_Odd_Color_Style;
          $eventr=TR_News_Even_Color_Style;
          if(($startRow_RecordNews)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
                    <tr class= "<?php echo $chahgecolorcount; ?>">
                      <td align="center" valign="top" width="20"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" width="18" height="18" /></td>
                      <td valign="top"><?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordNews['type'] != "") { 
              ?>
                        <span class="TipTypeStyle">[<?php echo $row_RecordNews['type']; ?>]</span>
                        <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
                        <a href="<?php echo $SiteBaseUrl . url_rewrite("news",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordNews['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordNews['title']; ?></a></td>
                      <td width="100" valign="top"><?php echo highLight(date('Y-m-d',strtotime($row_RecordNews['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></td>
            </tr>
                    <?php 
		   $startRow_RecordNews++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
                    <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordNews = mysqli_fetch_assoc($RecordNews)); 
      ?>
      <?php } ?>
                  </table>
                </div>
            </div>
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
if ($totalRows_RecordNews == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['News']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
  </tr>
</table>
<br />
<br />
  <?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
