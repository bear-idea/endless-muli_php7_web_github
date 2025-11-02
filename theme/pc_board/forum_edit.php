<script type="text/javascript" src="<?php echo $SiteBaseUrl ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.replace( 'content',{width : '90%', toolbar : 'Basic', height: '350px'} );
};
</script>
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<!--標題外框-->
<div style="position:relative;">
<div class="mdtitle TitleBoardStyle">
	<div class="mdtitle_t">
			<div class="mdtitle_t_l"> </div>
			<div class="mdtitle_t_r"> </div>
			<div class="mdtitle_t_c"><!--標題--></div>
			<div class="mdtitle_t_m"><!--更多--></div>
	</div><!--mdtitle_t-->
	<div class="mdtitle_c g_p_hide">
			<div class="mdtitle_c_l g_p_fill"> </div>
			<div class="mdtitle_c_r g_p_fill"> </div>
			<div class="mdtitle_c_c">
					<!-- <div class="mdtitle_m_t"></div>
					<div class="mdtitle_m_c">  --> 
<!--標題外框-->
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Forum']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>
<!--標題外框-->
  				<!--</div>
					<div class="mdtitle_m_b"></div>-->
			</div>
	</div><!--mdtitle_c-->
	<div class="mdtitle_b">
			<div class="mdtitle_b_l"> </div>
			<div class="mdtitle_b_r"> </div>
			<div class="mdtitle_b_c"> </div>
	</div><!--mdtitle_b-->
</div><!--mdtitle-->
</div>
<!--標題外框-->
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ((isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) { // Show if recordset empty 
?>
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
<!--外框--> 
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
           		  <form name="Forum_Post" action="require_forumedit.php" method="POST" id="Forum_Post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                      <tr>
                        <td width="100" align="right">主題：</td>
                        <td><span id="ForumName">
                          <label for="name"></label>
                          <input name="name" type="text" id="name" value="<?php echo $row_RecordForum['name']; ?>" size="50" maxlength="30" />
                        <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
                      </tr>
                      <tr>
                        <td align="right">類別：</td>
                        <td><span id="ForumClass">
                          <label for="type"></label>
                          <select name="type" id="type">
                            <option value="" <?php if (!(strcmp("", $row_RecordForum['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_RecordForumClass['itemname']?>"<?php if (!(strcmp($row_RecordForumClass['itemname'], $row_RecordForum['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordForumClass['itemname']?></option>
                            <?php
} while ($row_RecordForumClass = mysqli_fetch_assoc($RecordForumClass));
  $rows = mysqli_num_rows($RecordForumClass);
  if($rows > 0) {
      mysqli_data_seek($RecordForumClass, 0);
	  $row_RecordForumClass = mysqli_fetch_assoc($RecordForumClass);
  }
?>
                          </select>
                        <span class="selectRequiredMsg">請選取項目。</span></span></td>
                      </tr>
                      <tr>
                        <td align="right">內容：</td>
                        <td><span id="ForumContent">
                          <label for="content"></label>
                          <textarea name="content" cols="50" rows="20" id="content"><?php echo $row_RecordForum['content']; ?></textarea>
                        <span class="textareaRequiredMsg">需要有一個值。</span></span></td>
                      </tr>
                       <tr>
                     <td align="right"><span class="Form_Required_Item">*</span>驗證：</td>
                     <td><div class="QapTcha"></div></td>
                   </tr>
                      <tr>
                        <td align="right">&nbsp;</td>
                        <td><input type="submit" name="button" id="button" value="修改" />
                          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                          <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                          <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
                        <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" /></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_update" value="Forum_Post" />
            		</form>
           	  </div>
            </div>
        </div>        
</div>
<!--外框-->
  				<!--</div>
					<div class="mdmiddle_m_b"></div>-->
			</div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
<?php 
} else { // Show if recordset empty 
#
# ============== [/if] ============== #
?>
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
//if ($totalRows_RecordForum == 0) { // Show if recordset empty 
?>
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
<!--外框-->
<div class="columns on-1">
        <div class="container">
            <div class="column">
              <div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="300" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td>您必須<a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $_GET['wshop']; ?>&amp;Opt=log&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Forum">登入會員</a>才可發表主題<br />
若您尚未加入會員，請<a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $_GET['wshop']; ?>&amp;Opt=reg&lang=<?php echo $_SESSION['lang']; ?>">點此註冊 </a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
</table>
                </div>
            </div>
        </div>        
</div>
<br />
<br />
<!--外框-->
  				<!--</div>
					<div class="mdmiddle_m_b"></div>-->
	  </div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
  <?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
<script type="text/javascript">
  $(document).ready(function(){
	$('.QapTcha').QapTcha({
		txtLock : '移動按鈕拖曳至右方以解鎖按鈕',
		txtUnlock : '按鈕解鎖',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : '<?php echo $SiteBaseUrl ?>Qaptcha.jquery.php'
	});
  });
</script> 
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("ForumName", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("ForumClass", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("ForumContent", {validateOn:["blur"]});
</script>