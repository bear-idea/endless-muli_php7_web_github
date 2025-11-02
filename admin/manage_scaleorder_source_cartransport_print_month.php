<?php 
$UseMod = "Cartransport"; // 目前使用模組
//ob_start(); // 開啟輸出緩衝區
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php 
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


if($_POST['year'] != "" && $_POST['month'] != "") {
	$dt = new DateTime($_POST['year']."-".$_POST['month']);
	$dt->modify('first day of this month');
	$search_startdate = $dt->format('Y-m-d');
	
	$dt = new DateTime($_POST['year']."-".$_POST['month']);
	$dt->modify('last day of this month');
	$search_enddate = $dt->format('Y-m-d');
}


$search_nowdate = "2019-05-01";


$colsearch_RecordScaleorder_in = "%";
if (isset($DT_search)) {
  $colsearch_RecordScaleorder_in = $DT_search;
}

//$colnamelang_RecordScaleorder_in = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScaleorder_in = $_SESSION['lang'];
}

$colcarnumber_RecordScaleorder_in = "%";
if (isset($search_carnumber) && $search_carnumber != "") {
  $colcarnumber_RecordScaleorder_in = $search_carnumber;
}

$coluserid_RecordScaleorder_in = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder_in = $w_userid;
}

$colstartdate_RecordScaleorder_in = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordScaleorder_in = $search_startdate;
}
$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordScaleorder_in = $dt->format('Y-m-d');
$colenddate_RecordScaleorder_in .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordScaleorder_in = $dt->format('Y-m-d');
  $colenddate_RecordScaleorder_in .= " 23:59:59";
}

// 日期範圍
$query_RecordScaleorder_in = sprintf("SELECT * FROM erp_scaleordersourcedetail WHERE lang = %s && userid=%s && postdate BETWEEN %s AND %s ORDER BY oserial",GetSQLValueString($collang_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"),GetSQLValueString($colstartdate_RecordScaleorder_in, "date"),GetSQLValueString($colenddate_RecordScaleorder_in, "date"));
$RecordScaleorder_in = mysqli_query($DB_Conn, $query_RecordScaleorder_in) or die(mysqli_error($DB_Conn));
$row_RecordScaleorder_in = mysqli_fetch_assoc($RecordScaleorder_in);
$totalRows_RecordScaleorder_in = mysqli_num_rows($RecordScaleorder_in);


$colname_RecordScaleListCartransport = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordScaleListCartransport = $_GET['lang'];
}
$coluserid_RecordScaleListCartransport = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleListCartransport = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleListCartransport = sprintf("SELECT * FROM erp_scalesource WHERE lang=%s && userid=%s", GetSQLValueString($colname_RecordScaleListCartransport, "text"),GetSQLValueString($coluserid_RecordScaleListCartransport, "int"));
$RecordScaleListCartransport = mysqli_query($DB_Conn, $query_RecordScaleListCartransport) or die(mysqli_error($DB_Conn));
$row_RecordScaleListCartransport = mysqli_fetch_assoc($RecordScaleListCartransport);
$totalRows_RecordScaleListCartransport = mysqli_num_rows($RecordScaleListCartransport);

do { 
  $Cartransport['itemname'][] =  $row_RecordScaleListCartransport['name'];
} while ($row_RecordScaleListCartransport = mysqli_fetch_assoc($RecordScaleListCartransport));


do{
	
	//echo $row_RecordScaleorder_in['cartransport'] . " ";

	//for($j=0; $j<count($Cartransport['itemname']); $j++) 
	//{
		//if($Cartransport['itemname'][$j] == $row_RecordScaleorder_in['cartransport']) { 
		  if($row_RecordScaleorder_in['id'] != ""){
		  //$dt = new DateTime($row_RecordScaleorder_in['postdate']);
		  	  $NowCartransport['id'][] = $row_RecordScaleorder_in['id'];
			  $NowCartransport['code'][] = $row_RecordScaleorder_in['code'];
			  $NowCartransport['title'][] = $row_RecordScaleorder_in['title'];
			  $NowCartransport['carnumber'][] = $row_RecordScaleorder_in['carnumber'];
			  $NowCartransport['num'][] = $row_RecordScaleorder_in['num'];
			  $NowCartransport['postdate'][] = $row_RecordScaleorder_in['postdate'];
		  }
		//}
	//}


} while ($row_RecordScaleorder_in = mysqli_fetch_assoc($RecordScaleorder_in));

?>
<!DOCTYPE html>
<html lang="zh-TW">
<!--<![endif]-->
<head>
<meta charset="utf-8" />
<title><?php echo $_POST['year'];?>-<?php echo $_POST['month'];?> 車趟統計 - <?php echo $row_RecordAccount['name'];?></title> 
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta name="robots" content="noindex,nofollow" />
<meta content="" name="description" />
<meta content="" name="author" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />

<?php //$SiteBaseAdminPath="admin_color/"; ?>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/flag-icon/css/flag-icon.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo $SiteBaseUrl; ?>fonts/twemoji-awesome/dist/twemoji-awesome.min.css" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/font-awesome/5.6/css/fontawesome-all.min.css" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/glyphicon/css/glyphicon.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

<style>
@page { size: A4 landscape }
table.paleBlueRows {
  font-family: "Times New Roman", Times, serif;
  border: 1px solid #FFFFFF;
  text-align: left;
  border-collapse: collapse;
}
table.paleBlueRows td, table.paleBlueRows th {
  border: 1px solid #FFFFFF;
  /*padding: 2px 2px;*/
}
table.paleBlueRows tbody td {
	padding:1px 10px;
}
table.paleBlueRows tr:nth-child(even) {
  background: #D0E4F5;
}
table.paleBlueRows thead {
  background: #0B6FA4;
  border-bottom: 5px solid #FFFFFF;
}
table.paleBlueRows thead th {
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
  border-left: 2px solid #FFFFFF;
  padding:2px 2px;
}
table.paleBlueRows thead th:first-child {
  border-left: none;
}

table.paleBlueRows tfoot {
  font-weight: bold;
  color: #333333;
  background: #D0E4F5;
}
table.paleBlueRows tfoot td {
}
</style>

</head>
<body class="A4 landscape">


	    <?php 
		// 設定變數
		// 多少筆換下一業
		// echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1); // 最後一筆
        //echo cal_days_in_month(CAL_GREGORIAN,$_POST['month'],$_POST['year']);
        $ChangePageNumber = 30;
		?>
    
        <?php //$i = 0; ?>
        <?php for($i=0; $i<$totalRows_RecordScaleorder_in; $i++) { ?>
		
    	<?php if($i%$ChangePageNumber == "0") { ?>
        <section class="sheet padding-10mm">
        <article>
        <?php } ?>
		
        <?php if($i%$ChangePageNumber == "0") { ?>
        <table width="100%" class="paleBlueRows">
          <thead>  
          <tr>
            <td colspan="16" style="text-align:center; color:#fff;"><?php echo $_POST['year'];?>-<?php echo $_POST['month'];?> <strong>車趟統計表</strong></td>
          </tr>
          <tr>
            <td>聯單號碼</td>
            <?php for($j=0; $j<count($Cartransport['itemname']); $j++) { ?>
            <td><?php echo $Cartransport['itemname'][$j] ?></td>
            <?php } ?>
			<td>車號</td>
			<td>日期</td>
          </tr>
          <tr>
            <td colspan="15" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          </thead>  
		  <?php } ?>
          
          
          <tr>
            <td>
			<?php  
			// 日期
			//$NowDate = $_POST['year'] . "-" . $_POST['month'] . "-" . ($i+1);
			//$dt = new DateTime($NowDate); echo $NowDate = $dt->format('Y-m-d'); 
		    echo $NowCartransport['num'][$i];
			?>
			</td>
            <?php  for($j=0; $j<count($Cartransport['itemname']); $j++) {  ?>
            <td>
			<?php 
			    //var_dump($NowCartransport[$NowDate]);
				//echo $NowDate;
				//echo count($NowCartransport[$NowDate]);
				
				$NowRun=0;
				
				//if(count($NowCartransport[$NowDate]) > 0) {
				//echo $totalRows_RecordScaleorder_in;
				if($NowCartransport['title'][$i] == $Cartransport['itemname'][$j]) { $NowRun++; }
					
					if($NowRun == 0){
						echo "-";
					}else{
			    		echo $NowRun;
                        //echo $Cartransport['itemname'][$j];
                        $itemname_sum[$Cartransport['itemname'][$j]] += $NowRun;
                        
					}
				//}else{
				//	echo "-";
				//}
			?>
            </td>
            <?php } ?>
			<td>
			<?php 
				echo $NowCartransport['carnumber'][$i];
			?>
            </td>
			<td>
			<?php 
																  
			//$NowDate = $_POST['year'] . "-" . $_POST['month'] . "-" . ($i+1);
			$dt = new DateTime($NowCartransport['postdate'][$i]); echo $NowDate = $dt->format('Y-m-d'); 
			?>
            </td>
          </tr>
              

 
        
        <?php if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordScaleorder_in-1) { ?>
        
        <tfoot>
        <tr>
            <td style="text-align:center; color:#fff;"></td>
          </tr>
          <tr>
            <td></td>
            <?php for($j=0; $j<count($Cartransport['itemname']); $j++) { ?>
            <td><?php echo $itemname_sum[$Cartransport['itemname'][$j]]; ?></td>
            <?php } ?>
            <td></td>
			  <td></td>
          </tr>
          <tr>
            <td style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </tfoot>
        </table>
        <?php } ?>

        
        
        
        
			<?php if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordScaleorder_in-1) { ?>
            </article>
            </section>
        <?php } ?>
            
        <?php //$i++; ?>
           
        <?php } // for ?>
    

</body>
</html>
<?php
mysqli_free_result($RecordScaleorder_in);
?>