
<!--標題外框-->
<div style="position:relative;">
  <div class="mdtitle TitleBoardStyle">
    <div class="mdtitle_t">
      <div class="mdtitle_t_l"> </div>
      <div class="mdtitle_t_r"> </div>
      <div class="mdtitle_t_c"><!--標題--></div>
      <div class="mdtitle_t_m"><!--更多--></div>
    </div><!--mdtitle_t-->
    <div class="mdtitle_c g_p_hide">
      <div class="mdtitle_c_l g_p_fill"> </div>
      <div class="mdtitle_c_r g_p_fill"> </div>
      <div class="mdtitle_c_c">
        <!-- <div class="mdtitle_m_t"></div>
					<div class="mdtitle_m_c">  --> 
  <!--標題外框--> 
<div class="columns on-1">
    <div class="container">
      <div class="column">  
        <div class="container ct_board ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Faq']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>
  <!--標題外框-->
        <!--</div>
					<div class="mdtitle_m_b"></div>-->
        </div>
    </div><!--mdtitle_c-->
    <div class="mdtitle_b">
      <div class="mdtitle_b_l"> </div>
      <div class="mdtitle_b_r"> </div>
      <div class="mdtitle_b_c"> </div>
    </div><!--mdtitle_b-->
  </div><!--mdtitle-->
</div>
<!-- 標題外框-->
<?php 
if ($totalRows_RecordFaq > 0) { 
?>
<!--外框-->
<div style="position:relative;">
  <div class="mdmiddle MiddleBoardStyle">
    <div class="mdmiddle_t">
      <div class="mdmiddle_t_l"> </div>
      <div class="mdmiddle_t_r"> </div>
      <div class="mdmiddle_t_c"><!--標題--></div>
      <div class="mdmiddle_t_m"><!--更多--></div>
      </div><!--mdmiddle_t-->
    <div class="mdmiddle_c g_p_hide">
      <div class="mdmiddle_c_l g_p_fill"> </div>
      <div class="mdmiddle_c_r g_p_fill"> </div>
      <div class="mdmiddle_c_c">
        <!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
  <!--外框--> 
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                
<?php
function getBrowType()
{
 if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0"))      
 $browType="Internet Explorer 8.0";   
 else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0"))      
 $browType="Internet Explorer 7.0";      
 else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0"))      
 $browType="Internet Explorer 6.0";            
 else 
 $browType=$_SERVER["HTTP_USER_AGENT"];   
 Return $browType;
}
$_browType=getBrowType();
//echo($_browType);//输出结果
?>                
<?php if($_browType == "Internet Explorer 8.0" || $_browType == "Internet Explorer 7.0" || $_browType == "Internet Explorer 6.0") { ?>                
<ul class="drp_container"> 
<?php do { ?>
      <li>
          <ul style="padding-left:0px;">
		    <li class="button"><a href="#"><i class="fa fa-comments-o"></i><?php if($row_RecordFaq['type'] != "") { ?>&nbsp;【<?php echo $row_RecordFaq['type']; ?>】<?php } ?>&nbsp;<?php echo $row_RecordFaq['title']; ?> <span></span></a></li>

            <li class="dropdown" style="list-style:none;">
                <ul style="padding-left:5px;">
                    <li style="list-style:none;"><?php echo $row_RecordFaq['content']; ?></li>
                 
                </ul>
			</li>

          </ul>
          
      </li>
	  <?php } while ($row_RecordFaq = mysqli_fetch_assoc($RecordFaq)); ?>

  </ul>
<?php } else { ?>
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>paper-collapse.min.css">
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>paper-collapse.min.js"></script>
<section>
    <div class="container" style="min-height:800px;" id="paper_wrp">
	<?php do { ?>
<div class="collapse-card">
  <div class="collapse-card__heading">
    <div class="collapse-card__title">
      <i class="fa fa-question-circle fa-2x fa-fw"></i> <!-- Title Text --><?php if($row_RecordFaq['type'] != "") { ?>&nbsp;【<?php echo $row_RecordFaq['type']; ?>】<?php } ?>&nbsp;<?php echo $row_RecordFaq['title']; ?>
    </div>
  </div>
  <div class="collapse-card__body">
    <!-- Body Text --><?php echo $row_RecordFaq['content']; ?>
  </div>
</div>
<?php } while ($row_RecordFaq = mysqli_fetch_assoc($RecordFaq)); ?>
    </div>
</section>
<div style="clear:both;"></div>
<script type="text/javascript">
$(function () {
	
  $('.collapse-card').paperCollapse({
	  closeHandler: '.collapse-card__close_handler', 
      onShowComplete:function() {     
	   $("#Content_containter").height($("#Content_containter").height() + $(this).closest('.collapse-card').find('.collapse-card__body').height());
	   //alert($(this).closest('.collapse-card').find('.collapse-card__body').height());
    },
	  onHideComplete:function() {     
	   $("#Content_containter").height($("#Content_containter").height() - $(this).closest('.collapse-card').find('.collapse-card__body').height());
    }
  });
})
</script>
<?php } ?>





                </div>
            </div>
        </div>        
</div>
  <!--外框-->
        <!--</div>
					<div class="mdmiddle_m_b"></div>-->
        </div>
      </div><!--mdmiddle_c-->
    <div class="mdmiddle_b">
      <div class="mdmiddle_b_l"> </div>
      <div class="mdmiddle_b_r"> </div>
      <div class="mdmiddle_b_c"> </div>
      </div><!--mdmiddle_b-->
  </div><!--mdmiddle-->
</div>
<!--外框-->
<?php }  ?>
<?php 
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordFaq == 0) { 
?>
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
<!--外框-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;">常見問答  →  新增</strong> 來建立該項目<?php } ?></td>
  </tr>
</table>
<br />
<br />
<!--外框-->
  				<!--</div>
					<div class="mdmiddle_m_b"></div>-->
	  </div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
<?php 
}
?>