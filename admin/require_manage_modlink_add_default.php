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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
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

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Modlink']; ?> <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="name" type="text" id="name" maxlength="200" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇類別 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordModlinkListType['itemname']?>"><?php echo $row_RecordModlinkListType['itemname']?></option>
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
           <?php require("inc_modlist_add.php"); // 取得模組清單 ?>
           <?php $i++ ?>
           <?php } while ($row_RecordModList = mysqli_fetch_assoc($RecordModList)); ?>
             <?php if ($OptionCartSelect == '1') {?>
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_088.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Cart_Pay" id="typemenu_Cart_Pay"/>
                  <label for="typemenu_Cart_Pay">匯款通知</label>
             </div>
             </div>
             </div>
             
             <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_091.png" width="60" height="60" /></div>
             <div class="mod_text">
             <div class="radio radio-css radio-inline">
                  <input  type="radio" name="typemenu" value="Cart_Note" id="typemenu_Cart_Note"/>
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
          <label class="col-md-2 col-form-label">預設圖片 <i class="fa fa-info-circle text-orange" data-original-title="請注意只會顯示10個在您的頁面上，但您可在該模組主頁面中調整排列順序來作顯示。。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <div class="row">
                     <div class="col-md-12">
                     <div class="row">
                         <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 pull-left">
                             <div class="card">
                                  <img class="card-img-top" src="../images/link/fri_mod01.jpg" alt="" />
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input type="radio" name="picname" value="fri_mod01.jpg" id="picname_01" checked="checked" />
                                            <label for="picname_01">01</label>
                                      </div>
                                  </div>
                              </div> 
                          </div>
                          <?php for($i=2; $i<=9; $i++) { ?>
                          <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 pull-left">
                             <div class="card">
                                  <img class="card-img-top" src="../images/link/fri_mod0<?php echo $i; ?>.jpg" alt="" />
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input type="radio" name="picname" value="fri_mod0<?php echo $i; ?>.jpg" id="picname_0<?php echo $i; ?>" />
                                            <label for="picname_0<?php echo $i; ?>">0<?php echo $i; ?></label>
                                      </div>
                                  </div>
                              </div> 
                          </div>
                          <?php } ?>
                          <?php for($i=10; $i<=25; $i++) { ?>
                          <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 pull-left">
                             <div class="card">
                                  <img class="card-img-top" src="../images/link/fri_mod<?php echo $i; ?>.jpg" alt="" />
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input type="radio" name="picname" value="fri_mod<?php echo $i; ?>.jpg" id="picname_<?php echo $i; ?>" />
                                            <label for="picname_<?php echo $i; ?>"><?php echo $i; ?></label>
                                      </div>
                                  </div>
                              </div> 
                          </div>
                          <?php } ?>
                      </div>
                  </div>
                  </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述</label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" id="sdescription" size="100" maxlength="150" class="form-control"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            
            <input name="modselect"  type="hidden" id="modselect" value="0" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Modlink" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordModlinkListType);

mysqli_free_result($RecordModList);
?>
