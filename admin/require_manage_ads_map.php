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
 
$coluserid_RecordTmpShowSlect = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpShowSlect = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlect = sprintf("SELECT * FROM demo_tmp WHERE id = (SELECT MSTmpSelect FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpShowSlect, "int"));
$RecordTmpShowSlect = mysqli_query($DB_Conn, $query_RecordTmpShowSlect) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlect = mysqli_fetch_assoc($RecordTmpShowSlect);
$totalRows_RecordTmpShowSlect = mysqli_num_rows($RecordTmpShowSlect);

$coluserid_RecordTmpShowSlectRwd = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpShowSlectRwd = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlectRwd = sprintf("SELECT * FROM demo_tmp WHERE id = (SELECT MSTmpSelectRwd FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpShowSlectRwd, "int"));
$RecordTmpShowSlectRwd = mysqli_query($DB_Conn, $query_RecordTmpShowSlectRwd) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlectRwd = mysqli_fetch_assoc($RecordTmpShowSlectRwd);
$totalRows_RecordTmpShowSlectRwd = mysqli_num_rows($RecordTmpShowSlectRwd);


//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfig = "SELECT id, userid, lang, Mobile_Enable FROM demo_setting_fr WHERE userid = $w_userid";
$RecordSystemConfig = mysqli_query($DB_Conn, $query_RecordSystemConfig) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfig = mysqli_fetch_assoc($RecordSystemConfig);
$totalRows_RecordSystemConfig = mysqli_num_rows($RecordSystemConfig);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 橫幅 <small>導覽</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse" id="Step_View1"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-database"></i> 目前使用中版型</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
  
  <?php if($row_RecordSystemConfig['Mobile_Enable'] == "1") {  ?>
    <div class="row">
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-danger">雙版型</span> <span class="label label-warning">電腦 / 筆電</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
          <?php if ($row_RecordTmpShowSlect['userid'] == '1') { // 目前使用為官方版型?>
          <div class="alert alert-danger fade show">
          	<i class="fa fa-info-circle"></i> 官方版型不須設定橫幅，若需自訂橫幅請自行創建版型或替換有 <span class="label label-warning">個人</span> 圖示之版型
          </div>
          <?php } else { // 目前使用為個人版型?>
			    <?php if($row_RecordTmpShowSlect['tmpbanner'] == "0") {?>
                  <div class="alert alert-danger fade show">
                    <i class="fa fa-info-circle"></i> 目前未設定橫幅
                  </div>
				<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "1") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用公版橫幅】
                  </div>
				<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "2") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用樣版橫幅】
                  </div>
				<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "3") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用單圖橫幅】
                  </div>
                <?php } ?>
		  <?php } ?>
            <?php if($row_RecordTmpShowSlect['title'] != "" && $row_RecordTmpShowSlect['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlect['id']; ?></span>
              <?php if ($row_RecordTmpShowSlect['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlect['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpShowSlect['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlect['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpShowSlect['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlect['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpShowSlect['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpShowSlect['name'] == "board009" || $row_RecordTmpShowSlect['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } else { ?>
              <span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span>
              <?php } ?> 
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlect['type'];?></span> <?php echo $row_RecordTmpShowSlect['title']; ?></div>
            
            <?php /* 動作 */ ?>
            <?php if ($row_RecordTmpShowSlect['userid'] == '1') { // 目前使用為官方版型?>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top" id="Step_Change">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=getpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="由官方版型複製來建立自己的個人版型。" data-toggle="tooltip" data-placement="top" id="Step_Create" class="btn btn-primary m-t-10">創建樣版 <i class="fa fa-chevron-circle-right"></i></a> 
          <?php } else { // 目前使用為個人版型?>
          <?php if($row_RecordTmpShowSlect['tmpbanner'] == "0") {?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlect['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a> 
			<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "1") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlect['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a> 
            <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="上傳您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10">更改橫幅圖片(公版橫幅) <i class="fa fa-chevron-circle-right"></i></a> 
			<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "2") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlect['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
            <a href="tmp_manage_banner.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordTmpShowSlect['id']; ?>&amp;tmpname=<?php echo $row_RecordTmpShowSlect['id']; ?>&amp;board=<?php echo $row_RecordTmpShowSlect['name']; ?>" data-original-title="上傳您的橫幅圖片" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">更改橫幅圖片(樣板橫幅) <i class="fa fa-chevron-circle-right"></i></a>  
            <?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "3") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlect['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
				<?php if ($row_RecordTmpShowSlect['tmpbannerselect'] == '1') { ?>
              <a href="bannershow_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;tmpname=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
                <?php } else { ?>
              <a href="uplod_tmpbannerpic.php?id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="上傳您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">更改橫幅圖片(單圖) <i class="fa fa-chevron-circle-right"></i></a>
                <?php } ?>
            <?php }  ?>
          <?php } ?>
            <?php /* 動作 */ ?>
            

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pc.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php } ?>
          </div>
        </div>
      </div>
      
      
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">行動裝置</span> <span class="label label-danger">雙版型</span> <span class="label label-warning">平板 / 手機</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
          <?php if ($row_RecordTmpShowSlectRwd['userid'] == '1') { // 目前使用為官方版型?>
          <div class="alert alert-danger fade show">
          	<i class="fa fa-info-circle"></i> 官方版型不須設定橫幅，若需自訂橫幅請自行創建版型或替換有 <span class="label label-warning">個人</span> 圖示之版型
          </div>
          <?php } else { // 目前使用為個人版型?>
			    <?php if($row_RecordTmpShowSlectRwd['tmpbanner'] == "0") {?>
                  <div class="alert alert-danger fade show">
                    <i class="fa fa-info-circle"></i> 目前未設定橫幅
                  </div>
				<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "1") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用公版橫幅】
                  </div>
				<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "2") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用樣版橫幅】
                  </div>
				<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "3") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用單圖橫幅】
                  </div>
                <?php } ?>
		  <?php } ?>
            <?php if($row_RecordTmpShowSlectRwd['title'] != "" && $row_RecordTmpShowSlectRwd['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlectRwd['id']; ?></span>
              <?php if ($row_RecordTmpShowSlectRwd['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlectRwd['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpShowSlectRwd['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlectRwd['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpShowSlectRwd['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlectRwd['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpShowSlectRwd['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpShowSlectRwd['name'] == "board009" || $row_RecordTmpShowSlectRwd['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } else { ?>
              <span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span>
              <?php } ?>
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlectRwd['type'];?></span> <?php echo $row_RecordTmpShowSlectRwd['title']; ?></div>
            
            <?php /* 動作 */ ?>
            <?php if ($row_RecordTmpShowSlectRwd['userid'] == '1') { // 目前使用為官方版型?>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top" id="Step_Change">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=getpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="由官方版型複製來建立自己的個人版型。" data-toggle="tooltip" data-placement="top" id="Step_Create" class="btn btn-primary m-t-10">創建樣版 <i class="fa fa-chevron-circle-right"></i></a> 
          <?php } else { // 目前使用為個人版型?>
          <?php if($row_RecordTmpShowSlectRwd['tmpbanner'] == "0") {?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a> 
			<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "1") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a> 
            <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="上傳您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10">更改橫幅圖片(公版橫幅) <i class="fa fa-chevron-circle-right"></i></a> 
			<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "2") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
            <a href="tmp_manage_banner.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordTmpShowSlectRwd['id']; ?>&amp;tmpname=<?php echo $row_RecordTmpShowSlectRwd['id']; ?>&amp;board=<?php echo $row_RecordTmpShowSlectRwd['name']; ?>" data-original-title="上傳您的橫幅圖片" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">更改橫幅圖片(樣板橫幅) <i class="fa fa-chevron-circle-right"></i></a>  
            <?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "3") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
				<?php if ($row_RecordTmpShowSlectRwd['tmpbannerselect'] == '1') { ?>
              <a href="bannershow_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;tmpname=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
                <?php } else { ?>
              <a href="uplod_tmpbannerpic.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="上傳您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">更改橫幅圖片(單圖) <i class="fa fa-chevron-circle-right"></i></a>
                <?php } ?>
            <?php }  ?>
          <?php } ?>
            <?php /* 動作 */ ?>

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_mobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_rwd&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php } else if($row_RecordSystemConfig['Mobile_Enable'] == "0") { ?>
    <div class="row">
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-success">行動裝置</span> <span class="label label-danger">單版型</span> <span class="label label-warning">電腦 / 筆電 / 平板 / 手機</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
            <?php if ($row_RecordTmpShowSlect['userid'] == '1') { // 目前使用為官方版型?>
          <div class="alert alert-danger fade show">
          	<i class="fa fa-info-circle"></i> 官方版型不須設定橫幅，若需自訂橫幅請自行創建版型或替換有 <span class="label label-warning">個人</span> 圖示之版型
          </div>
          <?php } else { // 目前使用為個人版型?>
			    <?php if($row_RecordTmpShowSlect['tmpbanner'] == "0") {?>
                  <div class="alert alert-danger fade show">
                    <i class="fa fa-info-circle"></i> 目前未設定橫幅
                  </div>
				<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "1") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用公版橫幅】
                  </div>
				<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "2") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用樣版橫幅】
                  </div>
				<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "3") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用單圖橫幅】
                  </div>
                <?php } ?>
		  <?php } ?>
            <?php if($row_RecordTmpShowSlect['title'] != "" && $row_RecordTmpShowSlect['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlect['id']; ?></span>
              <?php if ($row_RecordTmpShowSlect['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlect['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpShowSlect['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlect['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpShowSlect['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlect['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpShowSlect['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpShowSlect['name'] == "board009" || $row_RecordTmpShowSlect['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } else { ?>
              <span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span>
              <?php } ?> 
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlect['type'];?></span> <?php echo $row_RecordTmpShowSlect['title']; ?></div>
            
            <?php /* 動作 */ ?>
            <?php if ($row_RecordTmpShowSlect['userid'] == '1') { // 目前使用為官方版型?>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top" id="Step_Change">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=getpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="由官方版型複製來建立自己的個人版型。" data-toggle="tooltip" data-placement="top" id="Step_Create" class="btn btn-primary m-t-10">創建樣版 <i class="fa fa-chevron-circle-right"></i></a> 
          <?php } else { // 目前使用為個人版型?>
          <?php if($row_RecordTmpShowSlect['tmpbanner'] == "0") {?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlect['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a> 
			<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "1") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlect['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a> 
            <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="上傳您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10">更改橫幅圖片(公版橫幅) <i class="fa fa-chevron-circle-right"></i></a> 
			<?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "2") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlect['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
            <a href="tmp_manage_banner.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordTmpShowSlect['id']; ?>&amp;tmpname=<?php echo $row_RecordTmpShowSlect['id']; ?>&amp;board=<?php echo $row_RecordTmpShowSlect['name']; ?>" data-original-title="上傳您的橫幅圖片" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">更改橫幅圖片(樣板橫幅) <i class="fa fa-chevron-circle-right"></i></a>  
            <?php } else if ($row_RecordTmpShowSlect['tmpbanner'] == "3") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlect['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
				<?php if ($row_RecordTmpShowSlect['tmpbannerselect'] == '1') { ?>
              <a href="bannershow_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;tmpname=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
                <?php } else { ?>
              <a href="uplod_tmpbannerpic.php?id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="上傳您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">更改橫幅圖片(單圖) <i class="fa fa-chevron-circle-right"></i></a>
                <?php } ?>
            <?php }  ?>
          <?php } ?>
            <?php /* 動作 */ ?>

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pcmobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_a&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
      </div>
      
    </div>
    <?php } else { ?>
    <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-success">行動裝置</span> <span class="label label-danger">單版型</span> <span class="label label-warning">電腦 / 筆電 / 平板 / 手機</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
		  <?php if ($row_RecordTmpShowSlectRwd['userid'] == '1') { // 目前使用為官方版型?>
          <div class="alert alert-danger fade show">
          	<i class="fa fa-info-circle"></i> 官方版型不須設定橫幅，若需自訂橫幅請自行創建版型或替換有 <span class="label label-warning">個人</span> 圖示之版型
          </div>
          <?php } else { // 目前使用為個人版型?>
			    <?php if($row_RecordTmpShowSlectRwd['tmpbanner'] == "0") {?>
                  <div class="alert alert-danger fade show">
                    <i class="fa fa-info-circle"></i> 目前未設定橫幅
                  </div>
				<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "1") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用公版橫幅】
                  </div>
				<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "2") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用樣版橫幅】
                  </div>
				<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "3") { ?>
                  <div class="alert alert-info fade show">
                    <i class="fa fa-check-circle"></i> 目前橫幅設定模式為【使用單圖橫幅】
                  </div>
                <?php } ?>
		  <?php } ?>
			  
          
            <?php if($row_RecordTmpShowSlectRwd['title'] != "" && $row_RecordTmpShowSlectRwd['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlectRwd['id']; ?></span>
              <?php if ($row_RecordTmpShowSlectRwd['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlectRwd['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpShowSlectRwd['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlectRwd['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpShowSlectRwd['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlectRwd['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpShowSlectRwd['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpShowSlectRwd['name'] == "board009" || $row_RecordTmpShowSlectRwd['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } else { ?>
              <span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span>
              <?php } ?>
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlectRwd['type'];?></span> <?php echo $row_RecordTmpShowSlectRwd['title']; ?></div>
            
            <?php /* 動作 */ ?>
            <?php if ($row_RecordTmpShowSlectRwd['userid'] == '1') { // 目前使用為官方版型?>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top" id="Step_Change">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=getpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="由官方版型複製來建立自己的個人版型。" data-toggle="tooltip" data-placement="top" id="Step_Create" class="btn btn-primary m-t-10">創建樣版 <i class="fa fa-chevron-circle-right"></i></a> 
          <?php } else { // 目前使用為個人版型?>
          <?php if($row_RecordTmpShowSlectRwd['tmpbanner'] == "0") {?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a> 
			<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "1") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a> 
            <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="上傳您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10">更改橫幅圖片(公版橫幅) <i class="fa fa-chevron-circle-right"></i></a> 
			<?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "2") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
            <a href="tmp_manage_banner.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordTmpShowSlectRwd['id']; ?>&amp;tmpname=<?php echo $row_RecordTmpShowSlectRwd['id']; ?>&amp;board=<?php echo $row_RecordTmpShowSlectRwd['name']; ?>" data-original-title="上傳您的橫幅圖片" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">更改橫幅圖片(樣板橫幅) <i class="fa fa-chevron-circle-right"></i></a>  
            <?php } else if ($row_RecordTmpShowSlectRwd['tmpbanner'] == "3") { ?>
            <a href="tmp_config_wrp_banner.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id'];?>" data-original-title="選擇橫幅的模式(設定後須重新整理此頁面)。" data-toggle="tooltip" data-placement="top" id="Step_Tip_None" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
				<?php if ($row_RecordTmpShowSlectRwd['tmpbannerselect'] == '1') { ?>
              <a href="bannershow_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;tmpname=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">模式選擇 <i class="fa fa-chevron-circle-right"></i></a>
                <?php } else { ?>
              <a href="uplod_tmpbannerpic.php?id_edit=<?php echo $row_RecordTmpShowSlectRwd['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="上傳您的橫幅圖片。" data-toggle="tooltip" data-placement="top" id="Step_Tip_Set" class="btn btn-primary m-t-10 colorbox_iframe_cd">更改橫幅圖片(單圖) <i class="fa fa-chevron-circle-right"></i></a>
                <?php } ?>
            <?php }  ?>
          <?php } ?>
            <?php /* 動作 */ ?>

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pcmobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_x&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
    </div>
    <?php }  ?>
    
    
    
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel --> 

<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip',
                intro: '依照以下的步驟操作，您可替換目前的網站橫幅。'
              },
			  {
                element: '#Step_View1',
                intro: '此區域為目前網站所使用版型的橫幅。'
              },
			  <?php if ($row_RecordTmpShowSlect['userid'] == '1') { // 目前使用為官方版型?>
              {
                element: '#Step_Tip_Select',
                intro: '由於您目前所套用的版型為官方版型，因此目前不可設置橫幅。您可以選擇更換非官方版型或重新建立自己的個人版型。<img src="images/tip/tip025.jpg" width="300" height="240" /><br /><br />版型分為個人版型和官方版型。<br />官方版型：僅能更換Logo、不可修改。<br />個人版型：可更換Logo、橫幅及設計外觀。'
              },
			  {
                element: '#Step_Change',
                intro: '若您有建立個人版型，您可在替換完後設置橫幅。'
              },
			  {
                element: '#Step_Create',
                intro: '若您尚未建立個人版型或想重新建立，請在建立完後設置成目前版型再行修改橫幅。'
              },
              <?php } else { // 目前使用為個人版型?>
			  {
                element: '#Step_Tip_Select',
                intro: '您目前套用的版型為個人版型。<img src="images/tip/tip025.jpg" width="300" height="240" /><br /><br />版型分為個人版型和官方版型。<br />官方版型：僅能更換Logo、不可修改。<br />個人版型：可更換Logo、橫幅及設計外觀。'
              },
			  <?php if($row_RecordTmpShowSlect['tmpbanner'] == "0") {?>
			  {
                element: '#Step_Tip_None',
                intro: '目前未設定橫幅,您可設置完後再行重整此頁面，建議更改為公版橫幅。'
              },
              <?php } else { ?>
			  {
                element: '#Step_Tip_None',
                intro: '更改橫幅模式，建議更改為公版橫幅。'
              },
              {
                element: '#Step_Tip_Set',
                intro: '設置您目前版型的橫幅。'
              },
              <?php } ?>
              <?php } ?>
              {
                element: '#Step_View',
                intro: '設置完後您可在前台觀看您更換的結果。',
                position: 'bottom'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>
<script>
$(document).ready(function() {
	$(".imgLiquidFill").imgLiquid();
});
</script>
<?php
mysqli_free_result($RecordTmpShowSlect);

mysqli_free_result($RecordTmpShowSlectRwd);

mysqli_free_result($RecordSystemConfig);
?>
