<?php if($_GET['lang'] == 'zh-cn') { ?>
<span class="badge bg-aqua-transparent-2 text-aqua-darker"><span class="flag-icon flag-icon-cn" title="cn" id="cn"></span> 简体</span>
<?php } else if($_GET['lang'] == 'en') { ?>
<span class="badge bg-aqua-transparent-2 text-aqua-darker"><span class="flag-icon flag-icon-us" title="us" id="us"></span> English</span>
<?php } else if($_GET['lang'] == 'jp') { ?>
<span class="badge bg-aqua-transparent-2 text-aqua-darker"><span class="flag-icon flag-icon-jp" title="jp" id="jp"></span> 日本语</span>
<?php } else if($_GET['lang'] == 'kr') { ?>
<span class="badge bg-aqua-transparent-2 text-aqua-darker"><span class="flag-icon flag-icon-kr" title="kr" id="kr"></span> 한국어</span>
<?php } else if($_GET['lang'] == 'sp') { ?>
<span class="badge bg-aqua-transparent-2 text-aqua-darker"><span class="flag-icon flag-icon-es" title="es" id="es"></span> Español</span>
<?php } else { ?>
<span class="badge bg-aqua-transparent-2 text-aqua-darker"><span class="flag-icon flag-icon-tw" title="tw" id="tw"></span> 繁體</span>
<?php } ?>
