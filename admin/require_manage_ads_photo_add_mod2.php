<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/banner";
	$ppu->extensions = "JPG";
	$ppu->formName = "form_Ads";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "3000";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "true";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "2000";
	$ppu->maxHeight = "2000";
	$ppu->saveWidth = "";
	$ppu->saveHeight = "";
	$ppu->timeout = "3600";
	$ppu->progressBar = "fileCopyProgress.htm";
	$ppu->progressWidth = "300";
	$ppu->progressHeight = "100";
	$ppu->checkVersion("2.1.3");
	$ppu->doUpload();
}
$GP_uploadAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
		$GP_uploadAction .= "?".$_SERVER['QUERY_STRING']."&GP_upload=true";
	} else {
		$GP_uploadAction .= "?".$_SERVER['QUERY_STRING'];
	}
} else {
  $GP_uploadAction .= "?"."GP_upload=true";
}

// Smart Image Processor 1.0.4
if (isset($_GET['GP_upload'])) {
  $sip = new resizeUploadedFiles($ppu);
  $sip->component = "GD2";
  $sip->resizeImages = "true";
  $sip->aspectImages = "true";
  $sip->maxWidth = $_POST['bwight'];
  $sip->maxHeight = $_POST['bhight'];
  $sip->quality = "100";
  $sip->makeThumb = "true";
  $sip->pathThumb = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/banner/thumb";
  $sip->aspectThumb = "true";
  $sip->naming = "prefix";
  $sip->suffix = "small_";
  $sip->maxWidthThumb = $_POST['swight'];
  $sip->maxHeightThumb = $_POST['shight'];
  $sip->qualityThumb = "100";
  $sip->checkVersion("1.0.4");
  $sip->doResize();
}

if (isset($editFormAction)) {
  if (isset($_SERVER['QUERY_STRING'])) {
	  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Ads")) {
  $insertSQL = sprintf("INSERT INTO demo_adtype_sub (act_id, sdescription, pic, modshow, datatransition, datakenburns, databgposition, databgzoom, datacontent, datacontentlocation, datacontentoverlay1, link, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['act_id'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['sdescription']), "text"),
                       GetSQLValueString($_POST['pic'], "text"),
					   GetSQLValueString($_POST['modshow'], "text"),
                       GetSQLValueString($_POST['animation'], "text"),
					   GetSQLValueString($_POST['datakenburns'], "int"),
					   GetSQLValueString($_POST['databgposition'], "int"),
					   GetSQLValueString($_POST['databgzoom'], "int"),
					   GetSQLValueString($_POST['datacontent'], "text"),
					   GetSQLValueString($_POST['datacontentlocation'], "int"),
					   GetSQLValueString($_POST['datacontentoverlay1'], "int"),
                       GetSQLValueString($_POST['link'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "inner_ads.php?Opt=photoviewpage&lang=" . $_POST['lang'] . "&act_id=" . $_POST['act_id'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
    <?php $CKEtoolbar = 'Basic' ?>
<?php } ?>

<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'datacontent',{width : '1170px', height : '<?php echo $row_RecordAd['dataheight']; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 輪播圖片 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="inner_ads.php?Opt=photoviewpage&lang=<?php echo $_GET['lang'] ?>&act_id=<?php echo $_GET['act_id'] ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="pic" name="pic" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic" required=""/>
               <div id="error_pic"></div>
               
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">顯示於<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row">
          
          <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_084.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input name="modshow"  type="radio" id="modshow_All" value="All" checked="checked" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
              <label for="modshow_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "AD":  // -------------------------------------------------
		 ?>
         <?php if ($OptionADSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_025.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
              <input  type="radio" name="modshow" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="modshow_<?php echo $i ?>" />
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
                 
                    
                    <select name="animation" id="animation" class="form-control" data-parsley-trigger="blur" required>
        
        <?php
do {  
?>
        <option value="<?php echo $row_RecordAdsListAnimation['itemname']?>"><?php echo $row_RecordAdsListAnimation['itemname']?></option>
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
          
                      <input name="link" data-parsley-type="url" pattern= "/^(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?$/i" id="link" maxlength="200" class="form-control" data-parsley-trigger="blur" placeholder="http://www.yoururl.com"  />
                      
                 
          </div>
      </div> 
      <div class="form-group row">
        <label class="col-md-2 col-form-label">開啟方式<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="linktarget" id="linktarget" class="form-control" data-parsley-trigger="blur" required>
                      <option value="_blank">開新視窗 (_blank)</option>
                      <option value="_self" selected="selected">目前視窗 (_self)</option>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述</label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" id="sdescription" size="100" maxlength="150" class="form-control"/> 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> KenBurns效果 <i class="fa fa-info-circle" data-original-title="以數位方式，讓靜態圖像產生動態移動的感覺與效果，會顯示讓攝影機像是掃過照片（搖攝）或從遠而近地顯示照片（縮放）。" data-toggle="tooltip" data-placement="top"></i></span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="datakenburns" id="datakenburns_1" value="1" checked />
                <label for="datakenburns_1">啟用</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="datakenburns" id="datakenburns_2" value="0" />
                <label for="datakenburns_2">關閉</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">移動方向<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                               <img src="images/theme-direction-ctlt.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['databgposition'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgposition" value="0" id="databgposition_0"  />
                                        <label for="databgposition_0">左上</label>
                                      </div>
                                  </div>
            </div> 
                          
                             <div class="card pull-left m-5">
                               <img src="images/theme-direction-ctlb.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['databgposition'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgposition" value="1" id="databgposition_1"  />
                                        <label for="databgposition_1">左下</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                <img src="images/theme-direction-ctrb.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['databgposition'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgposition" value="2" id="databgposition_2"  />
                                        <label for="databgposition_2">右下</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                <img src="images/theme-direction-crt.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['databgposition'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgposition" value="3" id="databgposition_3"  />
                                        <label for="databgposition_3">右上</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                <img src="images/theme-direction-ctbc.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['databgposition'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgposition" value="4" id="databgposition_4"   checked="checked"  />
                                            <label for="databgposition_4">下</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-direction-cttc.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['databgposition'],"5"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgposition" value="5" id="databgposition_5"  />
                                            <label for="databgposition_5">上</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-direction-ctlc.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['databgposition'],"6"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgposition" value="6" id="databgposition_6"  />
                                            <label for="databgposition_6">左</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-direction-ctrc.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['databgposition'],"7"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgposition" value="7" id="databgposition_7"  />
                                            <label for="databgposition_7">右</label>
                                      </div>
                                  </div>
                              </div> 
                          
                     
                 
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">縮放大小<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                               <img src="images/theme-zoom-1.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['databgzoom'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgzoom" value="0" id="databgzoom_0"  checked="checked"/>
                                        <label for="databgzoom_0">放大</label>
                                      </div>
                                  </div>
            </div> 
                          
                             <div class="card pull-left m-5">
                               <img src="images/theme-zoom-4.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['databgzoom'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgzoom" value="1" id="databgzoom_1"  />
                                        <label for="databgzoom_1">放大</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                <img src="images/theme-zoom-2.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['databgzoom'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgzoom" value="2" id="databgzoom_2"  />
                                        <label for="databgzoom_2">縮小</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                <img src="images/theme-zoom-3.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['databgzoom'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="databgzoom" value="3" id="databgzoom_3"  />
                                        <label for="databgzoom_3">縮小</label>
                                      </div>
                                  </div>
                              </div> 
                              
                          
                     
                 
             
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 文字區塊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="datacontent" id="datacontent" cols="100%" rows="35" class="form-control"></textarea>  
          </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">移動方向<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                               <img src="images/bmod_datacontentlocation7.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="0" id="datacontentlocation_0"  checked="checked"/>
                                        <label for="datacontentlocation_0">左上</label>
                                      </div>
                                  </div>
            </div> 
                          
                             <div class="card pull-left m-5">
                               <img src="images/bmod_datacontentlocation1.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="1" id="datacontentlocation_1"  />
                                        <label for="datacontentlocation_1">左下</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                <img src="images/bmod_datacontentlocation3.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="2" id="datacontentlocation_2"  />
                                        <label for="datacontentlocation_2">右下</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                <img src="images/bmod_datacontentlocation9.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="3" id="datacontentlocation_3"  />
                                        <label for="datacontentlocation_3">右上</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                <img src="images/bmod_datacontentlocation2.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="4" id="datacontentlocation_4"     />
                                            <label for="datacontentlocation_4">下</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/bmod_datacontentlocation8.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"5"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="5" id="datacontentlocation_5"  />
                                            <label for="datacontentlocation_5">上</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/bmod_datacontentlocation4.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"6"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="6" id="datacontentlocation_6"  />
                                            <label for="datacontentlocation_6">左</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/bmod_datacontentlocation6.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"7"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="7" id="datacontentlocation_7"  />
                                            <label for="datacontentlocation_7">右</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/bmod_datacontentlocation5.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['datacontentlocation'],"7"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentlocation" value="8" id="datacontentlocation_8"  />
                                            <label for="datacontentlocation_8">中</label>
                                      </div>
                                  </div>
                              </div> 
                          
                     
                 
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">縮放大小<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                               <img src="images/bmod_datacontentoverlay_none.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['datacontentoverlay1'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentoverlay1" value="0" id="datacontentoverlay1_0"  checked="checked"/>
                                        <label for="datacontentoverlay1_0">無</label>
                                      </div>
                                  </div>
            </div> 
                          
                             <div class="card pull-left m-5">
                               <img src="images/bmod_datacontentoverlay_left.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['datacontentoverlay1'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentoverlay1" value="1" id="datacontentoverlay1_1"  />
                                        <label for="datacontentoverlay1_1">左</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                <img src="images/bmod_datacontentoverlay_right.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['datacontentoverlay1'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentoverlay1" value="2" id="datacontentoverlay1_2"  />
                                        <label for="datacontentoverlay1_2">右</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                <img src="images/bmod_datacontentoverlay_center.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['datacontentoverlay1'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="datacontentoverlay1" value="3" id="datacontentoverlay1_3"  />
                                        <label for="datacontentoverlay1_3">中</label>
                                      </div>
                                  </div>
                              </div> 
                              
                          
                     
                 
             
          </div>
      </div>
      
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="act_id" type="hidden" id="act_id" value="<?php echo $_GET['act_id']; ?>" />
            <input name="bwight" type="hidden" id="bwight" value="<?php echo $row_RecordAd['bwight']; ?>" />
            <input name="bhight" type="hidden" id="bhight" value="<?php echo $row_RecordAd['bhight']; ?>" />
            <input name="swight" type="hidden" id="swight" value="<?php echo $row_RecordAd['swight']; ?>" />
            <input name="shight" type="hidden" id="shight" value="<?php echo $row_RecordAd['shight']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Ads" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

</div>

<script type="text/javascript">
<?php 
/*
文檔
https://github.com/kartik-v/bootstrap-fileinput/wiki/12.-%E4%B8%80%E4%BA%9B%E6%A0%B7%E4%BE%8B%E4%BB%A3%E7%A0%81
*/
?>
$(document).ready(function() {
	$("#pic").fileinput({
		showUpload:true, 
		uploadAsync: false, //设置上传同步异步 此为同步
		//uploadUrl: "index.php", //上传的地址  
		allowedFileExtensions: ["jpg"],
		//resizeImage: true,
		maxImageWidth: 2000,
		maxImageHeight: 2000,
		//resizePreference: 'width',
		maxFileSize: 3000,  
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
		});
});
</script>

<?php
mysqli_free_result($RecordAdsListAnimation);

mysqli_free_result($RecordModList);
?>
