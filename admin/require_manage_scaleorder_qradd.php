<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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



$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE userid=%s ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ($_GET['d1'] != "" || $_GET['d2'] != "" || $_GET['d3'] != "" || $_GET['d4'] != "" || $_GET['d5'] != "" || $_GET['d6'] != "" || $_GET['d7'] != "") {
	// manage_scaleorder.php?Opt_Scaleorder=qradd&qr=1&d2=廠區&d3=總重&d4=扣重&d5=產品編號&d6=日期&d7=時間&d1=產品
	
	
	$postdate = $_GET['d6'] . " " . $_GET['d7'];
	
	// 判斷是否重覆
	$coluserid_RecordOrderCheck = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordOrderCheck = $w_userid;
	}
	
	$colpostdate_RecordScaleorder = $postdate;
	/*if (isset($_GET['d8'])) {
	  $colnum_RecordScaleorder = $_GET['d8'];
	}*/
	$colnum_RecordScaleorder = $_GET['d8'];

	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordOrderCheck = sprintf("SELECT * FROM erp_scaleorderindetail WHERE userid=%s && postdate=%s && num=%s",GetSQLValueString($coluserid_RecordOrderCheck, "int"),GetSQLValueString($colpostdate_RecordScaleorder, "text"),GetSQLValueString($colnum_RecordScaleorder, "text"));
	$RecordOrderCheck = mysqli_query($DB_Conn, $query_RecordOrderCheck) or die(mysqli_error($DB_Conn));
	$row_RecordOrderCheck = mysqli_fetch_assoc($RecordOrderCheck);
	$totalRows_RecordOrderCheck = mysqli_num_rows($RecordOrderCheck);
	
	
	if($totalRows_RecordOrderCheck > 0) {
		
		//echo "<h1 style=\"font-size:60px; color:red\">重複輸入!!!!!!!!!!!!<h1>";
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> QRcode入庫 <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 物料檢視</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
  <?php if ($row_RecordOrderCheck['bound'] == 'in') { ?>
  <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前此物料已經入庫。</b></div>
  <?php } ?>
  
  <?php if ($row_RecordOrderCheck['bound'] == 'out') { ?>
  <div class="alert alert-warning m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前此物料已經出庫。</b></div>
  <?php } ?>
  
  <div class="table-responsive">
								<table class="table table-striped m-b-0">
									<tbody>
										<tr>
                                            <td align="right" width="200">資料庫ID：</td>
                                        <td><?php echo $row_RecordOrderCheck['id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">時間：</td>
                                          <td><?php echo $row_RecordOrderCheck['postdate']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">地磅流水號：</td>
                                          <td><?php echo $row_RecordOrderCheck['num']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">倉庫：</td>
                                          <td><?php echo $row_RecordOrderCheck['warehouse']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">狀態：</td>
                                          <td><?php if($row_RecordOrderCheck['bound']=='in'){echo "可出庫";} ?><?php if($row_RecordOrderCheck['bound']=='out'){echo "已出庫";} ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">物料：</td>
                                          <td><?php echo $row_RecordOrderCheck['title']; ?></td>
                                        </tr>
                                          <tr>
                                            <td align="right">總重：</td>
                                            <td><?php echo $row_RecordOrderCheck['Totalweight']; ?></td>
                                          </tr>
                                          <tr>
                                            <td align="right">扣重：</td>
                                          <td><?php echo $row_RecordOrderCheck['Minweight']; ?></td>
                                          </tr>
                                          <tr>
                                            <td align="right">淨重：</td>
                                          <td><?php echo $row_RecordOrderCheck['Oriweight']; ?></td>
                                          </tr>
                                         
                                          
                                        <tr>
                                            <td align="right">備註：</td>
                                            <td><?php echo $row_RecordOrderCheck['notes1']; ?></td>
                                        </tr>
                                                            </tbody>
                                       </table>
	</div>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->


<?php 		
	
		
	}else{
		
		
		
		
		
//////////////////////////////////////////////////////////	


// 取得分類

$colname_RecordScaleGetCodeType = "-1";
if (isset($_GET['d5'])) {
  $colname_RecordScaleGetCodeType = $_GET['d5'];
}
$coluserid_RecordScaleGetCodeType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleGetCodeType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleGetCodeType = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScaleGetCodeType, "text"),GetSQLValueString($coluserid_RecordScaleGetCodeType, "int"));
$RecordScaleGetCodeType = mysqli_query($DB_Conn, $query_RecordScaleGetCodeType) or die(mysqli_error($DB_Conn));
$row_RecordScaleGetCodeType = mysqli_fetch_assoc($RecordScaleGetCodeType);
$totalRows_RecordScaleGetCodeType = mysqli_num_rows($RecordScaleGetCodeType);



$collang_RecordScaleViewLine_l1 = "zh-tw";
if (isset($_POST['lang'])) {
  $collang_RecordScaleViewLine_l1 = "zh-tw";
}
$coluserid_RecordScaleViewLine_l1 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleViewLine_l1 = $w_userid;
}
$colitemid_RecordScaleViewLine_l1 = "-1";
if (isset($row_RecordScaleGetCodeType['type1'])) {
  $colitemid_RecordScaleViewLine_l1 = $row_RecordScaleGetCodeType['type1'];
}

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleViewLine_l1 = sprintf("SELECT * FROM erp_scaleitem WHERE item_id = %s && list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colitemid_RecordScaleViewLine_l1, "text"), GetSQLValueString($collang_RecordScaleViewLine_l1, "text"),GetSQLValueString($coluserid_RecordScaleViewLine_l1, "int"));
$RecordScaleViewLine_l1 = mysqli_query($DB_Conn, $query_RecordScaleViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
$totalRows_RecordScaleViewLine_l1 = mysqli_num_rows($RecordScaleViewLine_l1);


///////////////////////////////////////////////////////////


	
	
	// manage_scaleorder.php?Opt_Scaleorder=qradd&qr=1&d2=廠區&d3=總重&d4=扣重&d5=產品編號&d6=日期&d7=時間&d1=產品
  $insertSQL = sprintf("INSERT INTO erp_scaleorderindetail (title, code, author, type, warehouse, Totalweight, Minweight, Oriweight, postdate, notes1, notes2, num, people, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['d1'], "text"),
					   GetSQLValueString($_GET['d5'], "text"),
					   GetSQLValueString($row_RecordAccount['truename'], "text"),
					   GetSQLValueString($row_RecordScaleViewLine_l1['itemname'], "text"),
                       GetSQLValueString($_GET['d2'], "text"),
                       GetSQLValueString($_GET['d3'], "text"),
                       GetSQLValueString($_GET['d4'], "text"),
                       GetSQLValueString($_GET['d3']-$_GET['d4'], "text"),
					   GetSQLValueString($postdate, "date"),
                       GetSQLValueString($_GET['d10'], "text"),
					   GetSQLValueString($_GET['d11'], "text"),
					   GetSQLValueString($_GET['d8'], "text"),
					   GetSQLValueString($_GET['d9'], "text"),
					   GetSQLValueString('zh-tw', "text"),
                       GetSQLValueString($w_userid, "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
 
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_scaleorder_in.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
	}
	
	
}else{
	
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> QRcode入庫 <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 物料檢視</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">

  <div class="alert alert-warning m-t-0 m-b-0"><i class="fa fa-info-circle"></i> <b>輸入資料錯誤或未完整。</b></div>
  
        
        <div class="table-responsive">
								<table class="table table-striped m-b-0 m-t-10">
									<tbody>
										<tr>
                                            <td align="right" width="200">QRcode URL：</td>
                                        <td><?php echo $SiteFileUrl . "/manage_scaleorder.php?Opt=qradd&d1=產品&d2=廠區&d3=總重&d4=扣重&d5=產品編號&d6=日期&d7=時間&d8=地磅流水號&d9=過磅人員&d10=備用欄位&d11=備用欄位&d12=系統編號&d13=上傳圖片檔名&d14=上傳圖片檔名&d15=登入人員"; ?></td>
                                        </tr>
										
                                                            </tbody>
                                       </table>
                                       
                                       
                                       <table class="table table-bordered m-b-0 m-t-10">
                                       <thead>
                                          <tr>
                                              <th width="1%">代號</th>
                                              <th width="200">標題</th>
                                              <th>範例</th>
                                          </tr>
                                      </thead>
									<tbody>
										
										<tr>
                                          <td>d1</td>
										  <td>產品</td>
										  <td>PET白(PET脆盤無膠) </td>
									  </tr>
										<tr>
                                          <td>d2</td>
										  <td>廠區</td>
										  <td>友達台中廠 </td>
									  </tr>
										<tr>
                                          <td>d3</td>
										  <td>總重</td>
										  <td> 142</td>
									  </tr>
										<tr>
                                        <td>d4</td>
										  <td>扣重</td>
										  <td>10 </td>
									  </tr>
										<tr>
                                        <td>d5</td>
										  <td>產品編號</td>
										  <td> R-02027 </td>
									  </tr>
										<tr>
                                        <td>d6</td>
										  <td>日期</td>
										  <td>2018-06-04 </td>
									  </tr>
										<tr>
                                        <td>d7</td>
										  <td>時間</td>
										  <td>11:23:00 </td>
									  </tr>
										<tr>
                                        <td>d8</td>
										  <td>地磅流水號</td>
										  <td>219 </td>
									  </tr>
										<tr>
                                        <td>d9</td>
										  <td>過磅人員</td>
										  <td>楊過 </td>
									  </tr>
										<tr>
                                        <td>d10</td>
										  <td>備用欄位</td>
										  <td>&nbsp;</td>
									  </tr>
										<tr>
                                        <td>d11</td>
										  <td>備用欄位</td>
										  <td>&nbsp;</td>
									  </tr>
										<tr>
                                        <td>d12</td>
										  <td>備用欄位</td>
										  <td>&nbsp;</td>
									  </tr>
										<tr>
                                        <td>d13</td>
										  <td>備用欄位</td>
										  <td>&nbsp;</td>
									  </tr>
										<tr>
                                        <td>d14</td>
										  <td>備用欄位</td>
										  <td>&nbsp;</td>
									  </tr>
                                                            </tbody>
                                       </table>
	</div>
    
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
<?php } ?>