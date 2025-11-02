<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/tmpmainmenu";
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	$ppu->formName = "form_TmpMainMenu";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "3000";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "false";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "3500";
	$ppu->maxHeight = "3500";
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
$query_RecordTmpMainMenuListType = "SELECT * FROM demo_tmpitem WHERE list_id = 5";
$RecordTmpMainMenuListType = mysqli_query($DB_Conn, $query_RecordTmpMainMenuListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenuListType = mysqli_fetch_assoc($RecordTmpMainMenuListType);
$totalRows_RecordTmpMainMenuListType = mysqli_num_rows($RecordTmpMainMenuListType);

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_TmpMainMenu")) {
  $insertSQL = sprintf("INSERT INTO demo_tmpmainmenu (name, type, tmp_mainmenu_l_img, tmp_mainmenu_r_img, tmp_mainmenu_o_img, tmp_mainmenu_location, tmp_mainmenupic_height, tmp_mainmenu_font_size, tmp_mainmenu_font_style, tmp_mainmenu_color, tmp_mainmenu_width, tmp_mainmenu_img, tmp_mainmenu_hovercolor, tmp_mainmenu_hover_img, notes1, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_l_img'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_r_img'], "text"),
					   GetSQLValueString($_POST['tmp_mainmenu_o_img'], "text"),
					   GetSQLValueString($_POST['tmp_mainmenu_location'], "int"),
                       GetSQLValueString($_POST['tmp_mainmenupic_height'], "int"),
                       GetSQLValueString($_POST['tmp_mainmenu_font_size'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_font_style'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_color'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_width'], "int"),
                       GetSQLValueString($_POST['tmp_mainmenu_img'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_hovercolor'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_hover_img'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['userid'], "id"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Add'] = "Success";
  
  $insertGoTo = "manage_tmp.php?Opt=tmpmainmenu&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<style type="text/css">
#apDiv_config {
	position: fixed;
	width: 300px;
	height: 80px;
	z-index: 1;
	float: right;
	right: 0px;
	top: 150px;
}
#wrapper_config div #apDiv_config div span a {
	color: #1C590D;
	font-size: 9px;
}
#show_config tr td{
	border: 1px dotted #DDD;
	font-size: 9px;
}
#mainmenu_l{
	color: #CCC; font-size: 30px; font-weight: bolder; position: absolute; left: 5px; top: 5px; border: #CCC dotted 1px; width: 30px; height: 88px; margin-top:auto; margin-bottom:auto;
}
#mainmenu_l:hover{
	border: 1px dotted #C30;
}
#mainmenu_r{
	color: #CCC; font-size: 30px; font-weight: bolder; position: absolute; left: 355px; top: 5px; border: #CCC dotted 1px; width: 30px; height: 88px; margin-top:auto; margin-bottom:auto;
}
#mainmenu_r:hover{
	border: 1px dotted #C30;
}
#mainmenu_m{
	position:relative; left:35px; height:88px;
}

#mainmenu_m:hover .mainmenu_m_block1, #mainmenu_m:hover .mainmenu_m_block2, #mainmenu_m:hover .mainmenu_m_block3{
	border: 1px dotted #C30;
}
.mainmenu_m_block1{
	color: #CCC; font-size: 30px; font-weight: bolder; position: absolute; left: 0px; border: #CCC dotted 1px; width: 100px; height: 88px; margin-top:auto; margin-bottom:auto;
}
.mainmenu_m_block2{
	color: #CCC; font-size: 30px; font-weight: bolder; position: absolute; left: 105px; border: #CCC dotted 1px; width: 100px; height: 88px; margin-top:auto; margin-bottom:auto;
}
.mainmenu_m_block3{
	color: #CCC; font-size: 30px; font-weight: bolder; position: absolute; left: 210px; border: #CCC dotted 1px; width: 100px; height: 88px; margin-top:auto; margin-bottom:auto;
}
</style>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 主選單 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text" class="form-control" id="name" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
          <option value="">-- 選擇分類 --</option>
          <?php
				do {  
				?>
          <option value="<?php echo $row_RecordTmpMainMenuListType['itemname']?>"><?php echo $row_RecordTmpMainMenuListType['itemname']?></option>
          <?php
				} while ($row_RecordTmpMainMenuListType = mysqli_fetch_assoc($RecordTmpMainMenuListType));
				  $rows = mysqli_num_rows($RecordTmpMainMenuListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordTmpMainMenuListType, 0);
					  $row_RecordTmpMainMenuListType = mysqli_fetch_assoc($RecordTmpMainMenuListType);
				  }
				?>
        </select>
                    
                    
</div>
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">結構</label>
          <div class="col-md-10">
          <div class="table-responsive">
                  <div style="border:1px #CCCCCC dotted; width:810px; margin:5px;position:relative; height:280px;">
      
      <div style="position: absolute; left: 395px; top: 111px;"><img src="images/z_line_c.png" alt="" width="36" height="1" /></div>
      <div style="position:relative; top:100px; left:10px; padding:5px;border: #CCC dotted 1px; height:90px; width:382px; margin-left:0px;; margin-right:auto; margin-top:auto; margin-bottom:auto; background-image:url(images/mainmenu_wp.jpg);">
      	<div id="mainmenu_l"></div>
        <div id="mainmenu_m">
          <div class="mainmenu_m_block1"></div>
        <div class="mainmenu_m_block2"></div>
        <div class="mainmenu_m_block3"></div>
        </div>
        <div id="mainmenu_r"></div>
      </div>
      
      <div style="padding: 5px; position: absolute; left: 79px; top: 33px; width: 700px;" id="Step_M2">
      	<div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">選單列底圖<span class="text-red">*</span> <i class="fa fa-info-circle text-black" data-original-title="若您要製作無底圖的選單您可上傳透明的圖片。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <input id="tmp_mainmenu_img" name="tmp_mainmenu_img" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_mainmenu_img" required=""/>
              <div id="error_tmp_mainmenu_img"></div>
          </div>
      </div>
      <div style="padding: 5px; position: absolute; left: 79px; top: -3px; width: 700px;" id="Step_M1">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">選單列底圖(滑鼠移入)<span class="text-red">*</span> <i class="fa fa-info-circle text-black" data-original-title="若您要製作無底圖的選單您可上傳透明的圖片。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <input id="tmp_mainmenu_hover_img" name="tmp_mainmenu_hover_img" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_mainmenu_hover_img" required=""/>
              <div id="error_tmp_mainmenu_hover_img"></div>
          </div>
      </div>
      
      <div style="padding: 5px; position: absolute; left: 79px; top: 69px; width: 701px;">
      
              <div class="input-group p-0 width-200 pull-left">
            
              	  <div class="input-group-prepend"><span class="input-group-text">圖片寬度<span class="text-red">*</span></span></div>
                  <input name="tmp_mainmenu_width" class="form-control" id="tmp_mainmenu_width" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" value="100" required=""/>
                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
              </div>
              
              <div class="input-group p-0 width-200 pull-left m-l-2">
            
              	  <div class="input-group-prepend"><span class="input-group-text">圖片高度<span class="text-red">*</span></span></div>
                  <input name="tmp_mainmenupic_height" class="form-control" id="tmp_mainmenupic_height" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" value="50" required=""/>
                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
              </div>
    
      </div>
      
      <div style="padding: 5px; position: absolute; left: 46px; top: 207px; width: 700px;" id="Step_M3">
      	
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">左側圖片 <i class="fa fa-info-circle text-black" data-original-title="可不選擇，此為設定您選單的左側圖片。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <input id="tmp_mainmenu_l_img" name="tmp_mainmenu_l_img" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_mainmenu_l_img"/>
              <div id="error_tmp_mainmenu_l_img"></div>
          </div>
        
      </div>
      
      <div style="padding: 5px; position: absolute; left: 429px; top: 142px; width: 700px;" id="Step_M4">
      	
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">右側圖片 <i class="fa fa-info-circle text-black" data-original-title="可不選擇，此為設定您選單的右側圖片。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <input id="tmp_mainmenu_r_img" name="tmp_mainmenu_r_img" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_mainmenu_r_img"/>
              <div id="error_tmp_mainmenu_r_img"></div>
          </div>
        
      </div>
      
      
      <div style="padding: 5px; position: absolute; left: 445px; top: 105px; width: 700px;" id="Step_M5">
      	
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">底層背景 <i class="fa fa-info-circle text-black" data-original-title="可不選擇，此背景為水平重複排列並且寬度為目前版面寬度。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <input id="tmp_mainmenu_o_img" name="tmp_mainmenu_o_img" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_mainmenu_o_img"/>
              <div id="error_tmp_mainmenu_o_img"></div>
          </div>
        
      </div>
      
      <div style="position: absolute; left: 60px; top: 21px;"><img src="images/z_line_a.png" alt="" width="18" height="120" /></div>
      <div style="position: absolute; left: 29px; top: 167px;"><img src="images/z_line_b.png" alt="" width="16" height="60" /></div>
      <div style="position: absolute; left: 387px; top: 158px;"><img src="images/z_line_c.png" alt="" width="36" height="1" /></div>
      
      
      
      
      
      </div>   
                 </div>
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">選單位置<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="當您選擇《依據版面樣板位置》代表您可以在樣板中設定此選單的X軸和Y軸方向，您可以將您的選單設定到任何位置；當您選擇《將主選單置於頁首區塊和橫幅區塊之間》則代表此選單會固定在這兩區塊之間，高度則為您上傳的《選單列底圖》高度並且建議配合《底層背景》圖片作上傳當作此選單的底圖背景。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="tmp_mainmenu_location" id="tmp_mainmenu_location_2" value="0" checked="checked"/>
                <label for="tmp_mainmenu_location_2">依據版面樣版位置</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="tmp_mainmenu_location" id="tmp_mainmenu_location_1" value="1" />
                <label for="tmp_mainmenu_location_1">將主選單置於頁首區塊和橫幅區塊之間</label>
            </div>
            
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字大小<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
         <select name="tmp_mainmenu_font_size" id="tmp_mainmenu_font_size" class="form-control">
        <option value="9px" >9px</option>
          <option value="10px" >10px</option>
          <option value="11px" >11px</option>
          <option value="12px" >12px</option>
          <option value="13px" >13px</option>
          <option value="14px" >14px</option>
          <option value="16px" >16px</option>
          <option value="18px" >18px</option>
          <option value="xx-small" >xx-small</option>
          <option value="x-small" >x-small</option>
          <option value="small" selected="selected" >small</option>
          <option value="medium" >medium</option>
          <option value="large" >large</option>
        </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字樣式<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
         <select name="tmp_mainmenu_font_style" id="tmp_mainmenu_font_style" class="form-control">
          <option value="normal" selected="selected">標準</option>
          <option value="bold">粗體</option>
          <option value="bolder">粗體(+)</option>
        </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_mainmenu_color" type="text" required class="form-control colorpicker-element" id="tmp_mainmenu_color" value="#000000" maxlength="20" data-parsley-errors-container="#error_tmp_mainmenu_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_mainmenu_color"></div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色(滑鼠移入)<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_mainmenu_hovercolor" type="text" required class="form-control colorpicker-element" id="tmp_mainmenu_hovercolor" value="#DB6D00" maxlength="20" data-parsley-errors-container="#error_tmp_mainmenu_hovercolor" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_mainmenu_hovercolor"></div>
                      
                 
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
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_TmpMainMenu" />
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
	$("#tmp_mainmenu_hover_img, #tmp_mainmenu_img, #tmp_mainmenu_o_img, #tmp_mainmenu_l_img, #tmp_mainmenu_r_img").fileinput({
		showUpload:true, 
		showPreview: false,
		uploadAsync: false, //设置上传同步异步 此为同步
		//uploadUrl: "index.php", //上传的地址
		//showCaption: false, 
		dropZoneEnabled: false,
		
		allowedFileExtensions: ["jpg","png","jpeg","gif"],
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
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip',
                intro: '<img src="images/tip/tip079.jpg" width="339" height="154" /><br /><br />設計一選單將圖拆成四個部分上傳。'
              },
			  {
                element: '#Step_Tip',
                intro: '<img src="images/tip/tip080.jpg" width="300" height="117" /><br /><br />注意選單列底圖的圖片要設計成能水平重複排列。'
              },
			  {
                element: '#Step_Tip',
                intro: '<img src="images/tip/tip081.jpg" width="251" height="54" /><br /><br />建議選單列的圖片高度50px、寬度100px以內。'
              },
              {
                element: '#Step_M1',
                intro: '<img src="images/tip/tip083.png" width="100" height="50" /><br /><br />上傳圖片。'
              },
			  {
                element: '#Step_M2',
                intro: '<img src="images/tip/tip082.png" width="100" height="50" /><br /><br />上傳圖片。'
              },
			  {
                element: '#Step_M3',
                intro: '<img src="images/tip/tip084.png" width="25" height="50" /><br /><br />上傳圖片。'
              },
			  {
                element: '#Step_M4',
                intro: '<img src="images/tip/tip085.png" width="25" height="50" /><br /><br />上傳圖片。'
              },
			  {
                element: '#Step_Location',
                intro: '設置您的選單位置。'
              },
			  {
                element: '#Step_Location1',
                intro: '<img src="images/tip/tip082.jpg" width="500" height="286" /><br /><br />選擇此項目在設計版型時可自由移動您的選單。'
              },
			  {
                element: '#Step_Location2',
                intro: '<img src="images/tip/tip083.jpg" width="486" height="173" /><br /><br />選擇此項目會固定於橫幅上方，並建議搭配底層背景作上傳。'
              },
			  {
                element: '#Step_M5',
                intro: '底層背景。'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>

<script>
	$(document).ready(function() {
	  $(".colorpicker-element").colorpicker({format:"hex"});
	});
</script>

<?php
mysqli_free_result($RecordTmpMainMenuListType);
?>
