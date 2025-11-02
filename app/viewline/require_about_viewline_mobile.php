<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>	
<?php
foreach ($breadcrumbs as $breadcrumb)
{
    if ($breadcrumb->hasUrl()) {
        echo '<li class="current"><a href="' . $breadcrumb->getUrl() . '">' . $breadcrumb->getTitle() . '</a></li>';
    } else {
        echo '<li>' . $breadcrumb->getTitle() . '</li>';
    }
}
?>
</ol>
<div class="clear" style="clear:both;"></div>
