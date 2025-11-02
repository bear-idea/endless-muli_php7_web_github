<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
<?php if ($row_RecordContactMail['googlemapindicate'] != '0' && $GoogleMapAPICode != "") { ?>
<script src="https://maps.google.com/maps/api/js?sensor=false&key=<?php echo $GoogleMapAPICode; ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jQuery.bMap.1.3.1.min.js"></script>
<?php } ?>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.txtImportant{color:red}
#map{background:#fff;border:4px solid #fff;position:relative;-webkit-border-radius:4px;-moz-border-radius:4px;-o-border-radius:4px;border-radius:4px;box-shadow:0 1px 4px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 4px rgba(0,0,0,.2);-moz-box-shadow:0 1px 4px rgba(0,0,0,.2);-o-box-shadow:0 1px 4px rgba(0,0,0,.2);text-align:center;margin-bottom:20px;height:400px;}
}
</style>
<?php 
  switch($_GET['Operate']) 
  {
	  case "CheckError":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('" . $Lang_Post_Message_Contact_CheckError . "','warning');});</script>\n";
		break;
	  default:
		break;
  }
?>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Contact']; // 標題文字 ?></span></h1>
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
<!-- 標題外框-->
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
	  <?php if ($_SESSION['mailsend_message'] == "On") { ?>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                      <td width="189"><?php echo $Lang_Classify_Context_Mail_Send_Success; /*信件已送出*/ ?></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
          </table>
		<?php $_SESSION['mailsend_message'] = "Off"; ?>
		<?php } else { ?>     
      	<form id="Mail_Send_Form" name="Mail_Send_Form" method="post" action="<?php echo $SiteBaseUrl . url_rewrite('sendmail',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'send'),'',$UrlWriteEnable);?>" onsubmit="return document.MM_returnValue">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
          <?php if ($row_RecordContactMail['contacttitleindicate'] == '1') { ?>
            <tr>
              <td><h2><strong><?php echo $row_RecordContactMail['contacttitle']; ?></strong></h2></td>
            </tr>
           <?php } ?>
           <?php if ($row_RecordContactMail['googlemapindicate'] == '1' && $GoogleMapAPICode != "") { ?>
            <tr>
              <td><div id="map"></div></td>
            </tr>
            <?php } ?>
            <tr>
              <td><div data-scroll-reveal="enter top"><?php echo $row_RecordContactMail['contactcontent']; ?></div></td>
            </tr>
          </table>
          <?php if ($row_RecordContactMail['googlemapindicate'] == '2' && $GoogleMapAPICode != "") { ?><div id="map"></div><?php } ?>
          <?php if ($row_RecordContactMail['formindicate'] == '0') { ?>
          <table width="100%" cellpadding="0" cellspacing="0" class="TB_General_style00" data-scroll-reveal="enter left">
                        
                            <tbody>
                                <tr>
                                    <td width="120" align="right" class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Context_Mail_Send_Title; //主題 ?>:</td>
                                    <td><span id="sprytextfield1">
                                      <input name="subject" type="text"  class="text" id="subject" value="<?php echo $_COOKIE['Ct_Subject']; ?>"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                 <tr>
              <td align="right" valign="center" ><span class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Context_Mail_Send_Class; //分類 ?>:</span></td>
              <td valign="center" ><span id="spryselect1">
                <label for="contacttype"></label>
                <select name="contacttype" id="contacttype">
                  <option value="-1">-- <?php echo $Lang_Classify_Context_Mail_Send_Select_Class; //選擇分類 ?> --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordContactListType['itemname']?>"><?php echo $row_RecordContactListType['itemname']?></option>
                  <?php
} while ($row_RecordContactListType = mysqli_fetch_assoc($RecordContactListType));
  $rows = mysqli_num_rows($RecordContactListType);
  if($rows > 0) {
      mysqli_data_seek($RecordContactListType, 0);
	  $row_RecordContactListType = mysqli_fetch_assoc($RecordContactListType);
  }
?>
                </select>
                <span class="selectInvalidMsg"><?php echo $Lang_Classify_Send_Error01; //請選取有效的項目。 ?></span><span class="selectRequiredMsg"><?php echo $Lang_Classify_Send_Error02; //請選取項目。 ?></span></span></td>
            </tr>
                                <tr>
                                    <td align="right" class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Context_Mail_Send_Name; //姓名 ?>:</td>
                                    <td><span id="sprytextfield2">
                                      <input name="name" type="text"  class="text" id="name" value="<?php echo $_COOKIE['Ct_Name'];; ?>"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //<?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                <tr>
              <td valign="center" align="right"><span class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Context_Mail_Send_Sex; //姓別 ?>:</span></td>
              <td><span id="spryradio1">
                <label>
                  <input name="sex" type="radio" id="sex_0" value="<?php echo $Lang_Classify_Context_Mail_Send_Man; //男 ?>" checked="checked" />
                  <?php echo $Lang_Classify_Context_Mail_Send_Man; //男 ?></label>
                
                <label>
                  <input type="radio" name="sex" value="<?php echo $Lang_Classify_Context_Mail_Send_Woman; //女 ?>" id="sex_1" />
                  <?php echo $Lang_Classify_Context_Mail_Send_Woman; //女 ?></label>
                <br />
                <span class="radioRequiredMsg"><?php echo $Lang_Classify_Send_Error04; //請進行選取。 ?></span></span></td>
                              </tr>
                                <tr>
                                    <td align="right" class="columnName"><?php echo $Lang_Classify_Context_Mail_Send_Addr; //地址 ?>:</td>
                                    <td><span id="sprytextfield4">
                                      <input name="Address" type="text"  class="text" value="<?php echo $_COOKIE['Ct_Address']; ?>" size="50"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                <tr>
                                    <td align="right" class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Context_Mail_Send_Phone; //電話 ?>:</td>
                                    <td><span id="sprytextfield6">
                                      <input name="phone" type="text"  class="text" id="phone" value="<?php echo $_COOKIE['Ct_Phone']; ?>"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                <tr>
                                    <td align="right" class="columnName"><?php echo $Lang_Classify_Context_Mail_Send_Fax; //傳真 ?>:</td>
                                    <td><span id="sprytextfield7">
                                      <input name="Fax" type="text"  class="text" value="<?php echo $_COOKIE['Ct_Fax']; ?>"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                <tr>
                                    <td align="right" class="columnName"><span class="txtImportant">*</span> Email:</td>
                                    <td><span id="sprytextfield8">
                                    <input name="mail" type="text"  class="text" id="mail" value="<?php echo $_COOKIE['Ct_Mail']; ?>"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; //格式無效。 ?></span></span></td>
                                </tr>
                                <tr>
                                    <td align="right" class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Context_Mail_Send_Message; //您的留言 ?> :</td>
                                    <td><span id="sprytextarea1">
                                    <label for="message"></label>
                                      <textarea name="message" id="message" cols="45" rows="5"><?php echo $_COOKIE['Ct_Message']; ?></textarea>
                                    <span class="textareaRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                <tr>
              <td valign="center" align="right"><span class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Send_Verify; //解鎖 ?> :</span></td>
              <td valign="center" >
              <p>
                        <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                        <object type="application/x-shockwave-flash" data="<?php echo $SiteBaseUrl; ?>securimage/securimage_play.swf?icon_file=securimage/images/audio_icon.png&amp;audio_file=<?php echo $SiteBaseUrl ?>securimage/securimage_play.php" height="32" width="32" wmode="transparent">
                        <param name="movie" value="<?php echo $SiteBaseUrl; ?>securimage/securimage_play.swf?icon_file=<?php echo $SiteBaseUrl ?>securimage/images/audio_icon.png&amp;audio_file=<?php echo $SiteBaseUrl; ?>securimage/securimage_play.php" wmode="transparent" height="32" width="32"/>
                        </object>
                        &nbsp;
                        <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="<?php echo $SiteBaseUrl; ?>securimage/images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" /></a><br />
                        <strong><?php echo $Lang_Classify_Send_Verify_Input; ?>:<span class="txtImportant">*</span></strong><br />
                         <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                         <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
                         <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></p>
              </td>
                              </tr>
            <?php if ($CaptchaUseMobilButtom == '1') { ?>                  
            <tr>
              <td valign="center" align="right"><span class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Send_Unlock; //驗證 ?> :</span></td>
              <td valign="center" ><div class="QapTcha"></div></td>
                              </tr>
            <?php } ?>   
            <tr>
              <td valign="center" >&nbsp;</td>
              <td valign="center" >&nbsp;</td>
            </tr>
            <tr>
              <td valign="center" >&nbsp;</td>
              <td valign="center" >&nbsp;</td>
            </tr>
                            
        
            <tr>
              <td valign="center" align="middle" colspan="2"><input type="submit" value="<?php echo $Lang_Classify_Send_OK; //確定送出 ?>" onclick="return CheckFields();"/>
                <input type="reset" value="<?php echo $Lang_Classify_Send_Cancer; //重新輸入 ?>"/></td>
            </tr>
                    </tbody>
          </table>
          <?php } ?>
          <?php } ?>
          <input type="hidden" name="Mail_Send_Form" value="Mail_Send_On" />
      	  <input name="SiteMail" type="hidden" id="SiteMail" value="<?php echo $row_RecordContactMail['SiteMail']; ?>" />
      	  <input name="SiteAuthor" type="hidden" id="SiteAuthor" value="<?php echo $row_RecordContactMail['SiteAuthor']; ?>" />
      	  <input name="contacttitle" type="hidden" id="contacttitle" value="<?php echo $row_RecordContactMail['contacttitle']; ?>" />
      	  <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
      	  <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
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
<?php if ($CaptchaUseMobilButtom == '1') { ?> 
<script type="text/javascript">
  $(document).ready(function(){
	$('.QapTcha').QapTcha({
		txtLock : '<?php echo $Lang_Classify_Send_Verify_Tip; //移動按鈕拖曳至右方以解鎖按鈕 ?>',
		txtUnlock : '<?php echo $Lang_Classify_Send_Verify_Unlock; //按鈕解鎖 ?>',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : '<?php echo $SiteBaseUrl; ?>Qaptcha.jquery.php'
	});
  });
</script> 
<?php } ?> 
<?php if ($row_RecordContactMail['googlemapindicate'] != '0' && $GoogleMapAPICode != "") { ?>
<script type="text/javascript">
$(document).ready(function(){ 
	$("#map").bMap({
		mapZoom: 15,
		mapCenter:[<?php echo $row_RecordContactMail['SiteAddrX']; ?>,<?php echo $row_RecordContactMail['SiteAddrY']; ?>],
		//mapSidebar:"sideBar", //id of the div to use as the sidebar
		markers:{"data":[{"lat":"<?php echo $row_RecordContactMail['SiteAddrX']; ?>","lng":"<?php echo $row_RecordContactMail['SiteAddrY']; ?>","title":"<?php echo $row_RecordContactMail['SiteSName']; ?>","rnd":"1","body":"<div style=\"width:300px;text-align:left;\"></div></div><div style=\"width:95%;text-align:left;margin:5px;\"><?php if ($row_RecordContactMail['SitePhone'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block; text-align:center;\"><i class=\"fa fa-phone\"></i></span> <?php echo $Lang_Footer_Tel; ?>：<?php echo $row_RecordContactMail['SitePhone']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteCell'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block;text-align:center;\"><i class=\"fa fa-tablet\"></i></span> <?php echo $Lang_Footer_Cell; ?>：<?php echo $row_RecordContactMail['SiteCell']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteFax'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block;text-align:center;\"><i class=\"fa fa-print\"></i></span> <?php echo $Lang_Footer_Fax; ?>：<?php echo $row_RecordContactMail['SiteFax']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteAddr'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block;text-align:center;\"><i class=\"fa fa-map-marker\"></i></span> <?php echo $Lang_Footer_Addr; ?>：<?php echo $row_RecordContactMail['SiteAddr']; ?></div><?php } ?></div><div style=\"width:300px;text-align:left;\"></div>", "icon":"<?php echo $SiteBaseUrl; ?>images/googlemap/pins_ct.png"}
		]}
	});
});
</script>
<?php } ?>
<script type="text/javascript">
<!--
function CheckFields()
{	
	var fieldvalue = document.getElementById("subject").value;
	if (fieldvalue == "") 
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Title . ")"; ?>");
		document.getElementById("subject").focus();
		return false;
	}
	var fieldvalue = document.getElementById("contacttype").value;
	if (fieldvalue == "-1" || fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Class . ")"; ?>");
		document.getElementById("contacttype").focus();
		return false;
	}
	var fieldvalue = document.getElementById("name").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Name . ")"; ?>");
		document.getElementById("name").focus();
		return false;
	}
	var fieldvalue = document.getElementById("phone").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Phone . ")"; ?>");
		document.getElementById("phone").focus();
		return false;
	}
	var fieldvalue = document.getElementById("mail").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . "E-Mail" . ")"; ?>");
		document.getElementById("mail").focus();
		return false;
	}
	var fieldvalue = document.getElementById("message").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Message . ")"; ?>");
		document.getElementById("message").focus();
		return false;
	}
	var fieldvalue = document.getElementById("ct_captcha").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Verify . ")"; ?>");
		document.getElementById("ct_captcha").focus();
		return false;
	}
}
//-->
</script>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "email", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"], invalidValue:"-1"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("Ct_Captcha", "none", {validateOn:["blur"]});
</script>