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

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "") && $_GET['userid'] == $w_userid) {
  $deleteSQL = sprintf("DELETE FROM demo_tmpcolumn WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));
  if($_GET['type'] == 'productlist' || $_GET['type'] == 'productactlist' || $_GET['type'] == 'producthotlist' || $_GET['type'] == 'productsalelist' || $_GET['type'] == 'productnewslist' || $_GET['type'] == 'modlink' || $_GET['type'] == 'frilink' || $_GET['type'] == 'articlelist' || $_GET['type'] == 'fbfan' || $_GET['type'] == 'alllist' || $_GET['type'] == 'newslist' || $_GET['type'] == 'blogplist' || $_GET['type'] == 'blogcalendar' || $_GET['type'] == 'siteviewcount' || $_GET['type'] == 'sitewhoscount' || $_GET['type'] == 'alltypelist' || $_GET['type'] == 'productsearch')
  {
	  // 鎖定
	  $updateSQLLock = sprintf("UPDATE demo_setting_fr SET %s=0 WHERE userid=%s",
	                       GetSQLValueString($_GET['type'] . "Lock_sp", "none"),
						   GetSQLValueString($_GET['userid'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultLock = mysqli_query($DB_Conn, $updateSQLLock) or die(mysqli_error($DB_Conn));
  }
  $_SESSION['DB_Del'] = "Success";
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $deleteGoTo = "manage_tmp.php?wshop=" . $wshop . "&Opt=tmpcolumn&lang=" . $_SESSION['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $deleteGoTo));
  ob_end_flush(); // 輸出緩衝區結束
  exit;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "TmpColumnFree")) {
  $insertSQL = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, location, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['style'], "text"),
					   GetSQLValueString($_POST['dftname'], "text"),
					   GetSQLValueString($_POST['dftname_sp'], "text"),
					   GetSQLValueString($_POST['location'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));
  if($_POST['type'] == 'productlist' || $_POST['type'] == 'productactlist' || $_POST['type'] == 'producthotlist' || $_POST['type'] == 'productsalelist' || $_POST['type'] == 'productnewslist' || $_POST['type'] == 'modlink' || $_POST['type'] == 'frilink' || $_POST['type'] == 'articlelist' || $_POST['type'] == 'fbfan' || $_POST['type'] == 'alllist' || $_POST['type'] == 'newslist' || $_POST['type'] == 'blogplist' || $_POST['type'] == 'blogcalendar' || $_POST['type'] == 'siteviewcount' || $_POST['type'] == 'sitewhoscount' || $_POST['type'] == 'alltypelist' || $_POST['type'] == 'productsearch')
  {
	  // 鎖定
	  $updateSQLLock = sprintf("UPDATE demo_setting_fr SET %s=1 WHERE userid=%s",
	  					   GetSQLValueString($_POST['type'] . "Lock_sp", "none"),
						   GetSQLValueString($_POST['userid'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultLock = mysqli_query($DB_Conn, $updateSQLLock) or die(mysqli_error($DB_Conn));
  }
  
  $_SESSION['DB_Add'] = "Success";

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordTmpColumn = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpColumn = $w_userid;
}
$collang_RecordTmpColumn = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpColumn = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpColumn = sprintf("SELECT * FROM demo_tmpcolumn WHERE userid=%s && lang=%s && location='left'", GetSQLValueString($coluserid_RecordTmpColumn, "int"),GetSQLValueString($collang_RecordTmpColumn, "text"));
$RecordTmpColumn = mysqli_query($DB_Conn, $query_RecordTmpColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn);
$totalRows_RecordTmpColumn = mysqli_num_rows($RecordTmpColumn);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpAddColumn = "SELECT * FROM demo_tmpaddcolumn WHERE class != 'blog'";
$RecordTmpAddColumn = mysqli_query($DB_Conn, $query_RecordTmpAddColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpAddColumn = mysqli_fetch_assoc($RecordTmpAddColumn);
$totalRows_RecordTmpAddColumn = mysqli_num_rows($RecordTmpAddColumn);

$coluserid_RecordSettingLock = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingLock = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingLock = sprintf("SELECT productlistLock_sp, productactlistLock_sp, producthotlistLock_sp, productsalelistLock_sp, productnewslistLock_sp, frilinkLock_sp, modlinkLock_sp, fbfanLock_sp, articlelistLock_sp, alllistLock_sp, newslistLock_sp, blogplistLock_sp, blogcalendarLock_sp, siteviewcountLock_sp, sitewhoscountLock_sp, alltypelistLock_sp, productsearchLock_sp FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($coluserid_RecordSettingLock, "int"));
$RecordSettingLock = mysqli_query($DB_Conn, $query_RecordSettingLock) or die(mysqli_error($DB_Conn));
$row_RecordSettingLock = mysqli_fetch_assoc($RecordSettingLock);
$totalRows_RecordSettingLock = mysqli_num_rows($RecordSettingLock);
?>

<!-- ================== BEGIN X-Editable CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/css/bootstrap4-editable.min.css" rel="stylesheet" />
<!-- ================== END X-Editable CSS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 側邊欄位 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<div class="row">
<div class="col-lg-6">
<!-- begin panel -->
<div class="panel panel-inverse" id="Step_Edit_Board"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 欄位設定</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <form id="form_TmpColumnList" name="form_TmpColumnList" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered">
    <div class="table-responsive">
        <table class="table table-striped m-b-0" id="data-table-default">
            <thead>
                <tr>
                    <th>欄位型態</th>
                    <th>自訂欄位標題</th>
                    <th>排序</th>
                    <th width="1%">操作</th>
                </tr>
            </thead>
            <tbody>
			<?php do { ?>
            <?php if ($totalRows_RecordTmpColumn > 0) { // Show if recordset not empty ?>
                <tr>
                    <td><?php echo $row_RecordTmpColumn['dftname']; ?></td>
                    <td><span class="ed_customname" id="customname_<?php echo $row_RecordTmpColumn['id']; ?>" data-pk="<?php echo $row_RecordTmpColumn['id']; ?>"><?php echo $row_RecordTmpColumn['customname']; ?></span><?php if ($row_RecordTmpColumn['type'] == 'fbfan') { ?><a href="fbid_home.php?wshop=<?php echo $wshop;?>&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank" data-original-title="該頁面下方FB粉絲頁作設定。" data-toggle="tooltip" data-placement="right" class="btn btn-xs btn-primary pull-right colorbox_iframe"><i class="fa fa-arrow-circle-right"></i> ID設定</a><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'frilink') { ?><a href="manage_frilink.php?wshop=<?php echo $wshop;?>&amp;Opt_Frilink=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank" data-original-title="加入外部連結網址。" data-toggle="tooltip" data-placement="right" class="btn btn-xs btn-primary pull-right"><i class="fa fa-arrow-circle-right"></i> 資料維護</a><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'modlink') { ?><a href="manage_modlink.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank" data-original-title="加入現有模組連結網址。" data-toggle="tooltip" data-placement="right" class="btn btn-xs btn-primary pull-right"><i class="fa fa-arrow-circle-right"></i> 資料維護</a><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'siteviewcount') { ?><a href="counter_home.php?wshop=<?php echo $wshop;?>&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定初始人數。" data-toggle="tooltip" data-placement="right" class="btn btn-xs btn-primary pull-right colorbox_iframe"><i class="fa fa-arrow-circle-right"></i> 起始人數</a></span><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'free') { ?> <i data-original-title="此項目可自行放置Html語法。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'alltypelist') { ?> <i class="fa fa-info-circle text-orange" data-original-title="此項目可依各選單項目之底層子選單做分類，顯示於各頁面中，每一頁面皆有自己的分類清單。" data-toggle="tooltip" data-placement="top"></i><a href="submenu_home.php?wshop=<?php echo $wshop;?>&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-xs btn-primary pull-right colorbox_iframe" data-original-title="設定標題名稱。" data-toggle="tooltip" data-placement="right"><i class="fa fa-arrow-circle-right"></i> 標題名稱</a><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'alllist') { ?> <i data-original-title="此項目可在每一頁面中加入主選單列表。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'bline') { ?> <i data-original-title="此項目會放置一高度5px之空白區塊。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productlist') { ?> <i data-original-title="此項目可加入產品分類選單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'newslist') { ?> <i data-original-title="此項目可加入最新訊息。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'articlelist') { ?> <i data-original-title="此項目可加入自訂之文章選單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productactlist') { ?> <i data-original-title="此項目可加入活動商品清單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'producthotlist') { ?> <i data-original-title="此項目可加入熱門商品清單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productsalelist') { ?> <i data-original-title="此項目可加入促銷商品清單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productnewslist') { ?> <i data-original-title="此項目可加入最新商品清單。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?><?php if ($row_RecordTmpColumn['type'] == 'productsearch') { ?> <i data-original-title="此項目可加入商品搜尋。" data-toggle="tooltip" data-placement="right" class="fa fa-info-circle text-orange"></i><?php } ?></td>
                    <td id="Step_Sort"><span class="sortid" id="sortid_<?php echo $row_RecordTmpColumn['id']; ?>" data-pk="<?php echo $row_RecordTmpColumn['id']; ?>"><?php echo $row_RecordTmpColumn['sortid']; ?></span></td>
                    <td id="Step_Edit"><div class="btn-group"><?php if ($row_RecordTmpColumn['style'] == 'free') { ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn_setting_free&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> 修改</a><?php } else if($row_RecordTmpColumn['style'] == 'menu') { ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn_setting_menu&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> 修改</a><?php } else { ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn_setting&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> 修改</a><?php } ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>" class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i> 刪除</a></div></td>
                </tr>
             <?php } // Show if recordset not empty ?>
            <?php } while ($row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn)); ?>   
            </tbody>
        </table>
    </div>
    
        <input type="hidden" name="MM_update" value="form_NewsItemEdit" />
      </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
</div>


<div class="col-lg-6">
<!-- begin panel -->
<div class="panel panel-inverse" id="Step_Edit_Board"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa fa-plus"></i> 可新增欄位</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-hover m-b-0">
            <thead>
                <tr>
                    <th>欄位型態</th>
                    <th>描述</th>
                    <th width="1%">操作</th>
                </tr>
            </thead>
            <tbody>
			<?php do { ?>
            <?php if (
		  ($row_RecordTmpAddColumn['type'] == 'sitewhoscount' && ($row_RecordSettingLock['sitewhoscountLock_sp'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'siteviewcount' && ($row_RecordSettingLock['siteviewcountLock_sp'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'blogcalendar' && ($row_RecordSettingLock['blogcalendarLock_sp'] == '1' OR $OptionBlogSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'blogplist' && ($row_RecordSettingLock['blogplistLock_sp'] == '1' OR $OptionBlogSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'frilink' && ($row_RecordSettingLock['frilinkLock_sp'] == '1' OR $OptionFrilinkSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'modlink' && ($row_RecordSettingLock['modlinkLock_sp'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'productlist' && ($row_RecordSettingLock['productlistLock_sp'] == '1' OR $OptionProductSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'productactlist' && ($row_RecordSettingLock['productactlistLock_sp'] == '1' OR $OptionProductSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'producthotlist' && ($row_RecordSettingLock['producthotlistLock_sp'] == '1' OR $OptionProductSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'productsalelist' && ($row_RecordSettingLock['productsalelistLock_sp'] == '1' OR $OptionProductSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'productnewslist' && ($row_RecordSettingLock['productnewslistLock_sp'] == '1' OR $OptionProductSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'productsearch' && ($row_RecordSettingLock['productsearchLock_sp'] == '1' OR $OptionProductSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'articlelist' && ($row_RecordSettingLock['articlelistLock_sp'] == '1' OR $OptionArticleSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'alltypelist' && ($row_RecordSettingLock['alltypelistLock_sp'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'fbfan' && ($row_RecordSettingLock['fbfanLock_sp'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'alllist' && ($row_RecordSettingLock['alllistLock_sp'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'newslist' && ($row_RecordSettingLock['newslistLock_sp'] == '1' OR $OptionNewsSelect == '0'))
		  ) { ?>
          <?php } else { ?>
          <form name="TmpColumn" action="<?php echo $editFormAction; ?>" method="POST" id="TmpColumn<?php echo $row_RecordTmpAddColumn['type']; ?>">
                <tr>
                    <td><?php echo $row_RecordTmpAddColumn['dftname']; ?></td>
                    <td><?php echo $row_RecordTmpAddColumn['desc']; ?></td>
                    <td id="Step_Add"><button type="submit" class="btn btn btn-primary btn-xs"><i class="fa fa-plus"></i> 新增</button></td>
                </tr>
             <input name="type" type="hidden" id="type" value="<?php echo $row_RecordTmpAddColumn['type']; ?>" />
             <input name="dftname" type="hidden" id="dftname" value="<?php echo $row_RecordTmpAddColumn['dftname']; ?>" />
             <input name="dftname_sp" type="hidden" id="dftname_sp" value="<?php echo $row_RecordTmpAddColumn['dftname_sp']; ?>" />
             <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTmpAddColumn['id']; ?>" />
             <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
             <input name="style" type="hidden" id="style" value="<?php echo $row_RecordTmpAddColumn['style']; ?>" />
             <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
             <input name="location" type="hidden" id="location" value="left" />
             <input type="hidden" name="MM_insert" value="TmpColumnFree" />
          </form>
             <?php } // Show if recordset not empty ?>
            <?php } while ($row_RecordTmpAddColumn = mysqli_fetch_assoc($RecordTmpAddColumn)); ?> 
            </tbody>
        </table>
    </div>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
</div>
</div>

<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip1',
                intro: '依照以下的步驟操作，您可加入功能至側邊欄位中。'
              },
			  {
                element: '#Step_Tip2',
                intro: '<img src="images/tip/tip031.jpg" width="300" height="300" /><br /><br />前台顯示結果。'
              },
			  {
                element: '#Step_Add_Board',
                intro: '此區塊為可新增的功能列表。'
              },
			  {
                element: '#Step_Edit_Board',
                intro: '此區塊為目前網站中顯示的功能列表。'
              },
			  {
                element: '#Step_Add',
                intro: '您可以點選按鈕新增功能。新增的項目會加入至左方區塊中並顯示於網站。'
              },
              {
                element: '#Step_Sort',
                intro: '<img src="images/tip/tip060.jpg" width="126" height="102" /><br /><br />點選文字可直接修改，更改數字即可排序。',
                position: 'bottom'
              },
              {
                element: '#Step_Edit',
                intro: '您可以對每個項目做細部修改。',
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
$('#data-table-default').editable({
	selector: ".ed_customname",
	url: 'sqledit/tmpcolumn_jedit.php',
	type: 'text',
	name: 'customname',
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
	selector: ".sortid",
	url: 'sqledit/tmpcolumn_jedit.php',
	type: 'text',
	name: 'sortid',
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
</script>

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
<?php if(isset($_SESSION['DB_Del']) && $_SESSION['DB_Del'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料移除成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Del"]); ?>
<?php } ?>

<?php
mysqli_free_result($RecordTmpColumn);

mysqli_free_result($RecordTmpAddColumn);

mysqli_free_result($RecordSettingLock);
?>
