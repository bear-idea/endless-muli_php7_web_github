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

/* 取得類別列表 */
$colname_RecordActivitiesListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordActivitiesListType = $_GET['lang'];
}
$coluserid_RecordActivitiesListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordActivitiesListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesListType = sprintf("SELECT * FROM demo_actitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordActivitiesListType, "text"),GetSQLValueString($coluserid_RecordActivitiesListType, "int"));
$RecordActivitiesListType = mysqli_query($DB_Conn, $query_RecordActivitiesListType) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType);
$totalRows_RecordActivitiesListType = mysqli_num_rows($RecordActivitiesListType);

/* 取得作者列表 */
$colname_RecordActivitiesListAuthor = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordActivitiesListAuthor = $_GET['lang'];
}
$coluserid_RecordActivitiesListAuthor = "-1";
if (isset($w_userid)) {
  $coluserid_RecordActivitiesListAuthor = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesListAuthor = sprintf("SELECT * FROM demo_actitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordActivitiesListAuthor, "text"),GetSQLValueString($coluserid_RecordActivitiesListAuthor, "int"));
$RecordActivitiesListAuthor = mysqli_query($DB_Conn, $query_RecordActivitiesListAuthor) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesListAuthor = mysqli_fetch_assoc($RecordActivitiesListAuthor);
$totalRows_RecordActivitiesListAuthor = mysqli_num_rows($RecordActivitiesListAuthor);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Activities") && $_POST['sdescription'] == "") { 
	$_POST['sdescription'] = TrimSummary($_POST['content']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Activities")) {
  $insertSQL = sprintf("INSERT INTO demo_actalbum (title, author, type, location, sdescription, skeyword, content, startdate, enddate, indicate, postdate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
 
  $insertGoTo = "manage_activities.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php $CKEtoolbar = 'Full' ?>
<?php } ?>

<?php //if ($ManageActivitiesEditorSelect == '1' || $ManageActivitiesEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Activities']; ?> <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="title" type="text" id="title" maxlength="200" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇類別 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordActivitiesListType['itemname']?>"><?php echo $row_RecordActivitiesListType['itemname']?></option>
								<?php
				} while ($row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType));
				  $rows = mysqli_num_rows($RecordActivitiesListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordActivitiesListType, 0);
					  $row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">發佈單位<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="author" id="author" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇發佈單位 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordActivitiesListAuthor['itemname']?>"><?php echo $row_RecordActivitiesListAuthor['itemname']?></option>
											  <?php
						} while ($row_RecordActivitiesListAuthor = mysqli_fetch_assoc($RecordActivitiesListAuthor));
						  $rows = mysqli_num_rows($RecordActivitiesListAuthor);
						  if($rows > 0) {
							  mysqli_data_seek($RecordActivitiesListAuthor, 0);
							  $row_RecordActivitiesListAuthor = mysqli_fetch_assoc($RecordActivitiesListAuthor);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">地點</label>
          <div class="col-md-10">
          
                      <input name="location" type="text" id="location" maxlength="30" class="form-control" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">時間</label>
          <div class="col-md-5">
          
                      <div class="input-group m-b-10">
								<div class="input-group-prepend"><span class="input-group-text">開始</span></div>
								<input name="startdate" type="text" class="form-control" id="startdate" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW">
							</div>
                 
          </div>
          <div class="col-md-5">
          
            <div class="input-group m-b-10">
			  <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
					  <input name="enddate" type="text" class="form-control" id="enddate" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW">
				  </div>
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" id="skeyword" maxlength="300" class="form-control" data-role="tagsinput" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" id="sdescription" size="100" maxlength="150" class="form-control"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"></textarea>  
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
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>    
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
      <input type="hidden" name="MM_insert" value="form_Activities" />
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
mysqli_free_result($RecordActivitiesListType);

mysqli_free_result($RecordActivitiesListAuthor);
?>
