<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/knowledge";
	$ppu->extensions = "JPG,PNG,GIF";
	$ppu->formName = "form_Knowledge";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "3000";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "false";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "1500";
	$ppu->maxHeight = "1500";
	$ppu->saveWidth = "";
	$ppu->saveHeight = "";
	$ppu->timeout = "600";
	$ppu->progressBar = "fileCopyProgress.htm";
	$ppu->progressWidth = "300";
	$ppu->progressHeight = "100";
	$ppu->checkVersion("2.1.3");
	$ppu->doUpload();
}
$GP_uploadAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
		$GP_uploadAction .= "?".$_SERVER['QUERY_STRING']."&GP_upload=true";
	} else {
		$GP_uploadAction .= "?".$_SERVER['QUERY_STRING'];
	}
} else {
  $GP_uploadAction .= "?"."GP_upload=true";
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

// Smart Image Processor 1.0.4
if (isset($_GET['GP_upload'])) {
  $sip = new resizeUploadedFiles($ppu);
  $sip->component = "GD2";
  $sip->resizeImages = "true";
  $sip->aspectImages = "true";
  $sip->maxWidth = "1000";
  $sip->maxHeight = "1000";
  $sip->quality = "100";
  $sip->makeThumb = "true";
  $sip->pathThumb = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/knowledge/thumb";
  $sip->aspectThumb = "true";
  $sip->naming = "prefix";
  $sip->suffix = "small_";
  $sip->maxWidthThumb = "380";
  $sip->maxHeightThumb = "380";
  $sip->qualityThumb = "100";
  $sip->checkVersion("1.0.4");
  $sip->doResize();
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($editFormAction)) {
  if (isset($_SERVER['QUERY_STRING'])) {
	  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}

/* 取得類別列表 */
$colname_RecordKnowledgeListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordKnowledgeListType = $_GET['lang'];
}
$coluserid_RecordKnowledgeListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordKnowledgeListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnowledgeListType = sprintf("SELECT * FROM demo_knowledgeitem WHERE list_id = 1 && lang=%s && level='0' && userid=%s ORDER BY subitem_id", GetSQLValueString($colname_RecordKnowledgeListType, "text"),GetSQLValueString($coluserid_RecordKnowledgeListType, "int"));
$RecordKnowledgeListType = mysqli_query($DB_Conn, $query_RecordKnowledgeListType) or die(mysqli_error($DB_Conn));
$row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType);
$totalRows_RecordKnowledgeListType = mysqli_num_rows($RecordKnowledgeListType);

$colname_RecordKnowledge = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordKnowledge = $_GET['id_edit'];
}
$coluserid_RecordKnowledge = "-1";
if (isset($w_userid)) {
  $coluserid_RecordKnowledge = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnowledge = sprintf("SELECT * FROM demo_knowledge WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordKnowledge, "int"),GetSQLValueString($coluserid_RecordKnowledge, "int"));
$RecordKnowledge = mysqli_query($DB_Conn, $query_RecordKnowledge) or die(mysqli_error($DB_Conn));
$row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge);
$totalRows_RecordKnowledge = mysqli_num_rows($RecordKnowledge);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Knowledge") && $_POST['sdescription'] == "") { 
	$_POST['sdescription'] = TrimSummary($_POST['content']);
}
/* 當類別無傳值進來時則給定初始值 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Knowledge")) {
	if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
	if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
	if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Knowledge")) {
  $insertSQL = sprintf("INSERT INTO demo_knowledge (name, type1, type2, type3, pic, content, indicate, skeyword, sdescription, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
                       GetSQLValueString($_POST['pic'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['skeyword'], "text"),
					   GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_knowledge.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageKnowledgeEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageKnowledgeEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>
<?php //if ($ManageKnowledgeEditorSelect == '1' || $ManageKnowledgeEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php //} ?>
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Knowledge']; ?><small>複增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-copy"></i> 複增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="name" type="text" required class="form-control" id="name" value="<?php echo $row_RecordKnowledge['name']; ?>" maxlength="200"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類</label>
          <div class="col-md-10 p-10">
              <div class="row p-10">
                 
                    
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordKnowledge['type1']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordKnowledgeListType['item_id']?>"<?php if (!(strcmp($row_RecordKnowledgeListType['item_id'], $row_RecordKnowledge['type1']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordKnowledgeListType['itemname']?></option>
                      <?php
} while ($row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType));
  $rows = mysqli_num_rows($RecordKnowledgeListType);
  if($rows > 0) {
      mysqli_data_seek($RecordKnowledgeListType, 0);
	  $row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType);
  }
?>
                    </select>

                    
                    <select name="type2" id="type2" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordKnowledgeListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類2 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordKnowledgeListType['item_id']?>"<?php if (!(strcmp($row_RecordKnowledgeListType['item_id'], $row_RecordKnowledgeListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordKnowledgeListType['itemname']?></option>
<?php
} while ($row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType));
  $rows = mysqli_num_rows($RecordKnowledgeListType);
  if($rows > 0) {
      mysqli_data_seek($RecordKnowledgeListType, 0);
	  $row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType);
  }
?>
                    </select>

                    
                    <select name="type3" id="type3" class="form-control col-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordKnowledgeListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類3 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordKnowledgeListType['item_id']?>"<?php if (!(strcmp($row_RecordKnowledgeListType['item_id'], $row_RecordKnowledgeListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordKnowledgeListType['itemname']?></option>
                      <?php
} while ($row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType));
  $rows = mysqli_num_rows($RecordKnowledgeListType);
  if($rows > 0) {
      mysqli_data_seek($RecordKnowledgeListType, 0);
	  $row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType);
  }
?>
                    </select>
</div></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="pic" name="pic" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic" required="" />
               <div id="error_pic"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordKnowledge['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordKnowledge['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordKnowledge['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordKnowledge['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"><?php echo $row_RecordKnowledge['content']; ?></textarea>  
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">快速排版</label>
          <div class="col-md-10">
              <input type="image" src="images/tmp_smp_00.jpg" id="change_tmp00" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_01.jpg" id="change_tmp01" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_02.jpg" id="change_tmp02" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_03.jpg" id="change_tmp03" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_04.jpg" id="change_tmp04" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_05.jpg" id="change_tmp05" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_06.jpg" id="change_tmp06" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_07.jpg" id="change_tmp07" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_08.jpg" id="change_tmp08" onclick="return false" style="margin-right:5px;"><div style="color:#CC6600;">點選您想要的排版圖示外觀即可將【詳細內容欄位】全部替換。圖片可雙擊滑鼠左鍵，在視窗中點選【上傳】頁面，在上傳您要的圖片即可。</div>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文繞圖</label>
          <div class="col-md-10">
                <input type="image" src="images/tmp_smp_pic_01.jpg" id="change_unit01" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_02.jpg" id="change_unit02" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_03.jpg" id="change_unit03" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_04.jpg" id="change_unit04" onclick="return false" style="margin-right:5px;"><div style="color:#CC6600;">點選您想要的圖示外觀即可在【詳細內容欄位】之【游標處】加入文繞圖格式。圖片可雙擊滑鼠左鍵，在視窗中點選【上傳】頁面，在上傳您要的圖片即可。</div>  
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordKnowledge['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordKnowledge['id']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input id="fullIdPath" type="hidden" value="<?php echo $row_RecordKnowledge['type1']; ?>,<?php echo $row_RecordKnowledge['type2']; ?>,<?php echo $row_RecordKnowledge['type3']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Knowledge" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php require_once("require_template_panel.php"); ?>

<script type="text/javascript">
<?php 
/*
文檔
https://github.com/kartik-v/bootstrap-fileinput/wiki/12.-%E4%B8%80%E4%BA%9B%E6%A0%B7%E4%BE%8B%E4%BB%A3%E7%A0%81
*/
?>
$(document).ready(function() {
	$("#pic, #pic_muti").fileinput({
		showUpload:true, 
		uploadAsync: false, //设置上传同步异步 此为同步
		//uploadUrl: "index.php", //上传的地址  
		allowedFileExtensions: ["jpg","png","gif"],
		//resizeImage: true,
		maxImageWidth: 1500,
		maxImageHeight: 1500,
		//resizePreference: 'width',
		maxFileSize: 3000,  
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
		});
});
</script>

<script type="text/javascript">
// 下拉連動選單設定
$(function () {

    // 判斷是否有預設值
    var defaultValue = false;
    if (0 < $.trim($('#fullIdPath').val()).length) {
        $fullIdPath = $('#fullIdPath').val().split(',');
        defaultValue = true;
    }
    
    // 設定預設選項
    if (defaultValue) {
        $('#type1').selectOptions($fullIdPath[0]); 
    }
    
	//$("#type2").hide(); //開始執行時先將第二層的選單藏起來
	//$("#type3").hide(); //開始執行時先將第二層的選單藏起來
    // 開始產生關聯下拉式選單
    $('#type1').change(function () {
        // 觸發第二階下拉式選單
		//$("選單ID").addOption("選單內容物件",false);
		//$("選單ID").removeOption("選單索引/值/陣列");若是要刪掉全部則框號內置入/./
        $('#type2').removeOption(/.?/).ajaxAddOption(
            'selectbox_action/knowledge_add.php?&<?php echo time();?>', 
            { 'id': $(this).val(), 'lv': 1 }, 
            false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
            function () {
                
                // 設定預設選項
                if (defaultValue) {
                    $(this).selectOptions($fullIdPath[1]).trigger('change');
                } else {
                    $(this).selectOptions().trigger('change');
                }
				
				// 設定欄位隱藏/開啟
				if( $('#type1 option:selected').val() != '' && $('#type2 option:selected').val() != '')
				// 值=val() // 標籤=text
				{
					$("#type2").show(); // 
				}else{
					$("#type2").hide(); //
				}
            }
        ).change(function () {
            // 觸發第三階下拉式選單
            $('#type3').removeOption(/.?/).ajaxAddOption(
                'selectbox_action/knowledge_add.php?<?php echo time();?>', 
                { 'id': $(this).val(), 'lv': 2 }, 
                false, 
                function () {
                
                    // 設定預設選項
                    if (defaultValue) {
                        $(this).selectOptions($fullIdPath[2]);
                    }
					// 設定欄位隱藏/開啟
					if( $('#type2 option:selected').val() != '' && $('#type3 option:selected').val() != '')
					// 值=val() // 標籤=text
					{
						$("#type3").show(); // 
					}else{
						$("#type3").hide(); //
					}
					}
            );
        });
    }).trigger('change');

    // 全部選擇完畢後，顯示所選擇的選項
    /*$('#type3').change(function () {
        alert('主機：' + $('#type1 option:selected').text() + 
              '／類型：' + $('#type2 option:selected').text() +
              '／遊戲：' + $('#type3 option:selected').text());
    });*/
});
</script>
<?php
mysqli_free_result($RecordKnowledgeListType);

mysqli_free_result($RecordKnowledge);
?>
