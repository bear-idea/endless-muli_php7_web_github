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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Socialchat")) {
	
  if($_POST["serviceday1_start"] != "" && $_POST["serviceday1_end"] != "" && $_POST["serviceday1_end"] > $_POST["serviceday1_start"]) { $_POST["serviceday1"] = $_POST["serviceday1_start"] . "-" . $_POST["serviceday1_end"]; }
  if($_POST["serviceday2_start"] != "" && $_POST["serviceday2_end"] != "" && $_POST["serviceday2_end"] > $_POST["serviceday2_start"]) { $_POST["serviceday2"] = $_POST["serviceday2_start"] . "-" . $_POST["serviceday2_end"]; }
  if($_POST["serviceday3_start"] != "" && $_POST["serviceday3_end"] != "" && $_POST["serviceday3_end"] > $_POST["serviceday3_start"]) { $_POST["serviceday3"] = $_POST["serviceday3_start"] . "-" . $_POST["serviceday3_end"]; }
  if($_POST["serviceday4_start"] != "" && $_POST["serviceday4_end"] != "" && $_POST["serviceday4_end"] > $_POST["serviceday4_start"]) { $_POST["serviceday4"] = $_POST["serviceday4_start"] . "-" . $_POST["serviceday4_end"]; }
  if($_POST["serviceday5_start"] != "" && $_POST["serviceday5_end"] != "" && $_POST["serviceday5_end"] > $_POST["serviceday5_start"]) { $_POST["serviceday5"] =  $_POST["serviceday5_start"] . "-" . $_POST["serviceday5_end"]; }
  if($_POST["serviceday6_start"] != "" && $_POST["serviceday6_end"] != "" && $_POST["serviceday6_end"] > $_POST["serviceday6_start"]) { $_POST["serviceday6"] = $_POST["serviceday6_start"] . "-" . $_POST["serviceday6_end"]; }
  if($_POST["serviceday7_start"] != "" && $_POST["serviceday7_end"] != "" && $_POST["serviceday7_end"] > $_POST["serviceday7_start"]) { $_POST["serviceday7"] = $_POST["serviceday7_start"] . "-" . $_POST["serviceday7_end"]; }
  
  $updateSQL = sprintf("UPDATE demo_socialchat SET title=%s, socialnameid=%s, serviceday1=%s, serviceday2=%s, serviceday3=%s, serviceday4=%s, serviceday5=%s, serviceday6=%s, serviceday7=%s, sdescription=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
					   GetSQLValueString($_POST['socialnameid'], "text"),
                       GetSQLValueString($_POST['serviceday1'], "text"),
					   GetSQLValueString($_POST['serviceday2'], "text"),
					   GetSQLValueString($_POST['serviceday3'], "text"),
					   GetSQLValueString($_POST['serviceday4'], "text"),
					   GetSQLValueString($_POST['serviceday5'], "text"),
					   GetSQLValueString($_POST['serviceday6'], "text"),
					   GetSQLValueString($_POST['serviceday7'], "text"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_socialchat.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得贊助企業資料 */
$colname_RecordSocialchat = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordSocialchat = $_GET['id_edit'];
}
$coluserid_RecordSocialchat = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSocialchat = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSocialchat = sprintf("SELECT * FROM demo_socialchat WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordSocialchat, "int"),GetSQLValueString($coluserid_RecordSocialchat, "int"));
$RecordSocialchat = mysqli_query($DB_Conn, $query_RecordSocialchat) or die(mysqli_error($DB_Conn));
$row_RecordSocialchat = mysqli_fetch_assoc($RecordSocialchat);
$totalRows_RecordSocialchat = mysqli_num_rows($RecordSocialchat);

?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 人員 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>如何取得LINE的個人專屬URL網址。 <br /><span class="p-l-20">Android【加入好友】→【邀請】→【簡訊】→【隨邊選取一個用戶】→【邀請簡訊即可找到網址】</span><br /><span class="p-l-20">IOS【加入好友】→【行動條碼】→【顯示行動條碼】→【分享】→【即可找到網址】</span></b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="title" type="text" required="" class="form-control" id="title" value="<?php echo $row_RecordSocialchat['title']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">LINE 加入好友網址<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <div class="input-group p-0">
                      <div class="input-group-prepend"><span class="input-group-text">http://line.me/ti/p/</span></div>
                      <input name="socialnameid" type="text" id="socialnameid" value="<?php echo $row_RecordSocialchat['socialnameid']; ?>" size="200" maxlength="100" data-parsley-trigger="blur" class="form-control">                        
                      </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頭像<span class="text-red">*</span></label>
          <div class="col-md-10">
                 <a href="uplod_socialchat.php?id_edit=<?php echo $row_RecordSocialchat['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務時間(星期一)</label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                   <input name="serviceday1_start" type="text" class="form-control" id="serviceday1_start" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday1']); echo $serviceday[0]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="serviceday1_end" type="text" class="form-control" id="serviceday1_end" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday1']); echo $serviceday[1]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務時間(星期二)</label>
          <div class="col-md-5">
            <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                  <input name="serviceday2_start" type="text" class="form-control" id="serviceday2_start" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday2']); echo $serviceday[0]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="serviceday2_end" type="text" class="form-control" id="serviceday2_end" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday2']); echo $serviceday[1]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務時間(星期三)</label>
          <div class="col-md-5">
            <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                  <input name="serviceday3_start" type="text" class="form-control" id="serviceday3_start" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday3']); echo $serviceday[0]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="serviceday3_end" type="text" class="form-control" id="serviceday3_end" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday3']); echo $serviceday[1]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務時間(星期四)</label>
          <div class="col-md-5">
            <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                  <input name="serviceday4_start" type="text" class="form-control" id="serviceday4_start" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday4']); echo $serviceday[0]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="serviceday4_end" type="text" class="form-control" id="serviceday4_end" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday4']); echo $serviceday[1]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務時間(星期五)</label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                   <input name="serviceday5_start" type="text" class="form-control" id="serviceday5_start" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday5']); echo $serviceday[0]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="serviceday5_end" type="text" class="form-control" id="serviceday5_end" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday5']); echo $serviceday[1]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務時間(星期六)</label>
          <div class="col-md-5">
            <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                  <input name="serviceday6_start" type="text" class="form-control" id="serviceday6_start" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday6']); echo $serviceday[0]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
            <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                  <input name="serviceday6_end" type="text" class="form-control" id="serviceday6_end" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday6']); echo $serviceday[1]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
            </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務時間(星期日)</label>
          <div class="col-md-5">
            <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                  <input name="serviceday7_start" type="text" class="form-control" id="serviceday7_start" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday7']); echo $serviceday[0]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
            <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                  <input name="serviceday7_end" type="text" class="form-control" id="serviceday7_end" placeholder="例如：16:00，為24小時制，若不為服務時間請留空" value="<?php $serviceday = explode("-", $row_RecordSocialchat['serviceday7']); echo $serviceday[1]; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" />
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSocialchat['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSocialchat['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述</label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordSocialchat['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordSocialchat['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSocialchat['id']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Socialchat" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordSocialchat);
?>
