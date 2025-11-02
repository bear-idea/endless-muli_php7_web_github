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

/* 刪除活動花絮主題資料 */
if ((isset($_GET['act_del_id'])) && ($_GET['act_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype WHERE act_id=%s",
                       GetSQLValueString($_GET['act_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
/* 刪除活動花絮相片資料 */
if ((isset($_GET['act_del_id'])) && ($_GET['act_del_id'] != "")) {
  // 取得商品多圖資料
  $colname_RecordAdsPhotoGet = "-1";
  if (isset($_GET['act_del_id'])) {
	$colname_RecordAdsPhotoGet = $_GET['act_del_id'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordAdsPhotoGet = sprintf("SELECT * FROM demo_adtype_sub WHERE act_id = %s", GetSQLValueString($colname_RecordAdsPhotoGet, "int"));
  $RecordAdsPhotoGet = mysqli_query($DB_Conn, $query_RecordAdsPhotoGet) or die(mysqli_error($DB_Conn));
  $row_RecordAdsPhotoGet = mysqli_fetch_assoc($RecordAdsPhotoGet);
  $totalRows_RecordAdsPhotoGet = mysqli_num_rows($RecordAdsPhotoGet);
  do { 
	  @unlink($SiteImgFilePathAdmin . $wshop . '/image/banner/' . $row_RecordAdsPhotoGet['pic']);
	  @unlink($SiteImgFilePathAdmin . $wshop . '/image/banner/thumb/small_' . GetFileThumbExtend($row_RecordAdsPhotoGet['pic']));
  } while ($row_RecordAdsPhotoGet = mysqli_fetch_assoc($RecordAdsPhotoGet));
  
  $deleteSQL = sprintf("DELETE FROM demo_adtype_sub WHERE act_id=%s",
                       GetSQLValueString($_GET['act_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordAdtype = 15;
$pageNum_RecordAdtype = 0;
if (isset($_GET['pageNum_RecordAdtype'])) {
  $pageNum_RecordAdtype = $_GET['pageNum_RecordAdtype'];
}
$startRow_RecordAdtype = $pageNum_RecordAdtype * $maxRows_RecordAdtype;

$collang_RecordAdtype = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAdtype = $_GET['lang'];
}
$coluserid_RecordAdtype = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAdtype = $w_userid;
}
$colname_RecordAdtype = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordAdtype = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAdtype = sprintf("SELECT demo_adtype.act_id, demo_adtype.userid, demo_adtype.title, demo_adtype.type, demo_adtype.bwight, demo_adtype.bhight, demo_adtype.swight, demo_adtype.shight, demo_adtype.velocity, demo_adtype.numbers, demo_adtype.navigation, demo_adtype.thumbs, demo_adtype.label, demo_adtype.interval, demo_adtype.hideTools, demo_adtype.dots, demo_adtype.sdescription, demo_adtype.indicate, demo_adtype.author, demo_adtype.postdate, demo_adtype.style, demo_adtype.modstyle, demo_adtype.navigationstate, demo_adtype.tool, demo_adtype.theme, demo_adtype_sub.pic, demo_adtype.sortid, demo_adtype_sub.actphoto_id, demo_adtype.lang, count(demo_adtype_sub.act_id) AS photonum FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id GROUP BY demo_adtype.act_id HAVING (demo_adtype.lang = %s) && ((demo_adtype.title LIKE %s) || (demo_adtype.postdate LIKE %s) || (demo_adtype.author LIKE %s)) && demo_adtype.userid=%s && demo_adtype.type='contentbannerimage' ORDER BY demo_adtype.act_id DESC", GetSQLValueString($collang_RecordAdtype, "text"),GetSQLValueString("%" . $colname_RecordAdtype . "%", "text"),GetSQLValueString("%" . $colname_RecordAdtype . "%", "text"),GetSQLValueString("%" . $colname_RecordAdtype . "%", "text"),GetSQLValueString($coluserid_RecordAdtype, "int"));
$RecordAdtype = mysqli_query($DB_Conn, $query_RecordAdtype) or die(mysqli_error($DB_Conn));
$row_RecordAdtype = mysqli_fetch_assoc($RecordAdtype);
$totalRows_RecordAdtype = mysqli_num_rows($RecordAdtype);
?>
<!-- ================== BEGIN Datatables CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
<!--<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" />-->
<!-- ================== END Datatables CSS ================== -->

<!-- ================== BEGIN X-Editable CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/css/bootstrap4-editable.min.css" rel="stylesheet" />
<!-- ================== END X-Editable CSS ================== -->

<!-- ================== BEGIN Datatables JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/responsive.bootstrap4.min.js"></script>
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>-->
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>-->
<!--<script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>-->
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/adtype_datatable.js?<?php echo time(); ?>"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 區塊橫幅輪播 <small>總覽</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    
    <div class="alert alert-warning m-t-5"><i class="fa fa-info-circle"></i> <b>若圖片模糊，請根據您的版面配置來設定圖片的限制寬度，若不會設置請將直接將大圖寬度設為2000px，圖片會較為清晰。</b></div>
    
    <div class="alert alert-warning m-t-5"><i class="fa fa-info-circle"></i> <b>此區橫幅可設置多個並且可在 版型設計 > 首頁版型設定 之功能區塊作新增。</b></div>
    
    <?php if ($totalRows_RecordAdtype > 0) { // Show if recordset not empty ?>
    <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th width="125"><strong>主題</strong></th>
          <th><strong>標題 / 描述</strong></th>
          <th width="80">大圖寬度</th>
          
          <th width="80">縮圖寬度</th>
          
          <th width="60"><strong>張數</strong></th>
          <th width="1%"><strong>操作</strong></th>
        </tr>
        </thead>
        <tbody>  
        <?php do { ?>
          <tr>
            <td valign="middle" style="position:relative;">
            <?php if($row_RecordAdtype['modstyle'] == '0') { ?>
            <?php if ($row_RecordAdtype['label'] == "true") { ?><div style="position: absolute;"><img src="images/bmod_label.png" /></div><?php } ?>
            <?php if ($row_RecordAdtype['tool'] == "1") { ?><div style="position: absolute;"><img src="images/bmod_num.png" /></div><?php } ?>
            <?php if ($row_RecordAdtype['tool'] == "2") { ?><div style="position: absolute;"><img src="images/bmod_dot.png" /></div><?php } ?>
            <?php if ($row_RecordAdtype['tool'] == "3") { ?><div style="position: absolute;"><img src="images/bmod_dotswithpreview.png" /></div><?php } ?>
            <?php if ($row_RecordAdtype['theme'] == "") { ?><div style="position: absolute;"><img src="images/bmod_arrow1.png" /></div><?php } ?>
            <?php if ($row_RecordAdtype['theme'] == "clean") { ?><div style="position: absolute;"><img src="images/bmod_arrow2.png" /></div><?php } ?>
            <?php if ($row_RecordAdtype['theme'] == "minimalist") { ?><div style="position: absolute;"><img src="images/bmod_arrow3.png" /></div><?php } ?>
            <?php if ($row_RecordAdtype['theme'] == "round") { ?><div style="position: absolute;"><img src="images/bmod_arrow4.png" /></div><?php } ?>
            <?php if ($row_RecordAdtype['theme'] == "square") { ?><div style="position: absolute;"><img src="images/bmod_arrow5.png" /></div><?php } ?>
            <img src="images/bmod_bk_green.png" />
            <?php } else if($row_RecordAdtype['modstyle'] == '1') { ?>
            <?php if ($row_RecordAdtype['theme'] == "" && $row_RecordAdtype['tool'] == "0") { ?>
            <div style="position: absolute;"><img src="images/bmod_arrow6.png" /></div><?php } else if ($row_RecordAdtype['theme'] == "1" && $row_RecordAdtype['tool'] == "0"){ ?><div style="position: absolute;"><img src="images/bmod_arrow7.png" /></div><?php } else if ($row_RecordAdtype['theme'] == "2" && $row_RecordAdtype['tool'] == "0"){ ?><div style="position: absolute;"><img src="images/bmod_arrow8.png" /></div><?php } else if ($row_RecordAdtype['theme'] == "3" && $row_RecordAdtype['tool'] == "0"){ ?><div style="position: absolute;"><img src="images/bmod_arrow9.png" /></div><?php } else if ($row_RecordAdtype['theme'] == "4" && $row_RecordAdtype['tool'] == "0"){ ?><div style="position: absolute;"><img src="images/bmod_arrow10.png" /></div><?php } else { ?><div style="position: absolute;"><img src="images/bmod_arrow6.png" /></div>
			<?php } ?>
            <?php if ($row_RecordAdtype['tool'] == "0") { ?>
            <div style="position: absolute;"><img src="images/bmod_thumb_default.png" /></div><?php } else if ($row_RecordAdtype['tool'] == "1"){ ?><div style="position: absolute;"><img src="images/bmod_thumb_small.png" /></div><?php } else if ($row_RecordAdtype['tool'] == "2"){ ?><div style="position: absolute;"><img src="images/bmod_thumb_large.png" /></div><?php } else { ?><div style="position: absolute;"><img src="images/bmod_thumb_default.png" /></div><?php } ?>
            <img src="images/bmod_bk_red.png" />
            <?php } else { ?>
            <img src="images/bmod_bk_animation.png" />
            <?php } ?>
            </td>
            <td valign="middle">
              <span class="ed_title" id="title_<?php echo $row_RecordAdtype['act_id']; ?>" data-type='text' data-pk="<?php echo $row_RecordAdtype["act_id"]; ?>" data-placement='top'><?php echo $row_RecordAdtype['title']; ?></span>	
              
              <div class="descriptionword">
              <span class='label label-lime'>描述</span>
              <span class="ed_sdescription editable-click editable-empty" id="sdescription_<?php echo $row_RecordAdtype['act_id']; ?>" data-type='text' data-pk="<?php echo $row_RecordAdtype["act_id"]; ?>" data-placement='top'><?php if($row_RecordAdtype['sdescription'] != "") {echo nl2br($row_RecordAdtype['sdescription']);} else{ echo "Empty"; } ?></span> 
              </div>   
            </td>
            
            <td valign="middle"><span class="bwight" id="bwight_<?php echo $row_RecordAdtype['act_id']; ?>" data-pk="<?php echo $row_RecordAdtype["act_id"]; ?>"><?php echo $row_RecordAdtype['bwight']; ?></span></td>
            
            <td valign="middle"><span class="swight" id="swight_<?php echo $row_RecordAdtype['act_id']; ?>" data-pk="<?php echo $row_RecordAdtype["act_id"]; ?>"><?php echo $row_RecordAdtype['swight']; ?></span></td>
            
            <td align="center" valign="middle">
            <span class="label label-secondary "><?php echo $row_RecordAdtype['photonum']; ?></span>
            </td>
            <td align="left" valign="middle"class="MenuViewPage">
            <div class='btn-group'>
            <a href="inner_ads.php?wshop=<?php echo $wshop; ?>&amp;Opt=photoaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAdtype['act_id']; ?>" class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>
            <a href="inner_ads.php?wshop=<?php echo $wshop; ?>&amp;Opt=photoviewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAdtype['act_id']; ?>" class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='fa fa-image'></i> 圖片一覽</a>
            <a href="manage_ads.php?wshop=<?php echo $wshop; ?>&amp;Opt=ads_select&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAdtype['act_id']; ?>" class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-star'></i> 主題切換</a>
            <a href="manage_ads.php?wshop=<?php echo $wshop; ?>&amp;Opt=ads_set&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAdtype['act_id']; ?>" class='btn btn-xs btn-primary' style='text-align:center' data-original-title="此設定會根據選擇的主題不同，設定值會有所變更。" data-toggle="tooltip" data-placement="top"><i class='fa fa-cog'></i> 參數設定</a>
            <a href="manage_ads_content_image.php?wshop=<?php echo $wshop; ?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_del_id=<?php echo $row_RecordAdtype['act_id']; ?>" class="btn btn-xs btn-danger" style="text-align:center"><i class="far fa-trash-alt"></i> 刪除</a>
            
            </div>
            </td>
          </tr>
          <?php } while ($row_RecordAdtype = mysqli_fetch_assoc($RecordAdtype)); ?>
          </tbody>
      <tfoot>
      </tfoot>
    </table>
    <?php } // Show if recordset not empty ?>
    
    <?php if ($totalRows_RecordAdtype == 0) { // Show if recordset not empty ?>
     <form action="<?php echo $editFormAction; ?>" method="post" name="Banner_Gen" id="Banner_Gen">
     <div class="alert alert-danger fade show"><i class=""></i> <i class="fa fa-info-circle"></i> <b>目前尚未建立橫幅資料庫！！請點選按鈕建立！！</b></div>
     <input name="MM_Gen" type="hidden" id="MM_Gen" value="form_Banner_Gen" />
     <input name="Opt" type="hidden" id="Opt" value="viewpage" />
     <button type="submit" class="btn btn btn-primary btn-block">建立橫幅</button>
     </form>
    <?php } else if ($totalRows_RecordAdtype <= 10) { ?>
    <form action="<?php echo $editFormAction; ?>" method="post" name="Banner_Gen" id="Banner_Gen">
     <div class="alert alert-info fade show"><i class=""></i> <i class="fa fa-info-circle"></i> <b>目前已建立 <?php echo $totalRows_RecordAdtype; ?> 個主題！！最多建立10個</b></div>
     <input name="MM_Gen" type="hidden" id="MM_Gen" value="form_Banner_Gen" />
     <input name="Opt" type="hidden" id="Opt" value="viewpage" />
     <button type="submit" class="btn btn btn-primary btn-block">建立橫幅</button>
     </form>
    <?php } ?>
    
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel --> 

<script>
	$(document).ready(function() {
		 // Before TableManageDefault 
		 $('#data-table-default').editable({
                    selector: ".ed_title",
                    url: 'sqledit/adtype_jedit.php',
                    type: 'text',
                    name: 'title',
                    //title: '輸入標題',
                    tpl: "<input type='text' style='width: 100%' maxlength='200'>",
                    select2: {
                        width: '100%',
                        // THIS DOESN'T WORK AS IT SHOULD
                        // hiding search box
                        minimumResultsForSearch: -1
                    },
                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return '值不能為空';
                        }
                    }
                });
				
				$('#data-table-default').editable({
                    selector: ".ed_sdescription",
                    url: 'sqledit/adtype_jedit.php',
                    type: 'text',
                    name: 'sdescription',
                    //title: '輸入標題',
                    tpl: "<input type='text' style='width: 100%' maxlength='200'>",
                    select2: {
                        width: '100%',
                        // THIS DOESN'T WORK AS IT SHOULD
                        // hiding search box
                        minimumResultsForSearch: -1
                    },
                    validate: function(value) {
                        /*if ($.trim(value) == '') {
                            return '值不能為空';
                        }*/
                    }
                });

                $('#data-table-default').editable({
                    selector: ".bwight",
                    url: 'sqledit/adtype_jedit.php',
                    type: 'text',
                    name: 'bwight',
                    //title: '輸入排序',
                    tpl: "<input type='number' style='width: 80px' maxlength='200'>",
                    select2: {
                        width: '100%',
                        // THIS DOESN'T WORK AS IT SHOULD
                        // hiding search box
                        minimumResultsForSearch: -1
                    },
                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return '值不能為空';
                        }
                    }
                });
				
				 $('#data-table-default').editable({
                    selector: ".bhight",
                    url: 'sqledit/adtype_jedit.php',
                    type: 'text',
                    name: 'bhight',
	
                    //title: '輸入排序',
                    tpl: "<input type='text' style='width: 80px' maxlength='200'>",
                    select2: {
                        width: '100%',
                        // THIS DOESN'T WORK AS IT SHOULD
                        // hiding search box
                        minimumResultsForSearch: -1
                    },
                    validate: function(value) {
                        
                    }
                });
				
				$('#data-table-default').editable({
                    selector: ".swight",
                    url: 'sqledit/adtype_jedit.php',
                    type: 'text',
                    name: 'swight',
					
                    //title: '輸入排序',
                    tpl: "<input type='number' style='width: 80px' maxlength='200'>",
                    select2: {
                        width: '100%',
                        // THIS DOESN'T WORK AS IT SHOULD
                        // hiding search box
                        minimumResultsForSearch: -1
                    },
                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return '值不能為空';
                        }
                    }
                });
				
				$('#data-table-default').editable({
                    selector: ".shight",
                    url: 'sqledit/adtype_jedit.php',
                    type: 'text',
                    name: 'shight',
                    //title: '輸入排序',
                    tpl: "<input type='text' style='width: 80px' maxlength='200'>",
                    select2: {
                        width: '100%',
                        // THIS DOESN'T WORK AS IT SHOULD
                        // hiding search box
                        minimumResultsForSearch: -1
                    },
                    validate: function(value) {
                        
                    }
                });
	});
</script>
<script>
	//$.fn.editable.defaults.mode = 'inline';
	$(document).ready(function() {
		TableManageDefault.init();		
	});
</script>
<?php if(isset($_GET['act_del_id']) && $_GET['act_del_id'] != "") { ?>
<script type="text/javascript">
swal({ title: "資料刪除成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Add"]); ?>
<?php } ?>
<?php if(isset($_SESSION['DB_Add']) && $_SESSION['DB_Add'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Add"]); ?>
<?php } ?>
<?php if(isset($_SESSION['DB_Edit']) && $_SESSION['DB_Edit'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Edit"]); ?>
<?php } ?>
<?php if(isset($_SESSION['DB_Set']) && $_SESSION['DB_Set'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料設定成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Set"]); ?>
<?php } ?>
<?php
mysqli_free_result($RecordAdtype);
?>
