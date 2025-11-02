<?php 
$UseMod = "Split"; // 目前使用模組
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
$colname_RecordSplit = "%";
if (isset($_POST['name'])) {
  $colname_RecordSplit = $_POST['name'];
}
$coljob_RecordSplit = "%";
if (isset($_POST['job'])) {
  $coljob_RecordSplit = $_POST['job'];
}
$coldepartment_RecordSplit = "%";
if (isset($_POST['department'])) {
  $coldepartment_RecordSplit = $_POST['department'];
}
$colparticularyear_RecordSplit = "%";
if (isset($_POST['particularyear']) && $_POST['particularyear'] != "") {
  $colparticularyear_RecordSplit = $_POST['particularyear'];
}
$collang_RecordSplit = "%";
if (isset($_GET['lang']) && $_GET['lang'] != "") {
  $collang_RecordSplit = $_GET['lang'];
}
$colindicate_RecordSplit = "%";
if (isset($_POST['indicate']) && $_POST['indicate'] != "") {
  $colindicate_RecordSplit = $_POST['indicate'];
}
$coluserid_RecordSplit = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplit = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
echo $query_RecordSplit = sprintf("SELECT erp_splitorder.carnumber, erp_splitorder.startdate, erp_splitorder.indicate, erp_splitorder.lang, erp_splitorder.userid FROM erp_splitorderdetial LEFT OUTER JOIN erp_splitorder ON erp_splitorderdetial.oid = erp_splitorder.oid WHERE erp_splitorder.indicate LIKE %s && erp_splitorder.lang = %s && erp_splitorder.userid=%s", GetSQLValueString($colindicate_RecordSplit, "text"),GetSQLValueString($collang_RecordSplit, "text"),GetSQLValueString($coluserid_RecordSplit, "int"));
$RecordSplit = mysqli_query($DB_Conn, $query_RecordSplit) or die(mysqli_error($DB_Conn));
$row_RecordSplit = mysqli_fetch_assoc($RecordSplit);
echo $totalRows_RecordSplit = mysqli_num_rows($RecordSplit);
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
            <td colspan="15" style="text-align:center"><?php echo $_POST['particularyear']; ?> <?php echo $_POST['particularmonth']; ?>月 拆分統計表</td>
          </tr>
          <tr>
            <td>No.</td>
            <td>日期</td>
            <td>車號</td>
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
            <td><?php echo $row_RecordSplit['name']; ?></td>
            <td><?php echo $row_RecordSplit['department']; ?></td>
            <td><?php echo $row_RecordSplit['job']; ?></td>
            <td><?php echo $row_RecordSplit['arrivaldate']; ?></td>
            <td><?php echo $row_RecordSplit['totolworkday']; ?></td>
            <td><?php echo $row_RecordSplit['endyearprice']; ?></td>
            <td><?php echo $row_RecordSplit['FuneralDay']; ?></td>
            <td><?php echo $row_RecordSplit['LeaveDay']; ?></td>
            <td><?php echo $row_RecordSplit['SickDay']; ?></td>
            <td><?php echo $row_RecordSplit['LetterDay']; ?></td>
            <td><?php echo $row_RecordSplit['TotalRestHour']; ?></td>
            <td></td>
            <td><?php echo $row_RecordSplit['plusprice']; ?></td>
            <td><?php echo $row_RecordSplit['endyearprice'] + $row_RecordSplit['plusprice']; ?></td>
          </tr>
         
 
        
        <?php if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordSplit-1) { ?>
        
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

        
        
        
        
			<?php if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordSplit-1) { ?>
            </article>
            </section>
            <?php } ?>
            
            <?php $i++; ?>
           
		  <?php } while ($row_RecordSplit = mysqli_fetch_assoc($RecordSplit)); ?>
    

</body>
</html>
<?php
mysqli_free_result($RecordSplit);
?>