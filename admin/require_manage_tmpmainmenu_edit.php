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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpMainMenu")) {
  $updateSQL = sprintf("UPDATE demo_tmpmainmenu SET name=%s, type=%s, tmp_mainmenu_location=%s, tmp_mainmenupic_height=%s, tmp_mainmenu_font_size=%s, tmp_mainmenu_font_style=%s, tmp_mainmenu_color=%s, tmp_mainmenu_width=%s, tmp_mainmenu_hovercolor=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['tmp_mainmenu_location'], "int"),
                       GetSQLValueString($_POST['tmp_mainmenupic_height'], "int"),
                       GetSQLValueString($_POST['tmp_mainmenu_font_size'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_font_style'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_color'], "text"),
                       GetSQLValueString($_POST['tmp_mainmenu_width'], "int"),
                       GetSQLValueString($_POST['tmp_mainmenu_hovercolor'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_tmp.php?Opt=tmpmainmenu&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別列表 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenuListType = "SELECT * FROM demo_tmpitem WHERE list_id = 5";
$RecordTmpMainMenuListType = mysqli_query($DB_Conn, $query_RecordTmpMainMenuListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenuListType = mysqli_fetch_assoc($RecordTmpMainMenuListType);
$totalRows_RecordTmpMainMenuListType = mysqli_num_rows($RecordTmpMainMenuListType);

$colid_RecordTmpMainMenu = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpMainMenu = $_GET['id_edit'];
}
$coluserid_RecordTmpMainMenu = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpMainMenu = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenu = sprintf("SELECT * FROM demo_tmpmainmenu WHERE id=%s && userid=%s", GetSQLValueString($colid_RecordTmpMainMenu, "int"),GetSQLValueString($coluserid_RecordTmpMainMenu, "int"));
$RecordTmpMainMenu = mysqli_query($DB_Conn, $query_RecordTmpMainMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainMenu);
$totalRows_RecordTmpMainMenu = mysqli_num_rows($RecordTmpMainMenu);
/* 插入資料 */
?>

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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 主選單 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordTmpMainMenu['name']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type" id="type" class="form-control">
          <option value="-1" <?php if (!(strcmp(-1, $row_RecordTmpMainMenu['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
          <?php
do {  
?>
  <option value="<?php echo $row_RecordTmpMainMenuListType['itemname']?>"<?php if (!(strcmp($row_RecordTmpMainMenuListType['itemname'], $row_RecordTmpMainMenu['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordTmpMainMenuListType['itemname']?></option>
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
              <a href="uplod_tmpmainmenuimg.php?id_edit=<?php echo $row_RecordTmpMainMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
              <div id="error_tmp_mainmenu_img"></div>
          </div>
      </div>
      <div style="padding: 5px; position: absolute; left: 79px; top: -3px; width: 700px;" id="Step_M1">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">選單列底圖(滑鼠移入)<span class="text-red">*</span> <i class="fa fa-info-circle text-black" data-original-title="若您要製作無底圖的選單您可上傳透明的圖片。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <a href="uplod_tmpmainmenuhoverimg.php?id_edit=<?php echo $row_RecordTmpMainMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
              <div id="error_tmp_mainmenu_hover_img"></div>
          </div>
      </div>
      
      <div style="padding: 5px; position: absolute; left: 79px; top: 69px; width: 701px;">
      
              <div class="input-group p-0 width-200 pull-left">
            
              	  <div class="input-group-prepend"><span class="input-group-text">圖片寬度<span class="text-red">*</span></span></div>
                  <input name="tmp_mainmenu_width" class="form-control" id="tmp_mainmenu_width" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" value="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>" required=""/>
                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
              </div>
              
              <div class="input-group p-0 width-200 pull-left m-l-2">
            
              	  <div class="input-group-prepend"><span class="input-group-text">圖片高度<span class="text-red">*</span></span></div>
                  <input name="tmp_mainmenupic_height" class="form-control" id="tmp_mainmenupic_height" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" value="<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>" required=""/>
                  <div class="input-group-append"><span class="input-group-text">px</span></div>                
              </div>
    
      </div>
      
      <div style="padding: 5px; position: absolute; left: 46px; top: 207px; width: 700px;" id="Step_M3">
      	
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">左側圖片 <i class="fa fa-info-circle text-black" data-original-title="可不選擇，此為設定您選單的左側圖片。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <a href="uplod_tmpmainmenulimg.php?id_edit=<?php echo $row_RecordTmpMainMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
              <div id="error_tmp_mainmenu_l_img"></div>
          </div>
        
      </div>
      
      <div style="padding: 5px; position: absolute; left: 429px; top: 142px; width: 700px;" id="Step_M4">
      	
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">右側圖片 <i class="fa fa-info-circle text-black" data-original-title="可不選擇，此為設定您選單的右側圖片。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <a href="uplod_tmpmainmenurimg.php?id_edit=<?php echo $row_RecordTmpMainMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
              <div id="error_tmp_mainmenu_r_img"></div>
          </div>
        
      </div>
      
      
      <div style="padding: 5px; position: absolute; left: 445px; top: 105px; width: 700px;" id="Step_M5">
      	
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">底層背景 <i class="fa fa-info-circle text-black" data-original-title="可不選擇，此背景為水平重複排列並且寬度為目前版面寬度。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <a href="uplod_tmpmainmenuoimg.php?id_edit=<?php echo $row_RecordTmpMainMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
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
                <input <?php if (!(strcmp($row_RecordTmpMainMenu['tmp_mainmenu_location'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmp_mainmenu_location" id="tmp_mainmenu_location_2" value="0" />
                <label for="tmp_mainmenu_location_2">依據版面樣版位置</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmpMainMenu['tmp_mainmenu_location'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmp_mainmenu_location" id="tmp_mainmenu_location_1" value="1" />
                <label for="tmp_mainmenu_location_1">將主選單置於頁首區塊和橫幅區塊之間</label>
            </div>
            
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字大小<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
         <select name="tmp_mainmenu_font_size" id="tmp_mainmenu_font_size" class="form-control">
           <option value="9px"  <?php if (!(strcmp("9px", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>9px</option>
           <option value="10px"  <?php if (!(strcmp("10px", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>10px</option>
           <option value="11px"  <?php if (!(strcmp("11px", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>11px</option>
           <option value="12px"  <?php if (!(strcmp("12px", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>12px</option>
           <option value="13px"  <?php if (!(strcmp("13px", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>13px</option>
           <option value="14px"  <?php if (!(strcmp("14px", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>14px</option>
           <option value="14px"  <?php if (!(strcmp("16px", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>16px</option>
           <option value="14px"  <?php if (!(strcmp("18px", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>18px</option>
           <option value="xx-small"  <?php if (!(strcmp("xx-small", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>xx-small</option>
           <option value="x-small"  <?php if (!(strcmp("x-small", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>x-small</option>
           <option value="small"  <?php if (!(strcmp("small", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>small</option>
           <option value="medium"  <?php if (!(strcmp("medium", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>medium</option>
           <option value="large"  <?php if (!(strcmp("large", $row_RecordTmpMainMenu['tmp_mainmenu_font_size']))) {echo "selected=\"selected\"";} ?>>large</option>
         </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字樣式<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
         <select name="tmp_mainmenu_font_style" id="tmp_mainmenu_font_style" class="form-control">
           <option value="normal" <?php if (!(strcmp("normal", $row_RecordTmpMainMenu['tmp_mainmenu_font_style']))) {echo "selected=\"selected\"";} ?>>標準</option>
           <option value="bold" <?php if (!(strcmp("bold", $row_RecordTmpMainMenu['tmp_mainmenu_font_style']))) {echo "selected=\"selected\"";} ?>>粗體</option>
           <option value="bolder" <?php if (!(strcmp("bolder", $row_RecordTmpMainMenu['tmp_mainmenu_font_style']))) {echo "selected=\"selected\"";} ?>>粗體(+)</option>
         </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_mainmenu_color" type="text" required class="form-control colorpicker-element" id="tmp_mainmenu_color" value="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_mainmenu_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_mainmenu_color"></div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色(滑鼠移入)<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_mainmenu_hovercolor" type="text" required class="form-control colorpicker-element" id="tmp_mainmenu_hovercolor" value="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hovercolor']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_mainmenu_hovercolor" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_mainmenu_hovercolor"></div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordTmpMainMenu['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
            <input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_TmpMainMenu" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

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

mysqli_free_result($RecordTmpMainMenu);
?>
