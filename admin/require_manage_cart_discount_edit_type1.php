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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Discount")) {
  $updateSQL = sprintf("UPDATE demo_productdiscount SET name=%s, discountPieces=%s, discountFoldnumber=%s, startdate=%s, enddate=%s, limitdate=%s, skeyword=%s, sdescription=%s, content=%s, menuname=%s, menuindicate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['discountPieces'], "int"),
					   GetSQLValueString($_POST['discountFoldnumber'], "int"),
					   GetSQLValueString($_POST['startdate'], "date"),
					   GetSQLValueString($_POST['enddate'], "date"),
					   GetSQLValueString($_POST['limitdate'], "int"),
					   GetSQLValueString(htmlspecialchars($_POST['skeyword']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['sdescription']), "text"),
                       GetSQLValueString($_POST['content'], "text"),
					   GetSQLValueString($_POST['menuname'], "text"),
					   GetSQLValueString($_POST['menuindicate'], "int"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";
  
  /* 刪除購物清單 */
  $colname_RecordCart = "-1";
  if (isset($_POST['id'])) {
	$colname_RecordCart = $_POST['id'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordCart = sprintf("SELECT * FROM demo_cart WHERE pid = %s", GetSQLValueString($colname_RecordCart, "int"));
  $RecordCart = mysqli_query($DB_Conn, $query_RecordCart) or die(mysqli_error($DB_Conn));
  $row_RecordCart = mysqli_fetch_assoc($RecordCart);
  $totalRows_RecordCart = mysqli_num_rows($RecordCart);
  if($totalRows_RecordCart > 0) {
  do { 
	 $deleteSQL = sprintf("DELETE FROM demo_cart WHERE id=%s",
				   GetSQLValueString($row_RecordCart['id'], "int"));
	 $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  } while ($row_RecordCart = mysqli_fetch_assoc($RecordCart));
  }

  $updateGoTo = "manage_cart.php?Opt=discount&lang=" . $_POST['lang'] . "&type=" . $_POST['type'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordDiscount = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordDiscount = $_GET['id_edit'];
}
$coluserid_RecordDiscount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDiscount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDiscount = sprintf("SELECT * FROM demo_productdiscount WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordDiscount, "int"),GetSQLValueString($coluserid_RecordDiscount, "int"));
$RecordDiscount = mysqli_query($DB_Conn, $query_RecordDiscount) or die(mysqli_error($DB_Conn));
$row_RecordDiscount = mysqli_fetch_assoc($RecordDiscount);
$totalRows_RecordDiscount = mysqli_num_rows($RecordDiscount);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageNewsEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageNewsEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<script src="assets/plugins/masked-input/masked-input.min.js"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 滿件折扣(%) <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="折扣顯示名稱。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          
                      <input name="name" type="text" required="" class="form-control" id="name" autocomplete="off" value="<?php echo $row_RecordDiscount['name']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">折扣方式<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="例如:80代表8折/10代表1折。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
                  <div class="input-group p-0">
                    <div class="input-group-prepend"><span class="input-group-text">滿</span></div>
                    <select name="discountPieces" id="discountPieces" class="form-control" data-parsley-trigger="blur" required="">
                      <?php for($i=1; $i<=10; $i++) { ?>
                      <option value="<?php echo $i; ?>" <?php if (!(strcmp($i, $row_RecordDiscount['discountPieces']))) {echo "selected=\"selected\"";} ?>><?php echo $i; ?></option>
                      <?php } ?>
				    </select>
                    <div class="input-group-append"><span class="input-group-text">件</span></div> 
                  </div>
          </div>
          <div class="col-md-2">
                  <div class="input-group p-0">
                    <div class="input-group-prepend"><span class="input-group-text">打</span></div>
                    <select name="discountFoldnumber" id="discountFoldnumber" class="form-control" data-parsley-trigger="blur" required="">
                      <?php for($i=10; $i<=99; $i++) { ?>
                      <option value="<?php echo $i; ?>" <?php if (!(strcmp($i, $row_RecordDiscount['discountFoldnumber']))) {echo "selected=\"selected\"";} ?>><?php echo $i; ?></option>
                      <?php } ?>
				    </select>
                    <div class="input-group-append"><span class="input-group-text">折</span></div> 
                  </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordDiscount['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordDiscount['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="您可設定此項目來限制使用者是否可瀏覽此資料。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" <?php if (!(strcmp($row_RecordDiscount['indicate'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="indicate_1">上架</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" <?php if (!(strcmp($row_RecordDiscount['indicate'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="indicate_2">下架</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">限制時間<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="limitdate" id="limitdate_1" value="1" onclick="return checklimitdateradio();" <?php if (!(strcmp($row_RecordDiscount['limitdate'],"1"))) {echo "checked=\"checked\"";} ?>/>
                <label for="limitdate_1">限制</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="limitdate" id="limitdate_2" value="0" onclick="return checklimitdateradio();" <?php if (!(strcmp($row_RecordDiscount['limitdate'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="limitdate_2">永久</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row" style="display:none;" id="Limitdate_range">
          <label class="col-md-2 col-form-label">日期範圍<span class="text-red">*</span></label>
          <div class="col-md-10">
              <div class="input-group input-daterange">
                  <input name="startdate" type="text" class="form-control" id="startdate" autocomplete="off" value="<?php $dt = new DateTime($row_RecordDiscount['startdate']); echo $dt->format('Y-m-d'); ?>" data-parsley-trigger="blur" data-date-language="zh-TW" data-provide="datepicker" data-date-format="yyyy-mm-dd"/>
                  <span class="input-group-addon">to</span>
                  <input name="enddate" type="text" class="form-control" id="enddate" autocomplete="off" value="<?php $dt = new DateTime($row_RecordDiscount['enddate']); echo $dt->format('Y-m-d'); ?>" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-parsley-trigger="blur" data-date-language="zh-TW"/> 
              </div>
              
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">選單名稱<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="顯示選單連結名稱，顯示於商品分類上。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          
                      <input name="menuname" type="text" required="" class="form-control" id="menuname" autocomplete="off" value="<?php echo $row_RecordDiscount['menuname']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">選單顯示<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="menuindicate" id="menuindicate_1" value="1" <?php if (!(strcmp($row_RecordDiscount['menuindicate'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="menuindicate_1">是</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="menuindicate" id="menuindicate_2" value="0" <?php if (!(strcmp($row_RecordDiscount['menuindicate'],"0"))) {echo "checked=\"checked\"";} ?> />
                <label for="menuindicate_2">否</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">說明抬頭 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"><?php echo $row_RecordDiscount['content']; ?></textarea>  
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文繞圖</label>
          <div class="col-md-10">
                <input type="image" src="images/tmp_smp_00.jpg" id="change_tmp00" onclick="return false" style="margin-right:5px;">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordDiscount['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordNews['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDiscount['id']; ?>" />
            <input name="type" type="hidden" id="type" value="0" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Discount" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script>
function CheckFields()
{	
	if($('input[name=limitdate]:checked').val() == "1") {
		//alert("限制");
		if($("#startdate").val() == "" || $("#enddate").val() == "")
		{
			alert("開始時間或結束時間未填寫！！");
			return false;
		}
	}
	return true;
}
</script>

<script type="text/javascript">
	$(document).ready(function() {
			$("#change_tmp00").click(function(){
					CKEDITOR.instances.content.setData("<p style=\"text-align:center\"><img alt=\"\" height=\"auto\" src=\"images/discountpage1.jpg\" style=\"display: block; margin: auto;\" width=\"100%\" /></p>");
			});
	});
</script>

<script type="text/javascript">
<?php if($row_RecordDiscount['limitdate'] == '1') { ?>
$("#Limitdate_range").css("display","");
<?php } ?>
function checklimitdateradio(){ 
	if($('input[name=limitdate]:checked').val() == "0") {
		//alert("不限制");
		$("#Limitdate_range").slideToggle();
		//$("#Limitdate_end").slideToggle();
	}
	if($('input[name=limitdate]:checked').val() == "1") {
		//alert("限制");
		$("#Limitdate_range").slideToggle();
		//$("#Limitdate_end").slideToggle();
	}
}

</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.input-daterange').datepicker({
			language: "zh-TW",
			todayHighlight: true,
			format: 'yyyy-mm-dd'
 	    });  
  
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
		
		/*$('#startdate, #endtdate').datepicker({
		    }).on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); */
	});
</script>