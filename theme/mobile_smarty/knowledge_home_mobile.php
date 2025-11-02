<style type="text/css">
div .knowledge_inner_board{margin:0;padding:0;width:130px}
div .knowledge_inner_board .photoFram_Block_glossy,.div_knowledge_table-cell{overflow:hidden;height:90px;width:120px}
.knowledge_inner_board_relative{position:relative}
.knowledge_inner_board_relative_buttom{position:relative}
.div_knowledge_table-cell{text-align:center;vertical-align:middle;background:#fff;border:4px solid #fff;position:relative;-webkit-border-radius:4px;-moz-border-radius:4px;-o-border-radius:4px;border-radius:4px;box-shadow:0 1px 4px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 4px rgba(0,0,0,.2);-moz-box-shadow:0 1px 4px rgba(0,0,0,.2);-o-box-shadow:0 1px 4px rgba(0,0,0,.2)}
.div_knowledge_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_knowledge_table-cell *{vertical-align:middle}
div .knowledge_inner_board_context{text-align:left}
td.knowledge_down_board{padding:5px}
.knowledge_bottom_hight{height:5px}
.div_right_bottom_Knowledge{width:100px;float:right;right:0;bottom:0;z-index:20;border:0 solid #69c;_position:absolute}
</style>
               <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php if($row_RecordTmpConfig['tmphomeknowledgeshowtype'] == "1") {echo $row_RecordKnowledgeMultiTypeMenu_l1['itemname']; } else {echo $ModuleName['Knowledge']; } ?></span></h1>
                </div>
  <!--<div class="owl-carousel owl-padding-0 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>-->
  <ul class="list-inline row nomargin">  
 	  <?php $i=$startRow_RecordActnews + 1; // 取得頁面第一項商品之編號 ?>
      <?php $m_count=1; ?>
          <?php do { ?> 
                <li class="col-md-3 col-sm-6 col-xs-6">
                <div class="photoFrame_base">
                                <div class="shop-item nomargin"> 
                                <div class="imgLiquid" data-fill="<?php echo 'resize'; /* resize or crop */ ?>" data-board="<?php echo '1'; /* 方型 or 矩形 */ ?>">
                                <?php if ($row_RecordKnowledge['pic'] != "") { ?>	 
									   <?php if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1' && $row_RecordKnowledge['type3'] != '-1') { ?>
									   <a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2'],'type3'=>$row_RecordKnowledge['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alt="<?php echo $row_RecordKnowledge['sdescription']; ?>"/></a>
									   <?php } else if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1') { ?>
									   <a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alt="<?php echo $row_RecordKnowledge['sdescription']; ?>"/></a>
									   <?php } else if($row_RecordKnowledge['type1'] != '-1') { ?>
									   <a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alt="<?php echo $row_RecordKnowledge['sdescription']; ?>"/></a>
									   <?php } else  { ?>
									   <a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alt="<?php echo $row_RecordKnowledge['sdescription']; ?>"/></a>
									   <?php } ?>
									  <?php } else { ?>      
									  <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a>
									  <?php } ?>
                
                </div>
                                </div>
                                
                                <div class="knowledge_inner_board_context">
									   <?php if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1' && $row_RecordKnowledge['type3'] != '-1') { ?>
									   <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2'],'type3'=>$row_RecordKnowledge['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
									   <?php } else if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1') { ?>
									   <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
									   <?php } else if($row_RecordKnowledge['type1'] != '-1') { ?>
									   <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
									   <?php } else  { ?>
									   <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
									   <?php } ?>
									</div>
								</div>
                                
                   
                 </li>
          <?php $m_count++; ?>
          <?php $i++; ?>
          
          <?php } while ($row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge)); ?>
          </ul>
<!--</div>-->
<script type="text/javascript"> 
    $('.knowledge_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, 
	resize:true
	});
</script>