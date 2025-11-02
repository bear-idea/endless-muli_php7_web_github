<?php
/* 更新資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Ad")) {
  $updateSQL = sprintf("UPDATE demo_adtype SET theme=%s, tool=%s, dataheight=%s, lang=%s WHERE act_id=%s",
                       GetSQLValueString($_POST['theme'], "text"),
                       GetSQLValueString($_POST['tool'], "int"),
					   GetSQLValueString($_POST['dataheight'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['act_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";
  
  switch($row_RecordAd['type'])
  {
	  case "banner":
		  $updateGoTo = "manage_ads.php?Opt=viewpage&lang=" . $_POST['lang'];	
		  break;
	  case "homebannerimage":
		  $updateGoTo = "manage_ads_home_image.php?Opt=viewpage&lang=" . $_POST['lang'];	
		  break;
	  case "contentbannerimage":
		  $updateGoTo = "manage_ads_content_image.php?Opt=viewpage&lang=" . $_POST['lang'];	
		  break;
	  default:
		  $updateGoTo = "manage_ads.php?Opt=viewpage&lang=" . $_POST['lang'];
		  break;
  }
  //$updateGoTo = "manage_ads.php?Operate=editSuccess&Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}
?>


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 橫幅參數 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" id="form_Ad" name="form_Ad">
       
       <div class="form-group row">
          <label class="col-md-2 col-form-label">主題<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                                  <img src="images/theme-preview0.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['theme'],""))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="" id="theme_0"  />
                                            <label for="theme_0">風格1</label>
                                      </div>
                                  </div>
                              </div> 
                          
                             <div class="card pull-left m-5">
                                  <img src="images/theme-preview1.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['theme'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="1" id="theme_1"  />
                                        <label for="theme_1">風格2</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-preview2.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['theme'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="2" id="theme_2"  />
                                        <label for="theme_2">風格3</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-preview3.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['theme'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="3" id="theme_3"  />
                                        <label for="theme_3">風格4</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-preview4.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['theme'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="4" id="theme_4"  />
                                        <label for="theme_4">風格5</label>
                                      </div>
                                  </div>
                              </div> 
                          
                     
                 
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">工具列<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                                  <div style="position: absolute;"></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['tool'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tool" value="0" id="tool_0"  />
                                            <label for="tool_0">不使用</label>
                                      </div>
                                  </div>
                              </div> 
                          
                             <div class="card pull-left m-5">
                                  <div style="position: absolute;"><img src="images/bmod_thumb_small.png" /></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['tool'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tool" value="1" id="tool_1"  />
                                        <label for="tool_1">風格1</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                  <div style="position: absolute;"><img src="images/bmod_thumb_large.png" /></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['tool'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tool" value="2" id="tool_2"  />
                                        <label for="tool_2">風格2</label>
                                      </div>
                                  </div>
                              </div> 
                             
                             
                          
                     
                 
             
          </div>
      </div>
      
      
      
      
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">橫幅預設高度</label>
          <div class="col-md-10">
                      <input name="dataheight" class="form-control" id="dataheight" value="<?php echo $row_RecordAd['dataheight']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required/>
                      
        </div>
      </div>
       
       
      
     
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="act_id" type="hidden" id="act_id" value="<?php echo $row_RecordAd['act_id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordAd['lang']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      
      
  <input type="hidden" name="MM_update" value="form_Ad" />
  </form>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->



