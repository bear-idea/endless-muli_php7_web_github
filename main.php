<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head> 
<meta name="keywords" content="<?php echo $Title_Keyword; ?>" />
<meta name="DESCRIPTION" content="<?php echo $Title_Desc; ?>" />
<meta name ="author" content="富視網科技網頁設計" /> 
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" /> 
<meta name="publisher" content="富視網科技網頁設計" /> 
<meta name="copyright" content="富視網科技網頁設計" />
<meta name="robots" content="all" />
<meta name="robots" content="index,follow" />
<meta name="revisit-after" content="7 days" />
<meta name="rating" content="general" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="zh-tw" />
<meta http-equiv="expires" content="0" />
<meta name="spiders" content="all" />
<meta name="webcrawlers" content="all" />
<meta property="og:image" content="" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
<!-- FB發布屬性 -->
<meta property="og:title" content="<?php echo $Title_Word ?>" />
<meta property="og:type" content="" />
<meta property="og:url" content="" />
<meta property="og:image" content="images/100x100_noimage.jpg" />
<meta property="og:site_name" content="<?php echo $SiteName; ?>" />
<title><?php echo $SiteName; ?></title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" href="css/jqui/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<!--[if lte IE 6]>
<script language="javascript">
$(document).ready(function() {
		$.blockUI({ 
			message: '<table width="600" border="0" cellspacing="0" cellpadding="5"><tr><td width="14%" rowspan="2"><img src="ie6die/ie6-die.png" width="100" height="102" /></td><td width="86%" align="left"><span title="" closure_uid_ymkxka="66"><h3><strong>您正在使用的是以IE6為核心的瀏覽器瀏覽網頁！</strong></h3><hr /></span> 為了瀏覽網頁更安全、更快速，貼心建議您升級到較新的版本，或是改用其他的瀏覽器，以獲得更好的使用體驗。下面是一份目前廣受歡迎的瀏覽器列表。只要點選圖示，即可連到各自的官方下載頁面！<hr /></td></tr><tr><td  align="left"><a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx"><img src="ie6die/01.png" width="49" height="24" /></a><a href="http://www.mozilla.com/firefox/"><img src="ie6die/02.png" width="95" height="24" /></a><a href="http://www.google.com/chrome"><img src="ie6die/03.png" width="96" height="24" /></a><a href="http://www.apple.com/safari/download/"><img src="ie6die/04.png" width="87" height="24" /></a><a href="http://www.opera.com/download/"><img src="ie6die/05.png" width="83" height="24" /></a></td></tr></table>' ,
            overlayCSS: { backgroundColor: '#fff' },
			css: { 
                width: '600px', 
                backgroundColor: '#000', 
                opacity: .6, 
                color: '#fff',
				padding: '5px' 
            } 
			});		
    });
</script> 
<![endif]-->
<link href="css/incstyle_single.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.container{
	margin: 0px;
	padding: 0px;
}

.board{
	border: 1px solid #DDD;
}

.ct_board_title{
	margin: 5px;
	padding: 5px;	/*text-align: center;*/
	color: #FFF;
	background-color: #333;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="Bk_Anime_Wrapper">
<div id="Bk_Anime_Destroy"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Main_Wrapper" none="true">
  <tr>
    <td id="Left_Background">&nbsp;</td> 
    <td id="Middle_Wrapper">
<div style="position:relative;"><!--For FireFox-->
<div id="abgne_float_right_menu">
    	<img src="images/floatmenu_tb.png" width="50" height="20" />
    	<div id="abgne_float_right_top">
    	  <img src="images/floatmenu_top_A.png" width="50" height="35" />
  	  </div>
        <div id="abgne_float_right_context">
        	<a href="index.php"><img src="images/floatmenu_home_A.png" width="50" height="35" /></a>
            <?php if ($OptionCartSelect == '1') { ?>
            <a href="cart.php?Opt=showpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/floatmenu_cart_A.png" width="50" height="35" /></a>
            <?php } ?>
            <a href="javascript:history.go(-1); "><img src="images/floatmenu_back_A.png" width="50" height="35" /></a>
        </div>
        <div id="abgne_float_right_bottom">
        	<img src="images/floatmenu_down_A.png" width="50" height="35" />
        </div>
        <img src="images/floatmenu_db.png" width="50" height="20" />
</div>
</div>
<div class="mdl WrpBoardStyle">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="mdl_t_l"></td>
    <td class="mdl_t_c"></td>
    <td class="mdl_t_r"></td>
  </tr>
  <tr>
    <td class="mdl_c_l"></td>
    <td class="mdl_c_c">
    <div id="wrapper">
    <div id="abgne_float_lang_menu"> 
    </div>
    <!--<div id="abgne_float_left_menu">
    	<div id="abgne_float_left_top">
        	<img src="../images/floatmenu_top.png" width="50" height="50" />
        </div>
        <div id="abgne_float_left_context">
        	<a href="index.php"><img src="../images/floatmenu_home.png" width="50" height="50" /></a>
            <a href="javascript:history.go(-1); "><img src="../images/floatmenu_back.png" width="50" height="50" /></a>
        </div>
        <div id="abgne_float_left_bottom">
        	<img src="../images/floatmenu_down.png" width="50" height="50" />
        </div>
    </div>-->
  <div id="header" _height="none">
    <div id="context">
    
  </div>
<!--  Banner  -->      
  <div id="banner" _height="none">
    <div class="mdbanner BannerBoardStyle">
	<div class="mdbanner_t">
			<div class="mdbanner_t_l"> </div>
			<div class="mdbanner_t_r"> </div>
			<div class="mdbanner_t_c"><!--標題--></div>
			<div class="mdbanner_t_m"><!--更多--></div>
	</div><!--mdbanner_t-->
	<div class="mdbanner_c g_p_hide">
			<div class="mdbanner_c_l g_p_fill"> </div>
			<div class="mdbanner_c_r g_p_fill"> </div>
			<div class="mdbanner_c_c">
					<!-- <div class="mdbanner_m_t"></div>
					<div class="mdbanner_m_c">  -->  
  	<div id="context">
       
    </div>
      				<!--</div>
					<div class="mdbanner_m_b"></div>-->
			</div>
	</div><!--mdbanner_c-->
	<div class="mdbanner_b">
			<div class="mdbanner_b_l"> </div>
			<div class="mdbanner_b_r"> </div>
			<div class="mdbanner_b_c"> </div>
	</div><!--mdbanner_b-->
</div><!--mdbanner-->
  </div>
<!--  Banner  END -->
  <div id="Left_column">
  	<div id="context">
       
    </div>
  </div>
  <div id="shangxia"><div id="shang"></div><div id="comt"></div><div id="xia"></div></div>
  <div id="Content_containter" _height="auto">
  	<div id="Main_content">
      <div id="context" >

      	</div>
  	</div>  
    <div id="Rght_column">
      <div id="context">

    </div>
  </div>
  </div>

  <div id="footer" _height="none">
  	<!--<div id="floatblock" >
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" align="left" valign="bottom"><img src="../images/left_float_footer.png" width="200" height="100" /></td>
            <td width="50%" align="right"><img src="../images/right_float_footer.png" width="200" height="150" /></td>
            <td>&nbsp;</td>
            </tr>
        </table> 
	</div>-->
  	<div id="context">
      
    </div>
  </div>
</div>
	</td>
    <td class="mdl_c_r"></td>
  </tr>
  <tr>
    <td class="mdl_b_l"></td>
    <td class="mdl_b_c"></td>
    <td class="mdl_b_r"></td>
  </tr>
</table>



</div><!--mdl-->
</td>
    <td  id="Right_Background">&nbsp;</td>
  </tr>
</table>
</div>
<!--<div id="board_footer">
	<img src="../images/board_bk.png" width="1000" height="60" /></div>-->
</body>
</html>