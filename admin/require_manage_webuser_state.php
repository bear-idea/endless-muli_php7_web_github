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
  $updateSQL = sprintf("UPDATE demo_admin SET email=%s, urlbuilddate=%s, webenabledate=%s, webrenewdate=%s, usetime=%s, urllocalate=%s, urlonly=%s, urllink=%s, urllink2=%s, urlenable=%s WHERE id=%s",
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['urlbuilddate'], "date"),
                       GetSQLValueString($_POST['webenabledate'], "date"),
                       GetSQLValueString($_POST['webrenewdate'], "date"),
                       GetSQLValueString($_POST['usetime'], "int"),
                       GetSQLValueString($_POST['urllocalate'], "text"),
                       GetSQLValueString($_POST['urlonly'], "int"),
                       GetSQLValueString(trim($_POST['urllink']), "text"),
					   GetSQLValueString(trim($_POST['urllink2']), "text"),
                       GetSQLValueString($_POST['urlenable'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$colname_RecordWebState = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordWebState = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebState = sprintf("SELECT * FROM demo_admin WHERE id = %s", GetSQLValueString($colname_RecordWebState, "int"));
$RecordWebState = mysqli_query($DB_Conn, $query_RecordWebState) or die(mysqli_error($DB_Conn));
$row_RecordWebState = mysqli_fetch_assoc($RecordWebState);
$totalRows_RecordWebState = mysqli_num_rows($RecordWebState);
?>

<script type="text/javascript">
<!--
function CheckFields()
{	
	// 檢查『名稱』欄位
	var fieldvalue = document.getElementById("usetime").value;
	if (fieldvalue > 0) 
	{
		if(document.getElementById("webenabledate").value == "")
		{
			alert("網址啟用日欄位尚未填寫！！");
			document.getElementById("webenabledate").focus();
			return false;
		}
		if(document.getElementById("webrenewdate").value == "")
		{
			alert("網站最後續約日欄位尚未填寫！！");
			document.getElementById("webrenewdate").focus();
			return false;
		}
		
	}
}
//-->
</script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 網站狀態 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-cog"></i> 設定資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本設定</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">是否申請獨立網址 <span class="text-red">*</span></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordWebState['urlonly'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="urlonly" id="urlonly_1" value="1" />
                <label for="urlonly_1">是</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordWebState['urlonly'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="urlonly" id="urlonly_2" value="0" />
                <label for="urlonly_2">無</label>
            </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">獨立網址(主)</label>
          <div class="col-md-10">
                      
                      <input name="urllink" type="url" class="form-control" id="urllink" value="<?php echo $row_RecordWebState['urllink']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">獨立網址(次)</label>
          <div class="col-md-10">
                      
                      <input name="urllink2" type="url" class="form-control" id="urllink2" value="<?php echo $row_RecordWebState['urllink2']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">是否信件通知<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordWebState['urlenable'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="urlenable" id="urlenable_1" value="1" />
                <label for="urlenable_1">否</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordWebState['urlenable'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="urlenable" id="urlenable_2" value="0" />
                <label for="urlenable_2">是</label>
            </div>
            <small>設定停用則不會再次寄出通知信件，此選項僅告知網址是否到期</small>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">E-mail <i class="fa fa-info-circle text-orange" data-original-title="通知信件信箱。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
              <input name="email" type="email" class="form-control" id="email" value="<?php echo $row_RecordWebState['email']; ?>"  maxlength="200" data-parsley-trigger="blur"/>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網址註冊日</label>
          <div class="col-md-10">
              <input name="urlbuilddate" type="text" class="form-control" id="urlbuilddate" value="<?php echo $row_RecordWebState['urlbuilddate']; ?>" data-provide="datepicker" data-date-language="zh-TW" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網址註冊地</label>
          <div class="col-md-10">
                      
                      <input name="urllocalate" type="TEXT" class="form-control" id="urllocalate" value="<?php echo $row_RecordWebState['urllocalate']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 限制使用時間</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網址啟用日 <i class="fa fa-info-circle text-orange" data-original-title="僅首次使用需填寫及修改紀錄首次啟用時間。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>僅首次使用需填寫及修改紀錄首次啟用時間。</b></div>
              <input name="webenabledate" type="text" class="form-control" id="webenabledate" value="<?php echo $row_RecordWebState['webenabledate']; ?>"  data-date-language="zh-TW" data-parsley-trigger="blur" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/" /> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站最後續約日 <i class="fa fa-info-circle text-orange" data-original-title="續約之日期，此欄若需限定客戶使用時間必填。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>續約之日期，此欄若需限定客戶使用時間必填。</b></div>
              <input name="webrenewdate" type="text" class="form-control" id="webrenewdate" value="<?php echo $row_RecordWebState['webrenewdate']; ?>"  data-date-language="zh-TW"  data-parsley-trigger="blur" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/" /> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">租用日 <span class="text-red">*</span></label>
          <div class="col-md-10">
                      <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>會以最後續約日天數計算到期日，輸入0代表不限制天數。</b></div>
                      <div class="input-group">
                      <input name="usetime" id="usetime" value="<?php echo $row_RecordWebState['usetime']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                      <span class="input-group-append"><span class="input-group-text">年</span></span>
                      </div>
                            
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordWebState['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordWebState['lang']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script>
$(document).ready(function() {
  $('#webenabledate, #webrenewdate').daterangepicker({
    //timePicker: true,
    //startDate: moment().startOf('hour'),
    //endDate: moment().startOf('hour').add(32, 'hour'),
	autoUpdateInput: false,
	singleDatePicker: false,
	//startDate: "<?php $dt = new DateTime(); echo $dt->format('Y-01-01'); ?>",
    //endDate: "2016-11-28",
	singleDatePicker: true,
	showDropdowns: true,
	autoApply: true,
	showWeekNumbers : false, //是否显示第几周
    timePicker : true, //是否显示小时和分钟
    //timePickerIncrement : 60, //时间的增量，单位为分钟
    //timePicker12Hour : true, //是否使用12小时制来显示时间
	ranges: {
           '今天': [moment(), moment()],
           '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '最近一周': [moment().subtract(6, 'days'), moment()],
           '最近一月': [moment().subtract(29, 'days'), moment()],
           '本月': [moment().startOf('month'), moment().endOf('month')],
           '上個月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
		   '今年': [moment().startOf('year'), moment().endOf('year')],
		   '去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        },
    locale: {	
		 applyLabel : '確定',
		 cancelLabel : '取消',
		 fromLabel : '起始時間',
		 toLabel : '結束時間',
		 customRangeLabel : '自定日期',
		 daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
		 monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
		 firstDay : 1,
		 //format: 'YYYY-MM-DD'
		 format : 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
    }
  });
  
  //选择时间后触发重新加载的方法
       $('input[name="postdate"]').on('apply.daterangepicker',function(){
           //当选择时间后，出发dt的重新加载数据的方法
           reload_table();
           //获取dt请求参数
       });

      $('input[name="postdate"]').on('keyup change',function() {
            reload_table();
        });

	  $('input[name="postdate"]').on('apply.daterangepicker', function(ev, picker) {
		  $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		  reload_table();
	  });
	
	  $('input[name="postdate"]').on('cancel.daterangepicker', function(ev, picker) {
		  $(this).val('');
		  reload_table();
	  });
	  
	  $('.clearBtns').on('click','.clearBtns',function(){
          $('input[name="postdate"]').val('');
		  reload_table();
      });
	   
});
</script>

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordWebState);
?>
