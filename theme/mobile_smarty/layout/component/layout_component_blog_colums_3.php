
<!-- POST ITEM -->
<div class="row">
<?php foreach ($row_data as $row_data) { ?>
<div class="blog-post-item col-md-4 col-sm-4">

    <!-- IMAGE -->
    <figure class="margin-bottom-20">
        <img class="img-responsive" src="demo_files/images/720x400/3-min.jpg" alt="">
    </figure>
	<div class="photoFrame_base">
          <div class="shop-item nomargin"> 
               <div class="imgLiquid" data-fill="<?php echo 'resize'; /* resize or crop */ ?>" data-board="<?php echo '1'; /* 方型 or 矩形 */ ?>">
               		<a href="<?php echo $row_data['link_url']; ?>"><img src="<?php echo $row_data['link_pic']; ?>" alt="<?php echo $row_data['sdescription']; ?>" /></a><span></span>
          </div>
    </div>

    <h2><a href="<?php echo $row_data['link_url']; ?>"><?php echo $row_data['title']; ?></a></h2>

    <ul class="blog-post-info list-inline">
        <li>
            <a href="#">
                <i class="fa fa-clock-o"></i> 
                <span class="font-lato"><?php echo $row_data['postdate']; ?></span>
            </a>
        </li>
    </ul>

    <p><?php echo $row_data['sdescription']; ?></p>

    <a href="<?php echo $row_data['link_url']; ?>" class="btn btn-reveal btn-default">
        <i class="fa fa-plus"></i>
        <span>Read More</span>
    </a>

    </div>
</div>
<?php } ?>
</div>
<!-- /POST ITEM -->
					
