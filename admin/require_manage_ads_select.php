<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_RecordAd = "-1";
if (isset($_GET['act_id'])) {
  $colname_RecordAd = $_GET['act_id'];
}
$coluserid_RecordAd = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAd = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAd = sprintf("SELECT * FROM demo_adtype WHERE act_id = %s && userid=%s", GetSQLValueString($colname_RecordAd, "int"),GetSQLValueString($coluserid_RecordAd, "int"));
$RecordAd = mysqli_query($DB_Conn, $query_RecordAd) or die(mysqli_error($DB_Conn));
$row_RecordAd = mysqli_fetch_assoc($RecordAd);
$totalRows_RecordAd = mysqli_num_rows($RecordAd);

/* 更新資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Ad")) {
  $updateSQL = sprintf("UPDATE demo_adtype SET modstyle=%s WHERE act_id=%s",
                       GetSQLValueString($_POST['modstyle'], "int"),
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
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

?>
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/skitter-master/dist/skitter.css" type="text/css" media="all" rel="stylesheet" />
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/skitter-master/dist/jquery.skitter.min.js"></script>
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>assets/js/view/demo.revolution_slider.js"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 橫幅樣式 <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-database"></i> 資料選擇</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <form id="form_Ad" name="form_Ad" action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" >
    
    
    <div class="form-group row">
          <label class="col-md-2 col-form-label">主題<span class="text-red">*</span></label>
          <div class="col-md-5">
                                      <div class="skitter skitter-large">
                <ul>
                  <li> <a href="#cut"> <img src="images/linkphoto/banner_link_photo08.jpg" class="cut" /> </a>
                    <div class="label_text">
                      <p> 文字描述 1  </p>
                    </div>
                  </li>
                  <li> <a href="#swapBlocks"> <img src="images/linkphoto/banner_link_photo09.jpg" class="swapBlocks" /> </a>
                    <div class="label_text">
                      <p> 文字描述 2  </p>
                    </div>
                  </li>
                  <li> <a href="#swapBarsBack"> <img src="images/linkphoto/banner_link_photo10.jpg" class="swapBarsBack" /> </a>
                    <div class="label_text">
                      <p> 文字描述 3  </p>
                    </div>
                  </li>
                </ul>
              </div>
              
            <script>
            $('.skitter-large').skitter({
              navigation: true, /* Navigation display */
              dots: false,
			  hide_tools: false,
			  interval: 3000,
			  label:true /* Label display */
			  //theme: round /* minimalist, round, clean, square */
            });
            </script>
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['modstyle'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="modstyle" value="0" id="modstyle_0"  />
                                            <label for="modstyle_0">風格1</label>
                                      </div>
                                
                          
                          
                          
                     
                 
             
          </div>
          
          
          <div class="col-md-5">
                                      <div class="slider fullwidthbanner-container roundedcorners">
                  <div class="fullwidthbanner" data-height="300" data-shadow="" data-navigationStyle="">
                    <ul class="hide">
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-saveperformance="off" >
      <img src="../assets/images/1x1.png" data-lazyload="images/linkphoto/banner_link_photo12.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="110" data-bgpositionend="center bottom" />
                                    <div class="tp-caption very_big_white lfb start" 
										data-x="center" data-hoffset="0"
										data-y="center" 
										data-speed="300" 
										data-start="1200" 
										data-easing="easeOutExpo" 
										data-splitin="none" 
										data-splitout="none" 
										data-elementdelay="0.1" 
										data-endelementdelay="0.1" 
										data-endspeed="300">
											標題<br /> 文字內容 1
									</div>

                    </li>
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-saveperformance="off" >
      <img src="../assets/images/1x1.png" data-lazyload="images/linkphoto/banner_link_photo07.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="110" data-bgpositionend="center bottom" />
                                    <div class="tp-caption very_big_white lfb start" 
										data-x="right" data-hoffset="-20"
										data-y="top" data-voffset= "20" 
										data-speed="300" 
										data-start="1200" 
										data-easing="easeOutExpo" 
										data-splitin="none" 
										data-splitout="none" 
										data-elementdelay="0.1" 
										data-endelementdelay="0.1" 
										data-endspeed="300">
											標題<br /> 文字內容 2
									</div>

                    </li>

                     </ul>
                    <div class="tp-bannertimer"></div>
                  </div>
                </div>
              
          
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordAd['modstyle'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="modstyle" value="1" id="modstyle_1"  />
                                            <label for="modstyle_1">風格2</label>
                                      </div>
                                
                          
                          
                          
                     
                 
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="act_id" type="hidden" id="act_id" value="<?php echo $row_RecordAd['act_id']; ?>" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordAd['lang']; ?>" />
          </div>
      </div>
    
    
    
          
<input type="hidden" name="MM_update" value="form_Ad" />
      </form>
    
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel --> 

<?php
mysqli_free_result($RecordAd);
?>