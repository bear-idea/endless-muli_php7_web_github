<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script><script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>

<title>无标题文档</title>
<style>
/*文章分页*/
#page_break {
	
}
#page_break .collapse {
	display: none;
}
#page_break .num {
	padding: 10px 0;
	text-align: center;
}
#page_break .num li{
	display: inline;
	margin: 0 2px;
	padding: 3px 5px;
	border: 1px solid #FF7300;
	background-color: #fff;
	
	color: #FF7300;
	text-align: center;
	cursor: pointer;
	font-family: Arial;
	font-size: 12px;
	overflow: hidden;
}
#page_break .num li.on{
	background-color: #FF7300;
	
	color: #fff;
	font-weight: bold;
}
</style>
<script type="text/javascript">
<!--
	$(document).ready(function(){
		$('#page_break .num li:first').addClass('on');
		
		$('#page_break .num li').click(function(){
			//隐藏所有页内容
			$("#page_break div[id^='page_']").hide();
				
			//显示当前页内容。
			if ($(this).hasClass('on')) {
				$('#page_break #page_' + $(this).text()).show();			
			} else {
				$('#page_break .num li').removeClass('on');
				$(this).addClass('on');
				$('#page_break #page_' + $(this).text()).fadeIn('normal');
			}
		});
	});
//-->
</script>
</head>

<body>
<?php
/***********FCKEditor分页处理*********/
function pageBreak($content)
{
	//把文章内容按照<div style="page-break-after: always"><span style="display: none">&nbsp;</span></div>分割成数组
	$content  = $content;
	$pattern  = "/<div style=\"page-break-after: always\"><span style=\"display: none\">&nbsp;<\/span><\/div>/";
	$strSplit = preg_split($pattern, $content, -1, PREG_SPLIT_NO_EMPTY); //将文章内容分割成数组
	$count    = count($strSplit);   //分割后的数组单元数目
	$outStr   = ""; //返回的字串
	$i        = 1;
	
	if ($count > 1 ) {
		$outStr   = "<div id='page_break'>";
		foreach($strSplit as $value) {
			if ($i <= 1) {
				$outStr .= "<div id='page_$i'>$value</div>";
			} else {
				$outStr .= "<div id='page_$i' class='collapse'>$value</div>";
			}
			$i++;
		}
		
		$outStr .= "<div class='num'>";
		for ($i = 1; $i <= $count; $i++) {
			$outStr .= "<li>$i</li>";
		}
		$outStr .= "</div></div>";
		return $outStr;
	} else {
		return $content;
	}
}
$content = '1<div style="page-break-after: always"><span style="display: none">&nbsp;</span></div>2<div style="page-break-after: always"><span style="display: none">&nbsp;</span></div>3<div style="page-break-after: always"><span style="display: none">&nbsp;</span></div>4<div style="page-break-after: always"><span style="display: none">&nbsp;</span></div>5';
echo  pageBreak($content);
?>
</body>
</html>