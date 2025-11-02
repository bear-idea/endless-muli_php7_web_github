<?php
	//initialize the session
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	switch($_GET['lang'])
	{
		case "zh-tw":
			$_SESSION['lang'] = $_GET['lang'];
			break;
		case "zh-cn":
			$_SESSION['lang'] = $_GET['lang'];
			break;
		case "en":
			$_SESSION['lang'] = $_GET['lang'];
			break;	
		case "jp":
			$_SESSION['lang'] = $_GET['lang'];
			break;
		case "kr":
			$_SESSION['lang'] = $_GET['lang'];
			break;
		case "sp":
			$_SESSION['lang'] = $_GET['lang'];
			break;	
		default:
			$_SESSION['lang'] = $defaultlang;
	}
 ?>
    <script type="text/javascript" src="js/jquery.ddslick.min.js"></script>
<script type="text/javascript">
	$(function(){
		// 下拉選單的資料來源
		var ddData = [
    {
        text: "Facebook",
        value: 1,
        selected: false,
        //description: "Description with Facebook",
        imageSrc: "http://dl.dropbox.com/u/40036711/Images/facebook-icon-32.png"
    },
    {
        text: "Twitter",
        value: 2,
        selected: false,
        //description: "Description with Twitter",
        imageSrc: "http://dl.dropbox.com/u/40036711/Images/twitter-icon-32.png"
    },
    {
        text: "LinkedIn",
        value: 3,
        selected: true,
        //description: "Description with LinkedIn",
        imageSrc: "http://dl.dropbox.com/u/40036711/Images/linkedin-icon-32.png"
    },
    {
        text: "Foursquare",
        value: 4,
        selected: false,
        //description: "Description with Foursquare",
        imageSrc: "http://dl.dropbox.com/u/40036711/Images/foursquare-icon-32.png"
    }
];
 
		// 把 #myDropdown 轉換成 ddslick 下拉選單
		$('#LangMenu').ddslick({
			data: ddData,
			width: 300,
			selectText: '請選擇你最常用的社交工具'
		});
	});
</script>
<div id="LangMenu"></div>


