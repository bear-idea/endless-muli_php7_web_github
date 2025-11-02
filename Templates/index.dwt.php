<?php
//initialize the session
if (!isset($_SESSION)) { 
  session_start(); 
}     
   
// ** Logout the current user. **  
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){ 
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username_' . $_GET['wshop']] = NULL;
  $_SESSION['MM_UserGroup_' . $_GET['wshop']] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username_' . $_GET['wshop']]);
  unset($_SESSION['MM_UserGroup_' . $_GET['wshop']]);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['success_line_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_google_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_fb_login_backstage_'.$_GET['wshop']]);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;  
  }
}
?>
<?php require_once("inc_setting_fr.php"); ?>
<?php require_once("inc/inc_path.php"); ?>
<?php require_once("inc/inc_function.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> 
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
<!-- TemplateBeginEditable name="doctitle" -->
<title>Sample</title>
<!-- TemplateEndEditable -->
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" href="../css/jqui/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery.timers.js"></script>
<script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="../js/jquery.dropshadow.js"></script>
<link rel="stylesheet" href="../css/elastic.css" />
<script type="text/javascript" src="../js/elastic.js"></script>
<script type="text/javascript" src="../js/MSClass.js"> // 跑馬燈</script>
<link rel="stylesheet" href="../css/easytooltip/easyTooltip.css" />
<script type="text/javascript" src="js/jquery.spritely-0.5.js"> // 動態背景</script>
<script type="text/javascript" src="../js/minwt.auto_full_height.mini_n.js"></script>
<script type="text/javascript" src="js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<link rel="stylesheet" href="../css/jquery.rater/jquery.rater.css" />
<script type="text/javascript" src="../js/jquery.rater/jquery.rater.js"> // 評分</script>
<script type="text/javascript" src="js/jquery.bubbleup.js"> // 冒泡</script>
<script type="text/javascript" src="js/jquery.photoFrame.js"> // 相框</script>
<script type="text/javascript">
      $(function(){   
	  // 畫框方向:'top', 'bottom', 'left', 'right', 'topLeft', 'topRight', 'bottomLeft', 'bottomRight'
	  	$(".photoFrame_base").photoFrame({skin:'base', direction:'all'});
        $(".photoFrame_stamp").photoFrame({skin:'stamp', direction:'all'});
		$(".photoFrame_glass01").photoFrame({skin:'glass01', direction:'all'});
		$(".photoFrame_glass02").photoFrame({skin:'glass02', direction:'all'});
		$(".photoFrame_corner").photoFrame({skin:'corner', direction:'all'}); 
		$(".photoFrame_pick").photoFrame({skin:'pick', direction:'all'});
		$(".photoFrame_photographic").photoFrame({skin:'photographic', direction:'all_bottomThree'});
		$(".photoFrame_photographic01").photoFrame({skin:'photographic01', direction:'all_bottomThree'});
		$(".photoFrame_photographic02").photoFrame({skin:'photographic02', direction:'all'});
		$(".photoFrame_photographic03").photoFrame({skin:'photographic03', direction:'all'});
		$(".photoFrame_photographic04").photoFrame({skin:'photographic04', direction:'all'});
		$(".photoFrame_photographic05").photoFrame({skin:'photographic05', direction:'all'}); 
		$(".photoFrame_photographic06").photoFrame({skin:'photographic06', direction:'all'}); 
		$(".photoFrame_photographic07").photoFrame({skin:'photographic07', direction:'all'}); 
		$(".photoFrame_photographic08").photoFrame({skin:'photographic08', direction:'all'});
		$(".photoFrame_photographic09").photoFrame({skin:'photographic09', direction:'all'});  
      });
</script>  
<link href="../css/prettyPhoto.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"> // lightbox</script>
<script type="text/javascript" src="../js/jquery.corners.min.js"></script>
<script language="javascript">
$(document).ready( function(){
  $('.rounded').corners();
});
</script>
<!-- [ 上下滑動 ] -->
<script type="text/javascript">
jQuery(document).ready(function() {
var s= $('#abgne_float_left_menu, #abgne_float_right_menu').offset().top;$(window).scroll(function (){$("#abgne_float_left_menu, #abgne_float_right_menu").animate({top : $(window).scrollTop() + s + "px" },{queue:false,duration:500});});
$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
$('#abgne_float_left_top, #abgne_float_right_top').click(function(){$body.animate({scrollTop: '0px'}, 400);});
$('#abgne_float_left_bottom, #abgne_float_right_bottom').click(function(){$body.animate({scrollTop:$('#footer').offset().top}, 800);});
$('#abgne_float_left_context, #abgne_float_right_context').click(function(){$body.animate({scrollTop:$('#wrapper').offset().top}, 800);});
});
</script>
<!-- [ 上下滑動 End ] -->
<script type="text/javascript" src="../js/jquery.blockUI.js"></script>
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
<!-- [ reflection ] -->
<script type="text/javascript" src="../js/reflection.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
	$("#ref_thumb img").reflect();
})
</script>
<!-- [ reflection End ] -->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<!-- TemplateBeginEditable name="head" -->
<link href="<?php echo $TplCssPath; ?>/incstyle_single.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $TplCssPath; ?>/styleless.css" rel="stylesheet" type="text/css" />
<link href="../css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/styleless.css" rel="stylesheet" type="text/css" />
<!-- TemplateEndEditable -->
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
    	<img src="../images/floatmenu_tb.png" width="50" height="20" />
    	<div id="abgne_float_right_top">
    	  <img src="../images/floatmenu_top_A.png" width="50" height="35" />
  	  </div>
        <div id="abgne_float_right_context">
        	<a href="index.php"><img src="../images/floatmenu_home_A.png" width="50" height="35" /></a>
            <a href="cart.php?Opt=showpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="../images/floatmenu_cart_A.png" width="50" height="35" /></a>
            <a href="javascript:history.go(-1); "><img src="../images/floatmenu_back_A.png" width="50" height="35" /></a>
        </div>
        <div id="abgne_float_right_bottom">
        	<img src="../images/floatmenu_down_A.png" width="50" height="35" />
        </div>
        <img src="../images/floatmenu_db.png" width="50" height="20" />
</div>
</div>
<div class="mdl WrpBoardStyle">
	<div class="mdl_t">
			<div class="mdl_t_l"> </div>
			<div class="mdl_t_r"> </div>
			<div class="mdl_t_c"><!--標題--></div>
			<div class="mdl_t_m"><!--更多--></div>
	</div><!--mdl_t-->
	<div class="mdl_c g_p_hide">
			<div class="mdl_c_l g_p_fill"> </div>
			<div class="mdl_c_r g_p_fill"> </div>
			<div class="mdl_c_c">
					<!-- <div class="mdl_m_t"></div>
					<div class="mdl_m_c">  -->                 
<div id="wrapper">
    <div id="abgne_float_lang_menu"> 
    	<?php require("inc/inc_frontlangselect.php"); ?>
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
    <?php if ($MSTMP == 'default') { ?>
    <br />
    <div style="position:absolute;"><a href="index.php"><img src="../images/logo.png" alt="logo" width="150" height="58" /></a>
    </div>
    <br />
    <br />
    <div style="text-align:right;"><?php require_once("require_epaper_send.php"); ?></div>
    <?php } else { ?>
	<?php require($TplPath . "/header.php"); ?> 
	<?php } ?>
    <?php
    switch($MSMenu)
    {
        case '0': // 客製化
            require_once("mainmenu_custom.php");		
            break;
        case '1': // 樣板
			if ($MSLMenu != 1) { // 
			    if ($TmpMenuSelect == '0') { // 樣板使用系統預設 1:獨立樣板
            		require_once("mainmenu_dfcustom.php");
				}
			}	
            break;
        default:
            //require_once("mainmenu_custom.php");		
            break;
    }
	?> 
    </div>
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
        <?php 
		if ($MSBanner == '1')
		{
			include("require_banner.php"); // 引入橫幅檔案
		}
		if ($MSPublish == '1')
		{
			include("require_publish_marquee_sty01.php"); // 引入跑馬燈檔案
		}
		?>
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
        <?php
		if ($MSMemberLeftLogin == '1') {
				require_once("require_member_leftmenu_login.php");
		}
        switch($MSTMP)
		{
			case "userdefault":
		?>
        <!-- TemplateBeginEditable name="左選單標頭" -->
        <?php
				// 左選單標頭
				include($TplPath . "/news_leftmenu_title.php");
		?>
        <!-- TemplateEndEditable -->
        <?php
				break;
        	default:
        ?>
        <img src="images/r01.jpg" width="161" height="37" />
        <br /><br />
        <?php
                break;
        }
        ?>
        <?php
			switch($MSLMenu)
			{
				case "0":
		?>
        <!-- TemplateBeginEditable name="左選單分類" -->
        <?php
					// 左選單[分類] - 個別分類頁面
			    include_once("require_news_leftmenu_vertical_mega_menu.php");						
		?> 	
        <!-- TemplateEndEditable -->		
        <?php 
					break;
				case "1":
					include_once("require_all_leftmenu_vertical_mega_menu.php");				
					break;
				case "2":
					include_once("require_product_leftmenu_vertical_mega_menu.php");				
					break;
				default:
					include_once("require_news_leftmenu_vertical_mega_menu.php");
					break;
			}
			if ($MSLMenuArticlePlus == '1' && $MSLMenuArticlePlusR == '0') {
				include("require_article_leftmenu_vertical_mega_menu.php");
			}
			if ($MSNewsNLink == '1' && $MSNewsNLinkR == '0') {
				include_once("require_news_autolist_scroll.php");
			}
			if ($MSProductHot == '1' && $MSProductHotR == '0') {
				include("require_product_popularity.php");
			} 
			if ($MSFriLinkQLink == '1' && $MSFriLinkQLinkR == '0') {
				include("require_frilink_qlink.php");
			}  
		?>
        	<!-- 粉絲頁 -->
            <?php if ($SiteFBFan != '' && $MSFbFan == '1' && $MSFbFanR == '0') { ?>
            <div style="margin:5px;"></div>
        	<div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            
            <div class="fb-like-box" data-href="<?php echo $SiteFBFan; ?>" data-width="198" data-show-faces="true" data-stream="false" data-left="true"></div>
            <?php } ?>
            <!-- 粉絲頁 -->
    </div>
  </div>
  <div id="shangxia"><div id="shang"></div><div id="comt"></div><div id="xia"></div></div>
  <div id="Content_containter" _height="auto">
  	<div id="Main_content">
      <div id="context" >
      	<!-- TemplateBeginEditable name="主內容" -->
      	<?php include($TplPath . "/main_content.php"); ?>  
      	<!-- TemplateEndEditable -->
      </div>
  	</div>  
    <div id="Rght_column">
      <div id="context">     
        <!-- TemplateBeginEditable name="右選單" -->
		<!-- TemplateEndEditable -->
        <?php
			if ($MSLMenuArticlePlusR == '1') {
				include("require_article_leftmenu_vertical_mega_menu.php");
			}
			if ($MSNewsNLinkR == '1') {
				include_once("require_news_autolist_scroll.php");
			}
			if ($MSProductHotR == '1') {
				include("require_product_popularity.php");
			} 
			if ($MSFriLinkQLinkR == '1') {
				include("require_frilink_qlink.php");
			}   
		?>
        <!-- 粉絲頁 -->
            <?php if ($SiteFBFan != '' && $MSFbFanR == '1') { ?>
            <div style="margin:5px;"></div>
        	<div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            
            <div class="fb-like-box" data-href="<?php echo $SiteFBFan; ?>" data-width="198" data-show-faces="true" data-stream="false" data-left="true"></div>
            <?php } ?>
            <!-- 粉絲頁 -->
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
       <?php require('require_tmpfooter.php'); ?>
    </div>
  </div>
</div>
					<!--</div>
					<div class="mdl_m_b"></div>-->
			</div>
	</div><!--mdl_c-->
	<div class="mdl_b">
			<div class="mdl_b_l"> </div>
			<div class="mdl_b_r"> </div>
			<div class="mdl_b_c"> </div>
	</div><!--mdl_b-->
</div><!--mdl-->
</td>
    <td  id="Right_Background">&nbsp;</td>
  </tr>
</table>
</div>
<!--<div id="board_footer">
	<img src="../images/board_bk.png" width="1000" height="60" /></div>-->
</body>
<script type="text/javascript">
$(function () {// 圖片顯影
$('.div_table-cell img, .div_table-cell_frilinkqlink img').hover(
function() {$(this).fadeTo("fast", 0.5);},
function() {$(this).fadeTo("fast", 1);
});
});
</script>
<!-- [ 內容分頁 ] -->
<script type="text/javascript">
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
</script>
<!-- [ 內容分頁 END] -->
<!-- [ 區塊等高 ] -->
<script language="javascript"> 
	/*var l=document.getElementById("Left_column").scrollHeight;
	var m=document.getElementById("Main_content").scrollHeight;
	var r=document.getElementById("Rght_column").scrollHeight;
	layoutHeight=Math.max(l,m,r); 
	document.getElementById("Left_column").style.height=layoutHeight+"px";
	document.getElementById("Rght_column").style.height=layoutHeight+"px"; 
	document.getElementById("Main_content").style.height=layoutHeight+"px";*/
</script> 
<!-- [ 區塊等高 END] -->

<!-- [ 背景動畫 ] -->
<script language="javascript">
//jQuery(document).ready(function() {
  //$('#Bk_Anime_Wrapper').pan({fps: 30 , speed: 3, dir: 'right', depth: 100});
  //$('#Bk_Anime_Destroy').pan({fps: 30, speed: 10, dir: 'up', depth: 70});
//});
</script>
<!-- [ 背景動畫 END] -->

<!-- [ 字形切換 ] -->
<script language="javascript">
/*jQuery(document).ready(function() {
  	fontResizer('80%','90%','100%');
	jQuery("div#fontdisplay").css('display', 'block' );
});*/
</script>
<!-- [ 字形切換 End ] -->
</html>