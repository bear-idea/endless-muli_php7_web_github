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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Frilink")) {
  $updateSQL = sprintf("UPDATE demo_frilink SET name=%s, type=%s, typemenu=%s, link=%s, sdescription=%s,  modselect=%s, picname=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['typemenu'], "text"),
                       GetSQLValueString($_POST['link'], "text"),
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

  $updateGoTo = "manage_frilink.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別列表 */
$colname_RecordFrilinkListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordFrilinkListType = $_GET['lang'];
}
$coluserid_RecordFrilinkListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordFrilinkListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordFrilinkListType = sprintf("SELECT * FROM demo_frilinkitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordFrilinkListType, "text"),GetSQLValueString($coluserid_RecordFrilinkListType, "int"));
$RecordFrilinkListType = mysqli_query($DB_Conn, $query_RecordFrilinkListType) or die(mysqli_error($DB_Conn));
$row_RecordFrilinkListType = mysqli_fetch_assoc($RecordFrilinkListType);
$totalRows_RecordFrilinkListType = mysqli_num_rows($RecordFrilinkListType);

/* 取得贊助企業資料 */
$colname_RecordFrilink = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordFrilink = $_GET['id_edit'];
}
$coluserid_RecordFrilink = "-1";
if (isset($w_userid)) {
  $coluserid_RecordFrilink = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordFrilink = sprintf("SELECT * FROM demo_frilink WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordFrilink, "int"),GetSQLValueString($coluserid_RecordFrilink, "int"));
$RecordFrilink = mysqli_query($DB_Conn, $query_RecordFrilink) or die(mysqli_error($DB_Conn));
$row_RecordFrilink = mysqli_fetch_assoc($RecordFrilink);
$totalRows_RecordFrilink = mysqli_num_rows($RecordFrilink);

?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Frilink']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
          
                      <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordFrilink['name']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                <option <?php if (!(strcmp("", $row_RecordFrilink['type']))) {echo "selected=\"selected\"";} ?> value="">-- 選擇類別 --</option>
                <?php
				do {  
				?>
								<option <?php if (!(strcmp($row_RecordFrilinkListType['itemname'], $row_RecordFrilink['type']))) {echo "selected=\"selected\"";} ?> value="<?php echo $row_RecordFrilinkListType['itemname']?>"><?php echo $row_RecordFrilinkListType['itemname']?></option>
								<?php
				} while ($row_RecordFrilinkListType = mysqli_fetch_assoc($RecordFrilinkListType));
				  $rows = mysqli_num_rows($RecordFrilinkListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordFrilinkListType, 0);
					  $row_RecordFrilinkListType = mysqli_fetch_assoc($RecordFrilinkListType);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網址<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="link" required="" class="form-control" id="link" pattern= "/^(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?$/i" value="<?php echo $row_RecordFrilink['link']; ?>" maxlength="200" data-parsley-type="url" data-parsley-trigger="blur" placeholder="http://www.yoururl.com" />
                      
                 
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
                                            <input <?php if (!(strcmp($row_RecordFrilink['picname'],"fri_mod01.jpg"))) {echo "checked=\"checked\"";} ?>type="radio" name="picname" value="fri_mod01.jpg" id="picname_01" />
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
                                            <input <?php if (!(strcmp($row_RecordFrilink['picname'],"fri_mod0$i.jpg"))) {echo "checked=\"checked\"";} ?> type="radio" name="picname" value="fri_mod0<?php echo $i; ?>.jpg" id="picname_0<?php echo $i; ?>" />
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
                                            <input <?php if (!(strcmp($row_RecordFrilink['picname'],"fri_mod$i.jpg"))) {echo "checked=\"checked\"";} ?>type="radio" name="picname" value="fri_mod<?php echo $i; ?>.jpg" id="picname_<?php echo $i; ?>" />
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
                <input <?php if (!(strcmp($row_RecordFrilink['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordFrilink['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述</label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordFrilink['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordFrilink['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="typemenu"  type="hidden" id="typemenu" value="Link" />
            <input name="modselect"  type="hidden" id="modselect" value="0" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordFrilink['id']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Frilink" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordFrilinkListType);

mysqli_free_result($RecordFrilink);
?>
