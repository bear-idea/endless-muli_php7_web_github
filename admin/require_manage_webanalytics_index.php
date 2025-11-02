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
  $updateSQL = sprintf("UPDATE demo_setting_fr SET GoogleAnalyticsCodeID=%s WHERE id=%s",
                       GetSQLValueString($_POST['GoogleAnalyticsCodeID'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingFr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingFr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingFr = sprintf("SELECT id, GoogleAnalyticsCode, GoogleAnalyticsCodeID FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingFr, "int"));
$RecordSettingFr = mysqli_query($DB_Conn, $query_RecordSettingFr) or die(mysqli_error($DB_Conn));
$row_RecordSettingFr = mysqli_fetch_assoc($RecordSettingFr);
$totalRows_RecordSettingFr = mysqli_num_rows($RecordSettingFr);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> Google Analytics <small>分析</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 資料修改</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>將在Google Analyiic工具中產生的程式碼貼在下方即可讓您的網站使用分析工具。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>Google Analytics可以提供訪客瀏覽人次、網頁瀏覽人次、用戶的瀏覽器、作業系統、螢量來源、瀏覽頁次、熱門關鍵字、訪客來自於何處等等資料。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>此Google分析工具僅適用擁有獨立網址客戶，例如:www.yourname.com 而 www.shop3500.com/yourname 則是錯誤。</b></div>
  
  <form class="form-horizontal form-bordered" data-parsley-validate="" method="post" action="<?php echo $editFormAction; ?>" id="form1" name="form1" > 
       
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Google Analytics</label>
          <div class="col-md-10">
              
                  <a href="http://www.google.com/intl/zh-TW/analytics/" class="btn btn-link" target="_blank">http://www.google.com/intl/zh-TW/analytics/</a>
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">追蹤編號</label>
          <div class="col-md-10">
              
                  <input name="GoogleAnalyticsCodeID" type="text" id="GoogleAnalyticsCodeID" value="<?php echo $row_RecordSettingFr['GoogleAnalyticsCodeID']; ?>" size="20" maxlength="100" data-parsley-trigger="blur" class="form-control"/>
                                      
          
                      
                      
                 
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

<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip1',
                intro: '<img src="images/tip/tip033.jpg" width="300" height="202" /><br /><br />依照以下的步驟操作，您可透過Google分析工具來分析您網站的流量。'
              },
			  {
                element: '#Step_Reg',
                intro: '首先您必須註冊 Google Analytics ，使用您的Google帳戶即可。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="http://www.google.com/intl/zh-TW/analytics" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往 Google Analytics</a></span></div>'
              },
              {
                element: '#Step_Tip2',
                intro: '註冊完後登入 Google Analytics。'
              },
			  {
                element: '#Step_Tip3',
                intro: '<img src="images/tip/tip035.jpg" width="500" height="399" /><br /><br />依照以下的步驟操作，在 Google Analytics 中建立網站資源。'
              },
			  {
                element: '#Step_Tip4',
                intro: '<img src="images/tip/tip036.jpg" width="500" height="396" /><br /><br />依照以下的步驟操作，在 Google Analytics 設定資料及取得追蹤編號。'
              },
			  {
                element: '#Step_Tip5',
                intro: '<img src="images/tip/tip037.jpg" width="500" height="396" /><br /><br />複製追蹤編號，之後我們要回到網站後台管理系統，將編碼貼上。'
              },
			  {
                element: '#Step_Code',
                intro: '貼上在 Google Analytics 取得的追蹤編碼。'
              },
              {
                element: '#Step_Send',
                intro: '送出資料。',
                position: 'bottom'
              },
              {
                element: '#Step_View',
                intro: '設置完後您必須等待Google系統的收錄，約2-3天。',
                position: 'bottom'
              }
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
