<?php require_once('Connections/DB_Conn.php'); ?>
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

$colname_RecordDfTypeMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDfTypeMultiTopMenu_l1 = $_GET['lang'];
}
$coluserid_RecordDfTypeMultiTopMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDfTypeMultiTopMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfTypeMultiTopMenu_l1 = sprintf("SELECT * FROM demo_dftype WHERE lang = %s && indicate=1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colname_RecordDfTypeMultiTopMenu_l1, "text"),GetSQLValueString($coluserid_RecordDfTypeMultiTopMenu_l1, "int"));
$RecordDfTypeMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordDfTypeMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfTypeMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiTopMenu_l1);
$totalRows_RecordDfTypeMultiTopMenu_l1 = mysqli_num_rows($RecordDfTypeMultiTopMenu_l1);
?>
<?php do { ?>
<?php if ($Tp_Page == $row_RecordDfTypeMultiTopMenu_l1['typemenu']) { $SubMenuName=$row_RecordDfTypeMultiTopMenu_l1['title'];} // 用主選單名稱取代子選單 ?>
<li>
<?php if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Link') { ?>
<a href="<?php echo $row_RecordDfTypeMultiTopMenu_l1['link']; ?>" <?php if ($_GET['aid'] == $row_RecordDfTypeMultiTopMenu_l1['id']) { ?>class="mactive"<?php } ?> target="_blank"><?php echo $row_RecordDfTypeMultiTopMenu_l1['title']; ?></a>
<?php } else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Cart'){ ?>
<a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>" <?php if ($Tp_Page == $row_RecordDfTypeMultiTopMenu_l1['typemenu']) { ?>class="mactive"<?php } ?>><?php if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] != "" && isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) && count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'])) { ?><div id="cart_counter"><?php $Cart_Counter=0; $j=0; ?><?php foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) {/*購物車檢視畫面*/if(isset($_POST['Modify']) && $_GET['Opt'] == 'showpage'){$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]=$_POST['Modify'][$j];$j++;}/*\購物車檢視畫面*/$Cart_Counter += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];} ?><?php echo $Cart_Counter; ?></div><?php } ?><?php echo $row_RecordDfTypeMultiTopMenu_l1['title']; ?></a>
<?php } else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'LinkPage'){ ?>
<a href="<?php echo $row_RecordDfTypeMultiTopMenu_l1['link']; ?>" <?php if ($_GET['aid'] == $row_RecordDfTypeMultiTopMenu_l1['id']) { ?>class="mactive"<?php } ?>><?php echo $row_RecordDfTypeMultiTopMenu_l1['title']; ?></a>
<?php } else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Home'){ ?>
  <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" <?php if ($Tp_Page == $row_RecordDfTypeMultiTopMenu_l1['typemenu']) { ?>class="mactive"<?php } ?>><?php echo $row_RecordDfTypeMultiTopMenu_l1['title']; ?></a>
<?php } else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'DfPage' || $row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'DfType'){ ?>
<a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','aid'=>$row_RecordDfTypeMultiTopMenu_l1['id']),'',$UrlWriteEnable);?>" <?php if ($_GET['aid'] == $row_RecordDfTypeMultiTopMenu_l1['id']) { ?>class="mactive"<?php } ?>><?php echo $row_RecordDfTypeMultiTopMenu_l1['title']; ?></a>
<?php } else { ?>
<a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>" <?php if ($Tp_Page == $row_RecordDfTypeMultiTopMenu_l1['typemenu']) { ?>class="mactive"<?php } ?>><?php echo $row_RecordDfTypeMultiTopMenu_l1['title']; ?></a>
<?php } ?>
<?php if($TmpSubMainmenuIndicate == "1") {require("mainmenu_dfpage.php");} ?>
</li>
<?php } while ($row_RecordDfTypeMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiTopMenu_l1)); ?>
<?php
mysqli_free_result($RecordDfTypeMultiTopMenu_l1);
?>