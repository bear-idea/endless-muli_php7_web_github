<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/modlink";
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	$ppu->formName = "form_Modlink";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "500";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "false";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "500";
	$ppu->maxHeight = "500";
	$ppu->saveWidth = "";
	$ppu->saveHeight = "";
	$ppu->timeout = "600";
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

if (isset($editFormAction)) {
  if (isset($_SERVER['QUERY_STRING'])) {
	  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}

/* 取得類別列表 */
$colname_RecordModlinkListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordModlinkListType = $_GET['lang'];
}
$coluserid_RecordModlinkListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordModlinkListType = $w_userid;
}
$colname_RecordModlinkListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordModlinkListType = $_GET['lang'];
}
$coluserid_RecordModlinkListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordModlinkListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlinkListType = sprintf("SELECT * FROM demo_modlinkitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordModlinkListType, "text"),GetSQLValueString($coluserid_RecordModlinkListType, "int"));
$RecordModlinkListType = mysqli_query($DB_Conn, $query_RecordModlinkListType) or die(mysqli_error($DB_Conn));
$row_RecordModlinkListType = mysqli_fetch_assoc($RecordModlinkListType);
$totalRows_RecordModlinkListType = mysqli_num_rows($RecordModlinkListType);

$colname_RecordModlink = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordModlink = $_GET['id_edit'];
}
$coluserid_RecordModlink = "-1";
if (isset($w_userid)) {
  $coluserid_RecordModlink = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlink = sprintf("SELECT * FROM demo_modlink WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordModlink, "int"),GetSQLValueString($coluserid_RecordModlink, "int"));
$RecordModlink = mysqli_query($DB_Conn, $query_RecordModlink) or die(mysqli_error($DB_Conn));
$row_RecordModlink = mysqli_fetch_assoc($RecordModlink);
$totalRows_RecordModlink = mysqli_num_rows($RecordModlink);

$query_RecordModList = "SELECT * FROM demo_configitem";
$RecordModList = mysqli_query($DB_Conn, $query_RecordModList) or die(mysqli_error($DB_Conn));
$row_RecordModList = mysqli_fetch_assoc($RecordModList);
$totalRows_RecordModList = mysqli_num_rows($RecordModList);

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Modlink")) {
  $insertSQL = sprintf("INSERT INTO demo_modlink (name, type, typemenu, pic, sdescription, modselect, picname, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['typemenu'], "text"),
                       GetSQLValueString($_POST['pic'], "text"),
                       GetSQLValueString($_POST['sdescription'], "text"),
					   GetSQLValueString($_POST['modselect'], "int"),
					   GetSQLValueString($_POST['picname'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_modlink.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Modlink']; ?> <small>複增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 複增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordModlink['name']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                <option <?php if (!(strcmp("", $row_RecordModlink['type']))) {echo "selected=\"selected\"";} ?> value="">-- 選擇類別 --</option>
                <?php
				do {  
				?>
								<option <?php if (!(strcmp($row_RecordModlinkListType['itemname'], $row_RecordModlink['type']))) {echo "selected=\"selected\"";} ?> value="<?php echo $row_RecordModlinkListType['itemname']?>"><?php echo $row_RecordModlinkListType['itemname']?></option>
								<?php
				} while ($row_RecordModlinkListType = mysqli_fetch_assoc($RecordModlinkListType));
				  $rows = mysqli_num_rows($RecordModlinkListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordModlinkListType, 0);
					  $row_RecordModlinkListType = mysqli_fetch_assoc($RecordModlinkListType);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連結模組頁面<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          <div class="row">
          
          
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
             <?php if ($OptionCartSelect == '1') {?>
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_088.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],'Cart_Pay'))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="Cart_Pay" id="typemenu_Cart_Pay"/>
                  <label for="typemenu_Cart_Pay">匯款通知</label>
             </div>
             </div>
             </div>
             
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_091.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  <?php if (!(strcmp($row_RecordModlink['typemenu'],'Cart_Note'))) {echo "checked=\"checked\"";} ?> type="radio" name="typemenu" value="Cart_Note" id="typemenu_Cart_Note"/>
                  <label for="typemenu_Cart_Note">購物須知</label>
             </div>
             </div>
             </div>
             <?php } ?>
             
             <div style="clear:both"></div>
             
          </div>
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片<span class="text-red">*</span></label>
          <div class="col-md-10">
               <input id="pic" name="pic" type="file" size="50" maxlength="50" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic" required=""/>
               <div id="error_pic"></div>
               
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordModlink['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordModlink['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述</label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordModlink['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordModlink['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            
            <input name="modselect"  type="hidden" id="modselect" value="1" />
            <input name="picname"  type="hidden" id="picname" value="fri_mod01.jpg" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Modlink" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

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
		allowedFileExtensions: ["jpg", "png", "gif"],
		//resizeImage: true,
		maxImageWidth: 500,
		maxImageHeight: 500,
		//resizePreference: 'width',
		maxFileSize: 1000,  
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
		});
});
</script>

<?php
mysqli_free_result($RecordModlinkListType);

mysqli_free_result($RecordModlink);

mysqli_free_result($RecordModList);
?>
