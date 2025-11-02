<?php require_once('Connections/DB_Conn.php'); ?>
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

$colname_RecordBulletin = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordBulletin = $_SESSION['userid'];
}
$colnamelang_RecordBulletin = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordBulletin = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBulletin = sprintf("SELECT * FROM demo_bulletin WHERE userid = %s && lang = %s && indicate=1 ORDER BY id DESC", GetSQLValueString($colname_RecordBulletin, "int"), GetSQLValueString($colnamelang_RecordBulletin, "text"));
$RecordBulletin = mysqli_query($DB_Conn, $query_RecordBulletin) or die(mysqli_error($DB_Conn));
$row_RecordBulletin = mysqli_fetch_assoc($RecordBulletin);
$totalRows_RecordBulletin = mysqli_num_rows($RecordBulletin);

$colname_RecordBulletinCookies = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordBulletinCookies = $_SESSION['userid'];
}
$colnamelang_RecordBulletinCookies = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordBulletinCookies = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBulletinCookies = sprintf("SELECT * FROM demo_bulletin WHERE userid = %s && lang = %s && indicate=1 ORDER BY id DESC", GetSQLValueString($colname_RecordBulletinCookies, "int"), GetSQLValueString($colnamelang_RecordBulletinCookies, "text"));
$RecordBulletinCookies = mysqli_query($DB_Conn, $query_RecordBulletinCookies) or die(mysqli_error($DB_Conn));
$row_RecordBulletinCookies = mysqli_fetch_assoc($RecordBulletinCookies);
$totalRows_RecordBulletinCookies = mysqli_num_rows($RecordBulletinCookies);
?>
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>introjs.min.css" /><script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>intro.min.js"></script><?php if ($_COOKIE["introbulletinid_".$_GET['wshop']] == "") { ?><script type="text/javascript">$.cookie('introbulletinid_<?php echo $_GET['wshop']; ?>', '<?php echo $row_RecordBulletinCookies['id']; ?>', { path:'/', expires: 365 });</script><?php } else { ?><?php 
    if ($totalRows_RecordBulletinCookies > 0) {
        if ($_COOKIE["introbulletinid_".$_GET['wshop']] == $row_RecordBulletinCookies['id']) {
            $Intro_Tip = "0";
        }
    }
    ?><script type="text/javascript">$.cookie('introbulletinid_<?php echo $_GET['wshop']; ?>', '<?php echo $row_RecordBulletinCookies['id']; ?>', { path:'/', expires: 365 });</script><?php } ?><script type="text/javascript">function startIntro_All(){ var intro = introJs(); intro.setOptions({ steps: [<?php if ($totalRows_RecordBulletinCookies > 0) { ?><?php do {  ?>{element: '#Step_Tip_<?php echo $row_RecordBulletinCookies ['id']; ?>',intro: '<hr/><h2 style="text-align:center;"><i class="fa fa-tag"></i><?php echo $row_RecordBulletinCookies['title']; ?></h2><hr/><div><?php if ($row_RecordBulletinCookies['pic'] != "") { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/bulletin/<?php echo $row_RecordBulletinCookies['pic']; ?>" /><br /><br /><?php } ?><?php echo $row_RecordBulletinCookies['sdescription']; ?></div><?php if ($row_RecordBulletinCookies['link'] != "") { ?><div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="<?php echo $row_RecordBulletin['link']; ?>" target="_blank" style="color:#FFF"><i class="fa fa-arrow-circle-right"></i><?php echo $Lang_Classify_Context_Link_Bullent ?></a></span></div><?php } ?>'},<?php } while ($row_RecordBulletinCookies = mysqli_fetch_assoc($RecordBulletinCookies)); ?>{element: '#Step_End',intro: '<?php echo $Lang_Classify_Context_More_Bullent ?>',position: 'bottom'}<?php } else { ?>{
element: '#Step_End',intro: '<?php echo $Lang_Classify_Context_No_Bullent ?>',position: 'bottom'}<?php } ?>],nextLabel: '<?php echo $Lang_Classify_Context_Next_Bullent ?>',prevLabel: '<?php echo $Lang_Classify_Context_Prev_Bullent ?>',skipLabel: '<?php echo $Lang_Classify_Context_Skip_Bullent ?>',doneLabel: '<?php echo $Lang_Classify_Context_End_Bullent ?>',showStepNumbers: 'false',tooltipPosition: 'auto',positionPrecedence: ['left', 'right', 'bottom', 'top']});intro.start();}</script><script type="text/javascript">function startIntro(){varintro = introJs();intro.setOptions({steps: [<?php if ($totalRows_RecordBulletin > 0) { ?><?php do {  ?><?php if(@$_COOKIE["introbulletinid_".$_GET['wshop']] < $row_RecordBulletin['id']) { ?>{element: '#Step_Tip_<?php echo $row_RecordBulletin['id']; ?>',intro: '<hr/><h2 style="text-align:center;"><i class="fa fa-tag"></i><?php echo $row_RecordBulletin['title']; ?></h2><hr/><div><?php if ($row_RecordBulletin['pic'] != "") { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/bulletin/<?php echo $row_RecordBulletin['pic']; ?>" /><br /><br /><?php } ?><?php echo $row_RecordBulletin['sdescription']; ?></div><?php if ($row_RecordBulletin['link'] != "") { ?><div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="<?php echo $row_RecordBulletin['link']; ?>" target="_blank" style="color:#FFF"><i class="fa fa-arrow-circle-right"></i><?php echo $Lang_Classify_Context_Link_Bullent ?></a></span></div><?php } ?>'},<?php } ?><?php } while ($row_RecordBulletin = mysqli_fetch_assoc($RecordBulletin)); ?>{element: '#Step_End',
intro: '<?php echo $Lang_Classify_Context_More_Bullent ?>',position: 'bottom'}<?php } else { ?>{element: '#Step_End',intro: '<?php echo $Lang_Classify_Context_No_Bullent ?>',position: 'bottom'}<?php } ?>],nextLabel: '<?php echo $Lang_Classify_Context_Next_Bullent ?>',prevLabel: '<?php echo $Lang_Classify_Context_Prev_Bullent ?>',skipLabel: '<?php echo $Lang_Classify_Context_Skip_Bullent ?>',doneLabel: '<?php echo $Lang_Classify_Context_End_Bullent ?>',showStepNumbers: 'false',tooltipPosition: 'auto',positionPrecedence: ['left', 'right', 'bottom', 'top']});intro.start();}</script><?php if(@$Intro_Tip != "0" && $totalRows_RecordBulletinCookies > 0) { ?><script type="text/javascript">jQuery(window).loadfunction() {startIntro();})</script><?php } ?>
<?php
mysqli_free_result($RecordBulletin);

mysqli_free_result($RecordBulletinCookies);
?>
