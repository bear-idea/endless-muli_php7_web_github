<?php
echo "<ol class='breadcrumb hidden-xs' data-scroll-reveal='enter top after 0.8s'>";
foreach ($breadcrumbs as $breadcrumb) {
    if ($breadcrumb->hasUrl()) {
        echo '<li><a href="' . $breadcrumb->getUrl() . '">' . $breadcrumb->getTitle() . '</a></li>';
    } else {
        echo '<li>'.$breadcrumb->getTitle().'</li>';
    }
}
echo "</ol>";
echo "<div class='clear' style='clear:both;'></div>";
?>