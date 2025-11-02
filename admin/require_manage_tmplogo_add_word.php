<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO demo_tmplogo (name, type, logotype, logoname, logoname_cn, logoname_en, logoname_jp, logoname_kr, logoname_sp, logocolor, logofontsize, notes1, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['logotype'], "int"),
					   GetSQLValueString($_POST['logoname'], "text"),
					   GetSQLValueString($_POST['logoname_cn'], "text"),
					   GetSQLValueString($_POST['logoname_en'], "text"),
					   GetSQLValueString($_POST['logoname_jp'], "text"),
					   GetSQLValueString($_POST['logoname_kr'], "text"),
					   GetSQLValueString($_POST['logoname_sp'], "text"),
					   GetSQLValueString($_POST['logocolor'], "text"),
					   GetSQLValueString($_POST['logofontsize'], "text"),
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
        <label class="col-md-2 col-form-label">文字【繁體】<span class="text-red">*</span></label>
          <div class="col-md-10">
            <input name="logoname" type="text" class="form-control" id="logoname" maxlength="100" data-parsley-trigger="blur" required=""/>
               
          </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseZHCN == 1 || $defaultlang == 'zh-cn') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字【简体】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input name="logoname_cn" type="text" class="form-control" id="logoname_cn" maxlength="100" data-parsley-trigger="blur" required=""/>
               
          </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseEN == 1 || $defaultlang == 'en') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字【English】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input name="logoname_en" type="text" class="form-control" id="logoname_en" maxlength="100" data-parsley-trigger="blur" required=""/>
               
        </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseJP == 1 || $defaultlang == 'jp') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字【日本語】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input name="logoname_jp" type="text" class="form-control" id="logoname_jp" maxlength="100" data-parsley-trigger="blur" required=""/>
               
        </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseKR == 1 || $defaultlang == 'kr') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字【한국어】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input name="logoname_kr" type="text" class="form-control" id="logoname_kr" maxlength="100" data-parsley-trigger="blur" required=""/>
               
        </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseSP == 1 || $defaultlang == 'sp') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字【Español】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input name="logoname_sp" type="text" class="form-control" id="logoname_sp" maxlength="100" data-parsley-trigger="blur" required=""/>
               
        </div>
      </div>
      <?php } ?>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字顏色<span class="text-red">*</span></label>
          <div class="col-md-10">
              <div class="input-group colorpicker-component colorpicker-element" id="colorpicker-prepend">
                   <input name="logocolor" type="text" required="" class="form-control colorpicker-element" id="logocolor" value="#000000" maxlength="100" data-parsley-errors-container="#error_colorpicker" data-parsley-trigger="blur"/>
                   <span class="input-group-addon"><i style="background-color: rgb(64, 18, 18);"></i></span>
              </div>
              <div id="error_colorpicker"></div>									
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文字大小<span class="text-red">*</span></label>
          <div class="col-md-10">
               <select name="logofontsize" id="logofontsize" class="form-control">
                  <option value="18px" <?php if (!(strcmp("18px", $row_RecordTmpLogo['logofontsize']))) {echo "selected=\"selected\"";} ?>>小</option>
                  <option value="24px" <?php if (!(strcmp("24px", $row_RecordTmpLogo['logofontsize']))) {echo "selected=\"selected\"";} ?>>中</option>
                  <option value="36px" <?php if (!(strcmp("36px", $row_RecordTmpLogo['logofontsize']))) {echo "selected=\"selected\"";} ?>>大</option>
                  <option value="48px" <?php if (!(strcmp("48px", $row_RecordTmpLogo['logofontsize']))) {echo "selected=\"selected\"";} ?>>特大</option>
                </select>
               
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
            <input name="logotype" type="hidden" id="logotype" value="1" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_TmpLogo" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script>
$(document).ready(function() {
	$("#colorpicker-prepend").colorpicker({format:"hex"});
}); 
</script>
<?php
mysqli_free_result($RecordTmpLogoListType);
?>
