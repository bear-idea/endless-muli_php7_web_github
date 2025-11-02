<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['webname'] . "/image/tmpleftmenu";
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	$ppu->formName = "form_TmpLeftMenu";
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
$query_RecordTmpLeftMenuListType = "SELECT * FROM demo_tmpitem WHERE list_id = 4";
$RecordTmpLeftMenuListType = mysqli_query($DB_Conn, $query_RecordTmpLeftMenuListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenuListType = mysqli_fetch_assoc($RecordTmpLeftMenuListType);
$totalRows_RecordTmpLeftMenuListType = mysqli_num_rows($RecordTmpLeftMenuListType);

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_TmpLeftMenu")) {
  $insertSQL = sprintf("INSERT INTO demo_tmpleftmenu (name, type, tmp_title_pic, tmp_middle_pic, tmp_middle_o_pic, tmp_a_font_color, tmp_a_o_font_color, tmp_bottom_pic, notes1, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['tmp_title_pic'], "text"),
                       GetSQLValueString($_POST['tmp_middle_pic'], "text"),
                       GetSQLValueString($_POST['tmp_middle_o_pic'], "text"),
                       GetSQLValueString($_POST['tmp_a_font_color'], "text"),
                       GetSQLValueString($_POST['tmp_a_o_font_color'], "text"),
                       GetSQLValueString($_POST['tmp_bottom_pic'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['userid'], "id"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Add'] = "Success";
  
  $insertGoTo = "manage_tmp.php?Opt=tmpleftmenu&lang=" . $_POST['lang'];
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
	width: 230px;
	height: 115px;
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
#column_t{
	color: #CCC;
	font-size: 30px;
	font-weight: bolder;
	border: #CCC dotted 1px;
	width: 197px;;
	height: 50px;
	margin-right:auto;
	margin-left:auto;;
}
#column_t:hover{
	border: 1px dotted #C30;
}
#column_m{	
	margin-right: auto;
	margin-left: auto;
	margin-top: 5px;
	margin-bottom: 5px;
}
#column_m:hover .column_m_block{	
	border: 1px dotted #C30;
}
.column_m_block{
	margin-right: auto;
	margin-left: auto;
	width: 197px;
	height: 50px;
	border: #CCC dotted 1px;
	margin-bottom: 5px;
}
#column_b{
	color: #CCC;
	font-size: 30px;
	font-weight: bolder;
	border: #CCC dotted 1px;
	width: 197px;;
	height: 50px;
	margin-right:auto;
	margin-left:auto;;
}
#column_b:hover{
	border: 1px dotted #C30;
}
</style>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 側邊選單 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
          <option value="<?php echo $row_RecordTmpLeftMenuListType['itemname']?>"><?php echo $row_RecordTmpLeftMenuListType['itemname']?></option>
          <?php
				} while ($row_RecordTmpLeftMenuListType = mysqli_fetch_assoc($RecordTmpLeftMenuListType));
				  $rows = mysqli_num_rows($RecordTmpLeftMenuListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordTmpLeftMenuListType, 0);
					  $row_RecordTmpLeftMenuListType = mysqli_fetch_assoc($RecordTmpLeftMenuListType);
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
                  <div style="border:1px #CCCCCC dotted; width:800px; margin:5px;position:relative; height:315px;">
      
      <div style="position: absolute; left: 206px; top: 40px;"><img src="images/z_line_column.png" alt="" width="48" height="229" /></div>
      <div style="padding: 5px; position: absolute; left: 255px; top: 28px; width: 700px;" id="Step_M3">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">標題圖片<span class="text-red">*</span> <i class="fa fa-info-circle text-black" data-original-title="若您要製作無底圖的選單您可上傳透明的圖片。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <input id="tmp_title_pic" name="tmp_title_pic" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_title_pic" required=""/>
              <div id="error_tmp_title_pic"></div>
          </div> 
      </div>
      
      <div style="padding: 5px; position: absolute; left: 255px; top: 248px; width: 700px;" id="Step_M4">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">底部圖片</span>
              </div>
              <input id="tmp_bottom_pic" name="tmp_bottom_pic" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_bottom_pic" />
              <div id="error_tmp_bottom_pic"></div>
          </div> 
      </div>
      
      <div style="padding: 5px; position: absolute; left: 255px; top: 116px; width: 700px;" id="Step_M1">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">選單列底圖<span class="text-red">*</span> <i class="fa fa-info-circle text-black" data-original-title="建議選單列的圖片高度40px、寬度240px以內。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <input id="tmp_middle_pic" name="tmp_middle_pic" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_middle_pic" required=""/>
              <div id="error_tmp_middle_pic"></div>
          </div> 
      </div>
      
      <div style="padding: 5px; position: absolute; left: 255px; top: 154px; width: 700px;" id="Step_M2">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">選單列底圖 (滑鼠移入)<span class="text-red">*</span> <i class="fa fa-info-circle text-black" data-original-title="建議選單列的圖片高度40px、寬度240px以內。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <input id="tmp_middle_o_pic" name="tmp_middle_o_pic" type="file" size="50" maxlength="200" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_middle_o_pic" required=""/>
              <div id="error_tmp_middle_o_pic"></div>
          </div> 
      </div>
      

        <div style="position:relative; top:10px; left:10px; padding:5px;border: #CCC dotted 1px; width:202px; margin-left:0px;; margin-right:auto; margin-top:auto; margin-bottom:auto; background-image:url(images/column_wp.jpg)">
          <div id="column_t"></div>
        <div id="column_m">
        	<div class="column_m_block"></div>
            <div class="column_m_block"></div>
            <div class="column_m_block"></div>
        </div>
        <div id="column_b"></div>
    </div>
      </div>   
                 </div>
        </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_a_font_color" type="text" required class="form-control colorpicker-element" id="tmp_a_font_color" value="#000000" maxlength="20" data-parsley-errors-container="#error_tmp_a_font_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_a_font_color"></div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色(滑鼠移入)<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_a_o_font_color" type="text" required class="form-control colorpicker-element" id="tmp_a_o_font_color" value="#DB6D00" maxlength="20" data-parsley-errors-container="#error_tmp_a_o_font_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_a_o_font_color"></div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字偏移</label>
          <div class="col-md-10">
                      <input name="tmp_a_font_location" class="form-control" id="tmp_a_font_location" value="<?php echo $row_RecordTmp['tmp_a_font_location']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                      
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
      <input type="hidden" name="MM_insert" value="form_TmpLeftMenu" />
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
	$("#tmp_title_pic, #tmp_middle_pic, #tmp_middle_o_pic, #tmp_bottom_pic").fileinput({
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
                intro: '<img src="images/tip/tip095.jpg" width="324" height="84" /><br /><br />設計一選單如圖所示。'
              },
			  {
                element: '#Step_Tip',
                intro: '<img src="images/tip/tip096.jpg" width="214" height="189" /><br /><br />由於可以搭配側邊裝飾外框，在標題圖片和底部圖片的部分，一般皆不會用到。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpaddblock&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 新增側邊裝飾外框</a></span></div>'
              },
              {
                element: '#Step_M1',
                intro: '<img src="images/tip/tip097.png" width="200" height="38" /><br /><br />上傳圖片。'
              },
			  {
                element: '#Step_M2',
                intro: '<img src="images/tip/tip098.png" width="200" height="38" /><br /><br />上傳圖片。'
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
mysqli_free_result($RecordTmpLeftMenuListType);
?>
