<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('backstage.includes.head')
</head>
<?php
	$bodyClass = (!empty($appBoxedLayout)) ? 'boxed-layout ' : '';
	$bodyClass .= (!empty($paceTop)) ? 'pace-top ' : $bodyClass;
	$bodyClass .= (!empty($bodyClass)) ? $bodyClass . ' ' : $bodyClass;
	$appSidebarHide = (!empty($appSidebarHide)) ? $appSidebarHide : '';
	$appHeaderHide = (!empty($appHeaderHide)) ? $appHeaderHide : '';
	$appSidebarTwo = (!empty($appSidebarTwo)) ? $appSidebarTwo : '';
	$appSidebarSearch = (!empty($appSidebarSearch)) ? $appSidebarSearch : '';
	$appTopMenu = (!empty($appTopMenu)) ? $appTopMenu : '';
    $appFooter = (!empty($appFooter)) ? $appFooter : '';


	$appClass = (!empty($appTopMenu)) ? 'app-with-top-menu ' : '';
	$appClass .= (!empty($appHeaderHide)) ? 'app-without-header ' : ' app-header-fixed ';
	$appClass .= (!empty($appSidebarEnd)) ? 'app-with-end-sidebar ' : '';
	$appClass .= (!empty($appSidebarLight)) ? 'app-with-light-sidebar ' : '';
	$appClass .= (!empty($appSidebarWide)) ? 'app-with-wide-sidebar ' : '';
	$appClass .= (!empty($appSidebarHide)) ? 'app-without-sidebar ' : '';
	$appClass .= (!empty($appSidebarMinified)) ? 'app-sidebar-minified ' : '';
	$appClass .= (!empty($appSidebarTwo)) ? 'app-with-two-sidebar app-sidebar-end-toggled ' : '';
	$appClass .= (!empty($appContentFullHeight)) ? 'app-content-full-height ' : '';

	$appContentClass = (!empty($appContentClass)) ? $appContentClass : '';
?>
<body class="{{ $bodyClass }}">
	@include('backstage.includes.component.page-loader')

	<div id="app" class="app app-sidebar-fixed {{ $appClass }}">

		@includeWhen(!$appHeaderHide, 'backstage.includes.header')

		@includeWhen($appTopMenu, 'backstage.includes.top-menu')

		@includeWhen(!$appSidebarHide, 'backstage.includes.sidebar')

		@includeWhen($appSidebarTwo, 'backstage.includes.sidebar-right')

		<div id="content" class="app-content p-2 {{ $appContentClass }}">
			@yield('content')
		</div>

        @includeWhen($appFooter, 'backstage.includes.footer')

		@include('backstage.includes.component.scroll-top-btn')

	</div>

	@yield('outside-content')

	@include('backstage.includes.page-js')
</body>
</html>
