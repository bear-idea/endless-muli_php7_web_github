<?php 
if ($totalRows_RecordAds > 0) {    
	  switch($row_RecordAds['modstyle'])
	  {
		  case "0":
			  include($TplPath . "/banner_mod1.php");		
			  break;
		  case "1":
			  include($TplPath . "/banner_mod2.php");		
			  break;
		  default:
			  include($TplPath . "/banner_mod_default.php");
			  break;
	  }     
}
?>