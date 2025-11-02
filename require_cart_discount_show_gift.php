<?php if(isset($DiscountShowAll['DiscountGetType7']['discount']) && $DiscountShowAll['DiscountGetType7']['discount'] == '1') { ?>
<div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
<div class="row nomargin">
  <div class="col-md-1 col-sm-1 col-xs-2">
    <div class="shop-item margin-bottom-10">
      <div class="imgLiquid" data-fill="<?php echo $TmpProductImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpProductImageBoard; /* 方型 or 矩形 */ ?>"><a><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/productgift/<?php echo $DiscountShowAll['DiscountGetType7']['discountGiftPic']; ?>" alt=""/></a>
        <div style="clear:both"></div>
      </div>
    </div>
  </div>
  <div class="col-md-11 col-sm-11 col-xs-10">
    <div style="float:right;">
      <input name="dcprice[]" type="hidden" id="dcprice[]" value="0">
      <div style="color:#999; text-align:right;">X<?php echo $DiscountShowAll['DiscountGetType7']['discount']; ?></div>
      <input name="dcquantiry[]" type="hidden" id="dcquantiry[]" value="<?php echo $DiscountShowAll['DiscountGetType7']['discount']; ?>" />
    </div>
    <?php //if($row_RecordDiscountGetType7['pdseries'] == '') {} else { echo $row_RecordDiscountGetType7['pdseries']; } ?>
    <input name="pdseries[]" type="hidden" id="pdseries[]" value="<?php echo $row_RecordDiscountGetType7['pdseries']; ?>" />
    <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'gift'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordDiscountGetType7['pid']; ?>" style="font-size:16px;"><?php echo $DiscountShowAll['DiscountGetType7']['discountGift']; ?></a>
    <input name="dcproductname[]" type="hidden" id="dcproductname[]" value="<?php echo $DiscountShowAll['DiscountGetType7']['discountGift']; ?>" />
    <input name="id[]" type="hidden" id="id[]" value="<?php echo $DiscountShowAll['DiscountGetType7']['discountGiftID']; ?>" />
    <?php //if($row_RecordCartlist['Format'] != "") { ?>
    <br />
    <span class="keytag">
    <?php $arr_tag = explode(';', "滿額贈禮"); for($fi = 0; $fi < count($arr_tag); $fi++){ echo "<a>".$arr_tag[$fi]."</a>";}?>
    </span>
    <?php //} ?>
    <input name="dcformat[]" type="hidden" id="dcformat[]" value="滿額贈禮" />
    <input name="dcitemtotal[]" type="hidden" id="dcitemtotal[]" value="0" />
  </div>
</div>
</div>
<?php } ?>