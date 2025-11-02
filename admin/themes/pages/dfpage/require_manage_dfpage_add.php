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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/* 取得類別列表 */
$colname_RecordDfPageListType = "zh_TW";
if (isset($_GET['lang'])) {
  $colname_RecordDfPageListType = $_GET['lang'];
}
$coluserid_RecordDfPageListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfPageListType = $w_userid;
}
$colaid_RecordDfPageListType = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordDfPageListType = $_GET['aid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageListType = sprintf("SELECT * FROM demo_dfpageitem WHERE lang=%s && level='0' && aid=%s && userid=%s ORDER BY subitem_id", GetSQLValueString($colname_RecordDfPageListType, "text"),GetSQLValueString($colaid_RecordDfPageListType, "int"),GetSQLValueString($coluserid_RecordDfPageListType, "int"));
$RecordDfPageListType = mysqli_query($DB_Conn, $query_RecordDfPageListType) or die(mysqli_error($DB_Conn));
$row_RecordDfPageListType = mysqli_fetch_assoc($RecordDfPageListType);
$totalRows_RecordDfPageListType = mysqli_num_rows($RecordDfPageListType);

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_DfPage") && $_POST['sdescription'] == "") {
	$_POST['sdescription'] = TrimSummary($_POST['content']);
}
/* 當類別無傳值進來時則給定初始值 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_DfPage")) {
	if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
	if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
	if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_DfPage")) {
  $insertSQL = sprintf("INSERT INTO demo_dfpage (aid, title, type1, type2, type3, content, indicate, skeyword, sdescription, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['aid'], "text"),
					   GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString(htmlspecialchars($_POST['skeyword']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['sdescription']), "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_dfpage.php?Opt=viewpage&lang=" . $_POST['lang'] . '&aid=' . $_POST['aid'] . '&tpt=' . $_POST['tpt'];
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
	<?php if ($ManageDfPageEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageDfPageEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageDfPageEditorSelect == '1' || $ManageDfPageEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 文章資料 <small>新增</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body p-0">

  <form action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="title" type="text" class="form-control" id="title" maxlength="200" data-parsley-trigger="blur" required=""/>

        </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類</label>
          <div class="col-md-10">

              <div id="cxselect_type" class="row p-2">
                  <select name="type1" id="type1" class="type1 form-control form-select col" data-required="false"></select>
                  <select name="type2" id="type2" class="type2 form-control form-select col" data-required="true"></select>
                  <select name="type3" id="type3" class="type3 form-control form-select col" data-required="true"></select>
              </div>

        </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>
          <div class="col-md-10">

            <div class="form-check form-check-inline">
                <input class="form-check-input"  type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input"  type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>

          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-bs-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" id="skeyword" maxlength="300" class="form-control" data-role="tagsinput" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-bs-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" id="sdescription" size="100" maxlength="150" class="form-control"/>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-bs-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-bs-toggle="tooltip" data-bs-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"></textarea>
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
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
            <input name="tpt" type="hidden" id="tpt" value="<?php echo $row_RecordTpt['title']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_DfPage" />
  </form>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->

<script>
    $(document).ready(function() {
        $('#cxselect_type').cxSelect({
            url: 'selectbox_action/dfpage_add.php',
            selects: ['type1', 'type2', 'type3'], //class
            jsonSub:'sub',
            emptyStyle: 'none',
            jsonName: 'itemname',
            jsonValue: 'item_id',
            firstTitle: '-- 選擇項目 --',
            nodata: 'none'
        });
    });
</script>

<?php require_once("require_template_panel.php"); ?>

<?php
mysqli_free_result($RecordDfPageListType);
?>
