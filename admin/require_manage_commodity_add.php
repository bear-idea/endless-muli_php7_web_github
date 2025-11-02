<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/commodity";
	$ppu->extensions = "JPG,PNG,GIF";
	$ppu->formName = "form_Commodity";
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
  $sip->pathThumb = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/commodity/thumb";
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
$colname_RecordCommodityListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCommodityListType = $_GET['lang'];
}
$coluserid_RecordCommodityListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListType = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 1 && lang=%s && level='0' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colname_RecordCommodityListType, "text"),GetSQLValueString($coluserid_RecordCommodityListType, "int"));
$RecordCommodityListType = mysqli_query($DB_Conn, $query_RecordCommodityListType) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListType = mysqli_fetch_assoc($RecordCommodityListType);
$totalRows_RecordCommodityListType = mysqli_num_rows($RecordCommodityListType);

/* 取得作者列表 */
$colname_RecordCommodityListUnit = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCommodityListUnit = $_GET['lang'];
}
$coluserid_RecordCommodityListUnit = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListUnit = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListUnit = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCommodityListUnit, "text"),GetSQLValueString($coluserid_RecordCommodityListUnit, "int"));
$RecordCommodityListUnit = mysqli_query($DB_Conn, $query_RecordCommodityListUnit) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListUnit = mysqli_fetch_assoc($RecordCommodityListUnit);
$totalRows_RecordCommodityListUnit = mysqli_num_rows($RecordCommodityListUnit);

$colname_RecordCommodityListSourcegenre = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCommodityListSourcegenre = $_GET['lang'];
}
$coluserid_RecordCommodityListSourcegenre = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListSourcegenre = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListSourcegenre = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 3 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCommodityListSourcegenre, "text"),GetSQLValueString($coluserid_RecordCommodityListSourcegenre, "int"));
$RecordCommodityListSourcegenre = mysqli_query($DB_Conn, $query_RecordCommodityListSourcegenre) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListSourcegenre = mysqli_fetch_assoc($RecordCommodityListSourcegenre);
$totalRows_RecordCommodityListSourcegenre = mysqli_num_rows($RecordCommodityListSourcegenre);

$colname_RecordCommodityListGenre = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCommodityListGenre = $_GET['lang'];
}
$coluserid_RecordCommodityListGenre = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListGenre = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListGenre = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 4 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCommodityListGenre, "text"),GetSQLValueString($coluserid_RecordCommodityListGenre, "int"));
$RecordCommodityListGenre = mysqli_query($DB_Conn, $query_RecordCommodityListGenre) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListGenre = mysqli_fetch_assoc($RecordCommodityListGenre);
$totalRows_RecordCommodityListGenre = mysqli_num_rows($RecordCommodityListGenre);

$colname_RecordCommodityListCurrency = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCommodityListCurrency = $_GET['lang'];
}
$coluserid_RecordCommodityListCurrency = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListCurrency = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListCurrency = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 5 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCommodityListCurrency, "text"),GetSQLValueString($coluserid_RecordCommodityListCurrency, "int"));
$RecordCommodityListCurrency = mysqli_query($DB_Conn, $query_RecordCommodityListCurrency) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListCurrency = mysqli_fetch_assoc($RecordCommodityListCurrency);
$totalRows_RecordCommodityListCurrency = mysqli_num_rows($RecordCommodityListCurrency);

$coluserid_RecordSupplier = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSupplier = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSupplier = sprintf("SELECT * FROM invoicing_supplier WHERE userid=%s ORDER BY code",GetSQLValueString($coluserid_RecordSupplier, "int"));
$RecordSupplier = mysqli_query($DB_Conn, $query_RecordSupplier) or die(mysqli_error($DB_Conn));
$row_RecordSupplier = mysqli_fetch_assoc($RecordSupplier);
$totalRows_RecordSupplier = mysqli_num_rows($RecordSupplier);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
/* 當類別無傳值進來時則給定初始值 */
if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Commodity")) {
  $insertSQL = sprintf("INSERT INTO invoicing_commodity (code, barcode, name, unit, sourcegenre, genre, sellprice, buyprice, sellpricecurrency, buypricecurrency, type1, type2, type3, supplier, number, pdseries, model, pic, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['barcode'], "text"),
                       GetSQLValueString(htmlspecialchars($_POST['name']), "text"),
                       GetSQLValueString($_POST['unit'], "text"),
                       GetSQLValueString($_POST['sourcegenre'], "text"),
                       GetSQLValueString($_POST['genre'], "text"),
                       GetSQLValueString($_POST['sellprice'], "text"),
                       GetSQLValueString($_POST['buyprice'], "text"),
                       GetSQLValueString($_POST['sellpricecurrency'], "text"),
                       GetSQLValueString($_POST['buypricecurrency'], "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
					   GetSQLValueString($_POST['supplier'], "text"),
					   GetSQLValueString($_POST['suppliernumber'], "text"),
                       GetSQLValueString($_POST['pdseries'], "text"),
                       GetSQLValueString(htmlspecialchars($_POST['model']), "text"),
                       GetSQLValueString($_POST['pic'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['notes1']), "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_commodity.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManageCommodityEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageCommodityEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageCommodityEditorSelect == '1' || $ManageCommodityEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 產品管理 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">產品編號<span class="text-red">*</span></label>
          <div class="col-md-8">
                      <input name="code" type="text" class="form-control" id="code"  maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
		  <div class="col-md-2">
                      <?php require("require_manage_commodity_model_codegeneral.php"); ?>             
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">條碼編號</label>
          <div class="col-md-10">
                      <input name="barcode" type="text" class="form-control" id="barcode"  maxlength="200" data-parsley-trigger="blur" />
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">品名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text" class="form-control" id="name" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">庫存單位<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="unit" id="unit" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇庫存單位 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordCommodityListUnit['itemname']?>"><?php echo $row_RecordCommodityListUnit['itemname']?></option>
											  <?php
						} while ($row_RecordCommodityListUnit = mysqli_fetch_assoc($RecordCommodityListUnit));
						  $rows = mysqli_num_rows($RecordCommodityListUnit);
						  if($rows > 0) {
							  mysqli_data_seek($RecordCommodityListUnit, 0);
							  $row_RecordCommodityListUnit = mysqli_fetch_assoc($RecordCommodityListUnit);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">型號</label>
          <div class="col-md-10">
          
                      <input name="pdseries" type="text" id="pdseries" value="<?php echo $_COOKIE['Ck_Commodity_pdseries']; ?>" size="30" maxlength="30" class="form-control" />
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                  
                    
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required>
                      <option value="">-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordCommodityListType['item_id']?>"><?php echo $row_RecordCommodityListType['itemname']?></option>
                      <?php
} while ($row_RecordCommodityListType = mysqli_fetch_assoc($RecordCommodityListType));
  $rows = mysqli_num_rows($RecordCommodityListType);
  if($rows > 0) {
      mysqli_data_seek($RecordCommodityListType, 0);
	  $row_RecordCommodityListType = mysqli_fetch_assoc($RecordCommodityListType);
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
      <div class="form-group row">
        <label class="col-md-2 col-form-label">來源類型<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="sourcegenre" id="sourcegenre" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇來源類型 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordCommodityListSourcegenre['itemname']?>"><?php echo $row_RecordCommodityListSourcegenre['itemname']?></option>
											  <?php
						} while ($row_RecordCommodityListSourcegenre = mysqli_fetch_assoc($RecordCommodityListSourcegenre));
						  $rows = mysqli_num_rows($RecordCommodityListSourcegenre);
						  if($rows > 0) {
							  mysqli_data_seek($RecordCommodityListSourcegenre, 0);
							  $row_RecordCommodityListSourcegenre = mysqli_fetch_assoc($RecordCommodityListSourcegenre);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">類型<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="genre" id="genre" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇類型 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordCommodityListGenre['itemname']?>"><?php echo $row_RecordCommodityListGenre['itemname']?></option>
											  <?php
						} while ($row_RecordCommodityListGenre = mysqli_fetch_assoc($RecordCommodityListGenre));
						  $rows = mysqli_num_rows($RecordCommodityListGenre);
						  if($rows > 0) {
							  mysqli_data_seek($RecordCommodityListGenre, 0);
							  $row_RecordCommodityListGenre = mysqli_fetch_assoc($RecordCommodityListGenre);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">供應廠商</label>
          <div class="col-md-10">
                    <select name="supplier" id="supplier" class="form-control" data-parsley-trigger="blur" >
                      <option value="">-- 選擇供應廠商 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordSupplier['name']?>"><?php echo $row_RecordSupplier['code']?> <?php echo $row_RecordSupplier['name']?></option>
											  <?php
						} while ($row_RecordSupplier = mysqli_fetch_assoc($RecordSupplier));
						  $rows = mysqli_num_rows($RecordSupplier);
						  if($rows > 0) {
							  mysqli_data_seek($RecordSupplier, 0);
							  $row_RecordSupplier = mysqli_fetch_assoc($RecordSupplier);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">廠商品號</label>
          <div class="col-md-10">
                      <input name="suppliernumber" type="text" class="form-control" id="suppliernumber"  maxlength="100" data-parsley-trigger="blur" />
                      
        </div>
      </div>
      <div class="form-group row" style="display:none;">
        <label class="col-md-2 col-form-label">售價<span class="text-red">*</span></label>
          <div class="col-md-2">
          		    <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">幣別</span></span>
                    <select name="sellpricecurrency" id="sellpricecurrency" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇幣別 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordCommodityListCurrency['itemname']?>"><?php echo $row_RecordCommodityListCurrency['itemname']?></option>
											  <?php
						} while ($row_RecordCommodityListCurrency = mysqli_fetch_assoc($RecordCommodityListCurrency));
						  $rows = mysqli_num_rows($RecordCommodityListCurrency);
						  if($rows > 0) {
							  mysqli_data_seek($RecordCommodityListCurrency, 0);
							  $row_RecordCommodityListCurrency = mysqli_fetch_assoc($RecordCommodityListCurrency);
						  }
						?>
                    </select>
                    </div>
                    
 
                   
</div>
	  <div class="col-md-3" style="display:none;">
                      <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">價格</span></span>
                      <input name="sellprice" class="form-control" id="sellprice"  maxlength="11" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="0.01" />
                      </div>
                      
        </div>
      </div>
      <div class="form-group row" style="display:none;">
        <label class="col-md-2 col-form-label">進價<span class="text-red">*</span></label>
          <div class="col-md-2">
                    <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">幣別</span></span>
                    <select name="buypricecurrency" id="buypricecurrency" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇幣別 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordCommodityListCurrency['itemname']?>"><?php echo $row_RecordCommodityListCurrency['itemname']?></option>
											  <?php
						} while ($row_RecordCommodityListCurrency = mysqli_fetch_assoc($RecordCommodityListCurrency));
						  $rows = mysqli_num_rows($RecordCommodityListCurrency);
						  if($rows > 0) {
							  mysqli_data_seek($RecordCommodityListCurrency, 0);
							  $row_RecordCommodityListCurrency = mysqli_fetch_assoc($RecordCommodityListCurrency);
						  }
						?>
                    </select>
                    </div>
                    
 
                   
</div>
	  <div class="col-md-3" style="display:none;">
                      <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">價格</span></span>
                      <input name="buyprice" class="form-control" id="buyprice"  maxlength="11" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="0.01" />
                      </div>
                      
        </div>
      </div>
      <div class="form-group row" style="display:none;">
          <label class="col-md-2 col-form-label">規格</label>
          <div class="col-md-10">
          
                      <input name="model" type="text" id="model" value="<?php echo $_COOKIE['Ck_Commodity_model']; ?>" size="50" maxlength="100" class="form-control"/>
                 
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片</label>
          <div class="col-md-10">
               <input id="pic" name="pic" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic" />
               <div id="error_pic"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">上架</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">下架</label>
            </div>
             
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
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Commodity" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
<?php 
/*
文檔
https://github.com/kartik-v/bootstrap-fileinput/wiki/12.-%E4%B8%80%E4%BA%9B%E6%A0%B7%E4%BE%8B%E4%BB%A3%E7%A0%81
*/
?>
$(document).ready(function() {
	$("#pic").fileinput({
		showUpload:true, 
		uploadAsync: false, //设置上传同步异步 此为同步
		//uploadUrl: "index.php", //上传的地址  
		allowedFileExtensions: ["jpg"],
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
<!--<script type="text/javascript">
	function Ajax_codegenerate()
	{
		//$('#code').val() = $('#type1').val();
		$.ajax({
                  type :"GET",
                  url  : "ajax/clientele_code.php",
                  data : { 
                      type1 : $("#type1").val(),
					  type2 : $("#type2").val(),
					  type3 : $("#type3").val(),
					  unit : $("#unit").val(),
					  sourcegenre : $("#sourcegenre").val(),
					  genre : $("#genre").val(),
					  supplier : $("#supplier").val(),
                      },
                  dataType: "text",
                  success : function(msg) { 
					  //alert(msg);
					  $("#code").val(msg);
              }
        })
	}
</script>-->
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
            'selectbox_action/commodity_add.php?&<?php echo time();?>', 
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
                'selectbox_action/commodity_add.php?<?php echo time();?>', 
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
mysqli_free_result($RecordCommodityListType);

mysqli_free_result($RecordCommodityListUnit);

mysqli_free_result($RecordCommodityListSourcegenre);

mysqli_free_result($RecordCommodityListGenre);

mysqli_free_result($RecordCommodityListCurrency);

mysqli_free_result($RecordSupplier);
?>
