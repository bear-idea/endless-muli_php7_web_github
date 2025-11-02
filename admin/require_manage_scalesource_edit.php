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
$colname_RecordScalesourceListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordScalesourceListType = $_GET['lang'];
}
$coluserid_RecordScalesourceListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScalesourceListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScalesourceListType = sprintf("SELECT * FROM erp_scalesourceitem WHERE list_id = 1 && lang=%s && level='0' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colname_RecordScalesourceListType, "text"),GetSQLValueString($coluserid_RecordScalesourceListType, "int"));
$RecordScalesourceListType = mysqli_query($DB_Conn, $query_RecordScalesourceListType) or die(mysqli_error($DB_Conn));
$row_RecordScalesourceListType = mysqli_fetch_assoc($RecordScalesourceListType);
$totalRows_RecordScalesourceListType = mysqli_num_rows($RecordScalesourceListType);

/* 取得作者列表 */

$colname_RecordScalesource = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordScalesource = $_GET['id_edit'];
}
$coluserid_RecordScalesource = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScalesource = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScalesource = sprintf("SELECT * FROM erp_scalesource WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordScalesource, "int"),GetSQLValueString($coluserid_RecordScalesource, "int"));
$RecordScalesource = mysqli_query($DB_Conn, $query_RecordScalesource) or die(mysqli_error($DB_Conn));
$row_RecordScalesource = mysqli_fetch_assoc($RecordScalesource);
$totalRows_RecordScalesource = mysqli_num_rows($RecordScalesource);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/* 當類別無傳值進來時則給定初始值 */
if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Scalesource")) {
  $updateSQL = sprintf("UPDATE erp_scalesource SET name=%s, code=%s, type1=%s, type2=%s, type3=%s, pdseries=%s, model=%s, indicate=%s, plot=%s, homeshow=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString(htmlspecialchars($_POST['name']), "text"),
					   GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
                       GetSQLValueString($_POST['pdseries'], "text"),
                       GetSQLValueString(htmlspecialchars($_POST['model']), "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['plot'], "int"),
					   GetSQLValueString($_POST['homeshow'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['notes1']), "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";
  $updateGoTo = "manage_scalesource.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageScalesourceEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageScalesourceEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageScalesourceEditorSelect == '1' || $ManageScalesourceEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 貨源物料 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse"> 
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
                      <input name="code" type="text"  class="form-control" id="code" value="<?php echo $row_RecordScalesource['code']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text"  class="form-control" id="name" value="<?php echo $row_RecordScalesource['name']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">型號</label>
          <div class="col-md-10">
          
                      <input name="pdseries" type="text" id="pdseries" value="<?php echo $row_RecordScalesource['pdseries']; ?>" size="30" maxlength="30" class="form-control" />
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="" <?php if (!(strcmp(-1, $row_RecordScalesource['type1']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordScalesourceListType['item_id']?>"<?php if (!(strcmp($row_RecordScalesourceListType['item_id'], $row_RecordScalesource['type1']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordScalesourceListType['itemname']?></option>
                      <?php
} while ($row_RecordScalesourceListType = mysqli_fetch_assoc($RecordScalesourceListType));
  $rows = mysqli_num_rows($RecordScalesourceListType);
  if($rows > 0) {
      mysqli_data_seek($RecordScalesourceListType, 0);
	  $row_RecordScalesourceListType = mysqli_fetch_assoc($RecordScalesourceListType);
  }
?>
                    </select>
                    
                    <select name="type2" id="type2" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordScalesourceListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類2 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordScalesourceListType['item_id']?>"<?php if (!(strcmp($row_RecordScalesourceListType['item_id'], $row_RecordScalesourceListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordScalesourceListType['itemname']?></option>
<?php
} while ($row_RecordScalesourceListType = mysqli_fetch_assoc($RecordScalesourceListType));
  $rows = mysqli_num_rows($RecordScalesourceListType);
  if($rows > 0) {
      mysqli_data_seek($RecordScalesourceListType, 0);
	  $row_RecordScalesourceListType = mysqli_fetch_assoc($RecordScalesourceListType);
  }
?>
            </select>

                    
                    <select name="type3" id="type3" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordScalesourceListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類3 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordScalesourceListType['item_id']?>"<?php if (!(strcmp($row_RecordScalesourceListType['item_id'], $row_RecordScalesourceListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordScalesourceListType['itemname']?></option>
                      <?php
} while ($row_RecordScalesourceListType = mysqli_fetch_assoc($RecordScalesourceListType));
  $rows = mysqli_num_rows($RecordScalesourceListType);
  if($rows > 0) {
      mysqli_data_seek($RecordScalesourceListType, 0);
	  $row_RecordScalesourceListType = mysqli_fetch_assoc($RecordScalesourceListType);
  }
?>
                    </select>
                    <span class="help-block with-errors"></span>
                    
</div>
      </div></div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">規格</label>
          <div class="col-md-10">
          
                      <input name="model" type="text" id="model" value="<?php echo $row_RecordScalesource['model']; ?>" size="50" maxlength="100" class="form-control"/>
                 
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片</label>
          <div class="col-md-10">      
          <a href="uplod_scalesource.php?id_edit=<?php echo $row_RecordScalesource['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>                    
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" <?php if (!(strcmp($row_RecordScalesource['indicate'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="indicate_1">上架</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" <?php if (!(strcmp($row_RecordScalesource['indicate'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="indicate_2">下架</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordScalesource['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordScalesource['id']; ?>" />
            <input id="fullIdPath" type="hidden" value="<?php echo $row_RecordScalesource['type1']; ?>,<?php echo $row_RecordScalesource['type2']; ?>,<?php echo $row_RecordScalesource['type3']; ?>" />
            <input name="prepage" type="hidden" id="prepage" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Scalesource" />
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
            'selectbox_action/scalesource_add.php?&<?php echo time();?>', 
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
                'selectbox_action/scalesource_add.php?<?php echo time();?>', 
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
mysqli_free_result($RecordScalesourceListType);

mysqli_free_result($RecordScalesource);
?>
