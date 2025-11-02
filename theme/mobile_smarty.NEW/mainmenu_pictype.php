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
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
<?php $TopMainMenuCount = 0; // 圖片放置於 images -> 語系 須為png?>
	<td><img src="images/<?php echo $_SESSION['lang']; ?>/<?php echo $TmpPicMenu_Style; ?>/topmainmenu_l.png" /></td>
<?php do { ?>
    <td><a href="dfpage.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=<?php echo $row_RecordDfTypeMultiTopMenu_l1['typemenu']; ?>&amp;lang=<?php echo $_SESSION['lang'] ?>&amp;aid=<?php echo $row_RecordDfTypeMultiTopMenu_l1['id']; ?>" title="<?php echo $row_RecordDfTypeMultiTopMenu_l1['title']; ?>" onmouseover="MM_swapImage('MainMenuHoverPic<?php echo $TopMainMenuCount; ?>','','images/<?php echo $_SESSION['lang']; ?>/<?php echo $TmpPicMenu_Style; ?>/<?php echo $row_RecordDfTypeMultiTopMenu_l1['typemenu']; ?>_o.png',0)" onmouseout="MM_swapImgRestore()"><img src="images/<?php echo $_SESSION['lang']; ?>/<?php echo $TmpPicMenu_Style; ?>/<?php echo $row_RecordDfTypeMultiTopMenu_l1['typemenu']; ?>.png" name="MainMenuHoverPic<?php echo $TopMainMenuCount; ?>" border="0" id="MainMenuHoverPic<?php echo $TopMainMenuCount; ?>" /></a></td>
<?php $TopMainMenuCount++; ?>
<?php if ($TopMainMenuCount > 5) break; // 最多6個選單?>
<?php } while ($row_RecordDfTypeMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiTopMenu_l1)); ?>
    <td><img src="images/<?php echo $_SESSION['lang']; ?>/<?php echo $TmpPicMenu_Style; ?>/topmainmenu_r.png" /></td>
  </tr>
</table>
<?php
mysqli_free_result($RecordDfTypeMultiTopMenu_l1);
?>
