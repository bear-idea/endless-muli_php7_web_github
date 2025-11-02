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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpLeftMenu")) {
  $updateSQL = sprintf("UPDATE demo_tmpleftmenu SET name=%s, type=%s, tmp_a_font_color=%s, tmp_a_o_font_color=%s, tmp_a_font_location=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['tmp_a_font_color'], "text"),
                       GetSQLValueString($_POST['tmp_a_o_font_color'], "text"),
					   GetSQLValueString($_POST['tmp_a_font_location'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";
  
  $updateGoTo = "manage_tmp.php?Opt=tmpleftmenu&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別列表 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLeftMenuListType = "SELECT * FROM demo_tmpitem WHERE list_id = 4";
$RecordTmpLeftMenuListType = mysqli_query($DB_Conn, $query_RecordTmpLeftMenuListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenuListType = mysqli_fetch_assoc($RecordTmpLeftMenuListType);
$totalRows_RecordTmpLeftMenuListType = mysqli_num_rows($RecordTmpLeftMenuListType);

$colid_RecordTmpLeftMenu = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpLeftMenu = $_GET['id_edit'];
}
$coluserid_RecordTmpLeftMenu = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpLeftMenu = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLeftMenu = sprintf("SELECT * FROM demo_tmpleftmenu WHERE id=%s && userid=%s", GetSQLValueString($colid_RecordTmpLeftMenu, "int"),GetSQLValueString($coluserid_RecordTmpLeftMenu, "int"));
$RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_RecordTmpLeftMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu);
$totalRows_RecordTmpLeftMenu = mysqli_num_rows($RecordTmpLeftMenu);
/* 插入資料 */
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 側邊選單 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordTmpLeftMenu['name']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type" id="type" class="form-control">
          <option value="-1" <?php if (!(strcmp(-1, $row_RecordTmpLeftMenu['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
          <?php
do {  
?>
<option value="<?php echo $row_RecordTmpLeftMenuListType['itemname']?>"<?php if (!(strcmp($row_RecordTmpLeftMenuListType['itemname'], $row_RecordTmpLeftMenu['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordTmpLeftMenuListType['itemname']?></option>
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
              <a href="uplod_tmpleftmenutitle.php?id_edit=<?php echo $row_RecordTmpLeftMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
              <div id="error_tmp_title_pic"></div>
          </div> 
      </div>
      
      <div style="padding: 5px; position: absolute; left: 255px; top: 248px; width: 700px;" id="Step_M4">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">底部圖片</span>
              </div>
              <a href="uplod_tmpleftmenubottom.php?id_edit=<?php echo $row_RecordTmpLeftMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
              <div id="error_tmp_bottom_pic"></div>
          </div> 
      </div>
      
      <div style="padding: 5px; position: absolute; left: 255px; top: 116px; width: 700px;" id="Step_M1">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">選單列底圖<span class="text-red">*</span> <i class="fa fa-info-circle text-black" data-original-title="建議選單列的圖片高度40px、寬度240px以內。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <a href="uplod_tmpleftmenumiddle.php?id_edit=<?php echo $row_RecordTmpLeftMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
              <div id="error_tmp_middle_pic"></div>
          </div> 
      </div>
      
      <div style="padding: 5px; position: absolute; left: 255px; top: 154px; width: 700px;" id="Step_M2">
          <div class="input-group p-0">
              <div class="input-group-prepend">
                <span class="input-group-text">選單列底圖 (滑鼠移入)<span class="text-red">*</span> <i class="fa fa-info-circle text-black" data-original-title="建議選單列的圖片高度40px、寬度240px以內。" data-toggle="tooltip" data-placement="top"></i></span>
              </div>
              <a href="uplod_tmpleftmenumiddleo.php?id_edit=<?php echo $row_RecordTmpLeftMenu['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
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
                   <input name="tmp_a_font_color" type="text" required class="form-control colorpicker-element" id="tmp_a_font_color" value="<?php echo $row_RecordTmpLeftMenu['tmp_a_font_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_a_font_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_a_font_color"></div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色(滑鼠移入)<span class="text-red">*</span></label>
          <div class="col-md-10">
          		<div class="input-group colorpicker-component colorpicker-element">				
                   <input name="tmp_a_o_font_color" type="text" required class="form-control colorpicker-element" id="tmp_a_o_font_color" value="<?php echo $row_RecordTmpLeftMenu['tmp_a_o_font_color']; ?>" maxlength="20" data-parsley-errors-container="#error_tmp_a_o_font_color" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_tmp_a_o_font_color"></div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字偏移</label>
          <div class="col-md-10">
                      <input name="tmp_a_font_location" class="form-control" id="tmp_a_font_location" value="<?php echo $row_RecordTmpLeftMenu['tmp_a_font_location']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordTmpLeftMenu['notes1']; ?>" size="50" maxlength="50"/>    
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
      <input type="hidden" name="MM_update" value="form_TmpLeftMenu" />
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

mysqli_free_result($RecordTmpLeftMenu);
?>
