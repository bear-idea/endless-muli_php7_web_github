<div style="height:10px;"></div>
<?php if($rows_moduleCount[$Tp_Page]/$maxRows[$Tp_Page] > 1) {?>
<div class="col-md-7 col-xs-12">
  <div style="text-align:center;">
    <?php //if ($page > 0) { // Show if not first page ?>
    <div class="col-md-3 col-xs-12"> <a href="<?php echo $rows_module[$Tp_Page]['first_page_url']; ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;"> <i class="fa fa-angle-double-left"></i> <span><?php echo $Lang_First; ?></span> </a> </div>
    <?php //} // Show if not first page ?>
	<div class="col-md-3 col-xs-12"> <a href="<?php echo $rows_module[$Tp_Page]['prev_page_url']; ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;"> <i class="fa fa-angle-right"></i> <span><?php echo $Lang_Prev; ?></span> </a> </div>
    <div class="col-md-3 col-xs-12"> <a href="<?php echo $rows_module[$Tp_Page]['next_page_url']; ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;"> <i class="fa fa-angle-right"></i> <span><?php echo $Lang_Next; ?></span> </a> </div>
    <?php //if ($page < $totalPages_RecordAbout) { // Show if not last page ?>
    <div class="col-md-3 col-xs-12"> <a href="<?php echo $rows_module[$Tp_Page]['last_page_url']; ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;"> <i class="fa fa-angle-double-right"></i> <span><?php echo $Lang_Last; ?></span> </a> </div>
    <?php //} // Show if not first page ?>
  </div>
</div>
<div class="col-md-5 col-xs-12">
  <div>
    <div class="col-md-3 col-xs-4"> <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;"> <span><?php echo $Lang_PageNum; ?></span> </a> </div>
    <div class="col-md-3 col-xs-4">
      <div style="margin:2px 0px 2px 0px;">
        <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
          <?php for($i=1; $i<=ceil($rows_moduleCount[$Tp_Page]/$maxRows[$Tp_Page]); $i++) { ?>
          <option value="<?php echo $SiteBaseUrl . url_rewrite($Tp_MdName, array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>$_GET['Opt'],'page'=>$i), '', $UrlWriteEnable); ?>" <?php if(@$_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-6 col-xs-4"> <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;"> <span><?php echo $Lang_Content_Count_Total; ?><?php echo $rows_moduleCount[$Tp_Page]; ?><?php echo $Lang_Content_Count_Lots; ?></span> </a> </div>
  </div>
</div>
<?php } ?>
<div style="clear:both;"></div>
