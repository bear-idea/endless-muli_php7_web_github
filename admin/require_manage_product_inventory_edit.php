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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Product")) {
  $updateSQL = sprintf("UPDATE demo_product SET name=%s, pdseries=%s, indicate=%s, inventory=%s, inventoryshow=%s, inventorynotsale=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['pdseries'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['inventory'], "text"),
                       GetSQLValueString($_POST['inventoryshow'], "int"),
                       GetSQLValueString($_POST['inventorynotsale'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";
  $updateGoTo = "manage_product.php?Opt=inventory&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
  
  
}

$colname_RecordProduct = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordProduct = $_GET['id_edit'];
}
$coluserid_RecordProduct = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProduct = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordProduct, "int"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);
?>


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 庫存及狀態 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" >
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="name" type="text"  class="form-control" id="name" value="<?php echo $row_RecordProduct['name']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">型號</label>
          <div class="col-md-10">
          
                      <input name="pdseries" type="text" id="pdseries" value="<?php echo $row_RecordProduct['pdseries']; ?>" size="30" maxlength="30" class="form-control" />
                 
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">庫存量</label>
          <div class="col-md-10">
                      <input name="inventory" id="inventory" value="<?php echo $row_RecordProduct['inventory']; ?>" maxlength="11" class="form-control col-md-4 "  data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" /><small class="f-s-12 text-grey-darker">可輸入正負整數，不使用請留空。</small>
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" <?php if (!(strcmp($row_RecordProduct['indicate'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="indicate_1">上架</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" <?php if (!(strcmp($row_RecordProduct['indicate'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="indicate_2">下架</label>
            </div>
			<div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_3" value="2" <?php if (!(strcmp($row_RecordProduct['indicate'],"2"))) {echo "checked=\"checked\"";} ?>/>
                <label for="indicate_3">隱藏頁面</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">庫存量顯示 <i class="fa fa-info-circle text-orange" data-original-title="是否要公開顯示目前庫存量給消費者知道。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input type="radio" name="inventoryshow" id="inventoryshow_1" value="1" <?php if (!(strcmp($row_RecordProduct['inventoryshow'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="inventoryshow_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="inventoryshow" id="inventoryshow_2" value="0" <?php if (!(strcmp($row_RecordProduct['inventoryshow'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="inventoryshow_2">不顯示</label>
            </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">自動停賣 <i class="fa fa-info-circle text-orange" data-original-title="是否要公開顯示目前庫存量給消費者知道。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> 當<span style="color:#900; font-weight:bolder">【啟用自動停賣功能】</span>，商品目前庫存<span style="color:#900; font-weight:bolder">【小於或等於0】</span>或<span style="color:#900; font-weight:bolder">【庫存量未輸入】</span>，商品會無法購買並顯示已售完。</div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="inventorynotsale" id="inventorynotsale_1" value="1" <?php if (!(strcmp($row_RecordProduct['inventorynotsale'],"1"))) {echo "checked=\"checked\"";} ?> />
              <label for="inventorynotsale_1">啟用</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="inventorynotsale" id="inventorynotsale_2" value="0" <?php if (!(strcmp($row_RecordProduct['inventorynotsale'],"0"))) {echo "checked=\"checked\"";} ?>/>
              <label for="inventorynotsale_2">關閉</label>
            </div>
           
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
            <input name="prepage" type="hidden" id="prepage" value="<?php if(isset($_SERVER['HTTP_REFERER'])) { echo $_SERVER['HTTP_REFERER']; } ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Product" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordProduct);
?>

