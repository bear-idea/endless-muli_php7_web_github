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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpBoard")) {
  $updateSQL = sprintf("UPDATE demo_tmpboard SET name=%s, type=%s, tmp_w_marge_top=%s, tmp_w_marge_bottom=%s, tmp_w_marge_left=%s, tmp_w_marge_right=%s, tmp_w_padding_top=%s, tmp_w_padding_bottom=%s, tmp_w_padding_left=%s, tmp_w_padding_right=%s, tmp_w_font_color=%s, tmp_w_board_style=%s, tmp_w_board_width=%s, tmp_w_board_color=%s, tmp_w_background_color=%s, borderradius_t_l=%s, borderradius_t_r=%s, borderradius_b_l=%s, borderradius_b_r=%s, boxshadow_x=%s, boxshadow_y=%s, boxshadow_size=%s, boxshadow_color=%s, lineargradient_top=%s, lineargradient_bottom=%s, tmp_l_t_repeat=%s, tmp_l_t_width=%s, tmp_l_t_height=%s, tmp_m_t_repeat=%s, tmp_m_t_height=%s, tmp_r_t_repeat=%s, tmp_r_t_width=%s, tmp_r_t_height=%s, tmp_l_m_repeat=%s, tmp_l_m_width=%s, tmp_m_m_repeat=%s, tmp_r_m_repeat=%s, tmp_r_m_width=%s, tmp_l_b_repeat=%s, tmp_l_b_width=%s, tmp_l_b_height=%s, tmp_m_b_repeat=%s, tmp_m_b_height=%s, tmp_r_b_repeat=%s, tmp_r_b_width=%s, tmp_r_b_height=%s, skeyword=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['tmp_w_marge_top'], "int"),
                       GetSQLValueString($_POST['tmp_w_marge_bottom'], "int"),
                       GetSQLValueString($_POST['tmp_w_marge_left'], "int"),
                       GetSQLValueString($_POST['tmp_w_marge_right'], "int"),
                       GetSQLValueString($_POST['tmp_w_padding_top'], "int"),
                       GetSQLValueString($_POST['tmp_w_padding_bottom'], "int"),
                       GetSQLValueString($_POST['tmp_w_padding_left'], "int"),
                       GetSQLValueString($_POST['tmp_w_padding_right'], "int"),
                       GetSQLValueString($_POST['tmp_w_font_color'], "text"),
                       GetSQLValueString($_POST['tmp_w_board_style'], "text"),
                       GetSQLValueString($_POST['tmp_w_board_width'], "int"),
                       GetSQLValueString($_POST['tmp_w_board_color'], "text"),
                       GetSQLValueString($_POST['tmp_w_background_color'], "text"),
                       GetSQLValueString($_POST['borderradius_t_l'], "int"),
                       GetSQLValueString($_POST['borderradius_t_r'], "int"),
                       GetSQLValueString($_POST['borderradius_b_l'], "int"),
                       GetSQLValueString($_POST['borderradius_b_r'], "int"),
                       GetSQLValueString($_POST['boxshadow_x'], "int"),
                       GetSQLValueString($_POST['boxshadow_y'], "int"),
                       GetSQLValueString($_POST['boxshadow_size'], "text"),
                       GetSQLValueString($_POST['boxshadow_color'], "text"),
                       GetSQLValueString($_POST['lineargradient_top'], "text"),
                       GetSQLValueString($_POST['lineargradient_bottom'], "text"),
                       GetSQLValueString($_POST['tmp_l_t_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_l_t_width'], "int"),
                       GetSQLValueString($_POST['tmp_l_t_height'], "int"),
                       GetSQLValueString($_POST['tmp_m_t_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_m_t_height'], "int"),
                       GetSQLValueString($_POST['tmp_r_t_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_r_t_width'], "int"),
                       GetSQLValueString($_POST['tmp_r_t_height'], "int"),
                       GetSQLValueString($_POST['tmp_l_m_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_l_m_width'], "int"),
                       GetSQLValueString($_POST['tmp_m_m_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_r_m_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_r_m_width'], "int"),
                       GetSQLValueString($_POST['tmp_l_b_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_l_b_width'], "int"),
                       GetSQLValueString($_POST['tmp_l_b_height'], "int"),
                       GetSQLValueString($_POST['tmp_m_b_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_m_b_height'], "int"),
                       GetSQLValueString($_POST['tmp_r_b_repeat'], "text"),
                       GetSQLValueString($_POST['tmp_r_b_width'], "int"),
                       GetSQLValueString($_POST['tmp_r_b_height'], "int"),
                       GetSQLValueString($_POST['skeyword'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_tmp.php?Opt=tmpboard&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardListType = "SELECT * FROM demo_tmpitem WHERE list_id = 3";
$RecordTmpBoardListType = mysqli_query($DB_Conn, $query_RecordTmpBoardListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType);
$totalRows_RecordTmpBoardListType = mysqli_num_rows($RecordTmpBoardListType);

$colid_RecordTmpBoard = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpBoard = $_GET['id_edit'];
}
$coluserid_RecordTmpBoard = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBoard = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoard = sprintf("SELECT * FROM demo_tmpboard WHERE id=%s && userid=%s", GetSQLValueString($colid_RecordTmpBoard, "int"),GetSQLValueString($coluserid_RecordTmpBoard, "int"));
$RecordTmpBoard = mysqli_query($DB_Conn, $query_RecordTmpBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoard = mysqli_fetch_assoc($RecordTmpBoard);
$totalRows_RecordTmpBoard = mysqli_num_rows($RecordTmpBoard);

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
#board_wrp{
	position:relative; top:10px; left:10px; padding:5px;border: #CCC dotted 1px; width:310px; margin-left:0px;; margin-right:auto; margin-top:auto; margin-bottom:auto; height:214px; background-image:url(images/board_wp.png)
}
.board_block {
	width: 25px;
	min-height: 25px;
	float: left;
	border: 1px dotted #CCC;
	margin:1px;
}
.board_block_m {
	width: 237px;
	min-height: 25px;
	float: left;
	border: 1px dotted #CCC;
	margin:1px;
}
#board_wrp:hover, .bd1:hover, .bd2:hover, .bd3:hover, .bd4:hover, .bd5:hover, .bd6:hover, .bd7:hover, .bd8:hover, .bd9:hover{
	border: 1px dotted #C30;
}
</style>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 區塊外框 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" >
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 整體</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordTmpBoard['name']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
          <option value="-1" <?php if (!(strcmp(-1, $row_RecordTmpBoard['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
          <?php
do {  
?>
<option value="<?php echo $row_RecordTmpBoardListType['itemname']?>"<?php if (!(strcmp($row_RecordTmpBoardListType['itemname'], $row_RecordTmpBoard['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordTmpBoardListType['itemname']?></option>
<?php
} while ($row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType));
  $rows = mysqli_num_rows($RecordTmpBoardListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpBoardListType, 0);
	  $row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType);
  }
?>
        </select>
                    
                    
</div>
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">結構</label>
          <div class="col-md-10">
          <div class="alert alert-warning m-t-5 m-b-0"><b><i class="fa fa-info-circle"></i> 四周外框圖建議寬高30px以內(20px以內最佳)，避免中央主要內容區過小。</b></div>
          <div class="alert alert-warning m-t-5 m-b-0"><b><i class="fa fa-info-circle"></i> 主外框可單獨使用，此時您可不必上傳其餘區塊的圖示，選擇內建之選項來繪製外框。</b></div>
          <div class="alert alert-warning m-t-5 m-b-0"><b><i class="fa fa-info-circle"></i> 上傳各區塊圖片時，寬高必須指定，否則會視為圖片長寬為0px。</b></div>
          <div class="alert alert-warning m-t-5 m-b-0"><b><i class="fa fa-info-circle"></i> 外框設定可套用至網頁整體外框、內容區塊等部分。</b></div>
          <div class="table-responsive">
            <div style="border:1px #CCCCCC dotted; width:600px; margin:5px;position:relative; height:265px;">
      <div id="board_wrp">
      <div style="position: absolute; left: 20px; top: 20px;"><img src="images/z_line_d.png" alt="" width="30" height="27" /></div>
      <div style="position: absolute; left: 285px; top: 200px;"><img src="images/z_line_d.png" alt="" width="30" height="27" /></div>
      <div style="position: absolute; left: 160px; top: 200px;"><img src="images/z_line_d.png" alt="" width="30" height="27" /></div>
      <div style="position: absolute; left: 20px; top: 200px;"><img src="images/z_line_d.png" alt="" width="30" height="27" /></div>
      <div style="position: absolute; left: 285px; top: 110px;"><img src="images/z_line_d.png" alt="" width="30" height="27" /></div>
      <div style="position: absolute; left: 20px; top: 110px;"><img src="images/z_line_d.png" alt="" width="30" height="27" /></div>
      <div style="position: absolute; left: 285px; top: 20px;"><img src="images/z_line_d.png" alt="" width="30" height="27" /></div>
      <div style="position: absolute; left: 160px; top: 20px;"><img src="images/z_line_d.png" alt="" width="30" height="27" /></div>
      <div style="position: absolute; left: 313px; top: 16px; width: 37px; height: 1px;"><img src="images/z_line_c.png" alt="" width="36" height="1" /></div>
      <div style="padding: 5px; position: absolute; left: 30px; top: 40px; width: 66px; height: 17px; color:#666">左上區塊</div>
      <div style="padding: 5px; position: absolute; left: 160px; top: 40px; width: 66px; height: 17px; color:#666">中上區塊</div>
      <div style="padding: 5px; position: absolute; left: 290px; top: 40px; width: 66px; height: 17px; color:#666">右上區塊</div>
      <div style="padding: 5px; position: absolute; left: 30px; top: 126px; width: 66px; height: 17px; color:#666">左中區塊</div>
      <div style="padding: 5px; position: absolute; left: 160px; top: 126px; width: 66px; height: 17px; color:#666">中央區塊</div>
      <div style="padding: 5px; position: absolute; left: 290px; top: 126px; width: 66px; height: 17px; color:#666">右中區快</div>
      <div style="padding: 5px; position: absolute; left: 30px; top: 228px; width: 66px; height: 17px; color:#666">左下區塊</div>
      <div style="padding: 5px; position: absolute; left: 160px; top: 228px; width: 66px; height: 17px; color:#666">中下區塊</div>
      <div style="padding: 5px; position: absolute; left: 290px; top: 228px; width: 66px; height: 17px; color:#666">右下區塊</div>
      <div style="padding: 5px; position: absolute; left: 344px; top: 4px; width: 66px; height: 17px; color:#666">主外框</div>
      	<div class="board_block bd1"></div>
        <div class="board_block_m bd2"></div>
        <div class="board_block bd3"></div>
        <div class="board_block bd4" style="height:150px;"></div>
        <div class="board_block_m bd5" style="height:150px;"></div>
        <div class="board_block bd6" style="height:150px;"></div>
        <div class="board_block bd7"></div>
        <div class="board_block_m bd8"></div>
        <div class="board_block bd9"></div>
  </div>
</div>   
            </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 主外框</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">外距<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="此內容一般不須更動，填寫0即可。" data-toggle="tooltip" data-placement="top"></i></label>            
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">上</span></div>
                  <input name="tmp_w_marge_top" class="form-control" id="tmp_w_marge_top" value="<?php echo $row_RecordTmpBoard['tmp_w_marge_top']; ?>" maxlength="3" data-parsley-min="-50" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
              </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">下</span></div>
                  <input name="tmp_w_marge_bottom" class="form-control" id="tmp_w_marge_bottom" value="<?php echo $row_RecordTmpBoard['tmp_w_marge_bottom']; ?>" maxlength="3" data-parsley-min="-50" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
              </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">左</span></div>
                  <input name="tmp_w_marge_left" class="form-control" id="tmp_w_marge_left" value="<?php echo $row_RecordTmpBoard['tmp_w_marge_left']; ?>" maxlength="3" data-parsley-min="-50" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                  <div class="input-group-append"><span class="input-group-text">px</span></div>                    
              </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">右</span></div>
                  <input name="tmp_w_marge_right" class="form-control" id="tmp_w_marge_right" value="<?php echo $row_RecordTmpBoard['tmp_w_marge_right']; ?>" maxlength="3" data-parsley-min="-50" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                    <div class="input-group-append"><span class="input-group-text">px</span></div>                  
              </div>
                      
          </div>
          
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">內距<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="此內容一般不須更動，填寫0即可。" data-toggle="tooltip" data-placement="top"></i></label>            
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">上</span></div>
                  <input name="tmp_w_padding_top" class="form-control" id="tmp_w_padding_top" value="<?php echo $row_RecordTmpBoard['tmp_w_padding_top']; ?>" maxlength="3" data-parsley-min="-50" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
              </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">下</span></div>
                  <input name="tmp_w_padding_bottom" class="form-control" id="tmp_w_padding_bottom" value="<?php echo $row_RecordTmpBoard['tmp_w_padding_bottom']; ?>" maxlength="3" data-parsley-min="-50" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
              </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">左</span></div>
                  <input name="tmp_w_padding_left" class="form-control" id="tmp_w_padding_left" value="<?php echo $row_RecordTmpBoard['tmp_w_padding_left']; ?>" maxlength="3" data-parsley-min="-50" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                  <div class="input-group-append"><span class="input-group-text">px</span></div>                    
              </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">右</span></div>
                  <input name="tmp_w_padding_right" class="form-control" id="tmp_w_padding_right" value="<?php echo $row_RecordTmpBoard['tmp_w_padding_right']; ?>" maxlength="3" data-parsley-min="-50" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                    <div class="input-group-append"><span class="input-group-text">px</span></div>                  
              </div>
                      
          </div>
          
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-9">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_w_font_color" type="text" required class="form-control colorpicker-element" id="tmp_w_font_color" value="<?php echo $row_RecordTmpBoard['tmp_w_font_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_w_font_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_w_font_color"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom1" name="TransparentButtom1"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">邊框樣式</label>
          <div class="col-md-10">
          <div class="row">
                  
                    <div class="col-md-4">
                        <div class="input-group p-0"> 
                        
                        <div class="input-group-prepend"><span class="input-group-text">框線樣式</span></div>
                        
                        
                    <select name="tmp_w_board_style" id="tmp_w_board_style" class="form-control" data-parsley-trigger="blur" required="">
          <option  value="" <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>-- 選擇樣式 --</option>
          <option value="none" <?php if (!(strcmp("none", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>無邊框</option>
          <option value="dotted" <?php if (!(strcmp("dotted", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>點線</option>
          <option value="dashed" <?php if (!(strcmp("dashed", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>虛線</option>
          <option value="solid" <?php if (!(strcmp("solid", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>實線</option>
          <option value="double" <?php if (!(strcmp("double", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>雙線</option>
          <option value="groove" <?php if (!(strcmp("groove", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>立體凹線</option>
          <option value="ridge" <?php if (!(strcmp("ridge", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>立體凸線</option>
          <option value="inset" <?php if (!(strcmp("inset", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>立體嵌入線</option>
          <option value="outset" <?php if (!(strcmp("outset", $row_RecordTmpBoard['tmp_w_board_style']))) {echo "selected=\"selected\"";} ?>>立體隆起線</option>
        </select>
                    
                    </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="input-group p-0">
                        
                          <div class="input-group-prepend"><span class="input-group-text">框線寬度</span></div>
                              <input name="tmp_w_board_width" class="form-control" id="tmp_w_board_width" value="<?php echo $row_RecordTmpBoard['tmp_w_board_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="5" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
                          </div>
                                  
                      </div>
                      
                    <div class="col-md-4">
                        <div class="input-group colorpicker-component colorpicker-element">				
                           <input name="tmp_w_board_color" type="text" required class="form-control colorpicker-element" id="tmp_w_board_color" value="<?php echo $row_RecordTmpBoard['tmp_w_board_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_w_background_color" data-parsley-trigger="blur"/>
                           <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
                      </div>
                      <div id="error_tmp_w_background_color"></div>
                              
                         
                  </div>
                    
                    
           </div>
           </div>
           
           

      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底色<span class="text-red">*</span></label>
          <div class="col-md-9">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_w_background_color" type="text" required class="form-control colorpicker-element" id="tmp_w_background_color" value="<?php echo $row_RecordTmpBoard['tmp_w_background_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_w_background_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_w_background_color"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom2" name="TransparentButtom2"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_w_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圓角 <i class="fa fa-info-circle text-orange" data-original-title="IE系列不支援，僅部分模擬。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">左上</span></div>
                  <input name="borderradius_t_l" class="form-control" id="borderradius_t_l" value="<?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">右上</span></div>
                  <input name="borderradius_t_r" class="form-control" id="borderradius_t_r" value="<?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">右下</span></div>
                  <input name="borderradius_b_r" class="form-control" id="borderradius_b_r" value="<?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                  <div class="input-group-append"><span class="input-group-text">px</span></div>                    
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">左下</span></div>
                  <input name="borderradius_b_l" class="form-control" id="borderradius_b_l" value="<?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                    <div class="input-group-append"><span class="input-group-text">px</span></div>                  
            </div>
                      
          </div>
          
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">陰影 <i class="fa fa-info-circle text-orange" data-original-title="IE系列不支援，僅部分模擬。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">X位移</span></div>
                  <input name="boxshadow_x" class="form-control" id="boxshadow_x" value="<?php echo $row_RecordTmpBoard['boxshadow_x']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">Y位移</span></div>
                  <input name="boxshadow_y" class="form-control" id="boxshadow_y" value="<?php echo $row_RecordTmpBoard['boxshadow_y']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">陰影大小</span></div>
                  <input name="boxshadow_size" class="form-control" id="boxshadow_size" value="<?php echo $row_RecordTmpBoard['boxshadow_size']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                  <div class="input-group-append"><span class="input-group-text">px</span></div>                    
            </div>
                      
          </div>
          
          
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">陰影顏色<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="IE系列不支援，僅部分模擬。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-9">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="boxshadow_color" type="text" required class="form-control colorpicker-element" id="boxshadow_color" value="<?php echo $row_RecordTmpBoard['boxshadow_color']; ?>" maxlength="20" data-parsley-errors-container="#error_boxshadow_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_boxshadow_color"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom3" name="TransparentButtom3"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">漸層<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="IE系列不支援，僅部分模擬。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-1 col-form-label">上</div>
          <div class="col-md-3">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="lineargradient_top" type="text" required class="form-control colorpicker-element" id="lineargradient_top" value="<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>" maxlength="20" data-parsley-errors-container="#error_lineargradient_top" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_lineargradient_top"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom4" name="TransparentButtom4"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
          <div class="col-md-1 col-form-label">下</div>
          <div class="col-md-3">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="lineargradient_bottom" type="text" required class="form-control colorpicker-element" id="lineargradient_bottom" value="<?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>" maxlength="20" data-parsley-errors-container="#error_lineargradient_bottom" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_lineargradient_bottom"></div>
                      
                 
          </div>
          <div class="col-md-1">
          	<button type="button" class="btn btn-default btn-block" id="TransparentButtom5" name="TransparentButtom5"><i class="fa fa-tint"></i> 設為透明</button>
          </div>
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 左上區塊</span></div>
      </div>
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_l_t.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_l_t_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_l_t_repeat" id="tmp_l_t_repeat" class="form-control" data-parsley-trigger="blur" required="">
          <option value="" <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_l_t_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
          <option value="no-repeat"  <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_l_t_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
          <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_l_t_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
          <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_l_t_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
          <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_l_t_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
        </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊大小<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="若有上傳圖片，請填入圖片寬度，否則將不會顯示，建議寬高30px以內(20px以內最佳)，此區大小將會以圖片大小為基準。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">寬度</span></div>
                  <input name="tmp_l_t_width" class="form-control" id="tmp_l_t_width" value="<?php echo $row_RecordTmpBoard['tmp_l_t_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">高度</span></div>
                  <input name="tmp_l_t_height" class="form-control" id="tmp_l_t_height" value="<?php echo $row_RecordTmpBoard['tmp_l_t_height']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
            </div>
                      
          </div>
         
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 中上區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_m_t.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_m_t_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_m_t_repeat" id="tmp_m_t_repeat" class="form-control" data-parsley-trigger="blur" required="">
        <option value=""  <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_m_t_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
        <option value="no-repeat" <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_m_t_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
        <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_m_t_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
        <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_m_t_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
        <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_m_t_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
      </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊大小<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="若有上傳圖片，請填入圖片寬度，否則將不會顯示，建議寬高30px以內(20px以內最佳)，此區大小將會以圖片大小為基準。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">高度</span></div>
                  <input name="tmp_m_t_height" class="form-control" id="tmp_m_t_height" value="<?php echo $row_RecordTmpBoard['tmp_m_t_height']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
              </div>
                      
          </div>
         
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 右上區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_r_t.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_r_t_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_r_t_repeat" id="tmp_r_t_repeat" class="form-control" data-parsley-trigger="blur" required="">
        <option value=""  <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_r_t_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
        <option value="no-repeat" <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_r_t_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
        <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_r_t_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
        <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_r_t_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
        <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_r_t_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
      </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊大小<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="若有上傳圖片，請填入圖片寬度，否則將不會顯示，建議寬高30px以內(20px以內最佳)，此區大小將會以圖片大小為基準。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">寬度</span></div>
                  <input name="tmp_r_t_width" class="form-control" id="tmp_r_t_width" value="<?php echo $row_RecordTmpBoard['tmp_r_t_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">高度</span></div>
                  <input name="tmp_r_t_height" class="form-control" id="tmp_r_t_height" value="<?php echo $row_RecordTmpBoard['tmp_r_t_height']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
              </div>
                      
          </div>
         
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 左中區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_l_m.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_l_m_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_l_m_repeat" id="tmp_l_m_repeat" class="form-control" data-parsley-trigger="blur" required="">
         <option value="" <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_l_m_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
         <option value="no-repeat" <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_l_m_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
         <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_l_m_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
         <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_l_m_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
         <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_l_m_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
       </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊大小<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="若有上傳圖片，請填入圖片寬度，否則將不會顯示，建議寬高30px以內(20px以內最佳)，此區大小將會以圖片大小為基準。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">寬度</span></div>
                  <input name="tmp_l_m_width" class="form-control" id="tmp_l_m_width" value="<?php echo $row_RecordTmpBoard['tmp_l_m_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
            </div>
                      
          </div>
         
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 中央區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_m_m.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_m_m_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_m_m_repeat" id="tmp_m_m_repeat" class="form-control" data-parsley-trigger="blur" required="">
         <option value="" <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_m_m_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
         <option value="no-repeat" <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_m_m_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
         <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_m_m_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
         <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_m_m_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
         <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_m_m_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
       </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 右中區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_r_m.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_r_m_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_r_m_repeat" id="tmp_r_m_repeat" class="form-control" data-parsley-trigger="blur" required="">
         <option value="" <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_r_m_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
         <option value="no-repeat" <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_r_m_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
         <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_r_m_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
         <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_r_m_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
         <option value="repeat-y"  <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_r_m_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
       </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊大小<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="若有上傳圖片，請填入圖片寬度，否則將不會顯示，建議寬高30px以內(20px以內最佳)，此區大小將會以圖片大小為基準。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">寬度</span></div>
                  <input name="tmp_r_m_width" class="form-control" id="tmp_r_m_width" value="<?php echo $row_RecordTmpBoard['tmp_r_m_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
            </div>
                      
          </div>
         
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 左下區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_l_b.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_l_b_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_l_b_repeat" id="tmp_l_b_repeat" class="form-control" data-parsley-trigger="blur" required="">
        <option value="" <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_l_b_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
        <option value="no-repeat"  <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_l_b_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
        <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_l_b_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
        <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_l_b_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
        <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_l_b_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
      </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊大小<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="若有上傳圖片，請填入圖片寬度，否則將不會顯示，建議寬高30px以內(20px以內最佳)，此區大小將會以圖片大小為基準。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">寬度</span></div>
                  <input name="tmp_l_b_width" class="form-control" id="tmp_l_b_width" value="<?php echo $row_RecordTmpBoard['tmp_l_b_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">高度</span></div>
                  <input name="tmp_l_b_height" class="form-control" id="tmp_l_b_height" value="<?php echo $row_RecordTmpBoard['tmp_l_b_height']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
              </div>
                      
          </div>
         
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 中下區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_m_b.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_m_b_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_m_b_repeat" id="tmp_m_b_repeat" class="form-control" data-parsley-trigger="blur" required="">
         <option value="" <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_m_b_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
         <option value="no-repeat" <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_m_b_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
         <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_m_b_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
         <option value="repeat-x"  <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_m_b_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
         <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_m_b_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
       </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊大小<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="若有上傳圖片，請填入圖片寬度，否則將不會顯示，建議寬高30px以內(20px以內最佳)，此區大小將會以圖片大小為基準。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">高度</span></div>
                  <input name="tmp_m_b_height" class="form-control" id="tmp_m_b_height" value="<?php echo $row_RecordTmpBoard['tmp_m_b_height']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
              </div>
                      
          </div>
         
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 右下區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">背景圖</label>
          <div class="col-md-10">
               <a href="uplod_tmpboard_wrp_r_b.php?id_edit=<?php echo $row_RecordTmpBoard['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
               <div id="error_tmp_r_b_background_img"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">底圖排列方式<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="tmp_r_b_repeat" id="tmp_r_b_repeat" class="form-control" data-parsley-trigger="blur" required="">
         <option value="" <?php if (!(strcmp("", $row_RecordTmpBoard['tmp_r_b_repeat']))) {echo "selected=\"selected\"";} ?>>-- 選擇排列方式 --</option>
         <option value="no-repeat"  <?php if (!(strcmp("no-repeat", $row_RecordTmpBoard['tmp_r_b_repeat']))) {echo "selected=\"selected\"";} ?>>不重複</option>
         <option value="repeat" <?php if (!(strcmp("repeat", $row_RecordTmpBoard['tmp_r_b_repeat']))) {echo "selected=\"selected\"";} ?>>水平垂直皆重複</option>
         <option value="repeat-x" <?php if (!(strcmp("repeat-x", $row_RecordTmpBoard['tmp_r_b_repeat']))) {echo "selected=\"selected\"";} ?>>水平重複</option>
         <option value="repeat-y" <?php if (!(strcmp("repeat-y", $row_RecordTmpBoard['tmp_r_b_repeat']))) {echo "selected=\"selected\"";} ?>>垂直重複</option>
       </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">區塊大小<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="若有上傳圖片，請填入圖片寬度，否則將不會顯示，建議寬高30px以內(20px以內最佳)，此區大小將會以圖片大小為基準。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">寬度</span></div>
                  <input name="tmp_r_b_width" class="form-control" id="tmp_r_b_width" value="<?php echo $row_RecordTmpBoard['tmp_r_b_width']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                      <div class="input-group-append"><span class="input-group-text">px</span></div>                
            </div>
                      
          </div>
          <div class="col-md-2">
            <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">高度</span></div>
                  <input name="tmp_r_b_height" class="form-control" id="tmp_r_b_height" value="<?php echo $row_RecordTmpBoard['tmp_r_b_height']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="200" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                     <div class="input-group-append"><span class="input-group-text">px</span></div>                 
              </div>
                      
          </div>
         
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 標籤</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">關鍵詞 <i class="fa fa-info-circle text-orange" data-original-title="填入關鍵詞，輸入完按Enter即可輸入下一個或直接輸入以 【,】分隔的單字，例如【Shop3500,網頁設計,SEO】資料送出後會替您分開，【,】為英文單字的逗號，錯誤範例為【，】【、】及空白。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordTmpBoard['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 其他</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordTmpBoard['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_TmpBoard" />
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
			$("#tmp_w_font_color").val("transparent");
		});
		<?php if ($row_RecordTmpBoard['tmp_w_font_color'] == "transparent") { ?>
			$("#tmp_w_font_color").val("transparent");
		<?php } ?>
		
	  $("#TransparentButtom2").click(function(){
			// 設定透明
			$("#tmp_w_background_color").val("transparent");
		});
		<?php if ($row_RecordTmpBoard['tmp_w_background_color'] == "transparent") { ?>
			$("#tmp_w_background_color").val("transparent");
		<?php } ?>
		
	 
	  $("#TransparentButtom3").click(function(){
			// 設定透明
			$("#boxshadow_color").val("transparent")
		});
		<?php if ($row_RecordTmpBoard['boxshadow_color'] == "transparent") { ?>
			$("#boxshadow_color").val("transparent");
		<?php } ?>
	  $("#TransparentButtom4").click(function(){
			// 設定透明
			$("#lineargradient_top").val("transparent");
		});
		<?php if ($row_RecordTmpBoard['lineargradient_top'] == "transparent") { ?>
			$("#lineargradient_top").val("transparent");
		<?php } ?>
	  $("#TransparentButtom5").click(function(){
			// 設定透明
			$("#lineargradient_bottom").val("transparent")
		});
		<?php if ($row_RecordTmpBoard['lineargradient_bottom'] == "transparent") { ?>
			$("#lineargradient_bottom").val("transparent");
		<?php } ?>
		
	});
</script>


<?php
mysqli_free_result($RecordTmpBoardListType);

mysqli_free_result($RecordTmpBoard);
?>
