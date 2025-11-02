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

/* 取得類別列表 */
$coluserid_RecordPermissionListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermissionListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionListType = sprintf("SELECT * FROM demo_permissionitem WHERE list_id = 2 && (userid=%s || userid=1)",GetSQLValueString($coluserid_RecordPermissionListType, "int"));
$RecordPermissionListType = mysqli_query($DB_Conn, $query_RecordPermissionListType) or die(mysqli_error($DB_Conn));
$row_RecordPermissionListType = mysqli_fetch_assoc($RecordPermissionListType);
$totalRows_RecordPermissionListType = mysqli_num_rows($RecordPermissionListType);

/* 取得作者列表 */
$coluserid_RecordPermissionListAuthor = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermissionListAuthor = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionListAuthor = sprintf("SELECT * FROM demo_permissionitem WHERE list_id = 1 && (userid=%s || userid=1)",GetSQLValueString($coluserid_RecordPermissionListAuthor, "int"));
$RecordPermissionListAuthor = mysqli_query($DB_Conn, $query_RecordPermissionListAuthor) or die(mysqli_error($DB_Conn));
$row_RecordPermissionListAuthor = mysqli_fetch_assoc($RecordPermissionListAuthor);
$totalRows_RecordPermissionListAuthor = mysqli_num_rows($RecordPermissionListAuthor);

$query_RecordModList = "SELECT * FROM demo_configitem";
$RecordModList = mysqli_query($DB_Conn, $query_RecordModList) or die(mysqli_error($DB_Conn));
$row_RecordModList = mysqli_fetch_assoc($RecordModList);
$totalRows_RecordModList = mysqli_num_rows($RecordModList);

$colname_RecordPermission = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordPermission = $_GET['id_edit'];
}
$coluserid_RecordPermission = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermission = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermission = sprintf("SELECT * FROM demo_permission WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordPermission, "int"),GetSQLValueString($coluserid_RecordPermission, "int"));
$RecordPermission = mysqli_query($DB_Conn, $query_RecordPermission) or die(mysqli_error($DB_Conn));
$row_RecordPermission = mysqli_fetch_assoc($RecordPermission);
$totalRows_RecordPermission = mysqli_num_rows($RecordPermission);

// 取得 PermissionRuleUsegroup 是否有設定
$coluserid_RecordPermissionRuleUsegroupGet = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermissionRuleUsegroupGet = $w_userid;
}
$colitemid_RecordPermissionRuleUsegroupGet = "-1";
if (isset($_GET['id_edit'])) {
  $colitemid_RecordPermissionRuleUsegroupGet = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionRuleUsegroupGet = sprintf("SELECT * FROM demo_permissionruleusegroup WHERE itemid=%s && userid=%s",GetSQLValueString($colitemid_RecordPermissionRuleUsegroupGet, "int"),GetSQLValueString($coluserid_RecordPermissionRuleUsegroupGet, "int"));
$RecordPermissionRuleUsegroupGet = mysqli_query($DB_Conn, $query_RecordPermissionRuleUsegroupGet) or die(mysqli_error($DB_Conn));
$row_RecordPermissionRuleUsegroupGet = mysqli_fetch_assoc($RecordPermissionRuleUsegroupGet);
$totalRows_RecordPermissionRuleUsegroupGet = mysqli_num_rows($RecordPermissionRuleUsegroupGet);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Permission")) {
  $updateSQL = sprintf("UPDATE demo_permission SET title=%s, type=%s, module=%s, opt=%s, link=%s, postdate=%s, enable=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
					   GetSQLValueString($_POST['type'], "text"),
                       //GetSQLValueString(implode(",",$_POST['usegroup']), "text"),
                       GetSQLValueString($_POST['module'], "text"),
                       GetSQLValueString($_POST['opt'], "text"),
					   GetSQLValueString(encryptDecrypt('Shop3500 x Fullvision', $_POST['link'],0), "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['enable'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  if($totalRows_RecordPermissionRuleUsegroupGet == 0) {
	  $insertSQL = sprintf("INSERT INTO demo_permissionruleusegroup (grouptype, itemid, lang, userid) VALUES (%s, %s, %s, %s)",
				   GetSQLValueString(implode(",",$_POST['usegroup']), "text"),
				   GetSQLValueString($_POST['id'], "int"),
				   GetSQLValueString($_GET["lang"], "text"),
				   GetSQLValueString($w_userid, "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  }
  
  if($totalRows_RecordPermissionRuleUsegroupGet > 0) {
	  $updateSQL = sprintf("UPDATE demo_permissionruleusegroup SET grouptype=%s WHERE itemid=%s",
						   GetSQLValueString(implode(",",$_POST['usegroup']), "text"), 
						   GetSQLValueString($_POST['id'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result2 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  
  $_SESSION['DB_Edit'] = "Success";
 
  $insertGoTo = "manage_permission.php?Opt=rulepage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 權限規則 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改權限規則</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="title" type="text" required="" class="form-control" id="title" value="<?php echo $row_RecordPermission['title']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">模組類別群組<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                <option value="" <?php if (!(strcmp(-1, $row_RecordPermission['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                <?php if ($totalRows_RecordPermissionListType > 0) { ?>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordPermissionListType['itemvalue']?>" <?php if (!(strcmp($row_RecordPermissionListType['itemvalue'], $row_RecordPermission['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordPermissionListType['itemname']?> - <?php echo $row_RecordPermissionListType['itemvalue']?></option>
								<?php
				} while ($row_RecordPermissionListType = mysqli_fetch_assoc($RecordPermissionListType));
				  $rows = mysqli_num_rows($RecordPermissionListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordPermissionListType, 0);
					  $row_RecordPermissionListType = mysqli_fetch_assoc($RecordPermissionListType);
				  }
				?>
                <?php } ?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">群組<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="usegroup[]" id="usegroup[]" class="form-control sumoselect" data-parsley-trigger="blur" multiple="multiple">
                <!--<option value="">-- 選擇群組 --</option>-->
                <?php if ($totalRows_RecordPermissionListAuthor > 0) { ?>
                <?php $usegroup = mb_split(",",$row_RecordPermissionRuleUsegroupGet['grouptype']); ?>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordPermissionListAuthor['itemvalue']?>" <?php if(in_array($row_RecordPermissionListAuthor['itemvalue'], $usegroup)) { echo "selected=\"selected\"";}?>><?php echo $row_RecordPermissionListAuthor['itemname']?> - <?php echo $row_RecordPermissionListAuthor['itemvalue']?></option>
								<?php
				} while ($row_RecordPermissionListAuthor = mysqli_fetch_assoc($RecordPermissionListAuthor));
				  $rows = mysqli_num_rows($RecordPermissionListAuthor);
				  if($rows > 0) {
					  mysqli_data_seek($RecordPermissionListAuthor, 0);
					  $row_RecordPermissionListAuthor = mysqli_fetch_assoc($RecordPermissionListAuthor);
				  }
				?>
                <?php } ?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">模組<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          <div class="row">
          
          
             
         <?php $i=0 ?>
         <?php do { ?>
         <?php
			switch($row_RecordModList['itemvalue'])
			{
				case "Permission":  // -------------------------------------------------
         ?>
         <?php if ($OptionPermissionSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_001.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
              <input <?php if (!(strcmp($row_RecordPermission['module'],$row_RecordModList['itemvalue']))) {echo "checked=\"checked\"";} ?> type="radio" name="module" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="module_<?php echo $i ?>" />
              <label for="module_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
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
          <label class="col-md-2 col-form-label">功能代號<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="opt" type="text" required="" class="form-control" id="opt" value="<?php echo $row_RecordPermission['opt']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面檔名<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="link" type="text" class="form-control" id="link" value="<?php echo encryptDecrypt('Shop3500 x Fullvision', $row_RecordPermission['link'],1); ?>" maxlength="100" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="enable" id="enable_1" value="1" <?php if (!(strcmp($row_RecordPermission['enable'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="enable_1">啟用</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="enable" id="enable_2" value="0" <?php if (!(strcmp($row_RecordPermission['enable'],"0"))) {echo "checked=\"checked\"";} ?> />
                <label for="enable_2">關閉</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordPermission['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordPermission['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordPermission['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Permission" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
$(document).ready(function() {
		$('.sumoselect').SumoSelect({ okCancelInMulti: true, selectAll: true });
	});
</script>
<?php
mysqli_free_result($RecordPermissionListType);

mysqli_free_result($RecordPermissionListAuthor);

mysqli_free_result($RecordPermissionRuleUsegroupGet);

mysqli_free_result($RecordPermission);

mysqli_free_result($RecordModList);
?>
