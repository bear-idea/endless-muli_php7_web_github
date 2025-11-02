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

$coluserid_RecordWeeksheet = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWeeksheet = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWeeksheet = sprintf("SELECT * FROM salary_weeksheet WHERE userid=%s",GetSQLValueString($coluserid_RecordWeeksheet, "int"));
$RecordWeeksheet = mysqli_query($DB_Conn, $query_RecordWeeksheet) or die(mysqli_error($DB_Conn));
$row_RecordWeeksheet = mysqli_fetch_assoc($RecordWeeksheet);
$totalRows_RecordWeeksheet = mysqli_num_rows($RecordWeeksheet);

if ((isset($_POST["MM_del"])) && ($_POST["MM_del"] == "form_weeksheet") && $totalRows_RecordWeeksheet > 0 ) {
  $deleteSQL = sprintf("DELETE FROM salary_weeksheet WHERE userid=%s",
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $insertGoTo = "manage_weeksheet.php?Opt=genpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_weeksheet") && $totalRows_RecordWeeksheet == 0 ) {
	
$colname_RecordWorksheet = "-1";
if (isset($_POST['lang'])) {
  $colname_RecordWorksheet = $_POST['lang'];
}
$coluserid_RecordWorksheet = "-1";
if (isset($_POST['userid'])) {
  $coluserid_RecordWorksheet = $_POST['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE lang = %s && userid=%s", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);

    if($totalRows_RecordWorksheet > 0) {
	
	    $i = 1;
		
		do {
		 
		 $code = "W" . ($i++);
		    
			$insertSQL = sprintf("INSERT INTO salary_weeksheet (code, title, day0, day1, day2, day3, day4, day5, day6, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($code, "text"),
							   GetSQLValueString($row_RecordWorksheet['title'], "text"),
							   GetSQLValueString($row_RecordWorksheet['id'], "text"),
							   GetSQLValueString($row_RecordWorksheet['id'], "text"),
							   GetSQLValueString($row_RecordWorksheet['id'], "text"),
							   GetSQLValueString($row_RecordWorksheet['id'], "text"),
							   GetSQLValueString($row_RecordWorksheet['id'], "text"),
							   GetSQLValueString($row_RecordWorksheet['id'], "text"),
							   GetSQLValueString($row_RecordWorksheet['id'], "text"),
							   GetSQLValueString(date("Y-m-d"), "date"),
							   GetSQLValueString(1, "int"),
							   GetSQLValueString("", "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  
		} while ($row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet)); 
	
	}

 
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_weeksheet.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 周排班表 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 產生資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <?php if($totalRows_RecordWeeksheet == 0) { ?>
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  
     <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>此功能將自動產生周排班表項目。</b></div>	

      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">產生基本周排班表項目</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_weeksheet" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordWeeksheet > 0) { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前已有產生資料，若欲重新產生請將之清空</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">清空資料表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_del" value="form_weeksheet" />
  </form>
  <?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
