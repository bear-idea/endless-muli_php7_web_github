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
<meta property="og:image" content="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?>" />
<meta property="og:site_name" content="<?php echo $SiteName; ?>" />
<title><?php echo $Title_Word ?></title>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<link href="css/thiagosf-SkitterSlideshow/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
<script src="js/thiagosf-SkitterSlideshow/jquery.animate-colors-min.js"></script>
<script src="js/thiagosf-SkitterSlideshow/jquery.skitter.min.js"></script>
<link rel="stylesheet" href="css/jqui/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.timers.js"></script>
<script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="js/jquery.dropshadow.js"></script>
<script type="text/javascript" src="js/minwt.auto_full_height.mini.js"></script>
<link rel="stylesheet" href="css/elastic.css" />
<script type="text/javascript" src="js/elastic.js"></script>
<script type="text/javascript" src="js/MSClass.js"> // 跑馬燈</script>
<link rel="stylesheet" href="css/easytooltip/easyTooltip.css" />
<script type="text/javascript" src="js/jquery.spritely-0.5.js"> // 動態背景</script>
<script type="text/javascript" src="js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<script language="javascript" src="js/jquery.tipsy.js">/*Tip*/</script>
<link href="css/tipsy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
 $(function() {
   $('a[rel=tipsy]').tipsy({fade: true, gravity: 'w'});
 });
</script>
<link rel="stylesheet" href="css/jquery.rater/jquery.rater.css" />
<script type="text/javascript" src="js/jquery.rater/jquery.rater.js"> // 評分</script>
<script type="text/javascript" src="js/jquery.bubbleup.js"> // 冒泡</script>
<link rel="stylesheet" href="css/jquery.nailthumb.1.1.min.css" />
<script type="text/javascript" src="js/jquery.nailthumb.1.1.min.js"></script>
<link rel="stylesheet" href="css/photoFrame/photoFrame.css" />
<script type="text/javascript" src="js/jquery.photoFrame.js"> // 相框</script>
<script type="text/javascript">
$(function(){$(".photoFrame_base").photoFrame({skin:"base",direction:"all"});$(".photoFrame_stamp").photoFrame({skin:"stamp",direction:"all"});$(".photoFrame_glass01").photoFrame({skin:"glass01",direction:"all"});$(".photoFrame_glass02").photoFrame({skin:"glass02",direction:"all"});$(".photoFrame_corner").photoFrame({skin:"corner",direction:"all"});$(".photoFrame_pick").photoFrame({skin:"pick",direction:"all"});$(".photoFrame_photographic").photoFrame({skin:"photographic",direction:"all_bottomThree"});
$(".photoFrame_photographic01").photoFrame({skin:"photographic01",direction:"all_bottomThree"});$(".photoFrame_photographic02").photoFrame({skin:"photographic02",direction:"all"});$(".photoFrame_photographic03").photoFrame({skin:"photographic03",direction:"all"});$(".photoFrame_photographic04").photoFrame({skin:"photographic04",direction:"all"});$(".photoFrame_photographic05").photoFrame({skin:"photographic05",direction:"all"});$(".photoFrame_photographic06").photoFrame({skin:"photographic06",direction:"all"});
$(".photoFrame_photographic07").photoFrame({skin:"photographic07",direction:"all"});$(".photoFrame_photographic08").photoFrame({skin:"photographic08",direction:"all"});$(".photoFrame_photographic09").photoFrame({skin:"photographic09",direction:"all"})});
</script>  
<link href="css/prettyPhoto.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"> // lightbox</script>
<!-- [ 上下滑動 ] -->
<script type="text/javascript">
jQuery(document).ready(function(){var a=$("#abgne_float_left_menu, #abgne_float_right_menu").offset().top;$(window).scroll(function(){$("#abgne_float_left_menu, #abgne_float_right_menu").animate({top:$(window).scrollTop()+a+"px"},{queue:!1,duration:500})});$body=window.opera?"CSS1Compat"==document.compatMode?$("html"):$("body"):$("html,body");$("#abgne_float_left_top, #abgne_float_right_top").click(function(){$body.animate({scrollTop:"0px"},400)});$("#abgne_float_left_bottom, #abgne_float_right_bottom").click(function(){$body.animate({scrollTop:$("#footer").offset().top},
800)});$("#abgne_float_left_context, #abgne_float_right_context").click(function(){$body.animate({scrollTop:$("#wrapper").offset().top},800)})});
</script>
<!-- [ 上下滑動 End ] -->
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<!--[if lte IE 6]>
<script language="javascript">
$(document).ready(function(){$.blockUI({message:'<table width="600" border="0" cellspacing="0" cellpadding="5"><tr><td width="14%" rowspan="2"><img src="ie6die/ie6-die.png" width="100" height="102" /></td><td width="86%" align="left"><span title="" closure_uid_ymkxka="66"><h3><strong>\u60a8\u6b63\u5728\u4f7f\u7528\u7684\u662f\u4ee5IE6\u70ba\u6838\u5fc3\u7684\u700f\u89bd\u5668\u700f\u89bd\u7db2\u9801\uff01</strong></h3><hr /></span> \u70ba\u4e86\u700f\u89bd\u7db2\u9801\u66f4\u5b89\u5168\u3001\u66f4\u5feb\u901f\uff0c\u8cbc\u5fc3\u5efa\u8b70\u60a8\u5347\u7d1a\u5230\u8f03\u65b0\u7684\u7248\u672c\uff0c\u6216\u662f\u6539\u7528\u5176\u4ed6\u7684\u700f\u89bd\u5668\uff0c\u4ee5\u7372\u5f97\u66f4\u597d\u7684\u4f7f\u7528\u9ad4\u9a57\u3002\u4e0b\u9762\u662f\u4e00\u4efd\u76ee\u524d\u5ee3\u53d7\u6b61\u8fce\u7684\u700f\u89bd\u5668\u5217\u8868\u3002\u53ea\u8981\u9ede\u9078\u5716\u793a\uff0c\u5373\u53ef\u9023\u5230\u5404\u81ea\u7684\u5b98\u65b9\u4e0b\u8f09\u9801\u9762\uff01<hr /></td></tr><tr><td  align="left"><a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx"><img src="ie6die/01.png" width="49" height="24" /></a><a href="http://www.mozilla.com/firefox/"><img src="ie6die/02.png" width="95" height="24" /></a><a href="http://www.google.com/chrome"><img src="ie6die/03.png" width="96" height="24" /></a><a href="http://www.apple.com/safari/download/"><img src="ie6die/04.png" width="87" height="24" /></a><a href="http://www.opera.com/download/"><img src="ie6die/05.png" width="83" height="24" /></a></td></tr></table>',
overlayCSS:{backgroundColor:"#fff"},css:{width:"600px",backgroundColor:"#000",opacity:0.6,color:"#fff",padding:"5px"}})});
</script> 
<![endif]-->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<?php
switch($MSTMP)
{
	case "userdefault":
		echo "<link href=\"". $TplCssPath ."/incstyle_single.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"". $TplCssPath ."/styleless.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"". $TplCssPath . "/vertical-mega-menu/vertical_menu_basic.css\" rel=\"stylesheet\" type=\"text/css\" />";
		break;		
	default:
?>
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<?php
		break;
}
?>
<?php require_once("inc/inc_css_setting.mobile.bootstrap.min.php"); // 自訂樣式?>
<link rel="stylesheet" href="css/QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="js/jquery.ui.touch.js"></script>
<script type="text/javascript" src="js/QapTcha.jquery.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jPaginate/jquery.paginate.js"></script>
<link href="css/jPaginate/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="Bk_Anime_Wrapper">
<div id="Bk_Anime_Destroy"></div>
<div id="Bk_Bottom_Wrapper">
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Main_Wrapper" none="true">
  <tr>
    <td id="Left_Background">&nbsp;</td> 
    <td id="Middle_Wrapper">
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
    <div id="wrapper" style="background-image: none;">
  
  
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
<div id="mqo" _height="none">

</div>
  <div id="Left_column" >
  	<div id="context">
		
    </div>
  </div>
  <div id="shangxia"><div id="shang"></div><div id="comt"></div><div id="xia"></div></div>
  <div id="Content_containter" _height="auto">
  	<div id="Main_content">
      <div id="context" >
      	<div class="columns on-1">
      	  <div class="container">
      	    <div class="column">
      	      <div class="container">
      	        <?php if ($_GET['Opt'] == 'cartdetailed') { ?>
      	        <?php require("require_productcart_viewline.php"); ?>
      	        <?php } else { ?>
      	        <?php require("require_product_viewline.php"); ?>
      	        <?php } ?>
      	        </div>
      	      </div>
      	    </div>        
    	  </div>
        <?php
			switch($_GET['Opt'])
			{
				case "viewpage":
					switch($MSProduct)
					{	
						/*case '0':
							include_once("require_product_ela.php");
							break;
						case '1':
							include_once("require_product_4col.php");
							break;
						case '2':
							include_once("require_product_3col.php");
							break;
						case '3':
							include_once("require_product_2col.php");
							break;
						case '4':
							include_once("require_product_1col.php");
							break;*/
						default:
							include_once("require_product.php");	
							break;
					}
					break;		
				case "typepage":
					switch($MSProduct)
					{	
						/*case '0':
							include_once("require_product_type_ela.php");	
							break;
						case '1':
							include_once("require_product_type_4col.php");	
							break;
						case '2':
							include_once("require_product_type_3col.php");	
							break;
						case '3':
							include_once("require_product_type_2col.php");	
							break;
						case '4':
							include_once("require_product_type_1col.php");	
							break;*/
						default:
							include_once("require_product.php");	
							break;
					}
					break;		
				case "maintypepage":
					switch($MSProduct)
					{	
						/*case '0':
							include_once("require_product_type_main_ela.php");	
							break;
						case '1':
							include_once("require_product_type_main_4col.php");	
							break;
						case '2':
							include_once("require_product_type_main_3col.php");	
							break;
						case '3':
							include_once("require_product_type_main_2col.php");		
							break;
						case '4':
							include_once("require_product_type_main_1col.php");	
							break;*/
						default:
							include_once("require_product.php");	
							break;
					}
					break;		
				case "detailed":
					switch($MSProductContent)
					{	
						/*case '0':
							include_once("require_product_detailed_ela_base.php");
							break;
						case '1':
							include_once("require_product_detailed_ela.php");
							break;*/
						default:
							include_once("require_product_detailed_ela.php");
							break;
					}
					break;		
				case "cartdetailed":
					switch($MSProductContent)
					{	
						/*case '0':
							include_once("require_product_detailed_ela_base.php");
							break;
						case '1':
							include_once("require_product_detailed_ela.php");
							break;*/
						default:
							include_once("require_product_detailed.php");
							break;
					}
					break;	
				default:
					include_once("require_product.php");
					break;
			}
		?>

      	</div>
  	</div>  
    <div id="Rght_column">
      <div id="context">

    </div>
  </div>
  </div>

  <div id="footer" _height="none">
  <!--<div id="floatblock">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" align="left" valign="bottom"><img src="../images/left_float_footer.png" width="200" height="100" /></td>
            <td width="50%" align="right"><img src="../images/right_float_footer.png" width="200" height="150" /></td>
            <td>&nbsp;</td>
            </tr>
        </table> 
	</div> 	-->
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
</div>
<!--<div id="board_footer">
	<img src="../images/board_bk.png" width="1000" height="60" /></div>-->
<a href="#" class="scrollup">Scroll</a>
</body>
<script type="text/javascript">
$(function(){$(".div_table-cell img, .div_table-cell_frilinkqlink img").hover(function(){$(this).fadeTo("fast",0.5)},function(){$(this).fadeTo("fast",1)})});
</script>
<!-- [ 內容分頁 ] -->
<script type="text/javascript">
$(document).ready(function(){$("#page_break .num li:first").addClass("on");$("#page_break .num li").click(function(){$("#page_break div[id^='page_']").hide();$(this).hasClass("on")?$("#page_break #page_"+$(this).text()).show():($("#page_break .num li").removeClass("on"),$(this).addClass("on"),$("#page_break #page_"+$(this).text()).fadeIn("normal"))})});
</script>
<!-- [ 內容分頁 END] -->
<script type="text/javascript">
    $(document).ready(function(){ 
 
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        }); 
 
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
    });
</script>
<!-- [ 區塊等高 ] -->
<script language="javascript"> 
/*
var l=document.getElementById("Left_column").scrollHeight,m=document.getElementById("Main_content").scrollHeight,r=document.getElementById("Rght_column").scrollHeight;layoutHeight=Math.max(l,m,r);document.getElementById("Left_column").style.height=layoutHeight+"px";document.getElementById("Rght_column").style.height=layoutHeight+"px";document.getElementById("Main_content").style.height=layoutHeight+"px";
*/
</script> 
<!-- [ 區塊等高 END] --> 

<!-- [ 字形切換 ] -->
<script language="javascript">
/*jQuery(document).ready(function(){fontResizer("80%","90%","100%");jQuery("div#fontdisplay").css("display","block")});*/
</script>
<!-- [ 字形切換 End ] -->
</html>