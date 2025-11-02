<?php
	switch($row_RecordAds['theme'])
	{
		case "1":
			$datanavigationStyle = "preview1";			
			break;
		case "2":
			$datanavigationStyle = "preview2";			
			break;
		case "3":
			$datanavigationStyle = "preview3";			
			break;
		case "4":
			$datanavigationStyle = "preview4";			
			break;
		default:
			$datanavigationStyle = "";
			break;
	}
	switch($row_RecordAds['tool'])
	{
		case "0":
		    $thumbshow = "";		
			break;
		case "1":
			$datanavigationStyle = "";
			$thumbshow = "thumb-small";	
			break;
		case "2":
			$datanavigationStyle = "";
			$thumbshow = "thumb-large";		
			break;
		default:
			break;
	}
?>
<div class="slider fullwidthbanner-container roundedcorners <?php if ($row_RecordAds['tool'] == "2") {echo "margin-bottom-100";} ?>">
  <div class="fullwidthbanner <?php echo $thumbshow; ?>" data-height="<?php echo $row_RecordAds['dataheight']; ?>" data-shadow="3" data-navigationStyle="<?php echo $datanavigationStyle; ?>">
    <ul class="hide">
      <?php do { ?>
<?php 
	switch($row_RecordAds['datakenburns'])
	{
		case "0":
			$datakenburns = "off";			
			break;
		case "1":
			$datakenburns = "on";			
			break;
	}
	switch($row_RecordAds['databgposition'])
	{
		case "0":
			$databgposition = "center center";
			$databgpositionend = "left top";			
			break;
		case "1":
			$databgposition = "center center";
			$databgpositionend = "left bottom";	
			break;
		case "2":
			$databgposition = "center center";
			$databgpositionend = "right bottom";			
			break;
		case "3":
			$databgposition = "center center";
			$databgpositionend = "right top";			
			break;
		case "4":
			$databgposition = "center center";
			$databgpositionend = "center bottom";			
			break;
		case "5":
			$databgposition = "center center";
			$databgpositionend = "center top";		
			break;
		case "6":
			$databgposition = "center center";
			$databgpositionend = "left center";		
			break;
		case "7":
			$databgposition = "center center";
			$databgpositionend = "right center";				
			break;
	}
	switch($row_RecordAds['databgzoom'])
	{
		case "0":
			$databgfit = "100";	
			$databgfitend = "110";			
			break;
		case "1":
			$databgfit = "100";	
			$databgfitend = "150";		
			break;
		case "2":
			$databgfit = "110";	
			$databgfitend = "100";		
			break;
		case "3":
			$databgfit = "150";	
			$databgfitend = "100";		
			break;
	}
	switch($row_RecordAds['datacontentlocation'])
	{
		case "0":
			$datax = "left";	
			$datay = "top";
			$datahoffset = "10";
			$datavoffset = "10";			
			break;
		case "1":
			$datax = "left";	
			$datay = "bottom";
			$datahoffset = "10";
			$datavoffset = "-10";		
			break;
		case "2":
			$datax = "right";	
			$datay = "bottom";
			$datahoffset = "-10";
			$datavoffset = "-10";		
			break;
		case "3":
			$datax = "right";	
			$datay = "top";
			$datahoffset = "-10";
			$datavoffset = "10";		
			break;
		case "4":
			$datax = "center";	
			$datay = "bottom";
			$datahoffset = "0";
			$datavoffset = "-10";		
			break;
		case "5":
			$datax = "center";	
			$datay = "top";
			$datahoffset = "0";
			$datavoffset = "10";		
			break;
		case "6":
			$datax = "left";	
			$datay = "center";
			$datahoffset = "10";
			$datavoffset = "0";		
			break;
		case "7":
			$datax = "right";	
			$datay = "center";
			$datahoffset = "-10";
			$datavoffset = "0";		
			break;
		case "8":
			$datax = "center";	
			$datay = "center";
			$datahoffset = "0";
			$datavoffset = "0";		
			break;
	}
	switch($row_RecordAds['datacontentoverlay1'])
	{
		case "0":	
			break;
		case "1":
			$datacontentoverlay_location = "left";			
			break;
		case "2":
			$datacontentoverlay_location = "right";	
			break;
		case "3":
			$datacontentoverlay_location = "center";	
			break;
	}
?>
      <li data-transition="<?php echo $row_RecordAds['datatransition']; ?>" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off"  data-title="Slide" data-thumb="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/banner/thumb/small_<?php echo $row_RecordAds['pic']; ?>">
      <img src="<?php echo $SiteBaseUrl; ?>assets/images/1x1.png" data-lazyload="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/banner/<?php echo $row_RecordAds['pic']; ?>" alt="" data-bgposition="<?php echo $databgposition; ?>" data-kenburns="<?php echo $datakenburns; ?>" data-duration="10000" data-ease="Linear.easeNone" data-bgfit="<?php echo $databgfit; ?>" data-bgfitend="<?php echo $databgfitend; ?>" data-bgpositionend="<?php echo $databgpositionend; ?>" />
      
       <!-- <div class="tp-dottedoverlay twoxtwo"></div>-->
<?php 
/*
.tp-dottedoverlay						
.tp-dottedoverlay.twoxtwo				
.tp-dottedoverlay.twoxtwowhite			
.tp-dottedoverlay.threexthree			
.tp-dottedoverlay.threexthreewhite
*/
?>
		<!--<div class="overlay dark-3"></div>-->
        <?php if($row_RecordAds['datacontentoverlay1'] != "0") { ?>
        <div class="tp-caption lft start" data-x="<?php echo $datacontentoverlay_location; ?>" data-y="0" data-speed="750" data-start="750"data-easing="easeOutExpo" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300"><img src="<?php echo $SiteBaseUrl; ?>assets/images/1x1.png" alt="" data-lazyload="<?php echo $SiteBaseUrl; ?>assets/images/caption_bg.png"></div><?php } ?>
        <div class="tp-caption medium_light_white lfb start" data-x="<?php echo $datax; ?>" data-hoffset="<?php echo $datahoffset; ?>" data-y="<?php echo $datay; ?>" data-voffset="<?php echo $datavoffset; ?>" data-speed="300" data-start="1200" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300"><?php echo $row_RecordAds['datacontent']; ?></div>
 </li>
      <?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
    </ul>
    <div class="tp-bannertimer"></div>
  </div>
</div>
