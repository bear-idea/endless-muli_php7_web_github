<div style="height:5px;"></div>
<form action="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>" method="get">
    <div class="input-group">
        <input type="text" id="searchkey" name="searchkey" class="form-control required" placeholder="<?php echo $Lang_Classify_Product_Name_Search; ?>">
        <span class="input-group-btn">
            <button class="btn btn-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </span>
    </div>
    <?php if($UrlWriteEnable == '0') { ?>
    <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
    <input name="lang" type="hidden" id="lang" value="<?php echo $_SESSION['lang']; ?>" />
    <?php } ?>
</form>
<div style="height:5px;"></div>