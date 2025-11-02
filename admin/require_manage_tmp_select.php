<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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

/* 取得類別資料 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpListType = "SELECT * FROM demo_tmpitem WHERE list_id = 1";
$RecordTmpListType = mysqli_query($DB_Conn, $query_RecordTmpListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
$totalRows_RecordTmpListType = mysqli_num_rows($RecordTmpListType);

$coluserid_RecordTmpSelect = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpSelect = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpSelect = sprintf("SELECT MSTmpSelect FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpSelect, "int"));
$RecordTmpSelect = mysqli_query($DB_Conn, $query_RecordTmpSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpSelect = mysqli_fetch_assoc($RecordTmpSelect);
$totalRows_RecordTmpSelect = mysqli_num_rows($RecordTmpSelect);

$coluserid_RecordTmpSelectRwd = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpSelectRwd = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpSelectRwd = sprintf("SELECT MSTmpSelectRwd FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpSelect, "int"));
$RecordTmpSelectRwd = mysqli_query($DB_Conn, $query_RecordTmpSelectRwd) or die(mysqli_error($DB_Conn));
$row_RecordTmpSelectRwd = mysqli_fetch_assoc($RecordTmpSelectRwd);
$totalRows_RecordTmpSelectRwd = mysqli_num_rows($RecordTmpSelectRwd);

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

/* 取得發佈者資料 */
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 樣板套用 <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 目前使用版型</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="alert alert-warning m-b-0"><i class="fa fa-info-circle"></i> <b>模式可選擇雙版型模式及單版型模式，雙版型模式可在桌面裝置及行動裝置有各自外觀；單版型模式則在桌面裝置及行動裝置僅會使用相同外觀。<a href="manage_mobile.php?wshop=<?php echo $wshop;?>&amp;Opt=tmp_mobile_config&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 選擇模式</a></b></div>
    <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>一般傳統版型(對電腦瀏覽器相容性高/行動裝置不易閱讀/適於電腦操作)，RWD版型(僅支援IE9+以上瀏覽器/適用行動裝置/適於觸控操作)。請自行對您的客戶群做判斷調整。</b></div>
    <?php if($row_RecordSystemConfig['Mobile_Enable'] == "1") {  ?>
    <div class="row">
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-danger">雙版型</span> <span class="label label-warning">電腦 / 筆電</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
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
            
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>

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
            
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_rwd&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>

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
    <?php } else if($row_RecordSystemConfig['Mobile_Enable'] == "0" || $row_RecordSystemConfig['Mobile_Enable'] == "0") { ?>
    <div class="row">
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-success">行動裝置</span> <span class="label label-danger">單版型</span> <span class="label label-warning">電腦 / 筆電 / 平板 / 手機</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
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
            
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_a&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>

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
            <?php if($row_RecordTmpShowSlectRwd['title'] != "" && $row_RecordTmpShowSlectRwd['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlectRwd['id']; ?></span>
              <?php if ($row_RecordTmpShowSlectRwd['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlect['userid'] == '1') { ?>
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
            
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_x&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>

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

<script>
$(document).ready(function() {
	$(".imgLiquidFill").imgLiquid();
});
</script>
<?php
mysqli_free_result($RecordTmpListType);

mysqli_free_result($RecordTmpSelect);

mysqli_free_result($RecordTmpShowSlect);

mysqli_free_result($RecordTmpShowSlectRwd);

mysqli_free_result($RecordTmpSelectRwd);
?>
