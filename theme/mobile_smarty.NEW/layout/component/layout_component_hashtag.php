<div class="clearfix"></div>
<div>
<?php
foreach ($data_Hashtag as $data_Hashtag) {
    if ($data_Hashtag->hasUrl()) {
        echo '<a href="' . $data_Hashtag->getUrl() . '"><span class="label bg-black-transparent-5"># ' . $data_Hashtag->getTitle() . '</span></a> ';
    } else {
        echo '<a><span class="label bg-black-transparent-5">'.$data_Hashtag->getTitle().'</span></a> ';
    }
}
?>
</div>
<div class="clearfix"></div>