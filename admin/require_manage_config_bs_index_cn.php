<?php require_once('../Connections/DB_Conn.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
$updateSQL = sprintf("UPDATE demo_setting_fr SET SiteName_cn=%s, SiteDecsHome_cn=%s, SiteIndicate=%s, SiteIndicateDesc=%s, SiteCopyLock=%s, SiteAnimeCheck=%s, SiteType=%s, SiteFBFan=%s, SiteUrl=%s, SiteMail_cn=%s, SiteAuthor_cn=%s, SiteSName_cn=%s, SitePhone_cn=%s, SiteCell_cn=%s, SiteFax_cn=%s, SiteLINE=%s, SiteAddr_cn=%s, SiteAddrX_cn=%s, SiteAddrY_cn=%s, SiteIndustryType1=%s, SiteIndustryType2=%s, SiteIndustryType3=%s, googlemaparea1=%s, googlemaparea2=%s, googlemaparea3=%s, SiteFontSize=%s, urlwriteenable=%s WHERE id=%s",
                       GetSQLValueString($_POST['sitename'], "text"),
                       GetSQLValueString($_POST['SiteDecsHome'], "text"),
                       GetSQLValueString($_POST['SiteIndicate'], "int"),
					   GetSQLValueString($_POST['SiteIndicateDesc'], "text"),
                       GetSQLValueString($_POST['SiteCopyLock'], "int"),
					   GetSQLValueString($_POST['SiteAnimeCheck'], "int"),
                       GetSQLValueString($_POST['SiteType'], "int"),
                       GetSQLValueString($_POST['SiteFBFan'], "text"),
                       GetSQLValueString($_POST['siteurl'], "text"),
                       GetSQLValueString($_POST['sitemail'], "text"),
                       GetSQLValueString($_POST['siteauthor'], "text"),
                       GetSQLValueString($_POST['SiteSName'], "text"),
                       GetSQLValueString($_POST['SitePhone'], "text"),
                       GetSQLValueString($_POST['SiteCell'], "text"),
                       GetSQLValueString($_POST['SiteFax'], "text"),
					   GetSQLValueString($_POST['SiteLINE'], "text"),
                       GetSQLValueString($_POST['SiteAddr'], "text"),
					   GetSQLValueString($_POST['SiteAddrX'], "text"),
					   GetSQLValueString($_POST['SiteAddrY'], "text"),
					   GetSQLValueString($_POST['SiteIndustryType1'], "text"),
                       GetSQLValueString($_POST['SiteIndustryType2'], "text"),
                       GetSQLValueString($_POST['SiteIndustryType3'], "text"),
					   GetSQLValueString(@$_POST['googlemaparea1'], "text"),
                       GetSQLValueString(@$_POST['googlemaparea2'], "text"),
                       GetSQLValueString(@$_POST['googlemaparea3'], "text"),
					   GetSQLValueString($_POST['SiteFontSize'], "text"),
					   GetSQLValueString($_POST['urlwriteenable'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingFr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingFr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingFr = sprintf("SELECT * FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingFr, "int"));
$RecordSettingFr = mysqli_query($DB_Conn, $query_RecordSettingFr) or die(mysqli_error($DB_Conn));
$row_RecordSettingFr = mysqli_fetch_assoc($RecordSettingFr);
$totalRows_RecordSettingFr = mysqli_num_rows($RecordSettingFr);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingListType = "SELECT * FROM demo_settingitem WHERE list_id = 1";
$RecordSettingListType = mysqli_query($DB_Conn, $query_RecordSettingListType) or die(mysqli_error($DB_Conn));
$row_RecordSettingListType = mysqli_fetch_assoc($RecordSettingListType);
$totalRows_RecordSettingListType = mysqli_num_rows($RecordSettingListType);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordIndustryListType = "SELECT * FROM demo_settingitem WHERE list_id = 2 && level='0' ORDER BY subitem_id";
$RecordIndustryListType = mysqli_query($DB_Conn, $query_RecordIndustryListType) or die(mysqli_error($DB_Conn));
$row_RecordIndustryListType = mysqli_fetch_assoc($RecordIndustryListType);
$totalRows_RecordIndustryListType = mysqli_num_rows($RecordIndustryListType);
?>
<!--<script type="text/javascript" src="../js/jquery.tinyMap-2.2.7.min.js"></script>-->
<?php if ($GoogleMapAPICode != "") { ?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&key=<?php echo $GoogleMapAPICode; ?>"></script>
<?php } ?>
<script type="text/javascript" src="../js/jquery.twzipcode-1.6.0.min.js"></script>
<?php if ($GoogleMapAPICode != "") { ?>
<script>
 $(document).ready(function () {
	 initialize();
	$( ".draggable" ).draggable();
	$('#SiteAddr').focus(function(){
	  var addr = $('#SiteAddr').val();
	  if(addr != '') {
	  var opt_direction = {
		center: addr,
		zoom: 15,
		marker: [
            {addr: addr, text: '', label: '', css: 'Googlemap_label'}
        ]
		};
		$('#out').empty().html('<div class="alert alert-secondary fade show m-b-10" style="z-index:1000"><span class="close" data-dismiss="alert">×</span>拖曳【<i class="fa fa-map-marker"></i>】可設定更精確座標點<div id="map_canvas" class="" style="width:350px; height:350px;"></div></div>');
		initialize(); // 初始化
		//GetAddressMarker(); // 產生座標
		//$("#SiteAddrX").val("1211");
		//$('#map_canvas').tinyMap(opt_direction);
	  }
	});
 });
</script>
<?php } ?>
<style>
.Googlemap_label{font-size:12px;background:rgba(22,22,22,0.6);color:#fff;padding:.25em}#map_canvas { height: 100% }
</style>


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 網站基本資料 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本設定</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站標題名稱<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="網站標題的顯示名稱及FB顯示名稱，會影響搜尋引擎搜尋之標題。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="sitename" type="text" class="form-control" id="sitename" value="<?php echo $row_RecordSettingFr['SiteName_cn']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站描述<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="網站基本描述，會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="SiteDecsHome" type="text" class="form-control" id="SiteDecsHome" value="<?php echo $row_RecordSettingFr['SiteDecsHome_cn']; ?>" maxlength="300" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站狀態<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="會顯示提示訊息告知正在維修中。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['SiteIndicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteIndicate" id="SiteIndicate_1" value="1" />
                <label for="SiteIndicate_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['SiteIndicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteIndicate" id="SiteIndicate_2" value="0" />
                <label for="SiteIndicate_2">關閉</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站關閉狀態提示文字 <i class="fa fa-info-circle text-orange" data-original-title="網站暫時關閉的提醒訊息。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="SiteIndicateDesc" type="text" class="form-control" id="SiteIndicateDesc" value="<?php echo $row_RecordSettingFr['SiteIndicateDesc']; ?>" maxlength="300" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站複製與否<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="網站鎖定鍵盤和滑鼠。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['SiteCopyLock'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteCopyLock" id="SiteCopyLock_1" value="0" />
                <label for="SiteCopyLock_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['SiteCopyLock'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteCopyLock" id="SiteCopyLock_2" value="1" />
                <label for="SiteCopyLock_2">鎖定</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站動畫<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="網站的動畫效果。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['SiteCopyLock'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteAnimeCheck" id="SiteAnimeCheck_0" value="0" />
                <label for="SiteAnimeCheck_0">關閉</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['SiteCopyLock'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteAnimeCheck" id="SiteAnimeCheck_1" value="1" />
                <label for="SiteAnimeCheck_1">隨時刷新動畫特效</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['SiteCopyLock'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteAnimeCheck" id="SiteAnimeCheck_2" value="2" />
                <label for="SiteAnimeCheck_2">只執行一次動畫特效</label>
            </div>
            
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網址SEO<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="是否改變網址結構。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['urlwriteenable'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="urlwriteenable" id="urlwriteenable_1" value="1" />
                <label for="urlwriteenable_1">使用</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['urlwriteenable'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="urlwriteenable" id="urlwriteenable_2" value="0" />
                <label for="urlwriteenable_2">不使用</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">強制設定網站文字大小<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="網站整體的文字大小，強制指定時樣版設定文字大小的功能部分會失效。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
              <select name="SiteFontSize" id="SiteFontSize" class="form-control">
      	      <option value="" <?php if (!(strcmp("", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>以樣版設定為準</option>
      	      <option value="9px"  <?php if (!(strcmp("9px", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 9px</option>
      	      <option value="10px"  <?php if (!(strcmp("10px", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 10px</option>
      	      <option value="11px"  <?php if (!(strcmp("11px", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 11px</option>
      	      <option value="12px"  <?php if (!(strcmp("12px", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 12px</option>
      	      <option value="13px"  <?php if (!(strcmp("13px", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 13px</option>
      	      <option value="14px"  <?php if (!(strcmp("14px", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 14px</option>
      	      <option value="xx-small"  <?php if (!(strcmp("xx-small", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 xx-small</option>
      	      <option value="x-small"  <?php if (!(strcmp("x-small", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 x-small</option>
      	      <option value="small"  <?php if (!(strcmp("small", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 small</option>
      	      <option value="medium"  <?php if (!(strcmp("medium", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 medium</option>
      	      <option value="large"  <?php if (!(strcmp("large", $row_RecordSettingFr['SiteFontSize']))) {echo "selected=\"selected\"";} ?>>強制 large</option>
   	        </select>  
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">全站分類<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="網站分類。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
              <select name="SiteType" id="SiteType" class="form-control">
      	      <option value="" <?php if (!(strcmp("", $row_RecordSettingFr['SiteType']))) {echo "selected=\"selected\"";} ?>>-- 選擇全站分類 --</option>
      	      <?php
do {  
?>
      	      <option value="<?php echo $row_RecordSettingListType['item_id']?>"<?php if (!(strcmp($row_RecordSettingListType['item_id'], $row_RecordSettingFr['SiteType']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordSettingListType['itemname']?></option>
      	      <?php
} while ($row_RecordSettingListType = mysqli_fetch_assoc($RecordSettingListType));
  $rows = mysqli_num_rows($RecordSettingListType);
  if($rows > 0) {
      mysqli_data_seek($RecordSettingListType, 0);
	  $row_RecordSettingListType = mysqli_fetch_assoc($RecordSettingListType);
  }
?>
            </select>  
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">行業別<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定您的行業分類。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="row p-10">
              <select name="SiteIndustryType1" id="SiteIndustryType1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="" <?php if (!(strcmp(-1, $row_RecordSettingFr['SiteIndustryType1']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordIndustryListType['item_id']?>"<?php if (!(strcmp($row_RecordIndustryListType['item_id'], $row_RecordSettingFr['SiteIndustryType1']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordIndustryListType['itemname']?></option>
                      <?php
} while ($row_RecordIndustryListType = mysqli_fetch_assoc($RecordIndustryListType));
  $rows = mysqli_num_rows($RecordIndustryListType);
  if($rows > 0) {
      mysqli_data_seek($RecordIndustryListType, 0);
	  $row_RecordIndustryListType = mysqli_fetch_assoc($RecordIndustryListType);
  }
?>
            </select>
                    
                    
                    <select name="SiteIndustryType2" id="SiteIndustryType2" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordIndustryListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類2 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordIndustryListType['item_id']?>"<?php if (!(strcmp($row_RecordIndustryListType['item_id'], $row_RecordIndustryListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordIndustryListType['itemname']?></option>
<?php
} while ($row_RecordIndustryListType = mysqli_fetch_assoc($RecordIndustryListType));
  $rows = mysqli_num_rows($RecordIndustryListType);
  if($rows > 0) {
      mysqli_data_seek($RecordIndustryListType, 0);
	  $row_RecordIndustryListType = mysqli_fetch_assoc($RecordIndustryListType);
  }
?>
            </select>

                    
                    <select name="SiteIndustryType3" id="SiteIndustryType3" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordIndustryListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類3 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordIndustryListType['item_id']?>"<?php if (!(strcmp($row_RecordIndustryListType['item_id'], $row_RecordIndustryListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordIndustryListType['itemname']?></option>
                      <?php
} while ($row_RecordIndustryListType = mysqli_fetch_assoc($RecordIndustryListType));
  $rows = mysqli_num_rows($RecordIndustryListType);
  if($rows > 0) {
      mysqli_data_seek($RecordIndustryListType, 0);
	  $row_RecordIndustryListType = mysqli_fetch_assoc($RecordIndustryListType);
  }
?>
                    </select>  
                 
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站網址</label>
          <div class="col-md-10">
                      
                      <input name="siteurl" type="text" id="siteurl" value="<?php echo $row_RecordSettingFr['SiteUrl']; ?>" size="50" maxlength="150" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 頁尾資訊</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="SiteSName" type="text" class="form-control" id="SiteSName" value="<?php echo $row_RecordSettingFr['SiteSName_cn']; ?>" maxlength="100" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
                      
                      <input name="SitePhone" type="text" id="SitePhone" value="<?php echo $row_RecordSettingFr['SitePhone_cn']; ?>" maxlength="30" data-parsley-trigger="blur" class="form-control"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">行動/手機</label>
          <div class="col-md-10">
                      
                      <input name="SiteCell" type="text" id="SitePhone" value="<?php echo $row_RecordSettingFr['SiteCell_cn']; ?>" maxlength="15" data-parsley-trigger="blur" class="form-control"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">
                      
                      <input name="SiteFax" type="text" id="SiteFax" value="<?php echo $row_RecordSettingFr['SiteFax_cn']; ?>" maxlength="20" data-parsley-trigger="blur" class="form-control"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">LINE ID</label>
          <div class="col-md-10">
                      
                      <input name="SiteLINE" type="text" id="SiteLINE" value="<?php echo $row_RecordSettingFr['SiteLINE']; ?>" maxlength="50" data-parsley-trigger="blur" class="form-control"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">地址</label>
          <div class="col-md-10">
                      
                      <input name="SiteAddr" type="text" id="SiteAddr" value="<?php echo $row_RecordSettingFr['SiteAddr_cn']; ?>" size="50" maxlength="250" data-parsley-trigger="blur" class="form-control"/>
<div id="NowLatLng"><i class="fa fa-map-marker"></i> 目前標記位置：【經度：<?php echo $row_RecordSettingFr['SiteAddrY']; ?>】【緯度：<?php echo $row_RecordSettingFr['SiteAddrX']; ?>】</div>
<div style="position:relative"><div class="" id="out" style="position:absolute;"><div id="map_canvas"></div></div></div>
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_MapS">
          <label class="col-md-2 col-form-label">GPS座標 <i class="fa fa-info-circle text-orange" data-original-title="若尚未輸入GoogleMapAPI KEY或欲更精準位置，請手動輸入。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-5">
            <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">緯度</span></div>
                  <input name="SiteAddrX" type="text" class="form-control" id="SiteAddrX" value="<?php echo $row_RecordSettingFr['SiteAddrX']; ?>" maxlength="20" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
            <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">經度</span></div>
                  <input name="SiteAddrY" type="text" class="form-control" id="SiteAddrY" value="<?php echo $row_RecordSettingFr['SiteAddrY']; ?>" maxlength="20" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">寄送郵件Mail<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="寄送信件之顯示寄送Mail。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="sitemail" type="email" id="sitemail" value="<?php echo $row_RecordSettingFr['SiteMail_cn']; ?>" size="50" maxlength="150" data-parsley-trigger="blur" class="form-control" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">寄送郵件名稱<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="寄送信件之顯示信件標題。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="siteauthor" type="text" id="siteauthor" value="<?php echo $row_RecordSettingFr['SiteAuthor_cn']; ?>" size="50" maxlength="150"  data-parsley-trigger="blur" class="form-control" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 其他</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站圖示 <i class="fa fa-info-circle text-orange" data-original-title="FB發布後顯示的圖片以及您的網站代表圖片。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">      
          <a href="uplod_siteshowimage.php?id_edit=<?php echo $row_RecordSettingFr['id']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a>                    
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站小圖示 <i class="fa fa-info-circle text-orange" data-original-title="顯示於網站頁簽的小圖示 附檔名為.ico。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">      
          <a href="uplod_siteshowimageicon.php?id_edit=<?php echo $row_RecordSettingFr['id']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a>                    
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">FB粉絲頁 <i class="fa fa-info-circle text-orange" data-original-title="若您的網站有此功能則可輸入FB粉絲頁網址。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
              <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">https://www.facebook.com/</span></div>
                  <input name="SiteFBFan" type="text" id="SiteFBFan" value="<?php echo $row_RecordSettingFr['SiteFBFan']; ?>" size="20" maxlength="100" data-parsley-trigger="blur" class="form-control"/>
                                      
              </div>
                      
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSettingFr['id']; ?>" />
          <input id="fullIdPath" type="hidden" value="<?php echo $row_RecordSettingFr['SiteIndustryType1']; ?>,<?php echo $row_RecordSettingFr['SiteIndustryType2']; ?>,<?php echo $row_RecordSettingFr['SiteIndustryType3']; ?>" />
          <input name="Operate" type="hidden" id="Operate" value="editSuccess" />

          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php if ($GoogleMapAPICode != "") { ?>
<script type="text/javascript">
  var map;
  var marker;
   
  function initialize() 
  {
	//初始化地圖時的定位經緯度設定
    var latlng = new google.maps.LatLng(23.973875,120.982024); //台灣緯度Latitude、經度Longitude：23.973875,120.982024
    //初始化地圖options設定
	var mapOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	//初始化地圖
    map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
	//加入標記點
	marker = new google.maps.Marker({
		  draggable:true,
		  position: latlng,
		  title:"台灣 Taiwan",
		  map:map
	});	
	//增加標記點的mouseup事件
	google.maps.event.addListener(marker, 'mouseup', function() {
		LatLng = marker.getPosition();
		$("#NowLatLng").html("<i class=\"fa fa-map-marker\"></i> 移動標記後位置：【經度：" + LatLng.lng() + "】【緯度：" + LatLng.lat() + "】");
		$("#SiteAddrX").val(LatLng.lat());
		$("#SiteAddrY").val(LatLng.lng());
	});
	
  }
  
  function GetAddressMarker()
  {//重新定位地圖位置與標記點位置
  <?php //if($row_RecordSettingFr['SiteAddrX'] != "" && $row_RecordSettingFr['SiteAddrY'] != "") { ?>
	 address = $("#SiteAddr").val();
	 geocoder = new google.maps.Geocoder();
	 geocoder.geocode(
		 {
		  'address':address
		 },function (results,status) 
		 {
			if(status==google.maps.GeocoderStatus.OK) 
			{
			   //console.log(results[0].geometry.location);
			   LatLng = results[0].geometry.location;
			   map.setCenter(LatLng);		//將地圖中心定位到查詢結果
			   marker.setPosition(LatLng);	//將標記點定位到查詢結果
			   marker.setTitle(address);	//重新設定標記點的title
			   $("#NowLatLng").html("<i class=\"fa fa-map-marker\"></i> 目前標記位置：【經度：" + LatLng.lng() + "】【緯度：" + LatLng.lat() + "】");
			   $("#SiteAddrX").val(LatLng.lat());
			   $("#SiteAddrY").val(LatLng.lng());
			}
		 }
	 ); 
	 <?php //} else { ?>
	 <?php //}  ?>
  }
   $(document).ready(function() { 
	//綁定地址輸入框的keyup事件以即時重新定位
	$('#SiteAddr').blur(function(){
		GetAddressMarker();
		//$("#NowLatLng").html("【移動標記點後的位置】");
	});	
  });
 /* $(document).ready(function() { 
	//綁定地址輸入框的keyup事件以即時重新定位
	$("#SiteAddr").bind("keyup",function(){	
		GetAddressMarker();
		$("#NowLatLng").html("【移動標記點後的位置】");
	});	
  });*/
</script>
<?php } ?>
<script type="text/javascript">
$(function () {
    $('#twzipcode').twzipcode({
		countySel: '<?php echo $row_RecordSettingFr['googlemaparea1']; ?>', //縣市預設值
        districtSel: '<?php echo $row_RecordSettingFr['googlemaparea2']; ?>', //鄉鎮市區預設值
        countyName: 'googlemaparea1', //POST googlemaparea1
        districtName: 'googlemaparea2',//POST googlemaparea2
        zipcodeName: 'googlemaparea3'//POST googlemaparea3
    });
});
</script>
<script type="text/javascript">
            $(document).ready(function() {
				    //外框架
                    $("#change_addr").click(function(){
							// 清除外框架
							var county = $('select[name="googlemaparea1"]').val();
							var district  = $('select[name="googlemaparea2"]').val();
							var zip = $(':input[name=googlemaparea3]').val();
							$("#SiteAddr").val(zip+county+district);
                    });
            });
            </script>
<script type="text/javascript">
// 下拉連動選單設定
$(function () {

    // 判斷是否有預設值
    var defaultValue = false;
    if (0 < $.trim($('#fullIdPath').val()).length) {
        $fullIdPath = $('#fullIdPath').val().split(',');
        defaultValue = true;
    }
    
    // 設定預設選項
    if (defaultValue) {
        $('#SiteIndustryType1').selectOptions($fullIdPath[0]); 
    }
    
	//$("#SiteIndustryType2").hide(); //開始執行時先將第二層的選單藏起來
	//$("#SiteIndustryType3").hide(); //開始執行時先將第二層的選單藏起來
    // 開始產生關聯下拉式選單
    $('#SiteIndustryType1').change(function () {
        // 觸發第二階下拉式選單
		//$("選單ID").addOption("選單內容物件",false);
		//$("選單ID").removeOption("選單索引/值/陣列");若是要刪掉全部則框號內置入/./
        $('#SiteIndustryType2').removeOption(/.?/).ajaxAddOption(
            'selectbox_action/industry_add.php?&<?php echo time();?>', 
            { 'id': $(this).val(), 'lv': 1 }, 
            false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
            function () {
                
                // 設定預設選項
                if (defaultValue) {
                    $(this).selectOptions($fullIdPath[1]).trigger('change');
                } else {
                    $(this).selectOptions().trigger('change');
                }
				
				// 設定欄位隱藏/開啟
				if( $('#SiteIndustryType1 option:selected').val() != '' && $('#SiteIndustryType2 option:selected').val() != '')
				// 值=val() // 標籤=text
				{
					$("#SiteIndustryType2").show(); // 
				}else{
					$("#SiteIndustryType2").hide(); //
				}
            }
        ).change(function () {
            // 觸發第三階下拉式選單
            $('#SiteIndustryType3').removeOption(/.?/).ajaxAddOption(
                'selectbox_action/industry_add.php?<?php echo time();?>', 
                { 'id': $(this).val(), 'lv': 2 }, 
                false, 
                function () {
                
                    // 設定預設選項
                    if (defaultValue) {
                        $(this).selectOptions($fullIdPath[2]);
                    }
					// 設定欄位隱藏/開啟
					if( $('#SiteIndustryType2 option:selected').val() != '' && $('#SiteIndustryType3 option:selected').val() != '')
					// 值=val() // 標籤=text
					{
						$("#SiteIndustryType3").show(); // 
					}else{
						$("#SiteIndustryType3").hide(); //
					}
					}
            );
        });
    }).trigger('change');

    // 全部選擇完畢後，顯示所選擇的選項
    /*$('#SiteIndustryType3').change(function () {
        alert('主機：' + $('#SiteIndustryType1 option:selected').text() + 
              '／類型：' + $('#SiteIndustryType2 option:selected').text() +
              '／遊戲：' + $('#SiteIndustryType3 option:selected').text());
    });*/
});
</script>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php
mysqli_free_result($RecordSettingFr);

mysqli_free_result($RecordSettingListType);

mysqli_free_result($RecordIndustryListType);
?>
