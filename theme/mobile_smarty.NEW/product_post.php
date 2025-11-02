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
<div id="PostPagination">
<?php if($totalPages_RecordProductPost > 0) { ?>
<div class="col-md-12 col-xs-12">
	<div style="text-align:center;">
	<?php //if ($page > 0) { // Show if not first page ?>
	<div class="col-md-3 col-xs-12">
		<a class="btn btn-reveal btn-white" style="width:100%; margin:2px;" onclick="getData(0);">
		<i class="fa fa-angle-double-left"></i>
		<span><?php echo $Lang_First; ?></span>
		</a>
	</div>
	<?php //} // Show if not first page ?>
    <div class="col-md-3 col-xs-12">
		<div style="margin:2px 0px 2px 0px;">
			<select class="form-control" onclick="getData(this.options[this.selectedIndex].value);">
				<?php for($i=0; $i<ceil($totalRows_RecordProductPost/$maxRows_RecordProductPost); $i++) { ?>
				<option value="<?php echo $i; ?>"><?php echo $i+1; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
    <div class="col-md-3 col-xs-12">
		<a class="btn btn-reveal btn-white" style="width:100%; margin:2px;" onclick="getData(<?php echo $totalPages_RecordProductPost; ?>);">
		<i class="fa fa-angle-double-right"></i>
		<span><?php echo $Lang_Last; ?></span>
		</a>
	</div>
    <div class="col-md-3 col-xs-12">
		<a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
			<span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordProductPost; ?><?php echo $Lang_Content_Count_Lots; ?></span>
		</a>
	</div>
	</div>
</div>
<?php } ?>
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
<!--<form id="Post_Send_Form" name="Post_Send_Form">-->
<?php if ($row_RecordSystemConfigFr['CartFaqLimint'] == '0') { ?>
<div class="row">
    <div class="form-group">
        <div class="col-md-6 col-sm-6">
            <label>暱稱</label><span id="ProductPostAuthor">
            <input id="author" type="text" name="author" class="form-control required"><span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-md-12 col-sm-12">
            <label>留言內容</label><span id="sprytextarea1">
            <textarea name="QAPostContent" rows="5" class="form-control required" id="QAPostContent"></textarea>
            <span class="textareaRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textareaMaxCharsMsg"><?php echo $Lang_Classify_Send_Error06; //已超出字元數目的最大值。?>。</span></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
                              <p class="margin-top-10"> <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                            
                            &nbsp; <br />
                            <strong><?php echo $Lang_Classify_Send_Verify_Input; ?>:<span class="txtImportant">*</span></strong><br />
                            <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                            <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
                            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false" class="btn btn-3d btn-white"><i class="fa fa-refresh"></i><?php echo $Lang_Classify_Send_Verify_Unlock_Refresh; ?></a></p>
        </div>
    </div>
</div>

<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-3d btn-teal btn-block margin-top-30" name="qa_button" id="qa_button" value="送出問題" onclick="return CheckProductPost();">
				送出問題
			</button>
		</div>
<input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="Post_Send_Form" value="1" />
<input type="hidden" name="prevpage" value="<?php echo $actionurl; ?>" />
</div>
<!--</form>-->
</div>
<?php } else if($row_RecordSystemConfigFr['CartFaqLimint'] == '1' && (isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))){ ?>
<?php require("require_member_get.php"); ?>
<div class="row">
    <div class="form-group">
        <div class="col-md-6 col-sm-6">
        <?php if ($_SESSION["line_name"] != "" && isset($_SESSION['success_line_login_backstage'])) { ?>
        <?php $postname = $_SESSION["line_name"]; ?>
        <?php } else if ($_SESSION["fb_last_name"] != "" && isset($_SESSION['success_fb_login_backstage'])) { ?>
        <?php $postname = $_SESSION["fb_last_name"] . $_SESSION["fb_first_name"]; ?>
        <?php } else if ($_SESSION["google_name"] != "" && isset($_SESSION['success_google_login_backstage'])) { ?>
        <?php $postname = $row_RecordMember['name']; ?>
        <?php } else  { ?>
        <?php $postname = $row_RecordMember['name']; ?>
        <?php } ?>
            <span style="color:#2865A2; font-weight:bolder;"><?php echo $row_RecordMember['name']; ?></span><input name="author" type="hidden" id="author" value="<?php echo $postname; ?>" />
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-md-12 col-sm-12">
            <label>留言內容</label><span id="sprytextarea1">
            <textarea name="QAPostContent" rows="5" class="form-control required" id="QAPostContent"></textarea>
            <span class="textareaRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textareaMaxCharsMsg"><?php echo $Lang_Classify_Send_Error06; //已超出字元數目的最大值。?>。</span></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
                              <p class="margin-top-10"> <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                            
                            &nbsp; <br />
                            <strong><?php echo $Lang_Classify_Send_Verify_Input; ?>:<span class="txtImportant">*</span></strong><br />
                            <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                            <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
                            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false" class="btn btn-3d btn-white"><i class="fa fa-refresh"></i><?php echo $Lang_Classify_Send_Verify_Unlock_Refresh; ?></a></p>
        </div>
    </div>
</div>

<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-3d btn-teal btn-block margin-top-30" name="qa_button" id="qa_button" value="送出問題" onclick="return CheckProductPost();">
				送出問題
			</button>
		</div>
<input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="Post_Send_Form" value="1" />
<input type="hidden" name="prevpage" value="<?php echo $actionurl; ?>" />
</div>
<!--</form>-->
</div>
<?php } else { ?>
<?php if($OptionMemberSelect == '1') { ?>
<div class="row">
    <div class="col-md-12" style="text-align:center;">
    	<a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable);?>" class="btn btn-3d btn-amber"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 請先登入再進行發問</a>
    </div>
</div>
<?php } ?>
<?php } ?>
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