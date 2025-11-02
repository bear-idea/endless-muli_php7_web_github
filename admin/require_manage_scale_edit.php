<?php require_once('../Connections/DB_Conn.php'); ?>
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
$colname_RecordScaleListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordScaleListType = $_GET['lang'];
}
$coluserid_RecordScaleListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleListType = sprintf("SELECT * FROM erp_scaleitem WHERE list_id = 1 && lang=%s && level='0' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colname_RecordScaleListType, "text"),GetSQLValueString($coluserid_RecordScaleListType, "int"));
$RecordScaleListType = mysqli_query($DB_Conn, $query_RecordScaleListType) or die(mysqli_error($DB_Conn));
$row_RecordScaleListType = mysqli_fetch_assoc($RecordScaleListType);
$totalRows_RecordScaleListType = mysqli_num_rows($RecordScaleListType);

$colname_RecordScaleListSubType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordScaleListSubType = $_GET['lang'];
}
$coluserid_RecordScaleListSubType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleListSubType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleListSubType = sprintf("SELECT * FROM erp_scaleitem WHERE list_id = 4 && lang=%s && userid=%s", GetSQLValueString($colname_RecordScaleListSubType, "text"),GetSQLValueString($coluserid_RecordScaleListSubType, "int"));
$RecordScaleListSubType = mysqli_query($DB_Conn, $query_RecordScaleListSubType) or die(mysqli_error($DB_Conn));
$row_RecordScaleListSubType = mysqli_fetch_assoc($RecordScaleListSubType);
$totalRows_RecordScaleListSubType = mysqli_num_rows($RecordScaleListSubType);

/* 取得作者列表 */

$colname_RecordScale = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordScale = $_GET['id_edit'];
}
$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordScale, "int"),GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/* 當類別無傳值進來時則給定初始值 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Scale")) {
	if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
	if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
	if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Scale")) {
  
  $colname_RecordScaleCheck = "-1";
	if (isset($_POST['code'])) {
	  $colname_RecordScaleCheck = $_POST['code'];
	}
	$coluserid_RecordScaleCheck = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordScaleCheck = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordScaleCheck = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScaleCheck, "int"),GetSQLValueString($coluserid_RecordScaleCheck, "int"));
	$RecordScaleCheck = mysqli_query($DB_Conn, $query_RecordScaleCheck) or die(mysqli_error($DB_Conn));
	$row_RecordScaleCheck = mysqli_fetch_assoc($RecordScaleCheck);
	$totalRows_RecordScaleCheck = mysqli_num_rows($RecordScaleCheck);
	
	if($_POST['code'] == $_POST['code_old'] || $totalRows_RecordScaleCheck == 0){
	
  $updateSQL = sprintf("UPDATE erp_scale SET name=%s, code=%s, type=%s, type1=%s, type2=%s, type3=%s, state=%s, pdseries=%s, model=%s, splitscale=%s, indicate=%s, plot=%s, homeshow=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString(htmlspecialchars($_POST['name']), "text"),
					   GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
					   GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['pdseries'], "text"),
                       GetSQLValueString(htmlspecialchars($_POST['model']), "text"),
					   GetSQLValueString($_POST['splitscale'], "int"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['plot'], "int"),
					   GetSQLValueString($_POST['homeshow'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['notes1']), "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";
  $updateGoTo = "manage_scale.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
  
	}else{
	echo("<script type=\"text/javascript\">");
	echo("swal({ title: \"物料代碼重複!\", text: \"\", type: \"warning\",buttonsStyling: false,confirmButtonText: \"確認\",confirmButtonClass: \"btn btn-primary m-5\"});");
	echo("</script>");
  }
}
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageScaleEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageScaleEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageScaleEditorSelect == '1' || $ManageScaleEditorSelect == '2') { ?>
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
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 物料管理 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" >
      <div class="form-group row">
          <label class="col-md-2 col-form-label">物料代碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="code" type="text"  class="form-control" id="code" value="<?php echo $row_RecordScale['code']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text"  class="form-control" id="name" value="<?php echo $row_RecordScale['name']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">型號</label>
          <div class="col-md-10">
          
                      <input name="pdseries" type="text" id="pdseries" value="<?php echo $row_RecordScale['pdseries']; ?>" size="30" maxlength="30" class="form-control" />
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="" <?php if (!(strcmp(-1, $row_RecordScale['type1']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordScaleListType['item_id']?>"<?php if (!(strcmp($row_RecordScaleListType['item_id'], $row_RecordScale['type1']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordScaleListType['itemname']?></option>
                      <?php
} while ($row_RecordScaleListType = mysqli_fetch_assoc($RecordScaleListType));
  $rows = mysqli_num_rows($RecordScaleListType);
  if($rows > 0) {
      mysqli_data_seek($RecordScaleListType, 0);
	  $row_RecordScaleListType = mysqli_fetch_assoc($RecordScaleListType);
  }
?>
                    </select>
                    
                    <select name="type2" id="type2" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordScaleListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類2 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordScaleListType['item_id']?>"<?php if (!(strcmp($row_RecordScaleListType['item_id'], $row_RecordScaleListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordScaleListType['itemname']?></option>
<?php
} while ($row_RecordScaleListType = mysqli_fetch_assoc($RecordScaleListType));
  $rows = mysqli_num_rows($RecordScaleListType);
  if($rows > 0) {
      mysqli_data_seek($RecordScaleListType, 0);
	  $row_RecordScaleListType = mysqli_fetch_assoc($RecordScaleListType);
  }
?>
            </select>

                    
                    <select name="type3" id="type3" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordScaleListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類3 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordScaleListType['item_id']?>"<?php if (!(strcmp($row_RecordScaleListType['item_id'], $row_RecordScaleListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordScaleListType['itemname']?></option>
                      <?php
} while ($row_RecordScaleListType = mysqli_fetch_assoc($RecordScaleListType));
  $rows = mysqli_num_rows($RecordScaleListType);
  if($rows > 0) {
      mysqli_data_seek($RecordScaleListType, 0);
	  $row_RecordScaleListType = mysqli_fetch_assoc($RecordScaleListType);
  }
?>
                    </select>
                    <span class="help-block with-errors"></span>
                    
</div>
      </div></div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">種類大項</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordScale['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇種類大項 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordScaleListSubType['itemname']?>"<?php if (!(strcmp($row_RecordScaleListSubType['itemname'], $row_RecordScale['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordScaleListSubType['itemname']?></option>
                  <?php
} while ($row_RecordScaleListSubType = mysqli_fetch_assoc($RecordScaleListSubType));
  $rows = mysqli_num_rows($RecordScaleListSubType);
  if($rows > 0) {
      mysqli_data_seek($RecordScaleListSubType, 0);
	  $row_RecordScaleListSubType = mysqli_fetch_assoc($RecordScaleListSubType);
  }
?>
                </select>  
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">即時價格狀態</label>
          <div class="col-md-10">
                 
                    <select name="state" id="state" class="form-control" data-parsley-trigger="blur">
                <option value="">-- 選擇狀態 --</option>
								<option value="sell" <?php if (!(strcmp("sell", $row_RecordScale['state']))) {echo "selected=\"selected\"";} ?>>應收(對方付費，我方收款)</option>
                                <option value="buy" <?php if (!(strcmp("buy", $row_RecordScale['state']))) {echo "selected=\"selected\"";} ?>>應付(我方付費，對方取款)</option>
                                <option value="free" <?php if (!(strcmp("free", $row_RecordScale['state']))) {echo "selected=\"selected\"";} ?>>無償(無須付費)</option>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">規格</label>
          <div class="col-md-10">
          
                      <input name="model" type="text" id="model" value="<?php echo $row_RecordScale['model']; ?>" size="50" maxlength="100" class="form-control"/>
                 
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">類型<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="splitscale" id="splitscale_1" value="1" <?php if (!(strcmp($row_RecordScale['splitscale'],"1"))) {echo "checked=\"checked\"";} ?>/>
                <label for="splitscale_1">大磅</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="splitscale" id="splitscale_2" value="0"  <?php if (!(strcmp($row_RecordScale['splitscale'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="splitscale_2">小磅</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片</label>
          <div class="col-md-10">      
          <a href="uplod_scale.php?id_edit=<?php echo $row_RecordScale['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>                    
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" <?php if (!(strcmp($row_RecordScale['indicate'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="indicate_1">上架</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" <?php if (!(strcmp($row_RecordScale['indicate'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="indicate_2">下架</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordScale['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordScale['id']; ?>" />
            <input id="fullIdPath" type="hidden" value="<?php echo $row_RecordScale['type1']; ?>,<?php echo $row_RecordScale['type2']; ?>,<?php echo $row_RecordScale['type3']; ?>" />
            <input name="prepage" type="hidden" id="prepage" value="<?php if(isset($_SERVER['HTTP_REFERER'])) { echo $_SERVER['HTTP_REFERER']; } ?>" />
            <input name="code_old" type="hidden" id="code_old" value="<?php echo $row_RecordScale['code']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Scale" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
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
            'selectbox_action/scale_add.php?&<?php echo time();?>', 
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
                'selectbox_action/scale_add.php?<?php echo time();?>', 
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
mysqli_free_result($RecordScaleListType);

mysqli_free_result($RecordScale);

mysqli_free_result($RecordScaleListSubType);
?>
