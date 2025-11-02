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
/* 新增類別項目 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_ProductItemAdd")) {
  $insertSQL = sprintf("INSERT INTO demo_productspformat (aid, formatname, price, spprice, pid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['aid'], "int"),
                       GetSQLValueString(trim($_POST['formatname']), "text"),
					   GetSQLValueString($_POST['price'], "text"),
					   GetSQLValueString($_POST['spprice'], "text"),
					   GetSQLValueString($_POST['pid'], "int"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_ProductItemEdit")) {
	foreach($_POST['pid'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_productspformat SET aid=%s, sortid=%s, indicate=%s, formatname=%s, price=%s, spprice=%s, lang=%s WHERE pid=%s",
						   GetSQLValueString($_POST['aid'][$key], "int"),
						   GetSQLValueString($_POST['sortid'][$key], "int"),
						   GetSQLValueString($_POST['indicate'][$key], "int"),
						   GetSQLValueString(trim($_POST['formatname'][$key]), "text"),
						   GetSQLValueString($_POST['price'][$key], "text"),
						   GetSQLValueString($_POST['spprice'][$key], "text"),
						   GetSQLValueString($_POST['lang'][$key], "text"),
						   GetSQLValueString($_POST['pid'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}
/* 刪除類別項目 */
if ((isset($_POST['deltype'])) && ($_POST['deltype'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productspformat WHERE pid in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordProductListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListItem = $w_userid;
}
$colname_RecordProductListItem = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordProductListItem = $_GET['aid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListItem = sprintf("SELECT * FROM demo_productspformat WHERE aid = %s && userid=%s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductListItem, "text"),GetSQLValueString($coluserid_RecordProductListItem, "int"));
$RecordProductListItem = mysqli_query($DB_Conn, $query_RecordProductListItem) or die(mysqli_error($DB_Conn));
$row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem);
$totalRows_RecordProductListItem = mysqli_num_rows($RecordProductListItem);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />


<div>
    <div>
      
      <?php 
	  switch($_POST['Operate']) 
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料新增成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料修改成功！！','information');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料刪除成功！！','warning');});</script>\n";
			break;
		  default: 
		   switch($_GET['Operate']) 
			  {
				  case "delErrorT":
					//if($_POST['step'] == '2'){
					echo "<div class=\"ErrorTipMessage\">";
					echo "刪除失敗！！該項目下方尚有分類！！";
					echo "</div>\n";
					//}
					break;
				  case "delErrorP":
					//if($_POST['step'] == '2'){
					echo "<div class=\"ErrorTipMessage\">";
					echo "刪除失敗！！此分類尚有資料！！";
					echo "</div>\n";
					//}
					break;	
				  default:
					break;
			  }
		  	break;
	  }
	
	  ?>
       
       
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">商品特殊規格設定 - <?php echo $row_RecordProductListItem['listname']; ?> [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        </tr>
      </table>
      
      
      
      <?php //if ($ManageProductListSelect == '1') { ?>
      <div style="padding:10px; background-color:#F7EFEB; margin-bottom:10px; border:1px #ECDBD3 solid; color:#B37C67; font-weight:bolder;"><i class="fa fa-exclamation-circle"></i> 商品價格會依據所選擇的規格做變動，設定特殊規格後價格會以特殊規格設定為準。</div>
      
	  <?php if ($totalRows_RecordProductListItem > 0) { // Show if recordset not empty ?>
        <form id="form_ProductItemEdit" name="form_ProductItemEdit" method="POST" action="<?php echo $editFormAction; ?>">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                
  <tr>
    <td width="100" align="right">編輯欄位：</td>
    <td width="200"><strong>規格名稱</strong></td>
    <td width="175"><strong>價格</strong></td>
    <td width="175"><strong>特惠價</strong></td>
    <td width="80"><strong>排序</strong></td>
    <td width="250"><strong>狀態(公布:1/隱藏:0)</strong></td>
    <td><strong>操作</strong></td>
  </tr>
<?php $i = 1; ?>
                  <?php do { ?>
                <tr>
                      <td width="100" align="right">項目名稱：</td>
                  <td width="150"><label for="sortid[]"></label>
                    <input name="formatname[]" type="text" id="formatname[]" value="<?php echo $row_RecordProductListItem['formatname']; ?>" maxlength="30" /></td>
                  <td width="75"><label for="formatselect[]"></label>
                  <input name="price[]" type="text" id="price[]" value="<?php echo $row_RecordProductListItem['price']; ?>" maxlength="11" /></td>
                  <td width="75"><input name="spprice[]" type="text" id="spprice[]" value="<?php echo $row_RecordProductListItem['spprice']; ?>" maxlength="11" /></td>
                  <td width="80"><span id="ProductSortid<?php echo $i; ?>">
                  <input name="sortid[]" type="text" id="sortid[]" value="<?php echo $row_RecordProductListItem['sortid']; ?>" size="10" maxlength="10" />
                  <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
                  <td><span id="sprytextfield<?php echo $i; ?>">
                  <input name="indicate[]" type="text" id="indicate[]" value="<?php echo $row_RecordProductListItem['indicate']; ?>" size="10" maxlength="1" />
                  <span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldMinCharsMsg">值必須為0或1。</span><span class="textfieldMaxCharsMsg">值必須為0或1。</span><span class="textfieldMinValueMsg">值必須為0或1。</span><span class="textfieldMaxValueMsg">值必須為0或1。</span></span></td>
                  <td>刪除：
                    <input name="deltype[]" type="checkbox" id="deltype[]" value="<?php echo $row_RecordProductListItem['pid']; ?>" />
                    <label for="deltype[]">
                      <input name="pid[]" type="hidden" id="pid[]" value="<?php echo $row_RecordProductListItem['pid']; ?>" />
                      <input name="aid[]" type="hidden" id="aid[]" value="<?php echo $row_RecordProductListItem['aid']; ?>" />
                      <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordProductListItem['lang']; ?>" />
                      <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
                    </label>
                  <input type="submit" name="button3" id="button3" value="送出修改資料" /></td>
                  </tr><?php $i++; ?>
                    <?php } while ($row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem)); ?>   
			    <tr>
                    <td align="right">&nbsp;</td>
                    <td colspan="6">&nbsp;</td>
                </tr>
				<?php } // Show if recordset not empty ?>
              </table>
              <input type="hidden" name="MM_update" value="form_ProductItemEdit" />
      </form>
        
	  
      
	  <div style="height:5px;"></div>
      <form id="form_ProductItemAdd" name="form_ProductItemAdd" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right">新增欄位：</td>
                  	<td></td>
                  </tr>
                  
                <tr>
                      <td width="100" align="right">項目名稱：</td>
                      <td><span id="ProductItem">
                        <label for="formatname"></label>
                      <input name="formatname" type="text" id="formatname" maxlength="30" />
                      <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
        </tr>
                    
				  <tr>
                    <td align="right">價格：</td>
                    <td><span id="sprytextfield98">
                    <label for="price"></label>
                    <input name="price" type="text" id="price" maxlength="11" />
                    <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldMinValueMsg">輸入的值小於所需的最小值。</span></span></td>
                  </tr>
				  <tr>
				    <td align="right">特惠價：</td>
				    <td><span id="sprytextfield99">
                    <label for="spprice"></label>
                    <input name="spprice" type="text" id="spprice" maxlength="11" />
                    <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldMinValueMsg">輸入的值小於所需的最小值。</span></span></td>
	    </tr>
				  <tr>
				    <td align="right">&nbsp;</td>
				    <td><input type="submit" name="button" id="button" value="送出新增資料" />
                      <input type="reset" name="button2" id="button2" value="重置新增資料" />
                      <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
                      <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                      <input name="Operate2" type="hidden" id="Operate2" value="addSuccess" />
                      <input name="pid" type="hidden" id="pid" value="0" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" /></td>
	    </tr>
				  <tr>
				    <td align="right">&nbsp;</td>
				    <td>&nbsp;</td>
	    </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form_ProductItemAdd" />
      </form>
      <?php //} else {?>
      <?php //} ?>
      
      
  </div>
</div>

<script type="text/javascript">
var sprytextfield0 = new Spry.Widget.ValidationTextField("ProductItem", "none", {validateOn:["blur"]});
<?php for($i=1; $i <= $totalRows_RecordProductListItem; $i++) { ?>
var sprytextfield<?php echo $i; ?> = new Spry.Widget.ValidationTextField("sprytextfield<?php echo $i; ?>", "integer", {validateOn:["blur"], isRequired:false, minChars:1, maxChars:1, minValue:0, maxValue:1});
var sprytextfield1<?php echo $i; ?> = new Spry.Widget.ValidationTextField("ProductSortid<?php echo $i; ?>", "integer", {validateOn:["blur"]});
<?php } ?>
var sprytextfield98 = new Spry.Widget.ValidationTextField("sprytextfield98", "integer", {validateOn:["blur"], minValue:0});
var sprytextfield99 = new Spry.Widget.ValidationTextField("sprytextfield99", "integer", {validateOn:["blur"], minValue:0});
</script>
<?php
mysqli_free_result($RecordProductListItem);
?>
