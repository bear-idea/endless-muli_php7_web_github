<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $row_RecordBlog['title']; ?></span></h1>
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
<?php do { ?>
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
      <span style="float:right; margin-right:5px;"><?php require("require_sharelink.php"); ?></span>
      <?php //require("require_fb_like.php"); ?>
      <?php if ($row_RecordBlog['pass'] == '' || $row_RecordBlog['userid'] == $_SESSION['w_userid'] || $_POST['pass'] == $row_RecordBlog['pass']) { ?>
         <?php echo pageBreak($row_RecordBlog['content']); ?>
         <br />
		 <div class="columns on-1">
        <div class="container board">
            <div class="column">
			  <script>
                $(function() {
                    $( "#tabs" ).tabs({
                        //event: "mouseover"
							error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				}
			
                    });
                });
                </script>
                <!--Tab-->
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1"><?php echo $Lang_Tab_Reply //問答紀錄 ?></a></li>
                    </ul>
                    <div id="tabs-1">
<?php 
						switch($row_RecordBlog['replylevel'])
							{
								case "0":
								if($_SESSION['MM_Username_' . $_GET['wshop']] != '' && $_SESSION['wshopforckeditor'] != '' && $_SESSION['MM_UserGroup_' . $_GET['wshop']] != '')
								{
									require("require_blogpost_member.php"); 
								}else{
									require("require_blogpost.php"); 
								}
									
								break;
								case "1":
									require("require_blogpost_member.php"); 
								break;
								case "2":
									require("require_blogpost_member.php"); 
								break;
								case "3":			
								break;
							}
						?>
                    </div>
                </div>  
                <!--Tab-->             
            </div>
        </div>
  </div>
      <?php } else { ?>
	  <?php
	  $editFormAction = $_SERVER['PHP_SELF'];
		if (isset($_SERVER['QUERY_STRING'])) {
		  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
		} 
	  ?>
      <span style="color:#666;"><?php echo $Lang_Classify_Context_ReadMoreTip_Blog //閱讀此文章需要提示 ?><br />
            <?php echo $Lang_Classify_Context_PswTip_Blog //密碼提示： ?><?php echo $row_RecordBlog['passtip']; ?><br />   
            <form id="FormPassCheck" name="FormPassCheck" method="post" action="<?php echo $editFormAction; ?>">
              <?php echo $Lang_Classify_Context_Psw_Blog //密碼： ?>
              <input type="text" name="pass" id="pass" />
            </form>
            <br />
      </span>
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
<a name="rpdown" id="rpdown"></a><!-- 跳置最底 -->
<!--外框-->
<?php } while ($row_RecordBlog = mysqli_fetch_assoc($RecordBlog)); ?>