<!-- BEGIN navbar-collapse -->
<div class="collapse d-md-block me-auto" id="top-navbar">
  <div class="navbar-nav">
      <div class="navbar-item">
              <a class="navbar-link" href="index.php?lang=<?php echo $_SESSION['lang']; ?>"><strong><i class="fa fa-home fa-fw"></i> 後台首頁</strong></a>
      </div>

      <div class="navbar-item">
          <a class="navbar-link" href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><strong><i class="fa fa-gem fa-fw"></i> 版型設計</strong></a>
      </div>

      <div class="navbar-item">
          <a class="navbar-link" href="<?php echo $logoutAction ?>"><strong><i class="fa fa-sign-out-alt fa-fw"></i> 登出</strong></a>
      </div>
  </div>
</div>
<!-- END navbar-collapse -->