<?php require_once('../Connections/DB_Conn.php'); ?>
<?php include_once('colorsofimage.class.php');; ?>
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

function hex2rgb($hexColor){
	$color=str_replace('#','',$hexColor);
	if (strlen($color)> 3){
		$rgb=array(
			'r'=>hexdec(substr($color,0,2)),
			'g'=>hexdec(substr($color,2,2)),
			'b'=>hexdec(substr($color,4,2))
		);
	}else{
		$color=str_replace('#','',$hexColor);
		$r=substr($color,0,1). substr($color,0,1);
		$g=substr($color,1,1). substr($color,1,1);
		$b=substr($color,2,1). substr($color,2,1);
		$rgb=array( 
			'r'=>hexdec($r),
			'g'=>hexdec($g),
			'b'=>hexdec($b)
		);
	}
	return $rgb;
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpMainMenu")) {
	
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordTmpMainMenu = "SELECT * FROM demo_tmpmainmenu ORDER BY id DESC";
  $RecordTmpMainMenu = mysqli_query($DB_Conn, $query_RecordTmpMainMenu) or die(mysqli_error($DB_Conn));
  $row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainMenu);
  $totalRows_RecordTmpMainMenu = mysqli_num_rows($RecordTmpMainMenu);
  
  if ($totalRows_RecordTmpMainMenu > 0) {
	  
	  do
	  {
		  if( is_file($path.'/'.$filename) )
          {
			  $image = $SiteImgUrlAdmin . $row_RecordTmpMainMenu['webname'] . "/image/tmpmainmenu/" . $row_RecordTmpMainMenu['tmp_mainmenu_img'];
			  $colors_of_image = new ColorsOfImage($image);
			  //$colors_of_image->$maxnumcolors = 1;
			  $colors = $colors_of_image->getProminentColors();
			  
			  foreach ( $colors as $color ){
				$color_rgb = $color; 
			  }
			  
			  $color_rgbx =  hex2rgb($color_rgb);
			  
			  echo $updateSQL = sprintf("UPDATE demo_tmpmainmenu SET color_r=%s, color_g=%s, color_b=%s WHERE id=%s",
								   GetSQLValueString($color_rgbx['r'], "text"),
								   GetSQLValueString($color_rgbx['g'], "text"),
								   GetSQLValueString($color_rgbx['b'], "text"),
								   GetSQLValueString($row_RecordTmpMainMenu['id'], "int"));
			
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn)); 
			  //echo "檔案存在!";
          }else{
			  echo "檔案不存在!";
          }
	  } while ($row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainMenu));
  
  }
  
  
}
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
            <td><h5><strong><font color="#756b5b">顏色抓取</font></strong></h5></td>
        </tr>
      </table>
      <br />
      
      <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
      <form id="form_TmpMainMenu" name="form_TmpMainMenu" method="POST" action="<?php echo $editFormAction; ?>">  
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01_hover">
        <tr>
          <td width="150" align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong>顏色抓取：</strong></td>
          <td width="500">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">主選單：</td>
          <td><input type="submit" name="button" id="button" value="取得圖片主色系" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input name="id" type="hidden" id="id" value="<?php echo $row_RecordSystemConfig['id']; ?>" /></td>
          <td>&nbsp;</td>
        </tr>  
      </table>
      <input type="hidden" name="MM_update" value="form_TmpMainMenu" />
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
//mysqli_free_result($RecordTmpMainMenu);
?>
