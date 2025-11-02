<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 選擇網站方案 <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 選擇資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="manage_webuser.php?wshop=<?php echo $wshop;?>&amp;Opt=modaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <label class="col-md-2 col-form-label">方案類型<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                             <div class="card pull-left m-5">
                                  <div class="imgLiquidFill" style="width: 120px; height: 120px;"><img src="images/shop3500.png" width="130"/></div>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input name="modselect" type="radio" id="modselect_1" value="1" checked="checked"  />
                                            <label for="modselect_1">企業網站</label>
                                      </div>
                                  </div>
                             </div> 
                          
                             <div class="card pull-left m-5">
                                  <div class="imgLiquidFill" style="width: 120px; height: 120px;"><img src="images/1881shop.png"/></div>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input type="radio" name="modselect" value="2" id="modselect_2"  />
                                            <label for="modselect_2">購物商城</label>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <div class="imgLiquidFill" style="width: 120px; height: 120px;"><img src="images/lcrwd.png"/></div>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input type="radio" name="modselect" value="3" id="modselect_3"  />
                                            <label for="modselect_3">企業網站【基本】</label>
                                      </div>
                                  </div>
                              </div> 
                              
                              <div class="card pull-left m-5">
                                  <div class="imgLiquidFill" style="width: 120px; height: 120px;"><img src="images/lcrwd.png"/></div>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input type="radio" name="modselect" value="4" id="modselect_4"  />
                                            <label for="modselect_4">企業網站【進階】</label>
                                      </div>
                                  </div>
                              </div> 
                      
                 
          </div>
      </div>
      
      
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
           <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          </div>
      </div>
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script>
$(document).ready(function() {
	$(".imgLiquidFill").imgLiquid({fill:false});
});
</script>

