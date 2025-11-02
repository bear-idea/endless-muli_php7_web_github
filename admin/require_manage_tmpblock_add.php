<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['webname'] . "/image/tmpblock";
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	$ppu->formName = "form_TmpBlock";
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
$query_RecordTmpBlockListType = "SELECT * FROM demo_tmpitem WHERE list_id = 7";
$RecordTmpBlockListType = mysqli_query($DB_Conn, $query_RecordTmpBlockListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpBlockListType = mysqli_fetch_assoc($RecordTmpBlockListType);
$totalRows_RecordTmpBlockListType = mysqli_num_rows($RecordTmpBlockListType);

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_TmpBlock")) {
  $insertSQL = sprintf("INSERT INTO demo_tmpblock (name, type, tmp_title_pic, tmp_middle_pic, tmp_a_font_color, tmp_bottom_pic, tmp_block_style, tmp_block_width, tmp_block_color, tmp_block_background_color, tmp_b_t_hight, tmp_b_t_left, tmp_b_t_repet, tmp_b_t_position, tmp_b_m_repet, tmp_b_m_position, notes1, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['tmp_title_pic'], "text"),
                       GetSQLValueString($_POST['tmp_middle_pic'], "text"),
                       GetSQLValueString($_POST['tmp_a_font_color'], "text"),
                       GetSQLValueString($_POST['tmp_bottom_pic'], "text"),
                       GetSQLValueString($_POST['tmp_block_style'], "text"),
                       GetSQLValueString($_POST['tmp_block_width'], "int"),
                       GetSQLValueString($_POST['tmp_block_color'], "text"),
                       GetSQLValueString($_POST['tmp_block_background_color'], "text"),
                       GetSQLValueString($_POST['tmp_b_t_hight'], "int"),
                       GetSQLValueString($_POST['tmp_b_t_left'], "int"),
                       GetSQLValueString($_POST['tmp_b_t_repet'], "text"),
					   GetSQLValueString($_POST['tmp_b_t_position'], "text"),
                       GetSQLValueString($_POST['tmp_b_m_repet'], "text"),
                       GetSQLValueString($_POST['tmp_b_m_position'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Add'] = "Success";
  
  $insertGoTo = "manage_tmp.php?Opt=tmpblock&lang=" . $_POST['lang'];
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
	width: 197px;
	height: 50px;
	margin-right:auto;
	margin-left:auto;
	position:relative;
}
#column_t:hover{
	border: 1px dotted #C30;
}
#column_m{
	color: #CCC;
	font-size: 30px;
	font-weight: bolder;
	border: #CCC dotted 1px;
	width: 197px;
	height: 150px;
	margin-right: auto;
	margin-left: auto;
	margin-top: 5px;
	margin-bottom: 5px;
	position:relative;
}
#column_m:hover{
	border: 1px dotted #C30;
}
#column_b{
	color: #CCC;
	font-size: 30px;
	font-weight: bolder;
	border: #CCC dotted 1px;
	width: 197px;
	height: 50px;
	margin-right:auto;
	margin-left:auto;
	position:relative;
}
#column_b:hover{
	border: 1px dotted #C30;
}
#column_wrp{
	position: relative;
	top: 10px;
	left: 10px;
	padding: 5px;
	border: #CCC dotted 1px;
	width: 202px;
	margin-left: 0px;
	;
	margin-right: auto;
	margin-top: auto;
	margin-bottom: auto;
	background-image: url(images/blockstyle_wp.jpg);
}
#column_wrp:hover{
	border: 1px dotted #C30;
}
</style>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 側邊裝飾外框 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">結構</label>
          <div class="col-md-10">
          <div class="table-responsive">
                  <div style="border:1px #CCCCCC dotted; width:600px; margin:5px;position:relative; height:300px;">
      <div id="column_wrp">
      	<div style="position: absolute; left: 212px; top: 14px; width: 37px; height: 1px;"><img src="images/z_line_c.png" alt="" width="36" height="1" /></div>
        <span style="color: #CCC; font-size: 15px; font-weight: bolder; padding: 0px; position: absolute; right: -101px; top: 4px;">整體外框</span>
      	<div id="column_t">
        	<div style="position: absolute; left: 9px; top: 16px;"><img src="images/z_h.png" alt="" width="20" height="20" /></div>
            <div style="position: absolute; left: 20px; top: 42px;"><img src="images/z_line_b.png" alt="" width="16" height="60" /></div>
        	<div style="font-size: 15px; position: absolute; left: 40px; top: 10px; border: #CCC dotted 1px; padding: 5px;">標題文字</div>
            <div style="font-size: 15px; position: absolute; left: 42px; top: 86px; padding: 5px;">文字偏移</div>
        	<span style="color: #CCC; font-size:15px; font-weight:bolder; padding:0px; position: absolute; right: 5px; bottom: 0px;">標題部分</span>
        </div>
        <div id="column_m">
        	<span style="color: #CCC; font-size:15px; font-weight:bolder; padding:0px; position: absolute; right: 5px; bottom: 0px;">內容部分</span>
        </div>
        <div id="column_b">
        	<span style="color: #CCC; font-size:15px; font-weight:bolder; padding:0px; position: absolute; right: 5px; bottom: 0px;">底部部分</span>
        </div>
      </div>
      </div>   
                 </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 整體外框</span></div>
      </div>
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
          <option value="<?php echo $row_RecordTmpBlockListType['itemname']?>"><?php echo $row_RecordTmpBlockListType['itemname']?></option>
          <?php
				} while ($row_RecordTmpBlockListType = mysqli_fetch_assoc($RecordTmpBlockListType));
				  $rows = mysqli_num_rows($RecordTmpBlockListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordTmpBlockListType, 0);
					  $row_RecordTmpBlockListType = mysqli_fetch_assoc($RecordTmpBlockListType);
				  }
				?>
        </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">邊框樣式</label>
          <div class="col-md-10">
          <div class="row">
                  
                    <div class="col-md-4">
                        <div class="input-group p-0"> 
                        
                        <div class="input-group-prepend"><span class="input-group-text">框線樣式</span></div>
                        
                        
                    <select name="tmp_block_style" id="tmp_block_style" class="form-control" data-parsley-trigger="blur">
                      <option>-- 選擇樣式 --</option>
                      <option value="none" selected="selected">無邊框</option>
                      <option value="dotted">點線</option>
                      <option value="dashed">虛線</option>
                      <option value="solid">實線</option>
                      <option value="double">雙線</option>
                      <option value="groove">立體凹線</option>
                      <option value="ridge">立體凸線</option>
                      <option value="inset">立體嵌入線</option>
                      <option value="outset">立體隆起線</option>
                    </select>
                    
                    </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="input-group p-0">
                        
                          <div class="input-group-prepend"><span class="input-group-text">框線寬度</span></div>
                              <input name="tmp_block_width" class="form-control" id="tmp_block_width" value="<?php echo $row_RecordTmp['tmp_block_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="5" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
                          </div>
                                  
                      </div>
                      
                    <div class="col-md-4">
                        <div class="input-group colorpicker-component colorpicker-element">				
                           <input name="tmp_block_color" type="text" required class="form-control colorpicker-element" id="tmp_block_color" value="#000000" maxlength="20" data-parsley-errors-container="#error_tmp_block_color" data-parsley-trigger="blur"/>
                           <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
                      </div>
                      <div id="error_tmp_block_color"></div>
                              
                         
                  </div>
                    
                    
           </div>
           </div>
           
           

      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底色<span class="text-red">*</span></label>
          <div class="col-md-9">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_block_background_color" type="text" required class="form-control colorpicker-element" id="tmp_block_background_color" value="transparent" maxlength="20" data-parsley-errors-container="#error_tmp_block_background_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_block_background_color"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom1" name="TransparentButtom1"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 標題部分</span></div>
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
          <label class="col-md-2 col-form-label">文字偏移</label>
          <div class="col-md-10">
              <div class="input-group p-0">
                        
                          <div class="input-group-prepend"><span class="input-group-text">距左方</span></div>
                              <input name="tmp_b_t_left" class="form-control" id="tmp_b_t_left" value="0" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
               </div>
                      
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊高度 <i class="fa fa-info-circle text-orange" data-original-title="此欄位可不填，會以文字的高度作依據，您也可配合圖片設定高度。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      <input name="tmp_b_t_hight" class="form-control" id="tmp_b_t_hight" value="<?php echo $row_RecordTmp['tmp_b_t_hight']; ?>" maxlength="5" data-parsley-min="0" data-parsley-max="9999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="tmp_title_pic" name="tmp_title_pic" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_title_pic" required=""/>
               <div id="error_tmp_title_pic"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_b_t_repet" id="tmp_b_t_repet" class="form-control" data-parsley-trigger="blur" required="">
                        <option value="">-- 選擇排列方式 --</option>
                      <option value="no-repeat" selected="selected">不重複</option>
                      <option value="repeat">水平垂直皆重複</option>
                      <option value="repeat-x">水平重複</option>
                      <option value="repeat-y">垂直重複</option>
                    </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖位置<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_b_t_position" id="tmp_b_t_position" class="form-control" data-parsley-trigger="blur" required="">
        <option value="">-- 選擇位置 --</option>
          <option value="left top">置頂及靠左</option>
          <option value="center top" selected="selected">置頂及靠中</option>
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
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 內容部分</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="tmp_middle_pic" name="tmp_middle_pic" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_middle_pic" required=""/>
               <div id="error_tmp_middle_pic"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_b_m_repet" id="tmp_b_m_repet" class="form-control" data-parsley-trigger="blur" required="">
        <option value="">-- 選擇排列方式 --</option>
          <option value="no-repeat">不重複</option>
          <option value="repeat">水平垂直皆重複</option>
          <option value="repeat-x">水平重複</option>
          <option value="repeat-y" selected="selected">垂直重複</option>
        </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖位置<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_b_m_position" id="tmp_b_m_position" class="form-control" data-parsley-trigger="blur" required="">
        <option value="">-- 選擇位置 --</option>
          <option value="left top">置頂及靠左</option>
          <option value="center top" selected="selected">置頂及靠中</option>
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
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 底圖部分</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="tmp_bottom_pic" name="tmp_bottom_pic" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_tmp_bottom_pic" required=""/>
               <div id="error_tmp_bottom_pic"></div>
               
          </div>
      </div>
      
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 其他</span></div>
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
      <input type="hidden" name="MM_insert" value="form_TmpBlock" />
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
		showPreview: true,
		uploadAsync: false, //设置上传同步异步 此为同步
		//uploadUrl: "index.php", //上传的地址
		//showCaption: false, 
		dropZoneEnabled: true,
		
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

<script>
	$(document).ready(function() {
	  $(".colorpicker-element").colorpicker({format:"hex"});
	  
	  $("#TransparentButtom1").click(function(){
			// 設定透明
			$("#tmp_block_background_color").val("transparent")
		});
		<?php if ($row_RecordTmp['tmp_block_background_color'] == "transparent") { ?>
			$("#tmp_block_background_color").val("transparent");
		<?php } ?>
		
	});
</script>

<?php
mysqli_free_result($RecordTmpBlockListType);
?>
