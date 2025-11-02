<?php if ($MSNewsPNPage == '1') { ?>
<?php if ($row_RecordNewsPrev['id'] != '') { ?>
<div id="left-fixed-center"><a href="news.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=News&amp;lang=<?php echo $_GET['lang'] ?>&amp;id=<?php echo $row_RecordNewsPrev['id']; ?>"></a></div>
<?php } ?>
<?php if ($row_RecordNewsNext['id'] != '') { ?>
<div id="right-fixed-center"><a href="news.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=News&amp;lang=<?php echo $_GET['lang'] ?>&amp;id=<?php echo $row_RecordNewsNext['id']; ?>"></a></div>
<?php } ?>
<?php } ?>
<!--前後筆資料 END-->
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $row_RecordNews['title']; ?></span></h1>
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
<!--標題外框-->
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
                     <span style="float:right; margin-right:5px; width:350px; text-align:right;"><?php require("require_sharelink.php"); ?></span>
                     <?php //require("require_fb_like.php"); ?>
                    
						<?php echo pageBreak($row_RecordNews['content']); ?>
                        <?php if($row_RecordNews['skeyword'] != "" && $row_RecordNews['skeywordindicate'] == "1") { ?>
                        <div style="clear:both;"></div>
                        <div style="border:0px #CCCCCC dotted; padding:5px;" class="keytag">
                        <a>&nbsp;<i class="fa fa-tag"></i>&nbsp;</a><?php
                        $arr_tag = explode(',', $row_RecordNews['skeyword']);
						//echo $SiteBaseUrl . url_rewrite("news",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordNews['id']),'',$UrlWriteEnable);
                        for($i = 0; $i < count($arr_tag); $i++){ echo "<a href=\"".$SiteBaseUrl . url_rewrite("news",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'search'),'',$UrlWriteEnable).$tag_params.$arr_tag[$i] ."\">".$arr_tag[$i]."</a>";}
                        ?></div>
                        
                        <?php } ?>
                        <?php if ($MSNewsRadom == '1') { ?>
                        <?php //require("require_news_list_random.php"); ?>
                        <?php } ?>
                        <hr>
     <?php if ($MSNewsQA == '1') { ?>
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
                        <li><a href="#tabs-1"><?php echo $Lang_Tab_Facebook_Reply; //Facebook回應 ?></a></li>
                        <li><a href="<?php echo $SiteBaseUrl; ?>require_newspost.php?id=<?php echo $row_RecordNews['id']; ?>"><?php echo $Lang_Tab_Reply; //問答紀錄 ?></a></li>
                    </ul>
                    <div id="tabs-1">
                    	<div class="container left_ct_board">
                        	<div id="fb-root"></div>
							<script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) {return;}
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>

							<div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-num-posts="2" data-width="500"></div>
                        </div> 
                    </div>
                </div>  
                <!--Tab-->             
            </div>
        </div>
  </div> 
  <?php } ?>                      
                        
                          
                           
                            <!-- **************************************************************** -->

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