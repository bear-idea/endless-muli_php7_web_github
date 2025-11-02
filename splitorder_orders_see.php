<?php require_once('Connections/DB_Conn.php'); ?>
<?php header("Content-Type:text/html;charset=utf-8"); /* 指定頁面編碼方式 IE BUG*/  ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

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

$colname_RecordSplitorder = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordSplitorder = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorder = sprintf("SELECT * FROM erp_splitorder WHERE oserial = %s", GetSQLValueString($colname_RecordSplitorder, "text"));
$RecordSplitorder = mysqli_query($DB_Conn, $query_RecordSplitorder) or die(mysqli_error($DB_Conn));
$row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder);
$totalRows_RecordSplitorder = mysqli_num_rows($RecordSplitorder);

$colname_RecordSplitorderDetailed = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordSplitorderDetailed = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderDetailed = sprintf("SELECT * FROM erp_splitorderdetial WHERE oserial = %s", GetSQLValueString($colname_RecordSplitorderDetailed, "text"));
$RecordSplitorderDetailed = mysqli_query($DB_Conn, $query_RecordSplitorderDetailed) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderDetailed = mysqli_fetch_assoc($RecordSplitorderDetailed);
$totalRows_RecordSplitorderDetailed = mysqli_num_rows($RecordSplitorderDetailed);

$colname_RecordSplitorderPhoto_before = "-1";
if (isset($row_RecordSplitorder['oid'])) {
  $colname_RecordSplitorderPhoto_before = $row_RecordSplitorder['oid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderPhoto_before = sprintf("SELECT * FROM erp_splitorderphoto WHERE aid = %s && state='before'", GetSQLValueString($colname_RecordSplitorderPhoto_before, "text"));
$RecordSplitorderPhoto_before = mysqli_query($DB_Conn, $query_RecordSplitorderPhoto_before) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderPhoto_before = mysqli_fetch_assoc($RecordSplitorderPhoto_before);
$totalRows_RecordSplitorderPhoto_before = mysqli_num_rows($RecordSplitorderPhoto_before);

$colname_RecordSplitorderPhoto_after = "-1";
if (isset($row_RecordSplitorder['oid'])) {
  $colname_RecordSplitorderPhoto_after = $row_RecordSplitorder['oid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderPhoto_after = sprintf("SELECT * FROM erp_splitorderphoto WHERE aid = %s && state='after'", GetSQLValueString($colname_RecordSplitorderPhoto_after, "text"));
$RecordSplitorderPhoto_after = mysqli_query($DB_Conn, $query_RecordSplitorderPhoto_after) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderPhoto_after = mysqli_fetch_assoc($RecordSplitorderPhoto_after);
$totalRows_RecordSplitorderPhoto_after = mysqli_num_rows($RecordSplitorderPhoto_after);


$colname_RecordAccount = "-1";
if (isset($row_RecordSplitorder['userid'])) {
  $colname_RecordAccount = $row_RecordSplitorder['userid'];
}

$query_RecordAccount = sprintf("SELECT * FROM demo_admin WHERE id = %s", GetSQLValueString($colname_RecordAccount, "text"));
$RecordAccount = mysqli_query($DB_Conn, $query_RecordAccount) or die(mysqli_error($DB_Conn));
$row_RecordAccount = mysqli_fetch_assoc($RecordAccount);
$totalRows_RecordAccount = mysqli_num_rows($RecordAccount);

$_SESSION['userid'] = $row_RecordSplitorder['userid'];
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username_' . $_GET['wshop']] = NULL;
  $_SESSION['MM_UserGroup_' . $_GET['wshop']] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username_' . $_GET['wshop']]);
  unset($_SESSION['MM_UserGroup_' . $_GET['wshop']]);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['success_line_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_google_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_fb_login_backstage_'.$_GET['wshop']]);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once("inc/inc_function.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>拆分明細檢視</title>
<!-- mobile settings -->
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
<link href="<?php echo $SiteBaseUrl ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/layout-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/header-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/layout-font-rewrite.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/color_scheme/<?php echo $tplrwdbasiccolor; ?>.css" rel="stylesheet" type="text/css" id="color_scheme" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/layout-shop-user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>photoFrame/photoFrame.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">var plugin_path = '<?php echo $SiteBaseUrl; ?>assets/plugins/';</script>
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="https://img.shop3500.com/twemoji.min.js"></script> 
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/js/view/demo.revolution_slider.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jcolumn.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/layouts/center.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>noty/themes/default.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.cookie.js"></script>
<script type="text/javascript">function generatetip(a,b){var c=noty({text:a,type:b,dismissQueue:!0,modal:!0,layout:"center",theme:"defaultTheme"});console.log("html: "+c.options.id)};</script>
<?php if($SiteAnimeCheck != '0') { ?>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>scrollReveal.min.js"> // 滾動特效</script>
<script> window.scrollReveal = new scrollReveal( {reset: <?php if($SiteAnimeCheck == '1') { ?>true<?php }?><?php if($SiteAnimeCheck == '2') { echo 'false'; }?>} );</script>
<?php } ?>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.photoFrame.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="smoothscroll enable-animation">
<div id="wrapper" style="background-image:url(assets/images/patterns/pattern11.png)"> 
  
  <!-- HEADER -->
  <header id="header"></header>
  <!-- /HEADER -->
  <div class="padding-15">
  <div class="container">

  <div style="background-color:#FFF; padding:10px; border:1px #CCCCCC dashed; margin-top:10px;">
  
  
  <div class="row">
	<div class="col-md-12">
		<h2 style="text-align:center"><strong style="font-size:24px;">拆分明細表</strong></h2>
	</div>

	
  </div>
  
  
  
  <div class="row">
	<div class="col-md-6">
		<h4>拆分單號：<?php echo $row_RecordSplitorder['oserial']; ?></h4>
	</div>
    
    <div class="col-md-6">
		<h4>預估天數：<?php echo $row_RecordSplitorder['Estimatedday']; ?></h4>
	</div>
    
	<div class="col-md-6">
		<h4>拆分日期：<?php echo date('Y-m-d g:i A',strtotime($row_RecordSplitorder['startdate'])); ?></h4>
	</div>
    
    <div class="col-md-6">
		<h4>完工日期：<?php if($row_RecordSplitorder['enddate'] != "") {echo date('Y-m-d g:i A',strtotime($row_RecordSplitorder['enddate']));} ?></h4>
	</div>
    
    <div class="col-md-6">
		<h4>車號：<?php echo $row_RecordSplitorder['carnumber']; ?></h4>
	</div>
	
	<div class="col-md-6">
		<h4>總重量：<?php echo $row_RecordSplitorder['bigweight']; ?></h4>
	</div>
	
  </div>
  
  <?php if ($totalRows_RecordSplitorderPhoto_before > 0) { ?>
  <h4><strong>拆分前</strong></h4>
  <div class="alert alert-bordered-dashed margin-bottom-5 padding-0"><!-- DASHED --></span>
	<div class="row">
      <?php do { ?>
      <div class="col-md-3 col-xs-6">
          <div class="photoFrame_base">
          <div class="imgLiquid img-rounded" data-fill="resize" data-board="0" style="background-color:#FFF;">
            <img src="<?php echo $SiteImgUrl; ?><?php echo $row_RecordAccount['webname']; ?>/image/scaleorder_split/<?php echo GetFileThumbExtend($row_RecordSplitorderPhoto_before['pic']); ?>" data-fill="resize" data-board="0">
          </div>
          </div>
      </div>
      <?php } while ($row_RecordSplitorderPhoto_before = mysqli_fetch_assoc($RecordSplitorderPhoto_before)); ?>
      
    </div>
  </div>
  <?php } ?>
  
  <?php if ($totalRows_RecordSplitorderPhoto_after > 0) { ?>
  <h4><strong>拆分後</strong></h4>
  <div class="alert alert-bordered-dashed margin-bottom-5 padding-0"><!-- DASHED --></span>
	<div class="row">
      <?php do { ?>
      <div class="col-md-3 col-xs-6">
          <div class="photoFrame_base">
          <div class="imgLiquid img-rounded" data-fill="resize" data-board="0" style="background-color:#FFF;">
            <img src="<?php echo $SiteImgUrl; ?><?php echo $row_RecordAccount['webname']; ?>/image/scaleorder_split/<?php echo GetFileThumbExtend($row_RecordSplitorderPhoto_after['pic']); ?>" data-fill="resize" data-board="0">
          </div>
          </div>
      </div>
      <?php } while ($row_RecordSplitorderPhoto_after = mysqli_fetch_assoc($RecordSplitorderPhoto_after)); ?> 
  </div>
  </div>
  <?php } ?>
  
  
  <div class="row">
  <div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th><i class="fa fa-sort-amount-asc"></i> 編號</th>
				<th><i class="fa fa-asterisk"></i> 代號</th>
				<th><i class="fa fa-clone"></i> 物料</th>
				<th><i class="fa fa-balance-scale"></i>重量</strong></th>
				<th colspan="3"><i class="fa fa-balance-scale"></i> 比例</th>
				</tr>
		</thead>
		<tbody>
        <?php $i=1; ?>
        <?php if ($totalRows_RecordSplitorderDetailed > 0) { ?>
         <?php do { ?>
		 <?php 
		 $colname_RecordScale = "-1";
if (isset($row_RecordSplitorderDetailed['code'])) {
  $colname_RecordScale = $row_RecordSplitorderDetailed['code'];
}
$coluserid_RecordScale = "-1";
if (isset($row_RecordSplitorder['userid'])) {
  $coluserid_RecordScale = $row_RecordSplitorder['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

//////////

$collang_RecordScaleViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordScaleViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordScaleViewLine_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordScaleViewLine_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleViewLine_l1 = sprintf("SELECT * FROM erp_scaleitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordScaleViewLine_l1, "text"),GetSQLValueString($coluserid_RecordScaleViewLine_l1, "int"));
$RecordScaleViewLine_l1 = mysqli_query($DB_Conn, $query_RecordScaleViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
$totalRows_RecordScaleViewLine_l1 = mysqli_num_rows($RecordScaleViewLine_l1);


if ($row_RecordScale['type1'] != '') {
	do {  //比較字串
		if (!(strcmp($row_RecordScaleViewLine_l1['item_id'], $row_RecordScale['type1']))) { $row_RecordSplitorderDetailed['code'] =  $row_RecordScaleViewLine_l1['itemname']; 
		}
	} while ($row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1));
	$rows = mysqli_num_rows($RecordScaleViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordScaleViewLine_l1, 0);
		  $row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
	  }
}
 ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row_RecordSplitorderDetailed['code']; ?></td>
				<td>
				
				
				<?php echo $row_RecordSplitorderDetailed['title']; ?>

                </td>
				<td><?php echo $row_RecordSplitorderDetailed['weight']; ?> kg</td>
				<td><?php echo $row_RecordSplitorderDetailed['percent']; ?> %</td>
			</tr>
            <?php $i++; ?>
            <?php 
			$NowTotalweight += $row_RecordSplitorderDetailed['weight'];
			$NowTotalpercent += $row_RecordSplitorderDetailed['percent'];

			//echo $row_RecordSplitorderDetailed['Totalweight']; 
			
			?>
            <?php } while ($row_RecordSplitorderDetailed = mysqli_fetch_assoc($RecordSplitorderDetailed)); ?>
            <?php } ?>
		</tbody>
	</table>
</div>
     
            
    </div>
  </div>
  
  <div style="background-color:#FFF; padding:10px; border:1px #CCCCCC dashed; margin-top:10px; text-align:right"> 總重 <?php echo $NowTotalweight ?> kg / 比例 <?php echo $NowTotalpercent ?> %</div>
  
  <div style="background-color:#FFF; padding:10px; border:1px #CCCCCC dashed; margin-top:10px; text-align:center">
  
  
  <div class="row">
	<div class="col-md-12">
    <?php $SiteFileUrlName = pathinfo($_SERVER['PHP_SELF']); // 網站放置位置 echo $SiteFileUrlName['dirname']
$SiteFileUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . $SiteFileUrlName['dirname']; // 網站放置位置 ?>
		<?php $qr_url = $SiteFileUrl . "/splitor_orders_see.php?Serial=" . $row_RecordSplitorder['oserial'];?><img src="http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=<?php echo $qr_url ?>"/>
  <div style="font-size:12px; margin-top:-16px;">本頁面網址</div>
	</div>
    
  </div>
  
  
  
  
  
  
  </div>
  
  
   <br>
<br>

  <div class="clearfix"></div>
  
  <br>
<br>
  
  </div></div>
</div>
<footer id="footer" class="sticky">
  <div class="copyright" style="background-color:#333; color:#FFF; text-align:center; padding:10px;">
    <div class="container_full">
      <?php //require_once("require_manage_tmpfooter.php"); ?>
    </div>
  </div>
</footer>
<!-- JAVASCRIPT FILES --> 
<!--<script type="text/javascript" src="https://img.shop3500.com/twemoji.min.js"></script>-->
</body>
</html>
<?php
mysqli_free_result($RecordSplitorder);

mysqli_free_result($RecordSplitorderDetailed);
?>
