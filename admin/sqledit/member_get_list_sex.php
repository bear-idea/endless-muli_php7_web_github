<?php
switch($_SESSION['lang'])
{
	case "zh-tw":
		$array['男'] =  '男'; 
 		$array['女'] =  '女';	
		break;
	case "zh-cn":
		$array['男'] =  '男'; 
 		$array['女'] =  '女';
		break;
	case "en":
		$array['男'] =  'M'; 
 		$array['女'] =  'F';
		break;
	case "jp":
		$array['男'] =  '男性'; 
 		$array['女'] =  '女性';
		break;
	default:
		$array['男'] =  '男'; 
 		$array['女'] =  '女';
		break;
}
 print json_encode($array);
?>

