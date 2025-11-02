<?php if($_GET['lang'] == 'zh-cn') { ?>
    <span class="badge bg-light text-dark float-end"><span class="fi fi-cn rounded mb-0" title="CN"></span> 簡體</span>
<?php } else if($_GET['lang'] == 'en') { ?>
    <span class="badge bg-light text-dark float-end"><span class="fi fi-us rounded mb-0" title="us"></span> English</span>
<?php } else if($_GET['lang'] == 'jp') { ?>
    <span class="badge bg-light text-dark float-end"><span class="fi fi-jp rounded mb-0" title="jp"></span> 日本语</span>
<?php } else if($_GET['lang'] == 'kr') { ?>
    <span class="badge bg-light text-dark float-end"><span class="fi fi-kr rounded mb-0" title="kr"></span> 한국어</span>
<?php } else if($_GET['lang'] == 'sp') { ?>
    <span class="badge bg-light text-dark float-end"><span class="fi fi-sp rounded mb-0" title="sp"></span> Español</span>
<?php } else { ?>
    <span class="badge bg-light text-dark float-end"><span class="fi fi-tw rounded mb-0" title="TW"></span> 繁體</span>
<?php } ?>

