<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Service")) {
  $updateSQL = sprintf("UPDATE demo_service SET name=%s, author=%s, type=%s, price=%s, servicetime=%s, content=%s, postdate=%s, indicate=%s, sdescription=%s, skeyword=%s, skeywordindicate=%s, pushtop=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['price'], "text"),
					   GetSQLValueString($_POST['servicetime'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['skeyword'], "text"),
					   GetSQLValueString($_POST['skeywordindicate'], "int"),
					   GetSQLValueString($_POST['pushtop'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_service.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */
$colname_RecordServiceListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordServiceListType = $_GET["lang"];
}
$coluserid_RecordServiceListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordServiceListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordServiceListType = sprintf("SELECT * FROM demo_serviceitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordServiceListType, "text"),GetSQLValueString($coluserid_RecordServiceListType, "int"));
$RecordServiceListType = mysqli_query($DB_Conn, $query_RecordServiceListType) or die(mysqli_error($DB_Conn));
$row_RecordServiceListType = mysqli_fetch_assoc($RecordServiceListType);
$totalRows_RecordServiceListType = mysqli_num_rows($RecordServiceListType);

/* 取得作者資料 */
$colname_RecordServiceListAuthor = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordServiceListAuthor = $_GET['lang'];
}
$coluserid_RecordServiceListAuthor = "-1";
if (isset($w_userid)) {
  $coluserid_RecordServiceListAuthor = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordServiceListAuthor = sprintf("SELECT * FROM demo_serviceitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordServiceListAuthor, "text"),GetSQLValueString($coluserid_RecordServiceListAuthor, "int"));
$RecordServiceListAuthor = mysqli_query($DB_Conn, $query_RecordServiceListAuthor) or die(mysqli_error($DB_Conn));
$row_RecordServiceListAuthor = mysqli_fetch_assoc($RecordServiceListAuthor);
$totalRows_RecordServiceListAuthor = mysqli_num_rows($RecordServiceListAuthor);

/* 取得最新訊息資料 */
$colname_RecordService = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordService = $_GET['id_edit'];
}
$coluserid_RecordService = "-1";
if (isset($w_userid)) {
  $coluserid_RecordService = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordService = sprintf("SELECT * FROM demo_service WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordService, "int"),GetSQLValueString($coluserid_RecordService, "int"));
$RecordService = mysqli_query($DB_Conn, $query_RecordService) or die(mysqli_error($DB_Conn));
$row_RecordService = mysqli_fetch_assoc($RecordService);
$totalRows_RecordService = mysqli_num_rows($RecordService);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageServiceEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageServiceEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php //if ($ManageServiceEditorSelect == '1' || $ManageServiceEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 服務項目 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="name" type="text" class="form-control" id="title" value="<?php echo $row_RecordService['name']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordService['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordServiceListType['itemname']?>"<?php if (!(strcmp($row_RecordServiceListType['itemname'], $row_RecordService['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordServiceListType['itemname']?></option>
                  <?php
} while ($row_RecordServiceListType = mysqli_fetch_assoc($RecordServiceListType));
  $rows = mysqli_num_rows($RecordServiceListType);
  if($rows > 0) {
      mysqli_data_seek($RecordServiceListType, 0);
	  $row_RecordServiceListType = mysqli_fetch_assoc($RecordServiceListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">發佈者<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="author" id="author" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordService['author']))) {echo "selected=\"selected\"";} ?>>-- 選擇發佈者 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordServiceListAuthor['itemname']?>"<?php if (!(strcmp($row_RecordServiceListAuthor['itemname'], $row_RecordService['author']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordServiceListAuthor['itemname']?></option>
<?php
} while ($row_RecordServiceListAuthor = mysqli_fetch_assoc($RecordServiceListAuthor));
  $rows = mysqli_num_rows($RecordServiceListAuthor);
  if($rows > 0) {
      mysqli_data_seek($RecordServiceListAuthor, 0);
	  $row_RecordServiceListAuthor = mysqli_fetch_assoc($RecordServiceListAuthor);
  }
?>
                </select>
                    
 
                   
</div>
      </div>
	  
	  <div class="form-group row">
          <label class="col-md-2 col-form-label">價格</label>
          <div class="col-md-10">
                      <input name="price" id="price" value="<?php echo $row_RecordService['price']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務時間<span class="text-red">*</span></label>
          <div class="col-md-10">
           	<div class="input-group p-0">
                    <input name="servicetime" type="number" required="" class="form-control col-md-4" id="servicetime" step="1" value="<?php echo $row_RecordService['servicetime']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="999" data-parsley-type="number" data-parsley-trigger="blur" />
                        <div class="input-group-append"><span class="input-group-text">分鐘</span></div>                
            </div>
                      
                 
        </div>
      </div>  	
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片</label>
          <div class="col-md-10">      
          <a href="uplod_service.php?id_edit=<?php echo $row_RecordService['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>                    
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordService['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordService['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordService['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">關鍵字顯示 <i class="fa fa-info-circle text-orange" data-original-title="是否顯示關鍵字於頁面上。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordService['skeywordindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="skeywordindicate" id="skeywordindicate_1" value="1" />
                <label for="skeywordindicate_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordService['skeywordindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="skeywordindicate" id="skeywordindicate_2" value="0" />
                <label for="skeywordindicate_2">隱藏</label>
            </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordService['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">置頂<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="您可設定此項目來將文章放置於頁面的最頂端。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordService['pushtop'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="pushtop" id="pushtop_1" value="1" />
                <label for="pushtop_1">是</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordService['pushtop'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="pushtop" id="pushtop_2" value="0" />
                <label for="pushtop_2">否</label>
            </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"><?php echo $row_RecordService['content']; ?></textarea>  
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文繞圖</label>
          <div class="col-md-10">
                <input type="image" src="images/tmp_smp_pic_01.jpg" id="change_unit01" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_02.jpg" id="change_unit02" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_03.jpg" id="change_unit03" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_04.jpg" id="change_unit04" onclick="return false" style="margin-right:5px;"><div style="color:#CC6600;">點選您想要的圖示外觀即可在【詳細內容欄位】之【游標處】加入文繞圖格式。圖片可雙擊滑鼠左鍵，在視窗中點選【上傳】頁面，在上傳您要的圖片即可。</div>  
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordService['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur" required="" autocomplete="off"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordService['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordService['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordService['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="oldpic" type="hidden" id="oldpic" value="<?php echo $row_RecordService['pic']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Service" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php require_once("require_template_panel.php"); ?>

<script type="text/javascript">
	$(document).ready(function() {
			$("#change_unit01").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:left;\" />");
			});
			
			$("#change_unit02").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:right;\" />");
			});
			
			$("#change_unit03").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:none;\" /><br />");
			});
			
			$("#change_unit04").click(function(){
					CKEDITOR.instances.content.insertHtml("<p style=\"text-align:center\"><img alt=\"\" height=\"180\" src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" style=\"display: block; margin: auto;\" width=\"240\" /></p>");
			});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<?php
mysqli_free_result($RecordServiceListType);

mysqli_free_result($RecordServiceListAuthor);

mysqli_free_result($RecordService);
?>
