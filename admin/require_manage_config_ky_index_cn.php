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

// 取代特殊符號
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$_POST['SiteKeyWord'] = str_replace ("，",",",$_POST['SiteKeyWord']);
	$_POST['SiteKeyWord'] = str_replace (".",",",$_POST['SiteKeyWord']);
	$_POST['SiteKeyWord'] = str_replace ("、",",",$_POST['SiteKeyWord']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_fr SET SiteName_cn=%s, SitePrivate=%s, SiteKeyWord_cn=%s, SiteDesc_cn=%s WHERE id=%s",
                       GetSQLValueString($_POST['SiteName'], "text"),
					   GetSQLValueString($_POST['SitePrivate'], "text"),
                       GetSQLValueString(htmlspecialchars($_POST['SiteKeyWord']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['SiteDesc']), "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingFr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingFr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingFr = sprintf("SELECT id, SiteName_cn, SitePrivate, SiteKeyWord_cn, SiteDesc_cn FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingFr, "int"));
$RecordSettingFr = mysqli_query($DB_Conn, $query_RecordSettingFr) or die(mysqli_error($DB_Conn));
$row_RecordSettingFr = mysqli_fetch_assoc($RecordSettingFr);
$totalRows_RecordSettingFr = mysqli_num_rows($RecordSettingFr);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 網站關鍵字 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站名稱<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="『瀏覽器抬頭文字』 是您的網站是否被Yahoo或Google成功收錄一個重要的依據，通常皆以公司名稱或店名作填寫。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="SiteName" type="text" class="form-control" id="SiteName" value="<?php echo $row_RecordSettingFr['SiteName_cn']; ?>" maxlength="100" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">網頁隱私<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="用來告知搜尋引擎該網頁是否可被搜尋。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
              <select name="SitePrivate" id="SitePrivate" class="form-control" data-parsley-trigger="blur" required="">
      	      <option value="index,follow" <?php if (!(strcmp("index,follow", $row_RecordSettingFr['SitePrivate']))) {echo "selected=\"selected\"";} ?>>允許搜尋引擎檢索整個網站。</option>
      	      <option value="noindex,nofollow" <?php if (!(strcmp("noindex,nofollow", $row_RecordSettingFr['SitePrivate']))) {echo "selected=\"selected\"";} ?>>禁止搜尋引擎檢索整個網站。</option>
          </select>  
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               
            <input name="SiteKeyWord" type="text" class="form-control" id="SiteKeyWord" value="<?php echo $row_RecordSettingFr['SiteKeyWord_cn']; ?>" maxlength="300" data-role="tagsinput" />
               <div class="alert alert-warning m-t-5"><i class="fa fa-info-circle"></i> <b>填入網站關鍵字，輸入完按Enter即可輸入下一個或直接輸入以 【,】分隔的單字，例如【Shop3500,網頁設計,SEO】資料送出後會替您分開，【,】為英文單字的逗號，錯誤範例為【，】【、】及空白。</b></div>
               
               <div class="alert alert-warning m-t-5"><b>
               <i class="fa fa-info-circle"></i> 提示1： 輸入字數越少分數越高， 建議關鍵字以30字內，例如輸入『男裝』會比輸入『男裝,皮帶,襯衫』分數高<br />
               <i class="fa fa-info-circle"></i> 提示2： 關聯性越高則分數越高，例如輸入『男裝,皮帶,襯衫』會比輸入『男裝,家電,美食』分數高<br />
               <i class="fa fa-info-circle"></i> 提示3：網頁內文中若含有您設定的關鍵字，則會加分<br />
               <i class="fa fa-info-circle"></i> 提示4：輸入的關鍵字必須與網頁內文相關，例如您是賣衣服卻輸入『家電』會被扣分</b></div>
               
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站描述 <i class="fa fa-info-circle text-orange" data-original-title="沒有給網站描述時，搜尋引擎通常會自動抓網頁的前25字做為網頁內容摘要，呈現在搜尋結果上。但有時網頁的前25字可能未必能表達文章的宗旨。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <textarea name="SiteDesc" cols="100" class="form-control" id="SiteDesc"><?php echo $row_RecordSettingFr['SiteDesc_cn']; ?></textarea> 
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSettingFr['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordSettingFr);
?>
