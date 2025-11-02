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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Modlink")) {
  $updateSQL = sprintf("UPDATE demo_modlink SET name=%s, type=%s, typemenu=%s, sdescription=%s,  modselect=%s, picname=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['typemenu'], "text"),
                       GetSQLValueString($_POST['sdescription'], "text"),
					   GetSQLValueString($_POST['modselect'], "int"),
					   GetSQLValueString($_POST['picname'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_modlink.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
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
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlinkListType = sprintf("SELECT * FROM demo_modlinkitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordModlinkListType, "text"),GetSQLValueString($coluserid_RecordModlinkListType, "int"));
$RecordModlinkListType = mysqli_query($DB_Conn, $query_RecordModlinkListType) or die(mysqli_error($DB_Conn));
$row_RecordModlinkListType = mysqli_fetch_assoc($RecordModlinkListType);
$totalRows_RecordModlinkListType = mysqli_num_rows($RecordModlinkListType);

/* 取得贊助企業資料 */
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

?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Modlink']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
           <?php require("inc_modlist_edit.php"); // 取得模組清單 ?>
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
                 <a href="uplod_modlink.php?id_edit=<?php echo $row_RecordModlink['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a>
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
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordModlink['id']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Modlink" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordModlinkListType);

mysqli_free_result($RecordModlink);

mysqli_free_result($RecordModList);
?>
