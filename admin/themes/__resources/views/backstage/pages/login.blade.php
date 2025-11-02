@extends('backstage.layouts.default', [
	'paceTop' => true,
	'appSidebarHide' => true,
	'appHeaderHide' => true,
	'appContentClass' => 'p-0'
])

@section('title', '登入')

@section('content')
	<!-- BEGIN login -->
	<div class="login login-with-news-feed">
        <!-- BEGIN news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url('https://source.unsplash.com/random')"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>Cetus</b> Alcheny</h4>
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
						<?php echo $SiteAdminPath.'/images/login_icon.png'; ?>
                        <img src="<?php echo $SiteAdminPath.'/images/login_icon.png'; ?>" class="img-fluid" width="40" alt="鯨落後台管理系統">
                        <b>Cetus</b> Alchemy
                    </div>

                    <small class="pl-45px">Backstage Management System</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in-alt"></i>
                </div>
            </div>
            <!-- END login-header -->

			<!-- BEGIN login-content -->
			<div class="login-content">
				<form action="" method="POST" class="fs-13px">
					<div class="form-floating mb-15px">
						<input type="text" class="form-control h-45px fs-13px" placeholder="Email Address" id="account" name="account" />
						<label for="account" class="d-flex align-items-center fs-13px text-gray-600">Account</label>
					</div>
					<div class="form-floating mb-15px">
						<input type="password" class="form-control h-45px fs-13px" placeholder="Password" id="psw" name="psw" />
						<label for="password" class="d-flex align-items-center fs-13px text-gray-600">Password</label>
					</div>
					<div class="form-check mb-30px">
						<input class="form-check-input" type="checkbox" value="1" id="rememberMe" />
						<label class="form-check-label" for="rememberMe">
							Remember Me
						</label>
					</div>
					<div class="mb-15px">
						<button type="submit" class="btn btn-success d-block h-45px w-100 btn-lg fs-14px">Sign me in</button>
					</div>
					<div class="mb-40px pb-40px text-dark">
						Not a member yet? Click <a href="/register/v3" class="text-primary">here</a> to register.
					</div>
					<hr class="bg-gray-600 opacity-2" />
					<div class="text-gray-600 text-center text-gray-500-darker mb-0">
						&copy; Color Admin All Right Reserved 2021
					</div>
				</form>
			</div>
			<!-- END login-content -->
		</div>
		<!-- END login-container -->
	</div>
	<!-- END login -->
@endsection
