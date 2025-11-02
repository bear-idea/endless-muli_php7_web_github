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
  $insertSQL = sprintf("INSERT INTO demo_productitem (list_id, itemname, subitem_id, lang) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
					   GetSQLValueString($_POST['subitem_id'], "int"),
                       GetSQLValueString($_POST['lang'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_ProductItemEdit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_productitem SET list_id=%s, sortid=%s, indicate=%s, itemname=%s, lang=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['list_id'][$key], "int"),
						   GetSQLValueString($_POST['sortid'][$key], "int"),
						   GetSQLValueString($_POST['indicate'][$key], "int"),
						   GetSQLValueString(trim($_POST['itemname'][$key]), "text"),
						   GetSQLValueString($_POST['lang'][$key], "text"),
						   GetSQLValueString($_POST['item_id'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}
/* 刪除類別項目 */
if ((isset($_POST['deltype'])) && ($_POST['deltype'] != "")) {
	// 判斷該項目是否有資料
	$MM_flag="MM_update";
		if (isset($_POST[$MM_flag])) {
		foreach($_POST['deltype'] as $key => $val){
		  $MM_dupKeyRedirect="manage_product.php?wshop=" . $wshop . "&Opt=mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&Operate=delErrorP";
		  $loginUsername = $_POST['deltype'][$key];
		  $LoginRS__query = sprintf("SELECT * FROM demo_product WHERE type1=%s", GetSQLValueString($loginUsername, "int")); // 分類
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
		  $loginFoundUser = mysqli_num_rows($LoginRS);
		
		  //if there is a row in the database, the username was found - can not add the requested username		 
		  if($loginFoundUser){
			$MM_qsChar = "?";
			//append the username to the redirect page
			if (substr_count($MM_dupKeyRedirect,"?") >=1) {
				$MM_qsChar = "&";
				$MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
			}
			header ("Location: $MM_dupKeyRedirect");
			ob_end_flush(); // 輸出緩衝區結束
			exit;
		  } // if
		} //foreach
	} //if
	if (isset($_POST[$MM_flag])) {
		foreach($_POST['deltype'] as $key => $val){
		  $MM_dupKeyRedirect="manage_product.php?wshop=" . $wshop . "&Opt=mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&Operate=delErrorT";
		  $loginUsername = $_POST['deltype'][$key];
		  $LoginRS__query = sprintf("SELECT * FROM demo_productitem WHERE subitem_id=%s", GetSQLValueString($loginUsername, "int")); // 分類
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
		  $loginFoundUser = mysqli_num_rows($LoginRS);
	
		  //if there is a row in the database, the username was found - can not add the requested username		 
		  if($loginFoundUser){
			$MM_qsChar = "?";
			//append the username to the redirect page
			if (substr_count($MM_dupKeyRedirect,"?") >=1) {
				$MM_qsChar = "&";
				$MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
			}
			header ("Location: $MM_dupKeyRedirect");
			ob_end_flush(); // 輸出緩衝區結束
			exit;
		  } // if
		} //foreach
	} //if
	//$MM_flag="MM_update";
  $deleteSQL = sprintf("DELETE FROM demo_productitem WHERE item_id in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$collang_RecordProductListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductListItem = $_GET['lang'];
}
$collistid_RecordProductListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordProductListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListItem = sprintf("SELECT demo_productitem.item_id, demo_productlist.list_id, demo_productlist.listname, demo_productitem.itemname, demo_productitem.sortid, demo_productitem.indicate, demo_productitem.lang FROM demo_productlist LEFT OUTER JOIN demo_productitem ON demo_productlist.list_id = demo_productitem.list_id WHERE demo_productlist.list_id = %s && demo_productitem.lang=%s && demo_productitem.level=0 ORDER BY  demo_productitem.sortid ASC, demo_productitem.item_id DESC", GetSQLValueString($collistid_RecordProductListItem, "int"),GetSQLValueString($collang_RecordProductListItem, "text"));
$RecordProductListItem = mysqli_query($DB_Conn, $query_RecordProductListItem) or die(mysqli_error($DB_Conn));
$row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem);
$totalRows_RecordProductListItem = mysqli_num_rows($RecordProductListItem);$collang_RecordProductListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductListItem = $_GET['lang'];
}
$coluserid_RecordProductListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListItem = $w_userid;
}
$collistid_RecordProductListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordProductListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListItem = sprintf("SELECT demo_productitem.item_id, demo_productitem.userid, demo_productlist.list_id, demo_productlist.listname, demo_productitem.itemname, demo_productitem.sortid, demo_productitem.indicate, demo_productitem.lang FROM demo_productlist LEFT OUTER JOIN demo_productitem ON demo_productlist.list_id = demo_productitem.list_id WHERE demo_productlist.list_id = %s && demo_productitem.lang=%s && demo_productitem.level=0 && demo_productitem.userid=%s ORDER BY demo_productitem.sortid ASC, demo_productitem.item_id DESC", GetSQLValueString($collistid_RecordProductListItem, "int"),GetSQLValueString($collang_RecordProductListItem, "text"),GetSQLValueString($coluserid_RecordProductListItem, "int"));
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
            <td><h5><strong><font color="#756b5b">次分類設定 - <?php echo $row_RecordProductListItem['listname']; ?> [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        </tr>
      </table>
      
      
      
      <?php if ($ManageProductListSelect == '1') { ?>
        <form id="form_ProductItemEdit" name="form_ProductItemEdit" method="POST" action="<?php echo $editFormAction; ?>">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right">編輯欄位：</td>
                  	<td width="300"><strong>分類</strong></td>
                  	<td width="80"><strong>排序</strong></td>
                  	<td width="250"><strong>狀態(公布:1/隱藏:0)</strong></td>
                  	<td><strong>操作</strong></td>
                  </tr><?php $i = 1; ?>
                  <?php do { ?>
                <tr>
                      <td width="100" align="right">項目名稱：</td>
                  <td width="300"><label for="sortid[]"></label>
                    <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordProductListItem['itemname']; ?>" maxlength="30" /></td>
                  <td width="80"><input name="sortid[]" type="text" id="sortid[]" value="<?php echo $row_RecordProductListItem['sortid']; ?>" size="10" maxlength="10" /></td>
                  <td><span id="sprytextfield<?php echo $i; ?>">
                  <input name="indicate[]" type="text" id="indicate[]" value="<?php echo $row_RecordProductListItem['indicate']; ?>" size="10" maxlength="1" />
                  <span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldMinCharsMsg">值必須為0或1。</span><span class="textfieldMaxCharsMsg">值必須為0或1。</span><span class="textfieldMinValueMsg">值必須為0或1。</span><span class="textfieldMaxValueMsg">值必須為0或1。</span></span></td>
                  <td>刪除：
                    <input name="deltype[]" type="checkbox" id="deltype[]" value="<?php echo $row_RecordProductListItem['item_id']; ?>" />
                    <label for="deltype[]">
                      <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordProductListItem['item_id']; ?>" />
                      <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordProductListItem['list_id']; ?>" />
                      <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordProductListItem['lang']; ?>" />
                      <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
                    </label>
                  <input type="submit" name="button3" id="button3" value="送出修改資料" /></td>
                  </tr><?php $i++; ?>
                    <?php } while ($row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem)); ?>
			    <tr>
                    <td align="right">&nbsp;</td>
                    <td colspan="4">&nbsp;</td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form_ProductItemEdit" />
      </form>
        
	  
      
	  
      <form id="form_ProductItemAdd" name="form_ProductItemAdd" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right">新增欄位：</td>
                  	<td></td>
                  </tr>
                  
                <tr>
                      <td width="100" align="right">項目名稱：</td>
                      <td><span id="ProductItem">
                        <label for="itemname"></label>
                      <input name="itemname" type="text" id="itemname" maxlength="30" />
                      <span class="textfieldRequiredMsg">欄位不可為空。</span></span>                        
                      <input type="submit" name="button" id="button" value="送出新增資料" />
                      <input type="reset" name="button2" id="button2" value="重置新增資料" />
                  <input name="list_id" type="hidden" id="list_id" value="<?php echo $_GET['list_id']; ?>" />
                  <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                  <input name="Operate" type="hidden" id="Operate" value="addSuccess" />
                  <input name="subitem_id" type="hidden" id="subitem_id" value="0" /></td>
        </tr>
                    
				  <tr>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form_ProductItemAdd" />
      </form>
      <?php } else {?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><font color="#FF0000">您未擁有編輯此區塊的權限！！</font></td>
        </tr>
      </table>
      <?php } ?>
      
      
  </div>
</div>

<script type="text/javascript">
var sprytextfield0 = new Spry.Widget.ValidationTextField("ProductItem", "none", {validateOn:["blur"]});
<?php for($i=1; $i <= $totalRows_RecordProductListItem; $i++) { ?>
var sprytextfield<?php echo $i; ?> = new Spry.Widget.ValidationTextField("sprytextfield<?php echo $i; ?>", "integer", {validateOn:["blur"], isRequired:false, minChars:1, maxChars:1, minValue:0, maxValue:1});
<?php } ?>
</script>
<?php
mysqli_free_result($RecordProductListItem);
?>
