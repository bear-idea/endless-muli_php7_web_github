@extends('backstage.layouts.default', [
    'appHeaderLanguageBar' => true,
    'appFooter' => true
])

@section('title', '首頁')

@push('css')
	<link href="<?php echo $SiteAdminPath; ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
@endpush

@push('scripts')

@endpush

@section('content')

<?php
//dd($input);
?>


@endsection
