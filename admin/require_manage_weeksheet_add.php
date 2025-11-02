<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_weeksheet")) {
  $insertSQL = sprintf("INSERT INTO salary_weeksheet (code, title, day0, day1, day2, day3, day4, day5, day6, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['code'], "text"),
					   GetSQLValueString($_POST['title'], "text"),
					   GetSQLValueString($_POST['day0'], "text"),
                       GetSQLValueString($_POST['day1'], "text"),
                       GetSQLValueString($_POST['day2'], "text"),
					   GetSQLValueString($_POST['day3'], "text"),
					   GetSQLValueString($_POST['day4'], "text"),
					   GetSQLValueString($_POST['day5'], "text"),
					   GetSQLValueString($_POST['day6'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_weeksheet.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 


$colname_RecordWorksheet = "-1";
if (isset($_GET['lang'])) {
  $colname_RecordWorksheet = $_GET['lang'];
}
$coluserid_RecordWorksheet = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWorksheet = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE lang = %s && userid=%s", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i>  周排班表 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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

  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">周別代號<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="code" type="text" id="code" maxlength="100" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="title" type="text" id="title" maxlength="100" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">星期日排班<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day0" id="day0" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇排班 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWorksheet['id']?>"><?php echo $row_RecordWorksheet['code']; ?> <?php echo $row_RecordWorksheet['title']; ?> <?php echo "[上班時段 ".$row_RecordWorksheet['worktimestart']; ?> - <?php echo $row_RecordWorksheet['worktimeend'] ."]"; ?> <?php echo "[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"; ?> <?php echo "[休息時段 ".$row_RecordWorksheet['resttimestart']; ?> - <?php echo $row_RecordWorksheet['resttimeend'] ."]"; ?> <?php echo "[遲到 ".$row_RecordWorksheet['worktimelate']."]"; ?></option>
								<?php
				} while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet));
				  $rows = mysqli_num_rows($RecordWorksheet);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWorksheet, 0);
					  $row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">星期一排班<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day1" id="day1" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇排班 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWorksheet['id']?>"><?php echo $row_RecordWorksheet['code']; ?> <?php echo $row_RecordWorksheet['title']; ?> <?php echo "[上班時段 ".$row_RecordWorksheet['worktimestart']; ?> - <?php echo $row_RecordWorksheet['worktimeend'] ."]"; ?> <?php echo "[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"; ?> <?php echo "[休息時段 ".$row_RecordWorksheet['resttimestart']; ?> - <?php echo $row_RecordWorksheet['resttimeend'] ."]"; ?> <?php echo "[遲到 ".$row_RecordWorksheet['worktimelate']."]"; ?></option>
								<?php
				} while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet));
				  $rows = mysqli_num_rows($RecordWorksheet);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWorksheet, 0);
					  $row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">星期二排班<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day2" id="day2" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇排班 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWorksheet['id']?>"><?php echo $row_RecordWorksheet['code']; ?> <?php echo $row_RecordWorksheet['title']; ?> <?php echo "[上班時段 ".$row_RecordWorksheet['worktimestart']; ?> - <?php echo $row_RecordWorksheet['worktimeend'] ."]"; ?> <?php echo "[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"; ?> <?php echo "[休息時段 ".$row_RecordWorksheet['resttimestart']; ?> - <?php echo $row_RecordWorksheet['resttimeend'] ."]"; ?> <?php echo "[遲到 ".$row_RecordWorksheet['worktimelate']."]"; ?></option>
								<?php
				} while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet));
				  $rows = mysqli_num_rows($RecordWorksheet);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWorksheet, 0);
					  $row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">星期三排班<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day3" id="day3" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇排班 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWorksheet['id']?>"><?php echo $row_RecordWorksheet['code']; ?> <?php echo $row_RecordWorksheet['title']; ?> <?php echo "[上班時段 ".$row_RecordWorksheet['worktimestart']; ?> - <?php echo $row_RecordWorksheet['worktimeend'] ."]"; ?> <?php echo "[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"; ?> <?php echo "[休息時段 ".$row_RecordWorksheet['resttimestart']; ?> - <?php echo $row_RecordWorksheet['resttimeend'] ."]"; ?> <?php echo "[遲到 ".$row_RecordWorksheet['worktimelate']."]"; ?></option>
								<?php
				} while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet));
				  $rows = mysqli_num_rows($RecordWorksheet);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWorksheet, 0);
					  $row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">星期四排班<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day4" id="day4" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇排班 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWorksheet['id']?>"><?php echo $row_RecordWorksheet['code']; ?> <?php echo $row_RecordWorksheet['title']; ?> <?php echo "[上班時段 ".$row_RecordWorksheet['worktimestart']; ?> - <?php echo $row_RecordWorksheet['worktimeend'] ."]"; ?> <?php echo "[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"; ?> <?php echo "[休息時段 ".$row_RecordWorksheet['resttimestart']; ?> - <?php echo $row_RecordWorksheet['resttimeend'] ."]"; ?> <?php echo "[遲到 ".$row_RecordWorksheet['worktimelate']."]"; ?></option>
								<?php
				} while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet));
				  $rows = mysqli_num_rows($RecordWorksheet);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWorksheet, 0);
					  $row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">星期五排班<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day5" id="day5" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇排班 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWorksheet['id']?>"><?php echo $row_RecordWorksheet['code']; ?> <?php echo $row_RecordWorksheet['title']; ?> <?php echo "[上班時段 ".$row_RecordWorksheet['worktimestart']; ?> - <?php echo $row_RecordWorksheet['worktimeend'] ."]"; ?> <?php echo "[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"; ?> <?php echo "[休息時段 ".$row_RecordWorksheet['resttimestart']; ?> - <?php echo $row_RecordWorksheet['resttimeend'] ."]"; ?> <?php echo "[遲到 ".$row_RecordWorksheet['worktimelate']."]"; ?></option>
								<?php
				} while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet));
				  $rows = mysqli_num_rows($RecordWorksheet);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWorksheet, 0);
					  $row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">星期六排班<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day6" id="day6" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇排班 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWorksheet['id']?>"><?php echo $row_RecordWorksheet['code']; ?> <?php echo $row_RecordWorksheet['title']; ?> <?php echo "[上班時段 ".$row_RecordWorksheet['worktimestart']; ?> - <?php echo $row_RecordWorksheet['worktimeend'] ."]"; ?> <?php echo "[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"; ?> <?php echo "[休息時段 ".$row_RecordWorksheet['resttimestart']; ?> - <?php echo $row_RecordWorksheet['resttimeend'] ."]"; ?> <?php echo "[遲到 ".$row_RecordWorksheet['worktimelate']."]"; ?></option>
								<?php
				} while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet));
				  $rows = mysqli_num_rows($RecordWorksheet);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWorksheet, 0);
					  $row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
				  }
				?>
				    </select>
                    
 
                   
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
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control date-picker" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/> 
                 
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
      <input type="hidden" name="MM_insert" value="form_weeksheet" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
$(document).ready(function() {
			$("#change_unit01").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:left;\" />");
			});
			
			$("#change_unit02").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:right;\" />");
			});
			
			$("#change_unit03").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:none;\" /><br />");
			});
			
			$("#change_unit04").click(function(){
					CKEDITOR.instances.content.insertHtml("<p style=\"text-align:center\"><img alt=\"\" height=\"180\" src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" style=\"display: block; margin: auto;\" width=\"240\" /></p>");
			});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>
