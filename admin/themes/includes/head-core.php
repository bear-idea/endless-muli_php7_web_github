<meta name="csrf-token" id="token" content="<?php echo csrf_token(); ?>" >

<link rel="icon" href="<?php echo $SiteAdminPath; ?>favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="<?php echo $SiteAdminPath; ?>apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $SiteAdminPath; ?>apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $SiteAdminPath; ?>apple-touch-icon-144x144.png">

<?php if($SiteBaseUrlOuter != "") { $SiteAdminPath = $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { $SiteAdminPath =  $SiteBaseUrl . $SiteBaseAdminPath; } ?>
<!--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
<link href="<?php echo $SiteAdminPath; ?>assets/css/vendor.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/css/default/app.min.css" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/flag-icons/css/flag-icons.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" />

<link href="<?php echo $SiteAdminPath; ?>assets/plugins/intro.js/minified/introjs.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/colorbox/css/colorbox.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/nestable2/jquery.nestable.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/x-editable/dist/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet" />

<link href="<?php echo $SiteAdminPath; ?>assets/plugins/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/css/style.min.css" rel="stylesheet" />
<link href="<?php echo $SiteAdminPath; ?>assets/css/custom.min.css" rel="stylesheet" />

<script> var ADMINPATH = '<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>'; </script>
<script src="<?php echo $SiteAdminPath; ?>assets/js/vendor.min.js"></script>

