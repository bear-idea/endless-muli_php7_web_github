<?php 
$UseMod = "Yearend"; // 目前使用模組
//ob_start(); // 開啟輸出緩衝區
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/* 取得最新訊息資料 */
$colname_RecordYearend = "%";
if (isset($_POST['name'])) {
  $colname_RecordYearend = $_POST['name'];
}
$coljob_RecordYearend = "%";
if (isset($_POST['job'])) {
  $coljob_RecordYearend = $_POST['job'];
}
$coldepartment_RecordYearend = "%";
if (isset($_POST['department'])) {
  $coldepartment_RecordYearend = $_POST['department'];
}
$colparticularyear_RecordYearend = "%";
if (isset($_POST['particularyear']) && $_POST['particularyear'] != "") {
  $colparticularyear_RecordYearend = $_POST['particularyear'];
}
$collang_RecordYearend = "%";
if (isset($_GET['lang']) && $_GET['lang'] != "") {
  $collang_RecordYearend = $_GET['lang'];
}
$colindicate_RecordYearend = "%";
if (isset($_POST['indicate']) && $_POST['indicate'] != "") {
  $colindicate_RecordYearend = $_POST['indicate'];
}
$coluserid_RecordYearend = "-1";
if (isset($w_userid)) {
  $coluserid_RecordYearend = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordYearend = sprintf("SELECT * FROM salary_yearend WHERE name LIKE %s && particularyear LIKE %s && (job LIKE %s || job IS NULL) && (department LIKE %s || department IS NULL) && indicate LIKE %s && lang = %s && userid=%s", GetSQLValueString("%" . $colname_RecordYearend . "%", "text"), GetSQLValueString($colparticularyear_RecordYearend, "text"), GetSQLValueString("%" . $coljob_RecordYearend . "%", "text"), GetSQLValueString("%" . $coldepartment_RecordYearend . "%", "text"), GetSQLValueString($colindicate_RecordYearend, "text"),GetSQLValueString($collang_RecordYearend, "text"),GetSQLValueString($coluserid_RecordYearend, "int"));
$RecordYearend = mysqli_query($DB_Conn, $query_RecordYearend) or die(mysqli_error($DB_Conn));
$row_RecordYearend = mysqli_fetch_assoc($RecordYearend);
$totalRows_RecordYearend = mysqli_num_rows($RecordYearend);
?>
<!DOCTYPE html>
<html lang="zh-TW">
<!--<![endif]-->
<head>
<meta charset="utf-8" />
<title><?php echo $_POST['particularyear'];?>年終統計表 - <?php echo $row_RecordAccount['name'];?></title> 
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta name="robots" content="noindex,nofollow" />
<meta content="" name="description" />
<meta content="" name="author" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />

<?php //$SiteBaseAdminPath="admin_color/"; ?>
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/flag-icon/css/flag-icon.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo $SiteBaseUrl; ?>fonts/twemoji-awesome/dist/twemoji-awesome.min.css" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/font-awesome/5.6/css/fontawesome-all.min.css" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/glyphicon/css/glyphicon.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

<style>
@page { size: A4 landscape }
</style>

</head>
<body class="A4 landscape">


	    <?php 
		// 設定變數
		// 多少筆換下一業
		// echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) 最後一筆
		$ChangePageNumber = 35;
		?>
    
        <?php $i = 0; ?>
        <?php do { ?>
		
    	<?php if($i%$ChangePageNumber == "0") { ?>
        <section class="sheet padding-10mm">
        <article>
        <?php } ?>
		
        <?php if($i%$ChangePageNumber == "0") { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead style="display:table-header-group;font-weight:bold">  
          <tr>
            <td colspan="15" style="text-align:center"><?php echo $_POST['particularyear']; ?> 年終統計表</td>
          </tr>
          <tr>
            <td>No.</td>
            <td>姓名</td>
            <td>部門</td>
            <td>職位</td>
            <td>到職日</td>
            <td>年資</td>
            <td>年終</td>
            <td>公殤</td>
            <td>事假</td>
            <td>病假</td>
            <td>遲到早退</td>
            <td>總休</td>
            <td>主管考核</td>
            <td>加給金額</td>
            <td>實領年終</td>
          </tr>
          <tr>
            <td colspan="15" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          </thead>  
		  <?php } ?>
          <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $row_RecordYearend['name']; ?></td>
            <td><?php echo $row_RecordYearend['department']; ?></td>
            <td><?php echo $row_RecordYearend['job']; ?></td>
            <td><?php echo $row_RecordYearend['arrivaldate']; ?></td>
            <td><?php echo $row_RecordYearend['totolworkday']; ?></td>
            <td><?php echo $row_RecordYearend['endyearprice']; ?></td>
            <td><?php echo $row_RecordYearend['FuneralDay']; ?></td>
            <td><?php echo $row_RecordYearend['LeaveDay']; ?></td>
            <td><?php echo $row_RecordYearend['SickDay']; ?></td>
            <td><?php echo $row_RecordYearend['LetterDay']; ?></td>
            <td><?php echo $row_RecordYearend['TotalRestHour']; ?></td>
            <td></td>
            <td><?php echo $row_RecordYearend['plusprice']; ?></td>
            <td><?php echo $row_RecordYearend['endyearprice'] + $row_RecordYearend['plusprice']; ?></td>
          </tr>
         
 
        
        <?php if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordYearend-1) { ?>
        
        <tfoot>
        <tr>
            <td colspan="15" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td colspan="15" style="text-align:right">年終結算日 <?php echo $_POST['particularyear']+1 . "-01" . "-01";?></td>
          </tr>
        </tfoot>
        </table>
        <?php } ?>

        
        
        
        
			<?php if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordYearend-1) { ?>
            </article>
            </section>
            <?php } ?>
            
            <?php $i++; ?>
           
		  <?php } while ($row_RecordYearend = mysqli_fetch_assoc($RecordYearend)); ?>
    

</body>
</html>
<?php
mysqli_free_result($RecordYearend);
?>