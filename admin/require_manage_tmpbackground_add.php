<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['webname'] . "/image/tmpbackground";
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	$ppu->formName = "form_TmpBackGround";
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
$query_RecordTmpBackGroundListType = "SELECT * FROM demo_tmpitem WHERE list_id = 2";
$RecordTmpBackGroundListType = mysqli_query($DB_Conn, $query_RecordTmpBackGroundListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpBackGroundListType = mysqli_fetch_assoc($RecordTmpBackGroundListType);
$totalRows_RecordTmpBackGroundListType = mysqli_num_rows($RecordTmpBackGroundListType);

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_TmpBackGround")) {
  $insertSQL = sprintf("INSERT INTO demo_tmpbackground (name, type, bgimage, bgcolor, bgrepeat, bgposition, bgattachment, bgsize, localoutwrp1, localoutwrp2, localwrp, localheader, localcolumn, localmiddle, localfooter, localicon, localtitleline, notes1, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['bgimage'], "text"),
                       GetSQLValueString($_POST['bgcolor'], "text"),
                       GetSQLValueString($_POST['bgrepeat'], "text"),
                       GetSQLValueString($_POST['bgposition'], "text"),
                       GetSQLValueString($_POST['bgattachment'], "text"),
					   GetSQLValueString($_POST['bgsize'], "text"),
                       GetSQLValueString(isset($_POST['localoutwrp1']) ? "true" : "", "defined","1","0"),
					   GetSQLValueString(isset($_POST['localoutwrp2']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['localwrp']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['localheader']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['localcolumn']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['localmiddle']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['localfooter']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['localicon']) ? "true" : "", "defined","1","0"),
					   GetSQLValueString(isset($_POST['localtitleline']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
  
  $insertGoTo = "manage_tmp.php?Opt=tmpbk&lang=". $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 區塊背景 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>" class="form-horizontal form-bordered bg-form" data-parsley-validate="" method="post" enctype="multipart/form-data">
      
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
          <option value="<?php echo $row_RecordTmpBackGroundListType['itemname']?>"><?php echo $row_RecordTmpBackGroundListType['itemname']?></option>
          <?php
				} while ($row_RecordTmpBackGroundListType = mysqli_fetch_assoc($RecordTmpBackGroundListType));
				  $rows = mysqli_num_rows($RecordTmpBackGroundListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordTmpBackGroundListType, 0);
					  $row_RecordTmpBackGroundListType = mysqli_fetch_assoc($RecordTmpBackGroundListType);
				  }
				?>
        </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類位置<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="代表此背景可適用的區塊。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                                  <img src="images/bk_st_01.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localoutwrp1'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localoutwrp1" value="1" id="localoutwrp1" data-parsley-group="block-1" />
                                            <label for="localoutwrp1">外框架 <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此為主版面外圍的部分，適合放置重複排列的背景圖，另只有此區會對背景圖移動的屬性設定有效果。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <img src="images/bk_st_01.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localoutwrp2'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localoutwrp2" value="1" id="localoutwrp2"  data-parsley-group="block-1"/>
                                            <label for="localoutwrp2">外框架(裝飾) <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此為主版面外圍的裝飾部分，用以增添下層圖層的質感，此區適合放置不會覆蓋下層圖層之背景圖片。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <img src="images/bk_st_08.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localwrp'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localwrp" value="1" id="localwrp"  data-parsley-group="block-1"/>
                                            <label for="localwrp">主框架 <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此為主版面部分。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <img src="images/bk_st_02.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localheader'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localheader" value="1" id="localheader"  data-parsley-group="block-1"/>
                                            <label for="localheader">頁首區塊 <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此區會放置主選單、Logo，您可配合單張圖片擺放。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <img src="images/bk_st_04.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localcolumn'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localcolumn" value="1" id="localcolumn"  data-parsley-group="block-1"/>
                                            <label for="localcolumn">欄位區塊 <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此區會放置選單、外部模組等等，您可配合單張圖片擺放，若此區圖未完整顯示，則您必須至《版型設定》中調整此區高度。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <img src="images/bk_st_05.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localmiddle'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localmiddle" value="1" id="localmiddle"  data-parsley-group="block-1"/>
                                            <label for="localmiddle">中央區塊 <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此區會放置主要內容，您可配合單張圖片擺放。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <img src="images/bk_st_03.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localfooter'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localfooter" value="1" id="localfooter"  data-parsley-group="block-1"/>
                                            <label for="localfooter">頁尾區塊 <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此區會放置Copyright等等。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <img src="images/bk_st_07.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localicon'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localicon" value="1" id="localicon"  data-parsley-group="block-1"/>
                                            <label for="localicon">小圖示 <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此區會放置一小圖片，建議放置的背景圖不要過大，20x20像素以內為佳。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="card pull-left m-5">
                                  <img src="images/bk_st_06.jpg" width="150" height="150" />
                                  <div class="card-block">
                                      <div class="checkbox checkbox-css checkbox-inline">
                                            <input <?php if (!(strcmp($row_RecordTmp['localtitleline'],"1"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="localtitleline" value="1" id="localtitleline"  data-parsley-group="block-1"/>
                                            <label for="localtitleline">標題背景 <i class="fa fa-info-circle text-orange" data-original-title="白色部分為背景放置範圍，此為標題部分背景圖，您可上傳類似分隔線的背景做搭配。" data-toggle="tooltip" data-placement="top"></i></label>
                                      </div>
                                  </div>
                              </div> 
  
                 
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="bgimage" name="bgimage" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_bgimage" required=""/>
               <div id="error_bgimage"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底色<span class="text-red">*</span></label>
          <div class="col-md-9">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="bgcolor" type="text" required class="form-control colorpicker-element" id="bgcolor" value="transparent" maxlength="20" data-parsley-errors-container="#error_bgcolor" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_bgcolor"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom1" name="TransparentButtom1"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="bgrepeat" id="bgrepeat" class="form-control" data-parsley-trigger="blur" required="">
                        <option value="">-- 選擇排列方式 --</option>
                      <option value="no-repeat">不重複</option>
                      <option value="repeat" selected="selected">水平垂直皆重複</option>
                      <option value="repeat-x">水平重複</option>
                      <option value="repeat-y">垂直重複</option>
                    </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖移動 <i class="fa fa-info-circle text-orange" data-original-title="代表背景是否會跟著瀏覽器捲軸移動，此設定僅適用於外框架的背景。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="bgattachment" id="bgattachment" class="form-control" data-parsley-trigger="blur" >
          <option value="" selected="selected">-- 選擇屬性 --</option>
          <option value="fixed">不移動</option>
          <option value="scroll">隨捲軸</option>
        </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖位置<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="bgposition" id="bgposition" class="form-control" data-parsley-trigger="blur" required="">
        <option value="">-- 選擇位置 --</option>
          <option value="left top" selected="selected">置頂及靠左</option>
          <option value="center top">置頂及靠中</option>
          <option value="right top">置頂及靠右</option>
          <option value="left center">置中及靠左</option>
          <option value="center center">置中及靠中</option>
          <option value="right center">置中及靠右</option>
          <option value="center bottom">置底及靠中</option>
          <option value="left bottom">置底及靠左</option>
  <option value="right bottom">置底及靠右</option>
        </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖縮放 <span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="設定背景圖的大小，例如自訂背景圖片的寬度與高度、根據容器（如 DIV 區塊）大小而調整背景圖片的百分比、將背景圖片放大並填滿整個容器區域或是自動縮小背景圖片的大小使其可以完整呈現於容器的範圍內。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="bgsize" id="bgsize" class="form-control" data-parsley-trigger="blur" required="">
          <option value="">-- 選擇模式 --</option>
          <option value="auto" selected="selected">維持原尺寸 (auto)</option>
          <option value="100% auto">依目前寬度做縮放 / 高度自動調整 (100% auto)</option>
          <option value="cover">填滿目前區塊 (cover)</option>
        </select>
                    
                    
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
            <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_TmpBackGround" />
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
	$("#bgimage").fileinput({
		showUpload:true, 
		showPreview: true,
		uploadAsync: false, //设置上传同步异步 此为同步
		//uploadUrl: "index.php", //上传的地址
		//showCaption: false, 
		dropZoneEnabled: true,
		
		allowedFileExtensions: ["jpg","png","jpeg","gif"],
		//resizeImage: true,
		maxImageWidth: 3000,
		maxImageHeight: 3000,
		//resizePreference: 'width',
		maxFileSize: 1500,  
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
		});
});
</script>

<script>
	$(document).ready(function() {
	  $(".colorpicker-element").colorpicker({format:"hex"});
	  
	  $("#TransparentButtom1").click(function(){
			// 設定透明
			$("#bgcolor").val("transparent")
		});
		<?php if ($row_RecordTmp['bgcolor'] == "transparent") { ?>
			$("#bgcolor").val("transparent");
		<?php } ?>
		
	});
</script>

<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Locate',
                intro: '設置的背景可放置於網頁各區塊位置，白色部分為背景圖所放置的位置。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_tutorials.php?wshop=<?php echo $wshop;?>&amp;Opt_Tutorials=tu18&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 位置說明</a></span></div>'
              },
			  {
                element: '#Step_Tip',
                intro: '<img src="images/tip/tip084.jpg" width="178" height="168" /><br /><br />在網頁外框架的部分圖層結構如圖堆疊所示。'
              },
			  {
                element: '#Step_Tip',
                intro: '<img src="images/tip/tip085.jpg" width="353" height="272" /><br /><br />因此設計背景圖時可以利用透明PNG圖片來達成上圖顯示效果。'
              },
              {
                element: '#Step_L1',
                intro: '<img src="images/tip/tip086.jpg" width="432" height="500" /><br /><br />設置範例。'
              },
			  {
                element: '#Step_L2',
                intro: '<img src="images/tip/tip087.jpg" width="432" height="500" /><br /><br />設置範例。'
              },
			  {
                element: '#Step_L3',
                intro: '<img src="images/tip/tip088.jpg" width="432" height="500" /><br /><br />設置範例。'
              },
			  {
                element: '#Step_L4',
                intro: '<img src="images/tip/tip089.jpg" width="432" height="500" /><br /><br />設置範例。'
              },
			  {
                element: '#Step_L5',
                intro: '<img src="images/tip/tip090.jpg" width="432" height="500" /><br /><br />設置範例。'
              },
			  {
                element: '#Step_L6',
                intro: '<img src="images/tip/tip091.jpg" width="432" height="500" /><br /><br />設置範例。'
              },
			  {
                element: '#Step_L7',
                intro: '<img src="images/tip/tip092.jpg" width="432" height="500" /><br /><br />設置範例。'
              },
			  {
                element: '#Step_L8',
                intro: '<img src="images/tip/tip093.jpg" width="432" height="500" /><br /><br />設置範例。'
              },
			  {
                element: '#Step_L9',
                intro: '<img src="images/tip/tip094.jpg" width="432" height="500" /><br /><br />設置範例。'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>

<script type="text/javascript">
<!--
function CheckFields()
{		
	var checkYN = 0;
	if (document.getElementById("localoutwrp1").checked == true){checkYN++;}
	if (document.getElementById("localoutwrp2").checked == true){checkYN++;}
	if (document.getElementById("localwrp").checked == true){checkYN++;}
	if (document.getElementById("localheader").checked == true){checkYN++;}
	if (document.getElementById("localcolumn").checked == true){checkYN++;}
	if (document.getElementById("localmiddle").checked == true){checkYN++;}
	if (document.getElementById("localfooter").checked == true){checkYN++;}
	if (document.getElementById("localicon").checked == true){checkYN++;}
	if (document.getElementById("localtitleline").checked == true){checkYN++;}
	if (checkYN == 0) 
	{
		alert("至少選擇一個分類位置！！");
		return false;
	}

	return true;
}
//-->
</script>

<?php
mysqli_free_result($RecordTmpBackGroundListType);
?>
