<div class="timeline">
	<!-- .timeline-inverse = right position [left on RTL] -->
    <div class="timeline-hline"><!-- horizontal line --></div>

	<?php foreach ($row_data as $row_data) { ?>
    <!-- POST ITEM -->
    <div class="blog-post-item">

        <!-- timeline entry -->
        <div class="timeline-entry"><!-- .rounded = entry -->
            <?php echo $row_data['day']; ?><span><?php echo $row_data['month']; ?></span>
            <div class="timeline-vline"><!-- vertical line --></div>
        </div>
        <!-- /timeline entry -->

        <h2><a href="<?php echo $row_data['link_url']; ?>"><?php echo $row_data['title']; ?></a></h2>

        <ul class="list-inline">
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
    <!-- /POST ITEM -->
	<?php } ?>

</div>
