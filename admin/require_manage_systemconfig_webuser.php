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
  $updateSQL = sprintf("UPDATE demo_setting SET Defaultlang=%s, HighlightSelect=%s, SiteNoteChoose=%s, SiteModChoose=%s, LangChooseZHTW=%s, LangChooseZHCN=%s, LangChooseEN=%s, LangChooseJP=%s, LangChooseKR=%s, LangChooseSP=%s, FBICONChoose=%s, GOOGLEICONChoose=%s, PLURKICONChoose=%s, SITEMAPICONChoose=%s, RSSICONChoose=%s, MSNICONChoose=%s, MAILICONChoose=%s, OptionNewsSelect=%s, OptionLettersSelect=%s, OptionActnewsSelect=%s, OptionFaqSelect=%s, OptionProductSelect=%s, OptionMeetingSelect=%s, OptionSponsorSelect=%s, OptionFrilinkSelect=%s, OptionOtrlinkSelect=%s, OptionCareersSelect=%s, OptionPublishSelect=%s, OptionGuestbookSelect=%s, OptionMemberSelect=%s, OptionActivitiesSelect=%s, OptionProjectSelect=%s, OptionAdsSelect=%s, OptionDonationSelect=%s, OptionArticleSelect=%s, OptionAboutSelect=%s, OptionContactSelect=%s, OptionDfPageSelect=%s, OptionCatalogSelect=%s, OptionKnowledgeSelect=%s, OptionCartSelect=%s, OptionCartPaymentSelect=%s, OptionCartPayLogisticSelect=%s, OptionTicketsSelect=%s, OptionOrgSelect=%s, OptionFileMangSelect=%s, OptionAnalysisSelect=%s, OptionAlbumSelect=%s, OptionVideoSelect=%s, OptionMailSendSelect=%s, OptionEPaperSelect=%s, OptionADWallSelect=%s, OptionPartnerSelect=%s, OptionArtlistSelect=%s, OptionDailySelect=%s, OptionForumSelect=%s, OptionCalendarSelect=%s, OptionMenuMaintainSelect=%s, OptionWebSiteSelect=%s, OptionBlogSelect=%s, OptionTmpSelect=%s, OptionPicasaSelect=%s, OptionTimelineSelect=%s, OptionImageshowSelect=%s, OptionStrongholdSelect=%s, OptionRoomSelect=%s, OptionAttractionsSelect=%s, OptionSocialChatSelect=%s, OptionTmpHomeSelect=%s, OptionMobileSelect=%s, OptionDealerSelect=%s, OptionScaleSourceSelect=%s, OptionScaleClearanceSelect=%s, OptionBookingSelect=%s, OptionSplitOrderSelect=%s, dfpage_limit_page_num=%s, tmp_column_plus=%s WHERE id=%s",
                       GetSQLValueString($_POST['Defaultlang'], "text"),
                       GetSQLValueString($_POST['HighlightSelect'], "int"),
                       GetSQLValueString($_POST['SiteNoteChoose'], "int"),
					   GetSQLValueString($_POST['SiteModChoose'], "int"),
                       GetSQLValueString($_POST['LangChooseZHTW'], "int"),
                       GetSQLValueString($_POST['LangChooseZHCN'], "int"),
                       GetSQLValueString($_POST['LangChooseEN'], "int"),
                       GetSQLValueString($_POST['LangChooseJP'], "int"),
					   GetSQLValueString($_POST['LangChooseKR'], "int"),
					   GetSQLValueString($_POST['LangChooseSP'], "int"),
                       GetSQLValueString($_POST['FBICONChoose'], "int"),
                       GetSQLValueString($_POST['GOOGLEICONChoose'], "int"),
                       GetSQLValueString($_POST['PLURKICONChoose'], "int"),
                       GetSQLValueString($_POST['SITEMAPICONChoose'], "int"),
                       GetSQLValueString($_POST['RSSICONChoose'], "int"),
                       GetSQLValueString($_POST['MSNICONChoose'], "int"),
                       GetSQLValueString($_POST['MAILICONChoose'], "int"),
                       GetSQLValueString($_POST['OptionNewsSelect'], "int"),
                       GetSQLValueString($_POST['OptionLettersSelect'], "int"),
                       GetSQLValueString($_POST['OptionActnewsSelect'], "int"),
                       GetSQLValueString($_POST['OptionFaqSelect'], "int"),
                       GetSQLValueString($_POST['OptionProductSelect'], "int"),
                       GetSQLValueString($_POST['OptionMeetingSelect'], "int"),
                       GetSQLValueString($_POST['OptionSponsorSelect'], "int"),
                       GetSQLValueString($_POST['OptionFrilinkSelect'], "int"),
                       GetSQLValueString($_POST['OptionOtrlinkSelect'], "int"),
                       GetSQLValueString($_POST['OptionCareersSelect'], "int"),
                       GetSQLValueString($_POST['OptionPublishSelect'], "int"),
                       GetSQLValueString($_POST['OptionGuestbookSelect'], "int"),
                       GetSQLValueString($_POST['OptionMemberSelect'], "int"),
                       GetSQLValueString($_POST['OptionActivitiesSelect'], "int"),
                       GetSQLValueString($_POST['OptionProjectSelect'], "int"),
                       GetSQLValueString($_POST['OptionAdsSelect'], "int"),
                       GetSQLValueString($_POST['OptionDonationSelect'], "int"),
                       GetSQLValueString($_POST['OptionArticleSelect'], "int"),
                       GetSQLValueString($_POST['OptionAboutSelect'], "int"),
                       GetSQLValueString($_POST['OptionContactSelect'], "int"),
                       GetSQLValueString($_POST['OptionDfPageSelect'], "int"),
                       GetSQLValueString($_POST['OptionCatalogSelect'], "int"),
                       GetSQLValueString($_POST['OptionKnowledgeSelect'], "int"),
                       GetSQLValueString($_POST['OptionCartSelect'], "int"),
					   GetSQLValueString($_POST['OptionCartPaymentSelect'], "int"),
					   GetSQLValueString($_POST['OptionCartPayLogisticSelect'], "int"),
                       GetSQLValueString($_POST['OptionTicketsSelect'], "int"),
                       GetSQLValueString($_POST['OptionOrgSelect'], "int"),
                       GetSQLValueString($_POST['OptionFileMangSelect'], "int"),
                       GetSQLValueString($_POST['OptionAnalysisSelect'], "int"),
                       GetSQLValueString($_POST['OptionAlbumSelect'], "int"),
                       GetSQLValueString($_POST['OptionVideoSelect'], "int"),
                       GetSQLValueString($_POST['OptionMailSendSelect'], "int"),
                       GetSQLValueString($_POST['OptionEPaperSelect'], "int"),
                       GetSQLValueString($_POST['OptionADWallSelect'], "int"),
                       GetSQLValueString($_POST['OptionPartnerSelect'], "int"),
                       GetSQLValueString($_POST['OptionArtlistSelect'], "int"),
                       GetSQLValueString($_POST['OptionDailySelect'], "int"),
                       GetSQLValueString($_POST['OptionForumSelect'], "int"),
                       GetSQLValueString(@$_POST['OptionCalendarSelect'], "int"),
                       GetSQLValueString($_POST['OptionMenuMaintainSelect'], "int"),
                       GetSQLValueString($_POST['OptionWebSiteSelect'], "int"),
                       GetSQLValueString($_POST['OptionBlogSelect'], "int"),
                       GetSQLValueString($_POST['OptionTmpSelect'], "int"),
                       GetSQLValueString($_POST['OptionPicasaSelect'], "int"),
                       GetSQLValueString($_POST['OptionTimelineSelect'], "int"),
                       GetSQLValueString($_POST['OptionImageshowSelect'], "int"),
                       GetSQLValueString($_POST['OptionStrongholdSelect'], "int"),
                       GetSQLValueString($_POST['OptionRoomSelect'], "int"),
                       GetSQLValueString($_POST['OptionAttractionsSelect'], "int"),
					   GetSQLValueString($_POST['OptionSocialChatSelect'], "int"),
                       GetSQLValueString($_POST['OptionTmpHomeSelect'], "int"),
                       GetSQLValueString($_POST['OptionMobileSelect'], "int"),
                       GetSQLValueString($_POST['OptionDealerSelect'], "int"),
					   GetSQLValueString($_POST['OptionScaleSourceSelect'], "int"),
					   GetSQLValueString($_POST['OptionScaleClearanceSelect'], "int"),
					   GetSQLValueString($_POST['OptionBookingSelect'], "int"),
					   GetSQLValueString($_POST['OptionSplitOrderSelect'], "int"),
                       GetSQLValueString($_POST['dfpage_limit_page_num'], "int"),
                       GetSQLValueString($_POST['tmp_column_plus'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSystemConfig = "-1";
if (isset($_GET['id_edit'])) {
  $coluserid_RecordSystemConfig = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfig = sprintf("SELECT * FROM demo_setting WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfig, "int"));
$RecordSystemConfig = mysqli_query($DB_Conn, $query_RecordSystemConfig) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfig = mysqli_fetch_assoc($RecordSystemConfig);
$totalRows_RecordSystemConfig = mysqli_num_rows($RecordSystemConfig);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 模組啟用及相關資料 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
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
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 通用設定</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">預設語系<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="頁面使用之預設語系。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Defaultlang'],"zh-tw"))) {echo "checked=\"checked\"";} ?> type="radio" name="Defaultlang" id="Defaultlang_1" value="zh-tw" />
                <label for="Defaultlang_1">繁體</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Defaultlang'],"zh-cn"))) {echo "checked=\"checked\"";} ?> type="radio" name="Defaultlang" id="Defaultlang_2" value="zh-cn" />
                <label for="Defaultlang_2">簡體</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Defaultlang'],"en"))) {echo "checked=\"checked\"";} ?> type="radio" name="Defaultlang" id="Defaultlang_3" value="en" />
                <label for="Defaultlang_3">英文</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Defaultlang'],"jp"))) {echo "checked=\"checked\"";} ?> type="radio" name="Defaultlang" id="Defaultlang_4" value="jp" />
                <label for="Defaultlang_4">日文</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Defaultlang'],"kr"))) {echo "checked=\"checked\"";} ?> type="radio" name="Defaultlang" id="Defaultlang_5" value="kr" />
                <label for="Defaultlang_5">韓語</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Defaultlang'],"sp"))) {echo "checked=\"checked\"";} ?> type="radio" name="Defaultlang" id="Defaultlang_6" value="sp" />
                <label for="Defaultlang_6">西班牙</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Defaultlang'],"auto"))) {echo "checked=\"checked\"";} ?> type="radio" name="Defaultlang" id="Defaultlang_7" value="auto" />
                <label for="Defaultlang_7">根據瀏覽器判斷</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">搜索提示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="搜索結果會以醒目顏色做提示。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['HighlightSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="HighlightSelect" id="HighlightSelect_1" value="1" />
                <label for="HighlightSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['HighlightSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="HighlightSelect" id="HighlightSelect_2" value="0" />
                <label for="HighlightSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 系統模式</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">模式<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="選擇系統模式。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SiteModChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteModChoose" id="SiteModChoose_1" value="0" />
                <label for="SiteModChoose_1">網頁系統架構</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SiteModChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteModChoose" id="SiteModChoose_2" value="1" />
                <label for="SiteModChoose_2">地磅系統架構</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SiteModChoose'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteModChoose" id="SiteModChoose_3" value="2" />
                <label for="SiteModChoose_3">進銷存系統架構</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SiteModChoose'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteModChoose" id="SiteModChoose_4" value="3" />
                <label for="SiteModChoose_4">人事薪資系統架構</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SiteModChoose'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteModChoose" id="SiteModChoose_5" value="4" />
                <label for="SiteModChoose_5">Mail擷取系統架構</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 擴充功能</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">便簽留言<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="便簽是否啟用。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SiteNoteChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteNoteChoose" id="SiteNoteChoose_1" value="1" />
                <label for="SiteNoteChoose_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SiteNoteChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="SiteNoteChoose" id="SiteNoteChoose_2" value="0" />
                <label for="SiteNoteChoose_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 圖示連結&amp;語系</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站語系<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前網頁擁有的語言及上方小圖示顯示與否。" data-toggle="tooltip" data-placement="top"></i></label>                      	
          <div class="col-md-2">
            <span class="label label-success">繁體</span>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseZHTW'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseZHTW" id="LangChooseZHTW_1" value="1" />
                <label for="LangChooseZHTW_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseZHTW'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseZHTW" id="LangChooseZHTW_2" value="0" />
                <label for="LangChooseZHTW_2">關閉</label>
            </div>
           
             
          </div>
          <div class="col-md-2">
            <span class="label label-success">簡體</span>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseZHCN'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseZHCN" id="LangChooseZHCN_1" value="1" />
                <label for="LangChooseZHCN_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseZHCN'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseZHCN" id="LangChooseZHCN_2" value="0" />
                <label for="LangChooseZHCN_2">關閉</label>
            </div>
           
             
          </div>
          <div class="col-md-2">
            <span class="label label-success">英文</span>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseEN'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseEN" id="LangChooseEN_1" value="1" />
                <label for="LangChooseEN_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseEN'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseEN" id="LangChooseEN_2" value="0" />
                <label for="LangChooseEN_2">關閉</label>
            </div>
           
             
          </div>
          <div class="col-md-2">
            <span class="label label-success">日語</span>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseJP'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseJP" id="LangChooseJP_1" value="1" />
                <label for="LangChooseJP_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseJP'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseJP" id="LangChooseJP_2" value="0" />
                <label for="LangChooseJP_2">關閉</label>
            </div>
           
             
          </div>
          <div class="col-md-2">
            <span class="label label-success">韓語</span>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseKR'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseKR" id="LangChooseKR_1" value="1" />
                <label for="LangChooseKR_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseKR'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseKR" id="LangChooseKR_2" value="0" />
                <label for="LangChooseKR_2">關閉</label>
            </div>
           
             
          </div>
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-2">
            <span class="label label-success">西班牙語</span>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseSP'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseSP" id="LangChooseSP_1" value="1" />
                <label for="LangChooseSP_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['LangChooseSP'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="LangChooseSP" id="LangChooseSP_2" value="0" />
                <label for="LangChooseSP_2">關閉</label>
            </div>
           
             
          </div>
          <div class="col-md-2">
            
          </div>
          <div class="col-md-2">
            
          </div>
          <div class="col-md-2">
            
          </div>
          <div class="col-md-2">
            
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Facebook選擇圖示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前網頁上方Facebook圖示顯示與否。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['FBICONChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="FBICONChoose" id="FBICONChoose_1" value="1" />
                <label for="FBICONChoose_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['FBICONChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="FBICONChoose" id="FBICONChoose_2" value="0" />
                <label for="FBICONChoose_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Google+選擇圖示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前網頁上方Google+圖示顯示與否。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['GOOGLEICONChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="GOOGLEICONChoose" id="GOOGLEICONChoose_1" value="1" />
                <label for="GOOGLEICONChoose_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['GOOGLEICONChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="GOOGLEICONChoose" id="GOOGLEICONChoose_2" value="0" />
                <label for="GOOGLEICONChoose_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Plurk選擇圖示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前網頁上方Plurk圖示顯示與否。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['PLURKICONChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="PLURKICONChoose" id="PLURKICONChoose_1" value="1" />
                <label for="PLURKICONChoose_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['PLURKICONChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="PLURKICONChoose" id="PLURKICONChoose_2" value="0" />
                <label for="PLURKICONChoose_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站地圖選擇圖示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前網頁上方Sitemap圖示顯示與否。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SITEMAPICONChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="SITEMAPICONChoose" id="SITEMAPICONChoose_1" value="1" />
                <label for="SITEMAPICONChoose_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['SITEMAPICONChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="SITEMAPICONChoose" id="SITEMAPICONChoose_2" value="0" />
                <label for="SITEMAPICONChoose_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">RSS選擇圖示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前網頁上方RSS圖示顯示與否。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['RSSICONChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="RSSICONChoose" id="RSSICONChoose_1" value="1" />
                <label for="RSSICONChoose_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['RSSICONChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="RSSICONChoose" id="RSSICONChoose_2" value="0" />
                <label for="RSSICONChoose_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">客服選擇圖示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前網頁上方客服圖示顯示與否。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['MSNICONChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="MSNICONChoose" id="MSNICONChoose_1" value="1" />
                <label for="MSNICONChoose_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['MSNICONChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="MSNICONChoose" id="MSNICONChoose_2" value="0" />
                <label for="MSNICONChoose_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">郵件選擇圖示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前網頁上方郵件圖示顯示與否。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['MAILICONChoose'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="MAILICONChoose" id="MAILICONChoose_1" value="1" />
                <label for="MAILICONChoose_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['MAILICONChoose'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="MAILICONChoose" id="MAILICONChoose_2" value="0" />
                <label for="MAILICONChoose_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 頁數限制</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">自訂頁面<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="自訂頁面限制頁面。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-4">
            <div class="input-group"> 
            
              <select name="dfpage_limit_page_num" id="dfpage_limit_page_num" class="form-control">
              <option value="5" <?php if (!(strcmp(5, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>5</option>
              <option value="6" <?php if (!(strcmp(6, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>6</option>
              <option value="7" <?php if (!(strcmp(7, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>7</option>
              <option value="8" <?php if (!(strcmp(8, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>8</option>
<option value="9" <?php if (!(strcmp(9, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>9</option>
              <option value="10" <?php if (!(strcmp(10, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>10</option>
              <option value="12" <?php if (!(strcmp(12, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>12</option>
              <option value="15" <?php if (!(strcmp(15, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>15</option>
              <option value="999" <?php if (!(strcmp(999, $row_RecordSystemConfig['dfpage_limit_page_num']))) {echo "selected=\"selected\"";} ?>>999</option>
</select><span class="input-group-append"><span class="input-group-text">頁</span></span>
        </div>
            
           
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 版面擴充</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">自訂欄位(+)<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="網站支援三欄設計。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['tmp_column_plus'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmp_column_plus" id="tmp_column_plus_1" value="1" />
                <label for="tmp_column_plus_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['tmp_column_plus'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmp_column_plus" id="tmp_column_plus_2" value="0" />
                <label for="tmp_column_plus_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 網頁功能啟用</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_043.png" width="20" height="20" /> 自訂頁面<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionDfPageSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionDfPageSelect" id="OptionDfPageSelect_1" value="1" />
                <label for="OptionDfPageSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionDfPageSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionDfPageSelect" id="OptionDfPageSelect_2" value="0" />
                <label for="OptionDfPageSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_045.png" width="20" height="20" /> 版型修改<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionTmpSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionTmpSelect" id="OptionTmpSelect_1" value="1" />
                <label for="OptionTmpSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionTmpSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionTmpSelect" id="OptionTmpSelect_2" value="0" />
                <label for="OptionTmpSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_061.png" width="20" height="20" /> 首頁版型<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionTmpHomeSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionTmpHomeSelect" id="OptionTmpHomeSelect_1" value="1" />
                <label for="OptionTmpHomeSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionTmpHomeSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionTmpHomeSelect" id="OptionTmpHomeSelect_2" value="0" />
                <label for="OptionTmpHomeSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_041.png" width="20" height="20" /> 關於我們<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAboutSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAboutSelect" id="OptionAboutSelect_1" value="1" />
                <label for="OptionAboutSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAboutSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAboutSelect" id="OptionAboutSelect_2" value="0" />
                <label for="OptionAboutSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_057.png" width="20" height="20" /> 歷史沿革<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionTimelineSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionTimelineSelect" id="OptionTimelineSelect_1" value="1" />
                <label for="OptionTimelineSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionTimelineSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionTimelineSelect" id="OptionTimelineSelect_2" value="0" />
                <label for="OptionTimelineSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_058.png" width="20" height="20" /> 圖片展示<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionImageshowSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionImageshowSelect" id="OptionImageshowSelect_1" value="1" />
                <label for="OptionImageshowSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionImageshowSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionImageshowSelect" id="OptionImageshowSelect_2" value="0" />
                <label for="OptionImageshowSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_001.png" width="20" height="20" /> 最新訊息<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionNewsSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionNewsSelect" id="OptionNewsSelect_1" value="1" />
                <label for="OptionNewsSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionNewsSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionNewsSelect" id="OptionNewsSelect_2" value="0" />
                <label for="OptionNewsSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_020.png" width="20" height="20" /> 新聞快報<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionLettersSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionLettersSelect" id="OptionLettersSelect_1" value="1" />
                <label for="OptionLettersSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionLettersSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionLettersSelect" id="OptionLettersSelect_2" value="0" />
                <label for="OptionLettersSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_021.png" width="20" height="20" /> 活動快訊<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionActnewsSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionActnewsSelect" id="OptionActnewsSelect_1" value="1" />
                <label for="OptionActnewsSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionActnewsSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionActnewsSelect" id="OptionActnewsSelect_2" value="0" />
                <label for="OptionActnewsSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_024.png" width="20" height="20" /> 常見問答<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionFaqSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionFaqSelect" id="OptionFaqSelect_1" value="1" />
                <label for="OptionFaqSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionFaqSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionFaqSelect" id="OptionFaqSelect_2" value="0" />
                <label for="OptionFaqSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_002.png" width="20" height="20" /> 產品功能<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionProductSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionProductSelect" id="OptionProductSelect_1" value="1" />
                <label for="OptionProductSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionProductSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionProductSelect" id="OptionProductSelect_2" value="0" />
                <label for="OptionProductSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_009.png" width="20" height="20" /> 會議紀錄<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMeetingSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMeetingSelect" id="OptionMeetingSelect_1" value="1" />
                <label for="OptionMeetingSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMeetingSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMeetingSelect" id="OptionMeetingSelect_2" value="0" />
                <label for="OptionMeetingSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_011.png" width="20" height="20" /> 贊助企業<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionSponsorSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionSponsorSelect" id="OptionSponsorSelect_1" value="1" />
                <label for="OptionSponsorSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionSponsorSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionSponsorSelect" id="OptionSponsorSelect_2" value="0" />
                <label for="OptionSponsorSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_006.png" width="20" height="20" /> 友站連結<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionFrilinkSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionFrilinkSelect" id="OptionFrilinkSelect_1" value="1" />
                <label for="OptionFrilinkSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionFrilinkSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionFrilinkSelect" id="OptionFrilinkSelect_2" value="0" />
                <label for="OptionFrilinkSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_051.png" width="20" height="20" /> 相關連結<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionOtrlinkSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionOtrlinkSelect" id="OptionOtrlinkSelect_1" value="1" />
                <label for="OptionOtrlinkSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionOtrlinkSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionOtrlinkSelect" id="OptionOtrlinkSelect_2" value="0" />
                <label for="OptionOtrlinkSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_016.png" width="20" height="20" /> 求職徵才<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCareersSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCareersSelect" id="OptionCareersSelect_1" value="1" />
                <label for="OptionCareersSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCareersSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCareersSelect" id="OptionCareersSelect_2" value="0" />
                <label for="OptionCareersSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_003.png" width="20" height="20" /> 公佈資訊<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionPublishSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionPublishSelect" id="OptionPublishSelect_1" value="1" />
                <label for="OptionPublishSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionPublishSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionPublishSelect" id="OptionPublishSelect_2" value="0" />
                <label for="OptionPublishSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_007.png" width="20" height="20" /> 留言管理<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionGuestbookSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionGuestbookSelect" id="OptionGuestbookSelect_1" value="1" />
                <label for="OptionGuestbookSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionGuestbookSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionGuestbookSelect" id="OptionGuestbookSelect_2" value="0" />
                <label for="OptionGuestbookSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_013.png" width="20" height="20" /> 會員資料<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMemberSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMemberSelect" id="OptionMemberSelect_1" value="1" />
                <label for="OptionMemberSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMemberSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMemberSelect" id="OptionMemberSelect_2" value="0" />
                <label for="OptionMemberSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_077.png" width="20" height="20" /> 經銷專區<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionDealerSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionDealerSelect" id="OptionDealerSelect_1" value="1" />
                <label for="OptionDealerSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionDealerSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionDealerSelect" id="OptionDealerSelect_2" value="0" />
                <label for="OptionDealerSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_014.png" width="20" height="20" /> 活動花絮<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionActivitiesSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionActivitiesSelect" id="OptionActivitiesSelect_1" value="1" />
                <label for="OptionActivitiesSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionActivitiesSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionActivitiesSelect" id="OptionActivitiesSelect_2" value="0" />
                <label for="OptionActivitiesSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_032.png" width="20" height="20" /> 工程實績<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionProjectSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionProjectSelect" id="OptionProjectSelect_1" value="1" />
                <label for="OptionProjectSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionProjectSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionProjectSelect" id="OptionProjectSelect_2" value="0" />
                <label for="OptionProjectSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_037.png" width="20" height="20" /> 廣告輪播<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAdsSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAdsSelect" id="OptionAdsSelect_1" value="1" />
                <label for="OptionAdsSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAdsSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAdsSelect" id="OptionAdsSelect_2" value="0" />
                <label for="OptionAdsSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_015.png" width="20" height="20" /> 捐款名錄<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionDonationSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionDonationSelect" id="OptionDonationSelect_1" value="1" />
                <label for="OptionDonationSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionDonationSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionDonationSelect" id="OptionDonationSelect_2" value="0" />
                <label for="OptionDonationSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_008.png" width="20" height="20" /> 文章管理<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionArticleSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionArticleSelect" id="OptionArticleSelect_1" value="1" />
                <label for="OptionArticleSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionArticleSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionArticleSelect" id="OptionArticleSelect_2" value="0" />
                <label for="OptionArticleSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_033.png" width="20" height="20" /> 產品型錄<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCatalogSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCatalogSelect" id="OptionCatalogSelect_1" value="1" />
                <label for="OptionCatalogSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCatalogSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCatalogSelect" id="OptionCatalogSelect_2" value="0" />
                <label for="OptionCatalogSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_031.png" width="20" height="20" /> 知識學習<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionKnowledgeSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionKnowledgeSelect" id="OptionKnowledgeSelect_1" value="1" />
                <label for="OptionKnowledgeSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionKnowledgeSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionKnowledgeSelect" id="OptionKnowledgeSelect_2" value="0" />
                <label for="OptionKnowledgeSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_036.png" width="20" height="20" /> 購物車<span class="text-red">*</span></label>                       	
          <div class="col-md-3">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCartSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCartSelect" id="OptionCartSelect_1" value="1" />
                <label for="OptionCartSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCartSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCartSelect" id="OptionCartSelect_2" value="0" />
                <label for="OptionCartSelect_2">關閉</label>
            </div>

          </div>
          <div class="col-md-3">
            <span class="label label-success">金流</span>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCartPaymentSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCartPaymentSelect" id="OptionCartPaymentSelect_1" value="1" />
                <label for="OptionCartPaymentSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCartPaymentSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCartPaymentSelect" id="OptionCartPaymentSelect_2" value="0" />
                <label for="OptionCartPaymentSelect_2">關閉</label>
            </div>
           
             
          </div>
          <div class="col-md-3">
            <span class="label label-success">物流</span>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCartPayLogisticSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCartPayLogisticSelect" id="OptionCartPayLogisticSelect_1" value="1" />
                <label for="OptionCartPayLogisticSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionCartPayLogisticSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionCartPayLogisticSelect" id="OptionCartPayLogisticSelect_2" value="0" />
                <label for="OptionCartPayLogisticSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_018.png" width="20" height="20" /> 訂票系統<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionTicketsSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionTicketsSelect" id="OptionTicketsSelect_1" value="1" />
                <label for="OptionTicketsSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionTicketsSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionTicketsSelect" id="OptionTicketsSelect_2" value="0" />
                <label for="OptionTicketsSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_017.png" width="20" height="20" /> 成員幹部<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionOrgSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionOrgSelect" id="OptionOrgSelect_1" value="1" />
                <label for="OptionOrgSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionOrgSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionOrgSelect" id="OptionOrgSelect_2" value="0" />
                <label for="OptionOrgSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_004.png" width="20" height="20" /> 檔案管理<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionFileMangSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionFileMangSelect" id="OptionFileMangSelect_1" value="1" />
                <label for="OptionFileMangSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionFileMangSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionFileMangSelect" id="OptionFileMangSelect_2" value="0" />
                <label for="OptionFileMangSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_038.png" width="20" height="20" /> 統計資料<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAnalysisSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAnalysisSelect" id="OptionAnalysisSelect_1" value="1" />
                <label for="OptionAnalysisSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAnalysisSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAnalysisSelect" id="OptionAnalysisSelect_2" value="0" />
                <label for="OptionAnalysisSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_012.png" width="20" height="20" /> 相簿管理<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAlbumSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAlbumSelect" id="OptionAlbumSelect_1" value="1" />
                <label for="OptionAlbumSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAlbumSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAlbumSelect" id="OptionAlbumSelect_2" value="0" />
                <label for="OptionAlbumSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_010.png" width="20" height="20" /> 影片管理<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionVideoSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionVideoSelect" id="OptionVideoSelect_1" value="1" />
                <label for="OptionVideoSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionVideoSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionVideoSelect" id="OptionVideoSelect_2" value="0" />
                <label for="OptionVideoSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_005.png" width="20" height="20" /> 郵件發送<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMailSendSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMailSendSelect" id="OptionMailSendSelect_1" value="1" />
                <label for="OptionMailSendSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMailSendSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMailSendSelect" id="OptionMailSendSelect_2" value="0" />
                <label for="OptionMailSendSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_022.png" width="20" height="20" /> 電子期刊<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionEPaperSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionEPaperSelect" id="OptionEPaperSelect_1" value="1" />
                <label for="OptionEPaperSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionEPaperSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionEPaperSelect" id="OptionEPaperSelect_2" value="0" />
                <label for="OptionEPaperSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_025.png" width="20" height="20" /> 廣告發布<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionADWallSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionADWallSelect" id="OptionADWallSelect_1" value="1" />
                <label for="OptionADWallSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionADWallSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionADWallSelect" id="OptionADWallSelect_2" value="0" />
                <label for="OptionADWallSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_026.png" width="20" height="20" /> 合作夥伴<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionPartnerSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionPartnerSelect" id="OptionPartnerSelect_1" value="1" />
                <label for="OptionPartnerSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionPartnerSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionPartnerSelect" id="OptionPartnerSelect_2" value="0" />
                <label for="OptionPartnerSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_027.png" width="20" height="20" /> 藝文專欄<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionArtlistSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionArtlistSelect" id="OptionArtlistSelect_1" value="1" />
                <label for="OptionArtlistSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionArtlistSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionArtlistSelect" id="OptionArtlistSelect_2" value="0" />
                <label for="OptionArtlistSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_028.png" width="20" height="20" /> 主題日誌<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionDailySelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionDailySelect" id="OptionDailySelect_1" value="1" />
                <label for="OptionDailySelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionDailySelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionDailySelect" id="OptionDailySelect_2" value="0" />
                <label for="OptionDailySelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_029.png" width="20" height="20" /> 討論專區<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionForumSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionForumSelect" id="OptionForumSelect_1" value="1" />
                <label for="OptionForumSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionForumSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionForumSelect" id="OptionForumSelect_2" value="0" />
                <label for="OptionForumSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_034.png" width="20" height="20" /> 年度行事<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMenuMaintainSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMenuMaintainSelect" id="OptionMenuMaintainSelect_1" value="1" />
                <label for="OptionMenuMaintainSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMenuMaintainSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMenuMaintainSelect" id="OptionMenuMaintainSelect_2" value="0" />
                <label for="OptionMenuMaintainSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_034.png" width="20" height="20" /> 網站資訊<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionWebSiteSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionWebSiteSelect" id="OptionWebSiteSelect_1" value="1" />
                <label for="OptionWebSiteSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionWebSiteSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionWebSiteSelect" id="OptionWebSiteSelect_2" value="0" />
                <label for="OptionWebSiteSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_040.png" width="20" height="20" /> 聯絡我們<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionContactSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionContactSelect" id="OptionContactSelect_1" value="1" />
                <label for="OptionContactSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionContactSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionContactSelect" id="OptionContactSelect_2" value="0" />
                <label for="OptionContactSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_059.png" width="20" height="20" /> 經營據點<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionStrongholdSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionStrongholdSelect" id="OptionStrongholdSelect_1" value="1" />
                <label for="OptionStrongholdSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionStrongholdSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionStrongholdSelect" id="OptionStrongholdSelect_2" value="0" />
                <label for="OptionStrongholdSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_047.png" width="20" height="20" /> 部落格<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionBlogSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionBlogSelect" id="OptionBlogSelect_1" value="1" />
                <label for="OptionBlogSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionBlogSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionBlogSelect" id="OptionBlogSelect_2" value="0" />
                <label for="OptionBlogSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_052.png" width="20" height="20" /> 雲端相簿<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionPicasaSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionPicasaSelect" id="OptionPicasaSelect_1" value="1" />
                <label for="OptionPicasaSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionPicasaSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionPicasaSelect" id="OptionPicasaSelect_2" value="0" />
                <label for="OptionPicasaSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_067.png" width="20" height="20" /> 房型展示<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionRoomSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionRoomSelect" id="OptionRoomSelect_1" value="1" />
                <label for="OptionRoomSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionRoomSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionRoomSelect" id="OptionRoomSelect_2" value="0" />
                <label for="OptionRoomSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_068.png" width="20" height="20" /> 鄰近景點<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAttractionsSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAttractionsSelect" id="OptionAttractionsSelect_1" value="1" />
                <label for="OptionAttractionsSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionAttractionsSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionAttractionsSelect" id="OptionAttractionsSelect_2" value="0" />
                <label for="OptionAttractionsSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_111.png" width="20" height="20" /> 社群聊天<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionSocialChatSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionSocialChatSelect" id="OptionSocialChatSelect_1" value="1" />
                <label for="OptionSocialChatSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionSocialChatSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionSocialChatSelect" id="OptionSocialChatSelect_2" value="0" />
                <label for="OptionSocialChatSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_105.png" width="20" height="20" /> 預約系統<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionBookingSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionBookingSelect" id="OptionBookingSelect_1" value="1" />
                <label for="OptionBookingSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionBookingSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionBookingSelect" id="OptionBookingSelect_2" value="0" />
                <label for="OptionBookingSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_071.png" width="20" height="20" /> 行動裝置<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMobileSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMobileSelect" id="OptionMobileSelect_1" value="1" />
                <label for="OptionMobileSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionMobileSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionMobileSelect" id="OptionMobileSelect_2" value="0" />
                <label for="OptionMobileSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 地磅功能啟用</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_101.png" width="20" height="20" /> 貨源物料<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionScaleSourceSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionScaleSourceSelect" id="OptionScaleSourceSelect_1" value="1" />
                <label for="OptionScaleSourceSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionScaleSourceSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionScaleSourceSelect" id="OptionScaleSourceSelect_2" value="0" />
                <label for="OptionScaleSourceSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_109.png" width="20" height="20" /> 清運明細<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionScaleClearanceSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionScaleClearanceSelect" id="OptionScaleClearanceSelect_1" value="1" />
                <label for="OptionScaleClearanceSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionScaleClearanceSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionScaleClearanceSelect" id="OptionScaleClearanceSelect_2" value="0" />
                <label for="OptionScaleClearanceSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/mt_107.png" width="20" height="20" /> 物料拆分<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionSplitOrderSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionSplitOrderSelect" id="OptionSplitOrderSelect_1" value="1" />
                <label for="OptionSplitOrderSelect_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['OptionSplitOrderSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="OptionSplitOrderSelect" id="OptionSplitOrderSelect_2" value="0" />
                <label for="OptionSplitOrderSelect_2">關閉</label>
            </div>
           
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSystemConfig['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordNews['lang']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordSystemConfig);
?>
