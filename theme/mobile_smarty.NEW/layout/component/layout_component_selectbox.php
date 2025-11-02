<div class="btn-group margin-bottom-20">
<button type="button" class="btn bg-grey-transparent-3 dropdown-toggle" data-toggle="dropdown"><?php echo $Lang_Listitem_Select //-- 選擇項目 -- ?> <span class="caret"></span></button>
<ul class="dropdown-menu" role="menu">
<?php
foreach ($data_Selectbox as $data_Selectbox) {
    if ($data_Selectbox->hasUrl()) {
        echo '<li><a href="' . $data_Selectbox->getUrl() . '">' . $data_Selectbox->getTitle() . '</a></li>';
    } else {
        echo '<li><a>'.$data_Selectbox->getTitle().'</a></li>';
    }
}
?>
</ul>
</div>
