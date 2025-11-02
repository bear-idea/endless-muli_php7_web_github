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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModList = "SELECT * FROM demo_configitem";
$RecordModList = mysqli_query($DB_Conn, $query_RecordModList) or die(mysqli_error($DB_Conn));
$row_RecordModList = mysqli_fetch_assoc($RecordModList);
$totalRows_RecordModList = mysqli_num_rows($RecordModList);

$colnamelang_RecordDfType = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordDfType = $_GET['lang'];
}
$coluserid_RecordDfType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfType = sprintf("SELECT * FROM demo_dftype WHERE lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordDfType, "text"),GetSQLValueString($coluserid_RecordDfType, "int"));
$RecordDfType = mysqli_query($DB_Conn, $query_RecordDfType) or die(mysqli_error($DB_Conn));
$row_RecordDfType = mysqli_fetch_assoc($RecordDfType);
$totalRows_RecordDfType = mysqli_num_rows($RecordDfType);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_DfType")) {
  $insertSQL = sprintf("INSERT INTO demo_dftype (title, typemenu, indicate, notes1, link, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
					   GetSQLValueString($_POST['typemenu'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['link'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_dfpage.php?Opt=typepage&lang=". $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<style>
.mod_pic,.mod_text{vertical-align:middle;text-align:center}.mod_pic,.mod_text{text-align:center}.mod_board{width:120px;}.mod_pic{padding:5px}
</style>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['DfType']; ?> <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" id="form1">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="title" type="text" id="title" maxlength="50" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">模組<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          <div class="row">
          
          <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_019.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Home" id="typemenu_Home" />
                  <label for="typemenu_Home">回首頁</label>
             </div>
             </div>
             </div>
             
           <?php $i=0 ?>
           <?php do { ?>
           <?php require("inc_modlist_add.php"); // 取得模組清單 ?>
           <?php $i++ ?>
           <?php } while ($row_RecordModList = mysqli_fetch_assoc($RecordModList)); ?>

             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_053.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Link" id="typemenu_Link"/>
                  <label for="typemenu_Link">它網連結 <i class="fa fa-info-circle text-orange" data-original-title="此模組會內連到外部網站並開新視窗，選擇此項目後在《網址》輸入網址即可。" data-toggle="tooltip" data-placement="top"></i></label>
             </div>
             </div>
             </div>
             
             <?php //if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_054.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="LinkPage" id="typemenu_LinkPage" />
                  <label for="typemenu_LinkPage">頁面連結 <i class="fa fa-info-circle text-orange" data-original-title="此模組會內連到內部網站，選擇此項目後在《網址》輸入網址即可。" data-toggle="tooltip" data-placement="top"></i></label>
             </div>
             </div>
             </div>
             <?php //} ?>
             
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_125.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="AnchorPoint" id="typemenu_AnchorPoint" />
                  <label for="typemenu_AnchorPoint">錨點 <i class="fa fa-info-circle text-orange" data-original-title="此模組可設定可以快速的定位到指定元素，並將元素置於頁面最頂端。" data-toggle="tooltip" data-placement="top"></i></label>
             </div>
             </div>
             </div>
             
             <?php if ($OptionCartSelect == '1') {?>
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_088.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Cart_Pay" id="typemenu_Cart_Pay"/>
                  <label for="typemenu_Cart_Pay">匯款通知</label>
             </div>
             </div>
             </div>
             
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_091.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Cart_Note" id="typemenu_Cart_Note"/>
                  <label for="typemenu_Cart_Note">購物須知</label>
             </div>
             </div>
             </div>
             <?php } ?>
             
             <?php if ($OptionScaleSourceSelect == '1') {?>
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_101.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Scalesource" id="typemenu_Scalesource" />
                  <label for="typemenu_Scalesource">貨源管理</label>
             </div>
             </div>
             </div>
             <?php } ?>
             
             <?php if ($OptionScaleClearanceSelect == '1') {?>
             <div class="mod_board col-md-2 col-sm-3 col-xs-4">
               <div class="mod_pic"><img src="images/mt_109.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="ScaleClearance" id="typemenu_ScaleClearance" />
                  <label for="typemenu_ScaleClearance">清運明細</label>
             </div>
             </div>
             </div>
             <?php } ?>
             
             <?php if ($OptionSplitOrderSelect == '1') {?>
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_107.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Splitorder" id="typemenu_Splitorder" />
                  <label for="typemenu_Splitorder">物料拆分</label>
             </div>
             </div>
             </div>
             <?php } ?>
			  
			 <?php if ($OptionBookingSelect == '1') {?>
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_105.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Booking" id="typemenu_Booking" />
                  <label for="typemenu_Booking">預約系統</label>
             </div>
             </div>
             </div>
             <?php } ?>
             
             
             <div style="clear:both"></div>
             
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網址</label>
          <div class="col-md-10">
          
                      <input name="link" data-parsley-type="url" pattern= "/^(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?$/i" id="link" maxlength="200" class="form-control" data-parsley-trigger="blur" placeholder="http://www.yoururl.com"/>
                      
                      <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>如欲連結其他外部網站本欄才需填寫，而模組請選擇 它網連結。</b></div>
                      
                 
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
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_DfType" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->


<script type="text/javascript">
$(function () {
  $('#form1').parsley().on('form:validate', function (formInstance) {
  });
});
</script>

<?php
mysqli_free_result($RecordModList);

mysqli_free_result($RecordDfType);
?>
