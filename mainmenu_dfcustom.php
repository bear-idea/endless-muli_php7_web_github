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
?>
<?php
switch($MSTMP)
{
	case "userdefault":
		echo "<link href=\"". $TplCssPath ."/mega_menu_styles/skins/" . $TmpDFMenuColor . ".css\" rel=\"stylesheet\" type=\"text/css\" />";
		break;		
	default:
?>
<link href="css/mega_menu_styles/skins/white.css" rel="stylesheet" type="text/css" />
<?php
		break;
}
?>
<script type='text/javascript' src='js/mega_menu_styles/jquery.dcmegamenu.1.3.3.min.js'></script>
<div class="<?php echo $TmpDFMenuColor; ?>" >  
<ul id="mega-menu-3" class="mega-menu">
    <?php require("mainmenu_dftype.php"); ?>
</ul>
</div>
<script type="text/javascript">
$(function($){
	$('#mega-menu-3').dcMegaMenu({    
		 rowItems: 3,                  // Number of sub-menus in each row        
		 speed: 'fast',  // Speed of drop down animation // speed,slow       
	     effect: 'fade',  // Type of drop down animation - 'slide' or 'fade'        
	     event: 'hover', // Use either 'hover' or 'click'        
		 fullWidth: false  // Set to true to always show sub-menus at 100% 
	});
});
</script>