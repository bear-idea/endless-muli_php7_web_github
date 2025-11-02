<script type="text/javascript" src="js/jquery.galleryview-3.0-dev.js"></script>
<link type="text/css" rel="stylesheet" href="css/jquery.galleryview-3.0-dev.css" />
<script type="text/javascript">
	$(function(){
		$('#myGallery').galleryView({
			 // General Options
			transition_speed: 350, 		
			transition_interval: 5000, 		
			// Panel Options
			show_panels: true, 				
			show_panel_nav: true, 			
			enable_overlays: true, 
			panel_width: 380, 				
			panel_height: 380, 	
			panel_animation: 'fade', 		// (crossfade,fade,slide,none)
			panel_scale: 'crop', 			// crop , fit
			overlay_position: 'bottom', 	// (bottom, top)
			pan_images: false,				// 圖片是否可拖動
			pan_style: 'drag',				//STRING - panning method (drag = user clicks and drags image to pan, track = image automatically pans based on mouse position
			// Filmstrip Options
			start_frame: 1, 				
			show_filmstrip: true, 			
			show_filmstrip_nav: true, 		
			enable_slideshow: true,			
			autoplay: false,				
			show_captions: false, 			
			filmstrip_size: 3, 				
			filmstrip_style: 'scroll', 		//STRING - type of filmstrip to use (scroll = display one line of frames, scroll filmstrip if necessary, showall = display multiple rows of frames if necessary)
			filmstrip_position: 'bottom', 	//(bottom, top, left, right)
			frame_width: 50, 				
			frame_height: 50, 				
			frame_opacity: 0.7, 			
			frame_scale: 'fit', 			
			frame_gap: 5, 					
			
			// Info Bar Options
			show_infobar: true,				//BOOLEAN - flag to show or hide infobar
			infobar_opacity: 1				//FLOAT - transparency for info bar
		});
	});
</script>
<?php if ($row_RecordBnb['pic1'] != "" || $row_RecordBnb['pic2'] != "" || $row_RecordBnb['pic3'] != "" || $row_RecordBnb['pic4'] != "" || $row_RecordBnb['pic5'] != "") { ?>
<ul id="myGallery">
    <?php if ($row_RecordBnb['pic1'] != '') { ?>
    <li><img data-frame="bnb_img/<?php echo $row_RecordBnb['pic1']; ?>" src="bnb_img/<?php echo $row_RecordBnb['pic1']; ?>" title="<?php echo $row_RecordBnb['name']; ?>" data-description="<?php echo DeleteSpace($row_RecordBnb['sdescription']); ?>"></li>
    <?php } ?>
    <?php if ($row_RecordBnb['pic2'] != '') { ?>
    <li><img data-frame="bnb_img/<?php echo $row_RecordBnb['pic2']; ?>" src="bnb_img/<?php echo $row_RecordBnb['pic2']; ?>" title="<?php echo $row_RecordBnb['name']; ?>" data-description="<?php echo DeleteSpace($row_RecordBnb['sdescription']); ?>"></li>
    <?php } ?>
    <?php if ($row_RecordBnb['pic3'] != '') { ?>
    <li><img data-frame="bnb_img/<?php echo $row_RecordBnb['pic3']; ?>" src="bnb_img/<?php echo $row_RecordBnb['pic3']; ?>" title="<?php echo $row_RecordBnb['name']; ?>" data-description="<?php echo DeleteSpace($row_RecordBnb['sdescription']); ?>"></li>
    <?php } ?>
    <?php if ($row_RecordBnb['pic4'] != '') { ?>
    <li><img data-frame="bnb_img/<?php echo $row_RecordBnb['pic4']; ?>" src="bnb_img/<?php echo $row_RecordBnb['pic4']; ?>" title="<?php echo $row_RecordBnb['name']; ?>" data-description="<?php echo DeleteSpace($row_RecordBnb['sdescription']); ?>"></li>
    <?php } ?>
    <?php if ($row_RecordBnb['pic5'] != '') { ?>
    <li><img data-frame="bnb_img/<?php echo $row_RecordBnb['pic5']; ?>" src="bnb_img/<?php echo $row_RecordBnb['pic5']; ?>" title="<?php echo $row_RecordBnb['name']; ?>" data-description="<?php echo DeleteSpace($row_RecordBnb['sdescription']); ?>"></li>
    <?php } ?>
</ul>
<?php } else { ?>
<?php //$arrpic = getimagesize("upload/image/bnb/" . $row_RecordBnbChange['pic']); // 取得圖片資訊?>
	<div class="div_table-cell">
		<img src="images/100x100_noimage.jpg" alumb="false" _w="380" _h="380"/><span></span>
    </div>
<?php } ?>