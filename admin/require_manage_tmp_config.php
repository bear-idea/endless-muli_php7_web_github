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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting SET ManageTmpSearchSelect=%s, ManageTmpBatchDeleteSelect=%s, ManageTmpEditorSelect=%s, ManageTmpListSelect=%s WHERE id=%s",
                       GetSQLValueString($_POST['ManageTmpSearchSelect'], "int"),
                       GetSQLValueString($_POST['ManageTmpBatchDeleteSelect'], "int"),
                       GetSQLValueString($_POST['ManageTmpEditorSelect'], "int"),
                       GetSQLValueString($_POST['ManageTmpListSelect'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSystemConfig = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSystemConfig = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfig = sprintf("SELECT * FROM demo_setting WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfig, "int"));
$RecordSystemConfig = mysqli_query($DB_Conn, $query_RecordSystemConfig) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfig = mysqli_fetch_assoc($RecordSystemConfig);
$totalRows_RecordSystemConfig = mysqli_num_rows($RecordSystemConfig);
?>

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
				break;
	 		 }
		  	break;
	  }
	  
	  ?>
       
      
      
     
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">後台參數設定</font></strong></h5></td>
        </tr>
      </table>
      <br />
      
      <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">  
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01_hover">
        <tr>
          <td width="150" align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong>樣板選擇：</strong></td>
          <td width="500">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">搜索功能：</td>
          <td><p>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpSearchSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpSearchSelect" value="1" id="ManageTmpSearchSelect_0" />
              開啟</label>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpSearchSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpSearchSelect" value="0" id="ManageTmpSearchSelect_1" />
              關閉</label>
          </p></td>
          <td><font color="#999999">&raquo;頁面上是否有搜索功能工具</font></td>
        </tr>
        <tr>
          <td align="right">多筆刪除：</td>
          <td><p>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpBatchDeleteSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpBatchDeleteSelect" value="1" id="ManageTmpBatchDeleteSelect_0" />
              開啟</label>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpBatchDeleteSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpBatchDeleteSelect" value="0" id="ManageTmpBatchDeleteSelect_1" />
              關閉</label>
          </p></td>
          <td><font color="#999999">&raquo;是否可以同時刪除多筆資料</font></td>
        </tr>
        <tr>
          <td align="right">編輯器：</td>
          <td><p>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpEditorSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpEditorSelect" value="0" id="ManageTmpEditorSelect_0" />
              無編輯器</label>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpEditorSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpEditorSelect" value="1" id="ManageTmpEditorSelect_1" />
              進階編輯器</label>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpEditorSelect'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpEditorSelect" value="2" id="ManageTmpEditorSelect_2" />
              基本編輯器</label>
          </p></td>
          <td><font color="#999999">&raquo;設定內容之編輯器，進階編輯器則包含上傳(圖片、檔案)之功能</font></td>
        </tr>
        <tr>
          <td align="right">清單列表：</td>
          <td><p>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpListSelect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpListSelect" value="1" id="ManageTmpListSelect_0" />
              開啟</label>
            <label>
              <input <?php if (!(strcmp($row_RecordSystemConfig['ManageTmpListSelect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="ManageTmpListSelect" value="0" id="ManageTmpListSelect_1" />
              關閉</label>
          </p></td>
          <td><font color="#999999">&raquo;可自訂下拉選單內容</font></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="更新參數" />
          <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSystemConfig['id']; ?>" /></td>
          <td>&nbsp;</td>
        </tr>  
      </table>
      <input type="hidden" name="MM_update" value="form1" />
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

<?php
mysqli_free_result($RecordSystemConfig);
?>
