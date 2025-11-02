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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpBlock")) {
  $updateSQL = sprintf("UPDATE demo_tmpblock SET name=%s, type=%s, tmp_a_font_color=%s, tmp_block_style=%s, tmp_block_width=%s, tmp_block_color=%s, tmp_block_background_color=%s, tmp_b_t_hight=%s, tmp_b_t_left=%s, tmp_b_t_repet=%s, tmp_b_t_position=%s, tmp_b_m_repet=%s, tmp_b_m_position=%s, notes1=%s, lang=%s, webname=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['tmp_a_font_color'], "text"),
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
                       GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";
  
  $updateGoTo = "manage_tmp.php?Opt=tmpblock&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}
/* 取得類別列表 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBlockListType = "SELECT * FROM demo_tmpitem WHERE list_id = 7";
$RecordTmpBlockListType = mysqli_query($DB_Conn, $query_RecordTmpBlockListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpBlockListType = mysqli_fetch_assoc($RecordTmpBlockListType);
$totalRows_RecordTmpBlockListType = mysqli_num_rows($RecordTmpBlockListType);

$colid_RecordTmpBlock = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpBlock = $_GET['id_edit'];
}
$coluserid_RecordTmpBlock = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBlock = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBlock = sprintf("SELECT * FROM demo_tmpblock WHERE id=%s && userid=%s", GetSQLValueString($colid_RecordTmpBlock, "int"),GetSQLValueString($coluserid_RecordTmpBlock, "int"));
$RecordTmpBlock = mysqli_query($DB_Conn, $query_RecordTmpBlock) or die(mysqli_error($DB_Conn));
$row_RecordTmpBlock = mysqli_fetch_assoc($RecordTmpBlock);
$totalRows_RecordTmpBlock = mysqli_num_rows($RecordTmpBlock);
?>

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
	width: 212px;
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 側邊裝飾外框 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
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
                      <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordTmpBlock['name']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
          <option value="-1" <?php if (!(strcmp(-1, $row_RecordTmpBlock['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
          <?php
do {  
?>
<option value="<?php echo $row_RecordTmpBlockListType['itemname']?>"<?php if (!(strcmp($row_RecordTmpBlockListType['itemname'], $row_RecordTmpBlock['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordTmpBlockListType['itemname']?></option>
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
                        
                        
                    <select name="tmp_block_style" id="tmp_block_style" class="form-control" data-parsley-trigger="blur" >
          <option value="" <?php if (!(strcmp("", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>-- 選擇樣式 --</option>
          <option value="none" <?php if (!(strcmp("none", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>無邊框</option>
          <option value="dotted" <?php if (!(strcmp("dotted", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>點線</option>
          <option value="dashed" <?php if (!(strcmp("dashed", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>虛線</option>
          <option value="solid" <?php if (!(strcmp("solid", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>實線</option>
          <option value="double" <?php if (!(strcmp("double", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>雙線</option>
          <option value="groove" <?php if (!(strcmp("groove", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>立體凹線</option>
          <option value="ridge" <?php if (!(strcmp("ridge", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>立體凸線</option>
          <option value="inset" <?php if (!(strcmp("inset", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>立體嵌入線</option>
          <option value="outset" <?php if (!(strcmp("outset", $row_RecordTmpBlock['tmp_block_style']))) {echo "selected=\"selected\"";} ?>>立體隆起線</option>
        </select>
                    
                    </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="input-group p-0">
                        
                          <div class="input-group-prepend"><span class="input-group-text">框線寬度</span></div>
                              <input name="tmp_block_width" class="form-control" id="tmp_block_width" value="<?php echo $row_RecordTmpBlock['tmp_block_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="5" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
                          </div>
                                  
                      </div>
                      
                    <div class="col-md-4">
                        <div class="input-group colorpicker-component colorpicker-element">				
                           <input name="tmp_block_color" type="text" required class="form-control colorpicker-element" id="tmp_block_color" value="<?php echo $row_RecordTmpBlock['tmp_block_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_block_color" data-parsley-trigger="blur"/>
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
                   <input name="tmp_block_background_color" type="text" required class="form-control colorpicker-element" id="tmp_block_background_color" value="<?php echo $row_RecordTmpBlock['tmp_block_background_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_block_background_color" data-parsley-trigger="blur"/>
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
                   <input name="tmp_block_color" type="text" required class="form-control colorpicker-element" id="tmp_block_color" value="<?php echo $row_RecordTmpBlock['tmp_block_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_block_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_block_color"></div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字偏移</label>
          <div class="col-md-10">
              <div class="input-group p-0">
                        
                          <div class="input-group-prepend"><span class="input-group-text">距左方</span></div>
                              <input name="tmp_b_t_left" class="form-control" id="tmp_b_t_left" value="<?php echo $row_RecordTmpBlock['tmp_b_t_left']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
               </div>
                      
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊高度 <i class="fa fa-info-circle text-orange" data-original-title="此欄位可不填，會以文字的高度作依據，您也可配合圖片設定高度。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      <input name="tmp_b_t_hight" class="form-control" id="tmp_b_t_hight" value="<?php echo $row_RecordTmpBlock['tmp_b_t_hight']; ?>" maxlength="5" data-parsley-min="0" data-parsley-max="9999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖<span class="text-red">*</span></label>
          <div class="col-md-10">
               <a href="uplod_tmpblocktitle.php?id_edit=<?php echo $row_RecordTmpBlock['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_title_pic"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_b_t_repet" id="tmp_b_t_repet" class="form-control" data-parsley-trigger="blur" required="">
          <option value="" selected="selected" <?php if (!(strcmp("", $row_RecordTmpBlock['tmp_b_t_repet']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
          <option value="no-repeat" <?php if (!(strcmp("no-repeat", $row_RecordTmpBlock['tmp_b_t_repet']))) {echo "selected=\"selected\"";} ?>>不重複</option>
          <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBlock['tmp_b_t_repet']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
          <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBlock['tmp_b_t_repet']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
          <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBlock['tmp_b_t_repet']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
        </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖位置<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_b_t_position" id="tmp_b_t_position" class="form-control" data-parsley-trigger="blur" required="">
          <option value="" selected="selected" <?php if (!(strcmp("", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>-- 選擇位置 --</option>
          <option value="left top" <?php if (!(strcmp("left top", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置頂及靠左</option>
          <option value="center top" <?php if (!(strcmp("center top", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置頂及靠中</option>
          <option value="right top" <?php if (!(strcmp("right top", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置頂及靠右</option>
          <option value="left center" <?php if (!(strcmp("left center", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置中及靠左</option>
          <option value="center center" <?php if (!(strcmp("center center", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置中及靠中</option>
          <option value="right center" <?php if (!(strcmp("right center", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置中及靠右</option>
          <option value="center bottom" <?php if (!(strcmp("center bottom", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置底及靠中</option>
          <option value="left bottom" <?php if (!(strcmp("left bottom", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置底及靠左</option>
          <option value="right bottom" <?php if (!(strcmp("right bottom", $row_RecordTmpBlock['tmp_b_t_position']))) {echo "selected=\"selected\"";} ?>>置底及靠右</option>
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
               <a href="uplod_tmpblockmiddle.php?id_edit=<?php echo $row_RecordTmpBlock['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_middle_pic"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_b_m_repet" id="tmp_b_m_repet" class="form-control" data-parsley-trigger="blur" required="">
          <option value="" selected="selected" <?php if (!(strcmp("", $row_RecordTmpBlock['tmp_b_m_repet']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
          <option value="no-repeat" <?php if (!(strcmp("no-repeat", $row_RecordTmpBlock['tmp_b_m_repet']))) {echo "selected=\"selected\"";} ?>>不重複</option>
          <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBlock['tmp_b_m_repet']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
          <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBlock['tmp_b_m_repet']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
          <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBlock['tmp_b_m_repet']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
        </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖位置<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_b_m_position" id="tmp_b_m_position" class="form-control" data-parsley-trigger="blur" required="">
          <option value="" selected="selected" <?php if (!(strcmp("", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>-- 選擇位置 --</option>
          <option value="left top" <?php if (!(strcmp("left top", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置頂及靠左</option>
          <option value="center top" <?php if (!(strcmp("center top", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置頂及靠中</option>
          <option value="right top" <?php if (!(strcmp("right top", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置頂及靠右</option>
          <option value="left center" <?php if (!(strcmp("left center", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置中及靠左</option>
          <option value="center center" <?php if (!(strcmp("center center", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置中及靠中</option>
          <option value="right center" <?php if (!(strcmp("right center", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置中及靠右</option>
          <option value="center bottom" <?php if (!(strcmp("center bottom", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置底及靠中</option>
          <option value="left bottom" <?php if (!(strcmp("left bottom", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置底及靠左</option>
          <option value="right bottom" <?php if (!(strcmp("right bottom", $row_RecordTmpBlock['tmp_b_m_position']))) {echo "selected=\"selected\"";} ?>>置底及靠右</option>
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
               <a href="uplod_tmpblockbottom.php?id_edit=<?php echo $row_RecordTmpBlock['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
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
            <input name="lang" type="hidden" id="lang" />
        <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
        <input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" />
        <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_TmpBlock" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->


<script>
	$(document).ready(function() {
	  $(".colorpicker-element").colorpicker({format:"hex"});
	  
	  $("#TransparentButtom1").click(function(){
			// 設定透明
			$("#tmp_block_background_color").val("transparent")
		});
		<?php if ($row_RecordTmpBlock['tmp_block_background_color'] == "transparent") { ?>
			$("#tmp_block_background_color").val("transparent");
		<?php } ?>
		
	});
</script>

<?php
mysqli_free_result($RecordTmpBlockListType);

mysqli_free_result($RecordTmpBlock);
?>
