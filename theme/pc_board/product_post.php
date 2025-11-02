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
<?php 
if ($totalRows_RecordProductPost > 0) { // Show if recordset not empty 
?>
<span id="tishi"></span>        
<?php $floor = (($totalPages_RecordProductPost - $pagePost) * $maxRows_RecordProductPost) + ($totalRows_RecordProductPost - ($maxRows_RecordProductPost*$totalPages_RecordProductPost)); ?>
<div id="pagetxt">
  <?php do { ?>
                  <div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                    <tr>
                      <td width="30" valign="top"><h4><strong><?php echo '#' . $floor; ?></strong></h4></td>
                      <td valign="top"><?php echo '發表人' ?>： <font color="#2865A2"><strong><?php echo $row_RecordProductPost['author']; ?></strong></font></td>
                      <td width="50%" align="right" valign="top"><font color="#666666"><?php echo date('Y-m-d',strtotime($row_RecordProductPost['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordProductPost['postdate'])); ?>&nbsp;&nbsp;
                          </font></td>
                    </tr>
                    </table>                      
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
                      <tr>
                        <td valign="top">
                        <?php echo nl2br($row_RecordProductPost['content']);?>                          
						<?php require("require_productreply.php");?>
                        </td>
                      </tr>
                    </table>
                    <?php $floor--; ?>
                  </div>
                    <?php } while ($row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost)); ?>   
</div> 
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>


<div style="height:10px;"></div>

<div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordProductPost = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordProductPost = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordProductPost = buildNavigation($page,$totalPages_RecordProductPost,$prev_RecordProductPost,$next_RecordProductPost,$separator,$max_links,true); 
       ?>
     
        <select class="form-control" onclick="getData(this.options[this.selectedIndex].value);" style="width:100%">
				<?php for($i=0; $i<ceil($totalRows_RecordProductPost/$maxRows_RecordProductPost); $i++) { ?>
				<option value="<?php echo $i; ?>"><?php echo $i+1; ?></option>
				<?php } ?>
		</select>
        
</div>

<div style="clear:both;"></div>
<div style="height:10px;"></div>
<script>
function getData(page) {
	//if(state == 'prev') {page = GetCookie('pagePost'); page = parseInt(page)-parseInt(1); if(page<0) {page = 0;}}
	//if(state == 'next') {page = GetCookie('pagePost'); page = parseInt(page)+parseInt(1); if(page > <?php echo $totalPages_RecordProductPost; ?>) { page = <?php echo $totalPages_RecordProductPost; ?>;}}
    //alert(page);
    $.ajax({ 
        type: 'GET', 
        url: '<?php echo $SiteBaseUrl ?>ajax/productpost_page.php', 
        data: {'pagePost': page,'pid':<?php echo $_GET['id']; ?>,'totalPages_RecordProductPost':<?php echo $totalRows_RecordProductPost; ?>}, 
        //dataType: 'data', 
        success: function(msg){
		    $("#pagetxt").html(msg);
        }, 
        error: function() { 
		alert("Error");
        } 
    }); 
}

//var page = $(this).attr("data-page");
//getData(page);
</script>   
      
<div id='Tcha' style="padding:10px; background-color:#f5f5f5; border: 1px solid #CCC;">
<?php
if($row_RecordProductPost['type1'] != '-1' && $row_RecordProductPost['type2'] != '-1' && $row_RecordProductPost['type3'] != '-1') { $level='2'; }else if($row_RecordProductPost['type1'] != '-1' && $row_RecordProductPost['type2'] != '-1' && $row_RecordProductPost['type3'] == '-1') { $level='1'; }else if($row_RecordProductPost['type1'] != '-1' && $row_RecordProductPost['type2'] == '-1' && $row_RecordProductPost['type3'] == '-1') { $level='0'; }else { $level=''; }
if ($level == '2') {
	$actionurl = $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProductPost['type1'],'type2'=>$row_RecordProductPost['type2']),'',$UrlWriteEnable) . $id_params . $row_RecordProductPost['id'];
} else if ($level == '1') {
	$actionurl = $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProductPost['type1']),'',$UrlWriteEnable) . $id_params . $row_RecordProductPost['id'];
} else if ($level == '0') {
	$actionurl = $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable) . $id_params . $row_RecordProductPost['id'];
} else {
}
?>
<?php if ($row_RecordSystemConfigFr['CartFaqLimint'] == '0') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td><span id="ProductPostAuthor">
      <input name="author" type="text" id="author" maxlength="20" />您的暱稱...
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
  <tr>
    <td width="100"><span id="sprytextarea1">
      <textarea name="QAPostContent" cols="50" rows="5" id="QAPostContent" value=""></textarea>留個言吧...
      <span class="textareaRequiredMsg">欄位不可為空。</span><span class="textareaMaxCharsMsg">已超出字元數目的最大值。</span></span>      <div class="QapTcha"></div> </td>
  </tr>
  <tr>
    <td><p class="margin-top-10"> <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                            
                            &nbsp; <br />
                            <strong><?php echo $Lang_Classify_Send_Verify_Input; ?>:<span class="txtImportant">*</span></strong><br />
                            <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                            <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
                            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false" class="btn btn-3d btn-white"><i class="fa fa-refresh"></i><?php echo $Lang_Classify_Send_Verify_Unlock_Refresh; ?></a></p></td>
  </tr>
  <tr>
    <td>
      <input type="submit" name="qa_button" id="qa_button" value="送出問題" onclick="return CheckProductPost();" />
      <input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id']; ?>" />    
      </td>
    </tr>
</table>
<?php } else if($row_RecordSystemConfigFr['CartFaqLimint'] == '1' && (isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))){ ?>
<?php require("require_member_get.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td><span id="ProductPostAuthor">
      <input name="author" type="text" id="author" value="<?php echo $row_RecordMember['name']; ?>" maxlength="20" />您的暱稱...
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
  <tr>
    <td width="100"><span id="sprytextarea1">
      <textarea name="QAPostContent" cols="50" rows="5" id="QAPostContent" value=""></textarea>留個言吧...
      <span class="textareaRequiredMsg">欄位不可為空。</span><span class="textareaMaxCharsMsg">已超出字元數目的最大值。</span></span>      <div class="QapTcha"></div> </td>
  </tr>
  <tr>
    <td><p class="margin-top-10"> <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                            
                            &nbsp; <br />
                            <strong><?php echo $Lang_Classify_Send_Verify_Input; ?>:<span class="txtImportant">*</span></strong><br />
                            <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                            <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
                            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false" class="btn btn-3d btn-white"><i class="fa fa-refresh"></i><?php echo $Lang_Classify_Send_Verify_Unlock_Refresh; ?></a></p></td>
  </tr>
  <tr>
    <td>
      <input type="submit" name="qa_button" id="qa_button" value="送出問題" onclick="return CheckProductPost();"/>
      <input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id']; ?>" />    
      </td>
    </tr>
</table>
<?php } else { ?>
<?php if($OptionMemberSelect == '1') { ?>
<div style="width:300px; margin-left:auto; margin-right:auto; text-align:center;"><a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable);?>" style="padding:10px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 請先登入再進行發問</a></div>
<?php } ?>
<?php } ?>
</div>

<?php if ($totalRows_RecordProductPost > 0 ) { ?>
<script type="text/javascript">   
var Show_QAPost_Count = "(" + <?php echo $totalRows_RecordProductPost; ?> + ")";
$("#Show_QAPost_Count").html(Show_QAPost_Count);
</script>
<?php } ?>
<script type="text/javascript">
function reloadCaptcha()
{
	jQuery('#siimage').prop('src', '<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>');
}
function CheckProductPost() {
	//var params = $('input').serialize();
	var url = "<?php echo $SiteBaseUrl ?>ajax/product_reply.php";

	$.ajax({
		type: "post",
		url: url,
		data: "content="+$("#QAPostContent").val()+"&pid="+$("#pid").val()+"&author="+$("#author").val()+"&ct_captcha="+$("#ct_captcha").val()<?php if($row_RecordSystemConfigFr['CartFaqLimint'] == '1' && (isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))){?>+"&mid=<?php echo $row_RecordMember['id']; ?>"<?php } ?>, 
		//dataType: "json",
		//data: params,
		success: function(msg){
			if(msg == 'CheckError'){
				alert("驗證碼錯誤!!");
			}else if(msg != ''){
				reloadCaptcha();
				alert("提問已送出!!");
				window.location.reload();
				$('#qa_button').attr('disabled', 'disabled');
				$("#tishi").html(msg);
			}
			else{
				reloadCaptcha();
				alert("請確認您填寫的資料!!");
			}
			//$("#tishi").css({color: "green"});
		}
	});
}
</script>
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("ProductPostAuthor", "none", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], maxChars:150});
var sprytextfield3 = new Spry.Widget.ValidationTextField("Ct_Captcha", "none", {validateOn:["blur"]});
</script> 