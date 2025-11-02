<?php
/* 更新資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Ad")) {
  $updateSQL = sprintf("UPDATE demo_adtype SET theme=%s, tool=%s, navigationstate=%s, label=%s, `interval`=%s, lang=%s WHERE act_id=%s",
                       GetSQLValueString($_POST['theme'], "text"),
                       GetSQLValueString($_POST['tool'], "int"),
                       GetSQLValueString($_POST['navigationstate'], "int"),
                       GetSQLValueString($_POST['label'], "text"),
					   GetSQLValueString($_POST['interval'], "text"),
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
                                  <img src="images/theme-default.jpg" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['theme'],""))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="" id="theme_0"  />
                                            <label for="theme_0">風格1</label>
                                      </div>
                                  </div>
                              </div> 
                          
                             <div class="card pull-left m-5">
                                  <img src="images/theme-clean.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['theme'],"clean"))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="clean" id="theme_1"  />
                                        <label for="theme_1">風格2</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-minimalist.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['theme'],"minimalist"))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="minimalist" id="theme_2"  />
                                        <label for="theme_2">風格3</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-round.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['theme'],"round"))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="round" id="theme_3"  />
                                        <label for="theme_3">風格4</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <img src="images/theme-square.jpg" alt="" width="100" height="100"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['theme'],"square"))) {echo "checked=\"checked\"";} ?> type="radio" name="theme" value="square" id="theme_4"  />
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
                                  <div style="position: absolute;"><img src="images/bmod_num.png" /></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['tool'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tool" value="1" id="tool_1"  />
                                        <label for="tool_1">風格1</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                  <div style="position: absolute;"><img src="images/bmod_dot.png" /></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['tool'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tool" value="2" id="tool_2"  />
                                        <label for="tool_2">風格2</label>
                                      </div>
                                  </div>
                              </div> 
                              <div class="card pull-left m-5">
                                  <div style="position: absolute;"><img src="images/bmod_dotswithpreview.png" /></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['tool'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="tool" value="3" id="tool_3"  />
                                        <label for="tool_3">風格3</label>
                                      </div>
                                  </div>
                              </div> 
                             
                          
                     
                 
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">切換按鈕<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                                  <div style="position: absolute;"></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['navigationstate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="navigationstate" value="0" id="navigationstate_0"  />
                                            <label for="navigationstate_0">不顯示</label>
                                      </div>
                                  </div>
                              </div> 
                          
                             <div class="card pull-left m-5">
                                  <div style="position: absolute;"><img src="images/bmod_arrow1.png" /></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['navigationstate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="navigationstate" value="1" id="navigationstate_1"  />
                                        <label for="navigationstate_1">顯示</label>
                                      </div>
                                  </div>
            </div> 
                              <div class="card pull-left m-5">
                                  <div style="position: absolute;"><img src="images/bmod_arrow_hover.png" /></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['navigationstate'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="navigationstate" value="2" id="navigationstate_2"  />
                                        <label for="navigationstate_2">滑鼠移入顯示</label>
                                      </div>
                                  </div>
                              </div> 
                              
                          
                     
                 
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">說明<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         
                             <div class="card pull-left m-5">
                                  <div style="position: absolute;"></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['label'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="label" value="0" id="label_0"  />
                                            <label for="label_0">不顯示</label>
                                      </div>
                                  </div>
                              </div> 
                          
                             <div class="card pull-left m-5">
                                  <div style="position: absolute;"><img src="images/bmod_label.png" /></div><img src="images/bmod_bk_animation.png" width="150" height="150"/>
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                        <input <?php if (!(strcmp($row_RecordAd['label'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="label" value="1" id="label_1"  />
                                        <label for="label_1">顯示</label>
                                      </div>
                                  </div>
            </div> 
                             
                              
                          
                     
                 
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">相片外框<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
      <select name="interval" size="1" id="interval" class="form-control" data-parsley-trigger="blur" required="">
                  <option>-- 預設 --</option>
                  <option value="5000" <?php if (!(strcmp('5000', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>5 秒</option>
                  <option value="4500" <?php if (!(strcmp('4500', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>4.5 秒</option>
                  <option value="4000" <?php if (!(strcmp('4000', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>4 秒</option>
                  <option value="3500" <?php if (!(strcmp('3500', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>3.5 秒</option>
                  <option value="3000" <?php if (!(strcmp('3000', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>3 秒</option>
                  <option value="2500" <?php if (!(strcmp('2500', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>2.5 秒</option>
                  <option value="2000" <?php if (!(strcmp('2000', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>2 秒</option>
                  <option value="1500" <?php if (!(strcmp('1500', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>1.5 秒</option>
                  <option value="1000" <?php if (!(strcmp('1000', $row_RecordAd['interval']))) {echo "selected=\"selected\"";} ?>>1 秒</option>
                </select>
             
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