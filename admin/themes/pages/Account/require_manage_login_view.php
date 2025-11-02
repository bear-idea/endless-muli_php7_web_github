<style>
    .coming-soon {display: flex;justify-content: center; /* 水平居中 */align-items: center; /* 垂直居中 */height: 100%; /* 确保高度覆盖整个父容器 */width: 100%; /* 设置宽度为 100% */}  .coming-soon .brand {display: flex;justify-content: center; /* 水平居中 */align-items: center; /* 垂直居中 */transform: translateY(-60px); /* 向上移動 200px */}
    .login-cover-img {background-size: cover;background-position: center;height: 100vh;width: 100%;animation: zoomFadeInOut 20s ease-in-out infinite;}  @keyframes zoomFadeInOut { 0% {transform: scale(1.4);  /* 從放大的狀態開始 */opacity: 0;  /* 完全透明 */} 25% {transform: scale(1);  /* 從放大漸漸恢復正常大小 */opacity: 1;  /* 漸漸變得完全不透明（淡入） */} 75% {transform: scale(1);  /* 保持正常大小 */opacity: 1;  /* 完全不透明 */} 100% {transform: scale(1.2);  /* 再次放大 */opacity: 0;  /* 漸漸變得完全透明（淡出） */} }
</style>

<!-- BEGIN login -->
<div class="login login-with-news-feed">
    <!-- BEGIN news-feed -->
    <div class="news-feed login-cover">

        <div class="login-cover-img" style="background-image: url(https://picsum.photos/1920/1080)" data-id="login-cover-image"></div>
        <div class="login-cover-bg"></div>
        <div class="coming-soon">
            <div class="coming-soon-header" style="background-image: none">
                <div class="brand" style="width: 1024px; ">
                    <?php require_once ADMINPATH . '/themes/includes/component/logo-line.php'; ?>
                </div>

            </div>

        </div>
        <div class="news-caption">
            <h4 class="caption-title"><b>Management</b> System</h4>
            <p>
                Using CC0 Image. Explore the pictures of the world.
            </p>
        </div>
    </div>
    <!-- END news-feed -->

    <!-- BEGIN login-container -->
    <div class="login-container">
        <!-- BEGIN login-header -->

        <div class="login-header mb-30px">
            <div class="brand">
                <div class="d-flex align-items-center">
                    <img src="<?php echo $SiteAdminPath; ?>images/loginpic_a.svg" class="img-fluid" style="width: 50px;">
                    <b>Cetus</b> Alchemy
                </div>
                <small class="pl-45px">Backstage Management System</small>
            </div>
            <div class="icon">
                <?php echo renderIcon('material-symbols:lock-person-sharp','fs-64px'); ?>
<!--                <i class="fa fa-lock"></i>-->
            </div>
        </div>
        <!-- END login-header -->

        <!-- BEGIN login-content -->
        <?php if (isset($_GET['errMsg']) && $_GET['errMsg'] == "y") { ?>
            <div class="alert alert-danger fade show m-b-10">
                <i class="fa fa-times-circle"></i> 帳號或密碼錯誤！！請重新輸入！！
            </div>
        <?php } ?>
        <div class="login-content">
            <form id="ADlogin" name="ADlogin" method="post" action="<?php echo $loginFormAction; ?>" data-parsley-validate="">
                <div class="form-floating mb-15px">
                    <input type="text" class="form-control h-45px fs-13px" placeholder="帳號" id="Wshop_account" name="Wshop_account" required/>
                    <label for="Wshop_account" class="d-flex align-items-center fs-13px text-gray-600">帳號</label>
                </div>
                <div class="form-floating mb-15px">
                    <input type="password" class="form-control h-45px fs-13px" placeholder="密碼" id="psw" name="psw" required/>
                    <label for="psw" class="d-flex align-items-center fs-13px text-gray-600">密碼</label>
                </div>
                <div class="form-check mb-30px">
                    <input class="form-check-input" type="checkbox" value="1" id="rember_check" name="rember_check" />
                    <label class="form-check-label" for="rember_check">
                        記住帳密
                    </label>
                </div>
                <div class="mb-15px">
                    <button type="submit" class="btn btn-success d-block h-45px w-100 btn-lg fs-14px">登入</button>
                    <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
                </div>
                <div class="mb-40px pb-40px text-inverse">
                    <a href="../index.php" class="text-silver-lighter"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 返回首頁</a>
                </div>
                <hr class="bg-gray-600 opacity-2" />
                <div class="text-gray-600 text-center text-gray-500-darker mb-0">
                    &copy; All Right Reserved 2024
                </div>
            </form>
        </div>
        <!-- END login-content -->
    </div>
    <!-- END login-container -->
</div>
<!-- END login -->
