<?php
function dbcconv($text , $encode=1){
	if($encode == 0)
	{
		require_once("../inc/dbcconv_cht.php");
	}
	elseif($encode ==1)
	{
		require_once("../inc/dbcconv_chs.php");
	}

	$tmp = '';
	$textLength = strlen($text);
	for ($i = 0; $i < $textLength; $i++) {
		if ($i + 3 > $textLength) {
			$tmp .= substr($text, $i, 1);
		} else {
			$str = substr($text, $i, 3);
			if (dbcconv_isChinese($str)) {
				$tmp .= $data[dbcconv_id($str)];
				$i = $i + 2;
			} else {
				$tmp .= substr($text, $i, 1);
			}
		}
	}
	return $tmp;
}

function dbcconv_id($str) {
	$tmp = 0;
	if (strlen($str) === 3) {
		$tmp = ((ord($str[0]) - 228) * 4096) + ((ord($str[1]) - 184) * 64) + (ord($str[2]) - 128);
	}
	return $tmp;
}

function dbcconv_isChinese($str) {
	$id = dbcconv_id($str);
	if ($id <= 20901 && $id >= 0) {
		return true;
	} else {
		return false;
	}
}
?>