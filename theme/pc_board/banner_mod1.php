<script>
$(function() {
var	_navigationstate 	= <?php echo $row_RecordAds['navigationstate']; ?> || null;
	_tool 	= <?php echo $row_RecordAds['tool']; ?> || null;	
	_dots 	=  false;
	_preview 	=  false;
	_numbers 	=  false;
	_navigation 	=  false; 
	_hide_tools 	=  false;
	_numbers_align 	= 'center';


if(_tool == '0') {
} else if(_tool == '1'){
	_numbers 	=  true;
	_numbers_align 	= 'left';
	 
} else if(_tool == '2'){
	_dots 	=  true;
} else if(_tool == '3'){
	_dots 	=  true;
	_preview 	=  true;
}

if(_navigationstate == '0') {
} else if(_navigationstate == '1'){
	_navigation 	=  true; 
	 
} else if(_navigationstate == '2'){
	_navigation 	=  true; 
	_hide_tools 	=  true; 
}

  $('.skitter-large<?php echo $row_RecordAds['act_id']; ?>').skitter({
        navigation: _navigation,
		dots: _dots,
		hide_tools: _hide_tools,
		interval: <?php echo $row_RecordAds['interval']; ?>,
		label:<?php echo $row_RecordAds['label']; ?>,
		numbers:_numbers,
		numbers_align:_numbers_align,
		preview: _preview,
		theme:'<?php echo $row_RecordAds['theme']; ?>'
});
});
</script> 
<div class="skitter skitter-large<?php echo $row_RecordAds['act_id']; ?> <?php if ($row_RecordAds['tool'] == "2" || $row_RecordAds['tool'] == "3") { echo "with-dots"; } ?>">
  <ul>
    <?php do { ?>
    <li><a href="<?php echo $row_RecordAds['link']; ?>#<?php echo $row_RecordAds['animation']; ?>" target="<?php if($row_RecordAds['link'] == "") {echo "_self";}else{echo $row_RecordAds['linktarget'];} ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/banner/<?php echo $row_RecordAds['pic']; ?>" class="<?php echo $row_RecordAds['animation']; ?>" /></a>
      <?php //if ($row_RecordAds['label'] == "true") { ?>
      <div class="label_text">
        <p style="text-align:left;"><?php echo $row_RecordAds['sdescription']; ?></p>
      </div>
    </li>
    <?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
  </ul>
</div>
