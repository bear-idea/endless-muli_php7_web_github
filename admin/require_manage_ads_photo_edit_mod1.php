<?php require_once('../Connections/DB_Conn.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Ads")) {
  $updateSQL = sprintf("UPDATE demo_adtype_sub SET act_id=%s, sdescription=%s, modshow=%s, animation=%s, link=%s, linktarget=%s, lang=%s WHERE actphoto_id=%s",
                       GetSQLValueString($_POST['act_id'], "int"),
                       GetSQLValueString($_POST['sdescription'], "text"),
					   GetSQLValueString($_POST['modshow'], "text"),
                       GetSQLValueString($_POST['animation'], "text"),
                       GetSQLValueString($_POST['link'], "text"),
					   GetSQLValueString($_POST['linktarget'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['actphoto_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "inner_ads.php?Opt=photoviewpage&lang=" . $_POST['lang'] . "&act_id=" . $_POST['act_id'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordAds = "-1";
if (isset($_GET['actphoto_id'])) {
  $colname_RecordAds = $_GET['actphoto_id'];
}
$coluserid_RecordAds = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAds = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT * FROM demo_adtype_sub WHERE actphoto_id = %s && userid=%s", GetSQLValueString($colname_RecordAds, "int"),GetSQLValueString($coluserid_RecordAds, "int"));
$RecordAds = mysqli_query($DB_Conn, $query_RecordAds) or die(mysqli_error($DB_Conn));
$row_RecordAds = mysqli_fetch_assoc($RecordAds);
$totalRows_RecordAds = mysqli_num_rows($RecordAds);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAdsListAnimation = "SELECT * FROM demo_adtypeitem WHERE list_id = 1";
$RecordAdsListAnimation = mysqli_query($DB_Conn, $query_RecordAdsListAnimation) or die(mysqli_error($DB_Conn));
$row_RecordAdsListAnimation = mysqli_fetch_assoc($RecordAdsListAnimation);
$totalRows_RecordAdsListAnimation = mysqli_num_rows($RecordAdsListAnimation);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModList = "SELECT * FROM demo_configitem";
$RecordModList = mysqli_query($DB_Conn, $query_RecordModList) or die(mysqli_error($DB_Conn));
$row_RecordModList = mysqli_fetch_assoc($RecordModList);
$totalRows_RecordModList = mysqli_num_rows($RecordModList);

?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 輪播圖片 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="inner_ads.php?Opt=photoviewpage&lang=<?php echo $_GET['lang'] ?>&act_id=<?php echo $_GET['act_id'] ?>&actphoto_id=<?php echo $_GET['actphoto_id'] ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" >
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片<span class="text-red">*</span></label>
          <div class="col-md-10">
              <a href="uplod_adsphoto.php?actphoto_id=<?php echo $row_RecordAds['actphoto_id']; ?>&amp;act_id=<?php echo $_GET['act_id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning"><i class="fa fa-image"></i> 圖片修改</a> 
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">顯示於<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row">
          
          <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_084.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input <?php if (!(strcmp($row_RecordAds['modshow'],"All"))) {echo "checked=\"checked\"";} ?> name="modshow"  type="radio" id="modshow_All" value="All" />
                  <label for="modshow_All">全部模組</label>
             </div>
             </div>
             </div>
             
         <?php $i=0 ?>
         <?php do { ?>
         <?php
			switch($row_RecordModList['itemvalue'])
			{
				case "News":  // -------------------------------------------------
         ?>
         <?php if ($OptionNewsSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_001.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php
					break;
				case "Picasa":  // -------------------------------------------------
		 ?>
         <?php if ($OptionPicasaSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_052.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "About":  // -------------------------------------------------
		 ?>
         <?php if ($OptionAboutSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_041.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;
				case "Timeline":  // -------------------------------------------------
		 ?>
         <?php if ($OptionTimelineSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_057.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;
				case "Imageshow":  // -------------------------------------------------
		 ?>
         <?php if ($OptionImageshowSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_058.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Product":  // -------------------------------------------------
		 ?>
         <?php if ($OptionProductSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_002.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Cart":  // -------------------------------------------------
		 ?>
         <?php if ($OptionCartSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_036.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Guestbook":  // -------------------------------------------------
		 ?>
         <?php if ($OptionGuestbookSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_007.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Activities":  // -------------------------------------------------
		 ?>
         <?php if ($OptionActivitiesSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_014.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Project":  // -------------------------------------------------
		 ?>
         <?php if ($OptionProjectSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_032.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Album":  // -------------------------------------------------
		 ?>
         <?php if ($OptionAlbumSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_012.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Frilink":  // -------------------------------------------------
		 ?>
         <?php if ($OptionFrilinkSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_006.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Otrlink":  // -------------------------------------------------
		 ?>
         <?php if ($OptionOtrlinkSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_051.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Sponsor":  // -------------------------------------------------
		 ?>
         <?php if ($OptionSponsorSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_011.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Publish":  // -------------------------------------------------
		 ?>
         <?php if ($OptionPublishSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_003.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Letters":  // -------------------------------------------------
		 ?>
         <?php if ($OptionLettersSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_020.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Meeting":  // -------------------------------------------------
		 ?>
         <?php if ($OptionMeetingSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_009.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Donation":  // -------------------------------------------------
		 ?>
         <?php if ($OptionDonationSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_015.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Org":  // -------------------------------------------------
		 ?>
         <?php if ($OptionOrgSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_017.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Member":  // -------------------------------------------------
		 ?>
         <?php if ($OptionMemberSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_013.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "Careers":  // -------------------------------------------------
		 ?>
         <?php if ($OptionCareersSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_016.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Actnews":  // -------------------------------------------------
		 ?>
         <?php if ($OptionActnewsSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_021.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Faq":  // -------------------------------------------------
		 ?>
         <?php if ($OptionFaqSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_024.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Catalog":  // -------------------------------------------------
		 ?>
         <?php if ($OptionCatalogSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_033.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Forum":  // -------------------------------------------------
		 ?>
         <?php if ($OptionForumSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_029.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Contact":  // -------------------------------------------------
		 ?>
         <?php if ($OptionContactSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_040.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Stronghold":  // -------------------------------------------------
		 ?>
         <?php if ($OptionStrongholdSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_059.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Blog":  // -------------------------------------------------
		 ?>
         <?php if ($OptionBlogSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_047.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Album":  // -------------------------------------------------
		 ?>
         <?php if ($OptionAlbumSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_012.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "MailSend":  // -------------------------------------------------
		 ?>
         <?php if ($OptionMailSendSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_005.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "Knowledge":  // -------------------------------------------------
		 ?>
         <?php if ($OptionKnowledgeSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_031.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "EPaper":  // -------------------------------------------------
		 ?>
         <?php if ($OptionEPaperSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_022.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Partner":  // -------------------------------------------------
		 ?>
         <?php if ($OptionPartnerSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_026.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "AD":  // -------------------------------------------------
		 ?>
         <?php if (@$OptionADSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_025.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		;
					break;	
				case "Video":  // -------------------------------------------------
		 ?>
         <?php if ($OptionVideoSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_010.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Artlist":  // -------------------------------------------------
		 ?>
         <?php if ($OptionArtlistSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_027.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Article":  // -------------------------------------------------
		 ?>
         <?php if ($OptionArticleSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_008.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Room":  // -------------------------------------------------
		 ?>
         <?php if ($OptionRoomSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_067.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Attractions":  // -------------------------------------------------
		 ?>
         <?php if ($OptionAttractionsSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_068.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Dealer":  // -------------------------------------------------
		 ?>
         <?php if ($OptionDealerSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_077.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "DfPage":  // -------------------------------------------------
		 ?>
        <?php if ($OptionDfPageSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_043.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordAds['modshow'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?>  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
				default:
					break;
			}
		?> 
        <?php $i++ ?>
           <?php } while ($row_RecordModList = mysqli_fetch_assoc($RecordModList)); ?>
             
             <div style="clear:both"></div>
             
          </div>
          </div>
      </div>
     
      <div class="form-group row">
        <label class="col-md-2 col-form-label">轉場動畫效果<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="animation" id="animation" class="form-control" data-parsley-trigger="blur" required="">
        
      
        <?php
do {  
?>
        <option value="<?php echo $row_RecordAdsListAnimation['itemname']?>"<?php if (!(strcmp($row_RecordAdsListAnimation['itemname'], $row_RecordAds['animation']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordAdsListAnimation['itemname']?></option>
        <?php
} while ($row_RecordAdsListAnimation = mysqli_fetch_assoc($RecordAdsListAnimation));
  $rows = mysqli_num_rows($RecordAdsListAnimation);
  if($rows > 0) {
      mysqli_data_seek($RecordAdsListAnimation, 0);
	  $row_RecordAdsListAnimation = mysqli_fetch_assoc($RecordAdsListAnimation);
  }
?>
      </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連結網址</label>
          <div class="col-md-10">
          
                      <input name="link" class="form-control" id="link" placeholder="http://www.yoururl.com" pattern= "/^(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?$/i" value="<?php echo $row_RecordAds['link']?>" maxlength="200" data-parsley-type="url" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div> 
      <div class="form-group row">
        <label class="col-md-2 col-form-label">開啟方式<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="linktarget" id="linktarget" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="_blank" <?php if (!(strcmp("_blank", $row_RecordAds['linktarget']))) {echo "selected=\"selected\"";} ?>>開新視窗 (_blank)</option>
          <option value="_self" <?php if (!(strcmp("_self", $row_RecordAds['linktarget']))) {echo "selected=\"selected\"";} ?>>目前視窗 (_self)</option>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述</label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordAds['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="act_id" type="hidden" id="act_id" value="<?php echo $_GET['act_id']; ?>" />
        <input name="actphoto_id" type="hidden" id="actphoto_id" value="<?php echo $row_RecordAds['actphoto_id']; ?>" />
        <input name="bwight" type="hidden" id="bwight" value="<?php echo $row_RecordAdsView['bwight']; ?>" />
        <input name="bhight" type="hidden" id="bhight" value="<?php echo $row_RecordAdsView['bhight']; ?>" />
        <input name="swight" type="hidden" id="swight" value="<?php echo $row_RecordAdsView['swight']; ?>" />
        <input name="shight" type="hidden" id="shight" value="<?php echo $row_RecordAdsView['shight']; ?>" />
        <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Ads" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

</div>

<?php
mysqli_free_result($RecordAds);

mysqli_free_result($RecordAdsListAnimation);

mysqli_free_result($RecordModList);
?>
