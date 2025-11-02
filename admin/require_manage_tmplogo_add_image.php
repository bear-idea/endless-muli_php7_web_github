<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['webname'] . "/logo";
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	$ppu->formName = "form_Frilink";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "2000";
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
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogoListType = "SELECT * FROM demo_tmpitem WHERE list_id = 6";
$RecordTmpLogoListType = mysqli_query($DB_Conn, $query_RecordTmpLogoListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType);
$totalRows_RecordTmpLogoListType = mysqli_num_rows($RecordTmpLogoListType);

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_TmpLogo")) {
  $insertSQL = sprintf("INSERT INTO demo_tmplogo (name, type, logotype, logoimage, logoimage_cn, logoimage_en, logoimage_jp, logoimage_kr, logoimage_sp, width, height, notes1, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['logotype'], "int"),
					   GetSQLValueString($_POST['logoimage'], "text"),
					   GetSQLValueString($_POST['logoimage_cn'], "text"),
					   GetSQLValueString($_POST['logoimage_en'], "text"),
					   GetSQLValueString($_POST['logoimage_jp'], "text"),
					   GetSQLValueString($_POST['logoimage_kr'], "text"),
					   GetSQLValueString($_POST['logoimage_sp'], "text"),
					   GetSQLValueString($_POST['width'], "text"),
					   GetSQLValueString($_POST['height'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_tmp.php?Opt=logoviewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php //echo $defaultlang ?>
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> Logo <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text" class="form-control" id="name" maxlength="50" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
            <select name="type" id="type" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordTmpLogoListType['itemname']?>"><?php echo $row_RecordTmpLogoListType['itemname']?></option>
                      <?php
} while ($row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType));
  $rows = mysqli_num_rows($RecordTmpLogoListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpLogoListType, 0);
	  $row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType);
  }
?>
                    </select>
          </div>
</div>
      </div>
      
      <?php if ($LangChooseZHTW == 1 || $defaultlang == 'zh-tw') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【繁體】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="logoimage" name="logoimage" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_tw" required="" />
               <div id="error_pic_tw"></div>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseZHCN == 1 || $defaultlang == 'zh-cn') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【简体】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="logoimage_cn" name="logoimage_cn" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_cn" required="" />
               <div id="error_pic_cn"></div>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseEN == 1 || $defaultlang == 'en') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【English】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="logoimage_en" name="logoimage_en" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_en" required="" />
               <div id="error_pic_en"></div>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseJP == 1  || $defaultlang == 'jp') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【日本語】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="logoimage_jp" name="logoimage_jp" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_jp" required="" />
               <div id="error_pic_jp"></div>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseKR == 1  || $defaultlang == 'kr') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【한국어】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="logoimage_kr" name="logoimage_kr" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_kr" required="" />
               <div id="error_pic_kr"></div>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseSP == 1  || $defaultlang == 'sp') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【Español】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="logoimage_sp" name="logoimage_sp" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_sp" required="" />
               <div id="error_pic_sp"></div>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               
          </div>
      </div>
      <?php } ?>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片寬度<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="width" data-parsley-min="0" type="number" data-parsley-type="number" class="form-control" id="width" maxlength="4" data-parsley-trigger="blur" required=""/>
                      
                      <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前寬度以圖片<?php if($defaultlang == "zh-tw") {echo "【繁體】";}elseif($defaultlang == "zh-cn"){echo "【简体】";}elseif($defaultlang == "en"){echo "【English】";}elseif($defaultlang == "jp"){echo "【日本語】";}elseif($defaultlang == "en"){echo "【English】";}elseif($defaultlang == "kr"){echo "【日本語】";}elseif($defaultlang == "en"){echo "【한국어】";}elseif($defaultlang == "sp"){echo "【Español】";} ?>為準。</b></div>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片高度<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="height" data-parsley-min="0" type="number" data-parsley-type="number" class="form-control" id="height" maxlength="4" data-parsley-trigger="blur" required=""/>
                      
                      <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前高度以圖片<?php if($defaultlang == "zh-tw") {echo "【繁體】";}elseif($defaultlang == "zh-cn"){echo "【简体】";}elseif($defaultlang == "en"){echo "【English】";}elseif($defaultlang == "jp"){echo "【日本語】";}elseif($defaultlang == "kr"){echo "【한국어】";}elseif($defaultlang == "sp"){echo "【Español】";} ?>為準。</b></div>
                      
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
            <input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" />
            <input name="logotype" type="hidden" id="logotype" value="0" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_TmpLogo" />
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
	$("#logoimage").fileinput({
		showUpload:true, 
		uploadAsync: false, //设置上传同步异步 此为同步
		//uploadUrl: "index.php", //上传的地址  
		allowedFileExtensions: ["jpg", "png", "gif"],
		//resizeImage: true,
		maxImageWidth: 1500,
		maxImageHeight: 1500,
		//resizePreference: 'width',
		maxFileSize: 2000,  
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
	});
});
</script>

<script type="text/javascript">
<?php // 取得圖片預覽 ?>
$(document).ready(function() {
// var url = window.URL || window.webkitURL; // alternate use
function readImage(file) {
  
    var reader = new FileReader();
    var image  = new Image();
  
    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
		//console.log(image.src);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
            //$('#uploadPreview').html('<img src="'+ this.src +'"> '+w+'x'+h+' '+s+' '+t+' '+n+'<br>');
			//$('#uploadPreview').html('<div style="background-color:#FFF; padding:10px;"><img src="'+ this.src +'"> '+'<br/>'+w+'x'+h+' '+s+' '+'</div>');
		    $("#width").val(w); // 自動填入寬度
            $("#height").val(h); // 自動填入高度
			//$( "#uploadPreview" ).draggable(); // 使此區塊可拖曳
        };
        image.onerror= function() {
			if(file.type == "application/x-shockwave-flash")
			{
			}else{
					alert('Invalid file type: '+ file.type);
			}  
        };      
    };
    
}
$("#logoimage<?php if($defaultlang == "zh-tw") {echo "";}elseif($defaultlang == "zh-cn"){echo "_cn";}elseif($defaultlang == "en"){echo "_en";}elseif($defaultlang == "jp"){echo "_jp";} ?>").change(function (e) { // 上傳檔案的ID
    if(this.disabled) return alert('File upload not supported!');
    var F = this.files;
    if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i] );
});
});  
</script>

<?php
mysqli_free_result($RecordTmpLogoListType);
?>
