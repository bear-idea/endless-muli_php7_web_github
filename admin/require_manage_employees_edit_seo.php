<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/seo";
	$ppu->extensions = "JPG,PNG,GIF";
	$ppu->formName = "form_Employees";
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
  $sip->pathThumb = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/seo/thumb";
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Employees")) {
	
  /* 圖片未更改以原先檔名取代 */
  if($_POST['ogimage'] != ""){ 
  	@unlink($SiteImgFilePathAdmin . $_POST['wshop'] . '/image/seo/' . $_POST['oldpic']);
    @unlink($SiteImgFilePathAdmin . $_POST['wshop'] . '/image/seo/thumb/small_' . GetFileThumbExtend($_POST['oldpic']));
  }else{
	$_POST['ogimage'] = $_POST['oldpic'];
  }
  
  $updateSQL = sprintf("UPDATE demo_employees SET name=%s, sdescription=%s, skeyword=%s, ogtitle=%s, ogtype=%s, ogurl=%s, ogimage=%s, ogdescription=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['sdescription'], "text"),
					   GetSQLValueString($_POST['skeyword'], "text"),
                       GetSQLValueString($_POST['ogtitle'], "text"),
					   GetSQLValueString($_POST['ogtype'], "text"),
					   GetSQLValueString($_POST['ogurl'], "text"),
					   GetSQLValueString($_POST['ogimage'], "text"),
					   GetSQLValueString($_POST['ogdescription'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_employees.php?Opt=seo&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得最新訊息資料 */
$colname_RecordEmployees = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordEmployees = $_GET['id_edit'];
}
$coluserid_RecordEmployees = "-1";
if (isset($w_userid)) {
  $coluserid_RecordEmployees = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployees = sprintf("SELECT * FROM demo_employees WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordEmployees, "int"),GetSQLValueString($coluserid_RecordEmployees, "int"));
$RecordEmployees = mysqli_query($DB_Conn, $query_RecordEmployees) or die(mysqli_error($DB_Conn));
$row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees);
$totalRows_RecordEmployees = mysqli_num_rows($RecordEmployees);
?>

<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 員工管理 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row"><label class="col-md-12 col-form-label d-block d-sm-none"></label><div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本 SEO</span></div></div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="name" type="text" class="form-control" id="name" value="<?php echo $row_RecordEmployees['name']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordEmployees['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordEmployees['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      
      <div class="form-group row"><label class="col-md-12 col-form-label d-block d-sm-none"></label><div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 社群 SEO (Open Graph Tags)</span></div></div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題 <i class="fa fa-info-circle text-orange" data-original-title="og:title 網頁標題或是顯示內容的標題" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="ogtitle" type="text" class="form-control" id="ogtitle" value="<?php echo $row_RecordEmployees['ogtitle']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">類型 <i class="fa fa-info-circle text-orange" data-original-title="og:type 網頁內容的類型 (有 article, book, profile, website, music, video 等類型" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="ogtype" type="text" class="form-control" id="ogtype" value="<?php echo $row_RecordEmployees['ogtype']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">唯一網址 <i class="fa fa-info-circle text-orange" data-original-title="網頁的唯一網址 canonical URL。如果您有手機版和電腦版二個網頁、將二個網頁的og:url設成電腦版的網址，兩個網頁的facebook按讚次數就可以加總統計在一起" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="ogurl" type="url" class="form-control" id="ogurl" value="<?php echo $row_RecordEmployees['ogurl']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">預覽圖 <i class="fa fa-info-circle text-orange" data-original-title="og:image 分享的縮圖 (網頁的預覽圖)" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input id="ogimage" name="ogimage" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_ogimage" />
               <div id="error_ogimage"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述 <i class="fa fa-info-circle text-orange" data-original-title="og:description 網頁內容的簡單說明、建議以二至四句話來說明。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="ogdescription" type="text" class="form-control" id="ogdescription" value="<?php echo $row_RecordEmployees['ogdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordEmployees['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordEmployees['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordEmployees['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordEmployees['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordEmployees['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="oldpic" type="hidden" id="oldpic" value="<?php echo $row_RecordEmployees['ogimage']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Employees" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script>
<?php 
/*
文檔
https://github.com/kartik-v/bootstrap-fileinput/wiki/12.-%E4%B8%80%E4%BA%9B%E6%A0%B7%E4%BE%8B%E4%BB%A3%E7%A0%81
*/
?>
$(document).ready(function() {
	$("#ogimage").fileinput({
		showUpload:true, 
		uploadAsync: false, //设置上传同步异步(true) 此为同步(false)
		//uploadUrl: "index.php", //上传的地址  
		allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文檔後綴
		//resizeImage: true,
		maxImageWidth: 1500,
		maxImageHeight: 1500,
		//resizePreference: 'width',
		//maxFileCount:10,
		maxFileSize: 3000,
		overwriteInitial: true, // 上傳圖片時是否會覆蓋預覽圖  
		showRemove :true, //显示移除按钮
		<?php if($row_RecordEmployees['ogimage'] != "") { ?>
		initialPreview: [<?php echo "'" . $SiteImgUrlAdmin . $wshop ."/image/seo/" . $row_RecordEmployees['ogimage'] .  "'"; ?>],
		initialPreviewConfig: [<?php echo "{url: 'sqldatatable/employees_seophoto_del.php?id_del=".$row_RecordEmployees['id']."', key: ".$row_RecordEmployees['id'].", extra: {id:".$row_RecordEmployees['id']."} }"; ?>],
		<?php } ?>
		initialPreviewAsData: true // 确定你是否仅发送预览数据，而不是原始标记
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
		}).on('filepredelete', function(event, id) {
			//console.log(id);
			//return new Promise(function(resolve, reject) {
			var aborted = !window.confirm("確定删除? 此動作將無法恢復。");
			if (aborted) {	
				return aborted;
			}
			//});
		}).on('filedeleted', function() {
			//setTimeout(function() {
				swal({
                        title: '已刪除',
                        text: '資料刪除成功！',
                        type: 'success',
						buttonsStyling: false,
						confirmButtonText: '確定',
						confirmButtonClass: "btn btn-primary m-5"
                    })
			//}, 900);
		});
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
mysqli_free_result($RecordEmployees);
?>
