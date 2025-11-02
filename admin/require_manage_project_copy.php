<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Project") && $_POST['sdescription'] == "") { 
	$_POST['sdescription'] = TrimSummary($_POST['content']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Project")) {
  $insertSQL = sprintf("INSERT INTO demo_projectalbum (title, author, type, location, sdescription, skeyword, content, startdate, enddate, indicate, postdate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['skeyword'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['startdate'], "date"),
                       GetSQLValueString($_POST['enddate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_project.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}

/* 取得類別資料 */
$colname_RecordProjectListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordProjectListType = $_GET["lang"];
}
$coluserid_RecordProjectListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProjectListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectListType = sprintf("SELECT * FROM demo_projectitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordProjectListType, "text"),GetSQLValueString($coluserid_RecordProjectListType, "int"));
$RecordProjectListType = mysqli_query($DB_Conn, $query_RecordProjectListType) or die(mysqli_error($DB_Conn));
$row_RecordProjectListType = mysqli_fetch_assoc($RecordProjectListType);
$totalRows_RecordProjectListType = mysqli_num_rows($RecordProjectListType);

/* 取得作者資料 */
$colname_RecordProjectListAuthor = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordProjectListAuthor = $_GET['lang'];
}
$coluserid_RecordProjectListAuthor = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProjectListAuthor = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectListAuthor = sprintf("SELECT * FROM demo_projectitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordProjectListAuthor, "text"),GetSQLValueString($coluserid_RecordProjectListAuthor, "int"));
$RecordProjectListAuthor = mysqli_query($DB_Conn, $query_RecordProjectListAuthor) or die(mysqli_error($DB_Conn));
$row_RecordProjectListAuthor = mysqli_fetch_assoc($RecordProjectListAuthor);
$totalRows_RecordProjectListAuthor = mysqli_num_rows($RecordProjectListAuthor);

/* 取得最新訊息資料 */
$colname_RecordProject = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordProject = $_GET['id_edit'];
}
$coluserid_RecordProject = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProject = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProject = sprintf("SELECT * FROM demo_projectalbum WHERE act_id = %s && userid=%s", GetSQLValueString($colname_RecordProject, "int"),GetSQLValueString($coluserid_RecordProject, "int"));
$RecordProject = mysqli_query($DB_Conn, $query_RecordProject) or die(mysqli_error($DB_Conn));
$row_RecordProject = mysqli_fetch_assoc($RecordProject);
$totalRows_RecordProject = mysqli_num_rows($RecordProject);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php $CKEtoolbar = 'Full' ?>
<?php } ?>

<?php //if ($ManageProjectEditorSelect == '1' || $ManageProjectEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Project']; ?> <small>複增</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordProject['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordProject['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordProjectListType['itemname']?>"<?php if (!(strcmp($row_RecordProjectListType['itemname'], $row_RecordProject['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordProjectListType['itemname']?></option>
                  <?php
} while ($row_RecordProjectListType = mysqli_fetch_assoc($RecordProjectListType));
  $rows = mysqli_num_rows($RecordProjectListType);
  if($rows > 0) {
      mysqli_data_seek($RecordProjectListType, 0);
	  $row_RecordProjectListType = mysqli_fetch_assoc($RecordProjectListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">發佈者<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="author" id="author" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordProject['author']))) {echo "selected=\"selected\"";} ?>>-- 選擇發佈者 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordProjectListAuthor['itemname']?>"<?php if (!(strcmp($row_RecordProjectListAuthor['itemname'], $row_RecordProject['author']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordProjectListAuthor['itemname']?></option>
<?php
} while ($row_RecordProjectListAuthor = mysqli_fetch_assoc($RecordProjectListAuthor));
  $rows = mysqli_num_rows($RecordProjectListAuthor);
  if($rows > 0) {
      mysqli_data_seek($RecordProjectListAuthor, 0);
	  $row_RecordProjectListAuthor = mysqli_fetch_assoc($RecordProjectListAuthor);
  }
?>
                </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">地點</label>
          <div class="col-md-10">
          
                      <input name="location" type="text" class="form-control" id="location" value="<?php echo $row_RecordProject['location']; ?>" maxlength="30" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">時間</label>
          <div class="col-md-5">
          
                      <div class="input-group m-b-10">
								<div class="input-group-prepend"><span class="input-group-text">開始</span></div>
								<input name="startdate" type="text" class="form-control" id="startdate" value="<?php echo $row_RecordProject['startdate']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW">
							</div>
                 
          </div>
          <div class="col-md-5">
          
            <div class="input-group m-b-10">
			  <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
					  <input name="enddate" type="text" class="form-control" id="enddate" value="<?php echo $row_RecordProject['enddate']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW">
				  </div>
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordProject['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordProject['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordProject['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">關鍵字顯示 <i class="fa fa-info-circle text-orange" data-original-title="是否顯示關鍵字於頁面上。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordProject['skeywordindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="skeywordindicate" id="skeywordindicate_1" value="1" />
                <label for="skeywordindicate_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordProject['skeywordindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="skeywordindicate" id="skeywordindicate_2" value="0" />
                <label for="skeywordindicate_2">隱藏</label>
            </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordProject['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">置頂<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="您可設定此項目來將文章放置於頁面的最頂端。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordProject['pushtop'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="pushtop" id="pushtop_1" value="1" />
                <label for="pushtop_1">是</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordProject['pushtop'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="pushtop" id="pushtop_2" value="0" />
                <label for="pushtop_2">否</label>
            </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"><?php echo $row_RecordProject['content']; ?></textarea>  
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
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordProject['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Project" />
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

<?php
mysqli_free_result($RecordProjectListType);

mysqli_free_result($RecordProjectListAuthor);

mysqli_free_result($RecordProject);
?>
