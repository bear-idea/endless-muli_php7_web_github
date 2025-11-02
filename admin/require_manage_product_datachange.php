<?php require_once('../Connections/DB_Conn.php'); ?>
<?php include('dbcconv.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Form_Get")) {


/* 取得產品資訊 */

/* 當類別無傳值進來時則給定初始值 */
if($_POST['oldtype1'] == NULL){$_POST['oldtype1'] = '-1';}
if($_POST['oldtype2'] == NULL){$_POST['oldtype2'] = '-1';}
if($_POST['oldtype3'] == NULL){$_POST['oldtype3'] = '-1';}

$maxRows_RecordProduct = 999;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordProduct = $page * $maxRows_RecordProduct;

$coluserid_RecordProduct = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProduct = $w_userid;
}
$coltype1_RecordProduct = "-1";
if (isset($_POST['oldtype1'])) {
  $coltype1_RecordProduct = $_POST['oldtype1'];
}
$coltype2_RecordProduct = "-1";
if (isset($_POST['oldtype2'])) {
  $coltype2_RecordProduct = $_POST['oldtype2'];
}
$coltype3_RecordProduct = "-1";
if (isset($_POST['oldtype3'])) {
  $coltype3_RecordProduct = $_POST['oldtype3'];
}

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE type1 = %s && type2 = %s && type3 = %s && userid=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($coltype1_RecordProduct, "int"),GetSQLValueString($coltype2_RecordProduct, "int"),GetSQLValueString($coltype3_RecordProduct, "int"),GetSQLValueString($coluserid_RecordProduct, "int"));
$query_limit_RecordProduct = sprintf("%s LIMIT %d, %d", $query_RecordProduct, $startRow_RecordProduct, $maxRows_RecordProduct);
$RecordProduct = mysqli_query($DB_Conn, $query_limit_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);

//echo $totalRows_RecordProduct;

if ($totalRows_RecordProduct > 0) { 

do {

if($_POST['lang'] == 'zh-cn' && $row_RecordProduct['lang'] == 'zh-tw') { //繁轉簡
  
  /* 當類別無傳值進來時則給定初始值 */
  if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
  if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
  if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}

  $insertSQL = sprintf("INSERT INTO demo_product (name, type1, type2, type3, pdseries, model, price, spprice, pricecheck, pic, skeyword, sdescription, content, indicate, plot, homeshow, notes1, lang, postdate, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['name'],1)), "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
                       GetSQLValueString($row_RecordProduct['pdseries'], "text"),
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['model'],1)), "text"),
                       GetSQLValueString($row_RecordProduct['price'], "int"),
					   GetSQLValueString($row_RecordProduct['spprice'], "int"),
					   GetSQLValueString($row_RecordProduct['pricecheck'], "int"),
                       GetSQLValueString($row_RecordProduct['pic'], "text"),
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['skeyword'],1)), "text"),
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['sdescription'],1)), "text"),
                       GetSQLValueString(dbcconv($row_RecordProduct['content'],1), "text"),
                       GetSQLValueString($row_RecordProduct['indicate'], "int"),
					   GetSQLValueString($row_RecordProduct['plot'], "int"),
					   GetSQLValueString($row_RecordProduct['homeshow'], "int"),
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['notes1'],1)), "text"),
					   GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($row_RecordProduct['postdate'], "date"),
                       GetSQLValueString($row_RecordProduct['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $tipshow .= "【" . $row_RecordProduct['name'] . "】已複製至新分類<br/>";
}else if($_POST['lang'] == 'zh-tw' && $row_RecordProduct['lang'] == 'zh-cn'){ // 簡轉繁
  
  /* 當類別無傳值進來時則給定初始值 */
  if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
  if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
  if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}
  
  $insertSQL = sprintf("INSERT INTO demo_product (name, type1, type2, type3, pdseries, model, price, spprice, pricecheck, pic, skeyword, sdescription, content, indicate, plot, homeshow, notes1, lang, postdate, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['name'],1)), "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
                       GetSQLValueString($row_RecordProduct['pdseries'], "text"),
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['model'],0)), "text"),
                       GetSQLValueString($row_RecordProduct['price'], "int"),
					   GetSQLValueString($row_RecordProduct['spprice'], "int"),
					   GetSQLValueString($row_RecordProduct['pricecheck'], "int"),
                       GetSQLValueString($row_RecordProduct['pic'], "text"),
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['skeyword'],0)), "text"),
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['sdescription'],0)), "text"),
                       GetSQLValueString(dbcconv($row_RecordProduct['content'],0), "text"),
                       GetSQLValueString($row_RecordProduct['indicate'], "int"),
					   GetSQLValueString($row_RecordProduct['plot'], "int"),
					   GetSQLValueString($row_RecordProduct['homeshow'], "int"),
                       GetSQLValueString(htmlspecialchars(dbcconv($row_RecordProduct['notes1'],0)), "text"),
					   GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($row_RecordProduct['postdate'], "date"),
                       GetSQLValueString($row_RecordProduct['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $tipshow .= "【" . $row_RecordProduct['name'] . "】已複製至新分類<br/>";
}else{ // 其他
  
  /* 當類別無傳值進來時則給定初始值 */
  if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
  if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
  if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}
  
  $insertSQL = sprintf("INSERT INTO demo_product (name, type1, type2, type3, pdseries, model, price, spprice, pricecheck, pic, skeyword, sdescription, content, indicate, plot, homeshow, notes1, lang, postdate, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(htmlspecialchars($row_RecordProduct['name']), "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
                       GetSQLValueString($row_RecordProduct['pdseries'], "text"),
                       GetSQLValueString(htmlspecialchars($row_RecordProduct['model']), "text"),
                       GetSQLValueString($row_RecordProduct['price'], "int"),
					   GetSQLValueString($row_RecordProduct['spprice'], "int"),
					   GetSQLValueString($row_RecordProduct['pricecheck'], "int"),
                       GetSQLValueString($row_RecordProduct['pic'], "text"),
                       GetSQLValueString(htmlspecialchars($row_RecordProduct['skeyword']), "text"),
                       GetSQLValueString(htmlspecialchars($row_RecordProduct['sdescription']), "text"),
                       GetSQLValueString($row_RecordProduct['content'], "text"),
                       GetSQLValueString($row_RecordProduct['indicate'], "int"),
					   GetSQLValueString($row_RecordProduct['plot'], "int"),
					   GetSQLValueString($row_RecordProduct['homeshow'], "int"),
                       GetSQLValueString(htmlspecialchars($row_RecordProduct['notes1']), "text"),
					   GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($row_RecordProduct['postdate'], "date"),
                       GetSQLValueString($row_RecordProduct['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $tipshow .= "【" . $row_RecordProduct['name'] . "】已複製至新分類<br/>";
}

} while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct));

echo "<script type=\"text/javascript\">swal({ title: '".$tipshow."', text: '', type: 'success',buttonsStyling: false,confirmButtonText: '確認',confirmButtonClass: \"btn btn-primary m-5\"});</script>\n";		
}


}

/* 取得類別列表 */
$coluserid_RecordProductListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListType = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && level='0' && userid=%s ORDER BY sortid ASC, item_id DESC",GetSQLValueString($coluserid_RecordProductListType, "int"));
$RecordProductListType = mysqli_query($DB_Conn, $query_RecordProductListType) or die(mysqli_error($DB_Conn));
$row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
$totalRows_RecordProductListType = mysqli_num_rows($RecordProductListType);
?>
<style>
.bgtw{ background-color:#CDDDFC}
.bgcn{ background-color:#A5F8B1}
.bgen{ background-color:#FACCA3}
</style>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Product']; ?> <small>資料轉移</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-exchange-alt"></i> 資料轉移</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <?php if (isset($_POST['Step']) && $_POST['Step'] == '2') { ?>
  <form action="<?php echo $editFormAction;?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  <div class="form-group row">
          <label class="col-md-2 col-form-label">目標分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                    <label for="type1"></label>
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordProductListType['item_id']?>" class="<?php if($row_RecordProductListType['lang'] == 'zh-tw') { echo "bgtw";}else if($row_RecordProductListType['lang'] == 'zh-cn'){ echo "bgcn";}else if($row_RecordProductListType['lang'] == 'en'){ echo "bgen";} ?>"><?php echo $row_RecordProductListType['itemname']?></option>
                      <?php
} while ($row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType));
  $rows = mysqli_num_rows($RecordProductListType);
  if($rows > 0) {
      mysqli_data_seek($RecordProductListType, 0);
	  $row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
  }
?>
                    </select>
                    
                    <label for="type2"></label>
                    <select name="type2" id="type2" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1">-- 選擇分類2 --</option>
                    </select>
                    
                    <label for="type3"></label>
                    <select name="type3" id="type3" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1">-- 選擇分類3 --</option>
                    </select>
                    
                    
</div>
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="lang" id="lang" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                        <?php //if ($LangChooseZHTW == '1') { ?>
                        <option value="zh-tw" class="bgtw">繁</option>
                        <?php //} ?>
                        <?php if ($LangChooseZHCN == '1') { ?>
                        <option value="zh-cn" class="bgcn">簡</option>
                        <?php } ?>
                        <?php if ($LangChooseEN == '1') { ?>
                        <option value="en" class="bgen">英</option>
                        <?php } ?>
                        <?php if ($LangChooseJP == '1') { ?>
                        <option value="jp">日</option>
                        <?php } ?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">資料複製轉移</button>
             <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
                    <input name="oldtype1" type="hidden" id="oldtype1" value="<?php echo $_POST['type1']; ?>" />
                    <input name="oldtype2" type="hidden" id="oldtype2" value="<?php echo $_POST['type2']; ?>" />
                    <input name="oldtype3" type="hidden" id="oldtype3" value="<?php echo $_POST['type3']; ?>" />
                    <input name="Step" type="hidden" id="Step" value="3" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="Form_Get" />
  </form>
  <?php } else { ?>
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>此區功能並不會刪除您原先資料，僅會將該來源分類複製到目標分類。</b></div>
  
  <form action="<?php echo $editFormAction;?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">來源分類<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                    <label for="type1"></label>
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordProductListType['item_id']?>" class="<?php if($row_RecordProductListType['lang'] == 'zh-tw') { echo "bgtw";}else if($row_RecordProductListType['lang'] == 'zh-cn'){ echo "bgcn";}else if($row_RecordProductListType['lang'] == 'en'){ echo "bgen";} ?>"><?php echo $row_RecordProductListType['itemname']?></option>
                      <?php
} while ($row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType));
  $rows = mysqli_num_rows($RecordProductListType);
  if($rows > 0) {
      mysqli_data_seek($RecordProductListType, 0);
	  $row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
  }
?>
                    </select>
                    <label for="type2"></label>
                    <select name="type2" id="type2" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1">-- 選擇分類2 --</option>
                    </select>
                    <label for="type3"></label>
                    <select name="type3" id="type3" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1">-- 選擇分類3 --</option>
                    </select>
                    
                    
</div>
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">下一步 - 選擇要放置的目標分類</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="Step" type="hidden" id="Step" value="2" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <?php } ?>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
// 下拉連動選單設定
$(function () {

    // 判斷是否有預設值
    var defaultValue = false;
    if (0 < $.trim($('#fullIdPath').val()).length) {
        $fullIdPath = $('#fullIdPath').val().split(',');
        defaultValue = true;
    }
    
    // 設定預設選項
    if (defaultValue) {
        $('#type1').selectOptions($fullIdPath[0]); 
    }
    
	//$("#type2").hide(); //開始執行時先將第二層的選單藏起來
	//$("#type3").hide(); //開始執行時先將第二層的選單藏起來
    // 開始產生關聯下拉式選單
    $('#type1').change(function () {
        // 觸發第二階下拉式選單
		//$("選單ID").addOption("選單內容物件",false);
		//$("選單ID").removeOption("選單索引/值/陣列");若是要刪掉全部則框號內置入/./
        $('#type2').removeOption(/.?/).ajaxAddOption(
            'selectbox_action/product_add.php?&<?php echo time();?>', 
            { 'id': $(this).val(), 'lv': 1 }, 
            false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
            function () {
                
                // 設定預設選項
                if (defaultValue) {
                    $(this).selectOptions($fullIdPath[1]).trigger('change');
                } else {
                    $(this).selectOptions().trigger('change');
                }
				// 設定欄位隱藏/開啟
				if( $('#type1 option:selected').val() != '' && $('#type2 option:selected').val() != '')
				// 值=val() // 標籤=text
				{
					$("#type2").show(); // 
				}else{
					$("#type2").hide(); //
				}
            }
        ).change(function () {
            // 觸發第三階下拉式選單
            $('#type3').removeOption(/.?/).ajaxAddOption(
                'selectbox_action/product_add.php?<?php echo time();?>', 
                { 'id': $(this).val(), 'lv': 2 }, 
                false, 
                function () {
                
                    // 設定預設選項
                    if (defaultValue) {
                        $(this).selectOptions($fullIdPath[2]);
                    }
					// 設定欄位隱藏/開啟
					if( $('#type2 option:selected').val() != '' && $('#type3 option:selected').val() != '')
					// 值=val() // 標籤=text
					{
						$("#type3").show(); // 
					}else{
						$("#type3").hide(); //
					}
					}
            );
        });
    }).trigger('change');

    // 全部選擇完畢後，顯示所選擇的選項
    /*$('#select3').change(function () {
        alert('主機：' + $('#select1 option:selected').text() + 
              '／類型：' + $('#select2 option:selected').text() +
              '／遊戲：' + $('#select3 option:selected').text());
    });*/
});
</script>
<?php
mysqli_free_result($RecordProductListType);
?>
