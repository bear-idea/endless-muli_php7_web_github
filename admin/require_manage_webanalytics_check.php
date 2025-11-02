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


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_fr SET GoogleVerificationCode=%s WHERE id=%s",
                       GetSQLValueString(htmlspecialchars($_POST['GoogleVerificationCode']), "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE demo_setting_fr SET YahooVerificationCode=%s WHERE id=%s",
                       GetSQLValueString(htmlspecialchars($_POST['YahooVerificationCode']), "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingFr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingFr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingFr = sprintf("SELECT id, GoogleVerificationCode, YahooVerificationCode FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingFr, "int"));
$RecordSettingFr = mysqli_query($DB_Conn, $query_RecordSettingFr) or die(mysqli_error($DB_Conn));
$row_RecordSettingFr = mysqli_fetch_assoc($RecordSettingFr);
$totalRows_RecordSettingFr = mysqli_num_rows($RecordSettingFr);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 驗證網站所有權 <small>驗證</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro_Google();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startIntro_Google" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> Google 網站管理工具</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>為使用Google Search Console提供的功能，將之提供的驗證代碼貼入下方送出即可。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>Google Search Console 是 Google 提供的一項免費服務，能夠協助您監控及維持網站在 Google 搜尋結果中的排名。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>在使用此工具前請務必驗證您網站的使用權。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>驗證網站請選擇【其他方法】中的【HTML 標記】。</b></div>
  
  <form class="form-horizontal form-bordered" data-parsley-validate="" method="post" action="<?php echo $editFormAction; ?>" id="form1" name="form1" > 
       
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Google 驗證網站</label>
          <div class="col-md-10">
              
                  <a href="http://www.google.com/intl/zh-TW/analytics/" class="btn btn-link" target="_blank">http://www.google.com/intl/zh-TW/analytics/</a>
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">HTML 標記</label>
          <div class="col-md-10">
              
            <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">&#60;meta name=&#34;google-site-verification&#34; content=&#34;</span></div>
              <input name="GoogleVerificationCode" type="text" id="GoogleVerificationCode" value="<?php echo $row_RecordSettingFr['GoogleVerificationCode']; ?>" size="20" maxlength="100" data-parsley-trigger="blur" class="form-control"/>
              <div class="input-group-append"><span class="input-group-text">&#34;/&#62;</span></div>
                                      
              </div>
                                      
          
                      
                      
                 
          </div>
      </div>
 
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" id="Step_Send">送出</button>
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

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro_Yahoo();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startIntro_Yahoo" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i>  Yahoo(Bing) 網站管理工具</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>為使用Bing網站管理員工具提供的功能，將之提供的驗證代碼貼入下方送出即可。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>Google Search Console 是 Google 提供的一項免費服務，能夠協助您監控及維持網站在 Google 搜尋結果中的排名。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>在使用此工具前請務必驗證您網站的使用權。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>驗證網站請選擇 【複製 &#60;meta&#62; 標籤並貼到您的預設網頁】。</b></div>
  
  <form class="form-horizontal form-bordered" data-parsley-validate="" method="post" action="<?php echo $editFormAction; ?>" id="form1" name="form1" > 
       
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Yahoo(Bing) 驗證網站</label>
          <div class="col-md-10">
              
                  <a href="http://www.bing.com/toolbox/webmaster/" class="btn btn-link" target="_blank">http://www.bing.com/toolbox/webmaster/</a>
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">HTML 標記</label>
          <div class="col-md-10">
              
            <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">&#60;meta name=&#34;msvalidate.01&#34; content=&#34;</span></div>
              <input name="YahooVerificationCode" type="text" id="YahooVerificationCode" value="<?php echo $row_RecordSettingFr['YahooVerificationCode']; ?>" size="20" maxlength="100" data-parsley-trigger="blur" class="form-control"/>
              <div class="input-group-append"><span class="input-group-text">&#34;/&#62;</span></div>
                                      
            </div>
                                      
          
                      
                      
                 
          </div>
      </div>
 
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" id="Step_Send">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSettingFr['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
        </div>
      </div>
      
      
  <input type="hidden" name="MM_update" value="form2" />
  </form>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
      function startIntro_Google(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip1',
                intro: '<img src="images/tip/tip038.jpg" width="280" height="180" /><br /><br />由於使用Google的網站管理工具，必須驗證網站所有權，因此我們提供驗證網站的功能，方便您使用Google網站管理工具。'
              },
			  {
                element: '#Step_Reg_Google',
                intro: '首先您必須註冊 Search Console ，使用您的Google帳戶即可。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="https://www.google.com/webmasters/tools/home?hl=zh-TW" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往 Search Console</a></span></div>'
              },
              {
                element: '#Step_Tip2',
                intro: '註冊完後登入 Search Console。'
              },
			  {
                element: '#Step_Tip3',
                intro: '<img src="images/tip/tip039.jpg" width="500" height="392" /><br /><br />依照以下的步驟操作，在 Search Console 中建立網站資源。'
              },
			  {
                element: '#Step_Tip4',
                intro: '<img src="images/tip/tip040.jpg" width="500" height="396" /><br /><br />輸入網站網址。'
              },
			  {
                element: '#Step_Tip5',
                intro: '<img src="images/tip/tip041.jpg" width="500" height="359" /><br /><br />依照以下的步驟操作，透過HTML標記驗證網站並複製代碼，之後我們要回到網站後台管理系統，將編碼貼上，注意!!此頁面暫不需關閉!!稍後必須點選驗證按鈕。'
              },
			  {
                element: '#Step_Code_Google',
                intro: '貼上在 Search Console 取得的代碼。'
              },
              {
                element: '#Step_Send_Google',
                intro: '送出資料。',
                position: 'bottom'
              },
              {
                element: '#Step_Tip6',
                intro: '設置完後前往 Search Console 驗證網站所有權。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="https://www.google.com/webmasters/tools/home?hl=zh-TW" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往 Search Console</a></span></div>',
                position: 'bottom'
              },
			  {
                element: '#Step_Tip7',
                intro: '<img src="images/tip/tip042.jpg" width="500" height="411" /><br /><br />點選驗證。',
                position: 'bottom'
              },
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>
<script type="text/javascript">
      function startIntro_Yahoo(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip1',
                intro: '<img src="images/tip/tip043.jpg" width="318" height="159" /><br /><br />由於使用Bing的網站管理工具，必須驗證網站所有權，因此我們提供驗證網站的功能，方便您使用Bing網站管理工具。'
              },
			  {
                element: '#Step_Reg_Yahoo',
                intro: '首先您必須註冊 Bing 網站管理員工具 ，使用您的 Microsoft 帳戶即可。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="http://www.bing.com/toolbox/webmaster/" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往 Bing 網站管理員工具</a></span></div>'
              },
              {
                element: '#Step_Tip2',
                intro: '註冊完後登入 Bing 網站管理員工具。'
              },
			  {
                element: '#Step_Tip3',
                intro: '<img src="images/tip/tip044.jpg" width="500" height="397" /><br /><br />依照以下的步驟操作，在 Bing 網站管理員工具 中建立網站資源。'
              },
			  {
                element: '#Step_Tip4',
                intro: '<img src="images/tip/tip045.jpg" width="500" height="390" /><br /><br />點選新增。'
              },
			  {
                element: '#Step_Tip5',
                intro: '<img src="images/tip/tip046.jpg" width="500" height="366" /><br /><br />依照以下的步驟操作，透過HTML標記驗證網站並複製代碼，之後我們要回到網站後台管理系統，將編碼貼上，注意!!此頁面暫不需關閉!!稍後必須點選驗證按鈕。'
              },
			  {
                element: '#Step_Code_Yahoo',
                intro: '貼上在 Bing 網站管理員工具 取得的代碼。'
              },
              {
                element: '#Step_Send_Yahoo',
                intro: '送出資料。',
                position: 'bottom'
              },
              {
                element: '#Step_Tip6',
                intro: '設置完後前往 Search Console 驗證網站所有權。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="http://www.bing.com/toolbox/webmaster/" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往 Bing 網站管理員工具</a></span></div>',
                position: 'bottom'
              },
			  {
                element: '#Step_Tip7',
                intro: '<img src="images/tip/tip047.jpg" width="500" height="417" /><br /><br />點選驗證。',
                position: 'bottom'
              },
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "addSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php
mysqli_free_result($RecordSettingFr);
?>