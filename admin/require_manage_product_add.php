<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php


// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/product";
	$ppu->extensions = "JPG,PNG,GIF";
	$ppu->formName = "form_Product";
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
  $sip->pathThumb = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/product/thumb";
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
$colname_RecordProductListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordProductListType = $_GET['lang'];
}
$coluserid_RecordProductListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListType = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang=%s && level='0' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colname_RecordProductListType, "text"),GetSQLValueString($coluserid_RecordProductListType, "int"));
$RecordProductListType = mysqli_query($DB_Conn, $query_RecordProductListType) or die(mysqli_error($DB_Conn));
$row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
$totalRows_RecordProductListType = mysqli_num_rows($RecordProductListType);

/* 取得作者列表 */
$colname_RecordProductListBrand = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordProductListBrand = $_GET['lang'];
}
$coluserid_RecordProductListBrand = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListBrand = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListBrand = sprintf("SELECT * FROM demo_productitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordProductListBrand, "text"),GetSQLValueString($coluserid_RecordProductListBrand, "int"));
$RecordProductListBrand = mysqli_query($DB_Conn, $query_RecordProductListBrand) or die(mysqli_error($DB_Conn));
$row_RecordProductListBrand = mysqli_fetch_assoc($RecordProductListBrand);
$totalRows_RecordProductListBrand = mysqli_num_rows($RecordProductListBrand);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
/* 當類別無傳值進來時則給定初始值 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Product")) {
	if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
	if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
	if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Product")) {
  $insertSQL = sprintf("INSERT INTO demo_product (name, type1, type2, type3, pdseries, model, price, spprice, pricecheck, pic, skeyword, sdescription, skeywordindicate, content, postdate, indicate, plot, homeshow, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(htmlspecialchars($_POST['name']), "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
                       GetSQLValueString($_POST['pdseries'], "text"),
                       GetSQLValueString(htmlspecialchars($_POST['model']), "text"),
                       GetSQLValueString($_POST['price'], "int"),
					   GetSQLValueString($_POST['spprice'], "int"),
					   GetSQLValueString($_POST['pricecheck'], "int"),
                       GetSQLValueString($_POST['pic'], "text"),
                       GetSQLValueString(htmlspecialchars($_POST['skeyword']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['sdescription']), "text"),
					   GetSQLValueString($_POST['skeywordindicate'], "int"),
                       GetSQLValueString($_POST['content'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['plot'], "int"),
					   GetSQLValueString($_POST['homeshow'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['notes1']), "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $orderId = mysqli_insert_id($DB_Conn);
  $_POST['aid'] = $orderId;
  
  for($i=0; $i<count($_POST['pic_muti']); $i++) {
	  if($_POST['pic_muti'][$i] != "") {	  
		  $insertSQL = sprintf("INSERT INTO demo_productphoto (aid, sdescription, pic, lang, userid) VALUES (%s, %s, %s, %s, %s)",
								   GetSQLValueString($_POST['aid'], "int"),
								   GetSQLValueString($_POST['sdescription'][$i], "text"),
								   GetSQLValueString($_POST['pic_muti'][$i], "text"),
								   GetSQLValueString($_POST['lang'], "text"),
								   GetSQLValueString($_POST['userid'], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  }
  }
  
  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_product.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManageProductEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageProductEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageProductEditorSelect == '1' || $ManageProductEditorSelect == '2') { ?>
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

<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Product']; ?> <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text" class="form-control" id="name" value="<?php echo @$_COOKIE['Ck_Product_name']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">型號</label>
          <div class="col-md-10">
          
                      <input name="pdseries" type="text" id="pdseries" value="<?php echo @$_COOKIE['Ck_Product_pdseries']; ?>" size="30" maxlength="30" class="form-control" />
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required>
                      <option value="">-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordProductListType['item_id']?>"><?php echo $row_RecordProductListType['itemname']?></option>
                      <?php
} while ($row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType));
  $rows = mysqli_num_rows($RecordProductListType);
  if($rows > 0) {
      mysqli_data_seek($RecordProductListType, 0);
	  $row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
  }
?>
                    </select>
                    
                    <select name="type2" id="type2" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1">-- 選擇分類2 --</option>
                    </select>

                    
                    <select name="type3" id="type3" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1">-- 選擇分類3 --</option>
                    </select>

                    
</div>
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">規格</label>
          <div class="col-md-10">
          
                      <input name="model" type="text" id="model" value="<?php echo @$_COOKIE['Ck_Product_model']; ?>" size="50" maxlength="100" class="form-control"/>
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">價格</label>
          <div class="col-md-10">
                      <input name="price" id="price" value="<?php echo @$_COOKIE['Ck_Product_price']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/><?php if ($OptionCartSelect == '1') {?><small class="f-s-12 text-grey-darker">若不想啟用此商品購物功能，請將價格留空。</small><?php } ?>
                      
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">特惠價</label>
          <div class="col-md-10">
                      <input name="spprice" type="number" id="spprice" value="<?php echo @$_COOKIE['Ck_Product_spprice']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" step="1"/><?php if ($OptionCartSelect == '1') {?><small class="f-s-12 text-grey-darker">若不想啟用此商品購物功能，請將價格留空。</small><?php } ?>
                      
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">主圖片<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="pic" name="pic" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic" required="" />
               <div id="error_pic"></div>
               
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">內頁多圖</label>
          <div class="col-md-10">
               <input id="pic_muti" name="pic_muti[]" type="file" size="50" maxlength="300" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_muti" multiple="multiple"/>
               <div id="error_pic_muti"></div>
               
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標籤<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="plot" id="plot_0" value="0" checked />
                <label for="plot_0">無</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="plot" id="plot_1" value="1"  />
                <label for="plot_1">熱門 <span class="label label-danger">Hot</span></label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="plot" id="plot_2" value="2"  />
                <label for="plot_2">活動 <span class="label label-danger">Act</span></label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="plot" id="plot_3" value="3"  />
                <label for="plot_3">特價 <span class="label label-danger">Sale</span></label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="plot" id="plot_4" value="4"  />
                <label for="plot_4">最新 <span class="label label-danger">New</span></label>
            </div>
            
            
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">首頁顯示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="<?php if ($OptionTmpHomeSelect == '1') { ?>設定此項目可讓此商品顯示於首頁畫面中，若欲顯示請至首頁版型設計中選擇適當模式及啟用。<?php } else { ?>首頁模組尚未啟用。<?php } ?>" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="homeshow" id="homeshow_1" value="1" />
                <label for="homeshow_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="homeshow" id="homeshow_2" value="0" checked/>
                <label for="homeshow_2">不顯示</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="隱藏頁面代表會將該商品做隱藏，此商品將不會出現在商品清單中，但能透過以分享連結的方式來購買此商品，請注意該連結還是會被搜尋引擎所收錄。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">上架</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">下架</label>
            </div>
			<div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_3" value="2" />
                <label for="indicate_3">隱藏頁面</label>
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
          <label class="col-md-2 col-form-label">關鍵字顯示 <i class="fa fa-info-circle text-orange" data-original-title="是否顯示關鍵字於頁面上。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input type="radio" name="skeywordindicate" id="skeywordindicate_1" value="1" checked />
                <label for="skeywordindicate_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="skeywordindicate" id="skeywordindicate_2" value="0" />
                <label for="skeywordindicate_2">隱藏</label>
            </div>
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
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"></textarea>  
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
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="pricecheck" type="hidden" id="pricecheck" value="<?php echo $cartpricecheck; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Product" />
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
            'selectbox_action/product_add.php?&<?php echo time();?>', 
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
                'selectbox_action/product_add.php?<?php echo time();?>', 
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
    /*$('#select3').change(function () {
        alert('主機：' + $('#select1 option:selected').text() + 
              '／類型：' + $('#select2 option:selected').text() +
              '／遊戲：' + $('#select3 option:selected').text());
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
mysqli_free_result($RecordProductListType);

mysqli_free_result($RecordProductListBrand);
?>
