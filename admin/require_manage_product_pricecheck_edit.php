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
  $updateSQL = sprintf("UPDATE demo_product SET name=%s, pdseries=%s, price=%s, spprice=%s, costprice=%s, pricecheck=%s, indicate=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['pdseries'], "text"),
                       GetSQLValueString($_POST['price'], "int"),
					   GetSQLValueString($_POST['spprice'], "int"),
                       GetSQLValueString($_POST['costprice'], "int"),
                       GetSQLValueString($_POST['pricecheck'], "int"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";
  $updateGoTo = "manage_product.php?Opt=pricecheck&lang=" . $_POST['lang'];
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 價格及審核狀態 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">價格</label>
          <div class="col-md-10">
                      <input name="price" id="price" value="<?php echo $row_RecordProduct['price']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" /><?php if ($OptionCartSelect == '1') {?><small class="f-s-12 text-grey-darker">若不想啟用此商品購物功能，請將價格留空。</small><?php } ?>
                            
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">特惠價</label>
          <div class="col-md-10">
                      <input name="spprice" id="spprice" value="<?php echo $row_RecordProduct['spprice']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" /><?php if ($OptionCartSelect == '1') {?><small class="f-s-12 text-grey-darker">若不想啟用此商品購物功能，請將價格留空。</small><?php } ?>
                      
                 
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">成本價 <i class="fa fa-info-circle text-orange" data-original-title="此價格僅會顯示在後端。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      <input name="costprice" id="costprice" value="<?php echo $row_RecordProduct['costprice']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                      
                 
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
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">審核狀態 <i class="fa fa-info-circle text-orange" data-original-title="商品是否需要審核價格後才行購買。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input type="radio" name="pricecheck" id="pricecheck_1" value="1" <?php if (!(strcmp($row_RecordProduct['pricecheck'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="pricecheck_1">已審核</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="pricecheck" id="pricecheck_2" value="0" <?php if (!(strcmp($row_RecordProduct['pricecheck'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="pricecheck_2">未審核</label>
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
