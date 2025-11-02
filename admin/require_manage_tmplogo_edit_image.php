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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpLogo")) {
  $updateSQL = sprintf("UPDATE demo_tmplogo SET name=%s, type=%s, logotype=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['logotype'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_tmp.php?Opt=logoviewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別列表 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogoListType = "SELECT * FROM demo_tmpitem WHERE list_id = 6";
$RecordTmpLogoListType = mysqli_query($DB_Conn, $query_RecordTmpLogoListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType);
$totalRows_RecordTmpLogoListType = mysqli_num_rows($RecordTmpLogoListType);

$colid_RecordTmpLogo = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpLogo = $_GET['id_edit'];
}
$coluserid_RecordTmpLogo = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpLogo = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogo = sprintf("SELECT * FROM demo_tmplogo WHERE id=%s && userid=%s", GetSQLValueString($colid_RecordTmpLogo, "int"),GetSQLValueString($coluserid_RecordTmpLogo, "int"));
$RecordTmpLogo = mysqli_query($DB_Conn, $query_RecordTmpLogo) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogo = mysqli_fetch_assoc($RecordTmpLogo);
$totalRows_RecordTmpLogo = mysqli_num_rows($RecordTmpLogo);
/* 插入資料 */
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> Logo <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordTmpLogo['name']; ?>" maxlength="50" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
            <select name="type" id="type" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="" <?php if (!(strcmp(-1, $row_RecordTmpLogo['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordTmpLogoListType['itemname']?>" <?php if (!(strcmp($row_RecordTmpLogoListType['itemname'], $row_RecordTmpLogo['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordTmpLogoListType['itemname']?></option>
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
          <label class="col-md-2 col-form-label">圖片【繁體】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <a href="uplod_tmplogo_tw.php?id_edit=<?php echo $row_RecordTmpLogo['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               <?php if ($defaultlang == "zh-tw") { ?>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前圖片長寬以圖片【繁體】為準。</b></div>
               <?php } ?>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseZHCN == 1 || $defaultlang == 'zh-cn') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【简体】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <a href="uplod_tmplogo_cn.php?id_edit=<?php echo $row_RecordTmpLogo['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a> 
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               <?php if ($defaultlang == "zh-cn") { ?>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前圖片長寬以圖片【简体】為準。</b></div>
               <?php } ?>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseEN == 1 || $defaultlang == 'en') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【English】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <a href="uplod_tmplogo_en.php?id_edit=<?php echo $row_RecordTmpLogo['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               <?php if ($defaultlang == "en") { ?>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前圖片長寬以圖片【English】為準。</b></div>
               <?php } ?>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseJP == 1 || $defaultlang == 'jp') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【日本語】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <a href="uplod_tmplogo_jp.php?id_edit=<?php echo $row_RecordTmpLogo['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a> 
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               <?php if ($defaultlang == "jp") { ?>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前圖片長寬以圖片【<span class="col-md-2 col-form-label">日本語</span>】為準。</b></div>
               <?php } ?>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseKR == 1 || $defaultlang == 'kr') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【한국어】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <a href="uplod_tmplogo_kr.php?id_edit=<?php echo $row_RecordTmpLogo['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a> 
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               <?php if ($defaultlang == "jp") { ?>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前圖片長寬以圖片【<span class="col-md-2 col-form-label">한국어</span>】為準。</b></div>
               <?php } ?>
               
          </div>
      </div>
      <?php } ?>
      <?php if ($LangChooseSP == 1 || $defaultlang == 'sp') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片【Español】<span class="text-red">*</span></label>
          <div class="col-md-10">
               <a href="uplod_tmplogo_sp.php?id_edit=<?php echo $row_RecordTmpLogo['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a> 
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>若上傳多個語系的Logo圖片，請皆上傳同樣尺寸。</b></div>
               <?php if ($defaultlang == "jp") { ?>
               <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前圖片長寬以圖片【<span class="col-md-2 col-form-label">Español</span>】為準。</b></div>
               <?php } ?>
               
          </div>
      </div>
      <?php } ?>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordTmpLogo['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" />
            <input name="logotype" type="hidden" id="logotype" value="0" />
            <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_TmpLogo" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordTmpLogoListType);

mysqli_free_result($RecordTmpLogo);
?>
